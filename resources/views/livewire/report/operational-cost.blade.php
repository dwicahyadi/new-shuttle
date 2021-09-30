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
                            <label>Driver</label>
                            <select class="form-control" wire:model="driver_id">
                                <option value="0">All</option>
                                @forelse($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name ?? 'Driver Name' }}</option>
                                @empty
                                    <option value="0">No Driver</option>
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
                            <th>Driver</th>
                            <th>Unit</th>
                            <th>BOP</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($report ?? [] as $schedule)
                            <tr>
                                @foreach($schedule->departures as $departure)
                                    <td>{{ $departure->date }}</td>
                                    <td>{{ $departure->time }}</td>
                                    <td>{{ $departure->departure_point->name }}</td>
                                    <td>{{ $departure->arrival_point->name }}</td>
                                @endforeach
                                <td>{{ $schedule->driver->name ?? 'Driver Name'}}</td>
                                <td>{{ $schedule->car->code }}</td>
                                <td>{{ number_format($schedule->costs ?? 0) }}</td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                        <tfoot class="thead-light">
                        <tr>
                            <th>Total</th>
                            <th align="right" class="text-right" colspan="5"></th>
                            <th align="right" class="text-right">{{ number_format($report->sum('costs') ?? 0)}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
