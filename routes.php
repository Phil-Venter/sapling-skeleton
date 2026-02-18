<?php

/** @var Sapling\Core\Router $router */
use Sapling\Core\Response;

$router->get("ping", function () {
    pdo()->prepare(<<<'SQL'
        INSERT INTO visits (ip, "count", date)
        VALUES (:ip, 1, :date)
        ON CONFLICT(ip, date) DO UPDATE SET
        "count" = "count" + 1;
    SQL)
    ->execute([
        "ip" => $_SERVER["REMOTE_ADDR"],
        "date" => date("Y-m-d"),
    ]);

    return Response::ok("pong", ["Content-Type" => "text/plain; charset=utf-8"]);
});
