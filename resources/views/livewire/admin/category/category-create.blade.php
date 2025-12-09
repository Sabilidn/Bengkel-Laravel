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
                    <h5 class="modal-title text-white" id="myModalLabel">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>



                <!-- Modal Body -->
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama Kategori</label>
                            <input type="text" id="namaKategori" wire:model="nama" class="form-control"
                                placeholder="Masukkan nama kategori">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
