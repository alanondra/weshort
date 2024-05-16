<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use App\Services\ShortLinkService;
use App\Http\Requests\ShortLinks as Requests;
use App\Models\ShortLink;

class ShortLinkController extends AbstractController
{
	public function __construct(protected ShortLinkService $shortLinks)
	{
		//
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index(Requests\IndexRequest $request): Responsable
	{
		$shortLinks = $this->shortLinks
			->getList(
				page: $request->getPage(),
				count: $request->getCount()
			);

		$data = [
			'shortLinks' => $shortLinks,
		];

		return $this->inertia('ShortLinks/Index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): Responsable
	{
		return $this->inertia('ShortLinks/Create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Requests\StoreRequest $request): RedirectResponse
	{
		$shortLink = $this->shortLinks
			->create($request->getInputUrl());

		return redirect()
			->route(
				route: 'shortLinks.show',
				parameters: [
					'shortLink' => $shortLink
				]
			);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(ShortLink $shortLink): Responsable
	{
		/**
		 * @todo remove in favor of separate AJAX call for front-end
		 */
		$shortLink->loadMissing(['visits']);

		$data = [
			'model' => $shortLink,
		];

		return $this->inertia('ShortLinks/Show', $data);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(ShortLink $shortLink): RedirectResponse
	{
		$shortLink->delete();

		return redirect()->route('shortLinks.index');
	}
}
