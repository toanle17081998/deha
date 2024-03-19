@extends('admin.layouts.app')
@section('title', 'Categories list')
@section('content')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="mb-0">List</h6>
                <a class="btn btn-outline-success m-2 rounded-pill" href="{{ route('category.create') }}">Create <i
                        class="fas fa-plus"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Parent</th>
                            <th scope="col" style="width:90px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->parent_name }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-outline-primary btn-sm mx-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                            id="form-delete{{ $category->id }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-sm delete-button"
                                                data-id="{{ $category->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
