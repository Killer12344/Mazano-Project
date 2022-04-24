@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder mb-3"><i class="feather-tag"></i> Add Product</h4>
                    <form method="post" action="{{ route('product.update',$product->id) }}" id="formData" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title',$product->title) }}" placeholder="Enter Product Title">
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price',$product->price) }}" placeholder="Enter Product Price">
                            @error('price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 form-row">
                            <div class="col-6">
                                <select name="category" id="" class="custom-select @error('category') is-invalid @enderror">
                                    <option value="0" selected disabled>Select Category</option>
                                    @forelse($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category',$product->category_id) == $category->id? 'selected' : '' }}>{{ $category->title }}</option>
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
                                        <option value="{{ $category->id }}" {{ old('brand',$product->brand_id) == $category->id? 'selected' : '' }}>{{ $category->name }}</option>
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
                            <textarea name="description" placeholder="Enter Product Description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10">{{ old('description',$product->description) }}</textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <img src="{{ asset('storage/product/'.$product->photo_link) }}" style="height: 140px" class="img-fluid" alt="">
                            </div>
                            <input type="file" class="form-control-file" name="photo" accept="image/jpeg,image/png" value="">
                            @error('photo')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button class="w-100 btn btn-primary">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($product->photo as $p)
                            <div class="col-12 col-md-4">
                                <div class="mt-3">
                                    <img src="{{ asset('storage/products/'.$p->photos) }}" class="img-fluid"  alt="">
                                    <form action="{{ route('photo.destroy',$p->id) }}" method="post" class="mt-1">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100"><i class="feather-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <form action="{{ route('photo.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="file" class="form-control-file" name="photos[]" multiple accept="image/jpeg,image/png">
                            @error('photos.*')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="mt-3">
                                <button class="btn btn-primary">Update Photo</button>
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
