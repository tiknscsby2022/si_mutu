<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SSPController;

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

Route::get('/', function () {
    return redirect()->route('login_show');
});


Route::controller(AuthController::class)->middleware('guest')->group(function(){
    Route::get('/login', 'login')->name('login_show');
    Route::post('/login', 'authenticate')->name('authenticate');    
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::controller(AdminController::class)->group(function() {

    // ========================= DASHBOARD ============================
    //Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/beranda', 'beranda_show')->name('admin_beranda_show');
    Route::post('/beranda/store', 'beranda_store')->name('admin_beranda_store');

        // ========================= KETETAPAN ============================
    Route::get('/penetapan', 'penetapan_show')->name('admin_penetapan_show');  
        
        // ====================== ASPEK ===============================
        Route::post('/penetapan/aspek', 'aspek_store')->name('admin_penetapan_aspek_store');
        Route::get('/penetapan/aspek/{id}/delete', 'aspek_delete')->name('admin_penetapan_aspek_delete');
        Route::get('/penetapan/aspek/{id}/update', 'aspek_update')->name('admin_penetapan_aspek_update');
        Route::put('/penetapan/aspek/{id}/edit', 'aspek_edit')->name('admin_penetapan_aspek_edit');

        // ====================== STANDAR =============================
        Route::post('/penetapan/standar', 'standar_store')->name('admin_penetapan_standar_store');
        Route::get('/penetapan/standar/{id}/show', 'standar_show')->name('admin_penetapan_standar_show');
        Route::put('/penetapan/standar/{id}/update', 'standar_update')->name('admin_penetapan_standar_update');
        Route::get('/penetapan/standar/{id}/delete', 'standar_delete')->name('admin_penetapan_standar_delete');

        // ====================== INDIKATOR ===========================
        Route::get('/penetapan/indikator/{id}/show', 'indikator_show')->name('admin_penetapan_indikator_show');        
        Route::get('/penetapan/indikator/{id}/destroy', 'indikator_destroy')->name('admin_penetapan_indikator_destroy');
        Route::get('/penetapan/indikator/{id}/edit', 'indikator_edit')->name('admin_penetapan_indikator_edit');
        Route::put('/penetapan/indikator/{id}/update', 'indikator_update')->name('admin_penetapan_indikator_update');
        Route::post('/penetapan/indikator/{id}/store', 'indikator_store')->name('admin_penetapan_indikator_store');

    // ========================= REALISASI ============================
    Route::get('/realisasi', 'realisasi_show')->name('admin_realisasi_show');
    Route::get('/realisasi/data_role', 'data_role')->name('data_role');
    Route::get('/realisasi/{name}/departemen', 'realisasi_departemen_show')->name('admin_realisasi_departemen_show');    
    Route::get('/realisasi/departemen/{id}/show', 'realisasi_departemen_detail_show')->name('admin_realisasi_detail_departemen_show');    
    Route::get('/realisasi/{id}/get_relasi', 'realisasi_departemen_relasi_show')->name('admin_realisasi_departemen_relasi_show');
    Route::put('/realisasi/{id}/update', 'realisasi_update')->name('admin_realisasi_update');
    Route::post('/realisasi/{id}/store', 'realisasi_departemen_relasi_store')->name('admin_realisasi_departemen_relasi_store');
    Route::post('/realisasi/{id}/file/store', 'realisasi_file_store')->name('admin_file_store');

    // ========================= TEMUAN ================================
    Route::get('/temuan', 'temuan_show')->name('admin_temuan_show');
    Route::get('/temuan/{id}', 'temuan_search')->name('admin_temuan_search');
    Route::get('/temuan/{pic}/detail/{id}', 'temuan_detail')->name('admin_temuan_detail');
    Route::post('/temuan/store/detail/', 'temuan_store')->name('admin_temuan_store');

    // ========================= PENGENDALIAN ============================
    Route::get('/pengendalian', 'pengendalian_show')->name('admin_pengendalian_show');
    Route::get('/pengendalian/get_pdf', 'pengendalian_get_pdf_show')->name('admin_pengendalian_get_pdf_show');
    Route::get('/pengendalian/{media}/', 'pengendalian_media_show')->name('admin_pengendalian_media_show');
    Route::post('/pengendalian/create', 'pengendalian_store')->name('admin_pengendalian_store');

    // ========================= PENGENDALIAN ============================
    Route::get('/peningkatan', 'peningkatan_show')->name('admin_peningkatan_show');
    Route::post('/peningkatan/store', 'peningkatan_store')->name('admin_peningkatan_store');
    });
    
  
    
// ========================= ServerSide Processing ============================
Route::controller(SSPController::class)->group(function() {
    Route::get('/ssp/aspek', 'aspek')->name('ssp_aspek');
    Route::get('/ssp/role', 'role')->name('ssp_role');
    Route::get('/ssp/standar/{id}', 'standar')->name('ssp_standar');    
    Route::get('ssp/realisasi/{name}', 'realisasi')->name('ssp_realisasi');
    Route::get('ssp/file/{id}', 'file')->name('ssp_file');
    Route::get('/ssp/temuan', 'temuan')->name('ssp_temuan');
    Route::get('/ssp/temuan/{pic}/detail/{id}', 'temuan_detail')->name('ssp_temuan_detail');
    Route::get('/ssp/pengendalian', 'pengendalian')->name('ssp_pengendalian');
});




Route::controller(UserController::class)->group(function() {
    
    // ========================= DASHBOARD ============================
        Route::get('/dashboard', 'dashboard')->name('user_dashboard_show');

    // ========================= REALISASI ============================
        Route::get('/realisasi/{name}', 'realisasi_show')->name('user_realisasi_show');
});
