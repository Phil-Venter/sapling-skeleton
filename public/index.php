<?php

require_once __DIR__ . "/../vendor/autoload.php";
$router = initialise(".env");

require_once base_dir() . "routes.php";

if (!$router->matched) {
    Sapling\Core\Response::notFound("Not found")->send();
}
