@extends('layouts.app')
@section('content')
    @component('components.bread-crumb')
        <li class="breadcrumb-item active">Category Manager</li>
    @endcomponent
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder mb-3"><i class="feather-plus-circle"></i> Update Category</h4>
                    <form action="{{ route('brand.update',$brand->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <div class="mb-3">
                                <input type="text" name="name" placeholder="" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$brand->name) }}">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                @if(session('status'))
                                    <small class="text-success">{{ session('status') }}</small>
                                @endif
                            </div>
                            <button class="btn btn-outline-primary"> Update Category </button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered mt-4 table-hover">
                <thead class="text-center text-uppercase bg-primary text-light">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>owner</th>
                    <th>control</th>
                    <th>Date & Time</th>
                </tr>
                </thead>
                <tbody>
                @forelse($brands as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->user->name }}</td>
                        <td class="">
                            <a href="{{ route('brand.edit',$category->id) }}" class="btn btn-warning btn-sm"><i class="feather-edit"></i></a>
                            <form class="d-inline-block" method="post" action="{{ route('brand.destroy',$category->id) }}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger"><i class="feather-trash"></i></button>
                            </form>
                        </td>
                        <td>
                            <small>{{ $category->created_at->format('d M Y') }}
                                <br>
                                {{ $category->created_at->format('h i A') }}</small>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <p class="m-0 font-weight-bolder text-danger"> No Data! </p>
                        </td>
                    </tr>

                @endforelse

                </tbody>
            </table>

        </div>
    </div>

@endsection
