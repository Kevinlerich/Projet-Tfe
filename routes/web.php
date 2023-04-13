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
    // service routes
    Route::get('list_services', [ServiceController::class, 'index'])->name('list_service');
    Route::get('create_service', [ServiceController::class, 'create'])->name('create_service');
    Route::post('store_service', [ServiceController::class, 'store'])->name('store_service');
    Route::get('edit_service/{id}', [ServiceController::class, 'edit'])->name('edit_service');
    Route::put('update_service/{id}', [ServiceController::class, 'update'])->name('update_service');
    Route::delete('delete_service/{id}', [ServiceController::class, 'delete'])->name('delete_service');

    // portfolio routes
    Route::get('list_portfolio', [\App\Http\Controllers\Photographe\PortfolioController::class, 'index'])->name('list_portfolio');
    Route::get('create_portfolio', [\App\Http\Controllers\Photographe\PortfolioController::class, 'create'])->name('create_portfolio');
    Route::post('store_portfolio', [\App\Http\Controllers\Photographe\PortfolioController::class, 'store'])->name('store_portfolio');
    Route::get('edit_portfolio/{id}', [\App\Http\Controllers\Photographe\PortfolioController::class, 'edit'])->name('edit_portfolio');
    Route::put('update_portfolio/{id}', [\App\Http\Controllers\Photographe\PortfolioController::class, 'update'])->name('update_portfolio');
    Route::delete('delete_portfolio/{id}', [\App\Http\Controllers\Photographe\PortfolioController::class, 'delete'])->name('delete_portfolio');

    /**
     * Client route
     */
    // annonces
    Route::get('my_announces', [\App\Http\Controllers\Client\AnnounceController::class, 'index'])->name('my_announces');
    Route::get('create_annonces', [\App\Http\Controllers\Client\AnnounceController::class, 'create'])->name('create_annonces');
});
