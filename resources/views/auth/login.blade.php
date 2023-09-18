@extends('auth.layout')

@section('title', 'Login')
@section('content')
<div class="auth-form">
    <h3 class="text-center mb-4">Login</h3>
    <form action="{{ route('auth.login') }}" method="post">
        @csrf
        <div class="form-group">
            <label><strong>Username</strong></label>
            <input type="text" class="form-control" name="username" autofocus required>
        </div>
        <div class="form-group">
            <label><strong>Password</strong></label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="form-check mb-3 d-flex align-items-center">
            <input class="form-check-input" type="checkbox" id="form-check-remember" name="remember">
            <label class="form-check-label" for="form-check-remember">
                Remember me
            </label>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </div>
    </form>
</div>
@endsection