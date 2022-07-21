<div>
    @if($departure)
        <h2>
            {{ $departure->departure_point->name ?? "asal" }} - {{ $departure->arrival_point->name ?? "tujuan" }} |
            {{ $departure->date ?? 'tanggal' }} {{ substr($departure->time ?? 'jam',0,5) }}
        </h2>
        <a class="text-info my-4" data-toggle="modal" data-target="#ScheduleDetail" data-backdrop="static"
           wire:click="$emit('getSchedule',{{ $departure->schedule_id }})">
            <i class="fa fa-edit"></i>
            {{ $departure->schedule->car->code ?? "[Mobil belm dipilih]" }} |
            {{ $departure->schedule->driver->name ?? "[Sopir belum dipilih]" }} |
            BOP Rp.{{ number_format($departure->schedule->costs ?? 0) }}
        </a> |
        <a class=""
                     onclick="if (window.confirm('Yakin cetak manifest untuk point {{ \Illuminate\Support\Facades\Auth::user()->point->name ?? 'Point' }}')) window.open('{{ route('print.manifest', ['schedule'=> $departure->schedule->id ?? 0]) }}', '', 'width=500,height=500')">
            <i class="fa fa-print"></i> Cetak Manifest
        </a>

        @if($departure->get_time_diff()->isPast())
            <div class="alert alert-danger mt-2">
                <h5>Batas waktu reservasi sudah lewat!</h5>
            </div>
        @endif

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
    @else
        <img src="{{ asset('images/customer_waiting.png') }}" alt="">
    @endif
</div>
