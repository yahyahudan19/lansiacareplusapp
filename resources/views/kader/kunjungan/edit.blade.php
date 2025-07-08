@extends('components.layout')

@section('title')
    Detail Kunjungan
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
                            Edit Kunjungan</h1>
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
                        <a href="{{ url()->previous() }}" class="btn btn-success btn-sm">
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
                        @if (Auth::user()->role == 'Kader')
                            <form id="kt_docs_formvalidation_text" class="form" action="/kader/kunjungan/update/{{ $kunjungan->id }}"
                                autocomplete="off" method="POST">
                            @else
                                <form id="kt_docs_formvalidation_text" class="form" action="/puskesmas/kunjungan/update/{{ $kunjungan->id }}""
                                    autocomplete="off" method="POST">
                        @endif
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
                                                    <input type="text"
                                                        class="form-control form-control-solid border-0 ps-12"
                                                        data-kt-dialer-control="input" placeholder="Amount"
                                                        name="tinggi_bdn" value="{{ $kunjungan->tinggi_bdn ?? '' }}" />
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
                                                <input type="text" class="form-control form-control-solid border-0 ps-12"
                                                    data-kt-dialer-control="input" placeholder="Amount" name="berat_bdn"
                                                    value="{{ $kunjungan->berat_bdn ?? '' }}" />
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
                                                    data-kt-dialer-control="input" placeholder="Amount"
                                                    name="lingkar_prt" value="{{ $kunjungan->lingkar_prt ?? '' }}" />
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
                                                        name="diastole" value="{{ $kunjungan->diastole ?? '' }}" />
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
                                    <div class="col-md-6 fv-row">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Sistole</span>
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
                                                    data-kt-dialer-control="input" placeholder="Amount" name="sistole"
                                                    value="{{ $kunjungan->sistole ?? '' }}" />
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
                                            <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </button>
                                        <!--end::Decrease control-->

                                        <!--begin::Input control-->
                                        <input type="text" class="form-control form-control-solid border-0 ps-12"
                                            data-kt-dialer-control="input" placeholder="Amount" name="gula_drh"
                                            value="{{ $kunjungan->gula_drh ?? '' }}" />
                                        <!--end::Input control-->

                                        <!--begin::Increase control-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                            data-kt-dialer-control="increase">
                                            <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i>
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
                                        <span>Kolesterol</span>
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
                                            <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span
                                                    class="path2"></span></i>
                                        </button>
                                        <!--end::Decrease control-->

                                        <!--begin::Input control-->
                                        <input type="text" class="form-control form-control-solid border-0 ps-12"
                                            data-kt-dialer-control="input" placeholder="Amount" name="kolesterol"
                                            value="{{ $kunjungan->kolesterol ?? '' }}" />
                                        <!--end::Input control-->

                                        <!--begin::Increase control-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                            data-kt-dialer-control="increase">
                                            <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i>
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
                                    <label class="fw-semibold fs-6 mb-2">Asam Urat</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="asam_urat" class="form-control form-control-solid mb-3 mb-lg-0" 
                                        value="{{ $kunjungan->asam_urat ?? '' }}" />
                                    <!--end::Input-->
                                    <div class="form-text">Ganti tanda koma (,) dengan tanda titik(.) <b>Misalkan 2.7</b></div>

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-5">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center form-label">
                                        <span class="required">Alasan</span>
                                    </label>
                                    <!--end::Label-->
                                    <div class="mb-10">
                                        <select class="form-select" name="keterangan" data-control="select2" data-placeholder="Pilih Keterangan">
                                            <option></option>
                                            <option value="Tidak Ada" {{ $skrining->keterangan == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                                            <option value="Tidak ada Bahan Medis Habis Pakai" {{ $skrining->keterangan == 'Tidak ada Bahan Medis Habis Pakai' ? 'selected' : '' }}>Tidak ada Bahan Medis Habis Pakai</option>
                                            <option value="Belum dilakukan pemeriksaan" {{ $skrining->keterangan == 'Belum dilakukan pemeriksaan' ? 'selected' : '' }}>Belum dilakukan pemeriksaan</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <input type="hidden" name="tanggal_kj" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                <!--end::Input group-->
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
                             <div class="card-body pt-0">
                                <div class="text">Berdasarkan aktifitas kegiatan sehari hari (AKS)</div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <input type="text" name="nik" value="{{ $dapen->nik }}" hidden>
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Apakah anda merokok ?</span>
                                    </label>
                                    <select class="form-select" data-control="select2" name="merokok">
                                        <option value="Y" {{ $skrining->merokok == 'Y' ? 'selected' : '' }}>Iya</option>
                                        <option value="TSB" {{ $skrining->merokok == 'TSB' ? 'selected' : '' }}>Tidak, Sudah Berhenti Kurang dari 1 Tahun</option>
                                        <option value="TPS" {{ $skrining->merokok == 'TPS' ? 'selected' : '' }}>Tidak Pernah Sama Sekali</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Apakah anda memiliki riwayat atau sedang mengalami gangguan ginjal ?</span>
                                    </label>
                                    <select class="form-select" data-control="select2" name="ginjal">
                                        <option value="Y" {{ $skrining->ginjal == 'Y' ? 'selected' : '' }}>Iya</option>
                                        <option value="N" {{ $skrining->ginjal == 'N' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Bagaimana tingkat kemandirian anda ?</span>
                                    </label>
                                    <select class="form-select" data-control="select2" name="adl">
                                        <option value="A" {{ $skrining->adl == 'A' ? 'selected' : '' }}>Mandiri (A) : Dapat melakukan aktivitas sendiri tanpa bantuan orang lain</option>
                                        <option value="B" {{ $skrining->adl == 'B' ? 'selected' : '' }}>Ketergantungan Ringan (B) : Membutuhkan bantuan orang lain dalam melakukan aktivitas tertentu/memakai kursi roda</option>
                                        <option value="B1" {{ $skrining->adl == 'B1' ? 'selected' : '' }}>Ketergantungan Sedang (B) : Mengalami gangguan dalam aktifitas sehari-hari sendiri, terutama dalam hal Buang Air Kecil (BAK) dan Buang Air Besar (BAB)</option>
                                        <option value="C" {{ $skrining->adl == 'C' ? 'selected' : '' }}>Ketergantungan Berat (C) : Hanya bisa beraktivitas diatas tempat tidur</option>
                                        <option value="D" {{ $skrining->adl == 'D' ? 'selected' : '' }}>Ketergantungan Total (D) : Sama sekali tidak mampu melakukan aktifitas hidup sehari-hari, sehingga sangat tergantung orang lain</option>
                                    </select>
                                </div>
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
                                    <h3 class="fw-bold">Skilas (Skrining Lansia Sederhana )</h3>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Apakah terdapat penurunan kognitif?</span>
                                    </label>
                                    <select class="form-select" data-control="select2" name="kognitif">
                                        <option value="Y" {{ $skrining->kognitif == 'Y' ? 'selected' : '' }}>Ya</option>
                                        <option value="N" {{ $skrining->kognitif == 'N' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Apakah terdapat penurunan Mobilisasi (Tes berdiri dari kursi)?</span>
                                    </label>
                                    <select class="form-select" data-control="select2" name="mobilisasi">
                                        <option value="Y" {{ $skrining->mobilisasi == 'Y' ? 'selected' : '' }}>Ya</option>
                                        <option value="N" {{ $skrining->mobilisasi == 'N' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Apakah terdapat Malnutrisi?</span>
                                    </label>
                                    <select class="form-select" data-control="select2" name="malnutrisi">
                                        <option value="Y" {{ $skrining->malnutrisi == 'Y' ? 'selected' : '' }}>Ya</option>
                                        <option value="N" {{ $skrining->malnutrisi == 'N' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Apakah anda memiliki gangguan penglihatan (menggunakan kacamata/tidak jelas ketika melihat benda jauh atau dekat/ tidak jelas ketika membaca tanpa kacamata)?</span>
                                    </label>
                                    <select class="form-select" data-control="select2" name="penglihatan">
                                        <option value="Y" {{ $skrining->penglihatan == 'Y' ? 'selected' : '' }}>Iya</option>
                                        <option value="N" {{ $skrining->penglihatan == 'N' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Apakah anda memiliki gangguan pendengaran (menggunakan alat bantu dengar/ membutuhkan suara keras bila berbicara dengan orang lain)?</span>
                                    </label>
                                    <select class="form-select" data-control="select2" name="pendengaran">
                                        <option value="Y" {{ $skrining->pendengaran == 'Y' ? 'selected' : '' }}>Iya</option>
                                        <option value="N" {{ $skrining->pendengaran == 'N' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                </div>
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Bagaimana gambaran mental emosional pada diri anda?</span>
                                    </label>
                                    <select class="form-select" data-control="select2" name="gds">
                                        <option value="A" {{ $skrining->gds == 'A' ? 'selected' : '' }}>Sudah puas dengan kehidupan, bersemangat, merasa bahagia, menyenangkan</option>
                                        <option value="B" {{ $skrining->gds == 'B' ? 'selected' : '' }}>Merasa bosan, lebih senang dirumah, meninggalkan banyak kesenangan, cemas, memiliki masalah daya ingat</option>
                                        <option value="C" {{ $skrining->gds == 'C' ? 'selected' : '' }}>Merasa kehidupan hampa, tidak berdaya, tidak berharga, tidak ada harapan, keadaan orang lain lebih baik</option>
                                    </select>
                                </div>
                                <button id="kt_docs_formvalidation_text_submit" type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Simpan</span>
                                    <span class="indicator-progress">Silahkan Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
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
                                        <a href="/kader/penduduk/{{ $dapen->id }}"
                                            class="fw-bold text-gray-800 text-hover-primary me-2">{{ $dapen->nama }}</a>
                                        <!--end::Name-->
                                        <!--begin::Status-->
                                        @if ($dapen->category == 'Lansia')
                                            <span class="badge badge-light-danger">{{ $dapen->category }}</span>
                                        @elseif ($dapen->category == 'Pra-Lansia')
                                            <span class="badge badge-light-warning">{{ $dapen->category }}</span>
                                        @else
                                            <span class="badge badge-light-success">{{ $dapen->category }}</span>
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
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary me-2">Umur
                                            :
                                        </a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Email-->
                                    <a href="#"
                                        class="fw-semibold text-gray-600 text-hover-primary">
                                        {{ \Carbon\Carbon::parse($dapen->tanggal_lahir)->age }} Tahun
                                    </a>
                                    <!--end::Email-->
                                </div>
                                <div class="mb-3">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center mb-1">
                                        <!--begin::Name-->
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary me-2">RT/RW
                                            :
                                        </a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Email-->
                                    <a href="#"
                                        class="fw-semibold text-gray-600 text-hover-primary">
                                        {{ $dapen->rt ?? '00' }}/{{ $dapen->rw ?? '00' }}
                                    </a>
                                    <!--end::Email-->
                                </div>
                                <div class="mb-3">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center mb-1">
                                        <!--begin::Name-->
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary me-2">Kecamatan
                                            :
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
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary me-2">Kelurahan
                                            :
                                        </a>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Email-->
                                    <a href="#"
                                        class="fw-semibold text-gray-600 text-hover-primary">{{ $dapen->kelurahan->nama }}
                                    </a>
                                    <!--end::Email-->
                                    
                                </div>
                                <div class="mb-3">
                                    <a href="/kader/penduduk/{{ $dapen->id }}"
                                        class="btn btn-warning btn-sm">Detail Penduduk</a>
                                </div>
                                <!--end::Section-->

                                <!--begin::Seperator-->
                                <div class="separator separator-dashed mb-7"></div>
                                <!--end::Seperator-->
                                <!--begin::Section-->
                                <div class="mb-4">
                                    <!--begin::Title-->
                                    <h5 class="mb-3">Terakhir Kunjungan</h5>
                                    <!--end::Title-->
                                    <!--begin::Details-->
                                    @if ($dapen->lastKunjungan == null)
                                        <div class="mb-0">
                                            <!--begin::Plan-->
                                            <span class="badge badge-light-info me-2">Belum Pernah Kunjungan</span>
                                            <!--end::Plan-->
                                            <!--begin::Price-->
                                            <span class="fw-semibold text-gray-600">-</span>
                                            <!--end::Price-->
                                        </div>
                                    @else
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
                                    @endif
                                    <!--end::Details-->
                                </div>
                                <!--end::Section-->

                                <!--begin::Actions-->
                                @if ($dapen->lastKunjungan)
                                    <div class="mb-0">
                                        <a href="/kader/kunjungan/{{ $dapen->id }}"
                                            class="btn btn-primary btn-sm">Detail Kunjungan</a>
                                    </div>
                                @endif
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
                    message: 'Harus Diisi !'
                    },
                    stringLength: {
                    min: 3,
                    max: 3,
                    message: 'Minimal 100'
                    }
                }
                },
                'berat_bdn': {
                validators: {
                    notEmpty: {
                    message: 'Harus Diisi !'
                    },
                    stringLength: {
                    min: 2,
                    max: 3,
                    message: 'Minimal 30'
                    }
                }
                },
                'lingkar_prt': {
                validators: {
                    notEmpty: {
                    message: 'Harus Diisi !'
                    },
                    stringLength: {
                    min: 2,
                    max: 3,
                    message: 'Minimal 10'
                    }
                }
                },
                'diastole': {
                validators: {
                    notEmpty: {
                    message: 'Harus Diisi !'
                    },
                    stringLength: {
                    min: 2,
                    max: 3,
                    message: 'Minimal 20'
                    }
                }
                },
                'sistole': {
                validators: {
                    notEmpty: {
                    message: 'Harus Diisi !'
                    },
                    stringLength: {
                    min: 2,
                    max: 3,
                    message: 'Minimal 20'
                    }
                }
                },
                'gula_drh': {
                validators: {
                    notEmpty: {
                    message: 'Harus Diisi !'
                    },
                    stringLength: {
                    min: 2,
                    max: 3,
                    message: 'Minimal 20'
                    }
                }
                },
                // 'kolesterol': {
                // validators: {
                //     notEmpty: {
                //     message: 'Harus Diisi !'
                //     },
                //     stringLength: {
                //     min: 2,
                //     max: 3,
                //     message: 'Minimal 20'
                //     }
                // }
                // },
                // 'asam_urat': {
                // validators: {
                //     notEmpty: {
                //     message: 'Harus Diisi !'
                //     },
                //     numeric: {
                //     message: 'Harus desimal'
                //     },
                //     stringLength: {
                //     min: 3,
                //     max: 3,
                //     message: 'Nilai minimal 1 digit'
                //     }
                // }
                // }
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
                                text: "Data berhasil di kirim!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Baiklah !",
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
    @if(session('status') && session('message'))
        <script>
            let status = "{{ session('status') }}";
            let message = "{{ session('message') }}";

            if (status === 'success') {
                Swal.fire({
                    text: message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Baiklah !",
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
                    confirmButtonText: "Baiklah !",
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
                    confirmButtonText: "Baiklah !",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }
        </script>
    @endif
    <!-- end sessions -->
@endsection
