<?php require_once "Views/Templates/header.php"; ?>  
                    
                <!--<h1 class="mt-4">Dashboard</h1>-->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Categorias</li>
                    </ol>
    <button class="btn btn-primary" type="button" onclick="frmCategoria();" ><i class="fas fa-plus"></i>Nueva Categoria</button>
    <table class="table" id="tblCategorias">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th>Codigo SIAT</th>
                <th>Estado</th>
                <th></th>
            </tr>

        </thead>

    </table>

 <!--copio el modal-->
 <div class="modal fade" id="nueva_categoria" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Nueva Categoria</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmCategoria">
          <div class="form-group">
            <label for="nombre_categoria" class="col-form-label">Categoria</label>
            <input type="hidden" id="id_categoria" name="id_categoria">
            <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" 
            placeholder="Categoria">
          </div>
           <div class="form-group">
            <label for="codigoProducto" class="col-form-label">Codigo SIAT</label>
                <input type="text" class="form-control" id="codigoProducto" name="codigoProducto" 
                placeholder="Codigo SIAT">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" onclick="registrarCategoria(event);" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>

    <?php require_once "Views/Templates/footer.php"; ?> 
