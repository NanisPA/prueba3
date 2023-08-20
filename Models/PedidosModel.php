<?php
class PedidosModel extends Query{
    private $id_cliente,$numeroFactura,$cuf,$fechaEmision,$codigoMetodoPago,$montoTotal,$montoTotalSujetoIva,
    $descuentoAdicional,$productos,$codigoRecepcion;
    public function __construct()
    {
        parent::__construct();
    }

    public function buscarCliente(string $documentoid)
    {
        $sql = "select * from clientes where documentoid='$documentoid'";
        $data=$this->select($sql);
        return $data;
    }

    public function buscarProducto(string $codigo)
    {
        $sql = "select p.*, m.descripcion_corta, c.codigoProducto
        from productos p 
        inner join medidas m on m.id_medida=p.id_medida
        inner join categorias c on c.id_categoria=p.id_categoria
        where codigo='$codigo'";
        $data=$this->select($sql);
        return $data;
    }
    
    public function getPedidos(){
        $sql="select f.*, c.razon_social, c.documentoid, c.cliente_email
        from facturas f 
        inner join clientes c on c.id_cliente=f.id_cliente
        order by f.id_factura desc";
        $data=$this->selectAll($sql);
        return $data;
    }

    public function insertFactura(int $id_cliente,int $numeroFactura,string $cuf,string $fechaEmision,int $codigoMetodoPago,float $montoTotal,float $montoTotalSujetoIva,float $descuentoAdicional,string $productos)
    {
        $this->id_cliente = $id_cliente;
        $this->numeroFactura = $numeroFactura;
        $this->cuf = $cuf;
        $this->fechaEmision = $fechaEmision;
        $this->codigoMetodoPago = $codigoMetodoPago;
        $this->montoTotal = $montoTotal;
        $this->montoTotalSujetoIva = $montoTotalSujetoIva;
        $this->descuentoAdicional = $descuentoAdicional;
        $this->productos = $productos;
        //$this->codigoRecepcion = $codigoRecepcion;
        $sql = "insert into facturas (id_cliente,numeroFactura,cuf,fechaEmision,codigoMetodoPago,montoTotal,montoTotalSujetoIva,descuentoAdicional,productos) values (?,?,?,?,?,?,?,?,?)";
        $datos = array($this->id_cliente,$this->numeroFactura,$this->cuf,$this->fechaEmision,$this->codigoMetodoPago,$this->montoTotal,$this->montoTotalSujetoIva,$this->descuentoAdicional,$this->productos);
        $data=$this->save($sql,$datos);
        if($data==1){
            $res = "ok";
        }else{
            $res = "error";
        }
        return $res;
    }

    public function getFactura($id_factura){
        $sql="select *
        from facturas f
        inner join clientes c on c.id_cliente=f.id_cliente
        where f.id_factura='".$id_factura."'";
        $data = $this->select($sql);
        return $data;
        echo $id_factura;


    }

    public function getUniMedida($codigoMedida){
        $sql="select descripcion_medida
        from medidas
        where codigoMedida='".$codigoMedida."'";
        $data = $this->select($sql);
        return $data;


    }
}
?>