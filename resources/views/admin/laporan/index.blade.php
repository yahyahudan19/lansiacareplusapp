@extends('components.layout')

@section('title')
    Laporan Puskesmas
@endsection

@section('plugins-head')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('template/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<!--begin::Page loading(append to body)-->
<div class="page-loader flex-column" id="pageLoader" style="display: none;">
    <span class="spinner-border text-primary" role="status"></span>
    <span class="text-muted fs-6 fw-semibold mt-5">Loading...</span>
</div>
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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">Customer Orders Report</h1>
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
                        <li class="breadcrumb-item text-muted">Apps</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">eCommerce</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Reports</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="#" class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">Add Member</a>
                    <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">New Campaign</a>
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
            <!--begin::Products-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                            <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Report" />
                        </div>
                        <!--end::Search-->
                        <!--begin::Export buttons-->
                        <div id="kt_ecommerce_report_customer_orders_export" class="d-none"></div>
                        <!--end::Export buttons-->
                    </div>
                    <!--end::Card title==

<!==begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <!--begin::Daterangepicker-->
                        <input class="form-control form-control-solid w-100 mw-250px" placeholder="Pick date range" id="kt_ecommerce_report_customer_orders_daterangepicker" />
                        <!--end::Daterangepicker-->
                        <!--begin::Filter-->
                        <div class="w-150px">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
                                <option></option>
                                <option value="all">All</option>
                                <option value="active">Active</option>
                                <option value="locked">Locked</option>
                                <option value="disabled">Disabled</option>
                                <option value="banned">Banned</option>
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--end::Filter-->
                        <!--begin::Export dropdown-->
                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-outline ki-exit-up fs-2"></i>Export Report</button>
                        <!--begin::Menu-->
                        <div id="kt_ecommerce_report_customer_orders_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="copy">Copy to clipboard</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="excel">Export as Excel</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="csv">Export as CSV</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-export="pdf">Export as PDF</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--end::Export dropdown-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_report_customer_orders_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-100px">Customer Name</th>
                                <th class="min-w-100px">Email</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-100px">Date Joined</th>
                                <th class="text-end min-w-75px">No. Orders</th>
                                <th class="text-end min-w-75px">No. Products</th>
                                <th class="text-end min-w-100px">Total</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Emma Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">smith@kpmg.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-danger">Banned</div>
                                </td>
                                <td>22 Sep 2024, 5:20 pm</td>
                                <td class="text-end pe-0">83</td>
                                <td class="text-end pe-0">98</td>
                                <td class="text-end">$354.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Melody Macy</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">melody@altbox.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>25 Oct 2024, 5:30 pm</td>
                                <td class="text-end pe-0">92</td>
                                <td class="text-end pe-0">105</td>
                                <td class="text-end">$3673.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Max Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">max@kt.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-info">Disabled</div>
                                </td>
                                <td>25 Oct 2024, 5:30 pm</td>
                                <td class="text-end pe-0">73</td>
                                <td class="text-end pe-0">85</td>
                                <td class="text-end">$4588.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Sean Bean</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">sean@dellito.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>19 Aug 2024, 5:20 pm</td>
                                <td class="text-end pe-0">82</td>
                                <td class="text-end pe-0">96</td>
                                <td class="text-end">$2987.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Brian Cox</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">brian@exchange.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>25 Jul 2024, 6:43 am</td>
                                <td class="text-end pe-0">17</td>
                                <td class="text-end pe-0">29</td>
                                <td class="text-end">$2803.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Mikaela Collins</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">mik@pex.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>10 Nov 2024, 8:43 pm</td>
                                <td class="text-end pe-0">70</td>
                                <td class="text-end pe-0">79</td>
                                <td class="text-end">$3101.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Francis Mitcham</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">f.mit@kpmg.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>20 Jun 2024, 11:30 am</td>
                                <td class="text-end pe-0">24</td>
                                <td class="text-end pe-0">39</td>
                                <td class="text-end">$699.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Olivia Wild</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">olivia@corpmail.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>20 Dec 2024, 2:40 pm</td>
                                <td class="text-end pe-0">93</td>
                                <td class="text-end pe-0">98</td>
                                <td class="text-end">$252.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Neil Owen</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">owen.neil@gmail.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>22 Sep 2024, 5:20 pm</td>
                                <td class="text-end pe-0">36</td>
                                <td class="text-end pe-0">45</td>
                                <td class="text-end">$545.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Dan Wilson</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">dam@consilting.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>21 Feb 2024, 6:05 pm</td>
                                <td class="text-end pe-0">100</td>
                                <td class="text-end pe-0">109</td>
                                <td class="text-end">$1722.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Emma Bold</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">emma@intenso.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>25 Jul 2024, 11:05 am</td>
                                <td class="text-end pe-0">89</td>
                                <td class="text-end pe-0">102</td>
                                <td class="text-end">$3337.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Ana Crown</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">ana.cf@limtel.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>20 Dec 2024, 5:20 pm</td>
                                <td class="text-end pe-0">46</td>
                                <td class="text-end pe-0">60</td>
                                <td class="text-end">$3828.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Robert Doe</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">robert@benko.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>05 May 2024, 10:10 pm</td>
                                <td class="text-end pe-0">79</td>
                                <td class="text-end pe-0">87</td>
                                <td class="text-end">$2346.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">John Miller</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">miller@mapple.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>05 May 2024, 9:23 pm</td>
                                <td class="text-end pe-0">43</td>
                                <td class="text-end pe-0">50</td>
                                <td class="text-end">$1411.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Lucy Kunic</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">lucy.m@fentech.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>21 Feb 2024, 11:30 am</td>
                                <td class="text-end pe-0">56</td>
                                <td class="text-end pe-0">64</td>
                                <td class="text-end">$223.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Ethan Wilder</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">ethan@loop.com.au</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>25 Jul 2024, 11:05 am</td>
                                <td class="text-end pe-0">70</td>
                                <td class="text-end pe-0">81</td>
                                <td class="text-end">$2670.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Sean Bean</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">sean@dellito.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>22 Sep 2024, 11:05 am</td>
                                <td class="text-end pe-0">86</td>
                                <td class="text-end pe-0">91</td>
                                <td class="text-end">$369.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Emma Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">smith@kpmg.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>19 Aug 2024, 6:05 pm</td>
                                <td class="text-end pe-0">40</td>
                                <td class="text-end pe-0">47</td>
                                <td class="text-end">$3057.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Melody Macy</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">melody@altbox.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-info">Disabled</div>
                                </td>
                                <td>21 Feb 2024, 8:43 pm</td>
                                <td class="text-end pe-0">38</td>
                                <td class="text-end pe-0">51</td>
                                <td class="text-end">$4545.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Max Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">max@kt.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>19 Aug 2024, 6:43 am</td>
                                <td class="text-end pe-0">65</td>
                                <td class="text-end pe-0">78</td>
                                <td class="text-end">$962.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Sean Bean</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">sean@dellito.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>20 Dec 2024, 10:30 am</td>
                                <td class="text-end pe-0">5</td>
                                <td class="text-end pe-0">17</td>
                                <td class="text-end">$2987.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Brian Cox</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">brian@exchange.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>20 Dec 2024, 9:23 pm</td>
                                <td class="text-end pe-0">46</td>
                                <td class="text-end pe-0">58</td>
                                <td class="text-end">$3016.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Mikaela Collins</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">mik@pex.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>19 Aug 2024, 11:30 am</td>
                                <td class="text-end pe-0">59</td>
                                <td class="text-end pe-0">64</td>
                                <td class="text-end">$4238.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Francis Mitcham</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">f.mit@kpmg.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>22 Sep 2024, 2:40 pm</td>
                                <td class="text-end pe-0">74</td>
                                <td class="text-end pe-0">86</td>
                                <td class="text-end">$1600.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Olivia Wild</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">olivia@corpmail.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-info">Disabled</div>
                                </td>
                                <td>15 Apr 2024, 6:43 am</td>
                                <td class="text-end pe-0">84</td>
                                <td class="text-end pe-0">89</td>
                                <td class="text-end">$506.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Neil Owen</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">owen.neil@gmail.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>21 Feb 2024, 5:30 pm</td>
                                <td class="text-end pe-0">32</td>
                                <td class="text-end pe-0">39</td>
                                <td class="text-end">$3184.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Dan Wilson</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">dam@consilting.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>20 Dec 2024, 5:30 pm</td>
                                <td class="text-end pe-0">17</td>
                                <td class="text-end pe-0">23</td>
                                <td class="text-end">$3570.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Emma Bold</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">emma@intenso.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-danger">Banned</div>
                                </td>
                                <td>21 Feb 2024, 10:30 am</td>
                                <td class="text-end pe-0">83</td>
                                <td class="text-end pe-0">94</td>
                                <td class="text-end">$4631.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Ana Crown</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">ana.cf@limtel.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>25 Oct 2024, 9:23 pm</td>
                                <td class="text-end pe-0">78</td>
                                <td class="text-end pe-0">83</td>
                                <td class="text-end">$4609.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Robert Doe</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">robert@benko.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-info">Disabled</div>
                                </td>
                                <td>21 Feb 2024, 10:30 am</td>
                                <td class="text-end pe-0">43</td>
                                <td class="text-end pe-0">52</td>
                                <td class="text-end">$3786.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">John Miller</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">miller@mapple.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>20 Dec 2024, 5:20 pm</td>
                                <td class="text-end pe-0">36</td>
                                <td class="text-end pe-0">51</td>
                                <td class="text-end">$3585.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Lucy Kunic</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">lucy.m@fentech.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>15 Apr 2024, 8:43 pm</td>
                                <td class="text-end pe-0">100</td>
                                <td class="text-end pe-0">109</td>
                                <td class="text-end">$4212.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Ethan Wilder</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">ethan@loop.com.au</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>15 Apr 2024, 11:30 am</td>
                                <td class="text-end pe-0">24</td>
                                <td class="text-end pe-0">32</td>
                                <td class="text-end">$3881.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Emma Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">smith@kpmg.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>15 Apr 2024, 5:30 pm</td>
                                <td class="text-end pe-0">68</td>
                                <td class="text-end pe-0">74</td>
                                <td class="text-end">$3227.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Emma Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">smith@kpmg.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>25 Jul 2024, 10:10 pm</td>
                                <td class="text-end pe-0">79</td>
                                <td class="text-end pe-0">86</td>
                                <td class="text-end">$1375.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Melody Macy</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">melody@altbox.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>25 Jul 2024, 6:43 am</td>
                                <td class="text-end pe-0">38</td>
                                <td class="text-end pe-0">50</td>
                                <td class="text-end">$4952.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Max Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">max@kt.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>24 Jun 2024, 8:43 pm</td>
                                <td class="text-end pe-0">55</td>
                                <td class="text-end pe-0">66</td>
                                <td class="text-end">$2298.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Sean Bean</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">sean@dellito.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>05 May 2024, 5:20 pm</td>
                                <td class="text-end pe-0">54</td>
                                <td class="text-end pe-0">62</td>
                                <td class="text-end">$2340.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Brian Cox</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">brian@exchange.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-danger">Banned</div>
                                </td>
                                <td>10 Mar 2024, 11:05 am</td>
                                <td class="text-end pe-0">74</td>
                                <td class="text-end pe-0">82</td>
                                <td class="text-end">$3284.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Mikaela Collins</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">mik@pex.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>20 Jun 2024, 10:10 pm</td>
                                <td class="text-end pe-0">16</td>
                                <td class="text-end pe-0">23</td>
                                <td class="text-end">$3066.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Francis Mitcham</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">f.mit@kpmg.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-danger">Banned</div>
                                </td>
                                <td>21 Feb 2024, 10:30 am</td>
                                <td class="text-end pe-0">26</td>
                                <td class="text-end pe-0">38</td>
                                <td class="text-end">$791.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Olivia Wild</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">olivia@corpmail.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>10 Mar 2024, 11:30 am</td>
                                <td class="text-end pe-0">76</td>
                                <td class="text-end pe-0">90</td>
                                <td class="text-end">$3984.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Neil Owen</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">owen.neil@gmail.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>22 Sep 2024, 6:43 am</td>
                                <td class="text-end pe-0">4</td>
                                <td class="text-end pe-0">16</td>
                                <td class="text-end">$4301.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Dan Wilson</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">dam@consilting.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>25 Jul 2024, 10:10 pm</td>
                                <td class="text-end pe-0">70</td>
                                <td class="text-end pe-0">77</td>
                                <td class="text-end">$2507.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Emma Bold</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">emma@intenso.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-warning">Locked</div>
                                </td>
                                <td>20 Dec 2024, 10:10 pm</td>
                                <td class="text-end pe-0">21</td>
                                <td class="text-end pe-0">26</td>
                                <td class="text-end">$4242.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Ana Crown</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">ana.cf@limtel.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-warning">Locked</div>
                                </td>
                                <td>19 Aug 2024, 2:40 pm</td>
                                <td class="text-end pe-0">60</td>
                                <td class="text-end pe-0">66</td>
                                <td class="text-end">$4573.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Robert Doe</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">robert@benko.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-danger">Banned</div>
                                </td>
                                <td>05 May 2024, 5:20 pm</td>
                                <td class="text-end pe-0">39</td>
                                <td class="text-end pe-0">52</td>
                                <td class="text-end">$2563.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">John Miller</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">miller@mapple.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>19 Aug 2024, 11:30 am</td>
                                <td class="text-end pe-0">27</td>
                                <td class="text-end pe-0">38</td>
                                <td class="text-end">$4735.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Lucy Kunic</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">lucy.m@fentech.com</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>24 Jun 2024, 2:40 pm</td>
                                <td class="text-end pe-0">95</td>
                                <td class="text-end pe-0">103</td>
                                <td class="text-end">$2085.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="apps/ecommerce/customers/details.html" class="text-gray-900 text-hover-primary">Ethan Wilder</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-900 text-hover-primary">ethan@loop.com.au</a>
                                </td>
                                <td>
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td>10 Mar 2024, 6:05 pm</td>
                                <td class="text-end pe-0">27</td>
                                <td class="text-end pe-0">37</td>
                                <td class="text-end">$1056.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Products-->
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
    <!--begin::Vendors Javascript(used for this page only)-->
    
	<!--begin::Custom Javascript(used for this page only)-->
	<script src="{{ asset('template/assets/js/custom/apps/ecommerce/reports/customer-orders/customer-orders.js')}}"></script>
	<script src="{{ asset('template/assets/js/widgets.bundle.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/widgets.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/apps/chat/chat.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
	<script src="{{ asset('template/assets/js/custom/utilities/modals/users-search.js')}}"></script>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->
    <!--end::Vendors Javascript-->
    
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

    <!--begin:: Page Loader Javascript-->
    <script>
        // Toggle
        const button = document.querySelector("#kt_page_loading_message");

        // Handle toggle click event
        button.addEventListener("click", function() {
            // Populate the page loading element dynamically.
            // Optionally you can skipt this part and place the HTML
            // code in the body element by refer to the above HTML code tab.
            const loadingEl = document.createElement("div");
            document.body.prepend(loadingEl);
            loadingEl.classList.add("page-loader");
            loadingEl.classList.add("flex-column");
            loadingEl.innerHTML = `
                <span class="spinner-border text-primary" role="status"></span>
                <span class="text-muted fs-6 fw-semibold mt-5">Sedang Mencari Data...</span>
            `;

            // Show page loading
            KTApp.showPageLoading();

            // Hide after 3 seconds
            setTimeout(function() {
                KTApp.hidePageLoading();
                loadingEl.remove();
            }, 10000);
        });
    </script>
    <!--end:: Page Loader Javascript-->


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