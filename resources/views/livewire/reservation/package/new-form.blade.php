<div>
    @if($departure)
        <div class="card">
            <div class="card-body">
                <h4>Paket Baru</h4>
                <form onsubmit="return false">
                    <div class="form-group">
                        <label> Point</label>
                        <select class="form-control form-control-sm" wire:model="departure_point_id">
                            @php($points = $departure->city->points ?? $departure->departure_point->city->points)
                            @foreach($points as $point)
                                <option value="{{ $point->id }}">{{ $point->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Pengirim</label>
                        <input type="text" wire:model="sender_name" placeholder="nomor pengeirim" class="form-control form-control-sm mb-2" required>
                        <input type="text" wire:model="sender_phone" placeholder="nama pengeirim" class="form-control form-control-sm mb-2" required>
                    </div>

                    <div class="form-group">
                        <label> Penerima</label>
                        <input type="text" wire:model="receiver_name" placeholder="nomor penerima" class="form-control form-control-sm mb-2" required>
                        <input type="text" wire:model="receiver_phone" placeholder="nama penerima" class="form-control form-control-sm mb-2" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Berat</label>
                                <input type="number" class="form-control form-control-sm mb-2" wire:model="weight" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Jumlah Koli</label>
                                <input type="number" wire:model="piece" class="form-control form-control-sm mb-2" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label> Jenis</label>
                        <input type="text" id="package-type" list="package-types" wire:model="type" class="form-control form-control-sm mb-2" required>
                        <datalist id="package-types"></datalist>
                    </div>

                    <div class="form-group">
                        <label> Isi</label>
                        <input type="text" wire:model="content" class="form-control form-control-sm mb-2" required>
                    </div>

                    <div class="alert alert-info p-2 text-center">
                        <span>Total</span>
                        <h4>Rp.{{ number_format($total) }}</h4>
                    </div>

                    <div class="form-group text-right">
                        <button type="button" class="btn btn-primary" onclick="confirm('Konfirmasi Pembayaran Paket?') || event.stopImmediatePropagation()" wire:click="save">Bayar</button>
                    </div>type
                </form>
            </div>
        </div>
        @endif

</div>
