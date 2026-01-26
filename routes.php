<?php

/** @var Sapling\Core\Router $router */
use Sapling\Core\Response;

$router->get("ping", static fn() => Response::ok("pong", [
    "Content-Type" => "text/plain; charset=utf-8",
]));
