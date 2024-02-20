<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\SupplierController;

use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('product.index');
});

Auth::routes();
Route::get('/login/employee', [App\Http\Controllers\Auth\EmployeeLoginController::class, 'showLoginForm'])->name('login.employee');
Route::post('/login/employee', [App\Http\Controllers\Auth\EmployeeLoginController::class, 'login'])->name('login.employee.submit');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showClientLoginForm'])->name('login.client');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.client.submit');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'client'], function () {
    Route::get('/', [ClientController::class, 'index'])->name('client.index')->middleware(['auth:employee', 'admin']);

    Route::get('/create', [ClientController::class, 'store'])->name('client.store')->middleware(['auth:employee', 'admin']);
    Route::post('/create', [ClientController::class, 'create'])->name('client.create')->middleware(['auth:employee', 'admin']);

    Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('client.edit')->middleware(['auth:employee', 'admin']);
    Route::put('/update/{id}', [ClientController::class, 'update'])->name('client.update')->middleware(['auth:employee', 'admin']);

    Route::get('/editImage/{id}', [ClientController::class, 'editImage'])->name('client.editImage')->middleware(['auth:employee', 'admin']);
    Route::patch('/updateImage/{id}', [ClientController::class, 'updateImage'])->name('client.updateImage')->middleware(['auth:employee', 'admin']);

    Route::delete('/destroy/{id}', [ClientController::class, 'destroy'])->name('client.destroy')->middleware(['auth:employee', 'admin']);

    Route::get('/{id}', [ClientController::class, 'show'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('client.show')->middleware(['auth:employee', 'admin']);
});

Route::group(['prefix' => 'employee'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employee.index')->middleware(['auth:employee', 'admin']);

    Route::get('/create', [EmployeeController::class, 'store'])->name('employee.store')->middleware(['auth:employee', 'admin']);
    Route::post('/create', [EmployeeController::class, 'create'])->name('employee.create')->middleware(['auth:employee', 'admin']);

    Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware(['auth:employee', 'admin']);
    Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update')->middleware(['auth:employee', 'admin']);

    Route::get('/editImage/{id}', [EmployeeController::class, 'editImage'])->name('employee.editImage')->middleware(['auth:employee', 'admin']);
    Route::patch('/updateImage/{id}', [EmployeeController::class, 'updateImage'])->name('employee.updateImage')->middleware(['auth:employee', 'admin']);

    Route::delete('/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy')->middleware(['auth:employee', 'admin']);

    Route::get('/{id}', [EmployeeController::class, 'show'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('employee.show')->middleware(['auth:employee', 'admin']);
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');

    Route::get('/create', [ProductController::class, 'create'])->name('product.store')->middleware(['auth:employee', 'admin']);
    Route::post('/create', [ProductController::class, 'store'])->name('product.create')->middleware(['auth:employee', 'admin']);

    Route::get('/edit/{id}', [ProductController::class, 'edit'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('product.edit')->middleware(['auth:employee', 'admin']);
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update')->middleware(['auth:employee', 'admin']);

    Route::get('/editImage/{id}', [ProductController::class, 'editImage'])->name('product.editImage')->middleware(['auth:employee', 'admin']);
    Route::patch('/updateImage/{id}', [ProductController::class, 'updateImage'])->name('product.updateImage')->middleware(['auth:employee', 'admin']);

    Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware(['auth:employee', 'admin']);

    Route::get('/{id}', [ProductController::class, 'show'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('product.show');
});


Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index')->middleware('auth:employee');

Route::group(['prefix' => 'supplier'], function () {

    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index')->middleware(['auth:employee', 'admin']);

    Route::get('/create', [SupplierController::class, 'store'])->name('supplier.store')->middleware(['auth:employee', 'admin']);
    Route::post('/create', [SupplierController::class, 'create'])->name('supplier.create')->middleware(['auth:employee', 'admin']);

    Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit')->middleware(['auth:employee', 'admin']);
    Route::put('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update')->middleware(['auth:employee', 'admin']);

    Route::delete('/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy')->middleware(['auth:employee', 'admin']);

    Route::get('/{id}', [SupplierController::class, 'show'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('supplier.show')->middleware(['auth:employee', 'admin']);
});
