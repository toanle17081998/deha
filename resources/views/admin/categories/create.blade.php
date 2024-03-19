@extends('admin.layouts.app')
@section('title', 'Category create')
@section('content')
    <div class="col-12">
        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Create category</h6>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingName" name="name" placeholder="Name"
                                value="{{ old('name') }}">
                            <label for="floatingName">Name</label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="parent_id" id="floatingSelect" aria-label="Floating label select example">
                                <option value="">Parent category</option>
                                @php
                                    $n = 0;
                                @endphp
                                @foreach ($parentCategories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}" {{ old('parent_id') == $parentCategory->id ? 'selected':'' }}>{{ $parentCategory->name }}</option>
                                    @foreach ($parentCategory->childrens as $child)
                                        @include('admin.categories.categoryChild', [
                                            'child_cate' => $child,
                                            'n'=> ++$n,
                                        ])
                                        @php
                                            $n = 0;
                                        @endphp
                                    @endforeach
                                @endforeach
                            </select>
                            <label for="floatingSelect">Select parent category</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
