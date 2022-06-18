@extends('layouts.app')
@section('content')
    @component('components.bread-crumb')
        <li class="breadcrumb-item active">User List</li>
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered">
                        <thead class="text-uppercase">
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>e-mail</th>
                                <th>role</th>
                                @if(auth()->user()->role==0)
                                <th>control</th>
                                @endif
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                @if(auth()->id() != $user->id)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role==0?'admin' : 'user' }}</td>
                                        @if(auth()->user()->role==0)
                                            <td>
                                                @if($user->role)
                                                    <form action="{{ route('makeAdmin') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                        <button type="submit" class="btn btn-outline-success btn-sm">Make Admin</button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                 @else
                                    <tr>
                                        <td colspan="6" class="text-danger"> Not User </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="5">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
