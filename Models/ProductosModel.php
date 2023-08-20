<?php
class ProductosModel extends Query{
    private $codigo,$nombre_producto,$costo_compra,$precio_venta,$cantidad,$id_medida,$id_categoria,$estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getProductos(){
        $sql = "select p.*,c.nombre_categoria, m.descripcion_medida
        from productos p
        inner join categorias c on c.id_categoria=p.id_categoria
        inner join medidas m on m.id_medida=p.id_medida";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getMedidas(){
        $sql = "select * from medidas where medida_estado=1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCategorias(){
        $sql = "select * from categorias where categoria_estado=1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarProducto(string $codigo,string $nombre_producto,float $costo_compra,float $precio_venta,int $cantidad,int $id_medida,int $id_categoria){
        $this->codigo = $codigo;
        $this->nombre_producto = $nombre_producto;
        $this->costo_compra = $costo_compra;
        $this->precio_venta = $precio_venta;
        $this->cantidad = $cantidad;
        $this->id_medida = $id_medida;
        $this->id_categoria = $id_categoria;
        $verificar = "select * from productos where nombre_producto='$nombre_producto'";
        $existe=$this->select($verificar);
        if(empty($existe)){
            $sql = "insert into productos (codigo,nombre_producto,costo_compra,precio_venta,cantidad,
            id_medida,id_categoria) values (?,?,?,?,?,?,?)";
            $datos = array($this->codigo,$this->nombre_producto,$this->costo_compra,$this->precio_venta,
            $this->cantidad,$this->id_medida,$this->id_categoria);
            $data = $this->save($sql, $datos);
            if($data==1){
                $res= "ok";
            }else{
                $res = "error";
            }
        }else{
            $res= 'existe';
        }
        
        return $res;
    }

    public function editarProducto(int $id)
    {
        $sql="select * from productos where id_producto='$id'";
        $data=$this->select($sql);
        return $data;
    }

    public function modificarProducto(string $codigo,string $nombre_producto,float $costo_compra,float $precio_venta,
    int $cantidad,int $id_medida,int $id_categoria,int $id_producto)
    {
        $this->codigo = $codigo;
        $this->nombre_producto = $nombre_producto;
        $this->costo_compra = $costo_compra;
        $this->precio_venta = $precio_venta;
        $this->cantidad = $cantidad;
        $this->id_medida = $id_medida;
        $this->id_categoria = $id_categoria;
        $this->id_producto= $id_producto;
        $sql = "update productos set codigo=?,nombre_producto=?,costo_compra=?,precio_venta=?, 
        cantidad=?,id_medida=?,id_categoria=? where id_producto=?";
        $datos = array($this->codigo,$this->nombre_producto,$this->costo_compra,$this->precio_venta,
        $this->cantidad,$this->id_medida,$this->id_categoria, $this->id_producto);
        $data = $this->save ($sql,$datos);
        if($data == 1){
            $res = "modificado";
        }else{
            $res = "error";
        }
        return $res;
    }

    public function accion(int $estado, int $id)
    {
        $this->id_producto = $id;
        $this->estado = $estado;
        $sql="update productos set producto_estado=? where id_producto=?";
        $datos = array ($this->estado, $this->id_producto);
        $data=$this->save($sql,$datos);
        return $data;
    }
}

?>