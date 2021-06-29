<?php

namespace App\Http\Livewire\Master\Car;

use Livewire\Component;
use Livewire\WithPagination;

class MaintenanceTable extends Component
{
    use WithPagination;

    public $sortBy = 'id';
    public $sortDirection = 'desc';
    public $search = '';
    public int $car_id;

    protected $listeners = [
        'saved' => '$refresh'
    ];


    public function mount(int $car_id)
    {
        $this->car_id = $car_id;
    }

    public function render()
    {
        $maintenances = \App\Models\CarMaintenanceHistory::query()
            ->where('car_id', $this->car_id)
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
        return view('livewire.master.car.maintenance-table', compact(['maintenances']));
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
