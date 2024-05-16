<?php

use App\Events;
use App\Listeners;

return [
	/**
	 * Map of Events to Listeners.
	 */
	'listeners' => [
		Events\FileUploads\DeletingEvent::class => [
			Listeners\FileUploads\DeleteShortLinks::class,
		],
		Events\ShortLinks\CreatingEvent::class => [
			Listeners\ShortLinks\FillCode::class,
		],
		Events\ShortLinks\DeletingEvent::class => [
			Listeners\ShortLinks\DeleteVisits::class,
		],
	],
];
