@extends('components.layout')

@section('title')
    Laporan Puskesmas
@endsection

@section('plugins-head')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Laporan Puskesmas</h1>
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
                    <a href="#" class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">Add Member</a>
                    <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" >Export Data</a>
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
            <!--begin::Products-->
            <div class="card card-flush">
                <!--begin::Card body-->
                {{-- <div class="card-body pt-0"> --}}
                    <div class="table-responsive">
                        <table id="kt_datatable_zero_configuration" class="table table-striped table-row-bordered gy-5 gs-7">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th class="text-center align-middle min-w-300px">Kelompok</th>
                                    <th class="text-center align-middle min-w-300px">Indikator</th>
                                    @foreach ($kelurahans as $kelurahan)
                                        <th class="text-center align-middle min-w-300px">{{$kelurahan->nama}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($indicators as $indikator)
                                    <tr>
                                        <td class="text-center align-middle fw-bold fs-6 text-gray-800">
                                            {{$indikator->kelompok->nama}}
                                        </td>
                                        <td class="text-left align-middle fw-bold fs-6 text-gray-800">
                                            {{$indikator->nama}}
                                        </td>
                                        @foreach ($kelurahans as $kelurahan)
                                            <td class="text-center align-middle fw-bold fs-6 text-gray-800 px-7">
                                                {{ $dataCounts[$indikator->id][$kelurahan->id] ?? 0 }}
                                            </td>
                                        @endforeach
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                {{-- </div> --}}
                
                <!--end::Card body-->
            </div>
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
    <script src="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
	<!--end::Vendors Javascript(used for this page only)-->
	
	<script src="{{ asset('template/assets/js/widgets.bundle.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/widgets.js')}}"></script>
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
                var rows = api.rows({ page: 'current' }).nodes();
                var last = null;
                var rowspan = 1;
    
                // Column index 0 adalah kolom 'Kelompok'
                api.column(0, { page: 'current' }).data().each(function(group, i) {
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
                    if (i === api.column(0, { page: 'current' }).data().length - 1 && rowspan > 1) {
                        for (var j = i - rowspan + 1; j <= i; j += rowspan) {
                            $(rows[j]).find('td:first-child').attr('rowspan', rowspan);
                        }
                    }
                });
            }
        });
    </script>
    <!--end::Datatables Javascript-->
  
    
    <!--begin::Ajax Kelurahans Javascript-->
    <script>
        $(document).ready(function() {
            $('#kecamatan').change(function() {
                var kecamatanID = $(this).val();
                // console.log("Kecamatan terpilih: " + kecamatanID); // Log kecamatan yang dipilih
                if (kecamatanID) {
                    $.ajax({
                        url: '/getKelurahan/' + kecamatanID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log("Data kelurahan:", data); // Log data kelurahan yang diterima
                            $('#kelurahan').empty();
                            $('#kelurahan').append('<option></option>');
                            $.each(data, function(key, value) {
                                $('#kelurahan').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#kelurahan').empty();
                    $('#kelurahan').append('<option></option>');
                }
            });
        });
    </script>
    <!--end::Ajax Kelurahans Javascript-->


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


    <!-- begin sessions -->
    @if(session('status') && session('message'))
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
            } 
            else if (status === 'error') {
                Swal.fire({
                    text: message,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
            else if (status === 'warning') {
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