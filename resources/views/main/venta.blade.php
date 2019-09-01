@extends('app.app')
@section('content')
<div id="venta" class="p-t-20">
	<div class="row justify-content-center m-b-15">
		<div class="col-12 col-lg-6">
			<div class="form-row align-items-center">
				<div class="col-10">
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-barcode"></i></div>
						</div>
						<input type="text" id="codigo_barras" class="form-control focus-red" placeholder="Codigo de barras">
					</div>
				</div>
				<div class="col-2">
					<button class="btn btn-primary mb-2 focus-red"><i class="fas fa-cash-register fa-2x"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="row m-b-15 justify-content-center" v-show=" total != 0 ">
		<div class="col col-lg-6">
			<ul class="list-group list-group-horizontal">
				<li class="list-group-item">total: 1231</li>
				<li class="list-group-item">Tarjeta: 21321</li>
			</ul>
		</div>
	</div>
	<div class="row" v-show=" total != 0 ">
		<div class="col col-lg-4 offset-lg-3">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Precio</th>
						<th scope="col">Nombre</th>
						<th scope="col">Quedan</th>
					</tr>
				</thead>
				<tbody>
					<tr class="tr" v-for="venta in ventas">
						<td class="td-bold">$300</td>
						<td>sadasds</td>
						<td>sadasds</td>
						<td class="delete-sale"><a href="#" class="btn btn-danger"><i class="fas fa-trash fa-lg"></i></a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
