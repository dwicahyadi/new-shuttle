<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row">


        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body @if($step >= 0) bg-info text-white @endif ">
                                    <strong><i class="fa fa-map-marker-alt"></i> 1. Tentukan Point </strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body @if($step > 0) bg-info text-white @endif">
                                    <strong><i class="fa fa-calendar-plus"></i> 2. Tentukan Tanggal dan Waktu </strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body @if($step > 1) bg-info text-white @endif">
                                    <strong><i class="fa fa-check-circle"></i> 3. Konfirmasi </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form id="formWizard" wire:submit.prevent="save">
                        <div style="display: {{$step === 0 ? 'inline' : 'none'}}">
                            <section class="">
                                <h5>Step 1. Tentukan Point</h5>
                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissible animate__animated animate__bounceIn fade" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        {{ session('message') }}

                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Berangkat dari</label>
                                    <select class="form-control" wire:model="departurePointId" wire:change="setDeparturePoint">
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

                                <hr>
                                <div class="form-group">
                                    <label>Jumlah Kursi</label>
                                    <input type="number" class="form-control"wire:model="seats">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Harga Tiket</label>
                                    <input type="number" class="form-control" wire:model="price">
                                </div>
                            </section>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-lg btn-primary" wire:click="nextStep">Selanjutnya</button>
                            </div>

                        </div>

                        <div style="display: {{$step === 1 ? 'inline' : 'none'}}">
                            <section class="">
                                <h5>Step 2. Tentukan Tanggal dan Jam Keberangkatan</h5>

                                <div class="form-group">
                                    <label>Dari Tanggal</label>
                                    <input type="date" class="form-control" wire:model="fromDate">
                                </div>
                                <div class="form-group">
                                    <label>Sampai Tanggal</label>
                                    <input type="date" class="form-control" wire:model="toDate">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Jam Keberangkatan (Format 24 jam)</label>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" placeholder="Jam" wire:model="newHour" min="0" max="24">
                                            @error('newHour') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control" placeholder="Menit" wire:model="newMinute" min="0" max="60">
                                            @error('newMinute') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-primary btn-lg" wire:click="addDepartureTime">Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <table class="table">
                                    @forelse($departureTimes as $key => $departureTime)
                                        <tr>
                                            <td>{{$departureTime}}</td>
                                            <td><button type="button" class="btn btn-sm btn-danger" wire:click="removeDepartureTime({{$key}})"><i class="far fa-window-close"></i></button></td>
                                        </tr>
                                    @empty
                                        <span class="text-muted">Belum ada jam keberangkatan</span>
                                    @endforelse
                                </table>


                            </section>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-lg btn-primary" wire:click="previousStep">Sebelumnya</button>
                                <button type="button" class="btn btn-lg btn-primary" wire:click="nextStep">Selanjutnya</button>
                            </div>

                        </div>

                        <div style="display: {{$step === 2 ? 'inline' : 'none'}}">
                            <section class="">
                                <h5>Step 3. Konfirmasi</h5>

                                <p>Pembuatan jadwal untuk Jurusan <strong>{{$departurePoint->name ?? ''}}- {{$arrivalPoint->name ?? ''}}</strong></p>
                                <p>Jumlah kursi dibuka per jadwal <strong>{{$seats}} Seat @Rp. {{number_format($price)}}</strong></p>
                                <p>jadwal dibuka untuk tanggal <strong>{{$fromDate}} s.d {{$toDate}}</strong></p>
                                <p>Jam keberangkatan
                                <ul>
                                    @forelse($departureTimes as $key => $departureTime)
                                        <li>{{$departureTime}}</li>
                                    @empty
                                        <li><span class="text-muted">Belum ada jam keberangkatan</span></li>
                                    @endforelse
                                </ul>
                                </p>
                            </section>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-lg btn-primary" wire:click="previousStep">Sebelumnya</button>
                                <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
