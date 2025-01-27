@extends('admin.layouts.dashboard')
@section('title', 'Products')
@section('content')
    <div class="app-main flex-column flex-row-fluid">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="app-toolbar py-3 py-lg-6">
                <div class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Products
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                Products
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-content flex-column-fluid">
                <div class="app-container container-xxl">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span class="path2"></span></i>
                                    <input class="form-control form-control-solid w-250px ps-12" id="text-search" type="text" placeholder="Search">
                                </div>
                            </div>
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
                                    Create
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $html->table(['id' => 'table']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form-update" method="POST">
        @csrf
        @method('PUT')
        <input name="is_active" type="hidden">
    </form>
    <form id="form-delete" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
@push('css')
    <style>
        #table thead {
            font-weight: bold;
        }
    </style>
@endpush
@push('js')
    {{ $html->scripts() }}
    <script>
        $(function () {

            const table = $('#table');

            table.on('preXhr.dt', function (e, settings, data) {
                data.filter = {
                    search: $('#text-search').val(),
                };
            });

            $('#text-search').keyup(function () {
                table.DataTable().draw();
            });

            table.on('change', '.checkbox-is-active', function (e) {
                e.preventDefault();

                const url = $(this).data('url');
                const formUpdate = $('#form-update');

                Swal.fire({
                    html: 'Are you sure you want to change the status?',
                    icon: 'info',
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: 'Change',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-secondary',
                    },
                }).then((response) => {
                    if (response.isConfirmed) {
                        formUpdate.attr('action', url);
                        formUpdate.submit();
                    }
                });
            });

            table.on('click', '.a-delete', function (e) {
                e.preventDefault();

                const href = $(this).attr('href');
                const formDelete = $('#form-delete');

                Swal.fire({
                    html: 'Are you sure you want to delete?',
                    icon: 'info',
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-secondary',
                    },
                }).then((response) => {
                    if (response.isConfirmed) {
                        formDelete.attr('action', href);
                        formDelete.submit();
                    }
                });
            });
        });
    </script>
@endpush
