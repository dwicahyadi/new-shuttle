@extends('layouts.app_bu')

@section('content')
<div class="container mt-t">
    <br>
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Dashboard</h3>
                    <form method="get" class="d-flex">
                        @php($month = $_GET['month'] ?? date('m'))
                        @php($year = $_GET['year'] ?? date('Y'))
                        <select name="month" class="form-control">
                            @for($i = 1; $i <= 12; $i++)
                                <option @if($month == $i) selected @endif value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                            @endfor
                        </select>
                        <select name="year" class="form-control">
                            @for($i = date('Y'); $i >= date('Y')-3; $i--)
                                <option @if($year == $i) selected @endif value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                        <button type="submit" class="mx-4 btn btn-primary")>Tampilkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            @livewire('dashboard.customer-stat',['month'=>$month, 'year'=>$year])

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
