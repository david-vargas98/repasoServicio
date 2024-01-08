<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Chirp;
Route::get('/', function () {
    return view('welcome');
});

//Estas rutas se agregan con el paquete de autenticación breeze
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard'); //Como solo es una vista, se usa el método view
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Se agrega también la rita chirps al group, para usar la utenticación
    Route::get('/chirps', function () {
        return view('chirps.index');
    })->name('chirps.index');

    //Ruta para el método post del formulario
    Route::post('/chirps', function(){
        //Inserción en la BD
        Chirp::create([
            'message' => request('message'), //Mensaje que el usuaeio escribió
            'user_id' => auth()->id(), //Usuario autenticado
        ]);
        //Mensaje de sesión
        
        //Retorno a la ruta
        to_route('chirps.index');
    });
});

require __DIR__.'/auth.php';
