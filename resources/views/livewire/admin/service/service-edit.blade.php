<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Data Harga Service Data Lama</div>
                <div class="card-body">
                    
                    <form>
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama</label>
                            <input type="text" id="namaKategori" value="{{ $nama }}" class="form-control" readonly>
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Harga Service</label>
                            <input type="text" id="namaKategori" value="{{ $harga }}" class="form-control" readonly>
                            @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Data Harga Service Data Baru</div>
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama</label>
                            <input type="text" id="namaKategori" wire:model="nama" class="form-control">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Harga Service</label>
                            <input type="text" id="namaKategori" wire:model="harga" class="form-control">
                            @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('service.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>