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
Route::get('search/', [AccueilController::class, 'search'])->name('search');
Route::get('services', [AccueilController::class, 'services'])->name('services');
Route::get('annonces', [AccueilController::class, 'annonces'])->name('annonces');
Route::get('detail_service/{slug}', [AccueilController::class, 'detail_service'])->name('detail_service');
Route::get('detail_annonce/{slug}', [AccueilController::class, 'detail_annonce'])->name('detail_annonce');
Route::get('category_service/{category_slug}', [AccueilController::class, 'category_service'])->name('category_service');

Route::get('contact', [AccueilController::class, 'contact'])->name('contact');
Route::post('post_contact_annonce', [AccueilController::class, 'contact_annonce'])->name('contact_annonce');
Route::any('post_contact_service', [AccueilController::class, 'contact_service'])->name('contact_service');

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

    // Disponibilité route
    Route::get('my_disponibilities', [\App\Http\Controllers\Photographe\DisponibilityController::class, 'index'])->name('my_disponibilities');
    Route::get('create_disponibility', [\App\Http\Controllers\Photographe\DisponibilityController::class, 'create'])->name('create_disponibility');
    Route::get('edit_disponibility/{id}', [\App\Http\Controllers\Photographe\DisponibilityController::class, 'edit'])->name('edit_disponibility');
    Route::put('update_disponibility/{id}', [\App\Http\Controllers\Photographe\DisponibilityController::class, 'update'])->name('update_disponibility');
    Route::post('store_disponibility', [\App\Http\Controllers\Photographe\DisponibilityController::class, 'store'])->name('store_disponibility');
    Route::delete('delete_disponibility/{id}', [\App\Http\Controllers\Photographe\DisponibilityController::class, 'delete'])->name('delete_disponibility');

    // agenda route
    Route::get('my_agenda', [\App\Http\Controllers\AgendaController::class, 'index'])->name('my_agenda');
    Route::get('create_agenda', [\App\Http\Controllers\AgendaController::class, 'create'])->name('create_agenda');
    Route::get('edit_agenda/{id}', [\App\Http\Controllers\AgendaController::class, 'edit'])->name('edit_agenda');
    Route::get('confirmer_agenda/{agenda_id}', [\App\Http\Controllers\AgendaController::class, 'confirmer'])->name('confirmer_agenda');
    Route::put('update_agenda/{id}', [\App\Http\Controllers\AgendaController::class, 'update'])->name('update_agenda');
    Route::post('store_agenda/', [\App\Http\Controllers\AgendaController::class, 'store'])->name('store_agenda');
    Route::delete('delete_agenda/{id}', [\App\Http\Controllers\AgendaController::class, 'delete'])->name('delete_agenda');

    /**
     * Client route
     */
    // annonces
    Route::get('my_announces', [\App\Http\Controllers\Client\AnnounceController::class, 'index'])->name('my_announces');
    Route::get('create_annonce', [\App\Http\Controllers\Client\AnnounceController::class, 'create'])->name('create_annonce');
    Route::post('store_annonce', [\App\Http\Controllers\Client\AnnounceController::class, 'store'])->name('store_annonce');
    Route::get('edit_annonce/{id}', [\App\Http\Controllers\Client\AnnounceController::class, 'edit'])->name('edit_annonce');
    Route::put('update_annonce/{id}', [\App\Http\Controllers\Client\AnnounceController::class, 'update'])->name('update_annonce');
    Route::delete('delete_annonce/{id}', [\App\Http\Controllers\Client\AnnounceController::class, 'delete'])->name('delete_annonce');

    // Message routes
    Route::post('reply-message/{id}', 'App\Http\Controllers\MessageController@reply_message')->name('reply_message');
    Route::resource('messages', 'App\Http\Controllers\MessageController');
});
