@extends('admin.layouts.app')
@section('title', 'Roles edit'.$role->name)
@section('content')
    <div class="col-12">
        <form action="{{ route('role.update',$role->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Role</h6>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingName" name="name" placeholder="Name"
                        value="{{ old('name')  ??  $role->name }}">
                    <label for="floatingName">Name</label>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingDisplayName" name="display_name" value="{{ old('display_name')  ??  $role->display_name }}"
                        placeholder="Display name">
                    <label for="floatingDisplayName">Display name</label>
                    @error('display_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" name="group" value="{{ $role->group }}"
                        aria-label="Floating label select example">
                        <option value="system">System</option>
                        <option value="user">User</option>
                    </select>
                    <label for="floatingSelect">Works with selects</label>
                    @error('group')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <h6>Permissions</h6>
                    @foreach ($permissions as $groupName => $permission)
                        <div class="mb-3 col-lg-4">
                            <label>{{ $groupName }}</label>
                            @foreach ($permission as $item)
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="permission_ids[]"
                                        value="{{ $item->id }}" role="switch" id="{{ $item->name }}" 
                                        {{ $role->permissions->contains('name',$item->name) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="{{ $item->name }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
