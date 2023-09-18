@extends('layouts.body')

@section('title', 'Tambah Payroll')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('payroll.index') }}">Daftar Payroll</a></li>
    <li class="breadcrumb-item"><a href="{{ route('payroll.selectEmployee') }}">Pilih Karyawan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Payroll</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Tambah Payroll</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end d-flex">
        <a href="{{ route('payroll.selectEmployee') }}">
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
                    <form action="{{ route('payroll.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" class="form-control" name="employee_id" value="{{ $employee->id }}" hidden required>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Nama Karyawan</label>
                                <input type="text" class="form-control" value="{{ $employee->name }}" disabled required>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Gaji Pokok</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" name="basic_salary" value="{{ $employee->basic_salary }}" disabled required>
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
                                    <input type="number" class="form-control" name="allowance" value="{{ $employee->allowance }}" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Insentif</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" name="incentive" value="{{ $incentive }}" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Lembur</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" name="overtime" value="{{ $overtime }}" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>NWNP (No Work No Pay)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" name="nwnp" value="{{ $nwnp }}" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>BPJS</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" name="insurance" value="{{ $insurance }}" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Total Payroll</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" value="{{ $total_payroll }}" disabled required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-sm-12">
                                <label>Tanggal Payroll</label>
                                <input type="date" class="form-control" name="payroll_date" value="{{ $lastdate }}" disabled required>
                            </div>
                        </div>

                        <h5 class="text-center">Apakah anda yakin ingin menambah data payroll?</h5>
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Payroll
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
