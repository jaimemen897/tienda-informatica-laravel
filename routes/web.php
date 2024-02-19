<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('client.index');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'client'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('client.index')->middleware(['auth', 'admin']);

    Route::get('/create', [ClientController::class, 'store'])->name('client.store')->middleware(['auth', 'admin']);
    Route::post('/create', [ClientController::class, 'create'])->name('client.create')->middleware(['auth', 'admin']);

    Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('client.edit')->middleware(['auth', 'admin']);
    Route::put('/update/{id}', [ClientController::class, 'update'])->name('client.update')->middleware(['auth', 'admin']);

    Route::get('/editImage/{id}', [ClientController::class, 'editImage'])->name('client.editImage')->middleware(['auth', 'admin']);
    Route::patch('/updateImage/{id}', [ClientController::class, 'updateImage'])->name('client.updateImage')->middleware(['auth', 'admin']);

    Route::delete('/destroy/{id}', [ClientController::class, 'destroy'])->name('client.destroy')->middleware(['auth', 'admin']);

    Route::get('/{id}', [ClientController::class, 'show'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('client.show')->middleware(['auth', 'admin']);
});

Route::group(['prefix' => 'employee'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employee.index')->middleware(['auth', 'admin']);

    Route::get('/create', [EmployeeController::class, 'store'])->name('employee.store')->middleware(['auth', 'admin']);
    Route::post('/create', [EmployeeController::class, 'create'])->name('employee.create')->middleware(['auth', 'admin']);

    Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware(['auth', 'admin']);
    Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update')->middleware(['auth', 'admin']);

    Route::get('/editImage/{id}', [EmployeeController::class, 'editImage'])->name('employee.editImage')->middleware(['auth', 'admin']);
    Route::patch('/updateImage/{id}', [EmployeeController::class, 'updateImage'])->name('employee.updateImage')->middleware(['auth', 'admin']);

    Route::delete('/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy')->middleware(['auth', 'admin']);

    Route::get('/{id}', [EmployeeController::class, 'show'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('employee.show')->middleware(['auth', 'admin']);
});

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
