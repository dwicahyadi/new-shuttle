@extends('layouts.app_bu')

@section('content')
    <div class = "container-fluid mt-4">
        <div class = "row">
            <div class = "col-md-2">
                <div class="card mb-2 shadow sticky-top">
                    <div class="card-body p-2">
                        <strong class="card-title text-center">Cari jadwal</strong>
                        @livewire('reservation.schedule-search-form')
                    </div>
                </div>


            </div>

            <div class="col-md-2">
                <div class="card">
                    <div class="card-body p-0">
                        @livewire('reservation.schedule-list')
                    </div>
                </div>
            </div>

            <div class = "col-md-8">
                @livewire('reservation.departure-info-card')
                <div class="row">
                    <div class="col-md-12">


                        <div class="tab-content" id="midSideContent">
                            <div class="tab-pane fade show active" id="tab-seatLayout" role="tabpanel" aria-labelledby="seatLayout">
                                <div class="row">
                                    <div class="col-md-8">
                                        @livewire('reservation.seat-layout')
                                    </div>
                                    <div class="col-md-4">
                                        @livewire('reservation.new-form')
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-packageLayout" role="tabpanel" aria-labelledby="packageLayout">
                                <div class="row">
                                    <div class="col-md-8">
                                        @livewire('reservation.package.package-list')
                                    </div>
                                    <div class="col-md-4">
                                        @livewire('reservation.package.new-form')
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                </div>


            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ResevationDetail" tabindex="-1" role="dialog" aria-labelledby="ResevationDetailLabel" aria-hidden="true">
            @livewire('reservation.modal-dialog', ['reservation_id' => 0], key('modal-dialog'))
        </div>
        <div class="modal fade" id="ScheduleDetail" tabindex="-1" role="dialog" aria-labelledby="ScheduleDetailLabel" aria-hidden="true">
            @livewire('reservation.modal-schedule', ['schedule_id' => 0], key('modal-schedule'))
        </div>

    </div>

@endsection
