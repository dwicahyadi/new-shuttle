<div>
    <script type="text/javascript">
        function copy() {
            var pic = document.getElementById('tickets');
            var cvs = document.getElementById('canvas');
            html2canvas(pic).then(function(canvas) {
                cvs.append(canvas);
            });
        }
    </script>
    @if($reservation)
        <div class="modal-dialog modal-lg" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ResevationDetailLabel">Reservasi #{{$reservation->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reservatin-info-tab" data-toggle="tab" href="#reservatin-info" role="tab" aria-controls="reservatin-info" aria-selected="true">Reservasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reservation-log-tab" data-toggle="tab" href="#reservation-log" role="tab" aria-controls="reservation-log" aria-selected="false">Log</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-2" id="reservatin-info" role="tabpanel" aria-labelledby="reservatin-info-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Data Pemesan</h5>
                                    @if($reservation->expired_at)
                                        <div class="p-2 bg-warning">
                                            Pembayaran melalui transfer. Akan dibatalkan otomatis pada <strong>{{ $reservation->expired_at }}</strong>
                                        </div>
                                    @endif
                                    <p>
                                        <small>Kode</small><br>
                                        <strong>{{ $reservation->code ?? '----' }}</strong>
                                    </p>
                                    <p>
                                        <small>Nomor Telepon</small><br>
                                        <strong>{{ $reservation->customer->phone }}</strong>
                                    </p>
                                    <p>
                                        <small>Nama Pemesan</small><br>
                                        <strong>{{ $reservation->customer->name }}</strong>
                                    </p>

                                    <p>
                                        <small>Note</small><br>
                                        <strong>{{ $reservation->note ?? '-' }}</strong>
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    <h5>Data Tiket</h5>
                                    <div id="canvas">
                                        <ul class="list-group" id="tickets">
                                            @forelse($reservation->tickets as $ticket)
                                                <li class="list-group-item d-flex align-items-center">
                                                    <div class="mr-2">
                                                        <small class="clearfix">Seat {{ $ticket->seat }}</small>
                                                        <img
                                                            class="rounded mr-2"
                                                            src="https://ui-avatars.com/api/?size=32&background=0D8ABC&color=FFF&name={{ $ticket->discount_name ?? 'UMUM' }}"
                                                            alt="{{ $ticket->discount_name ?? 'UMUM' }}">
                                                    </div>
                                                    <div class="flex-fill">
                                                        <small>{{ $ticket->date }} {{ $ticket->departure->time }}</small><br>
                                                        <small>{{ $ticket->departure_point->city->name }} {{ $ticket->departure_point->name }}</small> -
                                                        <small>{{ $ticket->departure->arrival_point->city->name }} {{ $ticket->departure->arrival_point->name }}</small><br>
                                                        <span>{{ $ticket->name }}</span> /
                                                        <span>{{ $ticket->phone }}</span>
                                                    </div>
                                                    <div class="text-right">
                                                        <strong>Rp. {{ number_format($ticket->price) }}</strong>
                                                    </div>
                                                </li>
                                            @empty
                                                <li>Empty</li>
                                            @endforelse
                                            <li class="list-group-item d-flex align-items-center">
                                                <div class="flex-fill">
                                                    <span>Total</span>
                                                </div>
                                                <div class="text-right">
                                                    <h5>Rp. {{ number_format($reservation->tickets->sum('price') ?? 0) }}</h5>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right mt-4">
                                    @if($reservation->tickets[0]->status == 'paid')
                                        <button class="btn btn-primary" onclick="window.open('{{ route('print.ticket', ['reservationId'=> $reservation->id]) }}', '', 'width=500,height=500')">
                                            Cetak Tiket
                                        </button>

                                        @can('Cancel Payment')
                                            <button type="button" class="btn btn-danger" onclick="confirm('Yakin batalkan pembayaran?') || event.stopImmediatePropagation()"  wire:click="cancelPayment">
                                                Batalkan Pembayaran
                                            </button>
                                        @endcan
                                    @else

                                        <button type="button" class="btn btn-success mr-2" onclick="confirm('Konfirmasi pembayaran?') || event.stopImmediatePropagation()"  wire:click="payment">Bayar</button>
                                        <button type="button" class="btn btn-danger mr-2" onclick="confirm('Yakin batalkan reservasi?') || event.stopImmediatePropagation()"  wire:click="cancelReservation">Batalkan Reservasi</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reservation-log" role="tabpanel" aria-labelledby="reservation-log-tab">
                            <strong class="m-4">Logs</strong>
                            @empty($activities)
                                <span>No activites logged</span>
                            @else
                                <ul class="list-group">
                                    @foreach($activities as $activity)
                                        <li class="list-group-item border-right-0 border-left-0 bg-transparent">
                                            {{ $activity->description }} by <span class="text-primary">{{ $activity->causer->name }}</span> <span class="float-right">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->created_at))->diffForHumans() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ResevationDetailLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    @endif


</div>
