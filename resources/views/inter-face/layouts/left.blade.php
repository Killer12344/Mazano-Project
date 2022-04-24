<div class="col-12 col-md-3">
    <div class="left_side">
{{--        Category--}}
        <div class="item-list mt-3">
            <h5 class="fw-bolder text-uppercase mb-3 mt-5">categories</h5>
            @forelse($categories as $category)
                <a href="{{  route('orderByCat.index',$category->slug) }}" class="item my-2 d-flex justify-content-between">
                    <span class="text-black"><i class="bi-caret-right-fill"></i> {{ $category->title }} </span>
                    <span class="badge bg-secondary rounded-pill px-3 mt-1">{{ $category->product->count() }}</span>
                </a>
                <div class="rule"></div>
            
            @empty

                <a href="#" class="item my-2 d-flex justify-content-between">
                    <span class="text-black"><i class="bi-question"></i> No Categories </span>
                </a>

            @endforelse
            
        </div>
{{--        Price--}}
        <div class="item-list mt-3">
            <h5 class="fw-bolder text-uppercase  mb-3 mt-5">Price</h5>
            <form action="{{ route('orderByPrice.index') }}" method="get" class="d-flex justify-content-between align-items-baseline">
                <div class="pe-1">
                    <input type="number" value="{{ request()->min_price }}" placeholder="Min" name="min_price" class="form-control form-control-sm">
                </div>
                <i class="bi-dash"></i>
                <div class="ps-1">
                    <input type="number" value="{{ request()->max_price }}" placeholder="Max" name="max_price" class="form-control form-control-sm">
                </div>
                <div class="ps-1">
                    @if(request()->min_price && request()->max_price)
                        <a href="{{ route('index') }}" class="btn btn-sm btn-secondary px-3 text-white"><i class="bi-x"></i></a>
                    @else
                        <button class="btn btn-sm btn-secondary px-3 text-white"><i class="bi-search"></i></button>
                    @endif
                </div>
            </form>
        </div>
{{--        Brand--}}
        <div class="item-list mt-3">
            <h5 class="fw-bolder text-uppercase mb-3 mt-5">brands</h5>
            @foreach($brands as $category)
                <a href="{{ route('orderByBrand.index',$category->slug) }}" class="item my-2 d-flex justify-content-between">
                    <span class="text-black"><i class="bi-caret-right-fill"></i> {{ $category->name }} </span>
                    <span class="badge bg-secondary rounded-pill px-3 mt-1">{{ $category->product->count() }}</span>
                </a>
                <div class="rule"></div>
            @endforeach
        </div>
    </div>
</div>
