@extends('layouts.app_bu')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-6 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Master Mobil</h3>
                        <h6 class="font-weight-normal mb-2">Kelola mobil</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="d-flex align-items-center justify-content-md-end">
                    <div class="pr-1 mb-3 mb-xl-0">
                        <a href="{{ route('master.car.create') }}" class="btn btn-primary">
                            Tambah Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row stretch-card">
            <div class="col-lg-12 grid-margin">
                @livewire('master.car.table')
            </div>
        </div>
    </div>
@endsection
