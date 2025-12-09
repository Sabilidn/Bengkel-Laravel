<x-layouts.app>
    <div class="row">
        <div class="col-12">
            <div class="dashboard_header mb_50">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard_header_title">
                            <h3>Riwayat <i class="fas fa-history"></i></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard_breadcam text-end">
                            <p><a href="index.html">Dashboard</a> <i class="fas fa-caret-right"></i> Transaksi <i
                                    class="fas fa-caret-right"></i> Riwayat</p>
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
                </div>
                <div class="QA_table mb_30">
                <!-- table-responsive -->
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Plat Nomor</th>
                            <th scope="col">Jenis Kendaraan</th>
                            <th scope="col">Metode Pembayaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($transaction as $key => $item )
                           <tr>
                            <td>{{ $transaction->FirstItem() + $key }}</td>
                            <td>{{ $item->invoice }}</td>
                            <td>{{ $item->member->nama }}</td>
                            <td>{{ $item->member->plat_nomor }}</td>
                            <td>{{ $item->member->jenis_kendaraan }}</td>
                            <td>{{ $item->metode_bayar }}</td>
                            <td>
                                <a href="{{ route('item.detail',$item->id) }}" class="text-dark btn btn-info btn-sm">Detail</a>
                            </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-3">

                    {{ $transaction->links() }}

                </div>
            </div>
            </div>
        </div>
    </div>

</x-layouts.app>
