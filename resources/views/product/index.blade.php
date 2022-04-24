@extends('layouts.app')
@section('content')
    @component('components.bread-crumb')
        <li class="breadcrumb-item active"><a class="text-dark" href="{{ route('product.create') }}">Product</a></li>
        <li class="breadcrumb-item active">Product List</li>
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="get">
                        <div class="form-inline">
                            <input type="search" class="form-control mr-2" value="{{ request()->search }}" name="search" placeholder="Search">
                            <button class="btn btn-outline-primary"><i class="feather-search"></i> Search</button>
                        </div>
                    </form>

                    @if(request()->search)
                        <h4> Search by <span>{{ request()->search }}</span> </h4>
                        @endif

                    <table class="table mt-3 table-bordered table-hover">
                        <thead class="text-uppercase">
                            <tr>
                                <td>id</td>
                                <td>photo</td>
                                <td>title</td>
                                <td>price</td>
                                <td>description</td>
                                <td>category</td>
                                <td>brand</td>
                                <td>owner</td>
                                <td>control</td>
                                <td class="text-nowrap">Date & Time</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td><img src="{{ asset('storage/product/'.$product->photo_link) }}" style="height: 50px" alt=""></td>
                                    <td class="text-left">{{ \Illuminate\Support\Str::words($product->title,6) }}</td>
                                    <td> ${{ $product->price }}</td>
                                    <td class="text-left">{{ strip_tags(\Illuminate\Support\Str::words($product->description,20)) }}</td>
                                    <td>{{ $product->category->title }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->user->name }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('product.show',$product->id) }}" class="btn btn-sm btn-outline-success"><i class="feather-info"></i></a>
                                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-warning btn-sm"><i class="feather-edit"></i></a>
                                        <form action="{{ route('product.destroy',$product->id) }}" id="fromDelete{{ $product->id }}" class="d-inline-block" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteBtn({{ $product->id }},'{{ $product->title }}')"><i class="feather-trash"></i></button>
                                        </form>
                                    </td>
                                    <td>{{ $product->created_at->format('d M Y') }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-danger text-uppercase">non data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-baseline">
                        <span> {{ $products->links()}} </span>
                        <span class="float-right font-weight-bolder">Total : {{ $products->total() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('foot')
    <script>

        function deleteBtn(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your Product has been deleted.',
                        'success'
                    )
                    setTimeout(function () {
                        $("#fromDelete"+id).submit();
                    },1000)
                }
            })
        }

    </script>
    @endsection
