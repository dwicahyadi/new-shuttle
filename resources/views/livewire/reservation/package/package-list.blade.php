<div>
    @if($departure)
        <ul class="list-group">
            @forelse($packages as $package)
                <li class="list-group-item">
                    <div class="d-flex align-items-center">
                        <div class="p-2">
                            <img src="{{ asset('images/icons/box.svg') }}" alt="box" width="64px">
                        </div>
                        <div class="p-2 flex-fill">
                            <span class="text-info clearfix">{{ $package->departure_point->name ?? '' }}</span>
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
                            <br>
                            <button class="btn btn-outline-dark btn-sm" onclick="window.open('{{ route('print.package', ['package'=> $package]) }}', '', 'width=500,height=500')"><i class="fa fa-print"></i></button>
                        </div>
                    </div>

                </li>
            @empty
                <div class="text-center p-4 text-muted">
                    <img src="{{ asset('images/icons/box.svg') }}" alt="box" class="w-25 mt-4 text-muted">
                    <h4>Tidak ada paket...</h4>
                </div>
            @endforelse
        </ul>
    @endif()
</div>
