<?php

namespace App\Listeners\ShortLinks;

use App\Events\ShortLinks\CreatingEvent;
use App\Services\ShortLinkService;

/**
 * Generate shortcodes for the ShortLink code.
 */
class FillCode
{
	public function __construct(protected ShortLinkService $shortLinks)
	{
		//
	}

	/**
	 * Handle the CreatingEvent.
	 *
	 * @param \App\Events\ShortLink\CreatingEvent $event
	 *
	 * @return void
	 */
	public function handle(CreatingEvent $event)
	{
		$model = $event->getModel();

		if (empty($model->code)) {
			$model->code = $this->shortLinks->generateCode();
		}
	}
}
