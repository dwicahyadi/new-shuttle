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
Route::get('self_print/{reservation}',[\App\Http\Controllers\PrintController::class,'selfPrintTicket'])->name('self_print');
Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::view('/profile', 'profile')->name('profile');

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

            Route::name('discount.')->group(function () {
                Route::view('discount','master.discount.index')->name('index');
            });

            Route::name('permissions.')->group(function () {
                Route::view('permissions','master.permissions.index')->name('index');
            });

        });
    });

    Route::name('schedule.')->group(function (){
        Route::view('schedule/create','schedule.create')->name('create');
        Route::view('schedule/manage','schedule.manage')->name('manage');
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
        Route::get('print/package/{package}',[\App\Http\Controllers\PrintController::class, 'package'])->name('package');
    });

    Route::name('finance.')->group(function (){
        Route::view('ledger','finance.index')->name('ledger');
        Route::view('income','finance.income')->name('income');
        Route::view('expense','finance.expense')->name('expense');
    });

    Route::name('report.')->group(function (){
        Route::view('report/income_statement','report.income')->name('income_statement');
        Route::view('report/settlement','report.settlement')->name('settlement');
        Route::view('report/occupancy','report.occupancy')->name('occupancy');
        Route::view('report/operational_costs','report.operational_cost')->name('operational_cost');

        Route::view('report/per_point','report.per_point')->name('per_point');
        Route::view('report/per_route','report.per_route')->name('per-route');
        Route::view('report/ticket_detail','report.ticket_detail')->name('ticket-detail');

        Route::view('report/package_detail','report.package_detail')->name('package-detail');
    });
});
