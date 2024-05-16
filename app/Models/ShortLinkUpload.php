<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations;
use App\Events\ShortLinkUploads as Events;

/**
 * @property  int  $id
 * @property  \Illuminate\Support\Carbon  $created_at
 * @property  \Illuminate\Support\Carbon  $updated_at
 * @property  \Illuminate\Support\Carbon  $deleted_at
 * @property  string  $filename
 * @property  string  $path
 * @property  string  $type
 * @property  int  $size
 *
 * @property  \Illuminate\Database\Eloquent\Collection<\App\Models\ShortLinkVisit>  $visits
 */
class ShortLinkUpload extends AbstractModel
{
	use HasFactory;
	use SoftDeletes;

	/**
	 * The event map for the model.
	 *
	 * @var array<string, string>
	 */
	protected $dispatchesEvents = [
		'deleting' => Events\DeletingEvent::class,
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<string>
	 */
	protected $hidden = [
		self::UPDATED_AT,
		'deleted_at',
		'path',
	];

	/**
	 * Set up the shortLinks relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function shortLinks(): Relations\HasMany
	{
		return $this->hasMany(ShortLink::class);
	}
}
