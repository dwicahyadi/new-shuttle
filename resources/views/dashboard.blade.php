@extends('layouts.app_bu')

@section('content')
<div class="container mt-t">
    <!-- List group -->
    <div class="nav nav-pills mt-4" id="myList" role="tablist">
        <a class="nav-link active" data-toggle="list" href="#tickets" role="tab">Dashboard Penumpang</a>
        <a class="nav-link" data-toggle="tab" href="#packages" role="tab">Dashboard Paket</a>
        <a class="nav-link" data-toggle="tab" href="#finance" role="tab">Dashboard Keuangan</a>
        <a class="nav-link" data-toggle="tab" href="#operation" role="tab">Dashboard Mobil & Sopir</a>
        <a class="nav-link" data-toggle="tab" href="#cso" role="tab">Dashboard CSO</a>
        <a class="nav-link" data-toggle="tab" href="#sms" role="tab">Dashboard SMS</a>
    </div>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tickets" role="tabpanel">
            <div class="row mt-2">
                <div class="col-md-3">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Penumpang Bulan Berjalan</strong>
                        </card>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Penumpang Baru</strong>
                        </card>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Pelanggan Setia</strong>
                        </card>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Semua Penumpang</strong>
                        </card>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Trend Penumpang (30 hari)</strong>
                        </card>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Trend Penumpang Per Bulan</strong>
                        </card>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Trend Penumpang Per Point</strong>
                        </card>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Penumpang Berdasarkan Asal dan Tujuan</strong>
                        </card>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="packages" role="tabpanel">

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Trend Paket (30 hari)</strong>
                        </card>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Trend Paket Per Bulan</strong>
                        </card>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Trend Paket Per Point</strong>
                        </card>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Paket Berdasarkan Asal dan Tujuan</strong>
                        </card>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade mb-2" id="finance" role="tabpanel">
            @livewire('finance.stat-cards')
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Pemasukan</strong>
                        </card>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Biaya/Pengeluaran</strong>
                        </card>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">Trend Pemasukan vs Biaya</strong>
                        </card>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="operation" role="tabpanel">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">BOP dan Ritase (Sopir)</strong>
                        </card>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="cso" role="tabpanel">
            <div class="row mt-2">
                <div class="col-md-3">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">CSO Ranking</strong>
                        </card>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="sms" role="tabpanel">
            <div class="row mt-2">
                <div class="col-md-3">
                    <div class="card">
                        <card class="card-body">
                            <strong class="card-title">SMS Balnce</strong>
                        </card>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
