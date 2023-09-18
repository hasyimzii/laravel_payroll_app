@extends('layouts.body')

@section('title', 'Detail Payroll')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('payroll.request') }}">Daftar Payroll</a></li>
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
        <!-- Update Button -->
        @if ($payroll->status == 'approved')
        <button type="button" class="btn btn-warning text-white me-3" data-toggle="modal" data-target="#confirmUpdate">
            <i class="fas fa-times-circle mr-1"></i> Update Draft
        </button>
        @elseif ($payroll->status == 'draft')
        <button type="button" class="btn btn-success me-3" data-toggle="modal" data-target="#confirmUpdate">
            <i class="fas fa-check-circle mr-1"></i> Update Approve
        </button>
        @endif
        <!-- Update Confirmation Modal -->
        <div class="modal fade" id="confirmUpdate" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h1 class="text-center text-dark mt-3 mb-3"><i class="fa fa-circle-question fa-xl"></i></h1>
                        <h2 class="text-center text-dark">Ubah Status Payroll?</h2>
                        <p class="text-center text-secondary">Apakah anda yakin ingin mengubah status payroll menjadi "{{ ($payroll->status == 'approved') ? 'Draft' : 'Approved' }}"?</p>
                        <div class="d-flex d-row justify-content-center mb-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <form class="d-inline ml-3" 
                                action="{{ route('payroll.updateRequest', $payroll->id) }}" 
                                method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Ya, Ubah sekarang!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Back -->
        <a href="{{ route('payroll.request') }}">
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