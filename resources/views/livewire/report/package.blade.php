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
                                            <option value="{{$item->id}}">[{{$item->code}}] {{$item->name}}</option>
                                        @empty

                                        @endforelse
                                    </optgroup>
                                @empty

                                @endforelse
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
                            <th>Tanggal</th>
                            <th>Paket</th>
                            <th>Point</th>
                            <th>Telepon Pengirim</th>
                            <th>Nama Pengirim</th>
                            <th>Telepon Penerima</th>
                            <th>Nama Penerima</th>
                            <th>Berat</th>
                            <th>Jumah Koli</th>
                            <th>Jenis</th>
                            <th>Isi</th>
                            <th>Harga</th>
                            <th>CSO</th>
                            <th>Settlement</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($report ?? [] as $row)
                            <tr>
                                <td>{{ $row->created_at }}</td>
                                <td>PKT{{ \Illuminate\Support\Str::padLeft($row->id,'6','0') }}</td>
                                <td>{{ $row->departure_point->name }}</td>
                                <td>{{ $row->sender_name }}</td>
                                <td>{{ $row->sender_phone }}</td>
                                <td>{{ $row->receiver_name }}</td>
                                <td>{{ $row->receiver_phone }}</td>
                                <td>{{ $row->weight }}</td>
                                <td>{{ $row->piece }}</td>
                                <td>{{ $row->type }}</td>
                                <td>{{ $row->content }}</td>
                                <td align="right">{{ number_format($row->price)}}</td>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->settlemnt_id ? 'Sudah' : 'Belum' }}</td>
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
