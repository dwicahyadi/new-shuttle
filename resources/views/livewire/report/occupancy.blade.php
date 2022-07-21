<div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Kursi</th>
                    <th>Penumpang</th>
                    <th>Okupansi (%)</th>
                </tr>
                </thead>

                <tbody>
                @forelse($data as $row)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $row->date)->translatedFormat('l, d M Y') }}</td>
                        <td>{{ $row->time }}</td>
                        <td>{{ $row->from_point }}</td>
                        <td>{{ $row->to_point }}</td>
                        <td class="text-right">{{ number_format($row->seat_open) }}</td>
                        <td class="text-right">{{ number_format($row->tickets_count) }}</td>
                        <td class="text-right">{{ number_format($row->tickets_count/$row->seat_open,2)*100 }}</td>
                    </tr>
                @empty
                    <tr>
                        <td>None</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
