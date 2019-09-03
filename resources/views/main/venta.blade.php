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
						<input type="text" v-model="bar_code" @keyup.enter="addItem" id="bar_code" class="form-control focus-red" placeholder="Codigo de barras">
					</div>
				</div>
				<div class="col-2">
					<button @click="saveSale" class="btn btn-primary mb-2 focus-red"><i class="fas fa-cash-register fa-2x"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="row m-b-15 justify-content-center" v-show=" total != 0 ">
		<div class="col col-lg-6">
			<ul class="list-group list-group-horizontal">
				<li class="list-group-item">Total: @{{ total }}</li>
				<!-- <li class="list-group-item">Tarjeta: 21321</li> -->
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
					<tr class="tr" v-for="sale in sales">
						<td class="td-bold">$@{{ sale.price }}</td>
						<td>@{{ sale.name }}</td>
						<td>@{{ sale.stock }}</td>
						<td class="delete-sale"><a href="#" @click.prevent="removeSale(sale)" class="btn btn-danger"><i class="fas fa-trash fa-lg"></i></a></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
new Vue({
	el: '#venta',
	created: function() {
		this.getBarCodes();
	},
	data: {
		sales: [],
		ids_articles: [],
		codigos_barras_disponibles: [],
		total: 0,
		bar_code: '',
	},
	methods: {
		removeSale: function(article) {
			axios.get('sales/remove-item/' + article.id)
			.then( response => {
				let index = this.ids_articles.indexOf(article.id);
				this.ids_articles.splice(index, 1);
		        this.sales.filter(function (producto, i) {
		            if (producto.id === article.id) {
		                index = i;
		            }
		        });
		        this.sales.splice(index, 1);
		        this.total -= article.price;
				toastr.success("Se elimino la venta de " + article.name);
			})
			.catch( error => {
				console.log(error.response);
			});
		},
		getBarCodes: function() {
			axios.get('bar-codes')
			.then( response => {
				this.codigos_barras_disponibles = response.data;
			})
			.catch( error => {
				console.log(error.response);
			});
		},
		deleteSale: function(article){
			if(confirm('Seguro que quiere eliminar la venta de ' + article.name + '?')){
				axios.delete('sales/article/' + article.id)
				.then( response => {
					let index = this.id_articles.indexOf(article.id);
					this.ids_articles.splice(index, 1);
			        this.sales.filter(function (producto, i) {
			            if (producto.id === article.id) {
			                index = i;
			            }
			        });
			        this.sales.splice(index, 1);
			        this.total -= article.price;
					toastr.success("Se elimino la venta de " + article.name);
				}).catch( error => {
					console.log(error.response);
				});
			}
		},
		addItem: function() {
			if(this.bar_code!=''){
				if(this.codigos_barras_disponibles.includes(this.bar_code)){
					axios.get('sales/add-item/' + this.bar_code)
					.then( response => {
						let article = response.data;
						this.sales.push({
							'id'			: article.id,
							'bar_code' 		: article.bar_code,
							'name' 			: article.name,
							'price' 		: article.price,
							'stock' 		: article.stock,
						});
						this.ids_articles.push(article.id);
						this.total += article.price;
						this.bar_code = '';
					})
					.catch( error => {
						console.log(error.response);
					});
				}else{
					toastr.error('Ingrese un codigo de barras disponible');
					this.bar_code = '';
				}
			}
		},
		saveSale: function(){
			axios.post('sales', {
				ids_articles : this.ids_articles
			})
			.then( response => {
				this.sales = [];
				this.id_articles = [];
				this.total = 0;
				// toastr.success('Venta realizada con exito');
			})
			.catch( error => {
				console.log(error.response);
			});
		}
	}
});
</script>
@endsection
