@extends('layouts.app')

@section('title')
    @yield('title')
@endsection

@section('body')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-4">
        <div class="card">
            <!-- CONTENT -->
            @yield('content')
        </div>
    </div>
</div>
@endsection