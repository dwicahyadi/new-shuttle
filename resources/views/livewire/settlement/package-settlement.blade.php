<div>
    <div class="row">
        <div class="col-md-6">
            <h4>Data Paket</h4>
            <ul class="list-group" id="packages">
                @forelse($transactions as $package)
                    <li class="list-group-item">
                        <div class="d-flex align-items-center">
                            <div class="p-2 flex-fill">
                                <small>{{ $package->departure   ->date }} {{ $package->departure->time }}</small><br>
                                <small>{{ $package->departure->departure_point->city->name }} {{ $package->departure->departure_point->name }}</small> -
                                <small>{{ $package->departure->arrival_point->name }} {{ $package->departure->arrival_point->name }}</small><br>
                                <small> Pengirim</small> <br>
                                <span>{{ $package->sender_phone }}</span> / <span>{{ $package->sender_name }}</span>
                                <br>

                                <small> Penerima</small> <br>
                                <span>{{ $package->receiver_phone }}</span> / <span>{{ $package->receiver_name }}</span>
                            </div>
                            <div class="p-2 flex-fill">
                                <small> Berat/Jumlah</small> <br>
                                <span>{{ $package->weight }} KG</span> / <span>{{ $package->piece }} Koli</span>
                                <br>

                                <small> Jenis/Isi</small> <br>
                                <span>{{ $package->type }}</span> <br> <span>{{ $package->content }}</span>
                            </div>
                            <div class="p-2 text-right">
                                <strong>Rp. {{ number_format($package->price) }}</strong>
                            </div>
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
                            <th>Point Tujuan</th>
                            <th>KG</th>
                            <th>Koli</th>
                            <th>Amount</th>
                        </tr>
                        @forelse($transactions->groupBy('departure.arrival_point.name') as $arrival => $data)
                            <td>{{ $arrival }}</td>
                            <td class="text-right">{{ number_format($data->sum('weight') ?? 0) }}</td>
                            <td class="text-right">{{ number_format($data->sum('piece') ?? 0) }}</td>
                            <td class="text-right">{{ number_format($data->sum('price') ?? 0) }}</td>
                        @empty
                            Kosong
                        @endforelse

                        <tr>
                            <td></td>
                            <td align="right"><h3>{{ number_format($transactions->sum('weight')) }}</h3></td>
                            <td align="right"><h3>{{ number_format($transactions->sum('piece')) }}</h3></td>
                            <td align="right"><h3>{{ number_format($transactions->sum('price')) }}</h3></td>
                        </tr>

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
