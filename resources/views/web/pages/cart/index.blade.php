@extends('web.layouts.app')
@section('title', 'Shopping Cart')
@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container">
                <h1>Shopping Cart</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current"><a href="{{ route('products.index') }}"> Products</a></li>
                        <li class="current"><a href="{{ route('cart.index') }}"> Cart</a></li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Cart Section -->
        <section id="cart" class="cart section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-4">

                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        <div class="cart-items">
                            @if(count($cartItems) > 0)
                                @foreach($cartItems as $item)
                                    <div class="cart-item border-bottom pb-4 mb-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <img src="{{ $item['productImage'] }}" alt="{{ $item['productName'] }}" class="img-fluid rounded">
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="mb-1">{{ $item['productName'] }}</h5>
                                                <p class="mb-1"><strong>Quantity:</strong>
                                                <form action="{{ route('cart-items.store') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="productId" value="{{ $item['productId'] }}">
                                                    <input type="hidden" name="type" value="DECREASE">
                                                    <button type="submit" class="btn btn-sm btn-secondary">-</button>
                                                </form>
                                                {{ $item['quantity'] }}
                                                <form action="{{ route('cart-items.store') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="productId" value="{{ $item['productId'] }}">
                                                    <input type="hidden" name="type" value="INCREASE">
                                                    <button type="submit" class="btn btn-sm btn-secondary">+</button>
                                                </form>
                                                </p>
                                                <p class="mb-1"><strong>Price:</strong> ₹{{ $item['productPrice'] }}</p>
                                                <p class="mb-1"><strong>Total:</strong> ₹{{ $item['productTotalPrice'] }}</p>
                                            </div>
                                            <div class="col-md-3 text-end">
                                                <form action="{{ route('cart.remove', $item['productId']) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">Your cart is empty.
                                    <a href="{{ url('/') }}" class="text-primary">Shop Now</a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-4">
                        <div class="cart-summary p-4 bg-light rounded shadow">
                            <h3 class="mb-4">Cart Summary</h3>
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between mb-3">
                                    <span><strong>Subtotal:</strong></span>
                                    <span>₹{{ $subTotal }}</span>
                                </li>
                                <li class="d-flex justify-content-between mb-3">
                                    <span><strong>Shipping Charge:</strong></span>
                                    <span>₹{{ $shippingCharge }}</span>
                                </li>
                                <li class="d-flex justify-content-between mb-3">
                                    <span><strong>Grand Total:</strong></span>
                                    <span><strong>₹{{ $grandTotal }}</strong></span>
                                </li>
                            </ul>
                            <a href="" class="btn btn-primary w-100">Proceed to Checkout</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
