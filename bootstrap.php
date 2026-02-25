<?php

Sapling\Core\Database::set(tap(
    new PDO('sqlite:' . from_base_dir('app.db')),
    Sapling\Core\Database::saneDefaultsForSqlitePdo(...)
));
