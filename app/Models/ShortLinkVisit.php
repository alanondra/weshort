<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations;

/**
 * @property  int  $id
 * @property  \Illuminate\Support\Carbon  $created_at
 * @property  \Illuminate\Support\Carbon  $updated_at
 * @property  \Illuminate\Support\Carbon  $deleted_at
 * @property  int  $short_link_id
 * @property  string  $ip_address
 * @property  string|null  $user_agent
 * @property  string|null  $browser
 * @property  string|null  $browser_version
 * @property  boolean  $is_mobile
 * @property  boolean  $is_tablet
 * @property  string|null  $device_type
 * @property  string|null  $device_maker
 * @property  string|null  $device_name
 * @property  string|null  $platform
 * @property  string|null  $platform_version
 *
 * @property  \App\Models\ShortLink  $shortLink
 */
class ShortLinkVisit extends AbstractModel
{
	use HasFactory;
	use SoftDeletes;

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'is_mobile' => 'boolean',
		'is_tablet' => 'boolean',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<string>
	 */
	protected $hidden = [
		self::UPDATED_AT,
		'deleted_at',
	];

	/**
	 * Set up the shortLink relationship.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function shortLink(): Relations\BelongsTo
	{
		return $this->belongsTo(ShortLink::class);
	}
}
