@extends('layouts.body')

@section('title', 'Detail Payroll')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('payroll.index') }}">Daftar Payroll</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Payroll</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Detail Payroll</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end d-flex">
        <a href="{{ route('payroll.printPdf', $payroll->id) }}">
            <button type="button" class="btn btn-primary me-3">
                <i class="fas fa-print mr-1"></i> Cetak PDF
            </button>
        </a>
        <a href="{{ route('payroll.index') }}">
            <button type="button" class="btn btn-light">
                <i class="fas fa-arrow-circle-left mr-1"></i> Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->

<div class="row">
    <div class="col-12">
        <!-- Employee Section -->
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Karyawan</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $payroll->employee->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $payroll->employee->birth_place }}, {{ \Carbon\Carbon::parse($payroll->employee->birth_date)->isoFormat('DD MMM YYYY') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ ($payroll->employee->gender == 'male') ? 'Laki-Laki' : 'Perempuan' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $payroll->employee->position }}">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                @switch ($payroll->employee->status)
                                    @case ('fulltime')
                                    <span class="badge badge-primary">Tetap</span>
                                    @break
                                    @case ('contract')
                                    <span class="badge badge-success">Kontrak</span>
                                    @break
                                    @case ('freelance')
                                    <span class="badge badge-warning">HL</span>
                                    @break
                                @endswitch
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Mulai Kerja</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ \Carbon\Carbon::parse($payroll->employee->start_date)->isoFormat('ddd, DD MMM YYYY') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Payroll Section -->
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Payroll</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ \Carbon\Carbon::parse($payroll->payroll_date)->isoFormat('ddd, DD MMM YYYY') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Gaji Pokok</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Rp {{ number_format($payroll->basic_salary) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tunjangan Tetap</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Rp {{ number_format($payroll->allowance) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Insentif</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Rp {{ number_format($payroll->incentive) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lembur</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Rp {{ number_format($payroll->overtime) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NWNP (No Work No Pay)</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Rp {{ number_format($payroll->nwnp) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">BPJS</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Rp {{ number_format($payroll->insurance) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Total Payroll</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Rp {{ number_format($payroll->totalPayroll()) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Staff User</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $payroll->user->name }}">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                @switch ($payroll->status)
                                    @case ('approved')
                                    <span class="badge badge-success">Approved</span>
                                    @break
                                    @case ('draft')
                                    <span class="badge badge-warning">Draft</span>
                                    @break
                                @endswitch
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection