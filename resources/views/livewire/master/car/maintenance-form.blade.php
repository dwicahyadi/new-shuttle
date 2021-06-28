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
                <div class="form-group">
                    <label>Mobil</label><br>
                    <strong>{{ $car->code }} / {{ $car->license_number }}</strong>

                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" wire:model="date" class="form-control" required >
                    @error('date') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Catatan Servis/Perbaikan</label>
                    <textarea wire:model="note" class="form-control" required></textarea>
                    @error('note') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label>Jadwal Perawatan Berikutnya</label>
                    <input type="date" wire:model="next_maintenance_date" class="form-control" required >
                    @error('next_maintenance_date') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
