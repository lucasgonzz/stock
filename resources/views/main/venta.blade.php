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
						<input type="text" id="codigo_barras" class="form-control focus-red" v-model="codigo_barras" placeholder="Codigo de barras" @keyup.enter="addItem">
					</div>
				</div>
				<div class="col-2">
					<button class="btn btn-primary mb-2 focus-red" @click="nuevaVenta">Venta</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row m-b-15 justify-content-center" v-show=" total != 0 ">
		<div class="col col-lg-6">
			<ul class="list-group list-group-horizontal">
				<li class="list-group-item">total: $@{{ total }}</li>
				<li class="list-group-item">Tarjeta: $@{{ total + (total/100*18) }}</li>
			</ul>
		</div>
	</div>
	<div class="row justify-content-center" v-show=" total != 0 ">
		<div class="col col-lg-6">
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Nombre</th>
						<th scope="col">Precio</th>
						<th scope="col">Quedan</th>
					</tr>
				</thead>
				<tbody>
					<tr class="tr" v-for="venta in ventas">
						<td>@{{ venta.name }}</td>
						<td>$@{{ venta.price }}</td>
						<td>@{{ venta.stock }}</td>
						<td class="delete-sale" @click="deleteSale(venta)"><i class="fas fa-trash fa-lg"></i></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
$("#codigo_barras").focus();

new Vue({
	el: "#venta",
	created: function(){
		this.cargarCodigosDisponibles();
	},
	data: {
		ventas: [],
		id_articles: [],
		codigo_barras: '',
		codigos_barras_disponibles: [],
		total: 0,
	},
	methods: {
		deleteSale: function(article){
			if(confirm('Seguro que quiere eliminar la venta de ' + article.name + '?')){
				axios.delete('sales/article/' + article.id)
				.then( response => {
					let index = this.id_articles.indexOf(article.id);
					this.id_articles.splice(index, 1);

			        this.ventas.filter(function (producto, i) {
			            if (producto.id === article.id) {
			                index = i;
			            }
			        });

			        this.ventas.splice(index, 1);
			        this.total -= article.price;
					toastr.success("Se elimino la venta de " + article.name);
				}).catch( error => {
					console.log(error.response.data);
				});
			}
		},
		addItem: function() {
			if(this.codigo_barras!=''){
				if(this.codigos_barras_disponibles.includes(this.codigo_barras)){
					axios.get('sales/addItem/' + this.codigo_barras)
					.then( response => {
						let article = response.data;
						this.ventas.push({
							'id'			: article.id,
							'codigo_barras' : this.codigo_barras,
							'name' 			: article.name,
							'price' 		: article.price,
							'stock' 		: article.stock,
						});
						this.id_articles.push(article.id);
						this.total += article.price;
						this.codigo_barras = '';
					})
					.catch( error => {
						console.log(error.response.data);
					});
				}else{
					toastr.error('Ingrese un codigo de barras disponible');
					this.codigo_barras = '';
				}
			}
		},
		nuevaVenta: function(){
			axios.post('sales', {
				ventas : this.id_articles
			})
			.then( response => {
				this.ventas = [];
				this.id_articles = [];
				this.total = 0;
				alert("asd");
				console.log("anda");
				// toastr.success('Venta realizada con exito');
			})
			.catch( error => {
				console.log(error.response);
			});
		},
		cargarCodigosDisponibles: function(){
			axios.get('cargar-codigos-barras')
			.then( response => {
				this.codigos_barras_disponibles = response.data;
				$('#codigo_barras').focus();
			})
			.catch( error => {
				location.reload();
			});
		},
	}
});
</script>
@endsection