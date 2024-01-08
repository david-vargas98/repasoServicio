<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Estas rutas se agregan con el paquete de autenticación breeze
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard'); //Como solo es una vista, se usa el método view
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Se agrega también la rita chirps al group, para usar la utenticación
    Route::get('/chirps', function () {
        return 'ejemplo';
    })->name('chirps.index');
});

require __DIR__.'/auth.php';
