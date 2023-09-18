@extends('layouts.body')

@section('title', 'Tambah Lembur')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('overtime.index') }}">Daftar Lembur</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah Lembur</li>
  </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Tambah Lembur</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end d-flex">
        <a href="{{ route('overtime.index') }}">
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
                                        <button class="btn btn-success" data-toggle="modal" data-target="#confirmOvertime{{ $item->id }}">
                                            <i class="fa fa-user-clock"></i>
                                        </button>
                                        <!-- Overtime Confirmation Modal -->
                                        <div class="modal fade" id="confirmOvertime{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h1 class="text-center text-dark mt-3 mb-3"><i class="fa fa-circle-question fa-xl"></i></h1>
                                                        <h2 class="text-center text-dark">Tambah Lembur</h2>
                                                        <form class="d-inline" 
                                                            action="{{ route('overtime.store') }}" 
                                                            method="post">
                                                            @csrf
                                                            <input type="text" name="employee_id" value="{{ $item->id }}" hidden required>
                                                            <div class="form-row px-5 mx-4 mb-3">
                                                                <div class="col-sm-12">
                                                                    <label class="text-dark">Nama Karyawan</label>
                                                                    <input type="text" class="form-control" value="{{ $item->name }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-row px-5 mx-4 mb-3">
                                                                <div class="col-sm-12">
                                                                    <label class="text-dark">Total Jam</label>
                                                                    <input type="number" class="form-control" name="hours" min="0" value="0" required>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex d-row justify-content-center mb-3">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-success ml-3">Tambah Lembur</button>
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
