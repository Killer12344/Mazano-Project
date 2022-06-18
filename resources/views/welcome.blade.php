@extends('inter-face.layouts.app')

@section('content')
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-5">
            <div class="text-black-50 font-weight-bolder">Show 1<i class="bi-dash"></i>{{ $products->count() }} of {{  $products->total() }}</div>
            <div class="dropdown">
                <button class="btn short_by_btn dropdown-toggle text-black-50" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Short By
                </button>
                <ul class="dropdown-menu m-0 p-0" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item my-2" href="{{ route('index') }}">Refresh Page</a></li>
                    <li><a class="dropdown-item my-2" href="{{ route('priceAsc.index') }}">Low to High Price</a></li>
                    <li><a class="dropdown-item my-2" href="{{ route('priceDesc.index') }}">High to Low Price</a></li>
                </ul>
            </div>
        </div>
    </div>

    @php $count = 0; @endphp
    @forelse($products as $p)
        <div class="col-12 col-md-4">
            <div class="card card-hover shadow shadow-sm mb-4" style="height: 370px">
                <figure class="imghvr-shutter-in-out-horiz">
                    <img src="{{ asset('storage/product/'.$p->photo_link) }}" style="height: 230px" class="card-img-top">
                    <figcaption>
                        <div class="w-100 px-3" style="position: absolute; bottom: 10px; right: 0px">
                            <form id="addToCartForm{{ $count }}">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id{{ $count }}" value="{{ $p->id }}">
                                <button onclick="addToCart({{ $count }})" type="submit" class="btn btn-sm btn-success w-100 text-light"><i class="bi-cart"></i> Add To Cart</button>
                            </form>
                        </div>
                    </figcaption>
                </figure>
                @php $count++ @endphp
                <a href="{{ route('product.showDetail',$p->product_slug) }}" class="text-decoration-none">
                    <input type="hidden" name="brand_id" value="{{ $p->brand_id }}">
                    <div class="card-body">
                        <h6 class="text-black-50 mb-2 text-uppercase">
                            {{ $p->category->title }}
                            @if($p->created_at->format('d') == date('d M Y'))
                                <span class="text-lowercase bg-warning badge px-2 fw-bolder" style="padding: 5px"> New </span>
                            @endif
                        </h6>
                        <p class="my-2 text-black text" style="font-size: 14px; height: 43px">{{ \Illuminate\Support\Str::words($p->title,10) }}</p>
                        <span class="text-warning"><i class="bi-currency-dollar"></i>{{ $p->price }}.00</span>
                    </div>
                </a>
            </div>
        </div>
    @empty
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <span class="text-danger"> Data is Not Insert <i class="bi-exclamation-circle"></i> </span>
                </div>
            </div>
        </div>
    @endforelse

    <div class="col-12">
        <div class="mt-3">
            {{ $products->links()}}
        </div>
    </div>

@endsection

@section('foot')
        <script>

            $('#sidebarBtn').click(function () {
                $('.menu-sidebar').css({
                    'left' : '0px'
                })
            });
            $('#closeBtn').click(function () {
                $('.menu-sidebar').css({
                    'left' : '-400px'
                })
            });

            {{--let productArr = @json($products);--}}
            {{--let count = productArr.data.length;--}}

            @if(auth()->user())
                function addToCart(id){
                $('#addToCartForm'+id).submit(function (e) {
                    e.preventDefault();
                    let _token = $('input[name=_token]').val();
                    let product_id = $('#product_id'+id).val();
                    $.ajax({
                        type : "post",
                        url : "{{ route('product.cart') }}",
                        data : {
                            _token : _token,
                            product_id : product_id
                        },
                        success : function (response) {
                            window.location.reload();
                        },
                        error : function (response) {
                            window.location.reload();
                        }
                    })
                })
            }
            @else

            function addToCart(id){
                $('#addToCartForm'+id).submit(function (e) {
                    e.preventDefault();
                    window.location.href = '{{ route('login') }}';
                })
            }

            @endif

        </script>
@endsection

