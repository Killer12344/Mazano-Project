@extends('layouts.app')
@section('content')
    @component('components.bread-crumb')
        <li class="breadcrumb-item active">Product Add</li>
    @endcomponent
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder mb-3"><i class="feather-tag"></i> Add Product</h4>
                    <form method="post" action="{{ route('product.store') }}" id="formData" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter Product Title">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Enter Product Price">
                            @error('price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 form-row">
                            <div class="col-6">
                                <select name="category" id="" class="custom-select @error('category') is-invalid @enderror">
                                    <option value="0" selected disabled>Select Category</option>
                                    @forelse($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category') == $category->id? 'selected' : '' }}>{{ $category->title }}</option>
                                    @empty
                                        <option value="#" disabled>Not Category</option>
                                    @endforelse
                                </select>
                                @error('category')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-6">
                                <select name="brand" id="" class="custom-select @error('brand') is-invalid @enderror">
                                    <option value="0" selected disabled>Select Brands Name</option>
                                    @forelse($brands as $category)
                                        <option value="{{ $category->id }}" {{ old('brand') == $category->id? 'selected' : '' }}>{{ $category->name }}</option>
                                    @empty
                                        <option value="#" disabled>Not Brands Name</option>
                                    @endforelse
                                </select>
                                @error('brand')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea style="visibility: hidden" name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control-file" name="photo" accept="image/jpeg,image/png" value="">
                            @error('photo')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button class="w-100 btn btn-primary">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row-cols-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bolder mb-3"><i class="feather-image"></i> Add Photo</h4>
                        <form action="{{ route('product.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="mb-3">
                                    <form action="{{ route('product.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" form="formData" name="photos[]" multiple placeholder="" class="form-control p-1 @error('photo.*') is-invalid @enderror" value="{{ old('name') }}">
                                        @error('photo.*')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        @if(session('status1'))
                                            <small class="text-success">{{ session('status1') }}</small>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('foot')
    <script !src="">
        $(document).ready(function() {
            $('#description').summernote({
                placeholder : 'Enter Description',
                height : 400
            });
        });
    </script>
@endsection
