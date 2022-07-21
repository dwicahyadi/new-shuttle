<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Livewire\Component;

class CustomerSearchForm extends Component
{
    public ?Customer $customer;
    public ?Collection $suggestCustomers;
    public string $phone ='';
    public string $name = '';
    public string $address = '';
    public string $phoneSearch = '';

    protected $listeners = [
        'reservationSaved' => 'changeCustomer'
    ];



    public function render()
    {
        return view('livewire.reservation.customer-search-form');
    }

    public function updatedPhoneSearch($value)
    {
        if (strlen($this->phoneSearch > 4)) {
            $this->suggestCustomers = Customer::where('phone', 'like', $this->phoneSearch . '%')->limit(5)->get();
        } else {
            $this->suggestCustomers = null;
        }
    }

    public function setCustomer()
    {
        $this->customer = Customer::withCount(['tickets'=>function($q){
            return $q
                ->whereDate('date','>=', Carbon::now()->subMonth(2))
                ->where('status','paid');
        }])->where('phone', $this->phoneSearch)->first();
        if ($this->customer)
            $this->emit('setCustomer', $this->customer);
    }

    public function save()
    {
        $customer = new Customer();

        $customer->name = $this->name;
        $customer->phone = $this->phoneSearch;
        $customer->address = $this->address;
        $customer->count_reservation_finished = $customer->count_reservation_finished + 0;
        $customer->count_reservation = $customer->count_reservation + 0;
        $customer->save();

        $this->dispatchBrowserEvent(
            'alert', [
                'title' => 'Sukses',
                'msg' => 'Konsumen Baru Disimpan',
                'icon' => 'success']);

        $this->setCustomer();

    }

    public function changeCustomer()
    {
        $this->customer = null;
        $this->phoneSearch = '';
        $this->address = '';
        $this->name = '';
        $this->emit('changeCustomer');
    }

}
