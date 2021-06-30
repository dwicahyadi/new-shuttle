<div>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="save">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('message') }}

                    </div>
                @endif

                @if($customer_id)
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" wire:model="customer_id" class="form-control" readonly>
                        </div>
                    @endif

                <div class="form-group">
                    <label>No handphone</label>
                    <input type="text" wire:model="phone" class="form-control"  required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" wire:model="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" wire:model="address" class="form-control" required>
                </div>
                    @if($customer_id)
                        <div class="form-group">
                            <label>Jml Reservasi</label>
                            <input type="number" wire:model="count_reservation" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jml Reservasi Lunas</label>
                            <input type="number" wire:model="count_reservation_finished" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Pelanggan Setia</label>
                            <select type="number" wire:model="member" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    @endif

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
