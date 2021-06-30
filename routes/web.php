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
    return redirect(\route('home'));
});

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('master')->group(function (){
        Route::name('master.')->group(function (){
            Route::name('car.')->group(function (){
                Route::view('car','master.car.index')->name('index');
                Route::view('car/create','master.car.create')->name('create');
                Route::view('car/show','master.car.show')->name('show');
            });
            Route::name('customer.')->group(function (){
                Route::view('customer','master.customer.index')->name('index');
                Route::view('customer/create','master.customer.create')->name('create');
                Route::get('customer/show',function (){
                    $customer = \App\Models\Customer::query()
                    ->with(['tickets','packages','tickets.departure','tickets.departure.departure_point','tickets.departure.arrival_point',
                        'tickets.departure.departure_point.city','tickets.departure.arrival_point.city'])
                    ->where('id',request('id'))->first();
                    return view('master.customer.show',compact('customer'));
                })->name('show');
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

    Route::name('history.')->group(function (){
        Route::view('history/settlement','history.settlement')->name('settlement');
    });

    Route::name('print.')->group(function (){
        Route::get('print/ticket/{reservationId}',[\App\Http\Controllers\PrintController::class, 'ticket'])->name('ticket');
        Route::get('print/manifest/{schedule}',[\App\Http\Controllers\PrintController::class, 'manifest'])->name('manifest');
        Route::get('print/settlement/{settlement}',[\App\Http\Controllers\PrintController::class, 'settlement'])->name('settlement');
    });

    Route::name('finance.')->group(function (){
        Route::view('ledger','finance.index')->name('ledger');
        Route::view('income','finance.income')->name('income');
        Route::view('expense','finance.expense')->name('expense');
    });

    Route::name('report.')->group(function (){
        Route::view('report/ticket','report.tickets')->name('ticket');
        Route::view('report/income_statement','report.income_statement')->name('income_statement');
        Route::view('report/settlement','report.settlement')->name('settlement');
        Route::view('report/occupancy','report.occupancy')->name('occupancy');
        Route::view('report/operational_costs','report.operational_cost')->name('operational_cost');
    });
});
