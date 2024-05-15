<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

abstract class AbstractController
{
	public function inertia(string $component, array $properties = []): Response
	{
		return Inertia::render($component, $properties);
	}
}
