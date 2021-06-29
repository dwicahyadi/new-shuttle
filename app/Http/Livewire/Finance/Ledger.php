<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use Livewire\WithPagination;

class Ledger extends Component
{
    use WithPagination;

    public $sortBy = 'id';
    public $sortDirection = 'desc';
    public $search = '';

    public function render()
    {
        $ledgers = \App\Models\Ledger::query()
            ->search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);
        return view('livewire.finance.ledger', compact(['ledgers']));
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

