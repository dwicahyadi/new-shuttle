<div>
    <div class="row mb-2">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Pemasukan Bulan ini</h5>
                    <div class="text-right">
                        <h4 class="text-success">{{ number_format(\App\Models\Ledger::where('amount','>',0)->sum('amount') ?? 0) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Pengeluaran Bulan ini</h5>
                    <div class="text-right">
                        <h4 class="text-danger">{{ number_format(\App\Models\Ledger::where('amount','<',0)->sum('amount')*-1 ?? 0) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Saldo</h5>
                    <div class="text-right">
                        <h4>{{ number_format(\App\Models\Ledger::sum('amount') ?? 0) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
