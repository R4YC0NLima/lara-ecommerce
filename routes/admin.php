<?php

use App\Http\Controllers\Admin\{
    ProductAdminController,
    CategoryAdminController,
    ClientAdminController
};
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function() {
    Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
    
    Route::get('/produtos', [ProductAdminController::class, 'index'])->name('admin.products.index');
    Route::get('/produtos/create', [ProductAdminController::class, 'create'])->name('admin.products.create');
    Route::post('/produtos', [ProductAdminController::class, 'store'])->name('admin.products.store');
    Route::get('/produtos/{productAdmin}', [ProductAdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/produtos/{productAdmin}', [ProductAdminController::class, 'update'])->name('admin.products.update');
    Route::delete('/produtos/{productAdmin}', [ProductAdminController::class, 'destroy'])->name('admin.products.destroy');
    

    Route::get('/categorias', [CategoryAdminController::class, 'index'])->name('admin.categories.index');
    Route::get('/categorias/create', [CategoryAdminController::class, 'create'])->name('admin.categories.create');
    Route::post('/categorias', [CategoryAdminController::class, 'store'])->name('admin.categories.store');
    Route::get('/categorias/{categoryAdmin}', [CategoryAdminController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categorias/{categoryAdmin}', [CategoryAdminController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categorias/{categoryAdmin}', [CategoryAdminController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/clientes', [ClientAdminController::class, 'index'])->name('admin.clients.index');
    Route::get('/clientes/create', [ClientAdminController::class, 'create'])->name('admin.clients.create');
    Route::post('/clientes', [ClientAdminController::class, 'store'])->name('admin.clients.store');
    Route::get('/clientes/{categoryAdmin}', [ClientAdminController::class, 'edit'])->name('admin.clients.edit');
    Route::put('/clientes/{categoryAdmin}', [ClientAdminController::class, 'update'])->name('admin.clients.update');
    Route::delete('/clientes/{categoryAdmin}', [ClientAdminController::class, 'destroy'])->name('admin.clients.destroy');
        
});

