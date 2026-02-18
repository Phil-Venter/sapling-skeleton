<?php

/** @var Sapling\Core\Router $router */
use Sapling\Core\Response;

$router->get("ping", function () {
    $count = (int) tap(pdo()->prepare(<<<'SQL'
        INSERT INTO visits (ip, "count", date)
        VALUES (:ip, 1, :date)
        ON CONFLICT(ip, date) DO UPDATE SET
          "count" = "count" + 1
        RETURNING "count";
    SQL))->execute([
        "ip"   => $_SERVER["REMOTE_ADDR"] ?? "",
        "date" => date("Y-m-d H:i:s"),
    ])->fetchColumn();

    return Response::ok("pong ($count)", ["Content-Type" => "text/plain; charset=utf-8"]);
});
