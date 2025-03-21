<?php

use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [EvenementController::class, 'allevents']);  // Ou HomeController selon votre structure


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('evenements', EvenementController::class);
Route::get('/{id}/participants', [EvenementController::class, 'showParticipants'])->name('evenements.participants');
Route::get('/utilisateurs', [EvenementController::class, 'indexUtilisateur'])->name('utilisateurs.index');
Route::get('/evenement_actifs', [EvenementController::class, 'evenementActif'])->name('evenements.actifs');
Route::get('/evenement_expire', [EvenementController::class, 'evenementExpire'])->name('evenements.expires');
Route::get('/evenement_supprimer', [EvenementController::class, 'evenementSupprimer'])->name('evenements.supprimes');


Route::get('/evenements/{evenementId}/participer', [EvenementController::class, 'participer'])->name('evenements.participer');

require __DIR__.'/auth.php';
