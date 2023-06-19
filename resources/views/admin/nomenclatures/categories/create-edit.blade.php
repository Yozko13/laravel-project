@extends('admin.dashboard')
@section('dashboard_content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Add :name', ['name' => __('Category')]) }}</h4>
                    <form action="{{ isset($category) ? route('cms.categories.update', $category->id) : route('cms.categories.store') }}"
                        method="POST" enctype="multipart/form-data" class="forms-sample"
                    >
                        @csrf
                        @isset($category)
                            <div class="row margin-bottom-20">
                                <label class="col-sm-3 col-form-label">{{ __('Image') }}</label>
                                <div class="col-sm-9">
                                    <img src="{{ asset('storage/uploads/categories/' . $category->image) }}"
                                        alt="{{ __('Image') }}" class="width-50p"
                                    />
                                </div>
                            </div>
                        @endisset
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Upload Image') }}</label>
                            <input type="file" name="image" class="file-upload-default" />
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="{{ __('Upload Image') }}"
                                />
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">
                                        {{ __('Upload Image') }}
                                    </button>
                                </span>
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="categoryName" class="col-sm-3 col-form-label">{{ __('Name') }} *</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="categoryName"
                                    placeholder="{{ __('Name') }}" value="{{ old('name') ?? $category->name ?? '' }}"
                                />
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="categoryDescription" class="col-sm-3 col-form-label">{{ __('Description') }}</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="categoryDescription" rows="4">
                                    {{ old('description') ?? $category->description ?? '' }}
                                </textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __(isset($category) ? 'Save' : 'Add') }}</button>
                        <button class="btn btn-dark">{{ __('Back') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
