<?php

/** @var Sapling\Core\Router $router */
use Sapling\Core\Response;

$router->get("ping", function () {
    $sql = <<<'SQL'
        INSERT INTO visits (ip, "count", date)
        VALUES (:ip, 1, :date)
        ON CONFLICT(ip, date) DO UPDATE SET
          "count" = "count" + 1
        RETURNING "count";
    SQL;

    $data = [
        "ip" => $_SERVER["REMOTE_ADDR"] ?? "",
        "date" => date("Y-m-d H:i:s"),
    ];

    $count = (int) tap(pdo()->prepare($sql))
        ->execute($data)
        ->fetchColumn();

    return Response::ok()->text("pong ($count)");
});
