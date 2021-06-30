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
                        <thead class="thead-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Point</th>
                            <th>CSO</th>
                            <th>Setoran</th>
                            <th>Note</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($report ?? [] as $row)
                            <tr>
                                <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td>
                                <td>{{ $row->type ?? 'tickets' }}</td>
                                <td>{{ $row->user->point->name ?? '' }}</td>
                                <td>{{ $row->user->name ?? '' }}</td>
                                <td align="right">{{ number_format($row->amount)}}</td>
                                <td>{{ $row->note ?? '' }}</td>
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
