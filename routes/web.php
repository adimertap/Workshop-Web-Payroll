<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes(['verify' => true]);


Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@showRegisterForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get("/getkabupaten/{id}", "Auth\RegisterController@kabupaten_baru");
Route::get("/getkecamatan/{id}", "Auth\RegisterController@kecamatan_baru");
Route::get("/getdesa/{id}", "Auth\RegisterController@desa_baru");


Route::get('account/password', 'Account\PasswordController@edit')->name('password.edit');
Route::patch('account/password', 'Account\PasswordController@update')->name('password.edit');

Route::group(
    ['middleware' => 'auth'],
    function () {
        // MASTER DATA ------------------------------------------------------------ Master Data Payroll
        Route::prefix('payroll/gaji-pokok')
            ->namespace('Payroll\Masterdata')
            ->middleware(['owner', 'verified'])
            ->group(function () {
                Route::get('/', 'MasterdatagajipokokController@index')
                    ->name('masterdatagajipokok');

                Route::resource('gaji-pokok', 'MasterdatagajipokokController');
                Route::post('/tambahgajipokok', 'MasterdatagajipokokController@tambahgajipokok')
                    ->name('gaji-pokok-tambah');
            });

        Route::prefix('payroll')
            ->namespace('Payroll\Masterdata')
            ->middleware(['owner', 'verified'])
            ->group(function () {
                Route::resource('ptkp', 'PTKPController');
            });

        Route::prefix('payroll/tunjangan')
            ->namespace('Payroll\Masterdata')
            ->middleware(['owner', 'verified'])
            ->group(function () {
                Route::get('/', 'MasterdatatunjanganController@index')
                    ->name('masterdatatunjangan');

                Route::resource('tunjangan', 'MasterdatatunjanganController');
            });

        // GAJI PEGAWAI ----------------------------------------------------------- Gaji Pegawai
        Route::prefix('payroll')
            ->namespace('Payroll\Gajipegawai')
            ->middleware(['owner', 'verified'])
            ->group(function () {
                Route::resource('gaji-pegawai', 'GajipegawaiController');
                Route::get('/gaji-pegawai/{id_gaji_pegawai}/edit2', 'GajipegawaiController@edit2')
                    ->name('gaji-pegawai-edit');

                Route::post('gaji-pegawai/{id_gaji_pegawai}/set-status', 'GajipegawaiController@setStatus')
                    ->name('gaji-pegawai-status');
                Route::get('slip-gaji/{id}', 'GajipegawaiController@CetakSlip')->name('cetak-slip-gaji');
            });

        // PERAMPUNGAN ------------------------------------------------------------- Perampungan
        Route::prefix('payroll')
            ->namespace('Payroll\Perampungan')
            ->middleware(['owner', 'verified'])
            ->group(function () {
                Route::resource('perampungan', 'PerampunganControllerr');
                Route::get('form-perampungan/{id}', 'PerampunganControllerr@CetakForm')->name('cetak-perampungan');
            });
    }
);
