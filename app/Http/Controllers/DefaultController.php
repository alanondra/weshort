<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;

class DefaultController extends AbstractController
{
	public function index(): Responsable
	{
		return $this->inertia('Index');
	}
}
