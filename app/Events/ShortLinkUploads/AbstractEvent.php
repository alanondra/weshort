<?php

namespace App\Events\ShortLinkUploads;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ShortLinkUpload;

abstract class AbstractEvent
{
	use Dispatchable;
	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @param  \App\Models\ShortLinkUpload  $model
	 */
	public function __construct(protected ShortLinkUpload $model)
	{
		//
	}

	/**
	 * Get the Event Model.
	 *
	 * @return \App\Models\ShortLinkUpload
	 */
	public function getModel(): ShortLinkUpload
	{
		return $this->model;
	}
}
