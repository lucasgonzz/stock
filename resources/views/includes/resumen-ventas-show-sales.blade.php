<div class="row justify-content-center" v-if="mostrar == 0">
	<div class="col col-lg-6">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Codigo</th>
					<th scope="col">Nombre</th>
					<th scope="col">Precio</th>
					<th scope="col">Quedan</th>
					<th scope="col" colspan="2">Opciones</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="sale in sales">
					<template v-if="busqueda_por_fecha">
						<tr v-if="sale.otherDay" class="tr tr-sale-day-title">
							<td colspan="2">
								<strong class="c-w"><i class="fas fa-table"></i> @{{ sale.creado }}</strong>
							</td>
							<td colspan="4">
								<strong class="c-w">Total en el dia: $@{{ sale.totalDay }}</strong>
							</td>
						</tr>
					</template>
					<tr class="tr tr-sale-title">
						<td colspan="2"><i class="far fa-clock fa-lg"></i> @{{ sale.hora }}</td>
						<td colspan="4">Total: $@{{ sale.total }}</td>
						<td class="delete-sale p-l-5 p-t-0"><a href="#" @click.prevent="deleteSale(sale)" class="btn btn-danger" data-toggle="popover" title="Eliminar esta venta y sus articulos"><i class="fas fa-trash"></i>Eliminar esta venta</a></td>
					</tr>
					<template v-for="article in sale.articles">
						<tr>
							<th scope="row">@{{ article.bar_code }}</th>
							<td>@{{ article.name }}</td>
							<td>$@{{ article.price }}</td>
							<td>@{{ article.stock }}</td>
							<td><a href="#" @click.prevent="deleteArticle(sale.id, article)" class="btn" title="Eliminar solo este articulo"><i class="fas fa-trash btn-red"></i></a></td>
							<td v-if="article.sales.length>1"><a href="#" class="btn btn-outline-primary" @click.prevent="showLastSales(article)">Ventas anteriores</a></td>
						</tr>
					</template>
				</template>
				
			</tbody>
		</table>
	</div>
</div>

<div class="row" v-else>
	<div class="col">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Hora</th>
					<th scope="col">Articulo</th>
					<th scope="col">Precio</th>
					<th scope="col">Opciones</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="sale in sales">
					<tr v-for="article in sale.articles">
						<td>@{{ sale.hora }}</td>
						<td>@{{ article.name }}</td>
						<td>$@{{ article.price }}</td>
						<td v-if="article.sales.length>1"><a href="#" class="btn btn-outline-primary" @click.prevent="showLastSales(article)">Ventas anteriores</a></td>
					</tr>
				</template>
			</tbody>
		</table>
	</div>
</div>