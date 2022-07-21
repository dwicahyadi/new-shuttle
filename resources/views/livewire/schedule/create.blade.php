<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <form id="formWizard" wire:submit.prevent="save">
        <div class="card card-body mb-2">
            <strong class="card-title">Tentukan tanggal</strong>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="date" class="form-control" wire:model="fromDate">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" class="form-control" wire:model="toDate">
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body">
            <strong class="card-title">Tentukan Jadwal</strong>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Tujuan</label>
                        <select class="form-control" wire:model="arrivalPointId" wire:change="setArrivalPoint">
                            <option value="">Tujuan</option>
                            @forelse($cities as $city)
                                <optgroup label="[{{$city->code}}] {{$city->name}}">
                                    @forelse($city->points as $point)
                                        <option value="{{$point->id}}">[{{$point->code}}] {{$point->name}}</option>
                                    @empty

                                    @endforelse
                                </optgroup>
                            @empty

                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Jumlah Kursi</label>
                        <input type="number" class="form-control"wire:model="seats">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Harga Tiket</label>
                        <input type="number" class="form-control" wire:model="price">
                    </div>
                </div>
            </div>


            <table class="table">
                <tr>
                    <th>Point Kebrangkatan</th>
                    <th>Jam Keberangkatan</th>
                    <th>Hapus</th>
                </tr>
                @forelse($departureTimes as $key => $departureTime)
                    <tr>
                        <td>{{$departureTime['point_name']}}</td>
                        <td>{{$departureTime['time']}}</td>
                        <td><button type="button" class="btn btn-sm btn-danger" wire:click="removeDepartureTime({{$key}})"><i class="far fa-window-close"></i></button></td>
                    </tr>
                @empty
                    <span class="text-muted">Belum ada jam keberangkatan</span>
                @endforelse
            </table>

            @if($is_add)
                <div class="row p-2 bg-info">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Berangkat dari</label>
                            <select class="form-control" wire:model="departurePointId" wire:change="setDeparturePoint">
                                <option value="">Berangkat dari</option>
                                @forelse($departurePointList as $point)
                                    <option value="{{$point->id}}">[{{$point->code}}] {{$point->name}}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jam Keberangkatan (Format 24 jam)</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="number" class="form-control" placeholder="Jam" wire:model="newHour" min="0" max="24">
                                    @error('newHour') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" placeholder="Menit" wire:model="newMinute" min="0" max="60">
                                    @error('newMinute') <span class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary btn-lg" wire:click="addDepartureTime">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <button class="btn btn-primary py-2" wire:click="$set('is_add',true)" type="button">Tambah keberangkatan</button>
            @endif
        </div>

        <button type="submit" class="btn btn-lg btn-primary">Simpan</button>

    </form>
</div>
