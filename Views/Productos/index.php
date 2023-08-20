<?php require_once "Views/Templates/header.php"; ?>  
                    
                <!--<h1 class="mt-4">Dashboard</h1>-->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
    <button class="btn btn-primary" type="button" onclick="frmProducto();" ><i class="fas fa-plus"></i>Nuevo Producto</button>
    <table class="table" id="tblProductos">
        <thead class="thead-dark">
            <tr>
                <th>Codigo</th>
                <th>Categoria</th>
                <th>Producto</th>
                <th>Costo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>U. Medida</th>
                <th>Estado</th>
                <th></th>
            </tr>

        </thead>

    </table>

 <!--copio el modal-->
 <div class="modal fade" id="nuevo_producto" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Nuevo producto</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="frmProducto">
          <div class="form-group">
            <label for="codigo" class="col-form-label">Codigo</label>
            <input type="hidden" id="id_producto" name="id_producto">
            <input type="text" class="form-control" id="codigo" name="codigo" 
            placeholder="Codigo">
          </div>
           <div class="form-group">
            <label for="nombre_producto" class="col-form-label">Producto/Servicio</label>
                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" 
                placeholder="Descripcion Producto/Servicio">
            </div>
            <div class="form-group">
            <label for="costo_compra" class="col-form-label">Costo</label>
                <input type="number" class="form-control" id="costo_compra" name="costo_compra" 
                placeholder="Costo" step="0.01">
            </div>
            <div class="form-group">
            <label for="precio_venta" class="col-form-label">Precio</label>
                <input type="number" class="form-control" id="precio_venta" name="precio_venta" 
                placeholder="Precio" step="0.01">
            </div>
            <div class="form-group">
            <label for="cantidad" class="col-form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" 
                placeholder="Cantidad" >
            </div>
            <div class="form-group">
            <label for="id_medida" class="col-form-label">U. medida</label>
            <select name="id_medida" id="id_medida" class="form-control">
                <?php foreach($data['medidas'] as $r){ ?>
                    <option value="<?=$r['id_medida']?>"> <?=$r['descripcion_medida']?></option>
                <?php }?>
                
            </select>
          </div>
          <div class="form-group">
            <label for="id_categoria" class="col-form-label">Categoria</label>
            <select name="id_categoria" id="id_categoria" class="form-control">
                <?php foreach($data['categorias'] as $r){ ?>
                    <option value="<?=$r['id_categoria']?>"> <?=$r['nombre_categoria']?></option>
                <?php }?>
                
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" onclick="registrarProducto(event);" id="btnAccion">Registrar</button>
      </div>
    </div>
  </div>
</div>

    <?php require_once "Views/Templates/footer.php"; ?> 
