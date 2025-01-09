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
                    <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">New Campaign</a>
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
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                            <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Report" />
                        </div>
                        <!--end::Search-->
                        <!--begin::Export buttons-->
                        <div id="kt_ecommerce_report_customer_orders_export" class="d-none"></div>
                        <!--end::Export buttons-->
                    </div>
                    <!--end::Card title==

                    <!==begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <!--begin::Daterangepicker-->
                        <input class="form-control form-control-solid w-100 mw-250px" placeholder="Pick date range" id="kt_ecommerce_report_customer_orders_daterangepicker" />
                        <!--end::Daterangepicker-->
                        <!--begin::Filter-->
                        <div class="w-150px">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
                                <option></option>
                                <option value="all">All</option>
                                <option value="active">Active</option>
                                <option value="locked">Locked</option>
                                <option value="disabled">Disabled</option>
                                <option value="banned">Banned</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--end::Filter-->
                        <!--begin::Export dropdown-->
                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-outline ki-exit-up fs-2"></i>Export Report</button>
                        <!--begin::Menu-->
                        <div id="kt_ecommerce_report_customer_orders_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="copy">Copy to clipboard</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="excel">Export as Excel</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="csv">Export as CSV</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="pdf">Export as PDF</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--end::Export dropdown-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_report_customer_orders_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-100px">Kelompok</th>
                                <th class="min-w-100px">Indikator</th>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($data_indikator as $indikator)
                            <tr>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">{{$indikator->kelompok->nama}}</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">{{$indikator->nama}}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
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
    <!--begin::Vendors Javascript(used for this page only)-->
    
	<!--begin::Custom Javascript(used for this page only)-->
	
	<script src="{{ asset('template/assets/js/widgets.bundle.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/widgets.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/apps/chat/chat.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/utilities/modals/users-search.js')}}"></script>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->
    <!--end::Vendors Javascript-->

    <!--begin::Datatables Javascript-->
    <script>
        "use strict";

        // Class definition
        var KTAppEcommerceReportCustomerOrders = function () {
            // Shared variables
            var table;
            var datatable;

            // Private functions
            var initDatatable = function () {
                // Init datatable
                datatable = $(table).DataTable({
                    "info": false,
                    'order': [],
                    'pageLength': 10,
                    'drawCallback': function (settings) {
                        // Merge cells for 'Kelompok' column after each draw
                        var api = this.api();
                        var rows = api.rows({ page: 'current' }).nodes();
                        var last = null;
                        var rowspan = 1;

                        // Column index for 'Kelompok' (assuming it's the first column, index 0)
                        api.column(0, { page: 'current' }).data().each(function (group, i) {
                            if (last !== group) {
                                // New group encountered
                                if (rowspan > 1) {
                                    // Set rowspan for previous group
                                    for (var j = i - rowspan; j < i; j += rowspan) {
                                        $(rows[j]).find('td:first-child').attr('rowspan', rowspan);
                                    }
                                }
                                last = group;
                                rowspan = 1;
                            } else {
                                // Same group
                                $(rows[i]).find('td:first-child').remove();
                                rowspan++;
                            }

                            // Handle the last group
                            if (i === api.column(0, { page: 'current' }).data().length - 1 && rowspan > 1) {
                                for (var j = i - rowspan + 1; j <= i; j += rowspan) {
                                    $(rows[j]).find('td:first-child').attr('rowspan', rowspan);
                                }
                            }
                        });
                    }
                });
            }

            // Hook export buttons
            var exportButtons = () => {
                const documentTitle = 'Laporan Skrining Puskesmas X';
                
                // Helper function untuk mendapatkan group data
                function processData(data) {
                    let result = [];
                    let currentGroup = '';
                    let groupStartIndex = 0;
                    
                    data.forEach((row, index) => {
                        if (currentGroup !== row[0]) {
                            if (index > 0) {
                                result.push({
                                    group: currentGroup,
                                    startIndex: groupStartIndex,
                                    rowspan: index - groupStartIndex
                                });
                            }
                            currentGroup = row[0];
                            groupStartIndex = index;
                        }
                    });
                    
                    // Handle grup terakhir
                    result.push({
                        group: currentGroup,
                        startIndex: groupStartIndex,
                        rowspan: data.length - groupStartIndex
                    });
                    
                    return result;
                }

                var buttons = new $.fn.dataTable.Buttons(table, {
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            title: documentTitle,
                            autoFilter: true,
                            sheetName: 'Laporan Skrining',
                            className: 'btn btn-sm btn-light-primary',
                            exportOptions: {
                                columns: ':visible',
                                format: {
                                    header: function(data, columnIdx) {
                                        return data.replace(/<[^>]*>/g, '').trim();
                                    },
                                    body: function(data, row, column, node) {
                                        // Bersihkan HTML tags dan whitespace
                                        return data.replace(/<[^>]*>/g, '').trim();
                                    }
                                }
                            },
                            customizeData: function(data) {
                                // Proses data sebelum export
                                var rows = data.body;
                                var processedRows = [];
                                var currentGroup = '';
                                var firstInGroup = true;
                                
                                rows.forEach(function(row) {
                                    if (currentGroup !== row[0]) {
                                        currentGroup = row[0];
                                        firstInGroup = true;
                                    }
                                    
                                    // Hanya tampilkan nilai kelompok pada baris pertama dalam group
                                    if (!firstInGroup) {
                                        row[0] = ''; // Kosongkan cell untuk baris berikutnya dalam group yang sama
                                    }
                                    firstInGroup = false;
                                    processedRows.push(row);
                                });
                                
                                data.body = processedRows;
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: documentTitle,
                            customize: function(doc) {
                                var data = datatable.rows().data().toArray();
                                var groupInfo = processData(data);
                                var body = [];
                                
                                data.forEach((row, index) => {
                                    let group = groupInfo.find(g => 
                                        index >= g.startIndex && 
                                        index < (g.startIndex + g.rowspan)
                                    );
                                    
                                    if (index === group.startIndex) {
                                        // Baris pertama dalam group
                                        body.push([
                                            { 
                                                text: row[0].replace(/<[^>]*>/g, ''),
                                                rowSpan: group.rowspan
                                            },
                                            { text: row[1].replace(/<[^>]*>/g, '') }
                                        ]);
                                    } else {
                                        // Baris selanjutnya dalam group
                                        body.push([
                                            '', // Cell kosong karena di-rowspan
                                            { text: row[1].replace(/<[^>]*>/g, '') }
                                        ]);
                                    }
                                });
                                
                                // Update table body
                                doc.content[1].table.body = body;
                                
                                // Styling
                                doc.styles.tableHeader = {
                                    bold: true,
                                    fontSize: 11,
                                    color: 'black',
                                    fillColor: '#eeeeee'
                                };
                            },
                            pageSize: 'A4',
                            orientation: 'portrait',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            title: documentTitle,
                            exportOptions: {
                                columns: ':visible',
                                format: {
                                    body: function(data, row, column) {
                                        return data.replace(/<[^>]*>/g, '');
                                    }
                                }
                            }
                        }
                    ]
                }).container().appendTo($('#kt_ecommerce_report_customer_orders_export'));

                // Hook dropdown menu click event to datatable export buttons
                const exportButtons = document.querySelectorAll('#kt_ecommerce_report_customer_orders_export_menu [data-kt-ecommerce-export]');
                exportButtons.forEach(exportButton => {
                    exportButton.addEventListener('click', e => {
                        e.preventDefault();
                        const exportValue = e.target.getAttribute('data-kt-ecommerce-export');
                        const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
                        target.click();
                    });
                });
            }

            // Search Datatable
            var handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[data-kt-ecommerce-order-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    datatable.search(e.target.value).draw();
                });
            }

            // Handle status filter
            var handleStatusFilter = () => {
                const filterStatus = document.querySelector('[data-kt-ecommerce-order-filter="status"]');
                $(filterStatus).on('change', e => {
                    let value = e.target.value;
                    if (value === 'all') {
                        value = '';
                    }
                    datatable.column(2).search(value).draw();
                });
            }

            // Public methods
            return {
                init: function () {
                    table = document.querySelector('#kt_ecommerce_report_customer_orders_table');

                    if (!table) {
                        return;
                    }

                    initDatatable();
                    exportButtons();
                    handleSearchDatatable();
                    handleStatusFilter();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTAppEcommerceReportCustomerOrders.init();
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

    <!--begin::datepick Javascript-->
    <script>
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_date_only"), {
            display: {
                viewMode: "calendar",
                components: {
                    decades: true,
                    year: true,
                    month: true,
                    date: true,
                }
            }
        });
    </script>
    <!--end::datepick Javascript-->

    <!--begin:: Page Loader Javascript-->
    <script>
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
    </script>
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