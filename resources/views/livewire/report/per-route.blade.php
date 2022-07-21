<div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th>Asal</th>
                    <th>Tujuan</th>
                    <th>Trip</th>
                    <th>Penumpang</th>
                    <th>Omzet</th>
                    <th>Detail</th>
                </tr>
                </thead>

                <tbody>
                @forelse($data as $row)
                    <tr>
                        <td>{{ $row->from_point }}</td>
                        <td>{{ $row->to_point }}</td>
                        <td class="text-right">{{ number_format($row->trips_count) }}</td>
                        <td class="text-right">{{ number_format($row->tickets_count) }}</td>
                        <td class="text-right">{{ number_format($row->omzet) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary"
                               onclick="window.open('{{ route('report.ticket-detail',
                                [
                                    'from_date'=>request('from_date'),
                                    'to_date'=>request('to_date'),
                                    'departure_point_id'=>$row->departure_point_id,
                                    'arrival_point_id'=>$row->arrival_point_id,
                                ]) }}', '', 'width=1000,height=500,left=500,top=10')">Detail</a>
                        </td>
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
