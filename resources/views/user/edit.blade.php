@extends('layouts.body')

@section('title', 'Ubah User')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Daftar User</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah User</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Ubah User</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end d-flex">
        <a href="{{ route('user.index') }}">
            <button type="button" class="btn btn-light">
                <i class="fas fa-arrow-circle-left mr-1"></i> Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form col-12">
                    <form action="{{ route('user.update', $user->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan nama..." value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Masukkan username..." value="{{ $user->username }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning text-white btn-block">
                            <i class="fa fa-pencil mr-1"></i> Ubah User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
