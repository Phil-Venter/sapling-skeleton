<?php

use Sapling\Http\Request;

test('ping answers pong', function () {
	$response = testApp()->handle(new Request('GET', '/ping'));

	expect($response->status)->toBe(200);
	expect($response->body)->toBe('pong');
});
