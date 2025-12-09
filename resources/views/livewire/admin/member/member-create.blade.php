<div>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Tambah
    </button>

    <!-- The Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-sm">

                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title text-white" id="myModalLabel">Tambah Pelanggan Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>



                <!-- Modal Body -->
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama Pelanggan</label>
                            <input type="text" id="namaKategori" wire:model="nama" class="form-control shadow-sm"
                                placeholder="Masukkan Nama Pelanggan">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nomor Handphone</label>
                            <input type="number" id="namaKategori" wire:model="nomor_handphone" class="form-control shadow-sm"
                                placeholder="Masukan Nomor Handphone" >
                            @error('nomor_handphone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Plat Nomor</label>
                            <input type="text" id="namaKategori" wire:model="plat_nomor" class="form-control shadow-sm"
                                placeholder="Masukan Plat Nomor Kendaraan" >
                            @error('plat_nomor')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kendaraan</label>
                            <select wire:model="jenis_kendaraan" class="form-control shadow-sm">
                                <option selected>== Pilih Merek Mobil ==</option>
                                @foreach (['Toyota', 'Honda', 'Suzuki', 'Daihatsu', 'Mitsubishi', 'Nissan', 'Hyundai', 'Wuling', 'Kia', 'Mazda'] as $merk)
                                    <option value="{{ $merk }}">{{ $merk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        <button type="button" class="btn btn-link text-danger w-100 mt-2"
                            data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
