<?php require_once "Views/Templates/header.php"; ?>  
                    
                <!--<h1 class="mt-4">Dashboard</h1>-->
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Pedidos</li>
                    </ol>
    <a href="<?=base_url?>Pedidos/nuevo_pedido" class="btn btn-primary"><i class="fas fa-plus"></i>Nuevo Pedido</a>
    <table class="table" id="tblPedidos">
        <thead class="thead-dark">
            <tr>
                <th>Nro.</th>
                <th>Fecha</th>
                <th>Razon Social</th>
                <th>NIT/CI</th>
                <th>Email</th>
                <th>Total</th>
                <th>Descuento</th>
                <th>Estado</th>
                <th></th>
            </tr>
        
        </thead>

    </table>
<?php require_once "Views/Templates/footer.php"; ?> 