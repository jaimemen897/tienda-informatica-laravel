<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\SupplierController;

use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

Route::get('/email', [EmailController::class, 'sendWelcomeEmail']);

Route::get('/', function () {
    return redirect()->route('product.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/login/employee', [App\Http\Controllers\Auth\EmployeeLoginController::class, 'showLoginForm'])->name('login.employee');
Route::post('/login/employee', [App\Http\Controllers\Auth\EmployeeLoginController::class, 'login'])->name('login.employee.submit');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showClientLoginForm'])->name('login.client');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.client.submit');

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

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index')->middleware(['auth:employee', 'admin']);
    Route::get('/create', [CategoryController::class, 'create'])->name('category.store')->middleware(['auth:employee', 'admin']);
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware(['auth:employee', 'admin']);
    Route::get('/{id}', [CategoryController::class, 'show'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('category.show')->middleware(['auth:employee', 'admin']);
    Route::get('/deactivate/{id}', [CategoryController::class, 'deactivate'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('category.deactivate')->middleware(['auth:employee', 'admin']);
    Route::get('/activate/{id}', [CategoryController::class, 'activate'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('category.activate')->middleware(['auth:employee', 'admin']);
    Route::post('/create', [CategoryController::class, 'store'])->name('category.create')->middleware(['auth:employee', 'admin']);
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware(['auth:employee', 'admin']);
    Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware(['auth:employee', 'admin']);
});



Route::group(['prefix' => 'supplier'], function () {

    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index')->middleware(['auth:employee', 'admin']);

    Route::get('/create', [SupplierController::class, 'store'])->name('supplier.store')->middleware(['auth:employee', 'admin']);
    Route::post('/create', [SupplierController::class, 'create'])->name('supplier.create')->middleware(['auth:employee', 'admin']);

    Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit')->middleware(['auth:employee', 'admin']);
    Route::put('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update')->middleware(['auth:employee', 'admin']);

    Route::delete('/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy')->middleware(['auth:employee', 'admin']);

    Route::get('/{id}', [SupplierController::class, 'show'])->where('id', '^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$')->name('supplier.show')->middleware(['auth:employee', 'admin']);
});

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index')->middleware('auth:web,employee');

Route::group(['prefix' => 'cart'], function () {
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add')->middleware(['auth:web,employee']);
    Route::get('/', [CartController::class, 'viewCart'])->name('cart.index')->middleware(['auth:web,employee']);
    Route::post('/increase', [CartController::class, 'increaseQuantity'])->name('cart.increase')->middleware(['auth:web,employee']);
    Route::post('/decrease', [CartController::class, 'decreaseQuantity'])->name('cart.decrease')->middleware(['auth:web,employee']);
    Route::delete('/remove', [CartController::class, 'removeFromCart'])->name('cart.remove')->middleware(['auth:web,employee']);
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware(['auth:web,employee']);
});

Route::get('/factura', [App\Http\Controllers\ReportController::class, 'generatePDF'])->name('factura')->middleware('auth:employee,web');

