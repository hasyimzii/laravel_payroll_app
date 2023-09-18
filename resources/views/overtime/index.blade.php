@extends('layouts.body')

@section('title', 'Daftar Lembur')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Lembur</li>
    </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Daftar Lembur</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('overtime.create') }}">
            <button type="button" class="btn btn-success">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Lembur
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
                                <th>Tanggal</th>
                                <th>Nama Karyawan</th>
                                <th>Total Jam</th>
                                <th>Total Upah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($overtime as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('ddd, DD MMM YYYY') }}</td>
                                    <td>{{ $item->employee->name }}</td>
                                    <td>{{ $item->hours }} jam</td>
                                    <td>Rp {{ $item->total_salary }}</td>
                                    <td>
                                        <!-- Update -->
                                        <button class="btn btn-warning text-white" data-toggle="modal" data-target="#confirmUpdate{{ $item->id }}">
                                            <i class="fa fa-pencil text-white"></i>
                                        </button>
                                        <!-- Update Confirmation Modal -->
                                        <div class="modal fade" id="confirmUpdate{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h1 class="text-center text-dark mt-3 mb-3"><i class="fa fa-circle-question fa-xl"></i></h1>
                                                        <h2 class="text-center text-dark">Ubah Lembur</h2>
                                                        <form class="d-inline" 
                                                            action="{{ route('overtime.update', $item->id) }}" 
                                                            method="post">
                                                            @csrf
                                                            <div class="form-row px-5 mx-4 mb-3">
                                                                <div class="col-sm-12">
                                                                    <label class="text-dark">Nama Karyawan</label>
                                                                    <input type="text" class="form-control" value="{{ $item->employee->name }}" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-row px-5 mx-4 mb-3">
                                                                <div class="col-sm-12">
                                                                    <label class="text-dark">Total Jam</label>
                                                                    <input type="number" class="form-control" name="hours" min="0" value="{{ $item->hours }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex d-row justify-content-center mb-3">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-warning text-white ml-3">Ubah Lembur</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete -->
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete{{ $item->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="confirmDelete{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h1 class="text-center text-dark mt-3 mb-3"><i class="fa fa-circle-question fa-xl"></i></h1>
                                                        <h2 class="text-center text-dark">Hapus Lembur?</h2>
                                                        <p class="text-center text-secondary">Apakah anda yakin ingin menghapus?</p>
                                                        <div class="d-flex d-row justify-content-center mb-3">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <form class="d-inline ml-3" 
                                                                action="{{ route('overtime.delete', $item->id) }}" 
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Ya, Hapus sekarang!</button>
                                                            </form>
                                                        </div>
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
