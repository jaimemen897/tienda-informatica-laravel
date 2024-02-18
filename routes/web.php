<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('client.index');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'client'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('client.index');

    Route::get('/create', [ClientController::class, 'store'])->name('client.store');
    Route::post('/create', [ClientController::class, 'create'])->name('client.create');

    Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/update/{id}', [ClientController::class, 'update'])->name('client.update');

    Route::get('/editImage/{id}', [ClientController::class, 'editImage'])->name('client.editImage');
    Route::patch('/updateImage/{id}', [ClientController::class, 'updateImage'])->name('client.updateImage');

    Route::delete('/destroy/{id}', [ClientController::class, 'destroy'])->name('client.destroy');

    Route::get('/{id}', [ClientController::class, 'show'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('client.show');
});



