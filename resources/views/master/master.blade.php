<!DOCTYPE html>
<html lang="en">
@include('master.head')
<body data-sidebar="dark" >
	<div id="loading">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>
	<!-- Begin page -->
	<div id="layout-wrapper">

		<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('logo/berkatsoft.png') }}" style="margin-top: 30px" alt="" height="10">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('logo/berkatsoft.png') }}" style="margin-top: 30px" alt="" height="40">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>
            {{-- {{ dd(session()->get('nama')) }} --}}
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('undraw/undraw_male_avatar_323b.svg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ml-1" key="t-henry">{{ session()->get('nama') }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    {{-- <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> <span key="t-profile">Profile</span></a>
                    <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> <span key="t-my-wallet">My Wallet</span></a>
                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> <span key="t-settings">Settings</span></a>
                    <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> <span key="t-lock-screen">Lock screen</span></a>
                    <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                </div>
            </div>

        </div>
    </div>
</header>
	<!-- ========== Left Sidebar Start ========== -->
	<div class="vertical-menu">
		@include('master.menu')
	</div>
	<!-- Left Sidebar End -->

	<!-- ============================================================== -->
	<!-- Start right Content here -->
	<!-- ============================================================== -->
	<div class="main-content">
		@yield('content')
		<footer class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<script>document.write(new Date().getFullYear())</script> © Berkatsoft
					</div>
					<div class="col-sm-6">
						<div class="text-sm-right d-none d-sm-block">
							Development
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- end main content-->

</div>

<div class="rightbar-overlay"></div>
@yield('script')
@include('master.script')
</body>

</html>
