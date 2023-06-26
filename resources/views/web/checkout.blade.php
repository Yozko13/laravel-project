@extends('web.index')
@section('web-content')
    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="checkout_details_area mt-50 clearfix">
                        <div class="cart-title">
                            <h2>{{ __('Order completion') }}</h2>
                        </div>
                        <form action="{{ route('order.store') }}" method="POST" id="checkoutForm">
                            @csrf
                            <input type="hidden" name="cart_id" value="{{ $current_cart->id }}" />
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name') }}" placeholder="{{ __('First Name') }}*" required
                                    />
                                    @error('first_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name') }}" placeholder="{{ __('Last Name') }}*" required
                                    />
                                    @error('last_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" name="company_name" class="form-control"
                                        placeholder="{{ __('Company Name') }} ({{ __('Optional') }})"
                                        value="{{ old('company_name') }}"
                                    />
                                    @error('company_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="email" name="email" class="form-control" required
                                        placeholder="{{ __('Email address') }}*" value="{{ old('email') }}"
                                    />
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" name="address" class="form-control mb-3" required
                                        placeholder="{{ __('Address') }}*" value="{{ old('address') }}"
                                    />
                                    @error('address')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" name="city" class="form-control" placeholder="{{ __('City') }}*"
                                        value="{{ old('city') }}" required
                                    />
                                    @error('city')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" name="zip_code" class="form-control"
                                        placeholder="{{ __('Zip Code') }} ({{ __('Optional') }})"
                                        value="{{ old('zip_code') }}"
                                    />
                                    @error('zip_code')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="phone_number" class="form-control" required
                                        placeholder="{{ __('Contact phone number') }}*" value="{{ old('phone_number') }}"
                                    />
                                    @error('phone_number')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="comment" class="form-control w-100" cols="30" rows="10"
                                        placeholder="{{ __('Leave a comment about your order') }} ({{ __('Optional') }})"
                                    >{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Ship to a different address</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>{{ __('Total') }}</h5>
                        <ul class="summary-table">
                            <li><span>{{ __('Subtotal') }}:</span> <span>{{ $current_cart->sum_price }}лв.</span></li>
                            <li><span>{{ __('Delivery') }}:</span> <span>{{ __('Free') }}</span></li>
                            <li><span>{{ __('Total') }}:</span> <span>{{ $current_cart->sum_price }}лв.</span></li>
                        </ul>
                        <div class="payment-method">
                            <!-- Cash on delivery -->
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" name="payment_type" class="custom-control-input" value="cod" checked />
                                <label class="custom-control-label" for="cod">{{ __('Cash on Delivery') }}</label>
                            </div>
                            <!-- Paypal -->
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="paypal">
                                <label class="custom-control-label" for="paypal">
                                    Paypal <img class="ml-15" src="{{ asset('web/img/core-img/paypal.png') }}" alt="Paypal" />
                                </label>
                            </div>
                        </div>
                        <div class="cart-btn mt-100">
                            <button type="button" class="btn amado-btn w-100"
                                onclick="document.getElementById('checkoutForm').submit()"
                            >{{ __('Finished') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
