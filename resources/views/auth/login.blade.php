@extends('layouts.auth')

@section('content')


    <form action="/auth/login" method="POST" class="auth-form w-10/12 mx-auto">
        <h1 class="text-2xl font-bold leading-6 text-gray-900">Marketplace</h1>
        <h2 class="text-4xl font-bold leading-6 text-gray-900 my-7">Login your account</h2>

        @include('components.flash-message')

        <div class="form-row">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="example@gmail.com" required>
        </div>
        <div class="form-row">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="" required minlength="6">
        </div>
        <div class="form-row grid grid-cols-2 gap-4 mt-8">
            <button type="submit" class="btn btn-primary uppercase">Sign In</button>
            <a href="/auth/register" class="btn btn-secondary uppercase text-center">REGISTER</a>
        </div>
    </form>
@endsection