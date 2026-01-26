<?php

function initialise(string $env): Sapling\Core\Router
{
    set_error_handler(function (int $severity, string $message, string $file, int $line) {
        if (error_reporting() & $severity) {
            throw new \ErrorException($message, 0, $severity, $file, $line);
        }

        return false;
    });

    set_exception_handler(function (Throwable $e) {
        Sapling\Core\Response::exception($e)->send();
        exit();
    });

    register_shutdown_function(function () {
        if (!($err = error_get_last())) {
            return;
        }

        if (in_array($err["type"], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR], true)) {
            Sapling\Core\Response::exception(new \ErrorException($err["message"], 0, $err["type"], $err["file"], $err["line"]))->send();
            exit();
        }
    });

    Sapling\Core\Environment::load(base_dir() . $env);
    return Sapling\Core\Router::fromGlobals();
}
