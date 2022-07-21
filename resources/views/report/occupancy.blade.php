@extends('layouts.app_bu')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm-6 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Laporan. <small>Rekap Okupansi</small></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <h4>Filter</h4>
                @livewire('report.filter-form')
            </div>
        </div>

        <div class="shadow">
            @livewire('report.occupancy')
        </div>





    </div>
@endsection
