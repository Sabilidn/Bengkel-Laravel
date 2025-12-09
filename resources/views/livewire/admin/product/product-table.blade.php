<div>
    
    <div class="row">
        <div class="col-12">
            <div class="dashboard_header mb_50">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard_header_title">
                            <h3> Data Produk <i class="fas fa-boxes"></i></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard_breadcam text-end">
                            <p><a href="index.html">Dashboard</a> <i class="fas fa-caret-right"></i> Master Data <i
                                    class="fas fa-caret-right"></i> Data Produk</p>
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
                                <form Active="#">
                                    <div class="search_field">
                                        <input type="text" placeholder="Pencarian Produk" wire:model.live="search">
                                    </div>
                                    <button type="submit"> <i class="ti-search"></i> </button>
                                </form>
                            </div>
                        </div>

                        <div class="add_button ms-2">
                            @livewire('admin.product.product-create')
                        </div>
                    </div>
                </div>
                <div class="QA_table mb_30">
                    <!-- table-responsive -->
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga Produk</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr>
                                    <th scope="row"> <a href="#" class="question_content">
                                            {{ $products->firstItem() + $key }}</a></th>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->category->nama }}</td>
                                    <td>Rp.{{ number_format($item->harga, 0) }}</td>
                                    <td>
                                        @if ($item->stok == 0)
                                            <span class="btn btn-danger">Stok Habis</span>
                                        @else
                                            {{ $item->stok }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('product.edit', $item->id) }}"
                                            class="btn btn-info btn-sm btn-block text-dark">Edit</a>
                                        <button class="btn btn-danger btn-sm"
                                            wire:click="confirmDelete({{ $item->id }})">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- PAGINATION -->
                    <div class="d-flex justify-content-end mt-3">
                        {{ $products->links() }}
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
