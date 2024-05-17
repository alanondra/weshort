<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::name('api.')->group(function () {
	Route::prefix('uploads/{upload}')->name('uploads.')->group(function () {
		Route::get('shortLinks', [Controllers\ShortLinkUploadsController::class, 'shortLinks'])
			->name('shortLinks.index');
	});
	Route::prefix('shortLinks/{shortLink}')->name('shortlinks.')->group(function () {
		Route::get('visits', [Controllers\ShortLinkVisitsController::class, 'index'])
			->name('visits.index');
	});
});
