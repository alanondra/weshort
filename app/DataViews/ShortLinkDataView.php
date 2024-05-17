<?php

namespace App\DataViews;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use App\Models\ShortLink;

#[Attributes\UseModel(ShortLink::class)]
class ShortLinkDataView extends AbstractDataView
{
	/**
	 * Short code query filter.
	 *
	 * @var string|null
	 */
	protected ?string $code;

	/**
	 * URL query filter.
	 *
	 * @var string|null
	 */
	protected ?string $url;

	/**
	 * Filter ShortLinks by short code.
	 *
	 * @param  string|null  $code
	 *
	 * @return static
	 */
	public function whereCode(?string $code): static
	{
		$copy = clone $this;

		$copy->code = (!empty($code) ? $code : null);

		return $copy;
	}

	/**
	 * Filter ShortLinks by URL.
	 *
	 * @param  string|null  $url
	 *
	 * @return static
	 */
	public function whereUrl(?string $url): static
	{
		$copy = clone $this;

		$copy->url = (!empty($url) ? $url : null);

		return $copy;
	}

	/**
	 * Apply conditions to the Query Builder.
	 *
	 * @param  \Illuminate\Contracts\Database\Query\Builder  $query
	 *
	 * @return \Illuminate\Contracts\Database\Query\Builder
	 */
	protected function applyFilters(QueryBuilder $query): QueryBuilder
	{
		return $query
			->when(
				!empty($this->code),
				fn ($q) => $q
					->where(
						'code',
						'LIKE',
						sprintf('%%%s%%', str_escape_sql_like($this->code))
					)
			)
			->when(
				!empty($this->url),
				fn ($q) => $q
					->where(
						'url',
						'LIKE',
						sprintf('%%%s%%', str_escape_sql_like($this->url))
					)
			);
	}
}
