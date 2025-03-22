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
            <!--begin::Row-->
            <!--begin::Row-->
            <div class="row g-12 g-xl-10">
                <!--begin::Col-->
                <div class="col-md-3 col-xl-3 mb-xxl-10">
                    <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                        <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                            <div class="mb-4 px-9">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{$jumlah_penduduk}}</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Total Penduduk</span>
                            </div>
                            <div id="kt_card_widget_8_chart" class="min-h-auto" style="height: 125px"></div>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-3 col-xl-3 mb-xxl-10">
                    <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                        <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                            <div class="mb-4 px-9">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{$jumlah_kunjungan}}</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Total Kunjungan</span>
                            </div>
                            <div id="kt_card_widget_9_chart" class="min-h-auto" style="height: 125px"></div>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-3 col-xl-3 mb-xxl-10">
                    <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                        <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                            <div class="mb-4 px-9">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{$jumlah_puskesmas}}</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Jumlah Puskesmas</span>
                            </div>
                            <div id="kt_card_widget_9_chart" class="min-h-auto" style="height: 125px"></div>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-3 col-xl-3 mb-xxl-10">
                    <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                        <div class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                            <div class="mb-4 px-9">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{$jumlah_kelurahan}}</span>
                                </div>
                                <span class="fs-6 fw-semibold text-gray-500">Jumlah Kelurahan</span>
                            </div>
                            <div id="kt_card_widget_9_chart" class="min-h-auto" style="height: 125px"></div>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
@endsection

@section('plugins-last')

@endsection
