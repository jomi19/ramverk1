<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip.",
            "mount" => "ip",
            "handler" => "\Joakim\Controller\IpauthController",
        ],
        [
            "info" => "Json ip.",
            "mount" => "jsonip",
            "handler" => "\Joakim\Controller\JsonController",
        ],
    ]
];
