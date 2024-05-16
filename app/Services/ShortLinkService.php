<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\ShortLink;

class ShortLinkService
{
	/**
	 * Get the list of ShortLinks.
	 *
	 * @param  int  $page
	 * @param  int  $count
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator<\App\Models\ShortLink>
	 */
	public function getList(
		int $page = 1,
		int $count = 10
	): LengthAwarePaginator {
		$query = ShortLink::query();

		return $query->paginate(
			page: max(1, $page),
			perPage: max(1, $count)
		);
	}

	/**
	 * Create an instance of a ShortLink.
	 *
	 * @param  string  $url
	 *
	 * @return \App\Models\ShortLink
	 */
	public function create(string $url): ShortLink
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
