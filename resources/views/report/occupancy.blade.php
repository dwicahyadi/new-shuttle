@extends('layouts.app_bu')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-6 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Laporan. <small>Okupansi</small></h3>
                        <h6 class="font-weight-normal mb-2">Laporan okpansi periode tertentu</h6>
                    </div>
                </div>
            </div>
        </div>

        @livewire('report.occupancy')

    </div>
@endsection
