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
            <div class="row g-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-6 mb-md-5 mb-xl-10">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            <!--begin::Card widget 8-->
                            <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                <!--begin::Card body-->
                                <div
                                    class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                    <!--begin::Statistics-->
                                    <div class="mb-4 px-9">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Currency-->
                                            <span
                                                class="fs-4 fw-semibold text-gray-500 align-self-start me-1&gt;">#</span>
                                            <!--end::Currency-->
                                            <!--begin::Value-->
                                            <span
                                                class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{$jumlah_penduduk}}</span>
                                            <!--end::Value-->
                                           
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Description-->
                                        <span class="fs-6 fw-semibold text-gray-500">Total Penduduk</span>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Statistics-->
                                    <!--begin::Chart-->
                                    <div id="kt_card_widget_8_chart" class="min-h-auto"
                                        style="height: 125px"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 8-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            <!--begin::Card widget 9-->
                            <div class="card overflow-hidden h-md-50 mb-5 mb-xl-10">
                                <!--begin::Card body-->
                                <div
                                    class="card-body d-flex justify-content-between flex-column px-0 pb-0">
                                    <!--begin::Statistics-->
                                    <div class="mb-4 px-9">
                                        <!--begin::Statistics-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Value-->
                                            <span
                                                class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{$jumlah_kunjungan}}</span>
                                            <!--end::Value-->
                                           
                                        </div>
                                        <!--end::Statistics-->
                                        <!--begin::Description-->
                                        <span class="fs-6 fw-semibold text-gray-500">Total Kunjungan</span>
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Statistics-->
                                    <!--begin::Chart-->
                                    <div id="kt_card_widget_9_chart" class="min-h-auto"
                                        style="height: 125px"></div>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 9-->
                            
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
               
            </div>
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
