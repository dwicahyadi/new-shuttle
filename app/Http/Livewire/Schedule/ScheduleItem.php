<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Departure;
use Livewire\Component;

class ScheduleItem extends Component
{
    public Departure $departure;

    public function render()
    {
        return view('livewire.schedule.schedule-item');
    }

    public function toggleOpen()
    {
        $this->departure->update([
            'is_open' => !$this->departure->is_open
        ]);
    }
}
