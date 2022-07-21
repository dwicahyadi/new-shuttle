<div>
    @if($departure)
        <div class="card">
            <div class="card-body">
                @if($seats)
                    @php($seats = $seats->keyBy('seat'))
                    <table class="table table-borderless">
                        <tr>
                            <td class="" width="{{ 100/$seatPerRow }}%">
                                @isset($seats[1])
                                    @livewire('partial.filled-seat',['seatNumber' => 1, 'ticket'=> $seats[1], 'currentPontId' => $departure->departure_point_id], key('filled-seat.'.$departure->id.'.1'))
                                @else
                                    @livewire('partial.empty-seat',['seatNumber' => 1], key('seat.'.$departure->id.'.1'))
                                @endisset
                            </td>
                            @if($seatPerRow > 2)
                                <td class="" width="{{ 100/$seatPerRow }}%"><h4></h4></td>
                            @endif
                            <td class="" width="{{ 100/$seatPerRow }}%" style="vertical-align: middle; text-align: center">
                                <img src="{{ asset('images/icons/steer.svg') }}" alt="driver" style="height: 8rem;"  wire:click="$set('isManifestForm',1)">
                                <br>
                                <strong>{{ $departure->schedule->driver->name ?? 'Driver' }}</strong>
                            </td>
                        </tr>

                        {{--Baris 2--}}
                        <tr>
                            <td>
                                @isset($seats[2])
                                    @livewire('partial.filled-seat',['seatNumber' => 2, 'ticket'=> $seats[2], 'currentPontId' => $departure->departure_point_id], key('filled-seat.'.$departure->id.'.2'))
                                @else
                                    @livewire('partial.empty-seat',['seatNumber' => 2], key('seat.'.$departure->id.'.2'))
                                @endisset
                            </td>
                            <td></td>
                            <td>
                                @isset($seats[3])
                                    @livewire('partial.filled-seat',['seatNumber' => 3, 'ticket'=> $seats[3], 'currentPontId' => $departure->departure_point_id], key('filled-seat.'.$departure->id.'.3'))
                                @else
                                    @livewire('partial.empty-seat',['seatNumber' => 3], key('seat.'.$departure->id.'.3'))
                                @endisset
                            </td>
                        </tr>

                        {{--Baris 3--}}
                        <tr>
                            <td>
                                @isset($seats[4])
                                    @livewire('partial.filled-seat',['seatNumber' => 4, 'ticket'=> $seats[4], 'currentPontId' => $departure->departure_point_id], key('filled-seat.'.$departure->id.'.4'))
                                @else
                                    @livewire('partial.empty-seat',['seatNumber' => 4], key('seat.'.$departure->id.'.4'))
                                @endisset
                            </td>
                            <td></td>
                            <td>
                                @isset($seats[5])
                                    @livewire('partial.filled-seat',['seatNumber' => 5, 'ticket'=> $seats[5], 'currentPontId' => $departure->departure_point_id], key('filled-seat.'.$departure->id.'.5'))
                                @else
                                    @livewire('partial.empty-seat',['seatNumber' => 5], key('seat.'.$departure->id.'.5'))
                                @endisset
                            </td>
                        </tr>

                        {{-- Baris 4--}}
                        <tr>
                            <td>
                                @isset($seats[6])
                                    @livewire('partial.filled-seat',['seatNumber' => 6, 'ticket'=> $seats[6], 'currentPontId' => $departure->departure_point_id], key('filled-seat.'.$departure->id.'.6'))
                                @else
                                    @livewire('partial.empty-seat',['seatNumber' => 6], key('seat.'.$departure->id.'.6'))
                                @endisset
                            </td>
                            <td>
                                @isset($seats[7])
                                    @livewire('partial.filled-seat',['seatNumber' => 7, 'ticket'=> $seats[7], 'currentPontId' => $departure->departure_point_id], key('filled-seat.'.$departure->id.'.7'))
                                @else
                                    @livewire('partial.empty-seat',['seatNumber' => 7], key('seat.'.$departure->id.'.7'))
                                @endisset
                            </td>
                            <td>
                                @isset($seats[8])
                                    @livewire('partial.filled-seat',['seatNumber' => 8, 'ticket'=> $seats[8], 'currentPontId' => $departure->departure_point_id], key('filled-seat.'.$departure->id.'.8'))
                                @else
                                    @livewire('partial.empty-seat',['seatNumber' => 8], key('seat.'.$departure->id.'.8'))
                                @endisset
                            </td>
                        </tr>


                    </table>
                @else
                    <h2>Blank</h2>
                @endif
            </div>
        </div>
    @endif

</div>
