@extends('admin.dashboard')
@section('dashboard_content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Search') }}</h4>
                    <form method="GET" class="forms-sample">
                        <div class="form-group">
                            <label for="statusField">{{ __('Status') }}</label>
                            <select name="status" class="form-control" id="statusField">
                                <option value="">-- {{ __('Choose :option', ['option' => __('Status')]) }} --</option>
                                @foreach (App\Models\OrderStatus::getStatusList() as $status_id => $status_title)
                                    <option value="{{ $status_id }}"
                                        {{ $status_id == request('status') ? 'selected' : '' }}
                                    >{{ $status_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __('Search') }}</button>
                        <a href="{{ route('cms.orders.index') }}" class="btn btn-dark">{{ __('Reset') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Orders') }}</h4>
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
                                    <th>{{ __('Status') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
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
                                        <td>@include('admin.order.partials.change-status')</td>
                                        <td>
                                            <a href="{{ route('cms.orders.show', $order->id) }}"
                                                title="{{ __('Edit') }}" class="btn btn-outline-secondary btn-icon-text"
                                            >{{ __('Details') }} <i class="mdi mdi-cart-outline"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination margin-top-20">
                            {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
