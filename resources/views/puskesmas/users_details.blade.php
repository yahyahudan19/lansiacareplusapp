@extends('components.layout')

@section('title')
    User Detail
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">View User Details</h1>
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
                            <li class="breadcrumb-item text-muted">User Management</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Details</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
					<div class="d-flex align-items-center gap-2 gap-lg-3">
						<a href="/puskesmas/users" class="btn btn-primary">
							<i class="ki-duotone ki-left-square fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
							Kembali
						</a>
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
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Summary-->
                                <!--begin::User Info-->
                                <div class="d-flex flex-center flex-column py-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <img src="{{ asset('template/assets/media/avatars/300-1.jpg')}}" alt="image" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{$data_user->name}}</a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="mb-9">
                                        <!--begin::Badge-->
                                        <div class="badge badge-lg badge-light-primary d-inline">{{$data_user->role}}</div>
                                        <!--begin::Badge-->
                                    </div>
                                    <!--end::Position-->
                                    <!--begin::Info-->
                                    {{-- <!--begin::Info heading-->
                                    <div class="fw-bold mb-3">Assigned Tickets 
										<span class="ms-2" ddata-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Number of support tickets assigned, closed and pending this week.">
											<i class="ki-outline ki-information fs-7"></i>
										</span>
									</div>
                                    <!--end::Info heading-->
                                    <div class="d-flex flex-wrap flex-center">
                                        <!--begin::Stats-->
                                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                            <div class="fs-4 fw-bold text-gray-700">
                                                <span class="w-75px">243</span>
                                                <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                            </div>
                                            <div class="fw-semibold text-muted">Total</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                            <div class="fs-4 fw-bold text-gray-700">
                                                <span class="w-50px">56</span>
                                                <i class="ki-outline ki-arrow-down fs-3 text-danger"></i>
                                            </div>
                                            <div class="fw-semibold text-muted">Solved</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                            <div class="fs-4 fw-bold text-gray-700">
                                                <span class="w-50px">188</span>
                                                <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                            </div>
                                            <div class="fw-semibold text-muted">Open</div>
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Info--> --}}
                                </div>
                                <!--end::User Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details 
                                    <span class="ms-2 rotate-180">
                                        <i class="ki-outline ki-down fs-3"></i>
                                    </span></div>
                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit user details">
                                        <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_details">Edit</a>
                                    </span>
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_user_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Username</div>
                                        <div class="text-gray-600">{{$data_user->username}}</div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Email</div>
                                        <div class="text-gray-600">
                                            <a href="#" class="text-gray-600 text-hover-primary">{{$data_user->email}}</a>
                                        </div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Alamat Dinas</div>
                                        <div class="text-gray-600">{{$data_user->puskesmas->alamat}}</div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Puskesmas / Dinas</div>
                                        <div class="text-gray-600">{{$data_user->puskesmas->nama}}</div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">Created at :</div>
                                        <div class="text-gray-600">{{ \Illuminate\Support\Carbon::parse($data_user->created_at)->translatedFormat('d F Y') }}</div>
                                        <!--begin::Details item-->
                                    </div>
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
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_user_view_overview_security" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Profile</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5">
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                                <tbody class="fs-6 fw-semibold text-gray-600">
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>{{$data_user->email}}</td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_email">
                                                                <i class="ki-outline ki-pencil fs-3"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Password</td>
                                                        <td>******</td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
                                                                <i class="ki-outline ki-pencil fs-3"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Role</td>
                                                        <td>{{$data_user->role}}</td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                                                <i class="ki-outline ki-pencil fs-3"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->
                                    <div class="card-header border-0">
                                        <!--begin::Card title-->
                                        <div class="card-title flex-column">
                                            <h2 class="mb-1">Two Step Authentication</h2>
                                            <div class="fs-6 fw-semibold text-muted">Keep your account extra secure with a second authentication step.</div>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Add-->
                                            <button type="button" class="btn btn-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-outline ki-fingerprint-scanning fs-3"></i>Add Authentication Step</button>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-6 w-200px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_auth_app">Use authenticator app</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">Enable one-time password</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                            <!--end::Add-->
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pb-5">
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Content-->
                                            <div class="d-flex flex-column">
                                                <span>SMS</span>
                                                <span class="text-muted fs-6">+62 123 456 789</span>
                                            </div>
                                            <!--end::Content-->
                                            <!--begin::Action-->
                                            <div class="d-flex justify-content-end align-items-center">
                                                <!--begin::Button-->
                                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto me-5" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">
                                                    <i class="ki-outline ki-pencil fs-3"></i>
                                                </button>
                                                <!--end::Button-->
                                                <!--begin::Button-->
                                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" id="kt_users_delete_two_step">
                                                    <i class="ki-outline ki-trash fs-3"></i>
                                                </button>
                                                <!--end::Button-->
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin:Separator-->
                                        <div class="separator separator-dashed my-5"></div>
                                        <!--end:Separator-->
                                        <!--begin::Disclaimer-->
                                        <div class="text-gray-600">If you lose your mobile device or security key, you can 
                                        <a href='#' class="me-1">generate a backup code</a>to sign in to your account.</div>
                                        <!--end::Disclaimer-->
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

                <!--begin::Modals-->

                <!--begin::Modal - Update user details-->
                <div class="modal fade" id="kt_modal_update_details" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form" action="/admin/update/profile" id="kt_modal_update_user_form" method="POST">
								@csrf
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_update_user_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Update User Details</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                        <i class="ki-outline ki-cross fs-1"></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body py-10 px-lg-17">
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_user_header" data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">
                                        <!--begin::User toggle-->
                                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_update_user_user_info" role="button" aria-expanded="false" aria-controls="kt_modal_update_user_user_info">User Information 
                                        <span class="ms-2 rotate-180">
                                            <i class="ki-outline ki-down fs-3"></i>
                                        </span></div>
                                        <!--end::User toggle-->
										<input type="hidden" name="id" value="{{ $data_user->id }}">
                                        <!--begin::User form-->
                                        <div id="kt_modal_update_user_user_info" class="collapse show">
                                           
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Name</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="name" value="{{$data_user->name}}" required/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">
                                                    <span>Username</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="username must be active">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="username" value="{{$data_user->username}}" required/>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            
                                        </div>
                                        <!--end::User form-->

                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Modal body-->
                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait... 
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
                <!--end::Modal - Update user details-->

                <!--begin::Modal - Update email-->
                <div class="modal fade" id="kt_modal_update_email" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Update Email Address</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                    <i class="ki-outline ki-cross fs-1"></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_update_email_form" class="form" action="/admin/update/email" method="POST">
									@csrf
                                    <!--begin::Notice-->
									<input type="hidden" name="id" value="{{ $data_user->id }}">
                                    <!--begin::Notice-->
                                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                        <!--begin::Icon-->
                                        <i class="ki-outline ki-information fs-2tx text-primary me-4"></i>
                                        <!--end::Icon-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1">
                                            <!--begin::Content-->
                                            <div class="fw-semibold">
                                                <div class="fs-6 text-gray-700">Please note that a valid email address is required to complete the email verification.</div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->
                                    <!--end::Notice-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Email Address</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid" placeholder="" name="email" value="{{$data_user->email}}" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
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
                <!--end::Modal - Update email-->

                <!--begin::Modal - Update password-->
                <div class="modal fade" id="kt_modal_update_password" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Update Password</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                    <i class="ki-outline ki-cross fs-1"></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_update_password_form" class="form" action="/admin/update/password" method="POST">
									@csrf
									<input type="hidden" name="id" value="{{ $data_user->id }}">
                                    <!--begin::Input group=-->
                                    <div class="fv-row mb-10">
                                        <label class="required form-label fs-6 mb-2">Current Password</label>
                                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="current_password" autocomplete="off" />
                                    </div>
                                    <!--end::Input group=-->
                                    <!--begin::Input group-->
                                    <div class="mb-10 fv-row" data-kt-password-meter="true">
                                        <!--begin::Wrapper-->
                                        <div class="mb-1">
                                            <!--begin::Label-->
                                            <label class="form-label fw-semibold fs-6 mb-2">New Password</label>
                                            <!--end::Label-->
                                            <!--begin::Input wrapper-->
                                            <div class="position-relative mb-3">
                                                <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="new_password" autocomplete="off" />
                                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                    <i class="ki-outline ki-eye-slash fs-1"></i>
                                                    <i class="ki-outline ki-eye d-none fs-1"></i>
                                                </span>
                                            </div>
                                            <!--end::Input wrapper-->
                                            <!--begin::Meter-->
                                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                            </div>
                                            <!--end::Meter-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Hint-->
                                        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Input group=-->
                                    <!--begin::Input group=-->
                                    <div class="fv-row mb-10">
                                        <label class="form-label fw-semibold fs-6 mb-2">Confirm New Password</label>
                                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm_password" autocomplete="off" />
                                    </div>
                                    <!--end::Input group=-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
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
                <!--end::Modal - Update password-->

                <!--begin::Modal - Update role-->
                <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Update User Role</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                    <i class="ki-outline ki-cross fs-1"></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <!--begin::Form-->
                                <form id="kt_modal_update_role_form" class="form" action="/admin/update/role" method="POST">
									@csrf
                                    <!--begin::Notice-->
									<input type="hidden" name="id" value="{{ $data_user->id }}">
                                    <!--begin::Notice-->
                                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                        <!--begin::Icon-->
                                        <i class="ki-outline ki-information fs-2tx text-primary me-4"></i>
                                        <!--end::Icon-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1">
                                            <!--begin::Content-->
                                            <div class="fw-semibold">
                                                <div class="fs-6 text-gray-700">Please note that reducing a user role rank, that user will lose all priviledges that was assigned to the previous role.</div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->
                                    <!--end::Notice-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-5">
                                            <span class="required">Select a user role</span>
                                        </label>
                                        <!--end::Label-->
                                        
                                        <!--begin::Input row-->
                                        <div class="d-flex">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="user_role" type="radio" value="Puskesmas" id="kt_modal_update_role_option_1" {{ $data_user->role == 'Puskesmas' ? 'checked' : '' }} />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                    <div class="fw-bold text-gray-800">Puskesmas</div>
                                                    <div class="text-gray-600">Karyawan atau Anggota Puskesmas</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Radio-->
                                        </div>
                                        <!--end::Input row-->
                                        <div class='separator separator-dashed my-5'></div>
                                        <!--begin::Input row-->
                                        <div class="d-flex">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="user_role" type="radio" value="Kader" id="kt_modal_update_role_option_2" {{ $data_user->role == 'Kader' ? 'checked' : '' }} />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label" for="kt_modal_update_role_option_2">
                                                    <div class="fw-bold text-gray-800">Kader</div>
                                                    <div class="text-gray-600">Anggota Kaderisasi dari Puskesmas</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Radio-->
                                        </div>
                                        <!--end::Input row-->
                                        
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
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
                <!--end::Modal - Update role-->
                <!--end::Modals-->
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
	{{-- <script src="{{ asset('template/assets/js/custom/apps/user-management/users/view/update-details.js')}}"></script> --}}
	{{-- <script src="{{ asset('template/assets/js/custom/apps/user-management/users/view/update-email.js')}}"></script> --}}
	{{-- <script src="{{ asset('template/assets/js/custom/apps/user-management/users/view/update-password.js')}}"></script> --}}
	{{-- <script src="{{ asset('template/assets/js/custom/apps/user-management/users/view/update-role.js')}}"></script> --}}
	<!--end::Custom Javascript-->
	
	<!--begin::Update Details-->
	<script>
		"use strict";

		// Class definition
		var KTUsersUpdateDetails = function () {
			// Shared variables
			const element = document.getElementById('kt_modal_update_details');
			const form = element.querySelector('#kt_modal_update_user_form');
			const modal = new bootstrap.Modal(element);

			// Init add schedule modal
			var initUpdateDetails = () => {

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
							modal.hide(); // Hide modal				
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
							modal.hide(); // Hide modal				
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

				// Submit button handler
				const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
				submitButton.addEventListener('click', function (e) {
					// Prevent default button action
					e.preventDefault();

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
				});
			}

			return {
				// Public functions
				init: function () {
					initUpdateDetails();
				}
			};
		}();

		// On document ready
		KTUtil.onDOMContentLoaded(function () {
			KTUsersUpdateDetails.init();
		});
	</script>
	<!--end::Update Email-->

	<!--begin::Update Email-->
	<script>
		"use strict";

		// Class definition
		var KTUsersUpdateEmail = function () {
			// Shared variables
			const element = document.getElementById('kt_modal_update_email');
			const form = element.querySelector('#kt_modal_update_email_form');
			const modal = new bootstrap.Modal(element);

			// Init add schedule modal
			var initUpdateEmail = () => {

				// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
				var validator = FormValidation.formValidation(
					form,
					{
						fields: {
							'profile_email': {
								validators: {
									notEmpty: {
										message: 'Email address is required'
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
							modal.hide(); // Hide modal				
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
							modal.hide(); // Hide modal				
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

				// Submit button handler
				const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
				submitButton.addEventListener('click', function (e) {
					// Prevent default button action
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
							}
						});
					}
				});
			}

			return {
				// Public functions
				init: function () {
					initUpdateEmail();
				}
			};
		}();

		// On document ready
		KTUtil.onDOMContentLoaded(function () {
			KTUsersUpdateEmail.init();
		});
	</script>
	<!--end::Update Email-->

	<!--begin::Update Password-->
	<script>
		"use strict";

		// Class definition
		var KTUsersUpdatePassword = function () {
			// Shared variables
			const element = document.getElementById('kt_modal_update_password');
			const form = element.querySelector('#kt_modal_update_password_form');
			const modal = new bootstrap.Modal(element);

			// Init add schedule modal
			var initUpdatePassword = () => {

				// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
				var validator = FormValidation.formValidation(
					form,
					{
						fields: {
							'current_password': {
								validators: {
									notEmpty: {
										message: 'Current password is required'
									}
								}
							},
							'new_password': {
								validators: {
									notEmpty: {
										message: 'The password is required'
									},
									stringLength: {
										min: 8,
										message: 'The password must be at least 8 characters long'
									},
									callback: {
										message: 'Please enter a valid password with letters, numbers, and symbols',
										callback: function (input) {
											// Regular expression to check for letters, numbers, and symbols
											var valid = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/.test(input.value);
											return valid;
										}
									}
								}
							},
							'confirm_password': {
								validators: {
									notEmpty: {
										message: 'The password confirmation is required'
									},
									identical: {
										compare: function () {
											return form.querySelector('[name="new_password"]').value;
										},
										message: 'The password and its confirm are not the same'
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
							modal.hide(); // Hide modal				
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
							modal.hide(); // Hide modal				
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

				// Submit button handler
				const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
				submitButton.addEventListener('click', function (e) {
					// Prevent default button action
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
									// Swal.fire({
									// 	text: "Form has been successfully submitted!",
									// 	icon: "success",
									// 	buttonsStyling: false,
									// 	confirmButtonText: "Ok, got it!",
									// 	customClass: {
									// 		confirmButton: "btn btn-primary"
									// 	}
									// }).then(function (result) {
									// 	if (result.isConfirmed) {
									// 		modal.hide();
									// 	}
									// });

									form.submit(); // Submit form
								}, 2000);
							}
						});
					}
				});
			}

			return {
				// Public functions
				init: function () {
					initUpdatePassword();
				}
			};
		}();

		// On document ready
		KTUtil.onDOMContentLoaded(function () {
			KTUsersUpdatePassword.init();
		});
	</script>
	<!--end::Update Password-->
	
	<!--begin::Update Role-->
	<script>
		"use strict";

		// Class definition
		var KTUsersUpdateRole = function () {
			// Shared variables
			const element = document.getElementById('kt_modal_update_role');
			const form = element.querySelector('#kt_modal_update_role_form');
			const modal = new bootstrap.Modal(element);

			// Init add schedule modal
			var initUpdateRole = () => {

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
							modal.hide(); // Hide modal				
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
							modal.hide(); // Hide modal				
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

				// Submit button handler
				const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
				submitButton.addEventListener('click', function (e) {
					// Prevent default button action
					e.preventDefault();

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
				});
			}

			return {
				// Public functions
				init: function () {
					initUpdateRole();
				}
			};
		}();

		// On document ready
		KTUtil.onDOMContentLoaded(function () {
			KTUsersUpdateRole.init();
		});
	</script>
	<!--end::Update Role-->


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