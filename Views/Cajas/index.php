<?php require_once "Views/Templates/header.php"; ?>  
                    
                <!--<h1 class="mt-4">Dashboard</h1>-->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Cajas</li>
                    </ol>
    <button class="btn btn-primary" type="button" onclick="frmCaja();" ><i class="fas fa-plus"></i>  Nueva Caja</button>
    <table class="table" id="tblCajas">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre de Caja</th>
                <th>Estado</th>
                <th></th>
            </tr>

        </thead>

    </table>

 <!--copio el modal-->
 <div class="modal fade" id="nueva_caja" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Nueva Caja</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmCaja">
          <div class="form-group">
            <label for="caja" class="col-form-label">Nombre de Caja</label>
            <input type="hidden" id="id_caja" name="id_caja">
            <input type="text" class="form-control" id="caja" name="caja" placeholder="Nombre de caja">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" onclick="registrarCaja(event);" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>

    <?php require_once "Views/Templates/footer.php"; ?> 
