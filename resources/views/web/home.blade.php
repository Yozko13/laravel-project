@extends('web.index')
@section('web-content')
    <!-- Product Catagories Area Start -->
    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            @foreach ($category_list as $category_data)
                <div class="single-products-catagory clearfix">
                    <a href="" title="">
                        <img src="{{ $category_data['image'] }}" alt="{{ $category_data['name'] }}" />
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>{{ __('From :price lv.', ['price' => $category_data['price']]) }}</p>
                            <h4>{{ $category_data['name'] }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Product Catagories Area End -->
@endsection
