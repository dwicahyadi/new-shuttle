@extends('layouts.app_bu')

@section('content')
    <div class = "container-fluid mt-4">
        <div class = "row">
            <div class = "col-md-2">
                <div class="card">
                    <div class="card-header p-0">
                        <ul class="nav nav-tabs nav-justified sticky-top" id="leftSide" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="scheduleSearch" data-toggle="tab" href="#tab-scheduleSearch" role="tab" aria-controls="tab-scheduleSearch" aria-selected="true" title="Cari Jadwal Keberangakatan"><i class="mdi mdi-calendar-search mdi-24px"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reservationSearch" data-toggle="tab" href="#tab-reservationSearch" role="tab" aria-controls="tab-reservationSearch" aria-selected="false" title="Cari Pelanggan"><i class="mdi  mdi-account-search-outline mdi-24px"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-contact-tab" data-toggle="tab" href="#tabs-contact" role="tab" aria-controls="tabs-contact" aria-selected="false"  title="Cari Paket"><i class="mdi mdi-briefcase-search-outline mdi-24px"></i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-2">
                        <div class="tab-content" id="leftSideContent">
                            <div class="tab-pane fade show active" id="tab-scheduleSearch" role="tabpanel" aria-labelledby="scheduleSearch">
                                @livewire('reservation.schedule-search-form')
                                @livewire('reservation.schedule-list')
                            </div>
                            <div class="tab-pane fade" id="tab-reservationSearch" role="tabpanel" aria-labelledby="reservationSearch">
                                @livewire('reservation.ticket-search-form')
                            </div>
                            <div class="tab-pane fade" id="tabs-contact" role="tabpanel" aria-labelledby="tabs-contact-tab">ini 3</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class = "col-md-10">
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
