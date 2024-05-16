<?php

namespace App\Events\ShortLinks;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ShortLink;

abstract class AbstractEvent
{
	use Dispatchable;
	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @param  \App\Models\ShortLink  $model
	 */
	public function __construct(protected ShortLink $model)
	{
		//
	}

	/**
	 * Get the Event Model.
	 *
	 * @return \App\Models\ShortLink
	 */
	public function getModel(): ShortLink
	{
		return $this->model;
	}
}
