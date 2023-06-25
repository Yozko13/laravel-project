@extends('web.index')
@section('web-content')
<!-- Product Details Area Start -->
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-50">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" title="{{ __('Home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('shop-around') }}" title="{{ __('Shop around') }}">{{ __('Shop around') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators overflow-hidden">
                            @foreach ($product->images as $key => $image)
                                <li {!! empty($key) ? 'class="active"' : '' !!} data-target="#product_details_slider"
                                    data-slide-to="{{ $key }}" style="background-image: url({{ $image->getImageUrl() }});"
                                ></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($product->images as $key => $image)
                                <div class="carousel-item {{ empty($key) ? 'active' : '' }}">
                                    <a class="gallery_img" href="{{ $image->getImageUrl() }}"
                                        title="{{ $product->name }} - {{ __('Image') }} {{ $title_counter++ }}"
                                    >
                                        <img class="d-block w-100" src="{{ $image->getImageUrl() }}"
                                            alt="{{ $product->name }} - {{ __('Image') }} {{ $title_counter++ }}"
                                            title="{{ $product->name }} - {{ __('Image') }} {{ $title_counter }}"
                                        />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="single_product_desc">
                    <!-- Product Meta Data -->
                    <div class="product-meta-data">
                        <div class="line"></div>
                        <p class="product-price">{{ $product->price }}лв.</p>
                        <a href="product-details.html">
                            <h6>{{ $product->name }}</h6>
                        </a>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="review">
                                <a href="#">Write A Review</a>
                            </div>
                        </div>
                        <!-- Avaiable -->
                        <p class="{{ $product->in_stock ? 'avaibility' : 'exhausted' }}">
                            <i class="fa fa-circle"></i> {{ __($product->in_stock ? 'In stock' : 'Exhausted') }}
                        </p>
                    </div>
                    <div class="short_overview my-5">
                        <p>{{ $product->description }}</p>
                    </div>
                    <!-- Add to Cart Form -->
                    @if ($product->in_stock)
                        <form class="cart clearfix" action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <div class="widget color">
                                <h6 class="widget-title mb-15">{{ __('Choose :option', ['option' => __('Color')]) }}:</h6>
                                <div class="widget-desc">
                                    <ul class="d-flex">
                                        @foreach ($product->colors as $key => $color)
                                            <li>
                                                <a href="javascript:void(0)" style="background-color: {{ $color->color }}">
                                                    <input type="radio" name="color" value="{{ $color->id }}"
                                                        {{ old('color') == $color->id || empty($key) ? 'checked' : '' }}
                                                    />
                                                </a>
                                            </li>
                                        @endforeach
                                        @error('color')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </ul>
                                </div>
                            </div>
                            <div class="cart-btn d-flex mb-50">
                                <p>{{ __('qty') }}</p>
                                <div class="quantity">
                                    <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;">
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </span>
                                    <input type="number" class="qty-text" id="qty" step="1" min="1" max="300"
                                        name="quantity" value="1"
                                    />
                                    <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;">
                                        <i class="fa fa-caret-up" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @error('quantity')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" name="addtocart" value="5" class="btn amado-btn">{{ __('Grab them') }}</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Details Area End -->
@endsection
