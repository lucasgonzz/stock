@extends('app.app')
@section('content')
	<div id="resumen-ventas" class="m-t-30">
		<div class="row justify-content-center">
			<div class="col col-lg-8">
				<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
					<li class="nav-item m-l-0">
						<a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#nav-hoy" role="tab" aria-controls="pills-home" aria-selected="true" @click="getSales">Todas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-morning-tab" data-toggle="pill" href="#nav-hoy" role="tab" aria-controls="pills-profile" aria-selected="false" @click="getSalesMorning">De mañana</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-afternoon-tab" data-toggle="pill" href="#nav-hoy" role="tab" aria-controls="pills-contact" aria-selected="false" @click="getSalesAfternoon">De tarde</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#nav-desde-una-fecha" role="tab" aria-controls="pills-contact" aria-selected="false">Desde una fecha</a>
					</li>
				</ul>
			</div>
		</div>
		@include('includes.resumen-ventas-info')
		<!-- <hr style="background-color: #A8A8A8"> -->
		@include('includes.resumen-ventas-show-sales')		
		@include('modals.lastSales')
	</div>
@endsection

@section('scripts')
<script>
	new Vue({
	el: "#resumen-ventas",
	created: function(){
		this.getSales();
	},
	data: {
		sales: [],
		mostrar: 'ventas-hoy',
		total: 0,
		lastSales: [],
		mostrar: 0,
		ventas_cont: 0,

		// Desde una fecha
		desde: '',
		hasta: '',
		busqueda_por_fecha: false,
		ultima_fecha: '',

		// Mostrar ventas anteriores
		sale: {},
		article: {},
	},
	methods: {
		deleteSale: function(sale){
			axios.delete('sales/' + sale.id)
			.then( response => {
				this.getSales();
				toastr.success('Se elimino la venta');
			})
			.catch( error => {
				console.log(error.response);
			})
		},
		deleteArticle: function(sale_id, article) {
			axios.delete('sales/article/' + sale_id + '/' + article.id)
			.then( response => {
				this.getSales();
				toastr.success('Se elimino el articulo ' + article.name + ' de la venta');
			})
			.catch( error => {
				console.log(error.response);
			})
		},
		showLastSales: function(article){
			this.article = article;
			this.lastSales = article.sales;
			$('#last-sales').modal('show');
		},
		salesFrom: function() {
			axios.post('sales/from-date', {
				desde : this.desde,
				hasta : this.hasta,
			})
			.then( response => {
				console.log(response.data);
				this.sales = response.data;
				this.calcular_total_cantidad_ventas(this.sales);

				// Se actualiza busqueda-por-fecha para que se muestren
				// los dias (columnas grises) en la tabla
				this.busqueda_por_fecha = true;
			}).catch( error => {
				console.log(error.response);
			});
		},
		getSales: function(){
			axios.get('sales/today')
			.then( response => { 
				this.sales = response.data;
				this.calcular_total_cantidad_ventas(this.sales);
			})
			.catch( error => {
				console.log(error.response);
				location.reload();
			})
		},
		getSalesMorning: function(){
			axios.get('sales/morning')
			.then( response => {
				this.sales = response.data;
				this.calcular_total_cantidad_ventas(this.sales);
			})
			.catch( error => {
				console.log(error.response);
			})
		},
		getSalesAfternoon: function(){
			axios.get('sales/afternoon')
			.then( response => {
				console.log(response.data);
				this.sales = response.data;
				this.calcular_total_cantidad_ventas(this.sales);
			})
			.catch( error => {
				console.log(error.response);
			})
		},
		calcular_total_cantidad_ventas: function(sales) {
			this.total = 0;
			this.ventas_cont = 0;
			for(let i in sales){
				for(let j in sales[i].articles){
					this.total += sales[i].articles[j].price;
					this.ventas_cont ++;
				}
			}
		}
	}
});

</script>
@endsection
