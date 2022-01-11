<?php

use CTApi\CTClient;
use CTApi\CTConfig;
use Tests\Unit\HttpMock\CTClientMock;

require_once __DIR__ . "/../../vendor/autoload.php";

DocGenerator::generateDocs();


function dd(mixed $value)
{
    array_push(DocGenerator::$ddBuffer, $value);
}

class DocGenerator
{

    private static $RESOURCES_DIR = __DIR__ . "/ressources/";
    private static $OUTPUT_DIR = __DIR__ . "/output/";
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
        $content = file_get_contents(self::$RESOURCES_DIR . $resource);

        $contentParts = explode('```', $content);
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
        }catch (\CTApi\Exceptions\CTAuthException $exception){
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
}