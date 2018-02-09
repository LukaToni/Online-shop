<?php

// enables sessions for the entire app
session_start();

require_once("controller/ItemsController.php");
require_once("controller/ItemsRESTController.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "/^articles\/?(\d+)?$/" => function ($method, $id = null) {
        if ($id == null) {
            ItemsController::index();
        } else {
            ItemsController::get($id);
        }
    },
    "/^articles\/add$/" => function ($method) {
        if ($method == "POST") {
            ItemsController::add();
        } else {
            ItemsController::addForm();
        }
    },
    "/^articles\/(\d+)\/(foo|bar|baz)\/(\d+)$/" => function ($method, $id, $val, $num) {
        // primer kako definirati funkcijo, ki vzame dodatne parametre
        // http://localhost/netbeans/mvc-rest/books/1/foo/10
        echo "$id, $val, $num";
    },
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "articles");
    },
    # REST API
            
    "/^api\/articles\/(\d+)$/" => function ($method, $id = null) {
        switch ($method) {
            case "PUT":
                ItemsRESTController::edit($id);
                break;
            default: # GET
                ItemsRESTController::get($id);
                break;
        }
    },
    "/^api\/articles$/" => function ($method, $id = null) {
        switch ($method) {
            case "POST":
                ItemsRESTController::add();
                break;
            default: # GET
                ItemsRESTController::index();
                break;
        }
    },
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}

ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);
