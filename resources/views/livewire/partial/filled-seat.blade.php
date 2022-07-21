<div>

    <div class="border p-2 rounded shadow-sm con"
         @if($ticket->status == 'paid') style="background-color: #D4FFEB" @endif

    >
        @if($isEdit)
            @livewire('reservation.edit-ticket-form',['ticket'=>$ticket,], key("editTicket.{$ticket->id}"))
        @else
            <div class="@if($ticket->departure_point_id != $currentPontId)) other-seat-card @else seat-card @endif">

                <div class="d-flex">
                    <div>
                        <h4>{{ $seatNumber }}</h4>
                    </div>
                    <div>
                        <img
                            width="24"
                            height="24"
                            class="rounded ml-2"
                            src="https://ui-avatars.com/api/?size=32&background=0D8ABC&color=FFF&name={{ $ticket->discount_name ?? 'UMUM' }}"
                            alt="{{ $ticket->discount_name ?? 'UMUM' }}">
                    </div>
                    <div class="flex-fill text-right">
                        @if($ticket->is_multiroute)
                            <span class="badge badge-dark text-white border-light" title="Multiroute">MR</span>
                        @endif

                            @if(!$ticket->count_print && $ticket->status == 'paid' )
                                <button class="btn btn-outline-dark btn-sm" onclick="window.open('{{ route('print.ticket', ['reservationId'=> $ticket->reservation_id]) }}', '', 'width=500,height=500')"><i class="fa fa-print"></i></button>
                            @endif

                            @if(!$ticket->checked_in && $ticket->status == 'paid' )
                                <button class="btn btn-outline-success btn-sm" onclick="confirm('Penumpang sudah datang?') || event.stopImmediatePropagation()" wire:click="checkIn"><i class="fa fa-check"></i></button>
                            @endif

                            @if($ticket->status == 'unpaid' )
                                <button class="btn btn-outline-info btn-sm" wire:click="toggleEdit"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-outline-danger btn-sm" onclick="confirm('Yakin batalkan tiket ini?') || event.stopImmediatePropagation()" wire:click="cancelTicket"><i class="fa fa-times"></i></button>
                            @endif
                    </div>
                </div>



            </div>
            <div class="button-holder">
                <a href="void()" data-toggle="modal" data-target="#ResevationDetail" data-backdrop="static"
                   wire:click="$emit('getReservation',{{ $ticket->reservation_id }})">
                    <div class="text-center">
                        <small class="clearfix">{{ $ticket->phone }}</small>
                        <span class="clearfix">{{ $ticket->name }}</span>
                        <small class="clearfix">{{ $ticket->departure_point->name ?? 'point_name' }}</small>
                    </div>
                </a>

            </div>

        @endif
    </div>

</div>
