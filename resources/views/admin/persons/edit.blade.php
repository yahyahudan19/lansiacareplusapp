@extends('components.layout')

@section('title')
    Edit Penduduk
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Edit Penduduk</h1>
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
                            <li class="breadcrumb-item text-muted">Edit</li>
                            <!--end::Item-->
                            
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="javascript:history.back()" class="btn btn-flex btn-success h-40px fs-7 fw-bold">
                            <i class="ki-duotone ki-left-square"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Kembali</a>
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
                <!--begin::Form-->
                <form action="/admin/penduduk/update/{{$persons->id}}" id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="/admin/penduduk" method="POST">
                    @csrf
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">Data Diri</a>
                            </li>
                            <!--end:::Tab item-->
                            
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Edit Data Diri</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-5 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Nama Lengkap</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Lengkap" value="{{$persons->nama}}" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                {{-- <div class="text-muted fs-7">A product name is required and recommended to be unique.</div> --}}
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">NIK</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="nik" class="form-control mb-2" placeholder="NIK" value="{{$persons->nik}}" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                {{-- <div class="text-muted fs-7">A product name is required and recommended to be unique.</div> --}}
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                           
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-wrap gap-5 mb-4">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Jenis Kelamin</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select mb-2" name="jenis_kelamin" data-control="select2" data-hide-search="true" data-placeholder="Select an option">
                                                        <option></option>
                                                        <option value="L" {{ $persons->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                                        <option value="P" {{ $persons->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                    <!--end::Select2-->
                                                    <!--begin::Description-->
                                                    {{-- <div class="text-muted fs-7">Set the product tax class.</div> --}}
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Tanggal Lahir</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="input-group" id="kt_td_picker_date_only" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                                        <input id="kt_td_picker_date_only_input" name="tanggal_lahir" type="text" class="form-control" data-td-target="#kt_td_picker_date_only" value="{{ $tanggal_lahir }}"/>
                                                        <span class="input-group-text" data-td-target="#kt_td_picker_date_only" data-td-toggle="datetimepicker">
                                                            <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                                                        </span>
                                                    </div>
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    {{-- <div class="text-muted fs-7">Set the product VAT about.</div> --}}
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Status</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select mb-2" name="status" data-control="select2" data-hide-search="true" data-placeholder="Select an option">
                                                        <option></option>
                                                        <option value="Hidup" {{ $persons->status == 'Hidup' ? 'selected' : '' }}>Hidup</option>
                                                        <option value="Meninggal" {{ $persons->status == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                                                    </select>
                                                    <!--end::Select2-->
                                                    <!--begin::Description-->
                                                    {{-- <div class="text-muted fs-7">Set the product tax class.</div> --}}
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-wrap gap-5 mb-4">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">No. Telp</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="telp" class="form-control mb-2" placeholder="No. Telp" value="{{$persons->telp}}" />

                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    {{-- <div class="text-muted fs-7">Set the product tax class.</div> --}}
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                {{-- <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="form-label">BPJS</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="bpjs" class="form-control mb-2" placeholder="No. BPJS" value="{{$persons->bpjs}}" />

                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">Set the product tax class.</div>
                                                    <!--end::Description-->
                                                </div> --}}
                                                
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Apakah anda bersedia hasil skrining ini dikirimkan ke No HP Anda?</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select mb-2" name="notifikasi" data-control="select2" data-placeholder="Select a Notifikasi">
                                                        <option value="Y">Iya</option>
                                                        <option value="N">Tidak</option>
                                                    </select>
                                                    <!--end::Select2-->
                                                    <!--begin::Description-->
                                                    {{-- <div class="text-muted fs-7">Set the product tax class.</div> --}}
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Kemana anda akan pergi berobat, jika memerlukan pemeriksaan lebih lanjut?</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="person_periksa" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Pilih..." data-allow-clear="true" data-hide-search="true">
                                                    <option value="Puskesmas" {{ $persons->tempat_periksa == 'Puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                                                    <option value="Klinik" {{ $persons->tempat_periksa == 'Klinik' ? 'selected' : '' }}>Klinik</option>
                                                    <option value="Praktik Dokter" {{ $persons->tempat_periksa == 'Praktik Dokter' ? 'selected' : '' }}>Praktik Dokter</option>
                                                    <option value="RS Tipe D" {{ $persons->tempat_periksa == 'RS Tipe D' ? 'selected' : '' }}>RS Tipe D</option>
                                                </select>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                {{-- <div class="text-muted fs-7">A product name is required and recommended to be unique.</div> --}}
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-5 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Alamat</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="alamat" class="form-control mb-2" placeholder="Alamat Lengkap" value="{{$persons->alamat}}" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                {{-- <div class="text-muted fs-7">A product name is required and recommended to be unique.</div> --}}
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-wrap gap-5 mb-5">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">RT</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <input type="text" name="rt" class="form-control mb-2" placeholder="RT" value="{{$persons->rt}}" />

                                                    <!--end::Select2-->
                                                    <!--begin::Description-->
                                                    {{-- <div class="text-muted fs-7">Set the product tax class.</div> --}}
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">RW</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="rw" class="form-control mb-2" placeholder="RW" value="{{$persons->rw}}" />

                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    {{-- <div class="text-muted fs-7">Set the product VAT about.</div> --}}
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                 <!--begin::Input group-->
                                                 <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Kelurahan</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <select class="form-select mb-2" name="kelurahan_id" data-control="select2" data-placeholder="Select a Kelurahan">
                                                        <option></option>
                                                        @foreach ($kelurahans as $kel)
                                                            <option value="{{ $kel->id }}" {{ $kel->id == $persons->kelurahan_id ? 'selected' : '' }}>
                                                                {{ $kel->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <!--end::Select2-->
                                                    <!--begin::Description-->
                                                    {{-- <div class="text-muted fs-7">Set the product tax class.</div> --}}
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Input group-->

                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->
                                    
                                    
                                </div>
                            </div>
                            <!--end::Tab pane-->
                            
                            
                        </div>
                        <!--end::Tab content-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="javascript:history.back()" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Batal</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Silahkan Tunggu... 
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
                <!--end::Form-->
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
    <!--begin::Custom Javascript(used for this page only)-->
    {{-- <script src="{{ asset('template/assets/js/custom/apps/ecommerce/catalog/save-product.js')}}"></script> --}}
    
    <!--begin::Custom Javascript(Save / Submit form)-->
    <script>
        "use strict";

        // Class definition
        var KTAppEcommerceSaveProduct = function () {

            // Private functions

            // Submit form handler
            const handleSubmit = () => {
                // Define variables
                let validator;

                // Get elements
                const form = document.getElementById('kt_ecommerce_add_product_form');
                const submitButton = document.getElementById('kt_ecommerce_add_product_submit');

                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                validator = FormValidation.formValidation(
                    form,
                    {
                        fields: {
                            'nama': {
                                validators: {
                                    notEmpty: {
                                        message: 'Nama is required'
                                    }
                                }
                            },
                            'nik': {
                                validators: {
                                    notEmpty: {
                                        message: 'NIK is required'
                                    },
                                    stringLength: {
                                        min: 16,
                                        max: 16,
                                        message: 'NIK harus 16 digit'
                                    },
                                    regexp: {
                                        regexp: /^[0-9]+$/,
                                        message: 'NIK harus berupa angka'
                                    }
                                }
                            },
                            'jenis_kelamin': {
                                validators: {
                                    notEmpty: {
                                        message: 'Jenis Kelamin is required'
                                    }
                                }
                            },
                            'tanggal_lahir': {
                                validators: {
                                    notEmpty: {
                                        message: 'Tanggal Lahir is required'
                                    }
                                }
                            },
                            //'telp': {
                            //    validators: {
                            //        notEmpty: {
                            //            message: 'No. Telp is required'
                            //        }
                            //    }
                            //},
                            'status': {
                                validators: {
                                    notEmpty: {
                                        message: 'Status is required'
                                    }
                                }
                            },
                            'alamat': {
                                validators: {
                                    notEmpty: {
                                        message: 'Alamat is required'
                                    }
                                }
                            },
                            'rt': {
                                validators: {
                                    notEmpty: {
                                        message: 'RT is required'
                                    }
                                }
                            },
                            'rw': {
                                validators: {
                                    notEmpty: {
                                        message: 'RW is required'
                                    }
                                }
                            },
                            'kelurahan_id': {
                                validators: {
                                    notEmpty: {
                                        message: 'Kelurahan is required'
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

                // Handle submit button
                submitButton.addEventListener('click', e => {
                    e.preventDefault();

                    // Validate form before submit
                    if (validator) {
                        validator.validate().then(function (status) {
                            console.log('validated!');

                            if (status == 'Valid') {
                                submitButton.setAttribute('data-kt-indicator', 'on');

                                // Disable submit button whilst loading
                                submitButton.disabled = true;

                                setTimeout(function () {
                                submitButton.removeAttribute('data-kt-indicator');

                                    $.ajax({
                                        url: form.action,
                                        method: 'POST',
                                        data: $(form).serialize(),
                                        success: function (response) {
                                            Swal.fire({
                                                text: "Data berhasil disimpan!",
                                                icon: "success",
                                                buttonsStyling: false,
                                                confirmButtonText: "Baiklah !!",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            }).then(function () {
                                                // Redirect ke halaman asal jika perlu
                                                // window.location = form.getAttribute("data-kt-redirect");
                                            });
                                        },
                                        error: function (xhr) {
                                            submitButton.disabled = false;
                                            submitButton.removeAttribute('data-kt-indicator');

                                            Swal.fire({
                                                html: "Terjadi kesalahan saat menyimpan data.<br>Silakan cek kembali input atau coba lagi.",
                                                icon: "error",
                                                buttonsStyling: false,
                                                confirmButtonText: "OK",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            });
                                        }
                                    });
                                }, 200); // <-- boleh kamu kecilkan delay-nya kalau mau lebih cepat

                            } else {
                                Swal.fire({
                                    html: "Maaf, sepertinya ada yang error ! <br/><br/>Please note that there may be errors in the <strong>Data Diri</strong> tabs",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Baiklah !!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });
                    }
                })
            }

            // Public methods
            return {
                init: function () {

                    // Handle forms
                    handleSubmit();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTAppEcommerceSaveProduct.init();
        });

    </script>
    <!--begin::Custom Javascript(Date Picker)-->
    <script>
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_date_only"), {
            display: {
                viewMode: "calendar",
                components: {
                    decades: true,
                    year: true,
                    month: true,
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false
                }
            }
        });
    </script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

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
                    confirmButtonText: "Baiklah !!",
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
                    confirmButtonText: "Baiklah !!",
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