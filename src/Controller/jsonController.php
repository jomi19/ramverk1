<?php

namespace Joakim\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

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
        $valid = false;
        $type = "IPV6";
        $hostName = false;
        $json = [ "type" => "Invalid ip"];

        if (!isset($_POST["ip"])) {
            $json = ["type" => "No ip"];
            return [$json];
        }

        $ipAdress = $_POST["ip"];
        if (filter_var($ipAdress, FILTER_VALIDATE_IP)) {
            if (filter_var($ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                $type = "IPV4";
                $hostName = gethostbyaddr($ipAdress);
            }
            $valid = true;
            $json = ["type" => $type,
                "hostName" => $hostName
            ];

            return [$json];
        }


        return [$json];
    }

    public function indexAction()
    {
        return "Hej";
    }
}
