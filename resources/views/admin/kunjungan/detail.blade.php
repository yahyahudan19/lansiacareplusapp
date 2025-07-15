@extends('components.layout')

@section('title')
    Detail Kunjungan
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Detail Kunjungan</h1>
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
                            <li class="breadcrumb-item text-muted">Detail</li>
                            <!--end::Item-->
                            
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <!--begin::Button-->
                        <button onclick="window.history.back();" class="btn btn-success">
                            <i class="ki-duotone ki-left-square"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                            Kembali
                        </button>
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
                <div class="d-flex flex-column flex-xl-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body pt-15">
                                <!--begin::Summary-->
                                <div class="d-flex flex-center flex-column mb-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-150px symbol-circle mb-7">
                                        @if ($dapen->jenis_kelamin == "L")
                                            <img src="{{ asset('template/assets/media/avatars/300-1.jpg')}}" alt="image" />
                                        @else
                                        <img src="{{ asset('template/assets/media/avatars/300-12.jpg')}}" alt="image" />
                                        @endif
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">{{$dapen->nama}}</a>
                                    <!--end::Name-->
                                    <!--begin::Email-->
                                    <a href="#" class="fs-5 fw-semibold text-muted text-hover-primary mb-6">{{$dapen->nik}}</a>
                                    <!--end::Email-->
                                </div>
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold">Details</div>
                                    <!--begin::Badge-->
                                    <div class="badge badge-light-info d-inline">{{$dapen->category}}</div>
                                    <!--begin::Badge-->
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator separator-dashed my-3"></div>
                                <!--begin::Details content-->
                                <div class="pb-5 fs-6">
                                    
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Alamat</div>
                                    <div class="text-gray-600">{{$dapen->alamat}}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Kelurahan :</div>
                                    <div class="text-gray-600">{{$dapen->kelurahan->nama}}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Kecamatan :</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary">{{$dapen->kelurahan->kecamatan->nama}}</a>
                                    </div>
                                    <!--begin::Details item-->
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_overview">Overview</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_hasil_skrining">Hasil Skrining</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_overview" role="tabpanel">
                                <div class="row row-cols-1 row-cols-md-2 mb-6 mb-xl-9">
                                    
                                    <div class="col">
                                        <!--begin::Reward Tier-->
                                        <a href="#" class="card bg-info hoverable h-md-100">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <i class="ki-outline ki-award text-white fs-3x ms-n1"></i>
                                                <div class="text-white fw-bold fs-2 mt-5">{{$riwkin_jum}} Skrining</div>
                                                <div class="fw-semibold text-white"> Total atau Jumlah Skrining</div>
                                            </div>
                                            <!--end::Body-->
                                        </a>
                                        <!--end::Reward Tier-->
                                    </div>
                                </div>
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Riwayat Kunjungan</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed gy-5" id="kt_table_customers_payment">
                                            <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                                <tr class="text-start text-muted text-uppercase gs-0">
                                                    <th class="min-w-100px">ID Kunjungan.</th>
                                                    <th>Status</th>
                                                    {{-- <th>Kelurahan</th> --}}
                                                    <th class="min-w-100px">Tanggal Kunjungan</th>
                                                    <th>Rekomendasi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fs-6 fw-semibold text-gray-600">
                                                @foreach ($riwkin as $riw)
                                                <tr>
                                                    <td>
                                                        <a href="#" class="text-gray-600 text-hover-primary mb-1">#{{$riw->id}}</a>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light-success">Success</span>
                                                    </td>
                                                    {{-- <td>{{$riw->person->kelurahan->nama}}</td> --}}
                                                    <td>{{ \Illuminate\Support\Carbon::parse($riw->tanggal_kj)->translatedFormat('d F Y') }}</td>
                                                    {{-- <td><span class="badge badge-warning">{{ $riwkin_rekomendasi[$riw->id] }}</span></td> --}}
                                                    <td>{{ $riwkin_rekomendasi[$riw->id] }}</td>
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
                            <!--end:::Tab pane-->
                           
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade" id="kt_hasil_skrining" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2 class="fw-bold mb-0">Riwayat Skrining</h2>
                                        </div>
                                        <!--end::Card title-->
                                        @if (Auth::user()->role == "System Administrator")
                                             <!--begin::Card toolbar-->
                                            <div class="card-toolbar">
                                                <form action="/admin/kunjungan/tambah" method="POST">
                                                    @csrf
                                                    <input type="text" name="nik" value="{{$dakun->person->nik}}" hidden />
                                                    <button type="submit" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                                    <i class="ki-outline ki-plus-square fs-3"></i>Tambah Skrining</button>
                                                </form>
                                            </div>
                                            <!--end::Card toolbar-->
                                        @endif
                                       
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div id="kt_customer_view_payment_method" class="card-body pt-0">
                                        <div class="accordion accordion-icon-toggle" id="kt_customer_view_payment_method_accordion">
                                            <!--begin::Option-->
                                            <div class="py-0" data-kt-customer-payment-method="row">
                                                <!--begin::Header-->
                                                <div class="py-3 d-flex flex-stack flex-wrap">
                                                    <!--begin::Toggle-->
                                                    <div class="accordion-header d-flex align-items-center" data-bs-toggle="collapse" href="#kt_customer_view_payment_method_1" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_1">
                                                        <!--begin::Arrow-->
                                                        <div class="accordion-icon me-2">
                                                            <i class="ki-outline ki-right fs-4"></i>
                                                        </div>
                                                        <!--end::Arrow-->
                                                        <!--begin::Logo-->
                                                        <img src="{{ asset('template/assets/media/svg/files/upload.svg')}}" class="w-40px me-3" alt="" />
                                                        <!--end::Logo-->
                                                        <!--begin::Summary-->
                                                        <div class="me-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="text-gray-800 fw-bold">Detail Skrining</div>
                                                                <div class="badge badge-light-primary ms-5">Terbaru</div>
                                                            </div>
                                                            <div class="text-muted">{{ \Illuminate\Support\Carbon::parse($dakun->tanggal_kj)->translatedFormat('d F Y') }}</div>
                                                        </div>
                                                        <!--end::Summary-->
                                                    </div>
                                                    <!--end::Toggle-->
                                                    @if (Auth::user()->role == "System Administrator")
                                                    <!--begin::Toolbar-->
                                                    <div class="d-flex my-3 ms-9">
                                                        <!--begin::Edit-->
                                                        <a href="/admin/kunjungan/edit/{{$dakun->id}}" class="btn btn-icon btn-light-primary btn-sm me-2">
                                                            <i class="ki-outline ki-pencil fs-6"></i>
                                                        </a>
                                                        <!--end::Edit-->
                                                        <!--begin::Delete-->
                                                        <a href="#" class="btn btn-icon btn-light-danger btn-sm" data-kt-customer-payment-method="delete">
                                                            <i class="ki-outline ki-trash fs-6"></i>
                                                        </a>
                                                        <!--end::Delete-->
                                                        
                                                    </div>
                                                    <!--end::Toolbar-->
                                                    @endif
                                                    @if (Auth::user()->role == "Kader")
                                                    <!--begin::Toolbar-->
                                                    <div class="d-flex my-3 ms-9">
                                                        <!--begin::Edit-->
                                                        <a href="/kader/kunjungan/edit/{{$dakun->id}}" class="btn btn-light-primary btn-sm me-2">
                                                            <i class="ki-outline ki-pencil fs-6"></i> Edit
                                                        </a>
                                                        <!--end::Edit-->
                                                    </div>
                                                    <!--end::Toolbar-->
                                                    @endif
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Body-->
                                                <div id="kt_customer_view_payment_method_1" class="collapse show fs-6 ps-10" data-bs-parent="#kt_customer_view_payment_method_accordion">
                                                    <!--begin::Details-->
                                                    <div class="d-flex flex-wrap py-5">
                                                        <!--begin::Col-->
                                                        <div class="flex-equal me-5">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Tinggi Badan</td>
                                                                    <td class="text-gray-800">{{$dakun->tinggi_bdn ?? '-' }} cm</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Berat Badan</td>
                                                                    <td class="text-gray-800">{{$dakun->berat_bdn ?? '-' }} Kg</td>
                                                                </tr>
                                                               <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Lingkar Perut</td>
                                                                    <td class="text-gray-800">{{$dakun->lingkar_prt ?? '-' }} cm</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Diastole</td>
                                                                    <td class="text-gray-800">{{$dakun->diastole ?? '-' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Sistole</td>
                                                                    <td class="text-gray-800">{{$dakun->sistole ?? '-' }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="flex-equal">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Gula Darah</td>
                                                                    <td class="text-gray-800">
                                                                        <a href="#" class="text-gray-900 text-hover-primary">{{$dakun->gula_drh ?? '-'}}</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Kolesterol</td>
                                                                    <td class="text-gray-800">
                                                                        <a href="#" class="text-gray-900 text-hover-primary">{{$dakun->kolesterol ?? '-'}}</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Asam Urat</td>
                                                                    <td class="text-gray-800">{{$dakun->asam_urat ?? '-'}}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Details-->
                                                    <div class="separator separator-dashed"></div>
                                                    <div class="d-flex flex-wrap py-5">
                                                         <!--begin::Col-->
                                                         <div class="flex-equal me-5">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Merokok</td>
                                                                    @if ($dakrin->ginjal == "Y")
                                                                        <td class="text-gray-800">Iya</td>
                                                                    @else
                                                                        <td class="text-gray-800">Tidak</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Ginjal</td>
                                                                    @if ($dakrin->ginjal == "Y")
                                                                        <td class="text-gray-800">Iya</td>
                                                                    @else
                                                                        <td class="text-gray-800">Tidak</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">ADL</td>
                                                                    @if ($dakrin->adl == "A")
                                                                        <td class="text-gray-800">Mandiri (A)</td>
                                                                    @elseif($dakrin->adl == "B")
                                                                        <td class="text-gray-800">Ketergantungan (B)</td>
                                                                    @else
                                                                        <td class="text-gray-800">Ketergantungan (C)</td>
                                                                    @endif
                                                                </tr>
                                                                 <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Depresi</td>
                                                                    <td class="text-gray-800">{{$dakrin->gds}}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="flex-equal">
                                                            <table class="table table-flush fw-semibold gy-1">
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Kognitif</td>
                                                                    <td class="text-gray-800">
                                                                        @if ($dakrin->kognitif == "Y")
                                                                            Iya
                                                                        @else
                                                                            Tidak
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Mobilisasi</td>
                                                                    <td class="text-gray-800">
                                                                        @if ($dakrin->mobilisasi == "Y")
                                                                            Iya
                                                                        @else
                                                                            Tidak
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Malnutrisi</td>
                                                                    <td class="text-gray-800">
                                                                        @if ($dakrin->malnutrisi == "Y")
                                                                            Iya
                                                                        @else
                                                                            Tidak
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Penglihatan</td>
                                                                    @if ($dakrin->penglihatan == "Y")
                                                                        <td class="text-gray-800">Iya</td>
                                                                    @else
                                                                        <td class="text-gray-800">Tidak</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Pendengaran</td>
                                                                    @if ($dakrin->pendengaran == "Y")
                                                                        <td class="text-gray-800">Iya</td>
                                                                    @else
                                                                        <td class="text-gray-800">Tidak</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted min-w-125px w-125px">Depresi</td>
                                                                    @if ($dakrin->depresi == "Y")
                                                                        <td class="text-gray-800">Iya</td>
                                                                    @else
                                                                        <td class="text-gray-800">Tidak</td>
                                                                    @endif
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <div class="separator separator-dashed"></div>
                                                    <div class="d-flex flex-wrap py-5">
                                                        <!--begin::Col-->
                                                        <div class="flex-equal me-5">
                                                           <table class="table table-flush fw-semibold gy-1">
                                                               <tr>
                                                                   <td class="text-muted min-w-125px w-125px">Rekomendasi</td>
                                                                   <td>
                                                                       @if ($riwkin_rekomendasi[$riw->id] == "Silakan Rujuk ke Pustu atau Puskesmas terdekat")
                                                                           <span class="badge badge-danger badge-lg">{{ $riwkin_rekomendasi[$riw->id] }}</span>
                                                                       @else
                                                                           <span class="badge badge-primary badge-lg">{{ $riwkin_rekomendasi[$riw->id] }}</span>
                                                                       @endif
                                                                   </td>
                                                               </tr>
                                                           </table>
                                                       </div>
                                                        <div class="flex-equal me-5">
                                                           <table class="table table-flush fw-semibold gy-1">
                                                               <tr>
                                                                   <td class="text-muted min-w-125px w-125px">Alasan </td>
                                                                   <td>
                                                                       @if ($dakun->keterangan)
                                                                           <span class="badge badge-info badge-lg">{{ $dakun->keterangan }}</span>
                                                                       @else
                                                                           <span class="badge badge-info badge-lgx`">Tidak ada Alasan</span>
                                                                       @endif
                                                                   </td>
                                                               </tr>
                                                           </table>
                                                       </div>
                                                       <!--end::Col-->
                                                   </div>
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::Option-->
                                            @php $no = 2; @endphp
                                            @php $no1 = 2; @endphp
                                            @foreach ($riwkin_sliced as $riw)
                                                <div class="separator separator-dashed"></div>
                                                <!--begin::Option-->
                                                <div class="py-0" data-kt-customer-payment-method="row">
                                                    <!--begin::Header-->
                                                    <div class="py-3 d-flex flex-stack flex-wrap">
                                                        <!--begin::Toggle-->
                                                        <div class="accordion-header d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#kt_customer_view_payment_method_{{$no++}}" role="button" aria-expanded="false" aria-controls="kt_customer_view_payment_method_2">
                                                            <!--begin::Arrow-->
                                                            <div class="accordion-icon me-2">
                                                                <i class="ki-outline ki-right fs-4"></i>
                                                            </div>
                                                            <!--end::Arrow-->
                                                            <!--begin::Logo-->
                                                            <img src="{{ asset('template/assets/media/svg/files/upload.svg')}}" class="w-40px me-3" alt="" />
                                                            <!--end::Logo-->
                                                            <!--begin::Summary-->
                                                            <div class="me-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="text-gray-800 fw-bold">Riwayat Skrining #{{$riw->id}}</div>
                                                                </div>
                                                                <div class="text-muted">{{ \Illuminate\Support\Carbon::parse($riw->tanggal_kj)->translatedFormat('d F Y') }}</div>
                                                            </div>
                                                            <!--end::Summary-->
                                                        </div>
                                                        <!--end::Toggle-->
                                                        @if (Auth::user()->role == "System Administrator")
                                                            <!--begin::Toolbar-->
                                                            <div class="d-flex my-3 ms-9">
                                                                <!--begin::Edit-->
                                                                <a href="/admin/kunjungan/edit/{{$riw->id}}" class="btn btn-icon btn-light-primary w-30px h-30px me-3" >
                                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
                                                                        <i class="ki-outline ki-pencil fs-3"></i>
                                                                    </span>
                                                                </a>
                                                                <!--end::Edit-->
                                                                <!--begin::Delete-->
                                                                <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Delete" data-kt-customer-payment-method="delete">
                                                                    <i class="ki-outline ki-trash fs-3"></i>
                                                                </a>
                                                                <!--end::Delete-->
                                                                
                                                            </div>
                                                            <!--end::Toolbar-->
                                                        @endif
                                                    </div>
                                                    <!--end::Header-->
                                                    <!--begin::Body-->
                                                    <div id="kt_customer_view_payment_method_{{$no1++}}" class="collapse fs-6 ps-10" data-bs-parent="#kt_customer_view_payment_method_accordion">
                                                        <!--begin::Details-->
                                                        <div class="d-flex flex-wrap py-5">
                                                            <!--begin::Col-->
                                                            <div class="flex-equal me-5">
                                                                <table class="table table-flush fw-semibold gy-1">
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Tinggi Badan</td>
                                                                        <td class="text-gray-800">{{$riw->tinggi_bdn}} cm</td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Lingkar Perut</td>
                                                                        <td class="text-gray-800">{{$riw->lingkar_prt}} cm</td>
                                                                    </tr>
                                                                   
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Diastole</td>
                                                                        <td class="text-gray-800">{{$riw->diastole}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Asam Urat</td>
                                                                        <td class="text-gray-800">{{$riw->asam_urat}}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <!--end::Col-->
                                                            <!--begin::Col-->
                                                            <div class="flex-equal">
                                                                <table class="table table-flush fw-semibold gy-1">
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Berat Badan</td>
                                                                        <td class="text-gray-800">{{$riw->berat_bdn}} Kg</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Sistole</td>
                                                                        <td class="text-gray-800">{{$riw->sistole}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Gula Darah</td>
                                                                        <td class="text-gray-800">
                                                                            <a href="#" class="text-gray-900 text-hover-primary">{{$riw->gula_drh}}</a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Details-->
                                                        <div class="separator separator-dashed"></div>
                                                            <div class="d-flex flex-wrap py-5">
                                                                <!--begin::Col-->
                                                                <div class="flex-equal me-5">
                                                                    <table class="table table-flush fw-semibold gy-1">
                                                                        <tr>
                                                                            <td class="text-muted min-w-125px w-125px">Ginjal</td>
                                                                            @if ($riw->ginjal == "Y")
                                                                                <td class="text-gray-800">Iya</td>
                                                                            @else
                                                                                <td class="text-gray-800">Tidak</td>
                                                                            @endif
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td class="text-muted min-w-125px w-125px">Penglihatan</td>
                                                                            @if ($riw->penglihatan == "Y")
                                                                                <td class="text-gray-800">Iya</td>
                                                                            @else
                                                                                <td class="text-gray-800">Tidak</td>
                                                                            @endif
                                                                        </tr>
                                                                    
                                                                        <tr>
                                                                            <td class="text-muted min-w-125px w-125px">Pendengaran</td>
                                                                            @if ($riw->pendengaran == "Y")
                                                                                <td class="text-gray-800">Iya</td>
                                                                            @else
                                                                                <td class="text-gray-800">Tidak</td>
                                                                            @endif
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="text-muted min-w-125px w-125px">Merokok</td>
                                                                            @if ($riw->ginjal == "Y")
                                                                                <td class="text-gray-800">Iya</td>
                                                                            @else
                                                                                <td class="text-gray-800">Tidak</td>
                                                                            @endif
                                                                        </tr>
                                                                        
                                                                    </table>
                                                                </div>
                                                                <!--end::Col-->
                                                                <!--begin::Col-->
                                                                <div class="flex-equal">
                                                                    <table class="table table-flush fw-semibold gy-1">
                                                                        <tr>
                                                                            <td class="text-muted min-w-125px w-125px">ADL</td>
                                                                            @if ($riw->adl == "A")
                                                                                <td class="text-gray-800">Mandiri (A)</td>
                                                                            @elseif($riw->adl == "B")
                                                                                <td class="text-gray-800">Ketergantungan (B)</td>
                                                                            @else
                                                                                <td class="text-gray-800">Ketergantungan (C)</td>
                                                                            @endif
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text-muted min-w-125px w-125px">GDS</td>
                                                                            <td class="text-gray-800">{{$riw->gds}}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <!--end::Col-->
                                                            </div>
                                                        <div class="separator separator-dashed"></div>
                                                            <div class="d-flex flex-wrap py-5">
                                                                <!--begin::Col-->
                                                                <div class="flex-equal me-5">
                                                                <table class="table table-flush fw-semibold gy-1">
                                                                    <tr>
                                                                        <td class="text-muted min-w-125px w-125px">Rekomendasi</td>
                                                                        <td><span class="badge badge-info badge-lg">{{ $riwkin_rekomendasi[$riw->id] }}</span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <!--end::Col-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Option-->
                                            @endforeach
                                           
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                        </div>
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Content-->
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
    <script src="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script>
        "use strict";
        // Class definition
        var KTCustomerViewPaymentTable = function () {

            // Define shared variables
            var datatable;
            var table = document.querySelector('#kt_table_customers_payment');

            // Private functions
            var initCustomerView = function () {
                // Set date data order
                const tableRows = table.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const dateRow = row.querySelectorAll('td');
                    const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                    dateRow[3].setAttribute('data-order', realDate);
                });

                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    "info": false,
                    'order': [],
                    "pageLength": 4,
                    "lengthChange": false,
                    'columnDefs': [
                        { orderable: false, targets: 3 }, // Disable ordering on column 5 (actions)
                    ]
                });
            }

            // Delete customer
            var deleteRows = () => {
                // Select all delete buttons
                const deleteButtons = table.querySelectorAll('[data-kt-customer-table-filter="delete_row"]');
                
                deleteButtons.forEach(d => {
                    // Delete button on click
                    d.addEventListener('click', function (e) {
                        e.preventDefault();

                        // Select parent row
                        const parent = e.target.closest('tr');

                        // Get customer name
                        const invoiceNumber = parent.querySelectorAll('td')[0].innerText;

                        // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Yakin menghapus data " + invoiceNumber + "?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Iya, Hapus!",
                            cancelButtonText: "Tidak, Batalkan",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                Swal.fire({
                                    text: "Kamu menghapus data  " + invoiceNumber + "!.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Baik !",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    // Remove current row
                                    datatable.row($(parent)).remove().draw();
                                }).then(function () {
                                    // Detect checked checkboxes
                                    toggleToolbars();
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: customerName + " Tidak terhapus !.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Baik !",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    })
                });
            }

            // Public methods
            return {
                init: function () {
                    if (!table) {
                        return;
                    }

                    initCustomerView();
                    deleteRows();
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTCustomerViewPaymentTable.init();
        });
    </script>
    
    <script src="{{ asset('template/assets/js/widgets.bundle.js')}}"></script>
    <script src="{{ asset('template/assets/js/custom/widgets.js')}}"></script>
    
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

    <!--begin::Riwayat Javascript-->
    <script>
        "use strict";

        // Class definition
        var KTCustomerViewPaymentMethod = function () {

            // Private functions
            var initPaymentMethod = function () {
                // Define variables
                const table = document.getElementById('kt_customer_view_payment_method');
                const tableRows = table.querySelectorAll('[ data-kt-customer-payment-method="row"]');

                tableRows.forEach(row => {
                    // Select delete button
                    const deleteButton = row.querySelector('[data-kt-customer-payment-method="delete"]');

                    // Delete button action
                    deleteButton.addEventListener('click', e => {
                        e.preventDefault();

                        // Popup confirmation
                        Swal.fire({
                            text: "Yakin menghapus Data Skrining?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Iya, Hapus !!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                row.remove();
                                modal.hide(); // Hide modal				
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Data Skrining tidak Terhapus!.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Baik !",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }
                        });
                    });
                });
            }

            // Handle set as primary button
            const handlePrimaryButton = () => {
                // Define variable
                const button = document.querySelector('[data-kt-payment-mehtod-action="set_as_primary"]');

                button.addEventListener('click', e => {
                    e.preventDefault();

                    // Popup confirmation
                    Swal.fire({
                        text: "Are you sure you would like to set this card as primary?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, set it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            Swal.fire({
                                text: "Your card was set to primary!.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Baik !",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                }
                            });
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: "Your card was not set to primary!.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Baik !",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                }
                            });
                        }
                    });
                });
            };

            // Public methods
            return {
                init: function () {
                    initPaymentMethod();
                    handlePrimaryButton();
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTCustomerViewPaymentMethod.init();
        });
    </script>
    <!--end::Riwayat Javascript-->

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