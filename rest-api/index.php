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
    "/^items\/?(\d+)?$/" => function ($method, $id = null) {
        if ($id == null) {
            ItemsController::index();
        } else {
            ItemsController::get($id);
        }
    },
    "/^items\/add$/" => function ($method) {
        if ($method == "POST") {
            ItemsController::add();
        } else {
            ItemsController::addForm();
        }
    },
    "/^items\/edit\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            ItemsController::edit($id);
        } else {
            ItemsController::editForm($id);
        }
    },
    "/^items\/delete\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            ItemsController::delete($id);
        }
    },
    "/^items\/(\d+)\/(foo|bar|baz)\/(\d+)$/" => function ($method, $id, $val, $num) {
        // primer kako definirati funkcijo, ki vzame dodatne parametre
        // http://localhost/netbeans/mvc-rest/books/1/foo/10
        echo "$id, $val, $num";
    },
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "items");
    },
    # REST API
    "/^api\/items\/(\d+)$/" => function ($method, $id = null) {
        // TODO: izbris knjige z uporabo HTTP metode DELETE
        switch ($method) {
            case "PUT":
                ItemsRESTController::edit($id);
                break;
            default: # GET
                ItemsRESTController::get($id);
                break;
        }
    },
    "/^api\/items$/" => function ($method, $id = null) {
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
