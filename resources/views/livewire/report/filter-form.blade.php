<div>
    <form method="get" class="">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Dari Tanggal</label>
                    <input type="date" class="form-control" name="from_date" value="{{ request('from_date') ?? now()->format('Y-m-d') }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input type="date" class="form-control" name="to_date" value="{{ request('to_date') ?? now()->format('Y-m-d') }}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Asal</label>
                    <select class="form-control" name="departure_point_id">
                        <option value="">Semua</option>
                        @forelse($cities as $city)
                            <optgroup label="{{$city->name}}">
                                @forelse($city->points as $point)
                                    <option @if(request('departure_point_id') == $point->id) selected @endif value="{{$point->id}}"> {{$point->name}}</option>
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
                    <label>Tujuan</label>
                    <select class="form-control" name="arrival_point_id">
                        <option value="">Semua</option>
                        @forelse($cities as $city)
                            <optgroup label="{{$city->name}}">
                                @forelse($city->points as $point)
                                    <option @if(request('arrival_point_id') == $point->id) selected @endif value="{{$point->id}}"> {{$point->name}}</option>
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
                    <br>
                    <input type="submit" class="btn btn-primary">
                </div>

            </div>
        </div>
    </form>
</div>
