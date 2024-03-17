@extends('admin.layouts.app')
@section('title', 'Users list')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="mb-0">List</h6>
                <a class="btn btn-outline-success m-2 rounded-pill" href="{{ route('user.create') }}">Create <i
                        class="fas fa-plus"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col" style="width:90px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <img src="{{ $user->images ? asset('upload/users/'.$user->images->first()->url) : asset('admins/img/noimage.png') }}" width="100px" height="100px" alt="">
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-primary btn-sm mx-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
