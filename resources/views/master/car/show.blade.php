@extends('layouts.app_bu')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm-6 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Master Mobil. <small>Detail Mobil</small></h3>
                        <h6 class="font-weight-normal mb-2">Infoermasi lengkap mengenai Mobil</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="car-info-tab" data-toggle="tab" href="#car-info" role="tab" aria-controls="car-info" aria-selected="true">Mobil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="maintenance-tab" data-toggle="tab" href="#maintenance" role="tab" aria-controls="maintenance" aria-selected="false">Perawatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">Riwayat</a>
                    </li>

                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-2" id="car-info" role="tabpanel" aria-labelledby="car-info-tab">

                        @livewire('master.car.form',['id'=>request('id')])
                    </div>
                    <div class="tab-pane fade" id="maintenance" role="tabpanel" aria-labelledby="maintenance-tab">
                        <div class="row">
                            <div class="col-md-4">
                                @livewire('master.car.maintenance-form', ['car_id'=>request('id')])
                            </div>
                            <div class="col-md-8">
                                @livewire('master.car.maintenance-table', ['car_id'=>request('id')])
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                        @livewire('master.car.statistic',['car_id'=>request('id')])
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
