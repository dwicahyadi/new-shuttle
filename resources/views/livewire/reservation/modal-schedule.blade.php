<div>
    @if($schedule)
        <div class="modal-dialog modal-lg" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ResevationDetailLabel">Jadwal #{{$schedule->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="return false">
                        @if (session()->has('message'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('message') }}

                            </div>
                        @endif

                        <div class="form-group">
                            <label>Mobil</label>
                            <select class="form-control" wire:model="car_id">
                                <option value="">Pilih ..</option>
                                @forelse($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->code}} Nopol.{{ $car->license_number }}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Sopir</label>
                            <select class="form-control" wire:model="driver_id">
                                <option value="">Pilih ..</option>
                                @forelse($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kas Jalan</label>
                            <select class="form-control" wire:model="costs">
                                @foreach($listCosts as $costs_)
                                    <option value="{{$costs_}}">Rp. {{ number_format($costs_) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <button type="submit" wire:click="save" class="btn btn-primary btn-lg">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ResevationDetailLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    @endif


</div>
