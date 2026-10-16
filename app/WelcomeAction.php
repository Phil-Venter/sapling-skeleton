<?php

namespace App;

use Sapling\Attributes\Route;
use Sapling\Http\Response;
use Sapling\Template;

#[Route('GET', '')]
final class WelcomeAction
{
	public function __construct(
		private Template $template,
	) {}

	public function __invoke(): Response
	{
		return Response::html($this->template->render('welcome'));
	}
}
