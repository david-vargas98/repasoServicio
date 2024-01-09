<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Estas rutas se agregan con el paquete de autenticación breeze
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard'); //Como solo es una vista, se usa el método view
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Se agrega también la ruta chirps al group, para usar la utenticación
    Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');

    //Ruta para el método post del formulario
    Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');
});

require __DIR__.'/auth.php';
