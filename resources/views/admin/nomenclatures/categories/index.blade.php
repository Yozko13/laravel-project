@extends('admin.dashboard')
@section('dashboard_content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Categories') }}</h4>
                    <a class="nav-link btn btn-success create-new-button width-fit-content"
                        href="{{ route('cms.categories.create') }}"
                        title="+ {{ __('Add :name', ['name' => __('Category')]) }}"
                    >+ {{ __('Add :name', ['name' => __('Category')]) }}</a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/uploads/categories/' . $category->image) }}"
                                                alt="{{ __('Image') }}"
                                            />
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <label class="badge badge-{{ $category->active ? 'success' : 'danger' }}">
                                                {{ $category->active ? __('Active') : __('Inactive') }}
                                            </label>
                                        </td>
                                        <td>
                                            <a href="{{ route('cms.categories.edit', $category->id) }}"
                                                title="{{ __('Edit') }}" class="btn btn-outline-secondary btn-icon-text"
                                            >{{ __('Edit') }} <i class="mdi mdi-file-check btn-icon-append"></i></a>
                                        </td>
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
