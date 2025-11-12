<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TeamController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfilController;


// Include authentication routes for API
require __DIR__.'/auth.php';

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes

    // Team routes
Route::get('/teams', [TeamController::class, 'index']);
Route::get('/teams/search', [TeamController::class, 'search']);
    // Driver routes
Route::get('/drivers', [DriverController::class, 'index']);
Route::get('/drivers/search', [DriverController::class, 'search']);
    // Cars routes
Route::get('/cars', [DriverController::class, 'carsIndex']);
Route::get('/cars/search', [DriverController::class, 'carsSearch']);
    // Race routes
Route::get('/races', [DriverController::class, 'racesIndex']);
Route::get('/races/search', [DriverController::class, 'racesSearch']);
    // Laps routes
Route::get('/laps', [DriverController::class, 'lapsIndex']);

// Authenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfilController::class, 'edit']);
    Route::put('/profile', [ProfilController::class, 'update']);
    
    // Admin routes
    Route::post('/admin/teams/create', [ProfilController::class, 'createNewTeam']);
    Route::get('/admin/teams/edit/{id}', [ProfilController::class, 'editTeam']);
    Route::post('/admin/teams/update/{id}', [ProfilController::class, 'updateTeamAsAdmin']);
    Route::post('/admin/teams/simple-update/{id}', [ProfilController::class, 'updateTeamOnly']);
    Route::get('/admin/teams', [ProfilController::class, 'indexTeams']);
    Route::delete('/admin/teams/delete/{id}', [ProfilController::class, 'deleteTeam']);

    // Team routes
    Route::post('/teams/create', [TeamController::class, 'store']);
    Route::post('/teams/update/{id}', [TeamController::class, 'update']);
    Route::delete('/teams/delete/{id}', [TeamController::class, 'destroy']);
    // Driver routes
    Route::get('/admin/drivers', [DriverController::class, 'index']);
    Route::get('/admin/drivers/search', [DriverController::class, 'search']);
    Route::get('/admin/drivers/edit/{id}', [DriverController::class, 'edit']);
    Route::post('/admin/drivers/create', [DriverController::class, 'store']);
    Route::post('/admin/drivers/update/{id}', [DriverController::class, 'update']);
    Route::delete('/admin/drivers/delete/{id}', [DriverController::class, 'destroy']);
    // Cars routes
    Route::post('/cars/create', [DriverController::class, 'carsStore']);
    Route::post('/cars/update/{id}', [DriverController::class, 'carsUpdate']);
    Route::delete('/cars/delete/{id}', [DriverController::class, 'carsDestroy']);
    // Race routes
    Route::post('/races/create', [DriverController::class, 'racesStore']);
    Route::post('/races/update/{id}', [DriverController::class, 'racesUpdate']);
    Route::delete('/races/delete/{id}', [DriverController::class, 'racesDestroy']);
    // Laps routes
    Route::get('/laps/search', [DriverController::class, 'lapsSearch']);
    Route::post('/laps/create', [DriverController::class, 'lapsStore']);
    Route::post('/laps/update/{id}', [DriverController::class, 'lapsUpdate']);
    Route::delete('/laps/delete/{id}', [DriverController::class, 'lapsDestroy']);
    // Ticket routes
    Route::post('/tickets/create', [DriverController::class, 'ticketsStore']);
});