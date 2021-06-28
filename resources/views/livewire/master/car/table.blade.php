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
                        <th wire:click="sortBy('code')">Kode Unit  @include('include._sortable_icon',['field'=> 'code', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('license_number')">Nomor Polisi  @include('include._sortable_icon',['field'=> 'license_number', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('kilometers')">Kilometer Terkhir  @include('include._sortable_icon',['field'=> 'kilometers', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('active')">Aktif  @include('include._sortable_icon',['field'=> 'active', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($cars as $car)
                        <tr>
                            <td>{{$car->id}}</td>
                            <td>{{$car->code}}</td>
                            <td>{{$car->license_number}}</td>
                            <td align="right">{{number_format($car->kilometers)}}</td>
                            <td>@include('include._active_badge',['active'=> $car->active])</td>
                            <td>
                                <a href="{{ route('master.car.show',['id'=>$car->id]) }}" class="btn btn-sm btn-primary">Tampilkan</a>
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
                        Menampilkan {{ $cars->firstItem() }} sampai {{ $cars->lastItem() }} dari total {{ $cars->total() }} item
                    </div>
                    <div>
                        {!! $cars->links("pagination::bootstrap-4") !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
