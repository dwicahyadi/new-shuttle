<?php

namespace App\Http\Controllers;

use App\Helpers\ExpenseHelper;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Settlement;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    public function ticket($reservationId)
    {
        $reservation = Reservation::with('tickets')->find( $reservationId);
        if($reservation->tickets[0]->count_print > 0)
        {
            if(!Auth::user()->can('Re-print'))
                return 'You dont have permission to perform this action!';
        }
        $reservation->tickets()->update(['count_print' => \Illuminate\Support\Facades\DB::raw('count_print+1')]);
        return view('prints.ticket',['reservation'=>$reservation]);
    }

    public function manifest (Schedule $schedule){
        if (!$schedule ->car_id && !$schedule ->driver_id && !$schedule ->costs )
        {
            return 'Driver and or Car and or Costs cannot be null';
        }
        if (!$schedule->departures[0]->is_manifested)
        {
            $schedule->departures()->update(['is_manifested'=>true]);
            $desc = "BOP jadwal {$schedule->id}";
            ExpenseHelper::saveExpense('BOP', (int) $schedule->costs, $desc);
        }

        return view('prints.manifest', ['schedule'=>$schedule]);
    }

    public function settlement (Settlement $settlement){
        return view('prints.settlement', ['settlement'=>$settlement]);
    }

    public function package(Package $package)
    {
        return view('prints.package', ['package'=>$package]);
    }

    public function selfPrintTicket(Reservation $reservation)
    {
        return view('prints.ticket',['reservation'=>$reservation]);
    }

}
