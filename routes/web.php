<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\Photographe\ServiceController;

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
Route::get('detail_annonce/{slug}', [AccueilController::class, 'detail_annonce'])->name('detail_annonce');

Route::get('contact', [AccueilController::class, 'contact'])->name('contact');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');

    /**
     * Photographe Routes
     */
    Route::get('list_services', [ServiceController::class, 'index'])->name('list_service');
    Route::get('create_service', [ServiceController::class, 'create'])->name('create_service');
    Route::get('edit_service/{id}', [ServiceController::class, 'edit'])->name('edit_service');
    Route::delete('delete_service/{id}', [ServiceController::class, 'delete'])->name('delete_service');
});
