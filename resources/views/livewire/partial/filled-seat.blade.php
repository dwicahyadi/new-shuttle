<div>
    <div class="border p-2 rounded shadow-sm"
         @if($ticket->status == 'paid') style="background-color: #D4FFEB" @endif

    >
        @if($isEdit)
            @livewire('reservation.edit-ticket-form',['ticket'=>$ticket,], key("editTicket.{$ticket->id}"))
        @else
            <div class="">

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

                            @if($ticket->status == 'paid') <span class="badge badge-warning border-light p-1" title="Lunas">Lunas</span> @endif
                    </div>
                </div>
                <div class="text-center">
                    <small>{{ $ticket->phone }}</small><br>
                    {{ $ticket->name }}<br>
                    <small class="">{{ $ticket->departure_point->name ?? 'point_name' }}</small>
                </div>

                <div class="d-flex mt-4">
                    <button class="btn btn-primary btn-sm flex-fill"
                            data-toggle="modal" data-target="#ResevationDetail" data-backdrop="static"
                            wire:click="$emit('getReservation',{{ $ticket->reservation_id }})"
                    >
                        Tampilkan
                    </button>
                    @if($ticket->status == 'paid')
                        <button class="btn btn-outline-dark btn-sm" onclick="window.open('{{ route('print.ticket', ['reservationId'=> $ticket->reservation_id]) }}', '', 'width=500,height=500')"><i class="fa fa-print"></i></button>
                    @else
                        <button class="btn btn-outline-dark btn-sm" wire:click="toggleEdit"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-outline-danger btn-sm" onclick="confirm('Yakin batalkan tiket ini?') || event.stopImmediatePropagation()" wire:click="cancelTicket"><i class="fa fa-times"></i></button>
                    @endif
                </div>
            </div>
        @endif

    </div>
</div>
