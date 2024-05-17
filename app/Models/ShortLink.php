<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations;
use App\Events\ShortLinks as Events;

/**
 * @property  int  $id
 * @property  \Illuminate\Support\Carbon  $created_at
 * @property  \Illuminate\Support\Carbon  $updated_at
 * @property  \Illuminate\Support\Carbon  $deleted_at
 * @property-read  int  $deleted_ts
 * @property  string  $code
 * @property  string  $url
 * @property-read  string  $short_url
 *
 * @property  \Illuminate\Database\Eloquent\Collection<\App\Models\ShortLinkVisit>  $visits
 */
class ShortLink extends AbstractModel
{
	use HasFactory;
	use SoftDeletes;

	/**
	 * Shortcode length
	 */
	public const CODE_LENGTH = 11;

	/**
	 * The event map for the model.
	 *
	 * @var array<string, string>
	 */
	protected $dispatchesEvents = [
		'creating' => Events\CreatingEvent::class,
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
		'deleted_ts',
	];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [
		'short_url',
	];

	/**
	 * Set up the short_url attribute.
	 *
	 * @return \Illuminate\Database\Eloquent\Casts\Attribute
	 */
	public function shortUrl(): Attribute
	{
		return Attribute::make(
			get: function () {
				return route('visit', ['shortLink' => $this]);
			}
		);
	}

	/**
	 * Set up the upload relationship.
	 *
	 * @return \Illuminate\Database\EloquentRelations\BelongsTo
	 */
	public function upload(): Relations\BelongsTo
	{
		return $this->belongsTo(ShortLinkUpload::class);
	}

	/**
	 * Set up the visits relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function visits(): Relations\HasMany
	{
		return $this->hasMany(ShortLinkVisit::class, 'short_link_id');
	}
}
