<div>


    @if(!$customer)
        <form wire:submit.prevent="save">
            <div class="form-group">
                <label>Nomor Telepon</label>
                <input wire:model="phoneSearch"
                       wire:change="setCustomer"
                       wire:keydown.enter="setCustomer"
                       type="text"
                       name="phone"
                       list="customers"
                       id="customer"
                       class="form-control form-control-sm" placeholder="ketik kemudian Enter" autocomplete="off">
                @if($suggestCustomers)
                    <datalist id="customers">
                        @foreach($suggestCustomers as $suggest)
                            <option value="{{ $suggest->phone }}" wire:onclick="$set('phoneSearch','0000')">{{ $suggest->name }}</option>
                        @endforeach
                    </datalist>
                @endif
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input wire:model="name" type="text" name="name" class="form-control form-control-sm" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input wire:model="address" type="text" name="name" class="form-control form-control-sm" autocomplete="off">
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Simpan Pelanggan</button>
            </div>
        </form>
    @else

        @if($customer->member)
            <div class="alert alert-info text-center">
                <i class="fa fa-crown"></i> Pelanggan Setia
                {{ $customer->tickets_count }}
            </div>
        @else
            <p>Saat ini sudah {{ $customer->tickets_count }} Tiket</p>
        @endif
        <div class="mb-2">
            <span>Nomor Handphone</span><br>
            <strong>{{ $customer->phone }}</strong>
        </div>
        <div class="mb-2">
            <span>Nama Pemesan</span><br>
            <strong>{{ $customer->name }}</strong>
        </div>

        <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-sm btn-light"
                    wire:click="changeCustomer">
                Ganti Pelanggan
            </button>
            <a href="{{ route('master.customer.show',['id'=>$customer->id]) }}" class="btn btn-sm btn-light">
                Tampilkan
            </a>

        </div>
    @endif


</div>
