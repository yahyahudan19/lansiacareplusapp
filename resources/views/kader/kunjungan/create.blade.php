@extends('components.layout')

@section('title')
    Tambah Kunjungan
@endsection

@section('plugins-head')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                            Tambah Kunjungan</h1>
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
                            <li class="breadcrumb-item text-muted">Tambah</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <!--begin::Button-->
                        <a href="/puskesmas/kunjungan" class="btn btn-success btn-sm">
                            <i class="ki-duotone ki-left-square"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span><span class="path4"></span></i>
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
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                        <!--begin::Form-->
                        <form id="kt_docs_formvalidation_text" class="form" action="/puskesmas/kunjungan/store" autocomplete="off" method="POST" >
                            @csrf
                            <!--begin::Skrining-->
                            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold">Data Skrining</h2>
                                    </div>
                                    <!--begin::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Description-->
                                    {{-- <div class="text-gray-500 fw-semibold fs-5 mb-5">:</div> --}}
                                    <!--end::Description-->

                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin::Col-->
                                        <div class="col-md-4 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold mb-2">Tinggi Badan (cm)</label>
                                            <!--end::Label-->
                                            <!--begin::Row-->
                                            <div class="row fv-row">
                                                <!--begin::Col-->
                                                <div class="col-12">
                                                    <!--begin::Dialer-->
                                                    <div class="position-relative" data-kt-dialer="true"
                                                        data-kt-dialer-min="0" data-kt-dialer-max="300"
                                                        data-kt-dialer-step="1">

                                                        <!--begin::Decrease control-->
                                                        <button type="button"
                                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                            data-kt-dialer-control="decrease">
                                                            <i class="ki-duotone ki-minus-square fs-2"><span
                                                                    class="path1"></span><span class="path2"></span></i>
                                                        </button>
                                                        <!--end::Decrease control-->

                                                        <!--begin::Input control-->
                                                        <input type="text"
                                                            class="form-control form-control-solid border-0 ps-12"
                                                            data-kt-dialer-control="input" placeholder="Amount"
                                                            name="tinggi_bdn" value="100" />
                                                        <!--end::Input control-->

                                                        <!--begin::Increase control-->
                                                        <button type="button"
                                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                            data-kt-dialer-control="increase">
                                                            <i class="ki-duotone ki-plus-square fs-2"><span
                                                                    class="path1"></span><span class="path2"></span><span
                                                                    class="path3"></span></i>
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
                                                <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="0"
                                                    data-kt-dialer-max="200" data-kt-dialer-step="1">

                                                    <!--begin::Decrease control-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                        data-kt-dialer-control="decrease">
                                                        <i class="ki-duotone ki-minus-square fs-2"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                    <!--end::Decrease control-->

                                                    <!--begin::Input control-->
                                                    <input type="text"
                                                        class="form-control form-control-solid border-0 ps-12"
                                                        data-kt-dialer-control="input" placeholder="Amount" name="berat_bdn"
                                                        value="30" />
                                                    <!--end::Input control-->

                                                    <!--begin::Increase control-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                        data-kt-dialer-control="increase">
                                                        <i class="ki-duotone ki-plus-square fs-2"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span></i>
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
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Enter a card CVV code">
                                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input wrapper-->
                                            <div class="position-relative">
                                                <!--begin::Dialer-->
                                                <div class="position-relative" data-kt-dialer="true"
                                                    data-kt-dialer-min="0" data-kt-dialer-max="200"
                                                    data-kt-dialer-step="1">

                                                    <!--begin::Decrease control-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                        data-kt-dialer-control="decrease">
                                                        <i class="ki-duotone ki-minus-square fs-2"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                    <!--end::Decrease control-->

                                                    <!--begin::Input control-->
                                                    <input type="text"
                                                        class="form-control form-control-solid border-0 ps-12"
                                                        data-kt-dialer-control="input" placeholder="Amount"
                                                        name="lingkar_prt" value="1" />
                                                    <!--end::Input control-->

                                                    <!--begin::Increase control-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                        data-kt-dialer-control="increase">
                                                        <i class="ki-duotone ki-plus-square fs-2"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span></i>
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
                                                    <div class="position-relative" data-kt-dialer="true"
                                                        data-kt-dialer-min="0" data-kt-dialer-max="300"
                                                        data-kt-dialer-step="1">

                                                        <!--begin::Decrease control-->
                                                        <button type="button"
                                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                            data-kt-dialer-control="decrease">
                                                            <i class="ki-duotone ki-minus-square fs-2"><span
                                                                    class="path1"></span><span class="path2"></span></i>
                                                        </button>
                                                        <!--end::Decrease control-->

                                                        <!--begin::Input control-->
                                                        <input type="text"
                                                            class="form-control form-control-solid border-0 ps-12"
                                                            data-kt-dialer-control="input" placeholder="Amount"
                                                            name="diastole" value="100" />
                                                        <!--end::Input control-->

                                                        <!--begin::Increase control-->
                                                        <button type="button"
                                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                            data-kt-dialer-control="increase">
                                                            <i class="ki-duotone ki-plus-square fs-2"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span class="path3"></span></i>
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
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Enter a card CVV code">
                                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input wrapper-->
                                            <div class="position-relative">
                                                <!--begin::Dialer-->
                                                <div class="position-relative" data-kt-dialer="true"
                                                    data-kt-dialer-min="0" data-kt-dialer-max="200"
                                                    data-kt-dialer-step="1">

                                                    <!--begin::Decrease control-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                        data-kt-dialer-control="decrease">
                                                        <i class="ki-duotone ki-minus-square fs-2"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                    <!--end::Decrease control-->

                                                    <!--begin::Input control-->
                                                    <input type="text"
                                                        class="form-control form-control-solid border-0 ps-12"
                                                        data-kt-dialer-control="input" placeholder="Amount"
                                                        name="sistole" value="30" />
                                                    <!--end::Input control-->

                                                    <!--begin::Increase control-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                        data-kt-dialer-control="increase">
                                                        <i class="ki-duotone ki-plus-square fs-2"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span></i>
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
                                        <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="0"
                                            data-kt-dialer-max="300" data-kt-dialer-step="1">

                                            <!--begin::Decrease control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                data-kt-dialer-control="decrease">
                                                <i class="ki-duotone ki-minus-square fs-2"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                            </button>
                                            <!--end::Decrease control-->

                                            <!--begin::Input control-->
                                            <input type="text" class="form-control form-control-solid border-0 ps-12"
                                                data-kt-dialer-control="input" placeholder="Amount" name="gula_drh"
                                                value="100" />
                                            <!--end::Input control-->

                                            <!--begin::Increase control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                data-kt-dialer-control="increase">
                                                <i class="ki-duotone ki-plus-square fs-2"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i>
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
                                        <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="0"
                                            data-kt-dialer-max="300" data-kt-dialer-step="1">

                                            <!--begin::Decrease control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                data-kt-dialer-control="decrease">
                                                <i class="ki-duotone ki-minus-square fs-2"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                            </button>
                                            <!--end::Decrease control-->

                                            <!--begin::Input control-->
                                            <input type="text" class="form-control form-control-solid border-0 ps-12"
                                                data-kt-dialer-control="input" placeholder="Amount" name="kolesterol"
                                                value="0" />
                                            <!--end::Input control-

                                                            <!- begin::Increase control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                data-kt-dialer-control="increase">
                                                <i class="ki-duotone ki-plus-square fs-2"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i>
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
                                        <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="0"
                                            data-kt-dialer-max="300" data-kt-dialer-step="1">

                                            <!--begin::Decrease control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                data-kt-dialer-control="decrease">
                                                <i class="ki-duotone ki-minus-square fs-2"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                            </button>
                                            <!--end::Decrease control-->

                                            <!--begin::Input control-->
                                            <input type="text" class="form-control form-control-solid border-0 ps-12"
                                                data-kt-dialer-control="input" placeholder="Amount" name="asam_urat"
                                                value="0" />
                                            <!--end::Input control-->

                                            <!--begin::Increase control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                data-kt-dialer-control="increase">
                                                <i class="ki-duotone ki-plus-square fs-2"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i>
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
                                            <input class="form-control" placeholder="Pick a date" name="tanggal_kj"
                                                id="kt_datepicker_1" />
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    {{-- <!--begin::Notice-->
                                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed rounded-3 p-6">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1">
                                            <!--begin::Content-->
                                            <div class="fw-semibold">
                                                <h4 class="text-gray-900 fw-bold">This is a very important privacy notice!</h4>
                                                <div class="fs-6 text-gray-700">Writing headlines for blog posts is much science and probably cool audience. 
                                                <a href="#" class="fw-bold">Learn more</a>.</div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice--> --}}

                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Skrining-->

                            <!--begin::Kesehatan-->
                            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold">Data Kesehatan</h2>
                                    </div>
                                    <!--begin::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Description-->
                                    {{-- <div class="text-gray-500 fw-semibold fs-5 mb-5">:</div> --}}
                                    <!--end::Description-->
                                    <input type="text" name="nik" value="{{ $dapen->nik }}" hidden>
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Apakah anda merokok ?</span>
                                        </label>
                                        <!--end::Label-->
                                        <select class="form-select" data-control="select2" data-placeholder="Select an option" name="merokok">
                                            <option></option>
                                            <option value="Y" selected>Iya</option>
                                            <option value="TSB">Tidak, Sudah Berhenti</option>
                                            <option value="TPS">Tidak Pernah Sama Sekali</option>
                                        </select>
                                        
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Apakah anda memiliki riwayat atau sedang mengalami
                                                gangguan ginjal ?</span>
                                        </label>
                                        <!--end::Label-->
                                        <select class="form-select" data-control="select2"
                                            data-placeholder="Select an option" name="ginjal">
                                            <option></option>
                                            <option value="Y" selected>Iya</option>
                                            <option value="N">Tidak</option>
                                        </select>

                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Apakah anda memiliki gangguan penglihatan (menggunakan
                                                kacamata/tidak jelas ketika melihat benda jauh atau dekat/ tidak jelas
                                                ketika membaca tanpa kacamata)?</span>
                                        </label>
                                        <!--end::Label-->
                                        <select class="form-select" data-control="select2"
                                            data-placeholder="Select an option" name="penglihatan">
                                            <option></option>
                                            <option value="Y" selected>Iya</option>
                                            <option value="N">Tidak</option>
                                        </select>

                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Apakah anda memiliki gangguan pendengaran (menggunakan
                                                alat bantu dengar/ membutuhkan suara keras bila berbicara dengan orang
                                                lain)?</span>
                                        </label>
                                        <!--end::Label-->
                                        <select class="form-select" data-control="select2"
                                            data-placeholder="Select an option" name="pendengaran">
                                            <option></option>
                                            <option value="Y" selected>Iya</option>
                                            <option value="N">Tidak</option>
                                        </select>

                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Kesehatan-->

                            <!--begin::Lain-->
                            <div class="card card-flush pt-3 mb-5 mb-lg-10">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2 class="fw-bold">Data Lain</h2>
                                    </div>
                                    <!--begin::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Description-->
                                    {{-- <div class="text-gray-500 fw-semibold fs-5 mb-5">:</div> --}}
                                    <!--end::Description-->
                                    
                                    <!--end::Heading-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Bagaimana tingkat kemandirian anda ?</span>
                                        </label>
                                        <!--end::Label-->
                                        <select class="form-select" data-control="select2"
                                            data-placeholder="Select an option" name="adl">
                                            <option></option>
                                            <option value="A" selected>Mandiri (A) : Dapat melakukan aktivitas sendiri
                                                tanpa bantuan orang lain</option>
                                            <option value="B">Ketergantungan Ringan (B) : Membutuhkan bantuan orang
                                                lain dalam melakukan aktivitas tertentu/memakai kursi roda</option>
                                            <option value="C">Ketergantungan Berat (C) : Hanya bisa beraktivitas
                                                diatas tempat tidur</option>
                                        </select>

                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Bagaimana gambaran mental emosional pada diri
                                                anda?</span>
                                        </label>
                                        <!--end::Label-->
                                        <select class="form-select" data-control="select2"
                                            data-placeholder="Select an option" name="gds">
                                            <option></option>
                                            <option value="A" selected>Sudah puas dengan kehidupan, bersemangat,
                                                merasa bahagia, menyenangkan</option>
                                            <option value="B">Merasa bosan, lebih senang dirumah, meninggalkan banyak
                                                kesenangan, cemas, memiliki masalah daya ingat</option>
                                            <option value="C">Merasa kehidupan hampa, tidak berdaya, tidak berharga,
                                                tidak ada harapan, keadaan orang lain lebih baik</option>
                                        </select>

                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Actions-->
                                    <button id="kt_docs_formvalidation_text_submit" type="submit"
                                        class="btn btn-primary">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <!--end::Actions-->

                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Lain-->

                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
                        <!--begin::Card-->
                        <div class="card card-flush pt-3 mb-0" data-kt-sticky="true"
                            data-kt-sticky-name="subscription-summary"
                            data-kt-sticky-offset="{default: false, lg: '200px'}"
                            data-kt-sticky-width="{lg: '250px', xl: '300px'}" data-kt-sticky-left="auto"
                            data-kt-sticky-top="150px" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Data Penduduk</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 fs-6">
                                <!--begin::Section-->
                                <div class="mb-3">
                                    <!--begin::Title-->
                                    <h5 class="mb-3">Data Diri :</h5>
                                    <!--end::Title-->

                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center mb-1">
                                        <!--begin::Name-->
                                        <a href="/puskesmas/penduduk/{{ $dapen->id }}"
                                            class="fw-bold text-gray-800 text-hover-primary me-2">{{ $dapen->nama }}</a>
                                        <!--end::Name-->
                                        <!--begin::Status-->
                                        @if ($dapen->category == "Lansia")
                                            <span class="badge badge-light-danger">{{$dapen->category}}</span>
                                        @elseif ($dapen->category == "Pra-Lansia")
                                            <span class="badge badge-light-warning">{{$dapen->category}}</span>
                                        @else
                                            <span class="badge badge-light-success">{{$dapen->category}}</span>
                                        @endif
                                        <!--end::Status-->
                                    </div>
                                    <!--end::Details-->

                                    <!--begin::NIK-->
                                    <a href="#"
                                        class="fw-semibold text-gray-600 text-hover-primary">{{ $dapen->nik }}
                                    </a>
                                    <!--end::NIK-->
                                    
                                </div>

                                <div class="mb-3">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center mb-1">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="fw-bold text-gray-800 text-hover-primary me-2">Kecamatan :
                                        </a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Email-->
                                    <a href="#"
                                        class="fw-semibold text-gray-600 text-hover-primary">{{ $dapen->kelurahan->kecamatan->nama }}
                                    </a>
                                    <!--end::Email-->
                                </div>

                                <div class="mb-3">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center mb-1">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="fw-bold text-gray-800 text-hover-primary me-2">Kelurahan :
                                        </a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Email-->
                                    <a href="#"
                                        class="fw-semibold text-gray-600 text-hover-primary">{{ $dapen->kelurahan   ->nama }}
                                    </a>
                                    <!--end::Email-->
                                </div>
                                <!--end::Section-->

                                <!--begin::Seperator-->
                                <div class="separator separator-dashed mb-7"></div>
                                <!--end::Seperator-->
                                <!--begin::Section-->
                                <div class="mb-7">
                                    <!--begin::Title-->
                                    <h5 class="mb-3">Terakhir Kunjungan</h5>
                                    <!--end::Title-->
                                    <!--begin::Details-->
                                    <div class="mb-0">
                                        <!--begin::Plan-->
                                        <span class="badge badge-light-info me-2">
                                            @php
                                                $lastVisitYear = \Illuminate\Support\Carbon::parse(
                                                    $dapen->lastKunjungan->tanggal_kj,
                                                )->year;
                                                $currentYear = now()->year;
                                                $difference = $currentYear - $lastVisitYear;

                                                if ($difference === 0) {
                                                    echo 'Tahun Ini';
                                                } elseif ($difference === 1) {
                                                    echo 'Tahun Kemarin';
                                                } else {
                                                    echo $difference . ' Tahun Lalu';
                                                }
                                            @endphp
                                        </span>
                                        <!--end::Plan-->
                                        <!--begin::Price-->
                                        <span class="fw-semibold text-gray-600">
                                            {{ \Illuminate\Support\Carbon::parse($dapen->lastKunjungan->tanggal_kj)->translatedFormat('d F Y') }}
                                        </span>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Section-->

                                <!--begin::Actions-->
                                <div class="mb-0">
                                    <a href="/puskesmas/kunjungan/{{ $dapen->lastKunjungan->id }}"
                                        class="btn btn-primary btn-sm">Detail Kunjungan</a>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                </div>
                <!--end::Layout-->

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
    <!--end::Vendors Javascript-->


    <!--begin::Form Kunjungan Javascript-->
    <script>
        // Define form element
        const form = document.getElementById('kt_docs_formvalidation_text');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'tinggi_bdn': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'berat_bdn': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'lingkar_prt': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'diastole': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'sistole': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'gula_drh': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'kolesterol': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'asam_urat': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'merokok': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'ginjal': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'penglihatan': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'pendengaran': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'adl': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'gds': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
                            }
                        }
                    },
                    'tanggal_kj': {
                        validators: {
                            notEmpty: {
                                message: 'Field is required'
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
        const submitButton = document.getElementById('kt_docs_formvalidation_text_submit');
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function(status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click
                        submitButton.disabled = true;

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function() {
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
                            });

                            form.submit(); // Submit form
                        }, 2000);
                    }
                });
            }
        });
    </script>
    <!--end::Form Kunjungan Javascript-->

    <!--begin::datepick Javascript-->
    <script>
        $("#kt_datepicker_1").flatpickr();
    </script>
    <!--end::datepick Javascript-->

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
