<div>
    <div class="card">
        <div class="card-body table-responsive ">
            <table class="table table-striped nowrap">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Jenis Paket</th>
                    <th>Isi</th>
                    <th>Berat</th>
                    <th>Koli</th>
                    <th>Harga</th>
                    <th>Payment</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @forelse($data as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->sender_phone ."/". $row->sender_name }}</td>
                        <td>{{ $row->receiver_phone ."/". $row->receiver_name }}</td>
                        <td>{{ $row->departure->departure_point->name }}</td>
                        <td>{{ $row->departure->arrival_point->name }}</td>
                        <td>{{ $row->departure->date }}</td>
                        <td>{{ $row->departure->time }}</td>
                        <td>{{ $row->type }}</td>
                        <td>{{ $row->content }}</td>
                        <td>{{ $row->weight }}</td>
                        <td>{{ $row->piece }}</td>
                        <td>{{ $row->price }}</td>
                        <td>{{ $row->payment_at }}  oleh {{ $row->user->name ?? '' }}</td>
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
