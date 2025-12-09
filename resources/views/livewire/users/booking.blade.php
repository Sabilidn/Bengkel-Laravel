<div>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img class="w-100" src="/users/img/bg-1.jpg" alt="Layanan Bengkel Mobil Profesional">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Layanan Bengkel
                                        //</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">
                                        Solusi Terbaik untuk Perawatan dan Perbaikan Mobil Anda
                                    </h1>
                                    <a href="#" class="btn btn-primary py-3 px-5 animated slideInDown">
                                        Lihat Detail Layanan <i class="fa fa-arrow-right ms-3"></i>
                                    </a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="/users/img/toyota.png" alt="Toyota Service"
                                        width="900px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img class="w-100" src="/users/img/bg-2.jpg" alt="Layanan Cuci Mobil Profesional">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Cuci Mobil //
                                    </h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">
                                        Bersihkan Mobil Anda dengan Sentuhan Profesional
                                    </h1>
                                    <a href="#" class="btn btn-primary py-3 px-5 animated slideInDown">
                                        Jadwalkan Sekarang <i class="fa fa-arrow-right ms-3"></i>
                                    </a>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="/users/img/honda.png" alt="Honda Car Wash"
                                        width="900px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Selanjutnya</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="mb-4 text-center">Form Booking Service Mobil</h2>
                    <form wire:submit.prevent="submitBooking">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Pelanggan</label>
                                    <input type="text" class="form-control" id="nama" wire:model="nama"
                                        required>
                                    @error('nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" wire:model="email"
                                        required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nomor_hp" class="form-label">Nomor HP</label>
                                    <input type="number" class="form-control" id="nomor_hp" wire:model="nomor_hp"
                                        required>
                                    @error('nomor_hp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jenis Kendaraan</label>
                                    <select wire:model="jenis_kendaraan" class="form-select shadow-sm" required>
                                        <option selected>Pilih Merek Mobil</option>
                                        @foreach (['Toyota', 'Honda', 'Suzuki', 'Daihatsu', 'Mitsubishi', 'Nissan', 'Hyundai', 'Wuling', 'Kia', 'Mazda'] as $merk)
                                            <option value="{{ $merk }}">{{ $merk }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_kendaraan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tipe_kendaraan" class="form-label">Tipe Kendaraan</label>
                                    <input type="text" class="form-control" id="tipe_kendaraan"
                                        wire:model="tipe_kendaraan" required>
                                    @error('tipe_kendaraan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="plat_nomor" class="form-label">Plat Nomor</label>
                                    <input type="text" class="form-control" id="plat_nomor"
                                        wire:model="plat_nomor" required>
                                    @error('plat_nomor')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="atas_nama" class="form-label">Atas Nama (STNK)</label>
                                    <input type="text" class="form-control" id="atas_nama" wire:model="atas_nama"
                                        required>
                                    @error('atas_nama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jadwal_service" class="form-label">Jadwal Service</label>
                                    <input type="datetime-local" class="form-control" id="jadwal_service"
                                        wire:model="jadwal_service" required>
                                    @error('jadwal_service')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tipe_service" class="form-label">Tipe Service</label>
                                    <select class="form-select" id="tipe_service" wire:model.live="tipe_service"
                                        required>
                                        <option value="">-- Pilih Tipe Service --</option>
                                        <option value="Ganti Oli">Ganti Oli</option>
                                        <option value="Servis Berkala">Servis Berkala</option>
                                        <option value="Perbaikan Mesin">Perbaikan Mesin</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('tipe_service')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                @if ($tipe_service === 'Lainnya')
                                    <div class="mb-3">
                                        <label for="tipe_service_lainnya" class="form-label">Tipe Service
                                            Lainnya</label>
                                        <input type="text" class="form-control" id="tipe_service_lainnya"
                                            wire:model="tipe_service_lainnya" required>
                                        @error('tipe_service_lainnya')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <textarea class="form-control" id="keluhan" rows="4" wire:model="keluhan"></textarea>
                            @error('keluhan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">Kirim Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
</div>
