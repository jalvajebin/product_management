@extends('web.layouts.app')
@section('title', 'Products')
@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1>Portfolio Details</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current"><a href="{{ route('products.index') }}"> Products</a></li>
                        <li class="current"><a href="{{ route('cart.index') }}"> Cart</a></li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Portfolio Details Section -->
        <section id="portfolio-details" class="portfolio-details section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <!-- Product Images Section -->
                    <div class="col-lg-8">
                        <div class="portfolio-details-slider swiper init-swiper">

                            <script type="application/json" class="swiper-config">
                                {
                                  "loop": true,
                                  "speed": 600,
                                  "autoplay": {
                                    "delay": 5000
                                  },
                                  "slidesPerView": "auto",
                                  "pagination": {
                                    "el": ".swiper-pagination",
                                    "type": "bullets",
                                    "clickable": true
                                  }
                                }
                            </script>

                            <div class="swiper-wrapper align-items-center">
                                @foreach($product->variants as $variant)
                                    <div class="swiper-slide">
                                        <input id="updatedPrice" name="updatedPrice" type="hidden" value="{{ $product->special_price }}">
                                        <img src="{{ asset('storage/products/images/' . $product->image_name) }}" alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <!-- Product Information Section -->
                    <div class="col-lg-4">
                        <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                            <h3>Product Information</h3>
                            <ul>
                                <li><strong>Name</strong>: {{ $product->name }}</li>
                                <li><strong>Code</strong>: {{ $product->code }}</li>
                                <li>
                                    <input id="updatedPrice" name="updatedPrice" type="hidden" value="{{ $product->special_price }}">
                                    <strong>Price:</strong>
                                    <span style="text-decoration: line-through; color: gray;" id="originalPrice">{{ $product->price }}</span>
                                    <strong style="margin-left: 10px; color: red;" id="displayedPrice">{{ $product->special_price }}</strong>
                                </li>
                                <li>
                                    <strong>Availability:</strong>
                                    @if($product->stock > 0)
                                        <span class="text-success">In Stock</span>
                                    @else
                                        <span class="text-danger">Out of Stock</span>
                                    @endif
                                </li>
                                <li>
                                    <strong>Sizes:</strong>
                                    @foreach($product->variants->unique('size') as $variant)
                                        <span class="badge bg-primary">{{ $variant->size }}</span>
                                    @endforeach
                                </li>
                                <li>
                                    <strong>Colors:</strong>
                                    @foreach($product->variants->unique('color') as $variant)
                                        <span class="badge bg-secondary" style="background-color: {{ $variant->color_code }};">{{ $variant->color }}</span>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <!-- Add to Cart Section -->
                        <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                            <h2>Add to Cart</h2>
                            <form method="POST" class="me-3 w-100" action="{{ route('cart-items.store') }}">
                                @csrf
                                <input id="productId" name="productId" type="hidden" value="{{ $product->id }}">
                                <input id="type" name="type" type="hidden" value="INCREASE">
                                <input id="location" name="location" type="hidden" value="PRODUCT">
                                <!-- Select Size -->
                                <div class="mb-3">
                                    <label for="size" class="form-label"><strong>Select Size</strong></label>
                                    <select class="form-select" name="size" id="size" required>
                                        <option value="" disabled selected>Select size</option>
                                        @foreach($product->variants->unique('size') as $variant)
                                            <option value="{{ $variant->size }}">{{ $variant->size }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Select Color -->
                                <div class="mb-3">
                                    <label for="color" class="form-label"><strong>Select Color</strong></label>
                                    <select class="form-select" name="color" id="color" required>
                                        <option value="" disabled selected>Select color</option>
                                        @foreach($product->variants->unique('color') as $variant)
                                            <option value="{{ $variant->color }}">{{ $variant->color }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Add to Cart Button -->
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-cart"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </section>

    </main>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sizeSelect = document.getElementById('size');
            const colorSelect = document.getElementById('color');
            const displayedPriceElem = document.getElementById('displayedPrice');
            const updatedPriceElem = document.getElementById('updatedPrice');
            const originalPriceElem = document.getElementById('originalPrice');

            // Sending variant data to JavaScript
            const variantData = @json($product->variants); // All variants with their respective prices

            function updatePrice() {
                const selectedSize = sizeSelect.value;
                const selectedColor = colorSelect.value;

                // Find the matching variant based on size and color
                const matchingVariant = variantData.find(variant =>
                    variant.size === selectedSize && variant.color === selectedColor
                );

                if (matchingVariant) {
                    // Update the displayed price with variant's price and special price
                    const newPrice = matchingVariant.price;
                    const newSpecialPrice = matchingVariant.special_price;

                    displayedPriceElem.innerText = newSpecialPrice ? newSpecialPrice : newPrice;
                    updatedPriceElem.value = newSpecialPrice ? newSpecialPrice : newPrice;
                    originalPriceElem.innerText = newPrice;
                } else {
                    // If no matching variant is found, set default values
                    displayedPriceElem.innerText = "{{ $product->special_price }}"; // Default special price
                    updatedPriceElem.value = "{{ $product->special_price }}";
                    originalPriceElem.innerText = "{{ $product->price }}"; // Default price
                }
            }

            // Add event listeners to update the price when size or color is changed
            sizeSelect.addEventListener('change', updatePrice);
            colorSelect.addEventListener('change', updatePrice);
        });
    </script>
@endpush



