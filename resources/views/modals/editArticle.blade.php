<div class="modal fade" id="editArticle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Editar <strong>@{{ article.name }}</strong> | <i class="fas fa-barcode"></i> @{{ article.bar_code }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="cost">Agregado</label>
					<input type="text" name="cost" v-model="article.creado" class="form-control" disabled>
				</div>
				<div class="form-group">
					<label for="cost">Actualizado</label>
					<input type="text" name="cost" v-model="article.actualizado" class="form-control" disabled>
				</div>
				<div class="form-group">
					<label for="cost">Costo</label>
					<input type="text" name="cost" v-model="article.cost" id="costo" class="form-control focus-red">
				</div>
				<div class="form-group">
					<label for="price">Precio</label>
					<input type="text" name="price" v-model="article.price" class="form-control focus-red">
				</div>
				<div class="form-group">
					<label for="name">Nombre</label>
					<input type="text" name="name" v-model="article.name" class="form-control focus-red">
				</div>
				<div class="form-group">
					<label for="provider">Proveedores</label>
					<select v-model="article.providers" class="form-control focus-red" multiple="true">
						<option v-for="provider in providers" :value="provider.id">@{{ provider.name }}</option>
					</select>
					<small class="form-text text-muted">Para agregar un nuevo proveedor mantenga pulsado Ctrol y haga click en el proveedor que quiera agregar</small>
				</div>
				<div class="form-group">
					<label for="stock">Cantidad</label>
					<input type="number" v-model="article.stock" name="stock" class="form-control focus-red">
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" v-model="article.act_fecha" value="" id="defaultCheck1" checked>
					<label class="form-check-label" for="defaultCheck1">
						Actualizar fecha
					</label>
					<small class="form-text text-muted">Si desmarca esta casilla no se guardara la fecha de actualización</small>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary focus-red" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary focus-red" v-on:click="updateArticle">Actualizar</button>
			</div>
		</div>
	</div>
</div>
