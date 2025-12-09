<x-layouts.app>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="dashboard_header mb_50">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard_header_title">
                            <h3>Dashboard Bengkel</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard_breadcam text-end">
                            <p><a href="#">Beranda</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Pemasukan -->
        <div class="col-lg-8 col-xl-8">
            <div class="white_box mb_30">
                <div id="incomeChart"></div>
                <div class="card_footer_white">
                    <div class="row">
                        <!-- Bulan Ini -->
                        <div class="col-sm-4 text-center">
                            <div class="d-inline-flex">
                                <h5 class="me-2">Rp {{ number_format($thisMonth, 0, ',', '.') }}</h5>
                                <div class="text-success">
                                    <i class="fas fa-caret-up font-size-14 line-height-2 me-2"></i>
                                </div>
                            </div>
                            <p class="text-muted text-truncate mb-0">Bulan Ini</p>
                        </div>

                        <!-- Tahun Ini -->
                        <div class="col-sm-4 text-center">
                            <div class="mt-4 mt-sm-0">
                                <p class="mb-2 text-muted text-truncate">
                                    <i class="fas fa-circle text-primary me-2 font-size-10 me-1"></i> Tahun Ini :
                                </p>
                                <div class="d-inline-flex align-items-center">
                                    <h5 class="mb-0 me-2">Rp {{ number_format($thisYear, 0, ',', '.') }}</h5>
                                    <div class="text-success">
                                        <i class="fas fa-caret-up font-size-14 line-height-2 me-2"></i>
                                        {{ number_format($percentGrowth, 1) }}%
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tahun Lalu -->
                        <div class="col-sm-4 text-center">
                            <div class="mt-4 mt-sm-0">
                                <p class="mb-2 text-muted text-truncate">
                                    <i class="fas fa-circle text-success font-size-10 me-1"></i> Tahun Lalu :
                                </p>
                                <div class="d-inline-flex align-items-center">
                                    <h5 class="mb-0">Rp {{ number_format($previousYear, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Total -->
        @if (Auth()->user()->isAdmin == 1)
        <div class="col-lg-4">
            <div class="list_counter_wrapper white_box mb_30 p-0 card_height_100">
                <div class="single_list_counter">
                    <h3 class="deep_blue_2"><span class="counter deep_blue_2">{{ $member }}</span> </h3>
                    <p>Total Pelanggan</p>
                </div>
                <div class="single_list_counter">
                    <h3 class="deep_blue_2"><span class="counter deep_blue_2">{{ $category }}</span> </h3>
                    <p>Total Kategori</p>
                </div>
                <div class="single_list_counter">
                    <h3 class="deep_blue_2"><span class="counter deep_blue_2">{{ $product }}</span> </h3>
                    <p>Total Produk</p>
                </div>
                <div class="single_list_counter">
                    <h3 class="deep_blue_2"><span class="counter deep_blue_2">{{ $transaction }}</span> </h3>
                    <p>Total Transaksi </p>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Chart --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
            chart: {
                height: 350,
                type: 'line'
            },
            series: [{
                name: 'Pemasukan',
                data: @json($monthlyIncomeFormatted)
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                ]
            },
            title: {
                text: 'Statistik Pemasukan Bulanan Tahun {{ now()->year }}',
                align: 'left'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return 'Rp ' + val.toLocaleString('id-ID');
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#incomeChart"), options);
        chart.render();
    </script>
</x-layouts.app>
