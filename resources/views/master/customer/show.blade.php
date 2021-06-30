@extends('layouts.app_bu')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-6 mb-4 mb-xl-0">
                <div class="d-lg-flex align-items-center">
                    <div>
                        <h3 class="text-dark font-weight-bold mb-2">Master Pelanggan. <small>Detail Pelanggan</small></h3>
                        <h6 class="font-weight-normal mb-2">Informasi lengkap mengenai Pelanggan</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header p-0">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="customer-info-tab" data-toggle="tab" href="#customer-info" role="tab" aria-controls="customer-info" aria-selected="true">Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tickets-tab" data-toggle="tab" href="#tickets" role="tab" aria-controls="tickets" aria-selected="false">Tiket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="packages-tab" data-toggle="tab" href="#packages" role="tab" aria-controls="packages" aria-selected="false">Paket</a>
                    </li>

                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-2" id="customer-info" role="tabpanel" aria-labelledby="customer-info-tab">

                        @livewire('master.customer.form',['id'=>request('id')])
                    </div>
                    <div class="tab-pane fade" id="tickets" role="tabpanel" aria-labelledby="tickets-tab">
                        <p>Menampilkan tiket berdsarkan nomor telepon pelanggan</p>
                        <div class="row">
                            <div class="col-md-8">
                                @forelse($customer->tickets as $ticket)
                                    <li class="list-group-item d-flex align-items-center     ">
                                        <div class="mr-2">
                                            <small class="clearfix">Seat {{ $ticket->seat }}</small>
                                            <img
                                                class="rounded mr-2"
                                                src="https://ui-avatars.com/api/?size=32&background=0D8ABC&color=FFF&name={{ $ticket->discount_name ?? 'UMUM' }}"
                                                alt="{{ $ticket->discount_name ?? 'UMUM' }}">
                                        </div>
                                        <div class="flex-fill">
                                            <small>{{ $ticket->date }} {{ $ticket->departure->time }}</small><br>
                                            <small>{{ $ticket->departure->departure_point->city->name }} {{ $ticket->departure->departure_point->name }}</small> -
                                            <small>{{ $ticket->departure->arrival_point->name }} {{ $ticket->departure->arrival_point->name }}</small><br>
                                            <span>{{ $ticket->name }}</span> /
                                            <span>{{ $ticket->phone }}</span>
                                        </div>
                                        <div class="text-right">
                                            <strong>Rp. {{ number_format($ticket->price) }}</strong><br>
                                            @if($ticket->status == 'cancel')
                                                <span class="badge badge-danger">{{ $ticket->status }}</span>
                                            @elseif($ticket->status == 'paid')
                                                <span class="badge badge-success">{{ $ticket->status }}</span>
                                            @else
                                                <span class="badge badge-secondary">{{ $ticket->status }}</span>
                                            @endif
                                        </div>
                                    </li>
                                @empty
                                    <li>Empty</li>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="packages" role="tabpanel" aria-labelledby="packages-tab">
                        <p>Menampilkan paket yang fikirim berdsarkan nomor telepon pengirim</p>
                        <div class="row">
                            <div class="col-md-8">
                                <ul class="list-group" id="packages">
                                    @forelse($customer->packages as $package)
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <div class="p-2 flex-fill">
                                                    <small>{{ $package->departure->date }} {{ $package->departure->time }}</small><br>
                                                    <small>{{ $package->departure->departure_point->city->name }} {{ $package->departure->departure_point->name }}</small> -
                                                    <small>{{ $package->departure->arrival_point->name }} {{ $package->departure->arrival_point->name }}</small><br>
                                                    <small> Pengirim</small> <br>
                                                    <span>{{ $package->sender_phone }}</span> / <span>{{ $package->sender_name }}</span>
                                                    <br>

                                                    <small> Penerima</small> <br>
                                                    <span>{{ $package->receiver_phone }}</span> / <span>{{ $package->receiver_name }}</span>
                                                </div>
                                                <div class="p-2 flex-fill">
                                                    <small> Berat/Jumlah</small> <br>
                                                    <span>{{ $package->weight }} KG</span> / <span>{{ $package->piece }} Koli</span>
                                                    <br>

                                                    <small> Jenis/Isi</small> <br>
                                                    <span>{{ $package->type }}</span> <br> <span>{{ $package->content }}</span>
                                                </div>
                                                <div class="p-2 text-right">
                                                    <strong>Rp. {{ number_format($package->price) }}</strong>
                                                </div>
                                            </div>

                                        </li>
                                    @empty
                                        <li class="list-group-item">Empty</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
