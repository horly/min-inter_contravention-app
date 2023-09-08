<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/logout-user', 'logout')->name('app_logout');
});

Route::controller(MainController::class)->group(function(){
    Route::middleware('auth')->group(function(){
        Route::match(['get', 'post'], '/main', 'main')->name('app_main');
        Route::match(['get', 'post'], 'create_contravention', 'createContravention')->name('app_create_contravention');
    });
    Route::post('/add_contravention', 'addContravention')->name('app_add_contravention');
});
