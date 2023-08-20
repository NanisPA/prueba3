<?php require_once "Views/Templates/header.php"; ?>  
                    
                <!--<h1 class="mt-4">Dashboard</h1>-->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Medidas</li>
                    </ol>
    <button class="btn btn-primary" type="button" onclick="frmMedida();" ><i class="fas fa-plus"></i>Nueva Medida</button>
    <table class="table" id="tblMedidas">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Medida</th>
                <th>Abreviatura</th>
                <th>Estado</th>
                <th></th>
            </tr>

        </thead>

    </table>

 <!--copio el modal-->
 <div class="modal fade" id="nueva_medida" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Nueva medida</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmMedida">
          <div class="form-group">
            <label for="descripcion_medida" class="col-form-label">Medida</label>
            <input type="hidden" id="id_medida" name="id_medida">
            <input type="text" class="form-control" id="descripcion_medida" name="descripcion_medida" 
            placeholder="Medida">
          </div>
           <div class="form-group">
            <label for="descripcion_corta" class="col-form-label">Abreviatura</label>
                <input type="text" class="form-control" id="descripcion_corta" name="descripcion_corta" 
                placeholder="Abreviatura">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" onclick="registrarMedida(event);" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>

    <?php require_once "Views/Templates/footer.php"; ?> 
