<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mazon</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

</head>
<body>

@include('inter-face.layouts.header')

<section class="container-fluid" style="margin-top: 150px">
    <div class="container">
        <div class="row min-vh-100">
            <div class="col-12 col-md-6">
                <img src="{{ asset('storage/product/'.$product->photo_link) }}" class="img-fluid" alt="">
                <div class="mt-4 img">
                    @foreach($product->photo as $p)
                        <div class="p-1">
                            <img src="{{asset('storage/products/'.$p->photos)}}" class="img-fluid" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-6">
                <h4 class="fw-bold mb-4 mt-4 mt-md-0">{{ $product->title }}</h4>
                <div class="mb-3">
                <span>
                    <i class="bi-star text-warning"></i>
                    <i class="bi-star text-warning"></i>
                    <i class="bi-star text-warning"></i>
                    <i class="bi-star text-warning"></i>
                    <i class="bi-star text-warning"></i>
                </span>
                    <span class="ms-3 text-black-50">
                       ({{ $product->review->count() }} customer review)
                </span>
                    <h5 class="my-4 text-danger fw-bold">
                        <bi class="bi-currency-dollar"></bi>{{ $product->price }}.00
                    </h5>

                    <h5 class="fw-bold mb-4">
                        <a href="{{ route('product.showDetail',$product->product_slug) }}" class="text-black text-decoration-none">Description /</a>
                        <a href="{{ route('review.index',$product->product_slug) }}" class="text-black text-decoration-none"> Review</a>
                    </h5>
                    <div class="msg-box bg-light">
                        @foreach($reviews as $r)
                            <div class="d-flex align-items-baseline border border-bottom p-3">
                                <div class="">
                                    <img height="40px" class="rounded rounded-circle" src="{{ asset('storage/product/623f59dd2c068photo.jpg') }}" alt="">
                                </div>
                                <div class="ms-2 mt-1 w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="text-primary fw-bolder">{{ $r->user->name }}</span>
                                            <span class="text-black-50">on {{ $r->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                              <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                              <li><a class="dropdown-item" href="{{ route('review.delete',$r->id) }}"><i class="bi bi-trash-fill text-danger"></i>  Delete </a></li>
                                            </ul>
                                          </div>
                                    </div>
                                    <p class="my-3 page-height">
                                        {{ $r->msg }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                    </div>
                    <div class="review mt-1">
                        <form action="{{ route('review.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea placeholder="Say Something...." name="msg" id="msg" cols="30" rows="2" class="form-control"></textarea>
                            <div class="my-3 text-end">
                                <button type="submit" class="btn px-5 btn-dark" style="border-radius: 0px"> Send </button>
                            </div>
                        </form>
                    </div>
                    <div class="d-md-flex d-block mt-3">
                        <button class="btn btn-dark w-100 me-md-1 me-0 my-1" style="border-radius: 0px"> Add To Cart </button>
                        <button class="btn btn-dark w-100 ms-md-1 me-0 my-1" style="border-radius: 0px"> Buy Now </button>
                    </div>
                    <div class="text-black-50 mt-2 small"> Category : {{ $product->category->title }} </div>
                    <div class="text-black-50 mt-2 small"> Brand : {{ $product->brand->name }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="fw-bolder mb-0 mb-md-5 py-5 text-center"> Related Products </h3>
            </div>
            @php $count = 0; @endphp
            @foreach($related as $p)
                <div class="col-12 col-md-3">
                    <div class="card card-hover shadow shadow-sm mb-4" style="height: 370px">
                        <figure class="imghvr-shutter-in-out-horiz">
                            <img src="{{ asset('storage/product/'.$p->photo_link) }}" style="height: 230px" class="card-img-top">
                            <figcaption>
                                <div class="" style="margin-top: 160px;">
                                    <form id="addToCartForm{{ $count }}">
                                        @csrf
                                        <input type="hidden" name="product_id" id="product_id{{ $count }}" value="{{ $p->id }}">
                                        <button onclick="addToCart({{ $count }})" type="submit" class="btn btn-sm btn-success w-100 text-light"><i class="bi-cart"></i> Add To Cart</button>
                                    </form>
                                </div>
                            </figcaption>
                        </figure>
                        @php $count++ @endphp
                        <input type="hidden" name="id" value="{{ $p->brand_id }}">
                        <a href="{{ route('product.showDetail',$p->product_slug) }}" class="text-decoration-none">
                            <div class="card-body">
                                <h6 class="text-black-50 mb-2 text-uppercase">{{ $p->category->title }}</h6>
                                <p class="mb-2 text-black" style="font-size: 14px">{{ \Illuminate\Support\Str::words($p->title,10) }}</p>
                                <span class="text-warning"><i class="bi-currency-dollar"></i>{{ $p->price }}.00</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<script src="{{ asset('js/theme.js') }}"></script>
<script>
    $('#sidebarBtn').click(function () {
        $('.menu-sidebar').css({
            'left' : '0px'
        })
    })
    $('#closeBtn').click(function () {
        $('.menu-sidebar').css({
            'left' : '-400px'
        })
    })

    $('.img').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    $('.msg-box').click(function () {
        console.log($('.msg-box').innerHeight());
    });


    let currentHeight = $('.msg-box').innerHeight();
    if (currentHeight >= 450 ){
        $('.msg-box').addClass('scroll');
    }

</script>
</body>
</html>
