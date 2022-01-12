<div class="row mt-2">
    <div class="col-md-3">
        <div class="card">
            <card class="card-body">
                <h1>{{ number_format($current) }}</h1>
                <strong class="card-title">Penumpang Bulan Berjalan</strong>
            </card>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <card class="card-body">
                <h1>{{ number_format($new) }}</h1>
                <strong class="card-title">Penumpang Baru</strong>
            </card>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <card class="card-body">
                <h1>{{ number_format($member) }}</h1>
                <strong class="card-title">Pelanggan Setia</strong>
            </card>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <card class="card-body">
                <h1>{{ number_format($total) }}</h1>
                <strong class="card-title">Semua Penumpang</strong>
            </card>
        </div>
    </div>
</div>
