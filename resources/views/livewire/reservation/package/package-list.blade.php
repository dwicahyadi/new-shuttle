<div>
    @if($departure)
        <ul class="list-group">
            @forelse($packages as $package)
                <li class="list-group-item">
                    <div class="d-flex align-items-center">
                        <div class="p-2">
                            <i class="fa fa-gifts fa-3x text-primary"></i>
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
                        </div>
                    </div>

                </li>
            @empty

            @endforelse
        </ul>
    @endif()
</div>
