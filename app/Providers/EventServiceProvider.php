<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		$eventListeners = config('events.listeners', []);

		foreach ($eventListeners as $event => $listeners) {
			foreach ($listeners as $listener) {
				Event::listen($event, $listener);
			}
		}
	}
}
