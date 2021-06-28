<?php
namespace App\Helpers;


use App\Models\Package;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillHelper
{
    public static function countBill()
    {
        $bill = Ticket::where('payment_by', Auth::id())->whereNull('settlement_id')->get();
        return $bill->sum('price') ?? 0;
    }

    public static function countPackageBill()
    {
        $bill = Package::where('payment_by', Auth::id())->whereNull('settlement_id')->get();
        return $bill->sum('price') ?? 0;
    }
}
