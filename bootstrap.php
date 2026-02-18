<?php

register_pdo(tap(
    new PDO('sqlite:' . from_base_dir('app.db')),
    sane_defaults_for_sqlite_pdo(...)
));

pdo()->exec(<<<'SQL'
    CREATE TABLE IF NOT EXISTS visits (
        ip      TEXT    NOT NULL,
        "count" INTEGER NOT NULL DEFAULT 0,
        date    TEXT    NOT NULL,
        PRIMARY KEY (ip, date)
    );
SQL);
