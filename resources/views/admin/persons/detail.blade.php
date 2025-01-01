@extends('components.layout')

@section('title')
    Detail Penduduk
@endsection

@section('plugins-head')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Penduduk Details</h1>
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
                        <li class="breadcrumb-item text-muted">Penduduk</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Details</li>
                        <!--end::Item-->
                        
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                
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
            <!--begin::Penduduk details page-->
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x bPenduduk-0 fs-4 fw-semibold mb-lg-n2 me-auto">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_sales_Penduduk_summary">Penduduk Summary</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    @if (Auth::user()->role == "System Administrator")
                        <!--begin::Button-->
                        <a href="/admin/penduduk" class="btn btn-success">
                            <i class="ki-duotone ki-left-square"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Kembali
                        </a>
                        <!--end::Button-->
                    @elseif(Auth::user()->role == "Dinkes")
                        <!--begin::Button-->
                        <a href="/dinkes/penduduk" class="btn btn-success">
                            <i class="ki-duotone ki-left-square"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Kembali
                        </a>
                        <!--end::Button-->
                    @else
                        <!--begin::Button-->
                        <a href="/puskesmas/penduduk" class="btn btn-success">
                            <i class="ki-duotone ki-left-square"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Kembali
                        </a>
                        <!--end::Button-->
                    @endif
                    
                    {{-- <a href="/admin/penduduk/edit/" class="btn btn-primary btn-sm">Edit Penduduk</a> --}}
                    @if ($persons->created_by == Auth::user()->id)
                    <!--begin::Button-->
                    <a href="/admin/penduduk/edit/{{$persons->id}}" class="btn btn-warning">
                        <i class="ki-duotone ki-notepad-edit"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                        Edit Penduduk
                    </a>
                    <!--end::Button-->
                    @endif

                </div>
                <!--begin::Penduduk summary-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                     <!--begin::Customer details-->
                     <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Detail Data Diri :</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bPenduduked mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-profile-circle fs-2 me-2"></i>Nama Lengkap</div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin::Name-->
                                                    <a href="#" class="text-gray-600 text-hover-primary">{{$persons->nama}}</a>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-text-number fs-2 me-2"></i>NIK</div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <a href="#" class="text-gray-600 text-hover-primary">{{$persons->nik}}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-profile-user fs-2 me-2"></i>Jenis Kelamin</div>
                                            </td>
                                            @if ($persons->jenis_kelamin == "L")
                                                <td class="fw-bold text-end">Laki-Laki</td>
                                            @else
                                                <td class="fw-bold text-end">Perempuan</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-phone fs-2 me-2"></i>Telepon</div>
                                            </td>
                                            @if ($persons->telp == NULL || $persons->telp == 0)
                                                <td class="fw-bold text-end">Tidak Ada Data</td>
                                            @else
                                                <td class="fw-bold text-end">{{$persons->telp}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-plus-square fs-2 me-2"></i>BPJS</div>
                                            </td>
                                            @if ($persons->bpjs == NULL)
                                                <td class="fw-bold text-end">Tidak Ada Data</td>
                                            @else
                                                <td class="fw-bold text-end">{{$persons->bpjs}}</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Customer details-->
                    <!--begin::Penduduk details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Kategori :</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bPenduduked mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-calendar fs-2 me-2"></i>Tanggal Lahir</div>
                                            </td>
                                            <td class="fw-bold text-end">{{ \Illuminate\Support\Carbon::parse($persons->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-user-tick fs-2 me-2"></i>Usia </div>
                                            </td>
                                            <td class="fw-bold text-end">{{$age}} Tahun 
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-category fs-2 me-2"></i>Kategori</div>
                                            </td>
                                            <td class="fw-bold text-end">{{$kategori}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-tree fs-2 me-2"></i>Status</div>
                                            </td>
                                            <td class="fw-bold text-end">{{$persons->status}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-check-square fs-2 me-2"></i>Validasi</div>
                                            </td>
                                            @if ($persons->valid)
                                                <td class="fw-bold text-end">Valid</td>
                                            @else
                                                <td class="fw-bold text-end">Belum Valid</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Penduduk details-->
                   
                    
                </div>
                <!--end::Penduduk summary-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_sales_Penduduk_summary" role="tab-panel">
                        <!--begin::Penduduks-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                <!--begin::Payment address-->
                                <div class="card card-flush py-4 flex-row-fluid position-relative">
                                    <!--begin::Background-->
                                    <div class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                        <i class="ki-solid ki-address-book" style="font-size: 14em"></i>
                                    </div>
                                    <!--end::Background-->
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Alamat</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">{{$persons->alamat}}
                                    <br />RT {{$persons->rt}}, RW {{$persons->rw}},
                                    <br />Kelurahan {{$persons->kelurahan->nama}}, Kecamatan {{$persons->kelurahan->kecamatan->nama}}
                                    <br />Kota Malang.</div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Payment address-->
                                
                            </div>
                            
                        </div>
                        <!--end::Penduduks-->
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Penduduk details page-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@endsection

@section('plugins-last')

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('template/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{ asset('template/assets/js/custom/widgets.js')}}"></script>
    <script src="{{ asset('template/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{ asset('template/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{ asset('template/assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
    <script src="{{ asset('template/assets/js/custom/utilities/modals/users-search.js')}}"></script>
    <!--end::Custom Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
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