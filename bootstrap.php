<?php

use Sapling\App;
use Sapling\Config;
use Sapling\Db;
use Sapling\Http\Middleware\Csrf;
use Sapling\Http\Middleware\SecurityHeaders;
use Sapling\Http\Response;
use Sapling\Template;

$config = Config::load(
	configFile: __DIR__ . '/config.php',
	envFile: __DIR__ . '/.env',
);

$app = App::boot(__DIR__, $config);

$app->middleware(SecurityHeaders::class);
$app->middleware(Csrf::class);

// For the Dockerfile's health check.
$app->router->add('GET', 'ping', fn(): Response => Response::text('pong'));

$app->container->set(Db::class, fn() => Db::sqlite($config->get('db_file')));
$app->container->get(Template::class)->share('appName', $config->get('app_name'));

$app->scan(__DIR__ . '/app', 'App');

return $app;
