<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return Inertia::render('HomeView');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile', function () {
    return Inertia::render('ProfileView');
})->middleware(['auth', 'verified'])->name('profile');

Route::get('/tables', function () {
    return Inertia::render('TablesView');
})->middleware(['auth', 'verified'])->name('tables');

Route::get('/ui', function () {
    return Inertia::render('UiView');
})->middleware(['auth', 'verified'])->name('ui');

Route::get('/responsive', function () {
    return Inertia::render('ResponsiveView');
})->middleware(['auth', 'verified'])->name('responsive');

Route::get('/styles', function () {
    return Inertia::render('StyleView');
})->middleware(['auth', 'verified'])->name('styles');

Route::get('/forms', function () {
    return Inertia::render('FormsView');
})->middleware(['auth', 'verified'])->name('forms');

//Route::get('/login', function () {
//    return Inertia::render('LoginView');
//})->middleware(['auth', 'verified'])->name('login');

Route::get('/error', function () {
    return Inertia::render('ErrorView');
})->middleware(['auth', 'verified'])->name('error');

require __DIR__ . '/auth.php';