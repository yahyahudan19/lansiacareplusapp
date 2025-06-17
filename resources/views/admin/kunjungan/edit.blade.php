@extends('components.layout')

@section('title')
    Update Kunjungan
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Update Kunjungan #{{$kunjungan->id}}</h1>
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
                            <li class="breadcrumb-item text-muted">Kunjungan</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Update</li>
                            <!--end::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">{{$kunjungan->id}}</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        {{-- <a href="#" class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">Add Member</a> --}}
                         <!--begin::Button-->
                         <a href="/admin/kunjungan" class="btn btn-success">
                            <i class="ki-duotone ki-left-square"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Kembali
                        </a>
                        <!--end::Button-->
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
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Stepper-->
                        <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                            <!--begin::Nav-->
                            <div class="stepper-nav mb-5">
                                
                                <!--begin::Step 2-->
                                <div class="stepper-item current" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Data Pribadi</h3>
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Data Skrining</h3>
                                </div>
                                <!--end::Step 3-->
                                <!--begin::Step 4-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Data Kesehatan</h3>
                                </div>
                                <!--end::Step 4-->
                                <!--begin::Step 5-->
                                <div class="stepper-item" data-kt-stepper-element="nav">
                                    <h3 class="stepper-title">Completed</h3>
                                </div>
                                <!--end::Step 5-->
                            </div>
                            <!--end::Nav-->
                            <!--begin::Form-->
                            <form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" id="kt_create_account_form" method="POST" action="/admin/kunjungan/update/{{$kunjungan->id}}">
                                <!--begin::Step 1-->
                                <div class="current" data-kt-stepper-element="content">
                                    @csrf
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-15">
                                            <!--begin::Title-->
                                            <h2 class="fw-bold text-gray-900">Data Pribadi</h2>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class="text-muted fw-semibold fs-6">Jika ingin mengupdate data, silahkan kunjungi
                                            <a href="/admin/penduduk/{{$dapen->id}}" class="link-primary fw-bold">Halaman Ini</a>.</div>
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label required">Nama Lengkap</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input name="nama" class="form-control form-control-lg form-control-solid" value="{{$dapen->nama}}" readonly />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center form-label">
                                                <span class="required">NIK</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input name="nik" class="form-control form-control-lg form-control-solid" value="{{$dapen->nik}}" readonly />
                                            <!--end::Input-->
                                            <!--begin::Hint-->
                                            {{-- <div class="form-text">Customers will see this shortened version of your statement descriptor</div> --}}
                                            <!--end::Hint-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-10">
                                            <!--begin::Col-->
                                            <div class="col-md-8 fv-row">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold form-label mb-2">Jenis Kelamin</label>
                                                <!--end::Label-->
                                                <!--begin::Row-->
                                                <div class="row fv-row">
                                                    <!--begin::Col-->
                                                    <div class="col-6">
                                                        <select name="jenis_kelamin" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Month" disabled>
                                                            @if ($dapen->jenis_kelamin == "L")
                                                                <option>Laki-Laki</option>
                                                            @else
                                                                <option>Perempuan</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-6">
                                                        <select name="card_expiry_year" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Year" disabled>
                                                            <option>{{$dapen->age}} Tahun</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                    <span class="required">Kategori</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Lansia,Pra-Lansia, atau Non-Lansia">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input wrapper-->
                                                <div class="position-relative">
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" value="{{$dapen->category}}" name="card_cvv" readonly />
                                                    <!--end::Input-->
                                                    <!--begin::CVV icon-->
                                                    <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                                        <i class="ki-outline ki-credit-cart fs-2hx"></i>
                                                    </div>
                                                    <!--end::CVV icon-->
                                                </div>
                                                <!--end::Input wrapper-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--end::Label-->
                                            <label class="form-label">Alamat Lengkap</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea name="alamat" class="form-control form-control-lg form-control-solid" rows="3" readonly>{{$dapen->alamat}}</textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-10">
                                            <!--begin::Col-->
                                            <div class="col-md-12 fv-row">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold form-label mb-2">Kecamatan dan Kelurahan</label>
                                                <!--end::Label-->
                                                <!--begin::Row-->
                                                <div class="row fv-row">
                                                    <!--begin::Col-->
                                                    <div class="col-6">
                                                        <input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" value="{{$dapen->kelurahan->kecamatan->nama}}" name="card_cvv" readonly />
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-6">
                                                        <input type="text" class="form-control form-control-solid" minlength="3" maxlength="4" value="{{$dapen->kelurahan->nama}}" name="card_cvv" readonly />
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                            
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 1-->
                                <!--begin::Step 2-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-12">
                                            <!--begin::Title-->
                                            <h2 class="fw-bold text-gray-900">Input Skrining</h2>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class="text-muted fw-semibold fs-6">Masukkan data Skrining dibawah ini.</div>
                                            {{-- <a href="#" class="link-primary fw-bold">Help Page</a>.</div> --}}
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="row mb-5">
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold form-label mb-2">Tinggi Badan (cm)</label>
                                                <!--end::Label-->
                                                <!--begin::Row-->
                                                <div class="row fv-row">
                                                    <!--begin::Col-->
                                                    <div class="col-12">
                                                        <!--begin::Dialer-->
                                                    <div class="position-relative"
                                                    data-kt-dialer="true"
                                                    data-kt-dialer-min="0"
                                                    data-kt-dialer-max="300"
                                                    data-kt-dialer-step="1">

                                                    <!--begin::Decrease control-->
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                                        <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                    <!--end::Decrease control-->

                                                    <!--begin::Input control-->
                                                    <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="tinggi_bdn" value="{{$kunjungan->tinggi_bdn}}" />
                                                    <!--end::Input control-->

                                                    <!--begin::Increase control-->
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                                        <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                    </button>
                                                    <!--end::Increase control-->
                                                    </div>
                                                    <!--end::Dialer-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                    <span class="required">Berat Badan (Kg)</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Enter a card CVV code">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input wrapper-->
                                                <div class="position-relative">
                                                    <!--begin::Dialer-->
                                                    <div class="position-relative"
                                                    data-kt-dialer="true"
                                                    data-kt-dialer-min="0"
                                                    data-kt-dialer-max="200"
                                                    data-kt-dialer-step="1">

                                                    <!--begin::Decrease control-->
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                                        <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                    <!--end::Decrease control-->

                                                    <!--begin::Input control-->
                                                    <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="berat_bdn" value="{{$kunjungan->berat_bdn}}" />
                                                    <!--end::Input control-->

                                                    <!--begin::Increase control-->
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                                        <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                    </button>
                                                    <!--end::Increase control-->
                                                    </div>
                                                    <!--end::Dialer-->
                                                </div>
                                                <!--end::Input wrapper-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-4 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                    <span class="required">Lingkar Perut (cm)</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Enter a card CVV code">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input wrapper-->
                                                <div class="position-relative">
                                                    <!--begin::Dialer-->
                                                    <div class="position-relative"
                                                    data-kt-dialer="true"
                                                    data-kt-dialer-min="0"
                                                    data-kt-dialer-max="200"
                                                    data-kt-dialer-step="1">

                                                    <!--begin::Decrease control-->
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                                        <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                    <!--end::Decrease control-->

                                                    <!--begin::Input control-->
                                                    <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="lingkar_prt" value="{{$kunjungan->lingkar_prt}}" />
                                                    <!--end::Input control-->

                                                    <!--begin::Increase control-->
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                                        <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                    </button>
                                                    <!--end::Increase control-->
                                                    </div>
                                                    <!--end::Dialer-->
                                                   
                                                </div>
                                                <!--end::Input wrapper-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-5">
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold form-label mb-2">Diastole</label>
                                                <!--end::Label-->
                                                <!--begin::Row-->
                                                <div class="row fv-row">
                                                    <!--begin::Col-->
                                                    <div class="col-12">
                                                        <!--begin::Dialer-->
                                                        <div class="position-relative"
                                                        data-kt-dialer="true"
                                                        data-kt-dialer-min="0"
                                                        data-kt-dialer-max="300"
                                                        data-kt-dialer-step="1">

                                                        <!--begin::Decrease control-->
                                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                                            <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                        </button>
                                                        <!--end::Decrease control-->

                                                        <!--begin::Input control-->
                                                        <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="diastole" value="{{$kunjungan->diastole}}" />
                                                        <!--end::Input control-->

                                                        <!--begin::Increase control-->
                                                        <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                                            <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                        </button>
                                                        <!--end::Increase control-->
                                                        </div>
                                                        <!--end::Dialer-->
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <!--begin::Label-->
                                                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                    <span class="required">Sistole</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Enter a card CVV code">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input wrapper-->
                                                <div class="position-relative">
                                                    <!--begin::Dialer-->
                                                    <div class="position-relative"
                                                    data-kt-dialer="true"
                                                    data-kt-dialer-min="30"
                                                    data-kt-dialer-max="200"
                                                    data-kt-dialer-step="1">

                                                    <!--begin::Decrease control-->
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                                        <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                    <!--end::Decrease control-->

                                                    <!--begin::Input control-->
                                                    <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="sistole" value="{{$kunjungan->sistole}}" />
                                                    <!--end::Input control-->

                                                    <!--begin::Increase control-->
                                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                                        <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                    </button>
                                                    <!--end::Increase control-->
                                                    </div>
                                                    <!--end::Dialer-->
                                                </div>
                                                <!--end::Input wrapper-->
                                            </div>
                                            <!--end::Col-->
                                           
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-5">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center form-label">
                                                <span class="required">Gula Darah</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <!--begin::Dialer-->
                                            <div class="position-relative"
                                            data-kt-dialer="true"
                                            data-kt-dialer-min="0"
                                            data-kt-dialer-max="300"
                                            data-kt-dialer-step="1">

                                            <!--begin::Decrease control-->
                                            <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                                <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </button>
                                            <!--end::Decrease control-->

                                            <!--begin::Input control-->
                                            <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="gula_drh" value="{{$kunjungan->gula_drh}}" />
                                            <!--end::Input control-->

                                            <!--begin::Increase control-->
                                            <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                                <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            </button>
                                            <!--end::Increase control-->
                                            </div>
                                            <!--end::Dialer-->
                                            <!--end::Input-->
                                            <!--begin::Hint-->
                                            <div class="form-text">Sewaktu Puasa atau Tidak Puasa</div>
                                            <!--end::Hint-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-5">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center form-label">
                                                <span class="required">Kolesterol</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <!--begin::Dialer-->
                                            <div class="position-relative"
                                            data-kt-dialer="true"
                                            data-kt-dialer-min="0"
                                            data-kt-dialer-max="300"
                                            data-kt-dialer-step="1">

                                            <!--begin::Decrease control-->
                                            <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                                <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </button>
                                            <!--end::Decrease control-->

                                            <!--begin::Input control-->
                                            <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="kolesterol" value="{{$kunjungan->kolesterol}}" />
                                            <!--end::Input control-

                                            <!- begin::Increase control-->
                                            <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                                <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            </button>
                                            <!--end::Increase control-->
                                            </div>
                                            <!--end::Dialer-->
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-5">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center form-label">
                                                <span class="required">Asam Urat</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <!--begin::Dialer-->
                                            <div class="position-relative"
                                            data-kt-dialer="true"
                                            data-kt-dialer-min="0"
                                            data-kt-dialer-max="300"
                                            data-kt-dialer-step="1">

                                            <!--begin::Decrease control-->
                                            <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                                <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            </button>
                                            <!--end::Decrease control-->

                                            <!--begin::Input control-->
                                            <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="asam_urat" value="{{$kunjungan->asam_urat}}" />
                                            <!--end::Input control-->

                                            <!--begin::Increase control-->
                                            <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
                                                <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                            </button>
                                            <!--end::Increase control-->
                                            </div>
                                            <!--end::Dialer-->
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-5">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center form-label">
                                               <span class="required">Tanggal Kunjungan</span>
                                           </label>
                                           <!--end::Label-->
                                           <div class="mb-10">
                                               <input class="form-control" placeholder="Pick a date" name="tanggal_kj" id="kt_datepicker_1" value="{{$kunjungan->tanggal_kj}}"/>
                                           </div>
                                       </div>
                                       <!--end::Input group-->
                                        
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 2-->
                                <!--begin::Step 3-->
                                <div data-kt-stepper-element="content">
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-15">
                                            <!--begin::Title-->
                                            <h2 class="fw-bold text-gray-900">Data Kesehatan</h2>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class="text-muted fw-semibold fs-6">Diisi dengan menjawab pertanyaan dengan 
                                            <a href="#" class="text-primary fw-bold">Iya atau Tidak</a>.</div>
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Apakah anda merokok ?</span>
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select" data-control="select2" data-placeholder="Select an option" name="merokok">
                                                <option></option>
                                                <option value="Y" {{ $skrining->merokok == 'Y' ? 'selected' : '' }}>Iya</option>
                                                <option value="TSB" {{ $skrining->merokok == 'TSB' ? 'selected' : '' }}>Tidak, Sudah Berhenti</option>
                                                <option value="TPS" {{ $skrining->merokok == 'TPS' ? 'selected' : '' }}>Tidak Pernah Sama Sekali</option>
                                            </select>
                                            
                                            
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Apakah anda memiliki riwayat atau sedang mengalami gangguan ginjal ?</span>
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select" data-control="select2" data-placeholder="Select an option" name="ginjal">
                                                <option></option>
                                                <option value="Y" {{ $skrining->ginjal == 'Y' ? 'selected' : '' }}>Iya</option>
                                                <option value="N" {{ $skrining->ginjal == 'N' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            
                                            
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Apakah anda memiliki gangguan penglihatan (menggunakan kacamata/tidak jelas ketika melihat benda jauh atau dekat/ tidak jelas ketika membaca tanpa kacamata)?</span>
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select" data-control="select2" data-placeholder="Select an option" name="penglihatan">
                                                <option></option>
                                                <option value="Y" {{ $skrining->penglihatan == 'Y' ? 'selected' : '' }}>Iya</option>
                                                <option value="N" {{ $skrining->penglihatan == 'N' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Apakah anda memiliki gangguan pendengaran (menggunakan alat bantu dengar/ membutuhkan suara keras bila berbicara dengan orang lain)?</span>
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select" data-control="select2" data-placeholder="Select an option" name="pendengaran">
                                                <option></option>
                                                <option value="Y" {{ $skrining->pendengaran == 'Y' ? 'selected' : '' }}>Iya</option>
                                                <option value="N" {{ $skrining->pendengaran == 'N' ? 'selected' : '' }}>Tidak</option>
                                            </select>
                                            
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Heading-->
                                        <div class="pb-10 pb-lg-15">
                                            <!--begin::Title-->
                                            <h2 class="fw-bold text-gray-900">Data lain</h2>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class="text-muted fw-semibold fs-6">Diisi sesuai dengan kondisi
                                            <a href="#" class="text-primary fw-bold">Saat Ini</a>.</div>
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Bagaimana tingkat kemandirian anda ?</span>
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select" data-control="select2" data-placeholder="Select an option" name="adl">
                                                <option></option>
                                                <option value="A" {{ $skrining->adl == 'A' ? 'selected' : '' }}>Mandiri (A) : Dapat melakukan aktivitas sendiri tanpa bantuan orang lain</option>
                                                <option value="B" {{ $skrining->adl == 'B' ? 'selected' : '' }}>Ketergantungan Ringan (B) : Membutuhkan bantuan orang lain dalam melakukan aktivitas tertentu/memakai kursi roda</option>
                                                <option value="C" {{ $skrining->adl == 'C' ? 'selected' : '' }}>Ketergantungan Berat (C) : Hanya bisa beraktivitas diatas tempat tidur</option>
                                            </select>
                                            
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Bagaimana gambaran mental emosional pada diri anda?</span>
                                            </label>
                                            <!--end::Label-->
                                            <select class="form-select" data-control="select2" data-placeholder="Select an option" name="gds">
                                                <option></option>
                                                <option value="A"{{ $skrining->gds == 'A' ? 'selected' : '' }}>Sudah puas dengan kehidupan, bersemangat, merasa bahagia, menyenangkan</option>
                                                <option value="B"{{ $skrining->gds == 'B' ? 'selected' : '' }}>Merasa bosan, lebih senang dirumah, meninggalkan banyak kesenangan, cemas, memiliki masalah daya ingat</option>
                                                <option value="C"{{ $skrining->gds == 'C' ? 'selected' : '' }}>Merasa kehidupan hampa, tidak berdaya, tidak berharga, tidak ada harapan, keadaan orang lain lebih baik</option>
                                            </select>
                                            
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 3-->
                                <!--begin::Step 4-->
                                <div data-kt-stepper-element="content">
                                    
                                    <!--begin::Wrapper-->
                                    <div class="w-100">
                                        <!--begin::Heading-->
                                        <div class="pb-8 pb-lg-10">
                                            <!--begin::Title-->
                                            <h2 class="fw-bold text-gray-900">Your Are Done!</h2>
                                            <!--end::Title-->
                                            <!--begin::Notice-->
                                            <div class="text-muted fw-semibold fs-6">If you need more info, please 
                                            <a href="#" class="link-primary fw-bold">Sign In</a>.</div>
                                            <!--end::Notice-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Body-->
                                        <div class="mb-0">
                                            <!--begin::Text-->
                                            <div class="fs-6 text-gray-600 mb-5">Writing headlines for blog posts is as much an art as it is a science and probably warrants its own post, but for all advise is with what works for your great & amazing audience.</div>
                                            <!--end::Text-->
                                            <!--begin::Alert-->
                                            <!--begin::Notice-->
                                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                                <!--begin::Icon-->
                                                <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                                                <!--end::Icon-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-stack flex-grow-1">
                                                    <!--begin::Content-->
                                                    <div class="fw-semibold">
                                                        <h4 class="text-gray-900 fw-bold">We need your attention!</h4>
                                                        <div class="fs-6 text-gray-700">To start using great tools, please, 
                                                        <a href="utilities/wizards/vertical.html" class="fw-bold">Create Team Platform</a></div>
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Notice-->
                                            <!--end::Alert-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Step 4-->
                                <!--begin::Actions-->
                                <div class="d-flex flex-stack pt-15">
                                    <!--begin::Wrapper-->
                                    <div class="mr-2">
                                        <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                        <i class="ki-outline ki-arrow-left fs-4 me-1"></i>Back</button>
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Wrapper-->
                                    <div>
                                        <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                                            <span class="indicator-label">Submit 
                                            <i class="ki-outline ki-arrow-right fs-3 ms-2 me-0"></i></span>
                                            <span class="indicator-progress">Please wait... 
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue 
                                        <i class="ki-outline ki-arrow-right fs-4 ms-1 me-0"></i></button>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Stepper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
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
    <!--end::Vendors Javascript-->

   

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
    <script>
        $("#kt_datepicker_1").flatpickr();
    </script>
    <!--end::datepick Javascript-->

    <!--begin::Form Skrinings Javascript-->
    <script>
        "use strict";

        // Class definition
        var KTCreateAccount = function () {
            // Elements
            var modal;	
            var modalEl;

            var stepper;
            var form;
            var formSubmitButton;
            var formContinueButton;

            // Variables
            var stepperObj;
            var validations = [];

            // Private Functions
            var initStepper = function () {
                // Initialize Stepper
                stepperObj = new KTStepper(stepper);

                // Stepper change event
                stepperObj.on('kt.stepper.changed', function (stepper) {
                    if (stepperObj.getCurrentStepIndex() === 3) {
                        formSubmitButton.classList.remove('d-none');
                        formSubmitButton.classList.add('d-inline-block');
                        formContinueButton.classList.add('d-none');
                    } else if (stepperObj.getCurrentStepIndex() === 4) {
                        formSubmitButton.classList.add('d-none');
                        formContinueButton.classList.add('d-none');
                    } else {
                        formSubmitButton.classList.remove('d-inline-block');
                        formSubmitButton.classList.remove('d-none');
                        formContinueButton.classList.remove('d-none');
                    }
                });

                // Validation before going to next page
                stepperObj.on('kt.stepper.next', function (stepper) {
                    console.log('stepper.next');

                    // Validate form before change stepper step
                    var validator = validations[stepper.getCurrentStepIndex() - 1]; // get validator for currnt step

                    if (validator) {
                        validator.validate().then(function (status) {
                            console.log('validated!');

                            if (status == 'Valid') {
                                stepper.goNext();

                                KTUtil.scrollTop();
                            } else {
                                Swal.fire({
                                    text: "Maaf, ada yang error, cek lagi ya !.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Baik !",
                                    customClass: {
                                        confirmButton: "btn btn-light"
                                    }
                                }).then(function () {
                                    KTUtil.scrollTop();
                                });
                            }
                        });
                    } else {
                        stepper.goNext();

                        KTUtil.scrollTop();
                    }
                });

                // Prev event
                stepperObj.on('kt.stepper.previous', function (stepper) {
                    console.log('stepper.previous');

                    stepper.goPrevious();
                    KTUtil.scrollTop();
                });
            }

            var handleForm = function() {
                formSubmitButton.addEventListener('click', function (e) {
                    // Validate form before change stepper step
                    var validator = validations[2]; // get validator for last form

                    validator.validate().then(function (status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            // Prevent default button action
                            e.preventDefault();

                            // Disable button to avoid multiple click 
                            formSubmitButton.disabled = true;

                            // Show loading indication
                            formSubmitButton.setAttribute('data-kt-indicator', 'on');

                            form.submit(); // Submit form

                            // Simulate form submission
                            setTimeout(function() {
                                // Hide loading indication
                                formSubmitButton.removeAttribute('data-kt-indicator');

                                // Enable button
                                formSubmitButton.disabled = false;

                                stepperObj.goNext();
                            }, 2000);
                        } else {
                            Swal.fire({
                                text: "Maaf, ada yang error, cek lagi ya !.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Baik !",
                                customClass: {
                                    confirmButton: "btn btn-light"
                                }
                            }).then(function () {
                                KTUtil.scrollTop();
                            });
                        }
                    });
                });

                // Expiry month. For more info, plase visit the official plugin site: https://select2.org/
                $(form.querySelector('[name="card_expiry_month"]')).on('change', function() {
                    // Revalidate the field when an option is chosen
                    validations[3].revalidateField('card_expiry_month');
                });

                // Expiry year. For more info, plase visit the official plugin site: https://select2.org/
                $(form.querySelector('[name="card_expiry_year"]')).on('change', function() {
                    // Revalidate the field when an option is chosen
                    validations[3].revalidateField('card_expiry_year');
                });

                // Expiry year. For more info, plase visit the official plugin site: https://select2.org/
                $(form.querySelector('[name="business_type"]')).on('change', function() {
                    // Revalidate the field when an option is chosen
                    validations[2].revalidateField('business_type');
                });
            }

            var initValidation = function () {
                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

                // Step 1
                validations.push(FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'account_team_size': {
                                validators: {
                                    notEmpty: {
                                        message: 'Time size is required'
                                    }
                                }
                            },
                            'account_name': {
                                validators: {
                                    notEmpty: {
                                        message: 'Account name is required'
                                    }
                                }
                            },
                            'account_plan': {
                                validators: {
                                    notEmpty: {
                                        message: 'Account plan is required'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            // Bootstrap Framework Integration
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',
                                eleValidClass: ''
                            })
                        }
                    }
                ));

                // Step 2
                validations.push(FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'tinggi_bdn': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'berat_bdn': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'lingkar_prt': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'diastole': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'sistole': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'gula_drh': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'kolesterol': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'asam_urat': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            }
                            
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            // Bootstrap Framework Integration
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',
                                eleValidClass: ''
                            })
                        }
                    }
                ));

                // Step 3
                validations.push(FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'merokok': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'ginjal': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'penglihatan': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'pendengaran': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'adl': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            'gds': {
                                validators: {
                                    notEmpty: {
                                        message: 'Harus diisi atau dipilih !'
                                    }
                                }
                            },
                            
                        },

                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            // Bootstrap Framework Integration
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',
                                eleValidClass: ''
                            })
                        }
                    }
                ));
            }

            return {
                // Public Functions
                init: function () {
                    // Elements
                    modalEl = document.querySelector('#kt_modal_create_account');

                    if ( modalEl ) {
                        modal = new bootstrap.Modal(modalEl);	
                    }					

                    stepper = document.querySelector('#kt_create_account_stepper');

                    if ( !stepper ) {
                        return;
                    }

                    form = stepper.querySelector('#kt_create_account_form');
                    formSubmitButton = stepper.querySelector('[data-kt-stepper-action="submit"]');
                    formContinueButton = stepper.querySelector('[data-kt-stepper-action="next"]');

                    initStepper();
                    initValidation();
                    handleForm();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTCreateAccount.init();
        });
    </script>
    <!--end::Form Skrinings Javascript-->

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
                    confirmButtonText: "Baik !",
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
                    confirmButtonText: "Baik !",
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
                    confirmButtonText: "Baik !",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        </script>
    @endif
    <!-- end sessions -->

@endsection