<div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <strong>Filter Laporan</strong>
                    <form method="get" class="">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" wire:model.defer="date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" wire:model.defer="end_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Point Keberangaktan</label>
                            <select wire:model.defer="point" class="form-control">
                                <option value="">Semua</option>
                                @forelse($cities as $city)
                                    <optgroup label="[{{$city->code}}] {{$city->name}}">
                                        @forelse($city->points as $item)
                                            <option value="{{$item->name}}">[{{$item->code}}] {{$item->name}}</option>
                                        @empty

                                        @endforelse
                                    </optgroup>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select wire:model.defer="status" class="form-control">
                                <option value="">Semua</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="cancel">Cancel</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-primary" wire:click="$refresh">Tampilkan</button>
                            <div wire:loading>
                                loading...
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="">
                        <tr>
                            <th>Telepon</th>
                            <th>Nama</th>
                            <th>Point Keberangkatan</th>
                            <th>Point Tujuan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>No Kursi</th>
                            <th>Diskon</th>
                            <th>Harga Tiket</th>
                            <th>Status</th>
                            <th>CSO</th>
                            <th>Pembayaran Oleh</th>
                            <th>Settlement</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($report ?? [] as $row)
                            <tr>
                                <td>{{ $row->phone }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->departure_point }}</td>
                                <td>{{ $row->arrival_point }}</td>
                                <td>{{ $row->date }}</td>
                                <td>{{ $row->time }}</td>
                                <td>{{ $row->seat }}</td>
                                <td>{{ $row->discount_name }}</td>
                                <td align="right">{{ number_format($row->price)}}</td>
                                <td>{{ $row->status }}</td>
                                <td>{{ $row->reservation_by }}</td>
                                <td>{{ $row->payment_by }}</td>
                                <td>{{ $row->settlement_id }}</td>
                                <td align="center">
                                    <a href="{{ route('print.settlement', ['settlement'=>$row]) }}" target="_blank">Cetak</a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
