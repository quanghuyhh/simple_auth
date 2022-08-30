@extends('layouts.auth')

@section('content')
    <form action="/auth/register" method="POST" class="auth-form w-10/12 mx-auto">
        <h1 class="text-2xl font-bold leading-6 text-gray-900">Marketplace</h1>
        <h2 class="text-4xl font-bold leading-6 text-gray-900 my-7">Create an account</h2>

        @include('components.flash-message')

        <div class="form-row">
            <label for="display_name" class="form-label text-bold text-primary-100">Name</label>
            <input type="text" class="form-control" id="display_name" name="display_name" placeholder="John Does">
        </div>
        <div class="form-row">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="example@gmail.com" required>
        </div>
        <div class="form-row grid grid-cols-2 gap-4">
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required minlength="6">
            </div>
            <div class="form-group">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required minlength="6">
            </div>
        </div>
        <div class="form-row grid grid-cols-2 gap-4 mt-8">
            <button type="submit" class="btn btn-primary text-uppercase">REGISTER</button>
            <a href="/auth/login" class="btn btn-secondary text-uppercase text-center">Sign In</a>
        </div>
    </form>
@endsection