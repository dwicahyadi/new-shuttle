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
                        <th wire:click="sortBy('phone')">No Handphone  @include('include._sortable_icon',['field'=> 'phone', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('name')">Nama  @include('include._sortable_icon',['field'=> 'name', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('address')">Alamat  @include('include._sortable_icon',['field'=> 'address', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('count_reservation')">Jml. Reservasi  @include('include._sortable_icon',['field'=> 'count_reservation', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('count_reservation_finished')">Jml. Reservasi Lunas  @include('include._sortable_icon',['field'=> 'count_reservation_finished', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('member')">Pelanggan Setia  @include('include._sortable_icon',['field'=> 'member', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->address}}</td>
                            <td align="right">{{number_format($customer->count_reservation)}}</td>
                            <td align="right">{{number_format($customer->count_reservation_finished)}}</td>
                            <td>@include('include._active_badge',['active'=> $customer->member])</td>
                            <td>
                                <a href="{{ route('master.customer.show',['id'=>$customer->id]) }}" class="btn btn-sm btn-primary">Tampilkan</a>
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
                        Menampilkan {{ $customers->firstItem() }} sampai {{ $customers->lastItem() }} dari total {{ $customers->total() }} item
                    </div>
                    <div>
                        {!! $customers->links("pagination::bootstrap-4") !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
