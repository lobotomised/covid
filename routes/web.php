<?php

use App\Http\Controllers\GraphController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{country}', [GraphController::class, 'index'])->name('country');
