<x-layouts.app>
    <div class="row">
        <div class="col-12">
            <div class="dashboard_header mb_50">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard_header_title">
                            <h3> Laporan Data Transaksi <i class="fas fa-chart-bar"></i></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard_breadcam text-end">
                            <p><a href="index.html">Dashboard</a> <i class="fas fa-caret-right"></i> Laporan <i
                                    class="fas fa-caret-right"></i> Transaksi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <div class="QA_section mb-4">
                <div class="row justify-content-between align-items-end">
                    <div class="col-lg-8">
                        <form method="GET" action="{{ route('transactions.report') }}"
                            class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label for="start_date" class="form-label fw-semibold">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="start_date"
                                    value="{{ request('start_date') }}" class="form-control shadow-sm">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label fw-semibold">Tanggal Akhir</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                    class="form-control shadow-sm">
                            </div>
                            <div class="col-md-4 d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i>
                                    Tampilkan</button>
                                <a href="{{ route('transactions.report') }}" class="btn btn-outline-secondary w-100"><i
                                        class="bi bi-x-circle"></i> Reset</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 text-end mt-3 mt-lg-0">
                        <a href="{{ route('transaction.report.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            class="btn btn-danger shadow-sm">
                            <i class="bi bi-file-earmark-pdf"></i> Unduh PDF
                        </a>
                    </div>
                </div>
            </div>

            <div class="QA_table mb_30">
                <table class="table table-responsive text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Kasir</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Nama Item</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Plat Nomor</th>
                            <th scope="col">Jenis Kendaraan</th>
                            <th scope="col">Jenis Transaksi</th>
                            <th scope="col">Total</th>
                            <th scope="col">Metode Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $key => $item)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->invoice }}</td>
                                <td class="text-start">
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($item->details as $detail)
                                            <li>• {{ $detail->nama_item }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $item->member->nama }}</td>
                                <td>{{ $item->plat_nomor }}</td>
                                <td>{{ $item->jenis_kendaraan }}</td>
                                <td>
                                    @if ($item->jenis_transaksi === 'Produk & Service')
                                        Produk & Service
                                    @elseif ($item->jenis_transaksi === 'Produk')
                                        Produk
                                    @elseif ($item->jenis_transaksi === 'Service')
                                        Service
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="text-end">Rp {{ number_format($item->details->sum('total'), 0, ',', '.') }}
                                </td>
                                <td>{{ $item->metode_bayar }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="9" class="text-end fw-bold">Total Keseluruhan:</td>
                            <td colspan="2" class="fw-bold text-end text-danger">
                                Rp {{ number_format($total_semua, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $transactions->withQueryString()->links() }}
            </div>
        </div>
    </div>

</x-layouts.app>
