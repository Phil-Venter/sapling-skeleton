<?php

/* -----------------------------------------------------------------------------
 | Application Routes
 |-----------------------------------------------------------------------------
 | This file registers all HTTP routes for the application.
 |
 | Route patterns:
 | - Static paths:      "ping"
 | - Parameters:        "users/{id}"
 |
 | Notes:
 | - The router normalizes paths (trailing slashes are handled internally).
 | - Handlers should return a Sapling\Core\Response instance.
 | - If no route matches, the front controller returns a 404 response.
 *----------------------------------------------------------------------------*/

/** @var Sapling\Core\Router $router */

use Sapling\Core\Response;

/* -----------------------------------------------------------------------------
 | Health Check / Ping
 |-----------------------------------------------------------------------------
 | Simple endpoint used to verify the app is running and routing works.
 *----------------------------------------------------------------------------*/

$router->get("ping", static fn() => Response::ok("pong", [
    "Content-Type" => "text/plain; charset=utf-8",
]));
