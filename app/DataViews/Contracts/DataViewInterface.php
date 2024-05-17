<?php

namespace App\DataViews\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface DataViewInterface
{
	/**
	 * Set the Model.
	 *
	 * @param  \Illuminate\Database\Eloquent\Model  $model
	 *
	 * @return void
	 */
	public function setModel(Model $model): void;

	/**
	 * Paginate the data.
	 *
	 * @param int $page
	 * @param int $count
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function paginate(int $page, int $count): LengthAwarePaginator;
}
