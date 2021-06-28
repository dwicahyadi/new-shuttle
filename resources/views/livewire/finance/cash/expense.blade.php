<div>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="save">
                @if (session()->has('message'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('message') }}

                    </div>
                @endif

                <div class="form-group">
                    <label>Tanggal Biaya</label>
                    <input type="date" wire:model="date" class="form-control" required>
                    @error('date') <span class="form-text text-danger">{{ $message }}</span> @enderror

                </div>

                <div class="form-group">
                    <label>Kategori Biaya</label>
                    <input wire:model="category"
                           type="text"
                           name="category"
                           list="categories"
                           id="category"
                           class="form-control" placeholder="ketik untuk mencari" autocomplete="off">
                    @if($suggestCategories)
                        <datalist id="categories">
                            @foreach($suggestCategories as $suggest)
                                <option value="{{ $suggest->category }}" >{{ $suggest->category }}</option>
                            @endforeach
                        </datalist>
                    @endif
                    @error('category') <span class="form-text text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea wire:model="description" class="form-control"></textarea>
                    @error('description') <span class="form-text text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" wire:model="amount" class="form-control" required>
                    @error('amount') <span class="form-text text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="form-group d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
