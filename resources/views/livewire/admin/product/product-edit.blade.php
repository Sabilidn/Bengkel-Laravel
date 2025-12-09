<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="font-family: Abril Fatface">Data Produk Lama</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="namaKategori" class="form-label">Nama Produk</label>
                                <input type="text" id="namaKategori" value="{{ $nama }}" class="form-control"
                                    placeholder="Masukkan nama kategori" readonly>
                                @error('nama')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="namaKategori" class="form-label">Kategori</label>
                                <select wire:model="id_category" class="form-control" id="" disabled>
                                    <option value="">==Pilih Kategori==</option>
                                    @foreach ($categorys as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="namaKategori" class="form-label">Harga</label>
                                <input type="number" id="namaKategori" wire:model="harga" class="form-control"
                                    placeholder="Masukkan Harga Produk" readonly>
                                @error('harga')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="namaKategori" class="form-label">Stok</label>
                                <input type="number" id="namaKategori" wire:model="stok" class="form-control"
                                    placeholder="Masukkan Stok Produk" readonly>
                                @error('stok')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header" style="font-family: Abril Fatface">Data Produk Baru</div>
                        <div class="card-body">
                            <form wire:submit="update">
                                <div class="mb-3">
                                    <label for="namaKategori" class="form-label">Nama Produk</label>
                                    <input type="text" id="namaKategori" wire:model="nama" class="form-control"
                                        placeholder="Masukkan nama kategori" P>
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="namaKategori" class="form-label">Kategori</label>
                                    <select wire:model="id_category" class="form-control" id="">
                                        <option value="">==Pilih Kategori==</option>
                                        @foreach ($categorys as $category)
                                            <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="namaKategori" class="form-label">Harga</label>
                                    <input type="number" id="namaKategori" wire:model="harga" class="form-control"
                                        placeholder="Masukkan Harga Produk" P>
                                    @error('harga')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="namaKategori" class="form-label">Stok</label>
                                    <input type="number" id="namaKategori" wire:model="stok" class="form-control"
                                        placeholder="Masukkan Stok Produk" P>
                                    @error('stok')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
