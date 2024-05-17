<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use App\Services\ShortLinkUploadService;
use App\Http\Requests\ShortLinkUploads as Requests;
use App\Models\ShortLinkUpload;

class ShortLinkUploadsController extends AbstractController
{
	public function __construct(protected ShortLinkUploadService $uploads)
	{
		//
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index(Requests\IndexRequest $request): Responsable
	{
		$shortLinkUploads = $this->uploads
			->getList(
				page: $request->getPage(),
				count: $request->getCount()
			);

		$data = [
			'uploads' => $shortLinkUploads,
		];

		return $this->inertia('ShortLinkUploads/Index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): Responsable
	{
		return $this->inertia('ShortLinkUploads/Create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Requests\StoreRequest $request): RedirectResponse
	{
		$upload = $this->uploads
			->process($request->getUploadFile());

		return redirect()
			->route(
				route: 'uploads.show',
				parameters: [
					'upload' => $upload
				]
			);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(ShortLinkUpload $upload): Responsable
	{
		$upload->loadMissing(['shortLinks']);

		$data = [
			'model' => $upload,
		];

		return $this->inertia('ShortLinkUploads/Show', $data);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(ShortLinkUpload $upload): RedirectResponse
	{
		$upload->delete();

		return redirect()->route('shortLinkUploads.index');
	}

	public function shortLinks(Requests\ShortLinksRequest $request, ShortLinkUpload $upload)
	{
		return $upload
			->shortLinks()
			->paginate(
				page: $request->getPage(),
				perPage: $request->getCount()
			);
	}
}
