<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('change-locale/{locale}', function ($locale) {

    App::setLocale($locale);
    Session::put('locale', $locale);

    return redirect()->back();
})->name('locale.switch');

Route::get('/cms/page/{slug}', function ($slug) {
    // Your route handling logic here
    // This might involve rendering a view or returning data related to the "slug"
})->name('filament-cms.web.page'); // This names the route according to your requirement