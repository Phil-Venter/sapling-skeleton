<?php

require_once __DIR__ . "/../vendor/autoload.php";

require_once from_base_dir("bootstrap.php");

pdo()->exec(<<<'SQL'
    CREATE TABLE IF NOT EXISTS visits (
        ip      TEXT    NOT NULL,
        "count" INTEGER NOT NULL DEFAULT 0,
        date    TEXT    NOT NULL,
        PRIMARY KEY (ip, date)
    );
SQL);
