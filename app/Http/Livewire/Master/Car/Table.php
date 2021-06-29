<?php

namespace App\Http\Livewire\Master\Car;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $sortBy = 'id';
    public $sortDirection = 'desc';
    public $search = '';

    public function render()
    {
        $cars = \App\Models\Car::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
        return view('livewire.master.car.table', compact(['cars']));
    }

    public function sortBy($field)
    {
        if($this->sortDirection == 'asc')
        {
            $this->sortDirection = 'desc';
        }else{
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
