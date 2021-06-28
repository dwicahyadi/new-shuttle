<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function (){
    Route::prefix('master')->group(function (){
        Route::name('master.')->group(function (){
            Route::name('car.')->group(function (){
                Route::view('car','master.car.index')->name('index');
                Route::view('car/create','master.car.create')->name('create');
                Route::view('car/show','master.car.show')->name('show');
            });
        });
    });

    Route::name('schedule.')->group(function (){
        Route::view('schedule/create','schedule.create')->name('create');
    });

    Route::view('reservation','reservation.index')->name('reservation');

    Route::name('settlement.')->group(function (){
        Route::view('settlement/ticket','settlement.ticket')->name('ticket');
        Route::view('settlement/package','settlement.package')->name('package');
    });

    Route::name('print.')->group(function (){
        Route::get('print/ticket/{reservationId}',[\App\Http\Controllers\PrintController::class, 'ticket'])->name('ticket');
        Route::get('print/manifest/{schedule}',[\App\Http\Controllers\PrintController::class, 'manifest'])->name('manifest');
    });

    Route::name('finance.')->group(function (){
        Route::view('ledger','finance.index')->name('ledger');
        Route::view('income','finance.income')->name('income');
        Route::view('expense','finance.expense')->name('expense');
    });
});
