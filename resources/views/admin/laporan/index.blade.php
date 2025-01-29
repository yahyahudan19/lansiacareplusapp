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
                        <a href="#" class="btn btn-info btn-sm">
                            <i class="ki-duotone ki-file-sheet"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Export Data
                        </a>
                    </div>
                    <!--end::Actions-->
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
                <div class="card mb-5">
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
                                {{-- @csrf --}}
                                <!--begin::Toolbar-->
                                <div class="d-flex">
                                    <div class="row">
                                        <!--begin::Filter Puskesmas-->
                                        <div class="col-lg-6 mb-2 ">
                                            {{-- <div class="w-200px"> --}}
                                            <label class="fs-6 form-label fw-bold text-gray-900">Puskesmas</label>
                                            <select class="btn btn-light me-3" data-control="select2"
                                                data-placeholder="Pilih Puskesmas" name="puskesmas" id="puskesmas"
                                                data-allow-clear="true">
                                                <option></option>
                                                @foreach ($puskesmas as $pus)
                                                    <option value="{{ $pus->kode }}">{{ $pus->nama }}</option>
                                                @endforeach
                                            </select>
                                            {{-- </div> --}}
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
                </div>
                <!--end::Card Filter-->

                <!--begin::Products-->
                @if (request()->has('puskesmas') && request()->has('date_range'))
                <div class="card card-flush">
                    <!--begin::Card body-->
                    <div class="table-responsive">
                        <table id="kt_datatable_zero_configuration"
                            class="table table-striped table-row-bordered gy-5 gs-7">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th class="text-center align-middle min-w-300px">Kelompok</th>
                                    <th class="text-center align-middle min-w-300px">Indikator</th>
                                    @foreach ($kelurahans as $kelurahan)
                                        <th class="text-center align-middle min-w-300px">{{ $kelurahan->nama }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($indicators as $indikator)
                                    <tr>
                                        <td class="text-center align-middle fw-bold fs-6 text-gray-800">
                                            {{ $indikator->kelompok->nama }}
                                        </td>
                                        <td class="text-left align-middle fw-bold fs-6 text-gray-800">
                                            {{ $indikator->nama }}
                                        </td>
                                        @foreach ($kelurahans as $kelurahan)
                                            <td class="text-center align-middle fw-bold fs-6 text-gray-800 px-7">
                                                {{ $results[$kelurahan->nama][$indikator->kelompok->nama][$indikator->nama] ?? 0 }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
    <script>
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
    </script>
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

    <!--begin::Filter Puskemsas-->
    <script>
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#kt_datefilter_puskesmas").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#kt_datefilter_puskesmas").daterangepicker({
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
    <!--end::Filter Puskemsas-->

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
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            } else if (status === 'error') {
                Swal.fire({
                    text: message,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            } else if (status === 'warning') {
                Swal.fire({
                    text: message,
                    icon: "warning",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        </script>
    @endif
    <!-- end sessions -->
@endsection
