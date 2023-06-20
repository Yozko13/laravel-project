@extends('admin.dashboard')
@section('dashboard_content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Add :name', ['name' => __('Color')]) }}</h4>
                    <form action="{{ isset($color) ? route('cms.colors.update', $color->id) : route('cms.colors.store') }}"
                        method="POST" enctype="multipart/form-data" class="forms-sample"
                    >
                        @csrf
                        <div class="form-group row">
                            <label for="colorName" class="col-sm-3 col-form-label">{{ __('Name') }} *</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="colorName" required
                                    placeholder="{{ __('Name') }}" value="{{ old('name') ?? $color->name ?? '' }}"
                                />
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colorField" class="col-sm-3 col-form-label">{{ __('Color') }} *</label>
                            <div class="col-sm-9">
                                <input type="color" name="color" class="form-control" id="colorField" required
                                    placeholder="{{ __('Color') }}" value="{{ old('color') ?? $color->color ?? '' }}"
                                />
                                @error('color')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __(isset($color) ? 'Save' : 'Add') }}</button>
                        <a href="{{ route('cms.colors.index') }}" class="btn btn-dark">{{ __('Back') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
