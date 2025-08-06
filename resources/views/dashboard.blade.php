{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('components.layout')

@section('title')
    Dashboard
@endsection

@section('plugins-head')

@endsection

@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <h1 class="text-center mb-5">Selamat Datang,{{ Auth::user()->name }}</h1>

            @if(Auth::user()->role == 'Kader')
            <!--begin::Row-->
            <div class="row g-12 g-xl-10">
                <!--begin::Button-->
                <div class="col-md-3 col-xl-3 mb-3 mb-md-0 mb-xxl-10">
                    <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                        <i class="fas fa-user-plus me-2"></i> Tambah Data Penduduk
                    </a>
                </div>
                <!--end::Button-->
                <!--begin::Button-->
                <div class="col-md-3 col-xl-3 mb-3 mb-md-0 mb-xxl-10">
                    <a href="#" class="btn btn-success d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                        <i class="fas fa-calendar-plus me-2"></i> Tambah Kunjungan
                    </a>
                </div>
                <!--end::Button-->
            </div>
            <!--end::Row-->

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
                                        <input type="text" name="person_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama Lengkap"/>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row g-9 mb-7">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold mb-2">NIK</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="person_nik" placeholder="3573010101010001">
                                            <!--end::Input-->
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold mb-2">Jenis Kelamin</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <!--begin::Input-->
                                        <select name="jenis_kelamin" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                            <option></option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <!--end::Input-->
                                            <!--end::Input-->
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row g-9 mb-7">
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
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->

                                        {{-- <!--begin::Col-->
                                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="fw-semibold fs-6 mb-2">No. BPJS</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="person_bpjs" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="No. BPJS" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col--> --}}
                                    </div>
                                    <!--end::Input group-->
                                    <span><center>Kemana anda akan pergi berobat, jika memerlukan pemeriksaan lebih lanjut?</center></span>
                                    <br>
                                    <!--begin::Input group-->
                                    <div class="row g-9 mb-7">
                                        {{-- <!--begin::Col-->
                                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="fw-semibold fs-6 mb-2">No. BPJS</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="person_bpjs" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="No. BPJS" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div> --}}
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-12 fv-row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            {{-- <label class="fw-semibold fs-6 mb-2">Pilih Salah Satu</label> --}}
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="person_periksa" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Pilih..." data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="Puskesmas">Puskesmas</option>
                                                <option value="Klinik">Klinik</option>
                                                <option value="Praktik Dokter">Praktik Dokter</option>
                                                <option value="RS Tipe D">RS Tipe D</option>
                                            </select>
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    <span><center>Apakah anda ingin hasil skrining kesehatan dikirimkan melalui nomer HP yang anda berikan?</center></span>
                                    <!--begin::Input group-->
                                    <div class="row g-9 mb-7">
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="form-label required">Kirim Hasil Skrining</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="person_notifikasi" id="person_notifikasi" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="Y">Iya</option>
                                                <option value="N">Tidak</option>
                                            </select>
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row fv-plugins-icon-container" id="telp_container" style="display: none;">
                                            <!--begin::Label-->
                                            <label class="fw-semibold fs-6 mb-2">No. Telp</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="person_telp" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="No. Telp" />
                                            <!--end::Input-->
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fw-semibold fs-6 mb-2 required">Alamat Lengkap</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="person_alamat" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Alamat"  />
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
                                            <input class="form-control form-control-solid" placeholder="" name="person_rt" >
                                            <!--end::Input-->
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 fv-row fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold mb-2">RW</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="" name="person_rw" >
                                            <!--end::Input-->
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="form-label required">Kecamatan</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="kecamatan" id="kecamatan" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                            <option></option>
                                            @foreach ($kecamatans as $kec)
                                                <option value="{{$kec->id}}">{{$kec->nama}}</option>
                                            @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="form-label required">Kelurahan</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="person_kelurahan" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                            <option></option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-10">
                                    <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Batal</button>
                                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                        <span class="indicator-label">Simpan</span>
                                        <span class="indicator-progress">Silahkan Tunggu...
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

            <!--begin::Modal Search Person-->
            <div class="modal fade" tabindex="-1" id="kt_modal_1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <form id="kt_docs_formvalidation_text" class="form" action="/kader/kunjungan/tambah" autocomplete="off" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h3 class="modal-title">Cari Data Penduduk</h3>
                
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                                <!--end::Close-->
                            </div>
                
                            <div class="modal-body">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <center><label class="required fw-semibold fs-6 mb-2 ">Masukkan NIK untuk Menambahkan Data Kunjungan !</label></center>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" name="nik" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <!--begin::Actions-->
                                <button id="kt_docs_formvalidation_text_submit" type="submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Cari Penduduk
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                <!--end::Actions-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--begin::Modal Search Person-->
            @endif

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@endsection

@section('plugins-last')
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

<!--begin::No. Telp Function-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notifikasiSelect = $('#person_notifikasi');
        const telpContainer = document.getElementById('telp_container');

        if (notifikasiSelect.length && telpContainer) {
            notifikasiSelect.on('change', function () {
                if (this.value === 'Y') {
                    telpContainer.style.display = 'block';
                } else {
                    telpContainer.style.display = 'none';
                }
            });
        }
    });
</script>
<!--end::No. Telp Function-->

<!--begin::Add Person Javascript-->
<script>
    "use strict";
    var KTUsersAddUser = function () {
        const element = document.getElementById('kt_modal_add_user');
        const form = element.querySelector('#kt_modal_add_user_form');
        const modal = new bootstrap.Modal(element);

        var initAddUser = () => {
            // VALIDASI FORM
            var validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'person_name': { validators: { notEmpty: { message: 'Nama Lengkap Harus diisi' } } },
                        'person_nik': {
                            validators: {
                                notEmpty: { message: 'NIK Harus diisi' },
                                stringLength: {
                                    min: 16,
                                    max: 16,
                                    message: 'NIK harus 16 digit'
                                },
                                regexp: {
                                    regexp: /^[0-9]+$/,
                                    message: 'NIK harus berupa angka'
                                },
                                remote: {
                                    message: 'NIK sudah terdaftar',
                                    method: 'POST',
                                    url: '/check-nik',
                                    data: function () {
                                        return {
                                            nik: form.querySelector('[name="person_nik"]').value,
                                        };
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                }
                            }
                        },
                        'person_tl': { validators: { notEmpty: { message: 'Valid Tanggal Lahir Harus diisi' } } },
                        'jenis_kelamin': { validators: { notEmpty: { message: 'Jenis Kelamin harus diisi' } } },
                        'person_alamat': { validators: { notEmpty: { message: 'Valid Alamat Harus diisi' } } },
                        'person_rt': { validators: { notEmpty: { message: 'Valid RT Harus diisi' } } },
                        'person_rw': { validators: { notEmpty: { message: 'Valid RW Harus diisi' } } },
                        'person_kelurahan': { validators: { notEmpty: { message: 'Valid Kelurahan Harus diisi' } } },
                        'person_notifikasi': { validators: { notEmpty: { message: 'Valid Notifikasi Harus diisi' } } },
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

            // AJAX: Ganti Kelurahan saat Kecamatan berubah
            $(document).ready(function () {
                const kecSelect = $('select[name="kecamatan"]');
                const kelSelect = $('select[name="person_kelurahan"]');

                kecSelect.on('change', function () {
                    console.log('Change event triggered');

                    const kecamatanId = $(this).val();
                    kelSelect.html('<option value="">Loading...</option>');

                    if (kecamatanId) {
                        fetch(`/get-kelurahan-by-kecamatan/${kecamatanId}`)
                            .then(res => res.json())
                            .then(data => {
                                kelSelect.html('<option value="">Pilih Kelurahan...</option>');
                                data.forEach(kel => {
                                    kelSelect.append(`<option value="${kel.id}">${kel.nama}</option>`);
                                });
                                kelSelect.trigger('change'); // trigger Select2 refresh
                            });
                    } else {
                        kelSelect.html('<option value="">Pilih Kelurahan...</option>');
                        kelSelect.trigger('change');
                    }
                });
            });

            // SUBMIT
            const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
            submitButton.addEventListener('click', e => {
                e.preventDefault();
                if (validator) {
                    validator.validate().then(function (status) {
                        if (status == 'Valid') {
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            submitButton.disabled = true;

                            setTimeout(function () {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                Swal.fire({
                                    text: "Form Berhasil disimpan !",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Baik",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        modal.hide();
                                    }
                                });

                                form.submit();

                            }, 2000);
                        } else {
                            Swal.fire({
                                text: "Maaf, Sepertinya masih ada error .",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Baik, coba lagi!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                }
            });

            // CANCEL & CLOSE
            const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();
                Swal.fire({
                    text: "Yakin tidak jadi ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Iya, batalkan saja",
                    cancelButtonText: "Tidak",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        form.reset();
                        modal.hide();
                    }
                });
            });

            const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();
                Swal.fire({
                    text: "Yakin dibatalkan ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Iya, batalkan saja!",
                    cancelButtonText: "Tidak",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        form.reset();
                        modal.hide();
                    }
                });
            });
        }

        return {
            init: function () {
                initAddUser();
            }
        };
    }();

    KTUtil.onDOMContentLoaded(function () {
        KTUsersAddUser.init();
    });
</script>
<!--end::Add Person Javascript-->

<!--begin::Add Kunjungan Form Javascript-->
<script>
    // Define form element
    const form = document.getElementById('kt_docs_formvalidation_text');

    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'nik': {
                    validators: {
                        notEmpty: {
                            message: 'NIK Harus diisi'
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
    submitButton.addEventListener('click', function (e) {
        // Prevent default button action
        e.preventDefault();

        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                console.log('validated!');

                if (status == 'Valid') {
                    let nik = document.querySelector('input[name="nik"]').value;

                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // AJAX request to check NIK
                    $.ajax({
                        url: '/getPendudukByNIK',
                        type: 'GET',
                        data: { nik: nik },
                        success: function(response) {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');
                            // Enable button
                            submitButton.disabled = false;
                            if (response.status === 'success') {
                                if (response.hasVisitedThisYear) {
                                    // NIK found but already visited this year
                                    const visitDate = response.visitData[0]?.tanggal_kj || 'tanggal tidak diketahui';
                                    Swal.fire({
                                        text: `Penduduk dengan NIK : ${response.data.nik} sudah melakukan kunjungan di tahun ini pada tanggal ${new Date(visitDate).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}.`,
                                        icon: "warning",
                                        buttonsStyling: false,
                                        confirmButtonText: "Baiklah!",
                                        customClass: {
                                            confirmButton: "btn btn-warning"
                                        }
                                    });
                                } else {
                                    // NIK found and not visited this year
                                    Swal.fire({
                                        text: `NIK Berhasil ditemukan! Penduduk (${response.data.nama}) belum melakukan kunjungan di tahun ini.`,
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Baiklah!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function () {
                                        form.submit(); // Submit form
                                    });
                                }
                            } else {
                                // NIK not found
                                Swal.fire({
                                    text: "NIK Tidak tersedia, silahkan tambahkan di menu Penduduk",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Baiklah!",
                                    customClass: {
                                        confirmButton: "btn btn-danger"
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            submitButton.removeAttribute('data-kt-indicator');
                            submitButton.disabled = false;
                            Swal.fire({
                                text: "Terjadi kesalahan, silahkan coba lagi nanti.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Baiklah !",
                                customClass: {
                                    confirmButton: "btn btn-danger"
                                }
                            });
                        }
                    });
                }
            });
        }
    });
</script>
<!--end::Add Kunjungan Form Javascript-->

@endsection
