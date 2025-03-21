<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [EvenementController::class, 'allevents'])->name('welcome');  // Ou HomeController selon votre structure


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', IsAdmin::class])->prefix('admin')->group(function () {
Route::resource('evenements', EvenementController::class);

Route::get('evenements/{hashedId}', [EvenementController::class, 'show'])->name('evenements.show');

Route::get('evenements/{hashedId}/edit', [EvenementController::class, 'edit'])->name('evenements.edit');

Route::delete('evenements/{hashedId}', [EvenementController::class, 'destroy'])->name('evenements.destroy');
Route::get('/participants', [EvenementController::class, 'showParticipants'])->name('evenements.participants');
Route::get('/utilisateurs', [EvenementController::class, 'indexUtilisateur'])->name('utilisateurs.index');
Route::get('/evenement_actifs', [EvenementController::class, 'evenementActif'])->name('evenements.actifs');
Route::get('/evenement_expire', [EvenementController::class, 'evenementExpire'])->name('evenements.expires');
Route::get('/evenement_supprimer', [EvenementController::class, 'evenementSupprimer'])->name('evenements.supprimes');
});

Route::get('/evenements/{id}/participer', [EvenementController::class, 'showParticipationForm'])->name('evenements.participer');

// Route pour traiter la soumission du formulaire
Route::post('/evenements/{id}/participer', [EvenementController::class, 'participer'])->name('evenements.store-participant');


require __DIR__.'/auth.php';
