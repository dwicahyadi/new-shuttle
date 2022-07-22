<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Point;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Create extends Component
{
    public $step=0;
    public $seats = 10;
    public $departurePointId, $arrivalPointId, $price, $fromDate, $toDate;
    public $departurePoint, $arrivalPoint;
    public $newHour, $newMinute;
    public $departureTimes = [];
    public $is_add = false;
    public $departurePointList;

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.schedule.create',[
            'cities'=>\App\Models\City::with(['points'])->get(),
        ]);
    }

    public function nextStep()
    {
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function setDeparturePoint()
    {
//        $this->departurePoint = Point::with('city')->find($this->departurePointId);
    }
    public function setArrivalPoint()
    {
        $this->arrivalPoint = Point::with('city')->find($this->arrivalPointId);
        $this->departurePointList = Point::where('city_id','!=', $this->arrivalPointId)->get();
    }

    public function addDepartureTime()
    {
        $newDepartureTime = $this->createTime();
        $point = $this->departurePointList->where('id', $this->departurePointId)->first();

        $this->departureTimes[$this->departurePointId] = [
            'departure_point_id' => $point->id,
            'departure_point_code' => $point->code,
            'point_name' => $point->name,
            'time' => $newDepartureTime,
        ];

        $this->is_add = false;

    }

    public function removeDepartureTime($key)
    {
        unset($this->departureTimes[$key]);
    }

    public function save()
    {
        $currentDate = $this->fromDate;

        while (strtotime($currentDate) <= strtotime($this->toDate)) {

            $schedule = new Schedule();
            $schedule->seats = $this->seats;
            $schedule->save();

            foreach ($this->departureTimes as $key => $departureTime)
            {
                $code = $schedule->id." "
                    .$departureTime['departure_point_code']."-"
                    .$this->arrivalPoint->code." "
                    .date('ymd',strtotime($currentDate))
                    .str_replace(':','',$departureTime['time']);


                $schedule->departures()->create([
                    'code' => $code,
                    'date' => $currentDate,
                    'time' => $departureTime['time'],
                    'arrival_point_id' => $this->arrivalPointId,
                    'departure_point_id' => $departureTime['departure_point_id'],
                    'price' =>$this->price,
                    'status' => 'available',
                    'is_open' => true
                ]);
            }
            $currentDate = date ("Y-m-d", strtotime("+1 day", strtotime($currentDate)));

        }
        $this->dispatchBrowserEvent(
            'alert', [
            'title' => 'Pembuatan Jadwal',
            'msg' => 'Jadwal berhasil dibuat',
            'icon' => 'success']);

        $this->departureTimes = [];
//        $this->resetForm();
    }

    /**
     * @return string
     */
    private function createTime(): string
    {
        $time = str_pad($this->newHour >= 24 ? 23 : $this->newHour,'2','0',STR_PAD_LEFT);
        $time .= ':';
        $time .= str_pad($this->newMinute >= 59 ? 59 : $this->newMinute,'2','0');
        return $time;
    }

    private function resetForm()
    {
        $this->step = 0;
        $this->seats = 10;
        $this->departurePointId = 0;
        $this->arrivalPointId = 0;
        $this->price = null;
        $this->fromDate = null;
        $this->toDate=null;
        $this->departurePoint= null;
        $this->arrivalPoint=null;
        $this->newHour =0;
        $this->newMinute = 0;
        $this->departureTimes = [];
    }

}
