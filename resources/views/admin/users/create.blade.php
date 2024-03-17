@extends('admin.layouts.app')
@section('title', 'User create')
@section('content')
    <div class="col-12">
        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Create User</h6>
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
                            <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="Email"
                                value="{{ old('email') }}">
                            <label for="floatingEmail">Email</label>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingPhone" name="phone" placeholder="Phone"
                                value="{{ old('phone') }}">
                            <label for="floatingPhone">Phone</label>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingAddress" name="address"
                                placeholder="Address" value="{{ old('address') }}">
                            <label for="floatingAddress">Address</label>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"
                                value="{{ old('password') }}">
                            <label for="floatingPassword">Password</label>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingpassword_confirmation" name="password_confirmation" placeholder="Confirm password">
                            <label for="floatingpassword_confirmation">Confirm password</label>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-2">
                        <label for="basic-url" class="form-label">Gerder</label>
                        <fieldset class="row mb-3">
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gerder" id="gerder1" value="male" checked="">
                                    <label class="form-check-label" for="gerder1">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gerder" id="gerder2" value="female">
                                    <label class="form-check-label" for="gerder2">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-6 mb-3 image-upload">
                        <label for="basic-url" class="form-label">Avatar</label>
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept="image/*" name="image" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url({{ asset('admins/img/noimage.png') }});">
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="row">
                    <h6>Roles</h6>
                    @foreach ($roles as $groupName => $role)
                        <div class="mb-3 col-lg-4">
                            <label>{{ $groupName }}</label>
                            @foreach ($role as $item)
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="role_ids[]"
                                        value="{{ $item->id }}" role="switch" id="{{ $item->name }}">
                                    <label class="form-check-label"
                                        for="{{ $item->name }}">{{ $item->display_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>


                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
@endsection
