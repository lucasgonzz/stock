<nav class="navbar navbar-expand-lg bg-dark">
	<button class="navbar-toggler btn-menu" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<i class="fas fa-bars fa-lg"></i>
	</button>
	<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item active">
				<a class="nav-link {{ active('venta') }}" href="{{ route('venta') }}"><i class="fas fa-tags fa-xs m-r-5"></i>Venta</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link {{ active('ingresar') }}" href="{{ route('ingresar') }}"><i class="fas fa-external-link-alt fa-xs m-r-5"></i>Ingresar</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link {{ active('lista-precios') }}" href="{{ route('lista-precios') }}"><i class="fas fa-list-ol m-r-5"></i>Lista de precios</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link {{ active('resumen-ventas') }}" href="{{ route('resumen-ventas') }}"><i class="fas fa-key m-r-5 fa-xs"></i>Resumen de ventas</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link {{ active('resumen-ventas') }}" href="{{ route('resumen-ventas') }}"><i class="fas fa-sign-out-alt m-r-5"></i>Salir</a>
			</li>
		</ul>
	</div>
</nav>