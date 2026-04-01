<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FactureController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', function () {
    return redirect()->route('login');
});

// ===== AUTHENTIFICATION =====
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginPost');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('registerPost');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===== GESTIONNAIRE =====
Route::middleware('gestionnaire')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Burgers
    Route::get('/burgers', [BurgerController::class, 'index'])->name('burgers');
    Route::get('/addBurger', [BurgerController::class, 'create'])->name('addBurger');
    Route::post('/storeBurger', [BurgerController::class, 'store'])->name('storeBurger');
    Route::get('/editBurger/{id}', [BurgerController::class, 'edit'])->name('editBurger');
    Route::put('/updateBurger/{id}', [BurgerController::class, 'update'])->name('updateBurger');
    Route::get('/archiverBurger/{id}', [BurgerController::class, 'archiver'])->name('archiverBurger');
    Route::delete('/deleteBurger/{id}', [BurgerController::class, 'destroy'])->name('deleteBurger');

    // Commandes (gestionnaire)
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes');
    Route::get('/commandes/{id}', [CommandeController::class, 'show'])->name('showCommande');
    Route::get('/annulerCommande/{id}', [CommandeController::class, 'annuler'])->name('annulerCommande');
    Route::post('/updateStatutCommande/{id}', [CommandeController::class, 'updateStatut'])->name('updateStatutCommande');
    Route::get('/payerCommande/{id}', [CommandeController::class, 'payer'])->name('payerCommande');

    // Facture gestionnaire
    Route::get('/facture/{id}', [FactureController::class, 'telecharger'])->name('telechargerFacture');
});

// ===== CLIENT =====
Route::middleware('client')->group(function () {

    // Catalogue
    Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue');
    Route::get('/catalogue/{id}', [CatalogueController::class, 'show'])->name('showBurger');

    // Commandes client
    Route::get('/mes-commandes', [CommandeController::class, 'mesCommandes'])->name('mesCommandes');
    Route::get('/commander', [CommandeController::class, 'create'])->name('commander');
    Route::post('/storeCommande', [CommandeController::class, 'store'])->name('storeCommande');

    // Facture client
    Route::get('/ma-facture/{id}', [FactureController::class, 'telecharger'])->name('maFacture');
});
