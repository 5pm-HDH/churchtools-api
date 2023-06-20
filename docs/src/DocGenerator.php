<?php

use CTApi\CTClient;
use CTApi\CTConfig;
use CTApi\Exceptions\CTAuthException;
use CTApi\Exceptions\CTRequestException;
use CTApi\Test\Unit\HttpMock\CTClientMock;

require_once __DIR__ . "/../../vendor/autoload.php";

DocGenerator::generateDocs();


function dd(mixed $value)
{
    if(is_object($value)){
        $value = (array) $value;
    }
    if(is_array($value)){
        array_push(DocGenerator::$ddBuffer, json_encode($value));
    }else{
        array_push(DocGenerator::$ddBuffer, strval($value));
    }
}

class DocGenerator
{

    private static $RESOURCES_DIR = __DIR__ . "/ressources/";
    private static $OUTPUT_DIR = __DIR__ . "/../out/";
    private static $DOCS = [];

    public static $ddBuffer = [];

    public static function generateDocs(): void
    {
        $ressources = scandir(self::$RESOURCES_DIR, SCANDIR_SORT_ASCENDING);

        CTConfig::enableDebugging();

        foreach ($ressources as $ressource) {
            self::createMockEnviroment();
            self::processResource($ressource);
        }

        self::storeDocsToDisk();
    }

    private static function createMockEnviroment()
    {
        CTConfig::setApiUrl("https://example.church.tools/");
        CTConfig::setApiKey("exampleapikey");
        CTClient::setClient(new CTClientMock());
    }

    private static function processResource(string $resource): void
    {
        if ($resource == "." || $resource == "..") {
            return;
        }
        $docName = self::parseResourceToDocName($resource);

        $content = self::processResourceContent($resource);
        self::$DOCS[$docName] = $content;
    }

    private static function storeDocsToDisk()
    {
        foreach (self::$DOCS as $docName => $docContent) {
            file_put_contents(self::$OUTPUT_DIR . $docName . ".md", $docContent);
        }
    }

    private static function parseResourceToDocName(string $resource): string
    {
        $array = explode('.', $resource);
        array_pop($array);
        return implode($array);
    }

    private static function processResourceContent(string $resource): string
    {
        \CTApi\CTLog::enableConsoleLog();
        \CTApi\CTLog::getLog()->debug("GenerateDocs of: ".$resource);
        $methodContent = file_get_contents(self::$RESOURCES_DIR . $resource);

        // Process Code-Examples @deprecated
        $contentParts = explode('```', $methodContent);
        $processedContent = "";

        $isMarkdown = true;
        foreach($contentParts as $contentPart){
            if($isMarkdown){
                $processedContent .= self::processContentAsMd($contentPart);
            }else{
                $processedContent .= self::processContentAsPhp($contentPart);
            }

            $isMarkdown = !$isMarkdown;
        }

        // Process Templating-Syntax
        $templateTags = [];
        preg_match_all('/{{(.*?)}}/', $processedContent, $templateTags);

        foreach($templateTags[0] as $key => $tagWithBraces){
            $tagWithoutBraces = $templateTags[1][$key];

            $tagWithoutBracesParts = explode(".", $tagWithoutBraces);
            $tagClass = trim($tagWithoutBracesParts[0]);
            $tagMethod = trim($tagWithoutBracesParts[1]);

            $methodContent = self::processTestMethod($tagClass, $tagMethod);
            $processedContent = str_replace($tagWithBraces, $methodContent, $processedContent);
        }

        return $processedContent;
    }

    private static function processContentAsPhp($content): string
    {
        self::$ddBuffer = []; // Reset DD-Buffer

        $phpCode = $content;

        // remove "<?php"-Tags
        $phpCode = str_replace("php", "", $phpCode);

        try{
            eval($phpCode);
        }catch (CTAuthException|CTRequestException $exception){
            // ignore
        }catch (Exception $exception){
            //
            $i = 1;
        }

        $printCode = "";

        $ddBufferIndex = 0;
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $phpCode) as $line) {
            // replace "dd" with "echo" and print dd-Buffer-Content
            if (str_contains($line, "dd(")) {
                $printCode .= str_replace('dd(', 'echo (', $line);
                if(array_key_exists($ddBufferIndex, self::$ddBuffer)){
                    $printCode .= "\n// OUTPUT: " . self::$ddBuffer[$ddBufferIndex] . "\n";
                }else{
                    throw new Exception("DD-Buffer is invalid!");
                }

                $ddBufferIndex++;
            } else {
                $printCode .= $line . "\n";
            }
        }

        return "```php" . $printCode . "```";
    }

    private static function processContentAsMd($content): string
    {
        return $content;
    }

    /**
     * Parase Template brackets `{{` [TestClass].[TestMethod] `}}`
     * @param $testClass Class as String
     * @param $methodName Methodname as String
     * @return string Markdown-Content
     */
    private static function processTestMethod($testClass, $methodName){
        try{
            $reflectionClass = new ReflectionClass($testClass);
            $reflectionMethod = $reflectionClass->getMethod($methodName);

            $filename = $reflectionMethod->getFileName();
            $start_line = $reflectionMethod->getStartLine()+1; // curly bracket is in new line
            $end_line = $reflectionMethod->getEndLine()-1; // remove last brace
            $length = $end_line - $start_line;

            $testSourceCode = file($filename);

            // Slice Method-Source-Code from whole file
            $methodSourceCode = implode("", array_slice($testSourceCode, $start_line, $length));

            // Replace Asssert-Statements with "var_dump"-commands
            $methodSourceCode = self::processAsssertEqualsStatements($methodSourceCode);

            // Add Import-Statements
            $imports = self::extractImportsFromSourceCode(implode("", $testSourceCode));
            $methodSourceCode = $imports . "\n" . $methodSourceCode;

            // Wrap Markdown
            $methodSourceCode = "```php\n".$methodSourceCode."\n```";

            return $methodSourceCode;
        }catch (ReflectionException $exception){
            \CTApi\CTLog::getLog()->error("Could not read Test-Sourcecode: ", [$exception->getMessage()]);
            return "(EXAMPLE CODE IS MISSING)";
        }
    }

    /**
     * Extract `use`-Statements from PHP-File. Ignore imports from namespaces that start with Tests or PHPUnit.
     * @param $sourceCode
     * @return string md with import-statements
     */
    private static function extractImportsFromSourceCode($sourceCode): string{
        $imports = [];
        preg_match_all('/use (.*?);/', $sourceCode, $imports);

        $stringImports = "";
        foreach($imports[0] as $key => $importStatement){
            $importClass = $imports[1][$key];
            if(!str_starts_with($importClass, "Tests")
            && !str_starts_with($importClass, "PHPUnit")){
                $stringImports .= "        ".$importStatement."\n";
            }
        }

        return $stringImports;
    }

    /**
     * Convert all `assertEquals`-Statements to var_dump methods.
     * @param $testCode
     * @return string
     */
    private static function processAsssertEqualsStatements($testCode){
        $matches = [];
        $resultCode = $testCode;

        preg_match_all('/\$this->assertEquals\((.*?),(.*?)\);/', $testCode, $matches);

        $assertStatements = $matches[0];
        $results = $matches[1];
        $codes = $matches[2];

        if(sizeof($assertStatements) != sizeof($results) || sizeof($assertStatements) != sizeof($codes)){
            \CTApi\CTLog::getLog()->warning("Could not parse Assert-Statements.");
            return $testCode;
        }

        for($index = 0; $index < sizeof($assertStatements); $index++){
            $assertStatement = $assertStatements[$index];
            $result = $results[$index];

            $executionCode = "var_dump(".$codes[$index].");";
            $replaceString = $executionCode."\n        // Output: ".$result."\n";

            $resultCode = str_replace($assertStatement, $replaceString, $resultCode);
        }

        return $resultCode;
    }
}