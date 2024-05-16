<?php

namespace App\Services;

use Throwable;
use Psr\Log\LoggerInterface;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use BrowscapPHP\BrowscapInterface;
use App\Models\ShortLink;
use App\Models\ShortLinkVisit;

class TrackingService
{
	public function __construct(
		protected LoggerInterface $logger,
		protected BrowscapInterface $browscap
	) {
		//
	}

	/**
	 * Log a visit to the given ShortLink.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\ShortLink  $shortLink
	 *
	 * @return \App\Models\ShortLinkVisit
	 */
	public function logVisit(Request $request, ShortLink $shortLink): ShortLinkVisit
	{
		$visit = new ShortLinkVisit();

		$visit->shortLink()->associate($shortLink);

		$visit->ip_address = Arr::first($request->ips());
		$visit->user_agent = $request->userAgent();

		$this->parseUserAgent($visit);

		$visit->save();

		return $visit;
	}

	/**
	 * Attempt to parse the User-Agent string and update the
	 * ShortLinkVisit with the results.
	 *
	 * @param  \App\Models\ShortLinkVisit  $visit
	 *
	 * @return void
	 */
	protected function parseUserAgent(ShortLinkVisit $visit): void
	{
		if (empty($visit->user_agent)) {
			return;
		}

		try {
			$browserData = $this->browscap->getBrowser($visit->user_agent);

			$visit->browser = $browserData->browser ?? null;
			$visit->browser_version = $browserData->version ?? null;
			$visit->is_mobile = $browserData->ismobiledevice ?? false;
			$visit->is_tablet = $browserData->istablet ?? false;
			$visit->device_type = $browserData->device_type ?? null;
			$visit->device_maker = $browserData->device_maker ?? null;
			$visit->device_name = $browserData->device_name ?? null;
			$visit->platform = $browserData->platform ?? null;
			$visit->platform_version = $browserData->platform_version ?? null;
		} catch (Throwable $e) {
			$context = [
				'shortLink' => $visit->shortLink->code,
				'exception' => $e,
			];

			$this->logger->warning(
				sprintf('%s failed parsing User-Agent string.', class_basename(static::class)),
				$context
			);
		}
	}
}
