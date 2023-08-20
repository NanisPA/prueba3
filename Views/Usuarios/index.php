<?php require_once "Views/Templates/header.php"; ?>  
                    
                <!--<h1 class="mt-4">Dashboard</h1>-->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
    <button class="btn btn-primary" type="button" onclick="frmUsuario();" ><i class="fas fa-plus"></i>  Nuevo Usuario</button>
    <table class="table" id="tblUsuarios">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nick</th>
                <th>Nombre</th>
                <th>Caja</th>
                <th>Estado</th>
                <th></th>
            </tr>

        </thead>

    </table>

 <!--copio el modal-->
 <div class="modal fade" id="nuevo_usuario" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Nuevo Usuario</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmUsuario">
          <div class="form-group">
            <label for="nick" class="col-form-label">Nick</label>
            <input type="hidden" id="id_usuario" name="id_usuario">
            <input type="text" class="form-control" id="nick" name="nick" placeholder="Nick">
          </div>
          <div class="form-group">
            <label for="nombre" class="col-form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de Usuario">
          </div>

          <div class="row" id="claves">
            <div class="col-md-6">
              <div class="form-group">
                <label for="clave" class="col-form-label">Contraseña</label>
                <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña">
                
              </div>
              
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="confirmar" class="col-form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirmar" name="confirmar" placeholder="Confirmar Contraseña">
              </div>
            </div>
          </div>
                          
          <div class="form-group">
            <label for="id_caja" class="col-form-label">Caja</label>
            <select name="id_caja" id="id_caja" class="form-control">
                <?php foreach($data['cajas'] as $r){ ?>
                    <option value="<?=$r['id_caja']?>"> <?=$r['caja']?></option>
                <?php }?>
                
            </select>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" onclick="registrarUsuario(event);" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>

    <?php require_once "Views/Templates/footer.php"; ?> 
