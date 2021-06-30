<div>
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                @forelse($settlements as $settlement)
                    <li class="list-group-item d-flex align-items-center">
                        <div class="mr-2">
                            <div class="p-2 bg-info rounded text-white">
                                @if($settlement->type == 'packages')
                                    <i class="fa fa-gifts"></i>
                                @else
                                    <i class="fa fa-ticket-alt"></i>
                                @endif
                            </div>
                        </div>
                        <div class="flex-fill">
                            <small>{{ $settlement->created_at }}</small><br>
                            <span>Settlement {{ $settlement->type ?? 'tickets' }}</span><br>
                            <span>Catatan: {{ $settlement->note }}</span>
                        </div>

                        <div class="text-right">
                            <strong>Rp. {{ number_format($settlement->amount) }}</strong>
                        </div>
                        <div class="text-right ml-4">
                            <button type="button" class="btn btn-light btn-sm" onclick="window.open('{{ route('print.settlement',['settlement'=>$settlement]) }}', '', 'width=800,height=600')">
                                <i class="fa fa-print"></i> Cetak
                            </button>
                        </div>
                    </li>

                @empty

                @endforelse
            </ul>
            <div class="mt-4">
                {{ $settlements->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
