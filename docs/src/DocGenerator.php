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

        self::createMockEnviroment();

        foreach ($ressources as $ressource) {
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

        $appendingContent = self::processResourceContent($resource);

        if (!array_key_exists($docName, self::$DOCS)) {
            self::$DOCS[$docName] = '';
        }

        self::$DOCS[$docName] .= $appendingContent . "\n";
    }

    private static function storeDocsToDisk()
    {
        foreach (self::$DOCS as $docName => $docContent) {
            file_put_contents(self::$OUTPUT_DIR . $docName . ".md", $docContent);
        }
    }

    private static function parseResourceToDocName(string $resource): string
    {
        $array = explode('_', $resource);
        array_pop($array);
        return implode($array);
    }

    private static function processResourceContent(string $resource): string
    {
        $fileInfo = pathinfo(self::$RESOURCES_DIR . $resource);

        switch ($fileInfo['extension']) {
            case "php":
                return self::processResourceContentAsPhp($resource);
                break;
            case "md":
                return self::processResourceContentAsMd($resource);
                break;
            default:
                throw new Exception("File-Extension " . $fileInfo['extension'] . " is not supported!");
        }
    }

    private static function processResourceContentAsPhp($resource): string
    {
        self::$ddBuffer = []; // Reset DD-Buffer

        $phpCode = file_get_contents(self::$RESOURCES_DIR . $resource);

        // remove "<?php"-Tags
        $phpCode = str_replace("<?php", "", $phpCode);

        eval($phpCode);

        $printCode = "";

        $ddBufferIndex = 0;
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $phpCode) as $line) {
            // replace "dd" with "echo" and print dd-Buffer-Content
            if (str_contains($line, "dd(")) {
                $printCode .= str_replace('dd(', 'echo ', $line);
                $printCode .= "\n// OUTPUT: " . self::$ddBuffer[$ddBufferIndex] . "\n";
                $ddBufferIndex++;
            } else {
                $printCode .= $line . "\n";
            }
        }

        return "```\n" . $printCode . "\n```";
    }

    private static function processResourceContentAsMd($resource): string
    {
        return file_get_contents(self::$RESOURCES_DIR . $resource);
    }
}