<?php

return [
	'debug' => ($env['APP_ENV'] ?? 'production') === 'dev',
	'app_name' => 'Sapling',
	'app_key' => $env['APP_KEY'] ?? '',
	'timezone' => 'UTC',
	'db_file' => $env['DB_FILE'] ?? __DIR__ . '/database/app.db',
	'session_lifetime' => 60 * 60 * 24 * 14,
];
