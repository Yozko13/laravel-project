@extends('admin.dashboard')
@section('dashboard_content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Order details') }}</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('First Name') }}</th>
                                    <th>{{ __('Last Name') }}</th>
                                    <th>{{ __('Company Name') }}</th>
                                    <th>{{ __('Email address') }}</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('City') }}</th>
                                    <th>{{ __('Zip Code') }}</th>
                                    <th>{{ __('Contact phone number') }}</th>
                                    <th>{{ __('Comment') }}</th>
                                    <th>{{ __('Product count') }}</th>
                                    <th>{{ __('Payment type') }}</th>
                                    <th>{{ __('Price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->first_name }}</td>
                                    <td>{{ $order->last_name }}</td>
                                    <td>{{ $order->company_name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->city }}</td>
                                    <td>{{ $order->zip_code }}</td>
                                    <td>{{ $order->phone_number }}</td>
                                    <td>{{ $order->comment }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ __('Cash on Delivery') }}</td>
                                    <td>{{ $order->sum_price }}лв.</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr />
                        <h5 class="card-title">{{ __('Products') }}</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Color') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td>
                                            <img src="{{ $product->product->getImageUrl() }}" alt="{{ __('Image') }}" />
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}лв.</td>
                                        <td>
                                            <p style="color: {{ $product->color->color }};">{{ $product->color->name }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h5 class="card-title">{{ __('Status') }}</h5>
                        <div>@include('admin.order.partials.change-status')</div>
                        <hr />
                        <h5 class="card-title">{{ __('History') }}</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->statuses as $status)
                                    <tr>
                                        <td>{{ App\Models\OrderStatus::getReadableStatusByKey($status->status) }}</td>
                                        <td>{{ $status->created_at->format('d.m.Y H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
