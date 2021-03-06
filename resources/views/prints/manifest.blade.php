<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Manifest</title>
</head>
<style>
    h1, h2, h3, h4, h5, h6 {
        margin: 1px;
    }
</style>
<body onload="window.print()">
@php($departure = $schedule->departures[0] )
@php($tickets = $schedule->tickets()->whereNotNull('payment_by')->orderBy('seat')->get() )
@php($packages = $departure->packages )
<div style="width: 300px; page-break-before: always">
    <div style="text-align: center; margin-top: 5px">
{{--        <img src="{{ asset('images/logo bw.png') }}" alt="logo" width="120">--}}
        <h2>{{ config('app.name', 'Shuttle') }}</h2>
    </div>
    <br>
    <h2>Manifest</h2>
    <table>
        <tr>
            <td>Nomor</td>
            <td>: {{ $departure->code ?? 'kode' }}</td>
        </tr>
        <tr>
            <td>Rute</td>
            <td>: {{ $departure->departure_point->code ?? 'kode' }} - {{ $departure->arrival_point->code ?? 'kode' }} </td>
        </tr>
        <tr>
            <td>Tanggal/jam</td>
            <td>: {{ $departure->date }} / {{ $departure->time }} </td>
        </tr>
        <tr>
            <td>Sopir</td>
            <td>: {{ $schedule->driver->name ?? '-' }} </td>
        </tr>
        <tr>
            <td>Mobil</td>
            <td>: {{ $schedule->car->code ?? '-' }} {{ $schedule->car->license_number ?? '-' }} </td>
        </tr>
        <tr>
            <td>Kas jalan</td>
            <td>: {{ number_format($schedule->costs ?? 0) }} </td>
        </tr>
        <tr>
            <td>Point Keberangakatan</td>
            <td>: {{ \Illuminate\Support\Facades\Auth::user()->point->name }} </td>
        </tr>
    </table>
    <hr>
    <span>###PENUMPANG###</span>
    <table width="100%">
        <tr style="border-bottom: 1px black solid">
            <td>Kursi</td>
            <td>Penumpang</td>
        </tr>

        @forelse($tickets->whereNotNull('payment_by')->where('departure_point_id', \Illuminate\Support\Facades\Auth::user()->point_id) as $ticket)
            <tr>
                <td>{{ $ticket->seat }}</td>
                <td>{{ $ticket->name }}</td>
            </tr>
            <tr>
                <td></td>
                <td align="right"><small>({{ $ticket->discount_name ?? 'Umum' }})</small> {{ number_format($ticket->price ?? 0) }}</td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td>Kosong</td>
            </tr>
        @endforelse
        <tr>
            <td></td>
            <td align="right"><strong>{{ number_format($tickets->where('departure_point_id', \Illuminate\Support\Facades\Auth::user()->point_id)->sum('price') ?? 0) }}</strong></td>
        </tr>
    </table>

    Resume
    <table>
        @forelse($tickets->where('departure_point_id', \Illuminate\Support\Facades\Auth::user()->point_id)->groupBy('discount_name') as $discount => $val)
            <tr>
                <td>{{ $discount == '' ? 'Umum' : $discount }}</td>
                <td>: {{ $val->count() }}</td>
            </tr>
        @empty
            <tr>
                <td>Kosong</td>
                <td></td>
            </tr>
        @endforelse
    </table>
    <hr>
    <span>###PAKET###</span>
    <table width="100%">
        <tr style="border-bottom: 1px black solid">
            <td>Pengirim</td>
            <td>Paket</td>
        </tr>

        @forelse($packages as $package)
            <tr>
                <td>{{ $package->sender_name }}</td>
                <td>{{ $package->weight }} KG ( {{ $package->piece }} Koli )</td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td>Kosong</td>
            </tr>
        @endforelse
        <tr>
            <td></td>
            <td align="right">
                <strong>
                    {{ $packages->sum('weight') }} KG
                    ( {{ $packages->sum('piece') }} Koli )
                </strong></td>
        </tr>
    </table>

    <hr>
    <br>

    <table width="100%">
        <td align="center">
            CSO<br><br><br>
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
        </td>

        <td align="center">
            Sopir <br><br><br>
            {{ $schedule->driver->name ?? '-' }}
        </td>
    </table>

</div>
</body>
</html>
