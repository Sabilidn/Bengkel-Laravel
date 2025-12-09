<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Admin Data Lama</div>
                <div class="card-body">
                    
                    <form>
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama Admin</label>
                            <input type="text" id="namaKategori" value="{{ $name }}" class="form-control" readonly>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nomor Handphone</label>
                            <input type="text" id="namaKategori" value="{{ $email }}" class="form-control" readonly>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Admin Data Baru</div>
                <div class="card-body">
                    <form wire:submit.prevent="update">
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama Admin</label>
                            <input type="text" id="namaKategori" wire:model="name" class="form-control">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Email</label>
                            <input type="email" id="namaKategori" wire:model="email" class="form-control">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Password Baru</label>
                            <input type="password" id="namaKategori" wire:model="password" class="form-control">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>