<x-layouts.app>
    <div class="row">
        <div class="col-12">
            <div class="dashboard_header mb_50">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard_header_title">
                            <h3>Riwayat Detail <i class="fas fa-history"></i></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard_breadcam text-end">
                            <p><a href="index.html">Dashboard</a> <i class="fas fa-caret-right"></i> Transaksi <i
                                    class="fas fa-caret-right"></i> Riwayat <i class="fas fa-caret-right"></i> Detail
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="QA_table mb_30">
                <!-- table-responsive -->
                @php
                    $grandTotal = 0;
                @endphp

                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Item</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $key => $item)
                            @php
                                $grandTotal += $item->total;
                            @endphp
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $item->nama_item }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total</strong></td>
                            <td><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
