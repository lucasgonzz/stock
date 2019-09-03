<div class="row m-t-10 m-b-10">
	<div class="col-12 col-md-6 offset-md-3">
		<nav>
			<ul class="pagination">
				<li v-if="pagination.current_page > 1" @click.prevent="changePage(pagination.current_page - 1)" class="page-item">
					<a href="" class="page-link">
						<span><i class="fas fa-backward"></i></span>
					</a>
				</li>

				<li v-for="page in pagesNumber" v-bind:class="page==pagination.current_page ? 'active' : ''" class="page-item">
					<a href="#" @click.prevent="changePage(page)" class="page-link">
						@{{ page }}
					</a>
				</li>

				<li v-if="pagination.current_page < pagination.last_page" @click.prevent="changePage(pagination.current_page + 1)" class="page-item">
					<a href="" class="page-link">
						<span><i class="fas fa-forward"></i></span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</div>