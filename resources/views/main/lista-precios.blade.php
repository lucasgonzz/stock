@extends('app.app')
@section('content')
<div id="lista-precios">
	<div class="row justify-content-center m-t-20">
		<div class="col col-lg-10">
			@include('includes.lista-precios-nav')
			<hr class="m-t-5 m-b-5">
		</div>
	</div>
	
	<div class="row justify-content-center m-t-10 p-r">
		<div class="col col-lg-10">
		@if($agent->isMobile())
			@include('main.includes.articleComponent')
		@else
			<table id="table-articles" class="table table-striped table-hover table-sm m-t-20">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Codigo</th>
						<th scope="col">Ingreso</th>
						<th scope="col">Nombre</th>
						<th scope="col">Proovedores</th>
						<th class="col-precio">Precio</th>
						<th scope="col">Costo</th>
						<th scope="col">Ult. Act</th>
						<th scope="col">Precio anterior</th>
						<th scope="col">Stock</th>
						<th scope="col" colspan="3" class="text-center">Opciones</th>
					</tr>
				</thead>
				<tbody>						
					<tr v-for="article in articles" v-bind:class="article.style">
						<td>@{{ article.bar_code }}</td>
						<td>@{{ article.creado }}</td>
						<td>@{{ article.name }}</td>
						<td>
							<span v-for="provider in article.providers">
								@{{ provider.name }}
							</span>
						</td>
						<td class="precio">$@{{ article.price }}</td>
						<td>@{{ article.cost }}</td>
						<td>@{{ article.actualizado }}</td>
						<td>$@{{ article.previus_price != 0 ? article.previus_price : ''}}</td>
						<td>@{{ article.stock }}</td>
						<td><a href="#" v-if="article.sales.length" class="btn btn-primary" v-on:click.prevent="showLastSales(article)"><i class="fas fa-shopping-cart m-r-5"></i>Ventas</a></td>
						<td><a href="#" class="btn btn-primary" v-on:click.prevent="editArticle(article)"><i class="far fa-edit m-r-5"></i>Actualizar</a></td>
						<td><a href="#" class="btn btn-danger" v-on:click.prevent="deleteArticle(article)"><i class="fas fa-trash m-r-5"></i>Borrar</a></td>
					</tr>
				</tbody>
			</table>
		@endif
			
		</div>
		<div class="spinner-border text-primary" id="load-table" role="status">
		  	<span class="sr-only">Cargando...</span>
		</div>
	</div>
	<div v-show="current_page != 0">
		@include('includes.pagination')
	</div>
	
	@include('modals.editArticle')
	@include('modals.lastSales')
</div>
@endsection

@section('scripts')
<script>
$('#load-table').hide();

new Vue({
	el: "#lista-precios",
	created: function(){
		this.getArticles(1);
		this.getProviders();
	},
	data: {
		// Providers
		providers: [],

		// Articles
		articles: [],
		// article: {},
		article: {'id': '', 'act_fecha': true, 'name': '', 'cost': '', 'price': '', 'previus_price': '', 'stock': '', 'providers': [], 'bar_code': ''},

		// Campos de formulario de buscar
		busqueda: '',

		// Campos de formulario de filtrado
		buscar: false,
		filtrar: 'no',
		filtro: 0,
		orden: 0,
		min: '',
		max: '',
		providers_selected: [],
		perPage: 15,

		// Pagination
		current_page: 0,
		pagination: {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page' : 0,
            'from' : 0,
            'to' : 0,
		},
		offset: 2,

		// Modal ventas anteriores
		lastSales: [],
	},
	computed: {
		isActived: function(){
			return this.pagination.current_page;
		},
		pagesNumber: function(){

			if(!this.pagination.to){
				return [];
			}

			var from = this.pagination.current_page - this.offset;
			
			if(from < 1){
				from = 1;
			}

			var to = from + (2 * this.offset);
			if(to >= this.pagination.last_page){
				to = this.pagination.last_page;
			}

			var pagesArray = [];
			while(from <= to){
				pagesArray.push(from);
				from++;
			}
			return pagesArray;
		}
	},
	methods: {
		getArticles: function(page){ 
			this.current_page = this.perPage;
			if(this.current_page != 0){
				axios.post('articles/index?page=' + page, {
					filtrar : this.filtrar,
					filtro : this.filtro,
					providers: this.providers_selected,
					orden : this.orden,
					min : this.min,
					max : this.max,
					perPage : this.perPage,
				})
				.then( response => {
					console.log(response.data);
					this.articles = response.data.articles.data;
					this.pagination = response.data.pagination;
					window.scrollTo(0, 500);
				})
				.catch( function(error) {
					console.log(error.response);
				});
			}else{
				$('#load-table').show();
				console.log('sin paginacion: ' + this.filtrar);
				axios.post('articles/index', {
					filtrar : this.filtrar,
					filtro : this.filtro,
					providers: this.providers_selected,
					orden : this.orden,
					min : this.min,
					max : this.max,
					perPage : this.perPage,
				})
				.then( response => {
					console.log(response.data);
					this.articles = response.data;
					window.scrollTo(0, 4000);
				})
				.catch( function(error) {
					console.log(error.response);
				})
				.then(function(){
					$('#load-table').hide();
				});
			}
		},
		search: function(){
			$('#load-table').show();
			axios.get('articles/search/' + this.busqueda)
			.then( response => {
				this.articles = response.data;
				this.current_page = 0;
				let table = $("#table-articles").offset();
				let top = table.top;
				window.scrollTo(0, top);
			})
			.catch( error => {
				console.log(error.response);
			})
			.then(function(){
				$('#load-table').hide();
			});
		},
		changePage: function(page){
			this.pagination.current_page = page;
			this.getArticles(page);
		},
		getProviders: function(){
			axios.get('providers').then( response => {
				this.providers = response.data;
			}).catch( error => {
				location.reload();
			});
		},
		showLastSales: function(article){
			this.article = article;
			this.lastSales = article.sales;
			$('#last-sales').modal('show');
		},
		deleteArticle: function(articulo){
			if(confirm('Seguro que quieres eliminar ' + articulo.name + "?")){
				axios.delete('articles/'+articulo.id).then( response => {
					this.getArticles();
					toastr.success('Se elimino con exito ' + articulo.name);
				}).catch( error => {
					console.log(error.response);
				});
			}
		},
		updateArticle: function(){
			axios.put('articles/'+this.article.id, this.article)
			.then( response => {
				this.getArticles();
				$('#editArticle').modal('hide');
				this.article = {'id': '', 'act_fecha': true, 'name': '', 'cost': '', 'price': '', 'stock': '', 'providers': [], 'bar_code': ''};
				toastr.success(this.article.name + ' se actualizo con exito');
				// this.article = {};
			})
			.catch( error => {
				console.log(error.response);
			});
		},
		editArticle: function(article){
			this.article.id = article.id;
			this.article.creado = article.creado;
			this.article.actualizado = article.actualizado;
			this.article.bar_code = article.bar_code;
			this.article.name = article.name;
			this.article.cost = article.cost;
			this.article.price = article.price;
			this.article.stock = article.stock;
			for(let i in article.providers) {
				this.article.providers.push(article.providers[i].id);
			}

			// this.article.providers = article.providers;
			$("#editArticle").modal('show');
		}
	}
});

</script>

@endsection
