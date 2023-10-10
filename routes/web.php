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
        Route::get('/main', 'main')->name('app_main');
        Route::get('/create_contravention', 'createContravention')->name('app_create_contravention');
        Route::get('/info_contravention/{id:int}', 'infoContravention')->name('app_info_contravention');
        Route::get('/vehicule_db', 'vehiculeDb')->name('app_vehicule_db');
        Route::get('/vehicule_info/{num_matricule}', 'vehiculeInfo')->name('app_vehicule_info');
        Route::post('/found_vehicule', 'foundVehicule')->name('app_found_vehicule');
        Route::post('/get_price_infraction', 'getInfractionPRice')->name('app_get_price_infraction');
    });
    //Route::post('/add_contravention', 'addContravention')->name('app_add_contravention');
    Route::get('/payment_link/{token}', 'paymentLink')->name('app_payment_link');
    Route::post('/send_payment_link', 'sendPaymentLink')->name('app_send_payment_link');
    Route::post('/check_payment_code', 'checkPaymentCode')->name('app_check_payment_code');
    Route::get('/paiement_page/{id:int}', 'paymentPage')->name('app_paiement_page');
    Route::get('/mobile_paiement_page/{id:int}', 'mobilePaymentPage')->name('app_mobile_paiement_page');
    Route::post('/mobile_payment_process', 'mobilePaymentProcess')->name('app_mobile_payment_process');

    Route::get('/vehicule_registration', 'vehiculeRegis')->name('app_vehicule_registration');
    Route::post('/create_proprietaire', 'createProprietaire')->name('app_create_proprietaire');
    Route::post('/add_amande', 'addAmande')->name('app_add_amande');
});
