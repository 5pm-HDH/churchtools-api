<?php


namespace CTApi\Test\Integration;


use CTApi\CTConfig;
use CTApi\Models\Common\Auth\Auth;
use CTApi\Utils\CTUtil;

class IntegrationTestData
{
    private static $FILE_DIR = __DIR__ . '/integration-test-data.json';
    private static $CREDENTIALS_FILE = __DIR__ . '/integration.ini';

    private static ?IntegrationTestData $singleton = null;

    private string $apiUrl;
    private array $testCases = [];
    private array $users = [];

    private function __construct()
    {
        if (!file_exists(self::$FILE_DIR)) {
            throw new \Exception("Could not load integration-test-data.json");
        }
        $testDataContent = file_get_contents(self::$FILE_DIR);
        $testData = json_decode($testDataContent, true);

        if ($testDataContent != null && $testData == null) {
            throw new \Exception("Could not parse integration-test-data.json to json format.");
        }

        $this->apiUrl = CTUtil::arrayPathGet($testData, "environment.api_url");
        $this->testCases = CTUtil::arrayPathGet($testData, "testCases") ?? [];
        $this->users = CTUtil::arrayPathGet($testData, "users") ?? [];
    }

    public static function get(): IntegrationTestData
    {
        if (self::$singleton == null) {
            self::$singleton = new IntegrationTestData();
        }
        return self::$singleton;
    }

    /**
     * STATIC SHORTCUTS
     */

    /**
     * Return expected result for testcase.
     * @param string $testCase e.q. filter_events
     * @param string $path e.q.: first_element.name
     */
    public static function getResult(string $testCase, string $path)
    {
        return self::getTestCase($testCase)->getResult($path);
    }

    public static function getResultAsInt(string $testCase, string $path): int
    {
        return self::getTestCase($testCase)->getResultAsInt($path);
    }

    public static function getFilter(string $testCase, string $path)
    {
        return self::getTestCase($testCase)->getFilter($path);
    }

    public static function getFilterAsInt(string $testCase, string $path): int
    {
        return self::getTestCase($testCase)->getFilterAsInt($path);
    }

    public static function getTestCase(string $testCase): IntegrationTestCase
    {
        return new IntegrationTestCase($testCase, self::get()->getTestCaseResult($testCase));
    }

    /**
     * Returns API-Url for IntegrationTest-Environment.
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $userIdentifier
     * @return Auth
     * @throws \Exception
     */
    public function authenticateUser(string $userIdentifier = "default", ?string $totp = null): Auth
    {
        if (!array_key_exists($userIdentifier, $this->users)) {
            throw new \Exception("Could not find user in integration-test-data with identifier: " . $userIdentifier);
        }

        if (!file_exists(self::$CREDENTIALS_FILE)) {
            throw new \Exception("Could not find credentials file: " . self::$CREDENTIALS_FILE);
        }

        $mailKey = strtoupper($userIdentifier) . "_EMAIL";
        $passwordKey = strtoupper($userIdentifier) . "_PASSWORD";

        $credentials = parse_ini_file(self::$CREDENTIALS_FILE);
        $mail = $credentials[$mailKey] ?? null;
        $password = $credentials[$passwordKey] ?? null;

        if ($mail == null || $password == null) {
            throw new \Exception("Could not find email (Key: " . $mail . ") or password (Key: " . $password . ") for user (" . $userIdentifier . ") in credentials file.");
        }

        return CTConfig::authWithCredentials($mail, $password, $totp);
    }

    public function getUserData(string $userIdentifier = "default"): array
    {
        if (!array_key_exists($userIdentifier, $this->users)) {
            throw new \Exception("Could not find user in integration-test-data with identifier: " . $userIdentifier);
        }

        return $this->users["default"];
    }

    private function getTestCaseResult(string $testCaseIdentifier): array
    {
        if (!array_key_exists($testCaseIdentifier, $this->testCases)) {
            throw new \Exception("Could not find test case: " . $testCaseIdentifier);
        }
        return $this->testCases[$testCaseIdentifier];
    }

}