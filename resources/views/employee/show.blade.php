@extends('layouts.body')

@section('title', 'Detail Karyawan')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Daftar Karyawan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Karyawan</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Detail Karyawan</h4>
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
        <!-- Post Section -->
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Karyawan</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $employee->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $employee->birth_place }}, {{ \Carbon\Carbon::parse($employee->birth_date)->isoFormat('DD MMM YYYY') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ ($employee->gender == 'male') ? 'Laki-Laki' : 'Perempuan' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $employee->position }}">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                @switch ($employee->status)
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
                            <label class="col-sm-3 col-form-label">Gaji Pokok</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Rp {{ number_format($employee->basic_salary) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tunjangan Tetap</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="Rp {{ number_format($employee->allowance) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Mulai Kerja</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ \Carbon\Carbon::parse($employee->start_date)->isoFormat('ddd, DD MMM YYYY') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Bottom Section -->
        <div class="card">
            <!-- Tabs Header -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="presence-tab" data-toggle="tab" 
                    data-target="#presence" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                       Presensi 
                    </button>
                    <button class="nav-link" id="overtime-tab" data-toggle="tab" 
                    data-target="#overtime" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        Lembur
                    </button>
                    <button class="nav-link" id="insurance-tab" data-toggle="tab" 
                    data-target="#insurance" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                        BPJS
                    </button>
                </div>
            </nav>
            <!-- Tabs Content -->
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <!-- Presence -->
                    <div class="tab-pane fade show active" id="presence" role="tabpanel" aria-labelledby="nav-comment-tab">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($presence as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('ddd, DD MMM YYYY') }}</td>
                                        @switch ($item->status)
                                            @case ('present')
                                            <td><span class="badge badge-success">Masuk</span></td>
                                            @break
                                            @case ('leave')
                                            <td><span class="badge badge-warning">Cuti</span></td>
                                            @break
                                        @endswitch
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Overtime -->
                    <div class="tab-pane fade" id="overtime" role="tabpanel" aria-labelledby="nav-like-tab">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Total Jam</th>
                                    <th>Total Upah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($overtime as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('ddd, DD MMM YYYY') }}</td>
                                        <td>{{ $item->hours }} jam</td>
                                        <td>Rp {{ $item->total_salary }}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Insurance -->
                    <div class="tab-pane fade" id="insurance" role="tabpanel" aria-labelledby="nav-like-tab">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($insurance as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('ddd, DD MMM YYYY') }}</td>
                                        <td>Rp {{ $item->total_fee }}</td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection