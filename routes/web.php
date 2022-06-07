<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\ProductController;
// use App\Mail\NewSendEmail;
use App\Jobs\NewSendEmail;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Mail;
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

// Route::get('enviar-email', function() {
//     for($i = 0; $i <1000; $i++) {
//         NewSendEmail::dispatch($i);
//     }
// });

Route::post('register', [AuthController::class, 'create'])->name('newRegister');

Route::prefix('admin')->group(base_path('routes/admin.php'));
Route::match(['get', 'post'], '/{idCategory}/categoria', [ProductController::class, 'category'])->name('categoryToID');
Route::match(['get', 'post'], '/{idProduct}/carrinho/adicionar', [ProductController::class, 'addCart'])->name('addCart');
Route::match(['get', 'post'], '/ver-carrinho', [ProductController::class, 'showCart'])->name('showCart');
Route::match(['get', 'post'], '/{index}/excluir-carrinho', [ProductController::class, 'cartDestroy'])->name('cartDestroy');
Route::post('/carrinho/finalizar', [ProductController::class, 'finish'])->name('cartFinish');

Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');
Route::get('/verify', [AuthController::class, 'verifyCode'])->name('verifyCode');
Route::post('/verify', [AuthController::class, 'verify'])->name('verify');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

