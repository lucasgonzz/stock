<!-- <div class="article article-danger"> -->
	<div v-for="article in articles" class="card article m-b-10" v-bind:class="'article-' + article.style">
		<!-- <img src="..." class="card-img-top" alt="..."> -->
		<div class="card-body">
			<h5 class="h5 card-title text-center">
				@{{ article.name }} 
				<span><i class="fas fa-barcode m-r-5"></i>@{{ article.bar_code }}</span>
			</h5>
		</div>
		<ul class="list-group m-10">
			<li class="list-group-item d-flex justify-content-between align-items-center">
				Costo
				<span class="badge badge-primary badge-pill">$@{{ article.cost }}</span>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				Precio
				<span class="badge badge-primary badge-pill">$@{{ article.price }}</span>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				Mayorista
				<span class="badge badge-primary badge-pill">@{{ article.mayorista }}</span>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				Ingreso
				<span class="badge badge-primary badge-pill">@{{ article.creado }}</span>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				Ultima actualizacion
				<span class="badge badge-primary badge-pill">@{{ article.actualizado }}</span>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				Precio Anterior
				<span class="badge badge-primary badge-pill">$@{{ article.previus_price }}</span>
			</li>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				Stock
				<span class="badge badge-primary badge-pill">@{{ article.stock }}</span>
			</li>
		</ul>
		<div class="justify-content-between m-10">
			<a href="#" v-if="article.sales.length" v-on:click.prevent="showLastSales(article)" class="btn btn-warning m-m-5">Ventas anteriores</a>
			<a href="#" class="btn btn-primary btn m-m-5" v-on:click.prevent="editArticle(article)"><i class="fas fa-edit"></i></a>
			<a href="#" class="btn btn-danger btn m-m-5" v-on:click.prevent="deleteArticle(article)"><i class="fas fa-trash-alt"></i></a>
		</div>
	</div>
	<!-- <div class="media">
		<img src="..." class="mr-3" alt="...">
		<div class="media-body">
			<h5 class="h5">Trencito <i class="fas fa-barcode"></i> 15687498222</h5>
			<ul class="list-group m-b-10">
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Costo
					<span class="badge badge-primary badge-pill">$100</span>
				</li>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Precio
					<span class="badge badge-primary badge-pill">$140</span>
				</li>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Mayorista
					<span class="badge badge-primary badge-pill">Colo</span>
				</li>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Ingreso
					<span class="badge badge-primary badge-pill">10/20/2019</span>
				</li>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Ultima actualizacion
					<span class="badge badge-primary badge-pill">10/20/2019</span>
				</li>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Precio Anterior
					<span class="badge badge-primary badge-pill">$120</span>
				</li>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Stock
					<span class="badge badge-primary badge-pill">5</span>
				</li>
			</ul>
			<a href="#" class="btn btn-warning">Ventas anteriores</a>
			<a href="#" class="btn btn-primary">Actualizar</a>
			<a href="#" class="btn btn-danger">Borrar</a>
		</div>
	</div> -->
<!-- </div> -->