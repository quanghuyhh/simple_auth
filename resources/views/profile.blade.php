@extends('layouts.dashboard')

@section('content')
    <h1>My profile</h1>

    <div class="profile-form w-2/3 mx-auto">

        @include('components.flash-message')

        <form action="/my-profile" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                <div class="mt-1 flex items-center">
                  <span class="inline-block h-28 w-28 overflow-hidden rounded-full bg-gray-100">
                    <img src="{{ $user->avatar ?? '/assets/images/default-avatar.svg' }}" alt="" class="avatar-img" id="avatar-img">
                  </span>
                    <label for="avatar" class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <input type="file" id="avatar" name="avatar" class="hidden opacity-0" accept="image/*"/> Change
                    </label>
                </div>
            </div>
            <div class="form-row">
                <label for="display_name" class="form-label text-bold text-primary-100">Name</label>
                <input type="text" class="form-control" id="display_name" name="display_name" placeholder="John Does"
                       value="{{ $user->display_name ?? null }}">
            </div>
            <div class="form-row">
                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" name="email" class="form-control opacity-50" placeholder="example@gmail.com"
                       value="{{ $user->email ?? null }}" disabled readonly>
            </div>
            <div class="form-row grid grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                </div>
            </div>
            <div class="form-row text-center">
                <button class="btn btn-primary text-uppercase inline-block">Update Profile</button>
            </div>
        </form>
    </div>
@endsection

@push('footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#avatar').on('change', function (event) {
                console.log('abc', event.target.files)
                var files = event.target.files;
                if (!files.length) {
                    $('.avatar-img').src('/assets/images/default-avatar.svg');
                    return
                }
                var selectedFile = files[0];
                var reader = new FileReader();

                var imgtag = document.getElementById("avatar-img");
                imgtag.title = selectedFile.name;

                reader.onload = function(event) {
                    imgtag.src = event.target.result;
                };

                reader.readAsDataURL(selectedFile);
            });
        })
    </script>
@endpush
