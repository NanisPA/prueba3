<?php require_once "Views/Templates/header.php"; ?>  
                    
                <!--<h1 class="mt-4">Dashboard</h1>-->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Clientes</li>
                    </ol>
    <button class="btn btn-primary" type="button" onclick="frmCliente();" ><i class="fas fa-plus"></i>Nuevo Cliente</button>
    <table class="table" id="tblClientes">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Razon Social</th>
                <th>NIT/CI</th>
                <th>Complemento</th>
                <th>Email</th>
                <th>Estado</th>
                <th></th>
            </tr>

        </thead>

    </table>

 <!--copio el modal-->
 <div class="modal fade" id="nuevo_cliente" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Nuevo Cliente</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmCliente">
          <div class="form-group">
            <label for="razon_social" class="col-form-label">Razon Social</label>
            <input type="hidden" id="id_cliente" name="id_cliente">
            <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Razon Social">
          </div>
            <div class="row" >
            <div class="col-md-6">
              <div class="form-group">
                <label for="documentoid" class="col-form-label">NIT/CI</label>
                <input type="text" class="form-control" id="documentoid" name="documentoid" placeholder="NIT/CI">
                
              </div>
              
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="complementoid" class="col-form-label">Complemento</label>
                <input type="text" class="form-control" id="complementoid" name="complementoid" placeholder="Complemento">
              </div>
            </div>
            </div>
            <div class="form-group">
            <label for="cliente_email" class="col-form-label">Email</label>
            <input type="text" class="form-control" id="cliente_email" name="cliente_email" placeholder="Email">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" onclick="registrarCliente(event);" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>

    <?php require_once "Views/Templates/footer.php"; ?> 
