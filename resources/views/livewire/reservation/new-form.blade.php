<div>
    @if($departure && !$departure->get_time_diff()->isPast())
        <div class="card grid-margin mb-2">
            <div class="card-body">
                <h4 class="card-title mb-2">Data Pemesan</h4>
                @livewire('reservation.customer-search-form')
            </div>
        </div>
        @if($customer)
            <div class="card grid-margin mb-2">
                <div class="card-body">
                    <h4 class="card-title mb-2">Reservasi Baru</h4>
                    <form action="">
                        @csrf
                        {{--<div class="form-group">
                            <label>Point Keberangakatan</label>
                            <select class="form-control form-control-sm" wire:model="ticketDeparturePointId">
                                @php($points = $departure->city->points ?? $departure->departure_point->city->points)
                                @foreach($points as $point)
                                    <option value="{{ $point->id }}">{{ $point->name }}</option>
                                @endforeach
                            </select>
--}}{{--                            <label class="my-2"><input type="checkbox" wire:model="isMultiRoute"> Penumpang Multiroute</label>--}}{{--
                        </div>--}}

                        <div class="form-group">
                            <label>Tiket</label>
                            @if($customer->member && count($selectedSeats)> 1)
                                <div class="alert alert-danger">
                                    Hanya diperkenan 1 tiket yang menggunkan harga Pelanggan Setia.
                                </div>
                            @endif
                            @forelse($selectedSeats as $seat)
                                <div class="d-flex mb-2 border-bottom">
                                    <h4 class="mr-4">{{ $seat }}</h4>
                                    <div class="flex-fill">
                                        <select class="form-control form-control-sm" wire:model="ticketDiscounts.{{$seat}}" wire:change="sumPrice">
                                            <option value="">Umum Rp.{{ number_format($departure->price ?? 0)  }}</option>

                                            @forelse($discounts as $discount_)
                                                <option value="{{ $discount_ }}">{{ $discount_->name}} Rp.{{ number_format($departure->price - $discount_->amount) }}</option>
                                            @empty

                                            @endforelse

                                        </select>
                                    </div>
                                </div>
                            @empty
                                <span>Pilih Kursi terlebih dahulu</span>
                            @endforelse
                        </div>

                        <div class="alert alert-info text-center p-2">
                            <label>Total</label>
                            <h3>Rp. {{ number_format($total ?? 0) }}</h3>
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <button type="button" class="btn btn-primary" wire:click="save" wire:loading.attr="disabled">Simpan</button>
                            <button type="button" class="btn btn-success" onclick="confirm('Konfirmasi Pembayran?') || event.stopImmediatePropagation()"  wire:click="saveAndPayment" wire:loading.attr="disabled">Bayar</button>
                        </div>
                    </form>

                </div>
            </div>

        @endif
    @endif

</div>
