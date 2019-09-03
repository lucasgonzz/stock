@extends('app.app')

@section('content')
<div id="generar-codigos">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card m-t-40">
				<div class="card-header">
					Crear Codigo de barras
				</div>
				<div class="card-body">
					<div class="form-row m-b-10">
						<div class="col">
							<input type="text" class="form-control" v-model="codigo" placeholder="Codigo a generar">
						</div>
						<div class="col">
							<button class="btn btn-primary" @click="generarCodigo()">Generar codigo</button>
						</div>
					</div>
					<img src="generar-codigo/prueba" alt="" id="imagen-codigo">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
new Vue({
	el: "#generar-codigos",
	data: {
		codigo: '',
	},
	methods: {
		generarCodigo: function(){
			$('#imagen-codigo').attr('src', 'generar-codigo/' + this.codigo);
		}
	}
});
</script>
@endsection