<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Services\ShortLinkService;
use App\Services\ShortLinkUploadService;

class ShortLinkServiceProvider extends ServiceProvider
{
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			ShortLinkUploadService::class,
		];
	}

	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		$this->app->singleton(ShortLinkService::class);
		$this->app->singleton(ShortLinkUploadService::class);

		$this->app->extend(ShortLinkUploadService::class, function (ShortLinkUploadService $uploads, Application $app) {
			$directory = config('shortlinks.uploads.directory');

			$uploads->setDirectory($directory);

			$processors = config('shortlinks.uploads.processors', []);

			foreach ($processors as $processorClass) {
				/**
				 * @var \App\Services\ShortLinkUploads\Contracts\ProcessorInterface
				 */
				$processor = $app->get($processorClass);
				$uploads->addProcessor($processor);
			}

			return $uploads;
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
