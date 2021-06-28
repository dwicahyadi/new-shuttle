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
                        <th wire:click="sortBy('note')">Catatan  @include('include._sortable_icon',['field'=> 'note', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th wire:click="sortBy('next_maintenance_date')">Jadwal Perawatan Berikutnya @include('include._sortable_icon',['field'=> 'next_maintenance_date', 'sortBy' => $sortBy, 'sortDirection' => $sortDirection])</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($maintenances as $maintenance)
                        <tr>
                            <td>{{$maintenance->id}}</td>
                            <td>{{$maintenance->date}}</td>
                            <td>{{$maintenance->note}}</td>
                            <td>{{$maintenance->next_maintenance_date}}</td>
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
                        Menampilkan {{ $maintenances->firstItem() }} sampai {{ $maintenances->lastItem() }} dari total {{ $maintenances->total() }} item
                    </div>
                    <div>
                        {!! $maintenances->links("pagination::bootstrap-4") !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
