<?php

namespace App\Listeners\ShortLinkUploads;

use App\Events\ShortLinkUploads\DeletingEvent;

/**
 * Delete ShortLinks associated with the given ShortLinkUpload.
 */
class DeleteShortLinks
{
	/**
	 * Handle the DeletingEvent.
	 *
	 * @param \App\Events\ShortLinkUploads\DeletingEvent $event
	 *
	 * @return void
	 */
	public function handle(DeletingEvent $event)
	{
		$model = $event->getModel();
		$model->shortLinks()->delete();
	}
}
