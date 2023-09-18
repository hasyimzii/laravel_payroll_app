<!DOCTYPE html>
<html>
<head>
	<title>Struk Payroll PDF</title>
	
    <style type="text/css">
		body {
			font-size: 12pt;
            font-family: Arial, Helvetica, sans-serif;
		}
        table {
            width: 100%;
            border: 1px solid;
        }
        td {
            padding: 10px;
        }
        tr:nth-child(even) {
            background-color: #eeeeee;
        }
        .badge {
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 10pt;
            font-weight: bold;
        }
        .badge-primary {
            background-color: #0d6efd;
        }
        .badge-success {
            background-color: #198754;
        }
        .badge-warning {
            background-color: #fd7e14;
        }
	</style>
</head>
<body>
	<center>
		<h3>Struk Payroll</h3>
	</center>

    <table class='table table-bordered'>
        <tbody>
        <!-- Employee Detail -->
        <tr>
            <td>Nama Karyawan</td>
            <td>{{ $payroll->employee->name }}</td>
    </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>{{ $payroll->employee->birth_place }}, {{ \Carbon\Carbon::parse($payroll->employee->birth_date)->isoFormat('DD MMM YYYY') }}</td>
    </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>{{ ($payroll->employee->gender == 'male') ? 'Laki-Laki' : 'Perempuan' }}</td>
    </tr>
        <tr>
            <td>Jabatan</td>
            <td>{{ $payroll->employee->position }}</td>
    </tr>
        <tr>
            <td>Status</td>
            @switch ($payroll->employee->status)
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
    </tr>
        <tr>
            <td>Tanggal Mulai Kerja</td>
            <td>{{ \Carbon\Carbon::parse($payroll->employee->start_date)->isoFormat('ddd, DD MMM YYYY') }}</td>
    </tr>
        <!-- Payroll Section -->
        <tr>
            <td>Gaji Pokok</td>
            <td>Rp {{ number_format($payroll->basic_salary) }}</td>
    </tr>
        <tr>
            <td>Tunjangan Tetap</td>
            <td>Rp {{ number_format($payroll->allowance) }}</td>
    </tr>
        <tr>
            <td>Insentif</td>
            <td>Rp {{ number_format($payroll->incentive) }}</td>
    </tr>
        <tr>
            <td>Lembur</td>
            <td>Rp {{ number_format($payroll->overtime) }}</td>
    </tr>
        <tr>
            <td>NWNP (No Work No Pay)</td>
            <td>Rp {{ number_format($payroll->nwnp) }}</td>
    </tr>
        <tr>
            <td>BPJS</td>
            <td>Rp {{ number_format($payroll->insurance) }}</td>
    </tr>
        <tr>
            <td><b>Total Payroll:</b></td>
            <td><b>Rp {{ number_format($payroll->totalPayroll()) }}</b></td>
    </tr>
        <tr>
            <td>Staff User</td>
            <td>{{ $payroll->user->name }}</td>
    </tr>
        <tr>
            <td>Status</td>
            @switch ($payroll->status)
                @case ('approved')
                <td><span class="badge badge-success">Approved</span></td>
                @break
                @case ('draft')
                <td><span class="badge badge-warning">Draft</span></td>
                @break
            @endswitch
    </tr>
        <tr>
            <td>Tanggal Payroll</td>
            <td>{{ \Carbon\Carbon::parse($payroll->payroll_date)->isoFormat('ddd, DD MMM YYYY') }}</td>
        </tr>
        </tbody>
    </table>
</body>
</html>