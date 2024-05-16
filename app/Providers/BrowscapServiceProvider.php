<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use BrowscapPHP\Browscap;
use BrowscapPHP\BrowscapInterface;
use BrowscapPHP\BrowscapUpdater;
use BrowscapPHP\BrowscapUpdaterInterface;

class BrowscapServiceProvider extends ServiceProvider
{
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			Browscap::class,
			BrowscapInterface::class,
			BrowscapUpdater::class,
			BrowscapUpdaterInterface::class,
		];
	}

	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		$this->app->singleton(BrowscapUpdaterInterface::class, BrowscapUpdater::class);
		$this->app->singleton(BrowscapInterface::class, Browscap::class);

		$this->app->extend(BrowscapInterface::class, function (BrowscapInterface $browscap, Application $app) {
			/**
			 * @var \BrowscapPHP\BrowscapUpdaterInterface
			 */
			$updater = $app->get(BrowscapUpdaterInterface::class);
			$updater->update();

			return $browscap;
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
