@extends('layouts.app')

@section('title')
    @yield('title')
@endsection

@section('body')
<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="{{ route('index') }}" class="brand-logo">
            <!-- <img class="logo-abbr" src="{{ asset('assets/img/logo/himasif2020.png') }}" width="50" alt=""> -->
            <h3 class="logo-abbr my-auto mr-0 text-white">P</h3>
            <h3 class="brand-title my-auto ml-0 text-white">ayroll</h3>
        </a>
        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!-- SIDEBAR -->
    @include('layouts.sidebar')


    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <div class="container-fluid">

            <!-- CONTENT -->
            @yield('content')

        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    <!--**********************************
        Footer start
    ***********************************-->
    <div class="footer">
        <div class="copyright fw-normal">
            Copyright &copy; {{ date('Y') }}. All rights reserved </span><a class="nav-link-dark" href="https://github.com/hasyimzii" target="_blank" rel="noopener">Hasyim</a></p>
        </div>
    </div>
    <!--**********************************
        Footer end
    ***********************************-->
</div>
@endsection