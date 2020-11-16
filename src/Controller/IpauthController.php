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
class IpauthController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexActionPost() : object
    {
        $ipAdress = $_POST["ip"];
        $valid = false;
        $type = 6;
        $hostName = false;

        if (filter_var($ipAdress, FILTER_VALIDATE_IP)) {
            if (filter_var($ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                $type = 4;
                $hostName = gethostbyaddr($ipAdress);
            }
            $valid = true;
        }

        $page = $this->di->get("page");

        $page->add("joakim/ip/index", [
            "valid" => $valid,
            "check" => true,
            "type" => $type,
            "hostName" => $hostName
        ]);

        
        return $page->render([
            "title" => "Hejsan",

        ]);
    }

    public function indexAction() : object
    {
        $title = "Stylechooser";
        $page = $this->di->get("page");

        
        // $active = $session->get(self::$key, null);

        $page->add("joakim/ip/index", [
            "check" => false
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }
}
