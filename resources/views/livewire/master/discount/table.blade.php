<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end my-2">
                <input type="text" wire:model="search" placeholder="search" class="form-control w-25 mx-2">
            </div>
            <div class="table-responsive">
                <table class="table table-hover clickable">
                    <thead>
                    <tr class="">
                        <th wire:click="sortBy('id')" >ID @include('include._sortable_icon',['field'=> 'id', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('code')">Kode  @include('include._sortable_icon',['field'=> 'code', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('name')">Nama Diskon  @include('include._sortable_icon',['field'=> 'name', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('amount')">Nominal Diskon (Rp.)  @include('include._sortable_icon',['field'=> 'amount', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('active')">Aktif  @include('include._sortable_icon',['field'=> 'active', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($discounts as $discount)
                        <tr>
                            <td>{{$discount->id}}</td>
                            <td>{{$discount->code}}</td>
                            <td>{{$discount->name}}</td>
                            <td align="right">{{number_format($discount->amount)}}</td>
                            <td>@include('include._active_badge',['active'=> $discount->active])</td>
                            <td>
                                <a href="{{ route('master.car.show',['id'=>$discount->id]) }}" class="btn btn-sm btn-primary">Tampilkan</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <div>
                        Menampilkan {{ $discounts->firstItem() }} sampai {{ $discounts->lastItem() }} dari total {{ $discounts->total() }} item
                    </div>
                    <div>
                        {!! $discounts->links("pagination::bootstrap-4") !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
