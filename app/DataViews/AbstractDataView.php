<?php

namespace App\DataViews;

use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use App\DataViews\Contracts\DataViewInterface;

abstract class AbstractDataView implements DataViewInterface
{
	/**
	 * Model instance.
	 *
	 * @var \Illuminate\Database\Eloquent\Model
	 */
	protected readonly Model $model;

	/**
	 * Relations to load.
	 *
	 * @var array
	 */
	protected array $relations = [];

	/**
	 * Columns for the paginator.
	 *
	 * @var array
	 */
	protected array $columns = ['*'];

	/**
	 * Name of the individual pages.
	 *
	 * @var string
	 */
	protected string $pageName = 'page';

	/**
	 * Set the Model.
	 *
	 * @param  \Illuminate\Database\Eloquent\Model  $model
	 *
	 * @return void
	 */
	public function setModel(Model $model): void
	{
		$this->model = $model;
	}

	/**
	 * Get the base Eloquent Query Builder.
	 *
	 * @return \Illuminate\Contracts\Database\Eloquent\Builder
	 */
	protected function getBaseQuery(): EloquentBuilder
	{
		$model = clone $this->model;

		if (!empty($this->relations)) {
			$model->loadMissing($this->relations);
		}

		return $model->query();
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
		return $query;
	}

	/**
	 * Get the Query Builder.
	 *
	 * @return \Illuminate\Contracts\Database\Query\Builder
	 */
	public function getQuery(): QueryBuilder
	{
		$query = $this->getBaseQuery();
		$query = $this->applyFilters($query);

		return $query;
	}

	/**
	 * Paginate the data.
	 *
	 * @param int $page
	 * @param int $count
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function paginate(int $page, int $count): LengthAwarePaginator
	{
		$query = $this->getQuery();

		return $query->paginate(
			perPage: $count,
			columns: ['*'],
			pageName: 'page',
			page: $page
		);
	}
}
