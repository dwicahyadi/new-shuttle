<div>
    <form class="p-2" wire:submit.prevent="search">
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" wire:model.lazy="date" class="form-control form-control-sm">
            @error('date')<br>{{ $message }}@enderror
        </div>

        <div class="form-group">
            <label>Point Keberangkatan</label>
            <select class="form-control form-control-sm" wire:model.lazy="departurePointId">
                <option value="">Berangkat dari</option>
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

        <div class="form-group">
            <label>Point Keberangkatan</label>
            <select class="form-control form-control-sm" wire:model.lazy="arrivalPointId">
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

        <div class="form-group d-flex">
            <button type="submit" class="btn btn-primary flex-fill"><i class="mdi mdi-calendar-search"></i> Cari</button>
            <button type="submit" class="btn btn-light"><i class="mdi mdi-find-replace"></i></button>
        </div>
    </form>
</div>
