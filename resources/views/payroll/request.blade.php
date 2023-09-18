@extends('layouts.body')

@section('title', 'Daftar Payroll')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Payroll</li>
    </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Daftar Payroll</h4>
        </div>
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
                                <th>Total Payroll</th>
                                <th>Staff User</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payroll as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->payroll_date)->isoFormat('ddd, DD MMM YYYY') }}</td>
                                    <td>{{ $item->employee->name }}</td>
                                    <td>Rp {{ number_format($item->totalPayroll()) }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    @switch ($item->status)
                                        @case ('approved')
                                        <td><span class="badge badge-success">Approved</span></td>
                                        @break
                                        @case ('draft')
                                        <td><span class="badge badge-warning">Draft</span></td>
                                        @break
                                    @endswitch
                                    <td>
                                        <!-- Show -->
                                        <a href="{{ route('payroll.showRequest', $item->id) }}"
                                            class="btn btn-info">
                                                <i class="fa fa-eye text-white"></i>
                                        </a>
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
