@extends('admin.dashboard')
@section('dashboard_content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Colors') }}</h4>
                    <a class="nav-link btn btn-success create-new-button width-fit-content"
                        href="{{ route('cms.colors.create') }}"
                        title="+ {{ __('Add :name', ['name' => __('Color')]) }}"
                    >+ {{ __('Add :name', ['name' => __('Color')]) }}</a>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $color)
                                    <tr>
                                        <td>{{ $color->id }}</td>
                                        <td {!! isset($color->color) ? 'style="color: '. $color->color .'"' : '' !!}>
                                            {{ $color->name }}
                                        </td>
                                        <td>
                                            <label class="badge badge-{{ $color->active ? 'success' : 'danger' }}">
                                                {{ $color->active ? __('Active') : __('Inactive') }}
                                            </label>
                                        </td>
                                        <td>
                                            <a href="{{ route('cms.colors.edit', $color->id) }}"
                                                title="{{ __('Edit') }}" class="btn btn-outline-secondary btn-icon-text"
                                            >{{ __('Edit') }} <i class="mdi mdi-file-check btn-icon-append"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination margin-top-20">
                            {{ $colors->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
