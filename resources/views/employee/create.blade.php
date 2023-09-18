@extends('layouts.body')

@section('title', 'Tambah Karyawan')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Daftar Karyawan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Karyawan</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Tambah Karyawan</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end d-flex">
        <a href="{{ route('employee.index') }}">
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
                    <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Nama Karyawan</label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan nama karyawan..." required>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" name="birth_place" placeholder="Masukkan tempat lahir..." required>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" name="birth_date" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-select" id="sel1" name="gender">
                                <option value="male">Laki-Laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="position" placeholder="Masukkan jabatan..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-select" id="sel1" name="status">
                                <option value="fulltime">Tetap</option>
                                <option value="contract">Kontrak</option>
                                <option value="freelance">Harian Lepas</option>
                            </select>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Gaji Pokok</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Masukkan gaji pokok..."
                                        name="basic_salary" value="0" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Tunjangan Tetap</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Masukkan tunjangan tetap..."
                                        name="allowance" value="0" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Tanggal Mulai Kerja</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Karyawan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
