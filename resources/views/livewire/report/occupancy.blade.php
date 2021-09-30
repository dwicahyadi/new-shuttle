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
                                <option value="">Pilih..</option>
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
                            <th>Jam</th>
                            <th>Keberangkatan</th>
                            <th>Tujuan</th>
                            <th>Penumpang</th>
                            <th>Okupansi</th>
                            <th>Okupansi (7 Seats)</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($report as $row)
                            <tr>
                                <td>{{ $row->departures[0]->date }}</td>
                                <td>{{ $row->departures[0]->time }}</td>
                                <td>{{ $row->departures[0]->departure_point->name }}</td>
                                <td>{{ $row->departures[0]->arrival_point->name }}</td>
                                <td>{{ $row->paidTickets->count()}}</td>
                                <td>{{ $row->paidTickets->count() / $row->seats *100  }}%</td>
                                <td>{{ number_format($row->paidTickets->count() / 7 *100, 2)*1  }}%</td>
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
