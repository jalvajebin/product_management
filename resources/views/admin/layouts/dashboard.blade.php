<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/admin/media/custom/logos/favicon.svg') }}" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" rel="stylesheet">
    <link href="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/style.bundle.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body class="app-default" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true">
<div class="d-flex flex-column flex-root app-root">
    <div class="app-page flex-column flex-column-fluid">
        <div class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}" data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}" data-kt-sticky-animation="false">
            <div class="app-container container-fluid d-flex align-items-stretch justify-content-between">
                <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
                    <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                        <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                    <a class="d-lg-none" href="{{ route('admin.dashboard.index') }}">
                        <img class="h-35px" src="{{ asset('assets/admin/media/custom/logos/logo-light.svg') }}" alt="">
                    </a>
                </div>
                <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                    <div class="app-header-menu app-header-mobile-drawer align-items-stretch">
                    </div>
                    <div class="app-navbar flex-shrink-0">
                        <div class="app-navbar-item ms-1 ms-md-4">
                            <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                <img class="rounded-3" src="{{ asset('assets/admin/media/svg/avatars/blank.svg') }}" alt="">
                            </div>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">
                                        <div class="symbol symbol-50px me-5">
                                            <img src="{{ asset('assets/admin/media/svg/avatars/blank.svg') }}" alt="">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fw-bold d-flex align-items-center fs-5">
                                                {{ request()->user()->name }}
                                            </div>
                                            <a class="fw-semibold text-muted fs-7">{{ request()->user()->email }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator my-2"></div>
                                <div class="menu-item px-5">
                                    <form method="POST" action="{{ route('admin.logout.store') }}">
                                        @csrf
                                        <a class="menu-link px-5" id="a-logout">Logout</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-wrapper flex-column flex-row-fluid">
            <div class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
                <div class="app-sidebar-logo px-6 d-flex align-items-center justify-content-center">
                    <a href="{{ route('admin.dashboard.index') }}">
                        {{--                        <img class="h-35px app-sidebar-logo-default" src="{{ asset('assets/admin/media/custom/logos/logo-dark.svg') }}" alt="">--}}
                        <h6 style="color: white">PRODUCT MANAGEMENT</h6>
                    </a>
                </div>
                <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
                    <div class="app-sidebar-wrapper">
                        <div class="scroll-y my-5 pb-10 mx-3" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
                            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" data-kt-menu="true" data-kt-menu-expand="false">
                                <div class="menu-item">
                                    <a class="menu-link @if(request()->routeIs('admin.dashboard.*')) active @endif" href="{{ route('admin.dashboard.index') }}"><span class="menu-icon"><i class="ki-solid ki-rocket fs-2"></i></span><span class="menu-title">Dashboard</span></a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link @if(request()->routeIs('admin.products.*')) active @endif" href="{{ route('admin.products.index') }}"><span class="menu-icon"><i class="ki-solid ki-handcart fs-2"></i></span><span class="menu-title">Products</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $(function () {
        $('#a-logout').click(function (e) {
            e.preventDefault();
            $(this).closest('form').submit();
        });

        @if (session()->has('success'))
        Swal.fire({
            text: '{{ session()->get('success') }}',
            icon: 'success',
            showConfirmButton: false,
            timer: 1000,
        });
        @endif

        @if (session()->has('error'))
        Swal.fire({
            text: '{{ session()->get('error') }}',
            icon: 'error',
            showConfirmButton: false,
            timer: 1000,
        });
        @endif
    });
</script>
@stack('js')
</body>
</html>
