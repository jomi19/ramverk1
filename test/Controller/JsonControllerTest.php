<?php

namespace Anax\Controller;

use Joakim\Controller\JsonController;
use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class JsonControllerTest extends TestCase
{
    protected function setUp(): void
    {
        // Init service container $di to contain $app as a service
        $di = new DIFactoryConfig();
        $app = $di;
        $di->set("app", $app);

        // Create and initiate the controller
        $this->controller = new JsonController();
    }
    /**
     * Test the route "index".
     */
    public function testIndexActionPost()
    {
        $test = [
            ["ip" => "fel ip", "result" => "Invalid ip"],
            ["ip" => "185.49.134.3", "result" => "IPV4", "hostName" => "www.blocket.se"],
            ["ip" => "2001:0db8:85a3:0000:0000:8a2e:0370:7334", "result" => "IPV6"],
            ["ip" => false, "result" => "No ip"]];
        
        foreach ($test as $testCase) {
            $_POST["ip"] = $testCase["ip"];

            if (!$testCase["ip"]) {
                unset($_POST);
            }

            $res = $this->controller->indexActionPost();

            $this->assertContains($testCase["result"], $res[0]["type"]);
            if (isset($testCase["hostName"])) {
                $this->assertContains($testCase["hostName"], $res[0]["hostName"]);
            }
        }
    }

    public function testIndex()
    {
        $res = $this->controller->indexAction();

        $this->assertContains("Hej", $res);
    }
}
