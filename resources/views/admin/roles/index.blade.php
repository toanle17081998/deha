@extends('admin.layouts.app')
@section('title', 'Roles list')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="mb-0">List</h6>
                <a class="btn btn-outline-success m-2 rounded-pill" href="{{ route('role.create') }}">Create <i
                        class="fas fa-plus"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Display Name</th>
                            <th scope="col" style="width:90px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-outline-primary btn-sm"><i
                                            class="fas fa-edit"></i></a>

                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST"
                                        id="form-delete{{ $role->id }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger btn-sm delete-button"
                                            data-id="{{ $role->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
@endsection
