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
Route::get('search_annonce/', [AccueilController::class, 'search_annonce'])->name('search_annonce');
Route::get('services', [AccueilController::class, 'services'])->name('services');
Route::get('annonces', [AccueilController::class, 'annonces'])->name('annonces');
Route::get('detail_service/{slug}', [AccueilController::class, 'detail_service'])->name('detail_service');
Route::get('detail_annonce/{slug}', [AccueilController::class, 'detail_annonce'])->name('detail_annonce');
Route::get('category_service/{category_slug}', [AccueilController::class, 'category_service'])->name('category_service');
Route::get('category_annonce/{category_slug}', [AccueilController::class, 'category_annonce'])->name('category_annonce');

Route::post('fullcalenderAjax', [AccueilController::class, 'ajax'])->name('full_calendar');
Route::post('schedule/appointment', [AccueilController::class, 'index'])->name('available.schedule');
Route::post('store/rdv', [AccueilController::class, 'store_rdv'])->name('store_rdv');

Route::get('contact', [AccueilController::class, 'contact'])->name('contact');
Route::post('post_contact_annonce', [AccueilController::class, 'contact_annonce'])->name('contact_annonce')->middleware('auth');;
Route::post('post_contact_service', [AccueilController::class, 'contact_service'])->name('contact_service')->middleware('auth');;

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

    // Travail routes
    Route::get('travails', [\App\Http\Controllers\Photographe\TravailController::class, 'index'])->name('list_travails');
    Route::get('create-travail', [\App\Http\Controllers\Photographe\TravailController::class, 'create'])->name('create_travail');
    Route::post('post-create-travail', [\App\Http\Controllers\Photographe\TravailController::class, 'store'])->name('post_create_travail');
    Route::get('edit-travail/{id}', [\App\Http\Controllers\Photographe\TravailController::class, 'edit'])->name('edit_travail');
    Route::put('update_edit-travail/{id}', [\App\Http\Controllers\Photographe\TravailController::class, 'update'])->name('update_edit_travail');
    Route::delete('delete-travail/{id}', [\App\Http\Controllers\Photographe\TravailController::class, 'destroy'])->name('delete_travail');
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

    Route::get('archive/{id}', [\App\Http\Controllers\DashboardController::class, 'archive'])->name('archive');
});
