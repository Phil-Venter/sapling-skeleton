<?php

require_once __DIR__ . "/../vendor/autoload.php";

set_error_handler(function (int $severity, string $message, string $file, int $line): bool {
    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    return false;
});

set_exception_handler(function (Throwable $e): void {
    Sapling\Core\Response::exception($e)->send();
    exit(1);
});

register_shutdown_function(function (): void {
    $err = error_get_last();
    if ($err === null) {
        return;
    }

    $fatalTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR];
    if (!in_array($err["type"], $fatalTypes, true)) {
        return;
    }

    $exception = new ErrorException($err["message"], 0, $err["type"], $err["file"], $err["line"]);
    Sapling\Core\Response::exception($exception)->send();
    exit(1);
});

load_env(from_base_dir(".env"));
require_once from_base_dir("bootstrap.php");

$router = new Sapling\Core\Router(Sapling\Core\Request::fromGlobals());
require_once from_base_dir("routes.php");
if (!$router->matched) {
    Sapling\Core\Response::notFound()
        ->render(file_get_contents(from_base_dir("views/404.html")))
        ->send();
}
