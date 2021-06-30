<?php

namespace App\Http\Livewire\Settlement;

use App\Helpers\IncomeHelper;
use App\Models\Package;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PackageSettlement extends Component
{
    public int $amount = 0;
    public string $note = '';

    public function render()
    {
        $transactions = \App\Models\Package::with(['departure', 'departure.departure_point', 'departure.arrival_point'])->where('payment_by', Auth::id())
            ->whereNull('settlement_id')->orderBy('id','DESC')->get();

        $this->amount = $transactions->sum('price');

        return view('livewire.settlement.package-settlement',[
            'transactions'=>$transactions,]);
    }

    public function save()
    {
        DB::beginTransaction();
        $settlement = \App\Models\Settlement::create(
            [
                'amount'=> $this->amount,
                'note' => $this->note,
                'type' => 'packages',
                'user_id' => Auth::id()
            ]
        );

        Package::where('payment_by', Auth::id())->whereNull('settlement_id')->update(['settlement_id'=> $settlement->id]);
        IncomeHelper::saveIncome('PENDAPATAN PAKET',(int) $this->amount, 'Setllment oleh '.Auth::user()->name);
        activity('settlement_log')->performedOn($settlement)->causedBy(Auth::user())->log('Melakukan settlement sebesar '.$this->amount);
        DB::commit();
        $this->emit('updatePackageBill');

    }
}
