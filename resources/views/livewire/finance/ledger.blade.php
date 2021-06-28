<div>
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
                            <th wire:click="sortBy('date')">Tanggal  @include('include._sortable_icon',['field'=> 'date', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                            <th wire:click="sortBy('category')">Kategori  @include('include._sortable_icon',['field'=> 'category', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                            <th wire:click="sortBy('description')">Deskripsi  @include('include._sortable_icon',['field'=> 'description', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                            <th wire:click="sortBy('amount')">Amount  @include('include._sortable_icon',['field'=> 'amount', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($ledgers as $ledger)
                            <tr>
                                <td>{{$ledger->id}}</td>
                                <td>{{$ledger->date}}</td>
                                <td>{{$ledger->category}}</td>
                                <td>{{$ledger->description}}</td>
                                <td align="right">
                                    <span class="@if($ledger->amount < 0) text-danger @endif ">{{number_format($ledger->amount)}}</span>
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
                            Menampilkan {{ $ledgers->firstItem() }} sampai {{ $ledgers->lastItem() }} dari total {{ $ledgers->total() }} item
                        </div>
                        <div>
                            {!! $ledgers->links("pagination::bootstrap-4") !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
