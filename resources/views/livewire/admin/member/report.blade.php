<x-layouts.app>
    <div class="row">
        <div class="col-12">
            <div class="dashboard_header mb_50">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard_header_title">
                            <h3> Laporan Data Pelanggan <i class="fas fa-users"></i></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dashboard_breadcam text-end">
                            <p><a href="index.html">Dashboard</a> <i class="fas fa-caret-right"></i> Laporan <i
                                    class="fas fa-caret-right"></i> Pelanggan</p>
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
                        <div class="add_button ms-2">
                            <a href="{{ route('member.report.pdf') }}" class="btn btn-danger" target="_blank">Unduh
                                PDF</a>
                        </div>
                    </div>
                </div>
                <div class="QA_table mb_30">
                    <!-- table-responsive -->
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Nomor Handphone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $key => $item)
                                <tr>
                                    <th scope="row"> <a href="#" class="question_content">
                                            {{ $members->firstItem() + $key }}
                                        </a></th>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nomor_handphone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $members->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
