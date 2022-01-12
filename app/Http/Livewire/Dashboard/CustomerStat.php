<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Customer;
use App\Models\SummaryReport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class CustomerStat extends Component
{
    public $month, $year, $total, $new, $current, $member;

    public function render()
    {
        $expiresAt = Carbon::now()->endOfDay()->addSecond();

        $this->current = Cache::get('stat_total_customer',function(){
            return SummaryReport::whereMonth('date', $this->month)->whereYear('date',$this->year)->where('status','paid')->count();
        }, $expiresAt);

        $this->new = Customer::whereMonth('created_at', $this->month)->whereYear('created_at',$this->year)->count();
        $this->member = Customer::where('member',1)->count();
        $this->total = Customer::count();
        return view('livewire.dashboard.customer-stat');
    }
}
