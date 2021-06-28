<div>
    @if($departure)
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="mr-4">
                        <span>{{ $departure->date ?? 'tanggal' }}</span>
                        <h1>{{ substr($departure->time ?? 'jam',0,5) }}</h1>
                    </div>
                    <div class="flex-fill mr-4">
                        <small>Keberangaktan</small><br>
                        <strong>{{ $departure->departure_point->name ?? "asal" }}</strong><br>
                        <br>
                        <small>Tujuan</small><br>
                        <strong>{{ $departure->arrival_point->name ?? "tujuan" }}</strong>
                    </div>
                    <div class="flex-fill mr-4">
                        <small>Mobil</small><br>
                        <strong>{{ $departure->schedule->car->code ?? "mobil" }}</strong>
                        <br>
                        <small>Sopir</small><br>
                        <strong>{{ $departure->schedule->driver->name ?? "Sopir" }}</strong>

                        <br>
                        <small>BOP</small><br>
                        <strong>{{ number_format($departure->schedule->costs ?? 0) }}</strong>
                    </div>
                    <div class="p-2 border-left border-light">
                        <button class="mb-2 btn btn-info"
                                data-toggle="modal" data-target="#ScheduleDetail" data-backdrop="static"
                                wire:click="$emit('getSchedule',{{ $departure->schedule_id }})"
                        >
                            <span>Update Schedule</span>
                        </button>
                        <button type="button" class="mb-2 btn btn-primary"
                                onclick="if (window.confirm('Yakin cetak manifest untuk point {{ \Illuminate\Support\Facades\Auth::user()->point->name }}')) window.open('{{ route('print.manifest', ['schedule'=> $departure->schedule->id ?? 0]) }}', '', 'width=500,height=500')">
                            Cetak Manifest
                        </button>
                    </div>
                </div>


            </div>
        </div>

        <ul class="nav nav-pills my-4" id="midSide" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="seatLayout" data-toggle="tab" href="#tab-seatLayout" role="tab" aria-controls="tab-scheduleSearch" aria-selected="true" title="Penumpang">
                    Penumpang
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="packageLayout" data-toggle="tab" href="#tab-packageLayout" role="tab" aria-controls="tab-scheduleSearch" aria-selected="true" title="Penumpang">
                    Paket
                </a>
            </li>
        </ul>
    @endif
</div>
