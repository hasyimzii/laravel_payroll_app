<!--**********************************
            Sidebar start
        ***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <!-- Admin Sidebar -->
            <li class="nav-label first text-white">Menu</li>

            @if (auth()->user()->hasRole('supervisor'))
            <li>
                <a href="{{ route('payroll.request') }}" aria-expanded="false"><i class="fas fa-file-invoice-dollar"></i>
                    <span class="nav-text">Payroll Request</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}" aria-expanded="false"><i class="fas fa-users"></i>
                    <span class="nav-text">User</span>
                </a>
            </li>
            @elseif (auth()->user()->hasRole('staff'))
            <li>
                <a href="{{ route('employee.index') }}" aria-expanded="false"><i class="fas fa-user-tie"></i>
                    <span class="nav-text">Karyawan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('presence.index') }}" aria-expanded="false"><i class="fas fa-calendar-alt"></i>
                    <span class="nav-text">Presensi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('overtime.index') }}" aria-expanded="false"><i class="fas fa-user-clock"></i>
                    <span class="nav-text">Lembur</span>
                </a>
            </li>
            <li>
                <a href="{{ route('insurance.index') }}" aria-expanded="false"><i class="fas fa-hospital-user"></i>
                    <span class="nav-text">BPJS</span>
                </a>
            </li>
            <li>
                <a href="{{ route('payroll.index') }}" aria-expanded="false"><i class="fas fa-file-invoice-dollar"></i>
                    <span class="nav-text">Payroll</span>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('auth.logout') }}" aria-expanded="false"><i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
            
        </ul>
    </div>

    
</div>
<!--**********************************
            Sidebar end
        ***********************************-->