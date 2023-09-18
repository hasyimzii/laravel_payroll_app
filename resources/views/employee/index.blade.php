@extends('layouts.body')

@section('title', 'Daftar Karyawan')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Karyawan</li>
    </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Daftar Karyawan</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('employee.create') }}">
            <button type="button" class="btn btn-success">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Karyawan
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
                                        <!-- Show -->
                                        <a href="{{ route('employee.show', $item->id) }}"
                                            class="btn btn-info">
                                                <i class="fa fa-eye text-white"></i>
                                        </a>
                                        <!-- Update -->
                                        <a href="{{ route('employee.edit', $item->id) }}"
                                            class="btn btn-warning">
                                                <i class="fa fa-pencil text-white"></i>
                                        </a>
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
                                                        <h2 class="text-center text-dark">Hapus Karyawan?</h2>
                                                        <p class="text-center text-secondary">Apakah anda yakin ingin menghapus?</p>
                                                        <div class="d-flex d-row justify-content-center mb-3">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <form class="d-inline ml-3" 
                                                                action="{{ route('employee.delete', $item->id) }}" 
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