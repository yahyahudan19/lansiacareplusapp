<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-header d-flex flex-stack d-none d-lg-flex pt-8 pb-2" id="kt_app_sidebar_header">
        <!--begin::Logo-->
        <a href="#" class="app-sidebar-logo">
            <img alt="Logo" src="{{ asset('template/assets/media/logos/logo-base.svg')}}" class="h-35px d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
            <img alt="Logo" src="{{ asset('template/assets/media/logos/logo-dark.svg')}}" class="h-20px h-lg-35px theme-dark-show" />
        </a>
        <!--end::Logo-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-sm btn-icon bg-light btn-color-gray-700 btn-active-color-primary d-none d-lg-flex rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-outline ki-text-align-right rotate-180 fs-1"></i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--begin::Navs-->
    <div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
        <div id="kt_app_sidebar_navs_wrappers" class="app-sidebar-wrapper hover-scroll-y my-2" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_header" data-kt-scroll-wrappers="#kt_app_sidebar_navs" data-kt-scroll-offset="5px">
            
            <!--begin::Sidebar menu for System Administrators -->
            @if (auth()->user()->role == 'System Administrator')
                <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
                    <!--begin::Heading-->
                    <div class="menu-item mb-2">
                        <div class="menu-heading text-uppercase fs-7 fw-bold">Aplikasi</div>
                        <!--begin::Separator-->
                        <div class="app-sidebar-separator separator"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Heading-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-home-2 fs-2"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/dashboard" class="menu-link {{ Request::is('dashboard') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Umum</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            {{-- <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/dashboard/puskesmas" class="menu-link {{ Request::is('dashboard/puskesmas') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Puskesmas</span>
                                </a>
                                <!--end:Menu link-->
                            </div> --}}
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item here {{ Request::is('admin/penduduk*') || Request::is('penduduk*') ? 'show' : '' }} accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Penduduk</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/admin/penduduk" class="menu-link {{ Request::is('admin/penduduk') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Semua</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/admin/penduduk/lansia" class="menu-link {{ Request::is('admin/penduduk/lansia*') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Lansia</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/admin/penduduk/pra-lansia" class="menu-link {{ Request::is('admin/penduduk/pra-lansia*') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pra-Lansia</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        {{-- <a href="/admin/penduduk" class="menu-link {{ Request::is('admin/penduduk*') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Penduduk</span>
                        </a> --}}
                        <a href="/admin/kunjungan" class="menu-link {{ Request::is('admin/kunjungan*') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-safe-home fs-2"></i>
                            </span>
                            <span class="menu-title">Kunjungan</span>
                        </a>
                     
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ Request::is('admin/laporan/*') ? 'here show' : '' }} accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-note-2 fs-2"></i>
                            </span>
                            <span class="menu-title">Laporan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/admin/laporan/agregat" class="menu-link {{ Request::is('admin/laporan/agregat*') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Agregat</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/admin/laporan/puskesmas" class="menu-link {{ Request::is('admin/laporan/puskesmas*') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Puskesmas</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <br>
                    <!--end:Menu item-->

                    <!--begin::Heading-->
                    <div class="menu-item mb-2">
                        <div class="menu-heading text-uppercase fs-7 fw-bold">Manajemen</div>
                        <!--begin::Separator-->
                        <div class="app-sidebar-separator separator"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Heading-->
                    <div class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <a href="/admin/users" class="menu-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-security-user fs-2"></i>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                        <a href="/admin/puskesmas" class="menu-link {{ Request::is('admin/puskesmas*') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-home-1 fs-2"></i>
                            </span>
                            <span class="menu-title">Puskesmas</span>
                        </a>
                        <a href="/admin/whatsapp" class="menu-link {{ Request::is('admin/whatsapp*') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-whatsapp fs-2"></i>
                            </span>
                            <span class="menu-title">Whatsapp</span>
                        </a>
                        {{-- <a href="#" class="menu-link {{ Request::is('admin/log*') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-questionnaire-tablet fs-2"></i>
                            </span>
                            <span class="menu-title">Log</span>
                        </a> --}}
                        <!--end:Menu link-->
                    </div>
                </div>
            @endif
            <!--end::Sidebar menu-->

            <!--begin::Sidebar menu for Dinkes Users------------>
            @if (auth()->user()->role == 'Dinkes')
                <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
                    <!--begin::Heading-->
                    <div class="menu-item mb-2">
                        <div class="menu-heading text-uppercase fs-7 fw-bold">Aplikasi</div>
                        <!--begin::Separator-->
                        <div class="app-sidebar-separator separator"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Heading-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-home-2 fs-2"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/dinkes/dashboard" class="menu-link {{ Request::is('dinkes/dashboard') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Umum</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            {{-- <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/puskesmas/dashboard" class="menu-link {{ Request::is('puskesmas/dashboard') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Puskesmas</span>
                                </a>
                                <!--end:Menu link-->
                            </div> --}}
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item here {{ Request::is('dinkes/penduduk*') || Request::is('penduduk*') ? 'show' : '' }} accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Penduduk</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/dinkes/penduduk" class="menu-link {{ Request::is('dinkes/penduduk') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Semua</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/dinkes/penduduk/lansia" class="menu-link {{ Request::is('dinkes/penduduk/lansia*') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Lansia</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/dinkes/penduduk/pra-lansia" class="menu-link {{ Request::is('dinkes/penduduk/pra-lansia*') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pra-Lansia</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        {{-- <a href="/dinkes/penduduk" class="menu-link {{ Request::is('dinkes/penduduk') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Penduduk</span>
                        </a> --}}
                        <a href="/dinkes/kunjungan" class="menu-link {{ Request::is('dinkes/kunjungan*') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-safe-home fs-2"></i>
                            </span>
                            <span class="menu-title">Kunjungan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ Request::is('dinkes/laporan/*') ? 'here show' : '' }} accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-note-2 fs-2"></i>
                            </span>
                            <span class="menu-title">Laporan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/dinkes/laporan/agregat" class="menu-link {{ Request::is('dinkes/laporan/agregat') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Agregat</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/dinkes/laporan/puskesmas" class="menu-link {{ Request::is('dinkes/laporan/puskesmas') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Puskesmas</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <br>
                    <!--end:Menu item-->
                    <!--begin::Heading-->
                    <div class="menu-item mb-2">
                        <div class="menu-heading text-uppercase fs-7 fw-bold">Manajemen</div>
                        <!--begin::Separator-->
                        <div class="app-sidebar-separator separator"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Heading-->
                    <div class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <a href="/dinkes/puskesmas" class="menu-link {{ Request::is('dinkes/puskesmas') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-home-1 fs-2"></i>
                            </span>
                            <span class="menu-title">Puskesmas</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                </div>
            @endif
            <!--end::Sidebar menu-->

            <!--begin::Sidebar menu for Puskesmas Users -------->
            @if (auth()->user()->role == 'Puskesmas')
                <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
                    <!--begin::Heading-->
                    <div class="menu-item mb-2">
                        <div class="menu-heading text-uppercase fs-7 fw-bold">Aplikasi</div>
                        <!--begin::Separator-->
                        <div class="app-sidebar-separator separator"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Heading-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-home-2 fs-2"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/puskesmas/dashboard" class="menu-link {{ Request::is('puskesmas/dashboard') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Umum</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item here {{ Request::is('puskesmas/penduduk*') || Request::is('penduduk*') ? 'show' : '' }} accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Penduduk</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/puskesmas/penduduk" class="menu-link {{ Request::is('puskesmas/penduduk') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Semua</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/puskesmas/penduduk/lansia" class="menu-link {{ Request::is('puskesmas/penduduk/lansia*') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Lansia</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/puskesmas/penduduk/pra-lansia" class="menu-link {{ Request::is('puskesmas/penduduk/pra-lansia*') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pra-Lansia</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <a href="/puskesmas/kunjungan" class="menu-link {{ Request::is('puskesmas/kunjungan*') || Request::is('kunjungan*') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-safe-home fs-2"></i>
                            </span>
                            <span class="menu-title">Kunjungan</span>
                        </a>
                       
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item {{ Request::is('puskesmas/laporan*') ? 'here show' : '' }} accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-note-2 fs-2"></i>
                            </span>
                            <span class="menu-title">Laporan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/puskesmas/laporan"  class="menu-link {{ Request::is('puskesmas/laporan*') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Puskesmas</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <br>
                    <!--end:Menu item-->
                    <!--begin::Heading-->
                    <div class="menu-item mb-2">
                        <div class="menu-heading text-uppercase fs-7 fw-bold">Manajemen</div>
                        <!--begin::Separator-->
                        <div class="app-sidebar-separator separator"></div>
                        <!--end::Separator-->
                    </div>
                    <!--end::Heading-->
                    <div class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <a href="/puskesmas/users" class="menu-link {{ Request::is('puskesmas/users') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-security-user fs-2"></i>
                            </span>
                            <span class="menu-title">User</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                </div>
            @endif
            <!--end::Sidebar menu-->

            <!--begin::Sidebar menu for Kader Users ------------->
            @if (auth()->user()->role == 'Kader')
                <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
                    <!--begin::Heading-->
                    <div class="menu-item mb-2">
                        {{-- <div class="menu-heading text-uppercase fs-7 fw-bold">Aplikasi</div> --}}
                        <!--begin::Separator-->
                        {{-- <div class="app-sidebar-separator separator"></div> --}}
                        <!--end::Separator-->
                    </div>
                    <!--end::Heading-->
                    <!--begin:Menu item-->
                    {{-- <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-home-2 fs-2"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/kader/dashboard" class="menu-link {{ Request::is('kader/dashboard') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Umum</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div> --}}
                      <!--begin:Menu item-->
                      <div class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        {{-- <a href="/kader/penduduk" class="menu-link {{ Request::is('kader/penduduk') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Penduduk</span>
                        </a> --}}
                        <a href="/kader/kunjungan" class="menu-link {{ Request::is('kader/kunjungan*') || Request::is('kunjungan*') ? 'active' : '' }}">
                            <span class="menu-icon">
                                <i class="ki-outline ki-safe-home fs-2"></i>
                            </span>
                            <span class="menu-title">Kunjungan</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <div data-kt-menu-trigger="click" class="menu-item here {{ Request::is('kader/penduduk*') || Request::is('penduduk*') ? 'show' : '' }} accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-people fs-2"></i>
                            </span>
                            <span class="menu-title">Penduduk</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/kader/penduduk" class="menu-link {{ Request::is('kader/penduduk') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Semua</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/kader/penduduk/lansia" class="menu-link {{ Request::is('kader/penduduk/lansia*') ? 'active' : '' }}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Lansia</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a href="/kader/penduduk/pra-lansia" class="menu-link {{ Request::is('kader/penduduk/pra-lansia*') ? 'active' : '' }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Pra-Lansia</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                  
                </div>
            @endif
            <!--end::Sidebar menu-->
        </div>
    </div>
    <!--end::Navs-->
    
</div>