@extends('app.app')
@section('content')
<div class="cont m-t-30">
    <div id="ingresar">
		<div class="row justify-content-center">
			<div class="col-12 col-md-5">	
				<form>
					{{ csrf_field() }}
					<div class="form-group">
						<label for="barCode">Codigo de Barras</label>
						<input type="text" id="barCode" name="barCode" class="form-control focus-red" v-model="barCode" autofocus="true" @keyup.enter="isRegister">
					</div>
					<div class="row m-b-5">
						<div class="col">
							<label for="cost">Costo</label>
							<input type="text" v-model="cost" class="form-control focus-red">
						</div>
						<div class="col">
							<label for="price">Precio</label>
							<input type="text" v-model="price" class="form-control focus-red">
						</div>
					</div>
					<div class="form-group">
						<label for="name">Nombre</label>
						<input type="text" v-model="name" class="form-control focus-red">
					</div>
					<div class="form-group">
						<label for="created_at">Fecha</label>
						<input type="date" v-model="created_at" class="form-control focus-red">
					</div>
					<div class="row m-b-15">
						<div class="col">
							<label for="mayorista">Proveedores</label>
							<select v-model="providers_selected" class="form-control focus-red" multiple>
								<option v-for="provider in providers" :value="provider.id">@{{ provider.name }}</option>
							</select>
							<a href="#" @click.prevent="addProvider">Añadir proovedor</a>
						</div>
						<div class="col">
							<label for="stock">Cantidad</label>
							<input type="text" v-model="stock" class="form-control focus-red">
						</div>
					</div>
					<div class="form-group">
						<button type="button" @click="saveArticle" class="btn btn-primary btn-lg btn-block focus-red">Guardar</button>
					</div> 
				</form>		
			</div>
		</div>
		@include('modals.addProvider')
		@include('modals.editArticle')
    </div>
</div>
@endsection

@section('scripts')
<script>

$("#barCode").focus();
new Vue({
	el: '#ingresar',
	created: function() {
		this.getProviders();
		this.getBarCodes();
	},
	data: {
		// Lista de proovedores
		providers: [],

		// Nombre de proovedor para añadir
		provider: '',

		// En caso de que ya este registrado
		article: {'id': '', 'act_fecha': true, 'name': '', 'cost': '', 'price': '', 'previus_price': '', 'stock': '', 'providers': [], 'bar_code': ''},


		// Formulario para añadir
		barCode: '',
		cost: '',
		price: '',
		name: '',
		created_at:  new Date().toISOString().slice(0,10),
		providers_selected: [],
		stock: '',

		codigos_barras_disponibles: [],
	},
	methods: {
		getBarCodes: function() {
			axios.get('bar-codes')
			.then( response => {
				// console.log(response.data);
				this.codigos_barras_disponibles = response.data;
			})
			.catch( error => {
				// console.log(error.response);
				location.reload();
			});
		},
		isRegister: function(){
			if(this.codigos_barras_disponibles.includes(this.barCode)){
				console.log('Entro');
				axios.get('articles/' + this.barCode)
				.then( response => {
					let article = response.data;
					this.article.id = article.id;
					this.article.creado = article.creado + ' hace ' + article.created_diff;
					this.article.actualizado = article.actualizado + ' hace ' + article.updated_diff;
					this.article.codigo_barras = article.codigo_barras;
					this.article.name = article.name;
					this.article.cost = article.cost;
					this.article.price = article.price;
					this.article.stock = article.stock;
					this.article.mayorista = article.mayorista;
					$("#editArticle").modal('show');
					// $("#costo").focus();
				})
				.catch( error => {
					console.log(error.response);
				});	
			}
		},
		updateArticle: function(){
			axios.put('articles/'+this.article.id, this.article)
			.then( response => {
				$('#editArticle').modal('hide');
				toastr.success(this.article.name + ' se actualizo con exito');
				this.article = {'id': '', 'act_fecha': true, 'name': '', 'cost': '', 'price': '', 'stock': '', 'providers': [], 'bar_code': ''};
				this.barCode = '';
				$('#barCode').focus();
			})
			.catch( error => {
				console.log(error.response);
			});
		},
		saveArticle: function() {
			axios.post('articles', {
				bar_code: this.barCode,
				name: this.name,
				cost: this.cost,
				price: this.price,
				created_at: this.created_at,
				providers: this.providers_selected,
				stock: this.stock,
			})
			.then( response => {
				toastr.success('Articulo guardado correctamente');
				this.barCode = '',
				this.name = '',
				this.cost = '',
				this.price = '',
				this.providers_selected = [],
				this.stock = '',
				$("#barCode").focus();
			})
			.catch( error => {
				console.log(error.response);
			})
		},
		getProviders: function() {
			axios.get('providers')
			.then( response => {
				// console.log(response.data);
				this.providers = response.data;
			})
			.catch( error => {
				location.reload();
			})
		},
		addProvider: function() {
			$('#add-provider').modal('show');
		},
		saveProvider: function() {
			axios.post('providers', {
				name: this.provider
			})
			.then( response => {
				this.getProviders();
				$('#add-provider').modal('hide');
				toastr.success('Proveedor añadido correctamente');
			})
			.catch( error => {
				console.log(error.response);
			})
		}
	}
});

</script>
@endsection
