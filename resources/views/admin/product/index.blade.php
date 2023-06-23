@extends('admin.dashboard')
@section('dashboard_content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Products') }}</h4>
                    <a class="nav-link btn btn-success create-new-button width-fit-content"
                        href="{{ route('cms.products.create') }}"
                        title="+ {{ __('Add :name', ['name' => __('Product')]) }}"
                    >+ {{ __('Add :name', ['name' => __('Product')]) }}</a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('In stock') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <img src="{{ $product->getImageUrl() }}" alt="{{ __('Image') }}" />
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            <label class="badge badge-{{ $product->active ? 'success' : 'danger' }}">
                                                {{ $product->active ? __('Active') : __('Inactive') }}
                                            </label>
                                        </td>
                                        <td>
                                            <a href="{{ route('cms.products.edit', $product->id) }}"
                                                title="{{ __('Edit') }}" class="btn btn-outline-secondary btn-icon-text"
                                            >{{ __('Edit') }} <i class="mdi mdi-file-check btn-icon-append"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination margin-top-20">
                            {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
