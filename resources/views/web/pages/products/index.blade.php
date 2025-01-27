@extends('web.layouts.app')
@section('title', 'Products')
@section('content')
  <main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <h1>Products</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current"><a href="{{ route('products.index') }}"> Products</a></li>
            <li class="current"><a href="{{ route('cart.index') }}"> Cart</a></li>

          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <div class="row align-items-center">
            <div class="col-lg-7 portfolio-info">
            </div>
            <div class="col-lg-5 text-center text-lg-end">
              <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">All</li>
                  <li data-filter=".filter-product"><a href="{{ route('products.index') }}">Products</a></li>
                <li data-filter=".filter-branding"><a href="{{ route('cart.index') }}">Cart</a></li>
              </ul><!-- End Portfolio Filters -->
            </div>
          </div>

            <div class="row gy-4">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <a href="{{ route('products.show', $product->handle) }}">
                                <img src="{{ asset("storage/products/images/$product->image_name") }}" class="card-img-top" alt="{{ $product->name }}">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{!! $product->description !!}</p>
                                <p class="card-text"><strong>Rs.{{ $product->price }}</strong></p>
                            </div>
                            <div class="card-footer text-end">
                                <a href="{{ asset("storage/products/images/$product->image_name") }}"
                                   title="{{ $product->name }}"
                                   class="glightbox preview-link"
                                   data-title="{{ $product->name }}"
                                   data-description="{!! $product->description !!} - Rs. {{ $product->price }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="{{ route('products.show', $product->handle) }}" title="More Details" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

      </div>

    </section><!-- /Portfolio Section -->

  </main>
@endsection

