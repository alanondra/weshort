<?php

namespace App\Listeners\ShortLinks;

use App\Events\ShortLinks\DeletingEvent;

/**
 * Delete ShortLinks associated with the given ShortLinkUpload.
 */
class DeleteVisits
{
	/**
	 * Handle the DeletingEvent.
	 *
	 * @param \App\Events\ShortLinks\DeletingEvent $event
	 *
	 * @return void
	 */
	public function handle(DeletingEvent $event)
	{
		$model = $event->getModel();
		$model->visits()->delete();
	}
}
