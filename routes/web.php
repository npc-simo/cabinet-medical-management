<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\SecretaireController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\DossierMedicalController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\FactureController;


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register');


/*
|--------------------------------------------------------------------------
| ACCUEIL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| ROUTES PROTÉGÉES (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARDS
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard/patient', [PatientController::class, 'dashboard'])
        ->name('patient.dashboard');

    Route::get('/dashboard/medecin', [MedecinController::class, 'dashboard'])
        ->name('medecin.dashboard');

    Route::get('/dashboard/secretaire', [SecretaireController::class, 'dashboard'])
        ->name('secretaire.dashboard');


    /*
    |--------------------------------------------------------------------------
    | PATIENT – RENDEZ-VOUS
    |--------------------------------------------------------------------------
    */
    Route::get('/patient/rendezvous', [RendezvousController::class, 'index'])
        ->name('patient.rendezvous.index');

    Route::get('/patient/rendezvous/create', [RendezvousController::class, 'create'])
        ->name('rendezvous.create');

    Route::post('/patient/rendezvous', [RendezvousController::class, 'store'])
        ->name('rendezvous.store');

    Route::get('/patient/rendezvous/{id}', [RendezvousController::class, 'show'])
        ->name('rendezvous.show');

    Route::patch('/patient/rendezvous/{id}/annuler', [RendezvousController::class, 'annuler'])
        ->name('rendezvous.cancel');


    /*
    |--------------------------------------------------------------------------
    | PATIENT – DOSSIER MÉDICAL
    |--------------------------------------------------------------------------
    */
    Route::get('/patient/dossier', [DossierMedicalController::class, 'index'])
        ->name('patient.dossier');

    Route::get('/patient/dossier/download/{id}', [DossierMedicalController::class, 'download'])
        ->name('dossier.download');


    /*
    |--------------------------------------------------------------------------
    | PATIENT – ORDONNANCES
    |--------------------------------------------------------------------------
    */
    Route::get('/patient/ordonnances', [OrdonnanceController::class, 'index'])
        ->name('patient.ordonnances');

    Route::get('/patient/ordonnances/download/{id}', [OrdonnanceController::class, 'download'])
        ->name('patient.ordonnances.download');


    /*
    |--------------------------------------------------------------------------
    | PATIENT – FACTURES
    |--------------------------------------------------------------------------
    */
    Route::get('/patient/factures', [FactureController::class, 'index'])
        ->name('patient.factures');

    Route::get('/patient/factures/download/{id}', [FactureController::class, 'download'])
        ->name('patient.factures.download');

});
