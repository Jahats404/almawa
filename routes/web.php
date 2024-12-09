<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\kelola_agen\MarketingAgenController;
use App\Http\Controllers\kelola_agen\SaAgenController;
use App\Http\Controllers\kelola_jadwal\SaJadwalController;
use App\Http\Controllers\kelola_jamaah\AgenJamaahController;
use App\Http\Controllers\kelola_jamaah\SaJamaahController;
use App\Http\Controllers\paket\SaPaketController;
use App\Http\Controllers\pendaftaran\PendaftaranController;
use App\Http\Controllers\pengguna\AgenController;
use App\Http\Controllers\pengguna\PenggunaController;
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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [AuthController::class,'login'])->name('login');
Route::post('/authenticate', [AuthController::class,'authenticate'])->name('authenticate');

Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('/action-register', [AuthController::class,'action_register'])->name('action.register');

Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// FORGOT PASSWORD
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');




Route::middleware(['auth'])->group(function () {
    
    
    // Route prefix untuk Produsen

    Route::prefix('super-admin')->name('sa.')->middleware('CekUserLogin:1')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //PENGGUNA STAFF
        Route::get('/kelola-staff', [PenggunaController::class, 'staff'])->name('kelola.staff');
        Route::post('/tambah-staff', [PenggunaController::class, 'store_staff'])->name('tambah.staff');
        Route::put('/update-staff/{id}', [PenggunaController::class, 'update_staff'])->name('update.staff');
        Route::delete('/delete-staff/{id}', [PenggunaController::class, 'delete_staff'])->name('delete.staff');

        //PENGGUNA AGEN
        Route::get('/kelola-agen', [SaAgenController::class, 'agen'])->name('kelola.agen');
        Route::post('/tambah-agen', [SaAgenController::class, 'store_agen'])->name('tambah.agen');
        Route::get('/detail-agen/{id}', [SaAgenController::class, 'detail_agen'])->name('detail.agen');
        Route::put('/update-agen/{id}', [SaAgenController::class, 'update_agen'])->name('update.agen');
        Route::delete('/delete-agen/{id}', [SaAgenController::class, 'delete_agen'])->name('delete.agen');
        Route::get('/status-agen', [SaAgenController::class, 'status_agen'])->name('status.agen');
        Route::put('/ubah-status-agen/{id}', [SaAgenController::class, 'ubah_status_agen'])->name('ubah.status.agen');

        //PENGGUNA JADWAL
        Route::get('/kelola-jadwal', [SaJadwalController::class, 'index'])->name('kelola.jadwal');
        Route::post('/tambah-jadwal', [SaJadwalController::class, 'store'])->name('tambah.jadwal');
        Route::put('/update-jadwal/{id}', [SaJadwalController::class, 'update'])->name('update.jadwal');
        Route::delete('/destroy-jadwal/{id}', [SaJadwalController::class, 'destroy'])->name('destroy.jadwal');

        //PENGGUNA JAMAAH
        Route::get('/kelola-jamaah', [SaJamaahController::class, 'index'])->name('kelola.jamaah');
        Route::post('/tambah-jamaah', [SaJamaahController::class, 'store_jamaah'])->name('tambah.jamaah');
        Route::put('/update-jamaah/{id}', [SaJamaahController::class, 'update_jamaah'])->name('update.jamaah');
        Route::get('/detail-jamaah/{id}', [SaJamaahController::class, 'detail'])->name('detail.jamaah');
        Route::delete('/delete-jamaah/{id}', [SaJamaahController::class, 'delete'])->name('delete.jamaah');
        Route::get('/pengajuan-jamaah', [SaJamaahController::class, 'pengajuan_jamaah'])->name('pengajuan.jamaah');
        Route::put('/ubah-status-jamaah/{id}', [SaJamaahController::class, 'ubah_status_jamaah'])->name('ubah.status.jamaah');

        //PAKET
        Route::get('/kelola-paket', [SaPaketController::class, 'index'])->name('kelola.paket');
        Route::post('/tambah-paket', [SaPaketController::class, 'store'])->name('tambah.paket');
        Route::put('/update-paket/{id}', [SaPaketController::class, 'update'])->name('update.paket');
        Route::delete('/delete-paket/{id}', [SaPaketController::class, 'delete'])->name('delete.paket');
    });

    Route::prefix('admin')->name('admin.')->middleware('CekUserLogin:1')->group(function () {
        
    });

    Route::prefix('marketing')->name('marketing.')->middleware('CekUserLogin:4')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // AGEN
        Route::get('/kelola-agen', [MarketingAgenController::class, 'agen'])->name('kelola.agen');
        Route::post('/tambah-agen', [MarketingAgenController::class, 'store_agen'])->name('tambah.agen');
        Route::get('/detail-agen/{id}', [MarketingAgenController::class, 'detail_agen'])->name('detail.agen');
        Route::put('/update-agen/{id}', [MarketingAgenController::class, 'update_agen'])->name('update.agen');
        Route::delete('/delete-agen/{id}', [MarketingAgenController::class, 'delete_agen'])->name('delete.agen');
        Route::get('/status-agen', [MarketingAgenController::class, 'status_agen'])->name('status.agen');
        Route::post('/ubah-status-agen/{id}', [MarketingAgenController::class, 'ubah_status_agen'])->name('ubah.status.agen');
    });


    Route::prefix('agen')->name('agen.')->middleware('CekUserLogin:5')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard_agen'])->name('dashboard');

        // LENGKAPI DATA
        Route::get('/lengkapi-data', [AgenController::class, 'lengkapi_data'])->name('lengkapi.data');
        Route::get('/detail-data', [AgenController::class, 'detail'])->name('detail');
        Route::post('/action/lengkapi-data', [AgenController::class, 'action_lengkapi_data'])->name('action.lengkapi.data');
        
        //PENGGUNA JAMAAH
        Route::get('/kelola-jamaah', [AgenJamaahController::class, 'index'])->name('kelola.jamaah');
        Route::post('/tambah-jamaah', [AgenJamaahController::class, 'store_jamaah'])->name('tambah.jamaah');
        Route::put('/update-jamaah/{id}', [AgenJamaahController::class, 'update_jamaah'])->name('update.jamaah');
        Route::get('/detail-jamaah/{id}', [AgenJamaahController::class, 'detail'])->name('detail.jamaah');
        Route::delete('/delete-jamaah/{id}', [AgenJamaahController::class, 'delete'])->name('delete.jamaah');
        Route::get('/pengajuan-jamaah', [AgenJamaahController::class, 'pengajuan_jamaah'])->name('pengajuan.jamaah');
    });


    Route::prefix('jamaah')->name('jamaah.')->middleware('CekUserLogin:6')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard_jamaah'])->name('dashboard');

        // PENDAFTARAN
        Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
        Route::post('/pendaftaran-store', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
        Route::put('/pendaftaran-update/{id}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
        Route::get('/pendaftaran-detail/{id}', [PendaftaranController::class, 'detail'])->name('pendaftaran.detail');
        Route::delete('/pendaftaran-delete/{id}', [PendaftaranController::class, 'delete'])->name('pendaftaran.delete');
        
        // LENGKAPI DATA
        // Route::get('/lengkapi-data', [AgenController::class, 'lengkapi_data'])->name('lengkapi.data');
        // Route::post('/action/lengkapi-data', [AgenController::class, 'action_lengkapi_data'])->name('action.lengkapi.data');
    });
});