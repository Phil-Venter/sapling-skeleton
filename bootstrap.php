<?php

register_pdo(tap(
    new PDO('sqlite:' . from_base_dir('app.db')),
    sane_defaults_for_sqlite_pdo(...)
));
