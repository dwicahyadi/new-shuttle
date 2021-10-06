<?php

namespace App\Http\Livewire\Reservation;

use App\Helpers\WAHelper;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class ModalDialog extends Component
{
    public ?Reservation $reservation;
    public $activities;

    protected $listeners = [
        'getReservation'
    ];


    public function render()
    {
        return view('livewire.reservation.modal-dialog');
    }

    public function getReservation(int $id)
    {
        $this->reservation = Reservation::find($id);
        $this->activities = Activity::inLog('reservation_log')->where('subject_id', $id)->get();
    }

    public function payment()
    {
        $this->reservation->update(['expired_at'=> null,'is_expired'=>false]);
        $this->reservation->tickets()->update(
            [
                'status' => 'paid',
                'payment_method' => 'CASH PAYMENT',
                'payment_at' => now(),
                'payment_by' => Auth::id(),
            ]
        );
        activity('reservation_log')->performedOn($this->reservation)->causedBy(Auth::user())->log('payment');
        $this->reservation->customer->updateCustomerCountReservationFinish();

        $msg = WAHelper::msgBuilder($this->reservation);
        $wa = WAHelper::send($this->reservation->customer->phone, $msg);
        activity('reservation_log')->performedOn($this->reservation)->causedBy(Auth::user())->log('Whatasapp'.$wa);

        $this->emit('updateBill');
        $this->emit('reload');
        $this->getReservation($this->reservation->id);
    }

    public function cancelReservation()
    {
        $this->reservation->tickets()->update(['is_cancel' => true,'status' => 'cancel']);
        $this->emit('reservationSaved');
        activity('reservation_log')->performedOn($this->reservation)->causedBy(Auth::user())->log('cancel reservation');
        $this->reservation = null;

    }

    public function cancelPayment()
    {
        $this->reservation->tickets()->update(
            [
                'status' => 'unpaid',
                'payment_method' => null,
                'payment_at' => null,
                'payment_by' => null,
            ]
        );
        activity('reservation_log')->performedOn($this->reservation)->causedBy(Auth::user())->log('cancel payment');
        $this->emit('reload');
        $this->getReservation($this->reservation->id);
    }
}
