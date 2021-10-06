<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <style>
        html *
        {
            font-family: "Karla", sans-serif;
        }
    </style>
    <title>Cetak Resi Paket</title>
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
        <h2>{{ config('app.name', 'Shuttle') }}</h2>
    </div>
    <br>
    <div style="border: 1px black solid; padding: 5px; text-align: center">
        <h4>{{ $package->departure_point->name ?? '' }}</h4>
        <small>PKT{{ \Illuminate\Support\Str::padLeft($package->id,'6','0') }}</small>
    </div>
    <div>
        <small>Pengirim</small><br>
        <strong>{{ $package->sender_phone }}</strong> / <strong>{{ $package->sender_name }}</strong>
    </div>
    <div>
        <small>Penerima</small><br>
        <strong>{{ $package->receiver_phone }}</strong> / <strong>{{ $package->receiver_name }}</strong>
    </div>
    <div>
        <small> Berat/Jumlah</small> <br>
        <strong>{{ $package->weight }} KG</strong> / <strong>{{ $package->piece }} Koli</strong>
    </div>
    <div>
        <small> Jenis/Isi</small> <br>
        <strong>{{ $package->type }}</strong> <br> <strong>{{ $package->content }}</strong>
    </div>
    <hr>
    <div style="text-align: center; margin-bottom: 1em">
        <h4>{{ number_format($package->price) }}</h4>
        <img src="{{ asset('images/whatsapp.svg') }}" alt="wa" width="16">&nbsp;0877 2020 7999<br>
{{--        <img src="{{ asset('images/instagram-sketched.svg') }}" alt="wa" width="16">&nbsp;@suryashuttle--}}
    </div>
    <hr style="border-top: 1px dashed black">
    <small>*untuk paket</small>
    <div style="border: 1px black solid; padding: 5px; text-align: center">
        <h4>{{ $package->departure_point->name ?? '' }}</h4>
        <small>PKT{{ \Illuminate\Support\Str::padLeft($package->id,'6','0') }}</small>
    </div>
    <div>
        <small>Pengirim</small><br>
        <strong>{{ $package->sender_phone }}</strong> / <strong>{{ $package->sender_name }}</strong>
    </div>
    <div>
        <small>Penerima</small><br>
        <strong>{{ $package->receiver_phone }}</strong> / <strong>{{ $package->receiver_name }}</strong>
    </div>
    <div>
        <small> Berat/Jumlah</small> <br>
        <strong>{{ $package->weight }} KG</strong> / <strong>{{ $package->piece }} Koli</strong>
    </div>
    <br><br>
    <table width="100%">
        <tr>
            <td align="center">CSO Asal <br><br><br>________</td>
            <td align="center">CSO Tujuan <br><br><br>________</td>
            <td align="center">Penerima <br><br><br>________</td>
        </tr>
    </table>
    <br>
</div>
</body>
</html>
