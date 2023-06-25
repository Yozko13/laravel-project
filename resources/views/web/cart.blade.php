@extends('web.index')
@section('web-content')
    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="cart-title mt-50">
                        <h2>{{ __('Cart') }}</h2>
                    </div>
                    <div class="cart-table clearfix">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Color') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->products as $product)
                                    <tr>
                                        <td class="cart_product_img">
                                            <a href="{{ route('product', $product->product->slug) }}" title="{{ $product->name }}">
                                                <img src="{{ $product->product->getImageUrl() }}" alt="{{ $product->name }}"
                                                    title="{{ $product->name }} - {{ __('Image') }}"
                                                />
                                            </a>
                                        </td>
                                        <td class="cart_product_desc">
                                            <h5>{{ $product->name }}</h5>
                                        </td>
                                        <td class="price">
                                            <span>{{ $product->price }}лв.</span>
                                        </td>
                                        <td class="price">
                                            <span style="color: {{ $product->color->color }};">{{ $product->color->name }}</span>
                                        </td>
                                        <td class="qty">1</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>{{ __('Total') }}</h5>
                        <ul class="summary-table">
                            <li><span>{{ __('Subtotal') }}:</span> <span>{{ $cart->sum_price }}лв.</span></li>
                            <li><span>{{ __('Delivery') }}:</span> <span>{{ __('Free') }}</span></li>
                            <li><span>{{ __('Total') }}:</span> <span>{{ $cart->sum_price }}лв.</span></li>
                        </ul>
                        <div class="cart-btn mt-100">
                            <a href="cart.html" class="btn amado-btn w-100">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
