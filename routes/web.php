<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\CastIndex;
use App\Http\Livewire\EpisodeIndex;
use App\Http\Livewire\GenreIndex;
use App\Http\Livewire\MovieIndex;
use App\Http\Livewire\SeasonIndex;
use App\Http\Livewire\SerieIndex;
use App\Http\Livewire\TagIndex;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie:slug}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/series', [SerieController::class, 'index'])->name('series.index');
Route::get('/series/{serie:slug}', [SerieController::class, 'show'])->name('series.show');
Route::get('/series/{serie:slug}/seasons/{season:slug}', [SerieController::class, 'seasonShow'])->name('seasons.show');
Route::get('/episodes/{episode:slug}', [SerieController::class, 'showEpisode'])->name('episodes.show');
Route::get('/casts', [CastController::class, 'index'])->name('casts.index');
Route::get('/casts/{cast:slug}', [CastController::class, 'show'])->name('casts.show');
Route::get('/genres/{genre:slug}', [GenreController::class, 'show'])->name('genres.show');

Route::get('/admin', function () {
    return "Admin page";
})->name('admin.index');
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('movies', MovieIndex::class)->name('movies.index');
    Route::get('series', SerieIndex::class)->name('series.index');
    Route::get('series/{serie}/seasons', SeasonIndex::class)->name('seasons.index');
    Route::get('series/{serie}/seasons/{season}/episodes', EpisodeIndex::class)->name('episodes.index');
    Route::get('genres', GenreIndex::class)->name('genres.index');
    Route::get('casts', CastIndex::class)->name('casts.index');
    Route::get('tags', TagIndex::class)->name('tags.index');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // auth()->user()->assignRole('admin');
    return view('admin.index');
})->name('dashboard');
