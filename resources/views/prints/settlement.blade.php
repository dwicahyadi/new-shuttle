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
<div style="width: 300px; page-break-before: always">
    <div style="text-align: center; margin-top: 5px">
{{--        <img src="{{ asset('images/logo bw.png') }}" alt="logo" width="120">--}}
        <h2>ASIA TRANS</h2>
    </div>
    <br>
    <h2>Settlement</h2>

    <table>
        <tr>
            <td>CSO</td>
            <td>: {{ $settlement->user->name ?? '' }}</td>
        </tr>
        <tr>
            <td>Waktu Settlement</td>
            <td>: {{ $settlement->created_at ?? '' }}</td>
        </tr>
        <tr>
            <td>Jenis Settlement</td>
            <td>: {{ $settlement->type ?? 'tickets' }}</td>
        </tr>
        <tr>
            <td>Amount</td>
            <td>: {{ number_format( $settlement->amount ?? 0) }}</td>
        </tr>
        <tr>
            <td>Note</td>
            <td>: {{ $settlement->note ?? '' }}</td>
        </tr>
    </table>
    <hr>


    <strong>Rincian</strong>

    @if($settlement->type == 'packages')

        @php($transactions = $settlement->packages)
        <table style="width: 100%">
            <tr>
                <th>Point Tujuan</th>
                <th>KG</th>
                <th>Koli</th>
                <th>Amount</th>
            </tr>
            @forelse($transactions->groupBy('departure.arrival_point.name') as $arrival => $data)
                <td>{{ $arrival }}</td>
                <td align="right">{{ number_format($data->sum('weight') ?? 0) }}</td>
                <td align="right">{{ number_format($data->sum('piece') ?? 0) }}</td>
                <td align="right">{{ number_format($data->sum('price') ?? 0) }}</td>
            @empty
                Kosong
            @endforelse
        </table>


    @else
        @php($transactions = $settlement->tickets )
        <table style="width: 100%">
            @foreach($settlement->detail()->groupBy('departure_point_name') as $departure => $data)
                @foreach($data->groupBy('arrival_point_name') as $arrival => $tickets)
                    <tr>
                        <th align="left">{{ $departure}} - {{ $arrival }}</th>
                        <th align="right">{{ number_format($tickets->sum('price'))  }}</th>
                    </tr>
                    @foreach($tickets->groupBy('discount_name') as $discount => $row)
                        <tr>
                            <td style="padding-left: 12px">{{ $discount }} ({{ number_format($row->count('price')) }})</td>
                            <td align="right">{{ number_format($row->sum('price')) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endforeach
        </table>
        <hr>
        <br>
        <strong>Metode Pembayaran</strong>
        <table style="width: 100%">
            @foreach($transactions->groupBy('payment_method') as $method => $trans)
                <tr>
                    <td>{{ $method }}</td>
                    <td align="right">{{ number_format($trans->sum('price')) }}</td>
                </tr>

            @endforeach
        </table>
    @endif





    <br>
    CSO <br><br><br>
    {{ $settlement->user->name ?? '' }}
    <br>
    <small>Dicetak {{ now() }}</small>

</div>
</body>
</html>
