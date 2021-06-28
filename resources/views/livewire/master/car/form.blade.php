<div>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="save">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible animate__animated animate__bounceIn fade" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span>Close</span>
                        </button>
                        {{ session('message') }}

                    </div>
                @endif

                @if($car_id)
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" wire:model="car_id" class="form-control">
                        </div>
                    @endif

                <div class="form-group">
                    <label>Kode Unit</label>
                    <input type="text" wire:model="code" class="form-control" maxlength="10" required placeholder="Kode Unit">
                    <small id="helpId" class="text-muted">Maksimal 10 huruf {{ $code }}</small>
                </div>
                <div class="form-group">
                    <label>Nomor Polisi</label>
                    <input type="text" wire:model="license_number" class="form-control" required placeholder="Nomor Polisi">
                </div>
                <div class="form-group">
                    <label>Kilometer Terakhir</label>
                    <input type="number" wire:model="kilometers" class="form-control" required placeholder="Kilometer Terakhir">
                </div>
                <div class="form-group d-flex justify-content-between">
                   <div>
                       <button type="submit" class="btn btn-primary">Simpan</button>
                   </div>
                    <a href="{{ route('master.car.index') }}" class="btn btn-outline-inverse-light">Kemabli</a>
                </div>
            </form>
        </div>
    </div>

</div>
