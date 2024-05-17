<?php

namespace App\Services;

use App\DataViews\ShortLinkDataView;
use App\Models\ShortLink;

class ShortLinkService
{
	public function __construct(public readonly ShortLinkDataView $dataView)
	{
		//
	}

	/**
	 * Create an instance of a ShortLink.
	 *
	 * @param  string  $url
	 * @param  bool  $save
	 *
	 * @return \App\Models\ShortLink
	 */
	public function create(string $url, bool $save = true): ShortLink
	{
		$shortLink = new ShortLink();
		$shortLink->url = $url;
		$shortLink->save();

		return $shortLink;
	}

	/**
	 * Generate shortcode for ShortLink.
	 *
	 * @return string
	 */
	public function generateCode(): string
	{
		// generate bytes, compensating for base62 encoding
		$randomBytes = random_bytes(ceil(ShortLink::CODE_LENGTH * (6 / 8)));

		$base62String = base62_encode($randomBytes);

		return substr($base62String, 0, ShortLink::CODE_LENGTH);
	}
}
