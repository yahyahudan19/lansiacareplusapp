@extends('components.layout')

@section('title')
    Laporan Puskesmas
@endsection

@section('plugins-head')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')
    <!--begin::Page loading(append to body)-->
    <div class="page-loader flex-column" id="pageLoader" style="display: none;">
        <span class="spinner-border text-primary" role="status"></span>
        <span class="text-muted fs-6 fw-semibold mt-5">Loading...</span>
    </div>
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                            Laporan Puskesmas</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="index.html" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Laporan</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Puskesmas</li>
                            <!--end::Item-->

                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <button href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_export">
                            <i class="ki-solid ki-file-sheet"></i>
                            Export Laporan
                        </button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_generate">
                            <i class="ki-solid ki-setting-2"></i>
                            Generate Laporan
                        </button>
                    </div>
                    <!--end::Actions-->

                    <!--begin::Generate Modal-->
                    <div class="modal fade" tabindex="-1" id="kt_modal_generate">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <form action="#" method="GET">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Generate Laporan</h3>
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <div class="modal-body">
                                        <!--begin::Toolbar-->
                                        <div class="d-flex">
                                            <div class="row">
                                                @if (auth()->user()->role == "System Administrator" || auth()->user()->role == "Dinkes")
                                                    <!--begin::Filter Puskesmas-->
                                                    <div class="col-lg-8 mb-2 ">
                                                        <label class="fs-6 form-label fw-bold text-gray-900">Puskesmas</label>
                                                        <select class="btn btn-light me-3" data-control="select2"
                                                            data-placeholder="Pilih Puskesmas" name="puskesmas" id="puskesmas_ex"
                                                            data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($puskesmas as $pus)
                                                                <option value="{{ $pus->kode }}">{{ $pus->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Filter Puskesmas-->
                                                @elseif (auth()->user()->role == "Puskesmas")
                                                    <!--begin::Filter Puskesmas-->
                                                    <div class="col-lg-8 mb-2 ">
                                                        <label class="fs-6 form-label fw-bold text-gray-900">Puskesmas</label>
                                                        <select class="btn btn-light me-3" data-control="select2"
                                                            data-placeholder="Pilih Puskesmas" name="puskesmas" id="puskesmas_ex"
                                                            data-allow-clear="true" @readonly(true)>
                                                            <option value="{{ auth()->user()->puskesmas->kode }}" selected>{{ auth()->user()->puskesmas->nama }}</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Filter Puskesmas-->
                                                @endif
                                                <!--begin::Filter Date-->
                                                <div class="col-lg-4 mb-5">
                                                    <label class="fs-6 form-label fw-bold text-gray-900">Tanggal</label>
                                                    <br>
                                                    <input class="btn btn-primary me-3" placeholder="Pick date rage"
                                                        id="kt_datefilter_generate" name="date_range" />
                                                </div>
                                                <!--end::Filter Date-->
                                                <!--begin::Cari Button -->
                                                {{-- <div class="col-lg-6 mb-2">
                                                    <button type="submit" class="btn btn-success me-3"> <i
                                                            class="ki-outline ki-search-list fs-2"></i>Generate Laporan</button>
                                                </div> --}}
                                                <!--end::Cari Button -->
                                            </div>
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info">Generate</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Generate Modal-->
                    
                    <!--begin::Export Modal-->
                    <div class="modal fade" tabindex="-1" id="kt_modal_export">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <form action="/admin/laporan/exportExcel" method="GET">
                                    <div class="modal-header">
                                        <h3 class="modal-title">Export Laporan</h3>
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <div class="modal-body">
                                        <!--begin::Toolbar-->
                                        <div class="d-flex">
                                            <div class="row">
                                                @if (auth()->user()->role == "System Administrator" || auth()->user()->role == "Dinkes")
                                                    <!--begin::Filter Puskesmas-->
                                                    <div class="col-lg-8 mb-2 ">
                                                        <label class="fs-6 form-label fw-bold text-gray-900">Puskesmas</label>
                                                        <select class="btn btn-light me-3" data-control="select2"
                                                            data-placeholder="Pilih Puskesmas" name="puskesmas" id="puskesmas"
                                                            data-allow-clear="true">
                                                            <option></option>
                                                            @foreach ($puskesmas as $pus)
                                                                <option value="{{ $pus->kode }}">{{ $pus->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Filter Puskesmas-->
                                                @elseif (auth()->user()->role == "Puskesmas")
                                                    <!--begin::Filter Puskesmas-->
                                                    <div class="col-lg-8 mb-2 ">
                                                        <label class="fs-6 form-label fw-bold text-gray-900">Puskesmas</label>
                                                        <select class="btn btn-light me-3" data-control="select2"
                                                            data-placeholder="Pilih Puskesmas" name="puskesmas" id="puskesmas"
                                                            data-allow-clear="true" @readonly(true)>
                                                            <option value="{{ auth()->user()->puskesmas->kode }}" selected>{{ auth()->user()->puskesmas->nama }}</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Filter Puskesmas-->
                                                @endif
                                                <!--begin::Filter Date-->
                                                <div class="col-lg-4 mb-5">
                                                    <label class="fs-6 form-label fw-bold text-gray-900">Tanggal</label>
                                                    <br>
                                                    <input class="btn btn-primary me-3" placeholder="Pick date rage"
                                                        id="kt_datefilter_export" name="date_range" />
                                                </div>
                                                <!--end::Filter Date-->
                                                <!--begin::Cari Button -->
                                                {{-- <div class="col-lg-6 mb-2">
                                                    <button type="submit" class="btn btn-success me-3"> <i
                                                            class="ki-outline ki-search-list fs-2"></i>Generate Laporan</button>
                                                </div> --}}
                                                <!--end::Cari Button -->
                                            </div>
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-info">Export</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Export Modal-->

                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Card Filter-->
                {{-- <div class="card mb-5">
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Title-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <button type="button" class="btn btn-outline btn-outline-dashed me-2 mb-2" disabled>
                                    <i class="ki-outline ki-filter fs-2"></i>Filter Laporan</button>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <form action="#" method="GET">
                                <!--begin::Toolbar-->
                                <div class="d-flex">
                                    <div class="row">
                                        <!--begin::Filter Puskesmas-->
                                        <div class="col-lg-6 mb-2 ">
                                            <label class="fs-6 form-label fw-bold text-gray-900">Puskesmas</label>
                                            <select class="btn btn-light me-3" data-control="select2"
                                                data-placeholder="Pilih Puskesmas" name="puskesmas" id="puskesmas"
                                                data-allow-clear="true">
                                                <option></option>
                                                @foreach ($puskesmas as $pus)
                                                    <option value="{{ $pus->kode }}">{{ $pus->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--end::Filter Puskesmas-->

                                        <!--begin::Filter Date-->
                                        <div class="col-lg-6 mb-5">
                                            <label class="fs-6 form-label fw-bold text-gray-900">Tanggal</label>
                                            <br>
                                            <input class="btn btn-primary me-3" placeholder="Pick date rage"
                                                id="kt_datefilter_puskesmas" name="date_range" />
                                        </div>
                                        <!--end::Filter Date-->
                                        <!--begin::Cari Button -->
                                        <div class="col-lg-6 mb-2">
                                            <button type="submit" class="btn btn-success me-3"> <i
                                                    class="ki-outline ki-search-list fs-2"></i>Generate Laporan</button>
                                        </div>
                                        <!--end::Cari Button -->
                                    </div>
                                </div>
                                <!--end::Toolbar-->
                            </form>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <br>
                </div> --}}
                <!--end::Card Filter-->

                <!--begin::Products-->
                @if (request()->has('puskesmas') && request()->has('date_range'))
                <div class="alert alert-success mb-2" role="alert">
                    Data Laporan Puskesmas : <strong>{{$kelurahans->first()->puskesmas->nama}}</strong>, Periode : <strong>{{ \Illuminate\Support\Carbon::parse($startDate)->translatedFormat('d F Y') }} - {{ \Illuminate\Support\Carbon::parse($endDate)->translatedFormat('d F Y') }}</strong>.
                </div>

                <div class="card card-flush">
                    <!--begin::Card body-->
                    <div class="table-responsive">
                        <table class="table table-bordered gs-4 gy-4 gx-4">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th class="text-center align-middle min-w-200px">Kelompok</th>
                                    <th class="text-center align-middle min-w-300px">Indikator</th>
                                    @foreach ($kelurahans as $kelurahan)
                                        <th class="text-center align-middle">{{ $kelurahan->nama }}</th>
                                    @endforeach
                                    <th class="text-center align-middle">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $lastKelompok = null;
                                    $rowspanCounts = [];
                                @endphp
                    
                                @foreach ($indicators as $indikator)
                                    @php
                                        $kelompokNama = $indikator->kelompok->nama;
                                        if (!isset($rowspanCounts[$kelompokNama])) {
                                            $rowspanCounts[$kelompokNama] = collect($indicators)
                                                ->where('kelompok.nama', $kelompokNama)
                                                ->count();
                                        }
                                        // Tentukan apakah baris ini harus di-highlight
                                        $highlightClass = Str::contains($indikator->nama, '(L+P)') ? 'highlight-lp' : '';
                                    @endphp
                    
                                    <tr class="{{ $highlightClass }}">
                                        @if ($lastKelompok !== $kelompokNama)
                                            <td class="text-center align-middle fw-bold fs-6" rowspan="{{ $rowspanCounts[$kelompokNama] }}">
                                                {{ $kelompokNama }}
                                            </td>
                                            @php $lastKelompok = $kelompokNama; @endphp
                                        @endif
                                        <td class="text-left align-middle fw-bold fs-6">
                                            {{ $indikator->nama }}
                                        </td>
                                        @foreach ($kelurahans as $kelurahan)
                                            <td class="text-center align-middle fw-bold fs-6 px-7">
                                                {{ $results[$kelurahan->nama][$kelompokNama][$indikator->nama] ?? 0 }}
                                            </td>
                                        @endforeach
                                        <td class="text-center align-middle fw-bold fs-6 px-7">
                                            {{ $totals[$kelompokNama][$indikator->nama] ?? 0 }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <style>
                        .highlight-lp td {
                            background-color: #FFC107 !important; /* Warna kuning seperti pada gambar */
                            font-weight: bold;
                        }
                    </style>
                    <!--end::Card body-->
                </div>
                @else
                <div class="alert alert-info" role="alert">
                    <strong>Informasi:</strong> Silakan lakukan filter terlebih dahulu untuk melihat data laporan.
                </div>
                @endif
                <!--end::Products-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->

    </div>
    <!--end::Content wrapper-->
@endsection

@section('plugins-last')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript(used for this page only)-->

    <script src="{{ asset('template/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('template/assets/js/custom/widgets.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    <!--end::Vendors Javascript-->

    <!--begin::Datatables Javascript-->
    {{-- <script>
        $("#kt_datatable_zero_configuration").DataTable({
            "scrollX": true,
            "info": false,
            'order': [],
            'pageLength': 100,
            'drawCallback': function(settings) {
                // Merge cells untuk kolom 'Kelompok'
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                var rowspan = 1;

                // Column index 0 adalah kolom 'Kelompok'
                api.column(0, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        // New group encountered
                        if (rowspan > 1) {
                            // Set rowspan untuk group sebelumnya
                            for (var j = i - rowspan; j < i; j += rowspan) {
                                $(rows[j]).find('td:first-child').attr('rowspan', rowspan);
                            }
                        }
                        last = group;
                        rowspan = 1;
                    } else {
                        // Group yang sama
                        $(rows[i]).find('td:first-child').remove();
                        rowspan++;
                    }

                    // Handle group terakhir
                    if (i === api.column(0, {
                            page: 'current'
                        }).data().length - 1 && rowspan > 1) {
                        for (var j = i - rowspan + 1; j <= i; j += rowspan) {
                            $(rows[j]).find('td:first-child').attr('rowspan', rowspan);
                        }
                    }
                });
            }
        });
    </script> --}}
    <!--end::Datatables Javascript-->

    <!--begin:: Page Loader Javascript-->
    {{-- <script>
        // Toggle
        const button = document.querySelector("#kt_page_loading_message");

        // Handle toggle click event
        button.addEventListener("click", function() {
            // Populate the page loading element dynamically.
            // Optionally you can skipt this part and place the HTML
            // code in the body element by refer to the above HTML code tab.
            const loadingEl = document.createElement("div");
            document.body.prepend(loadingEl);
            loadingEl.classList.add("page-loader");
            loadingEl.classList.add("flex-column");
            loadingEl.innerHTML = `
                <span class="spinner-border text-primary" role="status"></span>
                <span class="text-muted fs-6 fw-semibold mt-5">Sedang Mencari Data...</span>
            `;

            // Show page loading
            KTApp.showPageLoading();

            // Hide after 3 seconds
            setTimeout(function() {
                KTApp.hidePageLoading();
                loadingEl.remove();
            }, 10000);
        });
    </script> --}}
    <!--end:: Page Loader Javascript-->

    <!--begin::Filter Puskemsas Generate-->
    <script>
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#kt_datefilter_generate").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#kt_datefilter_generate").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Hari Ini": [moment(), moment()],
                "Kemarin": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "7 Hari Terakhir": [moment().subtract(6, "days"), moment()],
                "30 Hari Terakhir": [moment().subtract(29, "days"), moment()],
                "Bulan Ini": [moment().startOf("month"), moment().endOf("month")],
                "Bulan Lalu": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                    "month")]
            }
        }, cb);

        cb(start, end);
    </script>
    <!--end::Filter Puskemsas Generate-->

    <!--begin::Filter Puskemsas Export-->
    <script>
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#kt_datefilter_export").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#kt_datefilter_export").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Hari Ini": [moment(), moment()],
                "Kemarin": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "7 Hari Terakhir": [moment().subtract(6, "days"), moment()],
                "30 Hari Terakhir": [moment().subtract(29, "days"), moment()],
                "Bulan Ini": [moment().startOf("month"), moment().endOf("month")],
                "Bulan Lalu": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                    "month")]
            }
        }, cb);

        cb(start, end);
    </script>
    <!--end::Filter Puskemsas Export-->

    <!-- begin sessions -->
    @if (session('status') && session('message'))
        <script>
            let status = "{{ session('status') }}";
            let message = "{{ session('message') }}";

            if (status === 'success') {
                Swal.fire({
                    text: message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Baiklah !!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            } else if (status === 'error') {
                Swal.fire({
                    text: message,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Baiklah !!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            } else if (status === 'warning') {
                Swal.fire({
                    text: message,
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "Baiklah !!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        </script>
    @endif
    <!-- end sessions -->
@endsection
