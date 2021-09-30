<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/html2canvas.min.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .clickable{
            cursor: pointer;
        }

        .seat-card{
        cursor: pointer;
        }

    </style>
    @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest()

                    @else
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="masterMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Master
                            </a>
                            <div class="dropdown-menu" aria-labelledby="masterMenu">
                                <a class="dropdown-item" href="{{ route('master.car.index') }}">Mobil</a>
                                <a class="dropdown-item" href="{{ route('master.customer.index') }}">Pelanggan</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="scheduleMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Jadwal
                            </a>
                            <div class="dropdown-menu" aria-labelledby="scheduleMenu">
                                <a class="dropdown-item" href="{{ route('schedule.create') }}">Buka Jadwal</a>
                                <a class="dropdown-item" href="{{ route('schedule.manage') }}">Kelola Jadwal</a>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservation') }}">Reservasi</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="historyMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Riwayat
                            </a>
                            <div class="dropdown-menu" aria-labelledby="historyMenu">
                                <a class="dropdown-item" href="{{ route('history.settlement') }}">Settlement</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="financeMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Keuangan
                            </a>
                            <div class="dropdown-menu" aria-labelledby="financeMenu">
                                <a class="dropdown-item" href="{{ route('finance.ledger') }}">Buku Besar</a>
                                <a class="dropdown-item" href="{{ route('finance.income') }}">Input Pemasukan</a>
                                <a class="dropdown-item" href="{{ route('finance.expense') }}">Input Biaya</a>
                            </div>
                        </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="reportMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Laporan
                                </a>
                                <div class="dropdown-menu" aria-labelledby="reportMenu">
                                    <a class="dropdown-item" href="{{ route('report.ticket') }}">Penjualan Tiket</a>
                                    <a class="dropdown-item" href="{{ route('report.package') }}">Penjualan Paket</a>
                                    <a class="dropdown-item" href="{{ route('report.income_statement') }}">Pendapatan</a>
                                    <a class="dropdown-item" href="{{ route('report.occupancy') }}">Okupansi</a>
                                    <a class="dropdown-item" href="{{ route('report.settlement') }}">Settlement</a>
                                    <a class="dropdown-item" href="{{ route('report.operational_cost') }}">BOP</a>
                                </div>
                            </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/">Pengaturan</a>
                        </li>

                    </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" title="Settlement Tiket" href="{{ route('settlement.ticket') }}">@livewire('partial.bill-info')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" title="Settlement Paket" href="{{ route('settlement.package') }}">@livewire('partial.package-bill-info')</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>
</html>
