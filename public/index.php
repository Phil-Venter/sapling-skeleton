<?php

/* -----------------------------------------------------------------------------
 | Front Controller
 |-----------------------------------------------------------------------------
 | This is the single entry point for every HTTP request.
 | It bootstraps the application, loads routes, dispatches the request,
 | and returns a response.
 *----------------------------------------------------------------------------*/

require_once __DIR__ . "/../vendor/autoload.php";

/* -----------------------------------------------------------------------------
 | Global Error / Exception Handling
 |-----------------------------------------------------------------------------
 | - Uncaught exceptions are rendered as a structured HTTP response.
 | - Fatal errors (that bypass exceptions) are converted into an exception-style
 |   response during shutdown.
 *----------------------------------------------------------------------------*/

set_exception_handler(function (Throwable $e) {
    Sapling\Core\Response::exception($e)->send();
    exit();
});

register_shutdown_function(function () {
    if (!($err = error_get_last())) {
        return;
    }

    $fatal = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR];

    if (in_array($err["type"], $fatal, true)) {
        $e = new \ErrorException($err["message"], 0, $err["type"], $err["file"], $err["line"]);
        Sapling\Core\Response::exception($e)->send();
        exit();
    }
});

/* -----------------------------------------------------------------------------
 | Environment
 |-----------------------------------------------------------------------------
 | Load configuration values from .env (if present).
 | This is typically used for APP_ENV, database credentials, API keys, etc.
 *----------------------------------------------------------------------------*/

Sapling\Core\Environment::load(__DIR__ . "/../.env");

/* -----------------------------------------------------------------------------
 | Development Diagnostics
 |-----------------------------------------------------------------------------
 | In development, convert PHP warnings/notices into exceptions so they are
 | surfaced consistently through the exception handler.
 *----------------------------------------------------------------------------*/

if (Sapling\Core\Environment::get("APP_ENV") === "dev") {
    set_error_handler(function (int $severity, string $message, string $file, int $line) {
        if (error_reporting() & $severity) {
            throw new \ErrorException($message, 0, $severity, $file, $line);
        }

        return false;
    });
}

/* -----------------------------------------------------------------------------
 | Routing
 |-----------------------------------------------------------------------------
 | Build the router from the incoming request (method + path),
 | then load route definitions.
 *----------------------------------------------------------------------------*/

$router = Sapling\Core\Router::fromGlobals();

require_once __DIR__ . "/../routes.php";

/* -----------------------------------------------------------------------------
 | Fallback Response
 |-----------------------------------------------------------------------------
 | If no route matched, return a 404 response.
 *----------------------------------------------------------------------------*/

Sapling\Core\Response::notFound("Not found")->send();
exit();
