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
						<input type="text" id="barCode" name="barCode" class="form-control focus-red" v-model="barCode" autofocus="true">
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
	},
	data: {
		// Lista de proovedores
		providers: [],

		// Nombre de proovedor para añadir
		provider: '',

		// Formulario para añadir
		barCode: '',
		cost: '',
		price: '',
		name: '',
		created_at:  new Date().toISOString().slice(0,10),
		providers_selected: [],
		stock: '',
	},
	methods: {
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
				console.log(response.data);
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
