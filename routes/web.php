<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkinglocationsController;
use App\Http\Controllers\ParkingsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\ParkingusersController;
use App\Http\Controllers\SchedulesController;

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

Route::group(['middleware' => 'auth'], function () {
    //Lokasi Parkir
    Route::get('/lokasiparkir', [ParkinglocationsController::class, 'index']);
    Route::get('/lokasiparkir/create', [ParkinglocationsController::class, 'create'])->name('lokasiparkir_create');
    Route::post('/lokasiparkir', [ParkinglocationsController::class, 'store'])->name('lokasiparkir_store');
    Route::get('/lokasiparkir/{parkinglocation}/edit', [ParkinglocationsController::class, 'edit'])
        ->name('lokasiparkir_edit');
    Route::put('/lokasiparkir/{parkinglocation}', [ParkinglocationsController::class, 'update'])
        ->name('lokasiparkir_update');
    Route::delete('/lokasiparkir/{parkinglocation}', [ParkinglocationsController::class, 'destroy'])
        ->name('lokasiparkir_delete');

    //Parkiran
    Route::get('/parkir', [ParkingsController::class, 'index'])->name('parkiran_index');
    Route::get('/kendaraanparkir', [ParkingsController::class, 'show'])->name('parkiran_show');
    Route::get('/parkir/create', [ParkingsController::class, 'create'])->name('parkiran_create');
    Route::post('/parkir', [ParkingsController::class, 'store'])->name('parkiran_store');
    Route::get('/parkir/{parking}/edit', [ParkingsController::class, 'edit'])->name('parkiran_edit');
    Route::put('/parkir/{parking}', [ParkingsController::class, 'update'])->name('parkiran_update');
    Route::delete('/parkir/{parking}', [ParkingsController::class, 'destroy'])->name('parkiran_delete');
    Route::put('/keluar/{parking}', [ParkingsController::class, 'keluar'])->name('parkiran_keluar');

    //Liburan
    Route::get('/libur', [HolidaysController::class, 'index'])->name('holiday_index');
    Route::get('/libur/create', [HolidaysController::class, 'create'])->name('holiday_create');
    Route::post('/libur', [HolidaysController::class, 'store'])->name('holiday_store');
    Route::get('/libur/{holiday}/edit', [HolidaysController::class, 'edit'])->name('holiday_edit');
    Route::put('/libur/{holiday}', [HolidaysController::class, 'update'])->name('holiday_update');
    Route::delete('/libur/{holiday}', [HolidaysController::class, 'destroy'])->name('holiday_delete');

    //Jam Kerja
    Route::get('/jamkerja', [SchedulesController::class, 'index'])->name('schedule_index');
    Route::get('/jamkerja/{schedule}/edit', [SchedulesController::class, 'edit'])->name('schedule_edit');
    Route::put('/jamkerja/{schedule}', [SchedulesController::class, 'update'])->name('schedule_update');

    //Export Excel Parkiran
    Route::get('/parkir/exportexcel', [ParkingsController::class, 'exportexcel'])->name('exportexcel_parkiran');
});


//pdf
Route::post('/pengguna/exportpdf', [ParkingusersController::class, 'exportpdf'])->name('exportpdf');


//Pengguna Parkir
Route::get('/', [ParkingusersController::class, 'index'])->name('pengguna_index');
Route::post('/parkirlpsplsorong', [ParkingusersController::class, 'store'])->name('pengguna_store');
Route::get('/parkirmotor', [ParkingusersController::class, 'parkirmotor'])->name('index_motor');
// Route::post('/motormasuk', [ParkingusersController::class, 'motor_masuk'])->name('motor_masuk');

//Fitur Autentikasi
Auth::routes(['reset' => false, 'register' => false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
