<?php

use Sapling\App;
use Sapling\Db;
use Sapling\Migrations;

// PHPUnit lowers error_reporting() during tests, which hides the warnings Sapling turns into crashes.
pest()->beforeEach(function () {
	error_reporting(E_ALL);
});

function testApp(): App
{
	$_SESSION = [];

	$app = require __DIR__ . '/../bootstrap.php';
	$db = Db::sqlite(':memory:');
	new Migrations($db, $app->path('database/migrations'))->run();
	$app->container->set(Db::class, $db);

	return $app;
}
