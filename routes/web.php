<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;

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

Route::get('/', [AccueilController::class, 'accueil'])->name('accueil');
Route::get('services', [AccueilController::class, 'services'])->name('services');
Route::get('service/{id}', [AccueilController::class, 'detail_service'])->name('detail_service');

Route::get('contact', [AccueilController::class, 'contact'])->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
