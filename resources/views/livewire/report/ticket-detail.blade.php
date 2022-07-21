<div>
    <div class="card">
        <div class="card-body table-responsive ">
            <table class="table table-striped nowrap">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Hanphone</th>
                    <th>Nama</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Jenis Tiket</th>
                    <th>Harga</th>
                    <th>Lunas</th>
                    <th>Cancel</th>
                    <th>Seat</th>
                    <th>Reservasi</th>
                    <th>Payment</th>
                    <th>Cetak Tiket</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @forelse($data as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->departure->departure_point->name }}</td>
                        <td>{{ $row->departure->arrival_point->name }}</td>
                        <td>{{ $row->date }}</td>
                        <td>{{ $row->time }}</td>
                        <td>{{ $row->discount_name ?? 'Umum' }}</td>
                        <td>{{ $row->price }}</td>
                        <td>{{ $row->status }}</td>
                        <td>{{ $row->is_cancel }}</td>
                        <td>{{ $row->seat }}</td>
                        <td>{{ $row->reservation_at }} oleh {{ $row->user_reservation->name ?? '' }}</td>
                        <td>{{ $row->payment_at }}  oleh {{ $row->user_payment->name ?? '' }}</td>
                        <td>{{ $row->count_print }}</td>
                        <td>Lihat</td>
                    </tr>
                @empty
                    <tr>
                        <td>None</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-2">
                <span>Total {{$data->total()}} baris data</span>
                {{ $data->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
