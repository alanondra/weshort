<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use App\Services\ShortLinkService;
use App\Http\Requests\ShortLinks as Requests;
use App\Models\ShortLink;
use App\Models\ShortLinkVisit;

class ShortLinkVisitsController extends AbstractController
{
	public function __construct(protected ShortLinkService $shortLinks)
	{
		//
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index(Requests\IndexRequest $request)
	{
		$query = ShortLinkVisit::query();

		$visits = $query->paginate(
			page: $request->getPage(),
			perPage: $request->getCount()
		);

		return $visits;
	}
}
