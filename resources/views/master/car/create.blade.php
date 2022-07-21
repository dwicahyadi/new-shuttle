@extends('layouts.app_bu')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm-6 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Master Mobil</h3>
                        <h6 class="font-weight-normal mb-2">Form Penmbahan Mobil Baru</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row stretch-card">
            <div class="col-lg-6 grid-margin">
                @livewire('master.car.form')
            </div>
        </div>
    </div>
@endsection
