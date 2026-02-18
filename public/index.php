<?php

require_once __DIR__ . "/../vendor/autoload.php";

register_exception_handlers();
load_env(from_base_dir(".env"));
require_once from_base_dir("bootstrap.php");

$router = new Sapling\Core\Router(Sapling\Core\Request::fromGlobals());
require_once from_base_dir("routes.php");
if (!$router->matched) {
    Sapling\Core\Response::notFound("Not found")->send();
}
