@extends('web.index')
@section('web-content')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" /> --}}
    <form class="shop_sidebar_area">
        <div class="widget mb-15">
            <h5>{{ __('Filters') }}</h5>
        </div>
        <!-- ##### Single Widget ##### -->
        <div class="widget catagory mb-15">
            <!-- Widget Title -->
            <h6 class="widget-title mb-15">{{ __('Categories') }}:</h6>
            <!--  Catagories  -->
            <div class="catagories-menu">
                <ul>
                    @foreach ($category_list as $category_id => $category_data)
                       <li class="active">
                            <label for="category-{{ $category_id }}">
                                <input type="checkbox" name="categories[]" value="{{ $category_id }}"
                                    id="category-{{ $category_id }}"
                                    {{ !empty(request('categories')) && in_array($category_id, request('categories')) ? 'checked' : '' }}
                                /> {{ $category_data['name'] }}
                            </label>
                       </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- ##### Single Widget ##### -->
        <div class="widget color mb-15">
            <!-- Widget Title -->
            <h6 class="widget-title mb-15">{{ __('Colors') }}:</h6>
            <div class="widget-desc">
                <ul class="d-flex">
                    @foreach ($colors as $color)
                        <li>
                            <a href="javascript:void(0)" style="background-color: {{ $color->color }}">
                                <input type="checkbox" name="colors[]" value="{{ $color->id }}"
                                    {{ !empty(request('colors')) && in_array($color->id, request('colors')) ? 'checked' : '' }}
                                />
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- ##### Single Widget ##### -->
        <div class="widget price mb-15">
            <!-- Widget Title -->
            <h6 class="widget-title mb-15">{{ __('Price') }}:</h6>
            <div class="widget-desc">
                <div class="slider-range">
                    <div data-min="10" data-max="1000" data-unit="лв." class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                        data-value-min="{{ request('price_from') ?? '10' }}"
                        data-value-max="{{ request('price_to') ?? '1000' }}"
                        data-label-result=""
                    >
                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    </div>
                    <div class="range-price">{{ request('price_from') ?? '10' }}ЛВ. - {{ request('price_to') ?? '1000' }}ЛВ.</div>
                    <input type="hidden" name="price_from" value="{{ request('price_from') ?? '' }}" />
                    <input type="hidden" name="price_to" value="{{ request('price_to') ?? '' }}"/>
                </div>
            </div>
        </div>
        <div class="widget price mb-15">
            <button type="submit" class="btn amado-btn mb-15">
                <img src="{{ asset('web/img/core-img/search.png') }}" alt="" /> {{ __('Search') }}
            </button>
        </div>
    </form>
    <div class="amado_product_area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                        <!-- Sorting -->
                        <div class="product-sorting d-flex">
                            <div class="sort-by-date d-flex align-items-center mr-15">
                                <p>{{ __('Sort by') }}</p>
                                <select onchange="window.location.href = '{{ url()->full() }}{{ $query_symbol }}order_price=' + this.value">
                                    <option value="">-- {{ __('Choose :option', ['option' => __('Price')]) }} --</option>
                                    <option value="ASC" {{ request('order_price') == 'ASC' ? 'selected' : '' }}>
                                        {{ __('Rising price') }}
                                    </option>
                                    <option value="DESC" {{ request('order_price') == 'DESC' ? 'selected' : '' }}>
                                        {{ __('Descending price') }}
                                    </option>
                                </select>
                            </div>
                            <div class="view-product d-flex align-items-center mr-15">
                                <p>{{ __('Show') }}</p>
                                <select onchange="window.location.href = '{{ url()->full() }}{{ $query_symbol }}paginate_count=' + this.value">
                                    <option value="12" {{ request('paginate_count') == 12 ? 'selected' : '' }}>12</option>
                                    <option value="24" {{ request('paginate_count') == 24 ? 'selected' : '' }}>24</option>
                                    <option value="48" {{ request('paginate_count') == 48 ? 'selected' : '' }}>48</option>
                                    <option value="96" {{ request('paginate_count') == 96 ? 'selected' : '' }}>96</option>
                                </select>
                            </div>
                            <!-- Total Products -->
                            <div class="d-flex align-items-center">
                                <div class="view d-flex">
                                    <a href="{{ route('shop-around') }}" title="{{ __('Clean up') }}"
                                        class="btn amado-btn active filter-btn"
                                    >{{ __('Clean up') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <!-- Single Product Area -->
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{ $product->getImageUrl() }}" alt="{{ $product->name }} - {{ __('Image') }} 1" />
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="{{ $product->getHoverImageUrl() }}"
                                    alt="{{ $product->name }} - {{ __('Image') }} 2"
                                />
                            </div>
                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">{{ $product->price }}лв.</p>
                                    <a href="{{ route('product', $product->slug) }}" title="{{ $product->name }}">
                                        <h6>{{ $product->name }}</h6>
                                    </a>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    @if ($product->in_stock)
                                        <div class="cart">
                                            <a href="{{ route('product', $product->slug) }}" data-toggle="tooltip"
                                                data-placement="left" title="{{ __('Add to Cart') }}"
                                            >
                                                <img src="{{ asset('web/img/core-img/cart.png') }}"
                                                    alt="{{ __('Cart') }}"
                                                    title="{{ $product->name }} - {{ __('Icon') }} {{ __('Cart') }} {{ $title_counter++ }}"
                                                />
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
@endsection
