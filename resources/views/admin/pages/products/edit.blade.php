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
                                <a href="{{ route('admin.products.index') }}" class="text-muted text-hover-primary">Products</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                Edit
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-content flex-column-fluid">
                <div class="app-container container-xxl">
                    <div class="card card-flush">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <div class="fv-row">
                                            <label class="form-label" for="name">Name</label>
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Name" value="{{ old('name', $product->name) }}" />
                                            @error('name')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <div class="fv-row">
                                            <label class="form-label" for="code">Code</label>
                                            <input class="form-control" id="code" name="code" type="text" placeholder="Code" value="{{ old('code', $product->code) }}" />
                                            @error('code')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <div class="fv-row">
                                            <label class="form-label" for="price">Price</label>
                                            <input class="form-control" id="price" name="price" type="text" placeholder="Price" value="{{ old('price', $product->price) }}" />
                                            @error('price')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <div class="fv-row">
                                            <label class="form-label" for="special_price">Special Price</label>
                                            <input class="form-control" id="special_price" name="special_price" type="text" placeholder="Special Price" value="{{ old('special_price', $product->special_price) }}" />
                                            @error('special_price')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <div class="fv-row">
                                            <label class="form-label" for="stock">Stock</label>
                                            <input class="form-control" id="stock" name="stock" type="text" placeholder="Stock" value="{{ old('stock', $product->stock) }}" />
                                            @error('stock')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <div class="fv-row">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="tox-target" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <div class="fv-row">
                                            <label class="form-label" for="image">Image</label>
                                            <input class="form-control" id="image" name="image" type="file">
                                            @error('image')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <div class="fv-row">
                                            <div class="image-input image-input-empty image-input-placeholder1" style="background-image: url({{ url("storage/products/images/$product->image_name") }});">
                                                <div class="image-input-wrapper w-150px h-150px"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <div class="fv-row">
                                            <label class="form-label" for="variants">Variants <span class="text-muted"></span></label>
                                            <div id="variants">
                                                <div class="d-flex flex-column gap-5 mb-5" data-repeater-list="variants">
                                                    @foreach($ProductVariants as $index => $productVariant)
                                                        <div class="form-group d-flex flex-wrap align-items-center gap-5" data-repeater-item>
                                                            <select class="form-select" name="variants[{{ $index }}][size]" data-hide-search="true" data-placeholder="Size">
                                                                <option></option>
                                                                <option value="XS" @if(old('variants.' . $index . '.size', $productVariant->size) == 'XS') selected @endif>XS</option>
                                                                <option value="M" @if(old('variants.' . $index . '.size', $productVariant->size) == 'M') selected @endif>M</option>
                                                                <option value="L" @if(old('variants.' . $index . '.size', $productVariant->size) == 'L') selected @endif>L</option>
                                                                <option value="XL" @if(old('variants.' . $index . '.size', $productVariant->size) == 'XL') selected @endif>XL</option>
                                                                <option value="XXL" @if(old('variants.' . $index . '.size', $productVariant->size) == 'XXL') selected @endif>XXL</option>
                                                            </select>
                                                            <div class="input-group">
                                                                <input class="form-control" name="variants[{{ $index }}][color]" type="text" placeholder="Color" value="{{ old('variants.' . $index . '.color', $productVariant->color) }}">
                                                                <button class="btn btn-icon btn-light-danger" type="button" data-repeater-delete><i class="ki-solid ki-cross fs-1"></i></button>
                                                            </div>

                                                            <input class="form-control" name="variants[{{ $index }}][price]" type="text" placeholder="Price" value="{{ old('variants.' . $index . '.price', $productVariant->price) }}">

                                                            <input class="form-control" name="variants[{{ $index }}][image]" type="file">


                                                            <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $productVariant->id }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-icon btn-light-success" type="button" data-repeater-create><i class="ki-solid ki-plus fs-1"></i></button>
                                                </div>
                                            </div>
                                            @error('variants.*.size')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            @error('variants.*.color')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            @error('variants.*.price')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            @error('variants.*.image')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($ProductVariants as $key => $productVariant)
                                        <div class="col-md-3 mb-4">
                                            <div class="image-input image-input-empty image-input-placeholder1" style="background-image: url({{ url("storage/products/images/$productVariant->image_name") }});">
                                                <div class="image-input-wrapper w-150px h-150px"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if(count($ProductVariants) <= 0)
                                    <div class="row">
                                        <div class="col-md-6 mb-5">
                                            <div class="fv-row">
                                                <label class="form-label" for="variants">Variants <span class="text-muted"></span></label>
                                                <div id="product_variants">
                                                    <div class="d-flex flex-column gap-5 mb-5" data-repeater-list="variants">
                                                        <div class="form-group d-flex flex-wrap align-items-center gap-5" data-repeater-item>
                                                            <select class="form-select" id="size" name="size"  data-hide-search="true" data-placeholder="Size">
                                                                <option></option>
                                                                <option value="XS" @if(old('variants.0.size') == 'XS') selected @endif>XS</option>
                                                                <option value="M" @if(old('variants.0.size') == 'M') selected @endif>M</option>
                                                                <option value="L" @if(old('variants.0.size') == 'L') selected @endif>L</option>
                                                                <option value="XL" @if(old('variants.0.size') == 'XL') selected @endif>XL</option>
                                                                <option value="XXL" @if(old('variants.0.size') == 'XXL') selected @endif>XXL</option>
                                                            </select>
                                                            <div class="input-group">
                                                                <input class="form-control" id="color" name="color" type="text" placeholder="Color" value="{{ old('variants.0.color') }}">
                                                                <button class="btn btn-icon btn-light-danger" type="button" data-repeater-delete><i class="ki-solid ki-cross fs-1"></i></button>
                                                            </div>
                                                            <input class="form-control" id="price" name="price]" type="text" placeholder="Price" value="{{ old('variants.0.price') }}">
                                                            <div class="input-group">
                                                                <input class="form-control" id="image" name="image" type="file">
                                                            </div>
                                                            <input name="id" type="hidden">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-icon btn-light-success" type="button" data-repeater-create><i class="ki-solid ki-plus fs-1"></i></button>
                                                    </div>
                                                </div>
                                                @error('variants.*.size')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @error('variants.*.color')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @error('variants.*.price')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                @error('variants.*.image')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary float-end">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function () {
            tinymce.init({
                selector: '#description',
                menubar: false,
                placeholder: 'Description',
            });
            $('#variants').repeater({
                initEmpty: false,
            });
            $('#product_variants').repeater({
                initEmpty: false,
            });
            // function initializeSelect2() {
            //     $('[data-control="select2"]').select2({
            //         placeholder: 'Select an option',
            //         minimumResultsForSearch: Infinity, // Hide search box
            //         width: '100%',
            //     });
            // }

            // Initialize select2 on page load
            // $(document).ready(function () {
            //     initializeSelect2();
            //
            //     // Reinitialize select2 after adding new fields
            //     $('[data-repeater-create]').on('click', function () {
            //         setTimeout(function () {
            //             initializeSelect2();
            //         }, 100);
            //     });
            // });
        });
    </script>
@endpush
