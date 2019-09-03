<div class="row">
	<div class="col">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link c-g active nav-lg" id="buscar-tab" data-toggle="tab" href="#buscar" role="tab" aria-controls="profile" aria-selected="false">Buscar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link c-g nav-lg" id="filtrar-tab" data-toggle="tab" href="#filtrar" role="tab" aria-controls="filtrar" aria-selected="true">Filtrar</a>
			</li>
		</ul>

		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="buscar" role="tabpanel" aria-labelledby="buscar-tab">
				<form>
					<div class="form-row m-t-20">
						<div class="col-12 col-lg-3">
							<input type="text" v-model="busqueda" id="buscar-nombre" class="form-control" placeholder="Nombre o Codigo">
						</div>
						<div class="col-12 col-lg-3 align-self-end">
							<button class="btn btn-primary d-none d-lg-block" v-on:click.prevent="search()"><i class="fas fa-search m-r-10"></i>Buscar</button>
							<button class="btn btn-primary btn-lg btn-block d-lg-none m-t-10" v-on:click.prevent="search()">Buscar</button>
						</div>
					</div>						
				</form>
			</div>
			<div class="tab-pane fade m-t-20" id="filtrar" role="tabpanel" aria-labelledby="filtrar-tab">
				<form>
					<div class="form-row align-items-start">
						<div class="col-12 m-b-20 m-lg-b-0 col-lg-3">
							<div class="form-check form-check-inline">
								<b-radio type="radio" v-model="filtrar" name="filtrar" native-value="no" id="mostrar-todos">Mostrar todos los artículos</b-radio>
							</div>
							<div class="form-check form-check-inline">
								<b-radio type="radio" v-model="filtrar" name="filtrar" native-value="si" id="mostrar-lo-que">Mostrar lo que</b-radio>
							</div>
							<div v-show="filtrar == 'si'" class="m-t-10">
								<select v-model="filtro" name="filto" id="filtro" class="form-control">
									<option value="0">Tengan 1 en stock</option>
									<option value="1">No tengan stock</option>
									<option value="2">Esten desactualizados</option>
								</select>
							</div>
						</div>
						<div class="col-12 m-b-20 m-lg-b-0 col-lg-2">
							<label for="orden">Ordenar por</label>
							<select v-model="orden" name=orden" id="orden" class="form-control">
								<option value="0">Mas nuevos</option>
								<option value="1">Mas viejos</option>
								<option value="2">Menor precio</option>
								<option value="3">Mayor precio</option>
								<option value="4">Mayorista</option>
							</select>
						</div>
						<div class="col-12 m-b-20 m-lg-b-0 col-lg-2">
							<label for="orden">Precio entre</label>
							<div>
								<input v-model="min" class="form-control input-precio" type="text" placeholder="Min"> - <input v-model="max" class="form-control input-precio" type="text" placeholder="Max">
							</div>
						</div>
						<!-- <div class="col-12 col-lg-2 m-b-20 m-lg-b-0">
							<label for="orden">Mayorista</label>
							<select multiple v-model="providers_selected" name=orden" id="orden" class="form-control">
								<option value="0" selected>Todos</option>
								<option v-for="provider in providers">@{{ provider.name }}</option>
							</select>
						</div> -->
						<div class="col-12 m-b-20 m-lg-b-0 col-lg-2">
							<label for="orden m-b-10">Elementos por página</label>
							<input type="number" min="0" v-model="perPage" class="form-control">
							<small class="form-text text-muted">Deje 0 si quiere mostrar todos</small>
						</div>
					</div>
					<div class="form-row align-items-start">
						<div class="col-12 col-lg-6 align-self-center">
							<button class="btn btn-primary btn-lg d-none d-lg-block" @click.prevent="getArticles(1)"><i class="fas fa-check m-r-5 btn-icon"></i>Mostrar</button>
							<button class="btn btn-primary btn-lg btn-block d-lg-none" @click.prevent="getArticles(1)">Mostrar</button>
						</div>
					</div>
				</form>
				<!-- <div class="row m-t-10">
					<div class="col">
						<p v-if="articles.length != perPage">@{{ articles.length }} articulos encontrados</p>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>
