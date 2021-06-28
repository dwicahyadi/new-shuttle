@extends('layouts.app_bu')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Buku Besar Keuangan. <small>Input Biasya</small></h3>
                        <h6 class="font-weight-normal mb-2">Input biaya dan pengeluaran selain BOP</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin">
                @livewire('finance.cash.expense')
            </div>
        </div>
    </div>
@endsection
