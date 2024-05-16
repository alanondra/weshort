<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\ShortLink;
use App\Services\TrackingService;

class DefaultController extends AbstractController
{
	public function index(): Responsable
	{
		return $this->inertia('Index');
	}

	public function visit(
		TrackingService $tracking,
		Request $request,
		ShortLink $shortLink
	): RedirectResponse {
		$tracking->logVisit($request, $shortLink);

		return redirect($shortLink->url);
	}
}
