<?php

namespace App\Providers;

use ReflectionClass;
use LogicException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\DataViews\Contracts\DataViewInterface;
use App\DataViews\Attributes\UseModel;

/**
 * Sets up DataViews so that they can be resolved through dependency injection
 * and so that the Models used as the basis for their queries are resolved at
 * the Container level based on annotation.
 */
class DataViewServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		$this->app->resolving(DataViewInterface::class, function (DataViewInterface $dataView, Application $app) {
			$reflection = new ReflectionClass($dataView);
			$attributes = $reflection->getAttributes(UseModel::class);

			if (count($attributes) === 0) {
				throw new LogicException(sprintf(
					'Class %s requires annotation of %s.',
					get_class($dataView),
					UseModel::class
				));
			}

			$modelClass = $attributes[0]->newInstance()->modelClass;

			/**
			 * @var \Illuminate\Database\Eloquent\Model
			 */
			$modelInstance = $app->make($modelClass);

			$dataView->setModel($modelInstance);

			return $dataView;
		});
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		//
	}
}
