<div>
    <div class="row">
        <div class="col-md-6">
            <h4>Data Tiket</h4>
            <ul class="list-group" id="tickets">
                @forelse($transactions as $ticket)
                    <li class="list-group-item d-flex align-items-center     ">
                        <div class="mr-2">
                            <small class="clearfix">Seat {{ $ticket->seat }}</small>
                            <img
                                class="rounded mr-2"
                                src="https://ui-avatars.com/api/?size=32&background=0D8ABC&color=FFF&name={{ $ticket->discount_name ?? 'UMUM' }}"
                                alt="{{ $ticket->discount_name ?? 'UMUM' }}">
                        </div>
                        <div class="flex-fill">
                            <small>{{ $ticket->date }} {{ $ticket->departure->time }}</small><br>
                            <small>{{ $ticket->departure->departure_point->city->name }} {{ $ticket->departure->departure_point->name }}</small> -
                            <small>{{ $ticket->departure->arrival_point->name }} {{ $ticket->departure->arrival_point->name }}</small><br>
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
            </ul>
        </div>

        <div class="col-md-6">
            <h4>Rekap Tagihan</h4>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th class="text-left">Point</th>
                            <th class="text-right">Qty</th>
                            <th class="text-right">Amount</th>
                        </tr>
                        @foreach($summary->groupBy('departure_point_name') as $departure => $data)
                            @foreach($data->groupBy('arrival_point_name') as $arrival => $tickets)
                                <tr class="bg-light">
                                    <td class="text-left"><strong>{{ $departure}} - {{ $arrival }}</strong></td>
                                    <td class="text-right"><strong>{{ number_format($tickets->count('price'))  }}</strong></td>
                                    <td class="text-right"><strong>{{ number_format($tickets->sum('price'))  }}</strong></td>
                                </tr>
                                @foreach($tickets->groupBy('discount_name') as $discount => $row)
                                    <tr>
                                        <td class="pl-4">{{ $discount }}</td>
                                        <td align="right">{{ number_format($row->count('price')) }}</td>
                                        <td align="right">{{ number_format($row->sum('price')) }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach

                        <tr>
                            <td></td>
                            <td align="right"><h3>{{ number_format($transactions->count('price')) }}</h3></td>
                            <td align="right"><h3>{{ number_format($transactions->sum('price')) }}</h3></td>
                        </tr>
                    </table>

                    <table class="table table-borderless">
                        @foreach($transactions->groupBy('payment_method') as $method => $trans)
                            <tr>
                                <td>{{ $method }}</td>
                                <td align="right">{{ number_format($trans->sum('price')) }}</td>
                            </tr>

                        @endforeach
                    </table>

                    <form wire:submit.prevent="save">
                        <textarea class="form-control my-2" placeholder="Catatan..."></textarea>
                        <label><input type="checkbox" required> Dengan ini Saya menyatakan telah menyetorkan Uang hasil penjualan sesuai dengan besar tagihan.</label>
                        <button class="mr-auto btn btn-primary" onclick="confirm('Konfirmasi settlement?') || event.stopImmediatePropagation()">Settlement</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
