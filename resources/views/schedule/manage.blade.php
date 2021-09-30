@extends('layouts.app_bu')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-6 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Kelola Jadwal</h3>
                        <h6 class="font-weight-normal mb-2">Pilih jadwal yang akan dikelola</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <strong>Pilih Jadwal</strong>
                        @livewire('reservation.schedule-search-form')
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                @livewire('schedule.schedule-list')
            </div>
        </div>

    </div>
@endsection
