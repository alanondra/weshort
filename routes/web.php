<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', [Controllers\DefaultController::class, 'index'])->name('home');
Route::get('/l/{shortLink:code}', [Controllers\DefaultController::class, 'visit'])->name('visit');
Route::resource('shortLinks', Controllers\ShortLinkController::class)->only(['index', 'store', 'show', 'destroy']);
