<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link text-center" href="{{ route('home') }}">
            <img src="{{ asset('images/icons/home-run.svg') }}" alt="home" width="24px" class="d-block align-content-center">
            <span>Beranda</span>
        </a>
    </li>
    @can('Setting')
        <li class="nav-item dropdown text-center">
            <a class="nav-link dropdown-toggle" href="#" id="masterMenu" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('images/icons/gear.svg') }}" alt="home" width="24px" class="d-block align-content-center">
                <span>Master</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="masterMenu">
                <a class="dropdown-item" href="{{ route('master.car.index') }}">Mobil</a>
                <a class="dropdown-item" href="{{ route('master.discount.index') }}">Discount</a>
                <a class="dropdown-item" href="{{ route('master.customer.index') }}">Pelanggan</a>
                <a class="dropdown-divider"></a>
                <a class="dropdown-item" href="{{ route('master.permissions.index') }}">Perizinan System</a>
            </div>
        </li>
    @endcan


    @can('Schedule')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="scheduleMenu" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('images/icons/calendar_clock.svg') }}" alt="home" width="24px" class="d-block align-content-center">
                <span>Jadwal</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="scheduleMenu">
                <a class="dropdown-item" href="{{ route('schedule.create') }}">Buka Jadwal</a>
                <a class="dropdown-item" href="{{ route('schedule.manage') }}">Kelola Jadwal</a>
            </div>
        </li>
    @endcan



    @can('Reservation')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('reservation') }}">
                <img src="{{ asset('images/icons/receptionist.svg') }}" alt="home" width="24px" class="d-block align-content-center">
                <span>Reservasi</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="historyMenu" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('images/icons/receipt.svg') }}" alt="home" width="24px" class="d-block align-content-center">
                <span>Riwayat</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="historyMenu">
                <a class="dropdown-item" href="{{ route('history.settlement') }}">Settlement</a>
            </div>
        </li>
    @endcan

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="financeMenu" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('images/icons/document.svg') }}" alt="home" width="24px" class="d-block align-content-center">
            <span>Keuangan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="financeMenu">
            <a class="dropdown-item" href="{{ route('finance.ledger') }}">Buku Besar</a>
            <a class="dropdown-item" href="{{ route('finance.income') }}">Input Pemasukan</a>
            <a class="dropdown-item" href="{{ route('finance.expense') }}">Input Biaya</a>
        </div>
    </li>

    @can('Report')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="reportMenu" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('images/icons/document.svg') }}" alt="home" width="24px" class="d-block align-content-center">
                <span>Laporan</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="reportMenu">
                <a class="dropdown-item" href="{{ route('report.per_point') }}">Laporan Per Point</a>
                <a class="dropdown-item" href="{{ route('report.per-route') }}">Laporan Per Jurusan</a>
                <a class="dropdown-item" href="{{ route('report.ticket-detail') }}">Laporan Detail Penjualan Tiket</a>
                <a class="dropdown-item" href="{{ route('report.occupancy') }}">Lpaoran Okupansi per Jadwal</a>
                <a class="dropdown-item" href="{{ route('report.operational_cost') }}">Laporan BOP</a>
                <a class="dropdown-item" href="{{ route('report.package-detail') }}">Laporan Detail Penjualan Paket</a>
                <a class="dropdown-item" href="{{ route('report.settlement') }}">Laporan Settlement</a>
            </div>
        </li>
    @endcan


</ul>
