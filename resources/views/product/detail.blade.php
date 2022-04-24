@extends('layouts.app')

@section('content')
    @component('components.bread-crumb')
        <li class="breadcrumb-item active"><a class="text-dark" href="{{ route('product.index') }}">Product List</a></li>
        <li class="breadcrumb-item active">Detail</li>
    @endcomponent
            <div class="row">
                <div class="col-12 col-md-6">
                    <img src="{{ asset('storage/product/'.$product->photo_link) }}" class="img-fluid" alt="">
                    <div class="mt-2 img">
                        @foreach($product->photo as $p)
                            <div class="px-1">
                                <img src="{{asset('storage/products/'.$p->photos)}}" class="img-fluid" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex text-secondary justify-content-between mt-3 mb-md-4 font-size-1">
                        <span><i class="feather-user"></i> {{ $product->user->name }}</span>
                        <span><i class="feather-calendar"></i> {{ $product->created_at->format('d M Y') }}</span>
                    </div>
                    <h4 class="font-weight-bolder">{{ $product->title }}</h4>
                    <div class="font-size-1 text-left text-md-right">
                        <span class="badge badge-dark p-2">Category : {{ $product->category->title }}</span>
                        <span class="badge badge-dark p-2">Brand : {{ $product->brand->name }}</span>
                        <span class="badge mt-1 mt-md-0 badge-success p-2">Price : $ {{ $product->price }}</span>
                    </div>
                    <div class="my-3">
                        <h6 class="font-weight-bolder">
                            Description
                        </h6>
                        <p class="font-weight-light text-secondary page m-0">
                            {!! $product->description !!}
                        </p>
                    </div>
                </div>
            </div>

@endsection
@section('foot')
    <script>
        $('.img').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
        });
    </script>
@endsection
