<?php

namespace App;

use Sapling\Attributes\Route;
use Sapling\Http\Response;

#[Route('GET', 'ping')]
final class PingAction
{
	public function __invoke(): Response
	{
		return Response::text('pong');
	}
}
