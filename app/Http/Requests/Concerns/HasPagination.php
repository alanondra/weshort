<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Foundation\Http\FormRequest;

trait HasPagination
{
	/**
	 * Get the requested page number.
	 *
	 * @return int
	 */
	public function getPage(): int
	{
		if ($this instanceof FormRequest) {
			return (int) $this->input('page', 1);
		}

		return 1;
	}

	/**
	 * Get the requested number of items per page.
	 *
	 * @param  int  $default
	 *
	 * @return int
	 */
	public function getCount(int $default = 10): int
	{
		if ($this instanceof FormRequest) {
			return (int) $this->input('count', $default);
		}

		return $default;
	}

	/**
	 * Get the list of rules for pagination.
	 *
	 * @return array
	 */
	protected function getPaginationRules(): array
	{
		return [
			'page' => ['nullable', 'int', 'min:1'],
			'count' => ['nullable', 'int', 'min:1', 'max:100'],
		];
	}
}
