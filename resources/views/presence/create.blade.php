@extends('layouts.body')

@section('title', 'Tambah Presensi')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('presence.index') }}">Daftar Presensi</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Presensi</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Tambah Presensi</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end d-flex">
        <a href="{{ route('presence.index') }}">
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
                <div class="table-responsive">
                    <table id="example" class="display text-muted" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employee as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ ($item->gender == 'male') ? 'Laki-Laki' : 'Perempuan' }}</td>
                                    <td>{{ $item->position }}</td>
                                    @switch ($item->status)
                                        @case ('fulltime')
                                        <td><span class="badge badge-primary">Tetap</span></td>
                                        @break
                                        @case ('contract')
                                        <td><span class="badge badge-success">Kontrak</span></td>
                                        @break
                                        @case ('freelance')
                                        <td><span class="badge badge-warning">HL</span></td>
                                        @break
                                    @endswitch
                                    <td>
                                        <!-- Presence -->
                                        <button class="btn btn-success" data-toggle="modal" data-target="#confirmPresence{{ $item->id }}">
                                            <i class="fa fa-user-check"></i>
                                        </button>
                                        <!-- Presence Confirmation Modal -->
                                        <div class="modal fade" id="confirmPresence{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h1 class="text-center text-dark mt-3 mb-3"><i class="fa fa-circle-question fa-xl"></i></h1>
                                                        <h2 class="text-center text-dark">Tambah Presensi</h2>
                                                        <form class="d-inline" 
                                                            action="{{ route('presence.store') }}" 
                                                            method="post">
                                                            @csrf
                                                            <input type="text" name="employee_id" value="{{ $item->id }}" hidden required>
                                                            <div class="form-row px-5 mx-4 mb-3">
                                                                <div class="col-sm-12">
                                                                    <label class="text-dark">Nama Karyawan</label>
                                                                    <input type="text" class="form-control" value="{{ $item->name }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group px-5 mx-4 mb-4">
                                                                <label class="text-dark">Status</label>
                                                                <select class="form-select" id="sel1" name="status">
                                                                    <option value="present">Masuk</option>
                                                                    <option value="leave">Cuti</option>
                                                                </select>
                                                            </div>
                                                            <div class="d-flex d-row justify-content-center mb-3">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-success ml-3">Tambah presensi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
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
@endsection

@push('style')
<link href="{{ asset('assets/dashboard/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('assets/dashboard/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/plugins-init/datatables.init.js') }}"></script>
@endpush
