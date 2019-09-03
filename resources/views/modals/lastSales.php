<div class="modal fade" id="last-sales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ventas anteriores de {{ article.name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-primary" role="alert">
          <strong>{{ lastSales.length }}</strong> vendidos
        </div>
        <ul class="list-group">
          <li v-for="sale in lastSales" class="list-group-item">
            <p>
              {{ sale.dia }}
              <strong><i class="fas fa-table"></i> {{ sale.creado }}</strong>
              <i class="far fa-clock m-l-10"></i> {{ sale.hora }} hs
            </p>
            <p v-if="sale.created_diff == 0">
              Hoy
            </p>
            <p v-else>
              Hace {{ sale.created_diff }}
            </p>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>