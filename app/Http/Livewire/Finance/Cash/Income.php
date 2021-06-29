<?php

namespace App\Http\Livewire\Finance\Cash;

use App\Models\Customer;
use App\Models\Ledger;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Income extends Component
{
    public string $date = '';
    public string $category = '';
    public string $description = '';
    public int $amount = 0;
    public ?Collection $suggestCategories;

    protected $rules = [
        'date' => 'required',
        'category' => 'required',
        'description' => 'required',
        'amount' => 'required|numeric|min:1',
    ];


    public function mount()
    {
        $this->date = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.finance.cash.income');
    }

    public function save()
    {
        $this->validate();
        Ledger::create(
            [
                'date' => $this->date,
                'category' => $this->category,
                'description' => $this->description,
                'amount' => $this->amount,
            ]);
        $this->reset([
            'date','category','description','amount',]);
        session()->flash('message', 'Pemasukan berhasil disimpan');
    }

    public function updatedCategory($value)
    {
        $this->suggestCategories = Ledger::selectRaw('count(*) AS cnt, category')->where('category', 'like', $value . '%')
            ->limit(10)->groupBy('category')->get();
    }
}
