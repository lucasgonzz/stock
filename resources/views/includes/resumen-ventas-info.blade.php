<div class="row m-b-10 justify-content-between">
	<div class="col-12 col-lg-8 offset-lg-2 align-self-center">
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="nav-hoy" role="tabpanel" aria-labelledby="nav-hoy-tab">
				<ul class="list-group list-group-horizontal" v-if="total>0">
					<li class="list-group-item">@{{ sales.length }} ventas</li>
					<li class="list-group-item">@{{ ventas_cont }} articulos vendidos</li>
					<li class="list-group-item">Resumen: $@{{ total }}</li>
				</ul>
				<p v-else>
					No se han realizado ventas aún
				</p>
			</div>
			<div class="tab-pane fade" id="nav-desde-una-fecha" role="tabpanel" aria-labelledby="nav-desde-una-fecha-tab">
				<form class="form-inline" @submit.prevent="salesFrom">
					<div class="form-group">
						<label for="desde">Desde</label>
						<input v-model="desde" type="date" id="desde" class="form-control mx-sm-3">
					</div>
					<div class="form-group">
						<label for="hasta">Hasta</label>
						<input v-model="hasta" type="date" id="hasta" class="form-control mx-sm-3">
					</div>
					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
			</div>
		</div>
	</div>
	<!-- <div class="col-12 col-lg-3 offset-lg-">
		<p class="h5">Ver</p>
		<div class="form-check form-check-inline">
			<b-radio type="radio" v-model="mostrar" name="solo-ventas" native-value="0" id="solo-ventas">Solo las ventas</b-radio>
		</div>
		<div class="form-check form-check-inline">
			<b-radio type="radio" v-model="mostrar" name="ventas-con-articulos" native-value="1" id="ventas-con-articulos">Las ventas y sus articulos</b-radio>
		</div>
	</div> -->
</div>