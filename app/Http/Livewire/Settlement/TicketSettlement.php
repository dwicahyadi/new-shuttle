<?php

namespace App\Http\Livewire\Settlement;

use App\Helpers\IncomeHelper;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TicketSettlement extends Component
{
    public int $amount = 0;
    public string $note = '';

    public function render()
    {
        $transactions = \App\Models\Ticket::with(['departure', 'departure.departure_point', 'departure.arrival_point'])->where('payment_by', Auth::id())
            ->whereNull('settlement_id')->orderBy('id','DESC')->get();
        $summary = Ticket::yetSettlement()->where('payment_by', Auth::id());

        $this->amount = $transactions->sum('price');

        return view('livewire.settlement.ticket-settlement',[
            'transactions'=>$transactions,
            'summary'=>$summary]);
    }

    public function save()
    {
        DB::beginTransaction();
        $settlement = \App\Models\Settlement::create(
            [
                'amount'=> $this->amount,
                'note' => $this->note,
                'user_id' => Auth::id()
            ]
        );

        Ticket::where('payment_by', Auth::id())->whereNull('settlement_id')->update(['settlement_id'=> $settlement->id]);
        IncomeHelper::saveIncome('PENDAPATAN TIKET',(int) $this->amount, 'Setllment oleh '.Auth::user()->name);
        activity('settlement_log')->performedOn($settlement)->causedBy(Auth::user())->log('Melakukan settlement sebesar '.$this->amount);
        DB::commit();
        $this->emit('updateBill');

    }
}
