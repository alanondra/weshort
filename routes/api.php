<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::name('api.')->group(function () {
	Route::prefix('shortLinks/{shortLink}')->name('shortlinks.')->group(function () {
		Route::get('visits', [Controllers\ShortLinkVisitsController::class, 'index'])
			->name('visits.index');
	});
});
