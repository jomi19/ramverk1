<?php

namespace Joakim\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Joakim\Ip\Ip;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class JsonController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionPost()
    {
        $json = [ "type" => "Invalid ip"];

        
        if (!isset($_POST["ip"]) || strlen($_POST["ip"]) < 1) {
            $json = ["type" => "No ip"];
            return [$json];
        }

        $ipAdress = $_POST["ip"];
        $ipData = new Ip();
        $data = $ipData->getIp($ipAdress);

        return [$data];
    }

    public function indexAction()
    {
        return "Hej";
    }
}
