<div data-simplebar class="h-100">
	<br>
{{-- <hr style="margin-top: 1cm; background-color: white"> --}}
	<!--- Sidemenu -->
	<div id="sidebar-menu">
		<!-- Left Menu Start -->
		<ul class="metismenu list-unstyled" id="side-menu">
			<li class="menu-title" key="t-menu">Menu</li>

			<li>
				<a href="{{ route('customer') }}" class="waves-effect">
					<i class="bx bxs-home"></i>
					<span key="t-dashboards">Kelola Customer</span>
				</a>
			</li>

			<li>
				<a href="{{ route('produk') }}" class="waves-effect">
					<i class="bx bx-user-circle"></i>
					<span key="t-dashboards">Kelola Product</span>
				</a>
			</li>

			<li>
				<a href="{{ route('order') }}" class="waves-effect">
					<i class="bx bx-user-voice"></i>
					<span key="t-dashboards">Order</span>
				</a>
			</li>

		</ul>
	</div>
	<!-- Sidebar -->
</div>
