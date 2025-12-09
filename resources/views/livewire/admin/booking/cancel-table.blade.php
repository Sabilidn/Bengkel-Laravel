<div>
     <div class="row">
        <div class="col-12">
            <div class="dashboard_header mb_50">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard_header_title">
                            <h3> Data Booking Dibatalkan <i class="fas fa-th-list"></i></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard_breadcam text-end">
                            <p><a href="index.html">Dashboard</a> <i class="fas fa-caret-right"></i> Data Booking Online <i class="fas fa-caret-right"></i> Data Sedang Dikerjakan</p>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="QA_section">
                <div class="white_box_tittle list_header">
                    <h4></h4>
                    <div class="box_right d-flex lms_block">
                        <div class="serach_field_2">
                            <div class="search_inner">
                                
                            </div>
                        </div>

                        <div class="add_button ms-2">
                        </div>
                    </div>
                </div>
                <div class="table-responsive QA_table mb_30">
                    <!-- table-responsive -->
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Nomor Handphone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Tipe Kendaraan</th>
                                <th scope="col">Plat Nomor</th>
                                <th scope="col">STNK A/N</th>
                                <th scope="col">Jadwal Service</th>
                                <th scope="col">Tipe Service</th>
                                <th scope="col">Keluhan</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($booking as $key => $item)
                                <tr>
                                    <th scope="row"> <a href="#" class="question_content">
                                            {{ $booking->firstItem() + $key }}</a></th>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nomor_hp }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->tipe_kendaraan }}</td>
                                    <td>{{ $item->plat_nomor }}</td>
                                    <td>{{ $item->atas_nama }}</td>
                                    <td>{{ $item->jadwal_service }}</td>
                                    <td>{{ $item->tipe_service }}</td>
                                    <td>{{ $item->keluhan }}</td>
                                    <td>
                                        @if ($item->status == 'Dibatalkan')
                                            <span class="btn btn-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     <div class="d-flex justify-content-end mt-3">
                        {{ $booking->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            window.addEventListener('show-delete-alert', event => {
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('deleteConfirmed', {
                            id: event.detail.id
                        });
                    }
                });
            });

            window.addEventListener('deleted', () => {
                Swal.fire(
                    'Terhapus!',
                    'Data berhasil dihapus.',
                    'success'
                );
            });
        </script>
    @endpush
</div>
