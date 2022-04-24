@extends('layouts.app')

@section('head')
    <style>
        .table thead,.table tr td{
            vertical-align: middle;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    @component('components.bread-crumb')
        <li class="breadcrumb-item active">Brand Manager</li>
    @endcomponent
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder mb-3"><i class="feather-plus-circle"></i> Add Brands Name</h4>
                    <form action="{{ route('brand.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="mb-3">
                                <input type="text" autofocus name="name" placeholder="" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-outline-primary"> Add New Brand </button>
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
                @forelse($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->user->name }}</td>
                        <td>
                            <a href="{{ route('brand.edit',$brand->id) }}" class="btn btn-warning btn-sm"><i class="feather-edit"></i></a>
                            <form class="d-inline-block" method="post" action="{{ route('brand.destroy',$brand->id) }}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger"><i class="feather-trash"></i></button>
                            </form>
                        </td>
                        <td>
                            <small>{{ $brand->created_at->format('d M Y') }}
                                <br>
                                {{ $brand->created_at->format('h i A') }}</small>
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
