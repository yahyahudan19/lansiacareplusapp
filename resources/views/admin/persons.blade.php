@extends('components.layout')

@section('title')
    Penduduk
@endsection

@section('plugins-head')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Data Semua Penduduk</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/dashboard" class="text-muted text-hover-primary">Home</a>
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
                        <li class="breadcrumb-item text-muted">Semua Penduduk</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="#" class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">Add Member</a>
                    <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">New Campaign</a>
                </div> --}}
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
            <div>
                <form action="/penduduk/find" method="GET">
                    <!--begin::Card-->
                    <div class="card mb-7">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Compact form-->
                            <div class="d-flex align-items-center">
                                <!--begin::Input group-->
                                <div class="position-relative w-md-1000px me-md-2">
                                    <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6"></i>
                                    <input type="text" class="form-control form-control-solid ps-10" name="search" value="" placeholder="Cari Nama atau NIK" />
                                </div>
                                <!--end::Input group-->
                                <!--begin:Action-->
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-success me-5">Cari</button>
                                </div>
                                <!--end:Action-->
                            </div>
                            <!--end::Compact form-->
                            
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </form>
            </div>
            <!--begin::Card Filter-->
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <button type="button" class="btn btn-outline btn-outline-dashed me-2 mb-2" disabled>
                            <i class="ki-outline ki-filter fs-2"></i>Filter Penduduk </button>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <form action="/penduduk/cari" method="GET">
                            {{-- @csrf --}}
                            <!--begin::Toolbar-->
                            <div class="d-flex">
                                <div class="row">
                                    <!--begin::Filter Kecamatan-->
                                    <div class="col-lg-6 mb-2 ">
                                        {{-- <div class="w-200px"> --}}
											<label class="fs-6 form-label fw-bold text-gray-900">Kecamatan</label>
                                            <select class="btn btn-light me-3" data-control="select2" data-placeholder="Pilih Kecamatan" name="kecamatan" id="kecamatan" data-allow-clear="true">
                                                <option></option>
                                                @foreach ($kecamatans as $kec)
                                                    <option value="{{$kec->id}}">{{$kec->nama}}</option>
                                                @endforeach
                                            </select>
                                        {{-- </div> --}}
                                    </div>
                                    <!--end::Filter Kecamatan-->
                                    
                                    <!--begin::Filter kelurahan-->
                                    <div class="col-lg-6 mb-2 ">
                                        {{-- <div class="w-200px"> --}}
											<label class="fs-6 form-label fw-bold text-gray-900">Kelurahan</label>
                                            <select class="btn btn-light me-3" data-control="select2" data-placeholder="Pilih Kelurahan" name="kelurahan" id="kelurahan" data-allow-clear="true">
                                                <option></option>
                                            </select>
                                        {{-- </div> --}}
                                    <!--end::Filter kelurahan-->
                                    </div>
                                    <!--begin::Filter kelurahan-->
                                    <div class="col-lg-6 mb-2 ">
                                        {{-- <div class="w-200px"> --}}
											<label class="fs-6 form-label fw-bold text-gray-900">Kategori</label>
                                            <select class="btn btn-light me-3" data-control="select2" data-placeholder="Pilih Kategori" name="kategori" id="kategori">
                                                <option value="Semua" {{ request()->is('admin/penduduk') ? 'selected' : '' }}>Semua</option>
                                                <option value="Lansia" {{ request()->is('admin/penduduk/lansia') ? 'selected' : '' }}>Lansia</option>
                                                <option value="Pra-Lansia" {{ request()->is('admin/penduduk/pra-lansia') ? 'selected' : '' }}>Pra-Lansia</option>
                                            </select>
                                        {{-- </div> --}}
                                    <!--end::Filter kelurahan-->
                                    </div>
                                    <!--begin::Filter Date-->
                                    <div class="col-lg-6 mb-5">
                                        <label class="fs-6 form-label fw-bold text-gray-900">Tanggal</label>
                                        <br>
                                        <input class="btn btn-primary me-3" placeholder="Pick date rage" id="kt_daterangepicker_4" name="date_range"/>
                                    </div>
                                    <!--end::Filter Date-->
                                    <!--begin::Cari Button -->
                                    <div class="col-lg-6 mb-2">
                                        <button type="submit" class="btn btn-success me-3"> <i class="ki-outline ki-search-list fs-2"></i>Cari Penduduk</button>
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
            <br>
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Cari Penduduk" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5" data-kt-user-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Jenis Kelamin:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="role" data-hide-search="true">
                                            <option></option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Status:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-user-table-filter="two-step" data-hide-search="true">
                                            <option></option>
                                            <option value="Hidup">Hidup</option>
                                            <option value="Meninggal">Meninggal</option>
                                            <option value="Tidak Diketahui">Tidak Diketahui</option>
                                        </select>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                            @if (in_array(auth()->user()->role, ['System Administrator', 'Puskesmas', 'Kader']))
                               <!--begin::Add user-->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                                <i class="ki-outline ki-plus fs-2"></i>Tambah Penduduk</button>
                                <!--end::Add user--> 
                            @endif
                            
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                        
                        <!--begin::Modal - Add Penduduk-->
                        <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header" id="kt_modal_add_user_header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bold">Tambah Penduduk </h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                            <i class="ki-outline ki-cross fs-1"></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::Modal header-->
                                    <!--begin::Modal body-->
                                    <div class="modal-body px-5 my-7">
                                        <!--begin::Form-->
                                        <form id="kt_modal_add_user_form" class="form" action="/admin/penduduk/store" method="POST">
                                            @csrf
                                            <!--begin::Scroll-->
                                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                                                
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">Nama Lengkap</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="person_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama Lengkap" value="User Test" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="required fw-semibold fs-6 mb-2">NIK</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="person_nik" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="NIK" value="35730439090000004" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--end::begin group-->
                                                <div class="row g-9 mb-7">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="required fw-semibold fs-6 mb-2">No. Telp</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="person_telp" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="No. Telp" value="6281259224380" />
                                                        <!--end::Input-->
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="form-label required">Tanggal Lahir</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="input-group" id="kt_td_picker_date_only" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                                        <input id="kt_td_picker_date_only_input" type="text" class="form-control" data-td-target="#kt_td_picker_date_only" name="person_tl"/>
                                                        <span class="input-group-text" data-td-target="#kt_td_picker_date_only" data-td-toggle="datetimepicker">
                                                            <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                        </span>
                                                    </div>
                                                        <!--end::Input-->
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->

                                              
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="fw-semibold fs-6 mb-2">No. BPJS</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="person_bpjs" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="No. BPJS" value="1234561235" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                              
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="fw-semibold fs-6 mb-2 required">Alamat Lengkap</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="person_alamat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Alamat" value="Jl. Malang" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row g-9 mb-7">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="required fs-6 fw-semibold mb-2">RT</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid" placeholder="" name="person_rt" value="01">
                                                        <!--end::Input-->
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <!--begin::Label-->
                                                        <label class="required fs-6 fw-semibold mb-2">RW</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input class="form-control form-control-solid" placeholder="" name="person_rw" value="02">
                                                        <!--end::Input-->
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="form-label required">Kelurahan</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <select name="person_kelurahan" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                                        <option></option>
                                                        @foreach ($kelurahans as $kel)
                                                            <option value="{{$kel->id}}">{{$kel->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->
                                            <div class="text-center pt-10">
                                                <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait... 
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Modal - Add Penduduk-->
                        
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">Nama dan NIK</th>
                                <th class="min-w-125px">Jenis Kelamin</th>
                                <th class="min-w-125px">Kelurahan</th>
                                <th class="min-w-125px">Kategori</th>
                                <th class="min-w-125px">Usia</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($data_person as $person)
                                <tr data-person-id="{{ $person->id }}">
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="/persons/{{$person->id}}" class="text-gray-800 text-hover-primary mb-1">{{$person->nama}}</a>
                                            <span>{{$person->nik}}</span>
                                        </div>
                                        <!--begin::User details-->
                                    </td>
                                    <td>
                                        @if ($person->jenis_kelamin == "P")
                                            <div class="text-gray-800 text-hover-primary mb-1">Perempuan</div>
                                        @else
                                            <div class="text-gray-800 text-hover-primary mb-1">Laki-Laki</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($person->kelurahan->nama == NULL)
                                            <div class="badge badge-warning fw-bold">Tidak Diketahui</div>
                                        @else
                                            <div class="text-gray-800 text-hover-primary mb-1">{{$person->kelurahan->nama}}</div>
                                        @endif
                                    
                                    </td>
                                    <td>
                                        @if ($person->category == "Lansia")
                                            <div class="badge badge-danger fw-bold">{{$person->category}}</div>
                                        @elseif($person->category == "Pra-Lansia")
                                            <div class="badge badge-warning fw-bold">{{$person->category}}</div>
                                        @else
                                            <div class="badge badge-primary  fw-bold">{{$person->category}}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="badge badge-success fw-bold">{{$person->age}} Tahun</div>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            @if (Auth::user()->role == "System Administrator")
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="/admin/penduduk/{{$person->id}}" class="menu-link px-3">Detail</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="/admin/penduduk/edit/{{$person->id}}" class="menu-link px-3">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                            @else
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="/admin/penduduk/{{$person->id}}" class="menu-link px-3">Detail</a>
                                                </div>
                                                <!--end::Menu item-->
                                            @endif

                                            @if ($person->created_by == Auth::user()->id )

                                                @if (Auth::user()->role == "Dinkes")
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="/dinkes/penduduk/edit/{{$person->id}}" class="menu-link px-3">Edit</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                @else
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="/dinkes/penduduk/edit/{{$person->id}}" class="menu-link px-3">Edit</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                @endif
                                            
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
                                            </div>
                                            <!--end::Menu item-->
                                            @endif
                                            
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
@endsection

@section('plugins-last')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <!--end::Vendors Javascript-->
    
    <!--end::Custom Javascript-->

    <!--begin::Filter Person-->
    <script>
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#kt_daterangepicker_4").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#kt_daterangepicker_4").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
            "Hari Ini": [moment(), moment()],
            "Kemarin": [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "7 Hari Terakhir": [moment().subtract(6, "days"), moment()],
            "30 Hari Terakhir": [moment().subtract(29, "days"), moment()],
            "Bulan Ini": [moment().startOf("month"), moment().endOf("month")],
            "Bulan Lalu": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            }
        }, cb);

        cb(start, end);
    </script>
    <!--end::Filter Person-->

    <!--begin::Add Person Javascript-->
    <script>
        "use strict";
        // Class definition
        var KTUsersAddUser = function () {
            // Shared variables
            const element = document.getElementById('kt_modal_add_user');
            const form = element.querySelector('#kt_modal_add_user_form');
            const modal = new bootstrap.Modal(element);

            // Init add schedule modal
            var initAddUser = () => {

                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                var validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'person_name': {
                                validators: {
                                    notEmpty: {
                                        message: 'Nama Lengkap is required'
                                    }
                                }
                            },
                            'person_nik': {
                                validators: {
                                    notEmpty: {
                                        message: 'Valid NIK is required'
                                    }
                                }
                            },
                            'person_tl': {
                                validators: {
                                    notEmpty: {
                                        message: 'Valid Tanggal Lahir is required'
                                    }
                                }
                            },
                            'person_alamat': {
                                validators: {
                                    notEmpty: {
                                        message: 'Valid Alamat is required'
                                    }
                                }
                            },
                            'person_telp': {
                                validators: {
                                    notEmpty: {
                                        message: 'Valid No. Telp is required'
                                    }
                                }
                            },
                            'person_rt': {
                                validators: {
                                    notEmpty: {
                                        message: 'Valid RT is required'
                                    }
                                }
                            },
                            'person_rw': {
                                validators: {
                                    notEmpty: {
                                        message: 'Valid RW is required'
                                    }
                                }
                            },
                            'person_kelurahan': {
                                validators: {
                                    notEmpty: {
                                        message: 'Valid Kelurahan is required'
                                    }
                                }
                            },
                        },

                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',
                                eleValidClass: ''
                            })
                        }
                    }
                );

                // Submit button handler
                const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
                submitButton.addEventListener('click', e => {
                    e.preventDefault();

                    // Validate form before submit
                    if (validator) {
                        validator.validate().then(function (status) {
                            console.log('validated!');

                            if (status == 'Valid') {
                                // Show loading indication
                                submitButton.setAttribute('data-kt-indicator', 'on');

                                // Disable button to avoid multiple click 
                                submitButton.disabled = true;

                                // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                setTimeout(function () {
                                    // Remove loading indication
                                    submitButton.removeAttribute('data-kt-indicator');

                                    // Enable button
                                    submitButton.disabled = false;

                                    // Show popup confirmation 
                                    Swal.fire({
                                        text: "Form has been successfully submitted!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function (result) {
                                        if (result.isConfirmed) {
                                            modal.hide();
                                        }
                                    });

                                    form.submit(); // Submit form

                                }, 2000);
                            } else {
                                // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });
                    }
                });

                // Cancel button handler
                const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
                cancelButton.addEventListener('click', e => {
                    e.preventDefault();

                    Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            form.reset(); // Reset form			
                            modal.hide();	
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: "Your form has not been cancelled!.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                }
                            });
                        }
                    });
                });

                // Close button handler
                const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
                closeButton.addEventListener('click', e => {
                    e.preventDefault();

                    Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            form.reset(); // Reset form			
                            modal.hide();	
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: "Your form has not been cancelled!.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                }
                            });
                        }
                    });
                });
            }

            return {
                // Public functions
                init: function () {
                    initAddUser();
                }
            };
        }();
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTUsersAddUser.init();
        });
    </script>
    <!--end::Add Person Javascript-->

    <!--begin::Table Person Javascript-->
    <script>
        "use strict";

        var KTUsersList = function () {
            // Define shared variables
            var table = document.getElementById('kt_table_users');
            var datatable;
            var toolbarBase;
            var toolbarSelected;
            var selectedCount;

            // Private functions
            var initUserTable = function () {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const dateRow = row.querySelectorAll('td');
                    const lastLogin = dateRow[3].innerText.toLowerCase(); // Get last login time
                    let timeCount = 0;
                    let timeFormat = 'minutes';

                    // Determine date & time format -- add more formats when necessary
                    if (lastLogin.includes('yesterday')) {
                        timeCount = 1;
                        timeFormat = 'days';
                    } else if (lastLogin.includes('mins')) {
                        timeCount = parseInt(lastLogin.replace(/\D/g, ''));
                        timeFormat = 'minutes';
                    } else if (lastLogin.includes('hours')) {
                        timeCount = parseInt(lastLogin.replace(/\D/g, ''));
                        timeFormat = 'hours';
                    } else if (lastLogin.includes('days')) {
                        timeCount = parseInt(lastLogin.replace(/\D/g, ''));
                        timeFormat = 'days';
                    } else if (lastLogin.includes('weeks')) {
                        timeCount = parseInt(lastLogin.replace(/\D/g, ''));
                        timeFormat = 'weeks';
                    }

                    // Subtract date/time from today -- more info on moment datetime subtraction: https://momentjs.com/docs/#/durations/subtract/
                    const realDate = moment().subtract(timeCount, timeFormat).format();

                    // Insert real date to last login attribute
                    dateRow[3].setAttribute('data-order', realDate);

                    // Set real date for joined column
                    const joinedDate = moment(dateRow[5].innerHTML, "DD MMM YYYY, LT").format(); // select date from 5th column in table
                    dateRow[5].setAttribute('data-order', joinedDate);
                });

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    "info": false,
                    'order': [],
                    "pageLength": 10,
                    "lengthChange": false,
                    'columnDefs': [
                        { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                        { orderable: false, targets: 5 }, // Disable ordering on column 6 (actions)                
                    ]
                });

                // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
                datatable.on('draw', function () {
                    initToggleToolbar();
                    handleDeleteRows();
                    toggleToolbars();
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    datatable.search(e.target.value).draw();
                });
            }

            // Filter Datatable
            var handleFilterDatatable = () => {
                // Select filter options
                const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
                const filterButton = filterForm.querySelector('[data-kt-user-table-filter="filter"]');
                const selectOptions = filterForm.querySelectorAll('select');

                // Filter datatable on submit
                filterButton.addEventListener('click', function () {
                    var filterString = '';

                    // Get filter values
                    selectOptions.forEach((item, index) => {
                        if (item.value && item.value !== '') {
                            if (index !== 0) {
                                filterString += ' ';
                            }

                            // Build filter value options
                            filterString += item.value;
                        }
                    });

                    // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
                    datatable.search(filterString).draw();
                });
            }

            // Reset Filter
            var handleResetForm = () => {
                // Select reset button
                const resetButton = document.querySelector('[data-kt-user-table-filter="reset"]');

                // Reset datatable
                resetButton.addEventListener('click', function () {
                    // Select filter options
                    const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
                    const selectOptions = filterForm.querySelectorAll('select');

                    // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
                    selectOptions.forEach(select => {
                        $(select).val('').trigger('change');
                    });

                    // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
                    datatable.search('').draw();
                });
            }


            // Delete user
            var handleDeleteRows = () => {
                // Select all delete buttons
                const deleteButtons = table.querySelectorAll('[data-kt-users-table-filter="delete_row"]');

                deleteButtons.forEach(d => {
                    // Delete button on click
                    d.addEventListener('click', function (e) {
                        e.preventDefault();

                        // Select parent row
                        const parent = e.target.closest('tr');

                        // Get user name and user id
                        const userName = parent.querySelectorAll('td')[1].querySelectorAll('a')[0].innerText;
                        const personId = parent.dataset.personId; // Assume there's a data attribute for user id

                        // SweetAlert2 pop up
                        Swal.fire({
                            text: "Are you sure you want to delete " + userName + "?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                // Perform Ajax request to delete user
                                fetch(`/destroy/penduduk/${personId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        Swal.fire({
                                            text: "You have deleted " + userName + "!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function () {
                                            // Remove current row
                                            datatable.row($(parent)).remove().draw();
                                        });
                                    } else {
                                        Swal.fire({
                                            text: data.message,
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        text: "An error occurred while deleting the user.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: userName + " was not deleted.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    });
                });
            }


            // Init toggle toolbar
            var initToggleToolbar = () => {
                // Toggle selected action toolbar
                // Select all checkboxes
                const checkboxes = table.querySelectorAll('[type="checkbox"]');

                // Select elements
                toolbarBase = document.querySelector('[data-kt-user-table-toolbar="base"]');
                toolbarSelected = document.querySelector('[data-kt-user-table-toolbar="selected"]');
                selectedCount = document.querySelector('[data-kt-user-table-select="selected_count"]');
                const deleteSelected = document.querySelector('[data-kt-user-table-select="delete_selected"]');

                // Toggle delete selected toolbar
                checkboxes.forEach(c => {
                    // Checkbox on click event
                    c.addEventListener('click', function () {
                        setTimeout(function () {
                            toggleToolbars();
                        }, 50);
                    });
                });

                // Deleted selected rows
                deleteSelected.addEventListener('click', function () {
                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Are you sure you want to delete selected user?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            Swal.fire({
                                text: "You have deleted all selected user!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                // Remove all selected customers
                                checkboxes.forEach(c => {
                                    if (c.checked) {
                                        datatable.row($(c.closest('tbody tr'))).remove().draw();
                                    }
                                });

                                // Remove header checked box
                                const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                                headerCheckbox.checked = false;
                            }).then(function () {
                                toggleToolbars(); // Detect checked checkboxes
                                initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                            });
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: "Selected customers was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                });
            }

            // Toggle toolbars
            const toggleToolbars = () => {
                // Select refreshed checkbox DOM elements 
                const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

                // Detect checkboxes state & count
                let checkedState = false;
                let count = 0;

                // Count checked boxes
                allCheckboxes.forEach(c => {
                    if (c.checked) {
                        checkedState = true;
                        count++;
                    }
                });

                // Toggle toolbars
                if (checkedState) {
                    selectedCount.innerHTML = count;
                    toolbarBase.classList.add('d-none');
                    toolbarSelected.classList.remove('d-none');
                } else {
                    toolbarBase.classList.remove('d-none');
                    toolbarSelected.classList.add('d-none');
                }
            }

            return {
                // Public functions  
                init: function () {
                    if (!table) {
                        return;
                    }

                    initUserTable();
                    initToggleToolbar();
                    handleSearchDatatable();
                    handleResetForm();
                    handleDeleteRows();
                    handleFilterDatatable();

                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTUsersList.init();
        });
    </script>
    <!--end::Table Person Javascript-->

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