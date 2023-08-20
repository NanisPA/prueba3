<?php require_once "Views/Templates/header.php"; ?> 
<section class="content">
    <div class="card">
        <div class="card header">
            <h4 class="card-title">Nuevo pedido</h4>
        </div>
       <div class="card body">
        <form action="" class="row">
            <div class="form-group row col-md-9">
                <div class="form-group col-md-3">
                    <label for="numeroFactura">Nro.Factura</label>
                    <input type="number" class="form-control" id="numeroFactura" name="numeroFactura">

                </div>
                <div class="form-group col-md-2">
                    <label for="actEconomica">Act. Economica</label>
                    <input type="number" class="form-control" id="actEconomica" name="actEconomica" value="620900" readonly>

                </div>
                <div class="form-group col-md-4">
                    <label for="tipo_documento">Tipo de documento</label>
                        <select class="form-control" name="tipo_documento" id="tipo_documento" >
                            <option value="1">Cedula de Identidad</option>
                            <option value="5">NIT</option>
                        </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="documentoid">NIT/CI</label>
                    <input type="text" class="form-control" id="documentoid" name="documentoid" placeholder="Ingrese el Carnet o NIT">
                    <div class="input group append">
                        <button class="btn btn-outline-secondary" type="button" onclick="buscarCliente()"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="form-group col-md-6" >
                    <label for="razon_social">Razon Social</label>
                    <input type="hidden" id="id_cliente" name="id_cliente">
                    <input type="hidden" id="complementoid" name="complementoid">
                    <input type="text" class="form-control" id="razon_social" name="razon_social">
                </div>
                <div class="form-group col-md-6" >
                    <label for="cliente_email">Correo Electronico</label>
                    <input type="email" class="form-control" id="cliente_email" name="cliente_email">
                </div>
            </div>
            <input type="hidden" id="cufdvalor" name="cufdvalor" value="<?=$_SESSION['scufd']?>">
            <div class="form-group row col-md-3">
                <div class="card">
                    <div class="input-group">
                        <span class="input-group-text">S.total</span>
                            <input type="text" class="form-control" id="subTotal" name="subTotal" value="0.00" 
                            style="text-align:right;"  readonly>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Desc.Add</span>
                            <input type="text" class="form-control" id="descAdicional" name="descAdicional" 
                            value="0.00" onchange="calcularstotal()" style="text-align:right;" >
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">Total</span>
                            <input type="text" class="form-control" id="total" name="total" value="0.00" style="text-align:right;" readonly>
                    </div>
                    <div class="input-group">
                        <span class="badge bg-secondary" id="comunicacionSiat">Desconectado</span>
                        <p id="lineacuis"><?php if(!isset($_SESSION['scuis'])) echo "CUIS inexistente"; else echo "CUIS: ".$_SESSION['scuis']; ?></p>
                        <span id="cufd" style="font-size:small" >No existe Cufd vigente</span>
                    </div>
                    </div>
                    <input type="hidden" id="snick" name="snick" value="<?=$_SESSION['nick']?>">
                </div>
            
        </form>
       </div>
    </div>
    <div class="card">
        <div class="card header">
            <h4 class="card-title">Agregar productos</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="for-group col-md-2">
                    <label for="">Cod.Producto</label>
                    <input type="hidden" id="id_producto" name="id_producto">
                    <input type="text" class="form-control" id="codigo" name="codigo">
                    <input type="hidden" id="codigoProducto" name="codigoProducto">
                    
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="buscarProducto()"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="nombre_producto">Producto</label>
                    <input type="text" class="form-control" id="nombre_producto" name="nombre_producto">
                </div>
                <div class="form-group col-md-2">
                    <label for="descripcion_corta">U.med</label>
                    <input type="text" class="form-control" id="descripcion_corta" name="descripcion_corta">
                </div>
                <div class="form-group col-md-1">
                    <label for="cantProducto">Cant.</label>
                    <input type="number" class="form-control" id="cantProducto" name="cantProducto" value="1" min="1" onchange="calcularstotal()">
                </div>
                <div class="form-group col-md-1">
                    <label for="precio_venta">Precio</label>
                    <input type="number" class="form-control" id="precio_venta" name="precio_venta" min="0" step="0.01">
                </div>
                <div class="form-group col-md-1">
                    <label for="descProducto">Descuento</label>
                    <input type="number" class="form-control" id="descProducto" name="descProducto" value="0.00" min="0" step="0.01"
                    onchange="calcularstotal()">
                </div>
                <div class="form-group col-md-1">
                    <label for="sTotal">S.total</label>
                    <input type="number" class="form-control" id="sTotal" name="sTotal" min="0" step="0.00" value="0.00">
                </div>
                <div class="form-group col-md-1">
                    <label for="">&nbsp;</label>
                    <div class="input-group">
                        <button class="btn btn-info" type="button" onclick="cargarProductos()"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" onclick="emitirFactura()">Generar Factura</button>
        </div>
</div>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Descuento</th>
                        <th>S. Total</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody id="detalles">

                </tbody>
            </table>
        </div>
    </div>
</section>

<?php require_once "Views/Templates/footer.php"; ?>
<script src="<?=base_url?>Assets/js/facturacion.js"></script>