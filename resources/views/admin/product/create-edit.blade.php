@extends('admin.dashboard')
@section('dashboard_content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('Add :name', ['name' => __('Product')]) }}</h4>
                    <form action="{{ isset($product) ? route('cms.products.update', $product->id) : route('cms.products.store') }}"
                        method="POST" enctype="multipart/form-data" class="forms-sample"
                    >
                        @csrf
                        @isset($product)
                            <div class="row margin-bottom-20">
                                <label class="col-sm-3 col-form-label">{{ __('Image') }}</label>
                                <div class="col-sm-9">
                                    <img src="{{ asset('storage/uploads/products/' . $product->image) }}"
                                        alt="{{ __('Image') }}" class="width-50p"
                                    />
                                </div>
                            </div>
                        @endisset
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Upload Images') }} *</label>
                            <input type="file" name="image" class="file-upload-default" multiple />
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="{{ __('Upload Images') }}"
                                />
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">
                                        {{ __('Upload Images') }}
                                    </button>
                                </span>
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        @php
                            $category_id   = old('category_id') ?? $product->category_id ?? '';
                            $chosen_colors = old('colors') ?? [];

                            if (empty($chosen_colors) && isset($product)) {
                                $chosen_colors = $product->colors->pluck('id')->toArray();
                            }
                        @endphp
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="categoryId">{{ __('Category') }} *</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="category_id" id="categoryId" required>
                                    <option value="">-- {{ __('Choose :option', ['option' => __('Category')]) }} --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $category_id ? 'selected' : '' }}
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                          </div>
                        <div class="form-group row">
                            <label for="productName" class="col-sm-3 col-form-label">{{ __('Name') }} *</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="productName" required
                                    placeholder="{{ __('Name') }}" value="{{ old('name') ?? $product->name ?? '' }}"
                                />
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="productDescription" class="col-sm-3 col-form-label">{{ __('Description') }}</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="productDescription" rows="4">
                                    {{ old('description') ?? $product->description ?? '' }}
                                </textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="priceField" class="col-sm-3 col-form-label">{{ __('Price') }} *</label>
                            <div class="col-sm-9 input-group">
                                <input type="number" name="price" id="priceField" class="form-control"
                                    value="{{ old('price') ?? $product->price ?? '' }}" aria-label="{{ __('Price') }}"
                                    placeholder="0.00" required
                                />
                                <div class="input-group-append">
                                    <span class="input-group-text">лв.</span>
                                </div>
                                @error('price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Colors') }} *</label>
                            <div class="col-sm-9">
                                @foreach ($colors as $key => $color)
                                    <div class="form-check">
                                        <label for="color-{{ $color->id }}" class="form-check-label"
                                            style="color: {{ $color->color }};"
                                        >
                                            <input type="checkbox" name="colors[]" id="color-{{ $color->id }}"
                                                class="form-check-input" value="{{ $color->id }}"
                                                {{ in_array($color->id, $chosen_colors) ? 'checked' : '' }}
                                            />{{ $color->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">{{ __(isset($product) ? 'Save' : 'Add') }}</button>
                        <a href="{{ route('cms.products.index') }}" class="btn btn-dark">{{ __('Back') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
