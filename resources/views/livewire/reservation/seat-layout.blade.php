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

                        @for($i = 2; $i <= $totalSeats; $i++)

                            <tr>
                                @for($col = 1; $col <= $seatPerRow; $col++)
                                    <td class="">
                                        @isset($seats[$i])
                                            @livewire('partial.filled-seat',['seatNumber' => $i, 'ticket'=> $seats[$i], 'currentPontId' => $departure->departure_point_id], key("filled-seat.{$departure->id}.$i"))
                                        @else
                                            @livewire('partial.empty-seat',['seatNumber' => $i], key("seat.{$departure->id}.$i"))
                                        @endisset
                                        @if($col < $seatPerRow)
                                            <?php
                                            $i++;
                                            if($i > $totalSeats) break;
                                            ?>
                                        @endif
                                    </td>
                                @endfor

                            </tr>
                        @endfor
                    </table>
                @else
                    <h2>Blank</h2>
                @endif
            </div>
        </div>
    @endif

</div>
