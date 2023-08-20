<?php
class CategoriasModel extends Query{
    private $nombre_categoria,$codigoProducto, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategorias(){
        $sql = "select *
        from categorias";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarCategoria(string $nombre_categoria,int $codigoProducto){
        $this->nombre_categoria = $nombre_categoria;
        $this->codigoProducto = $codigoProducto;
        $verificar = "select * from categorias where nombre_categoria='$nombre_categoria'";
        $existe=$this->select($verificar);
        if(empty($existe)){
            $sql = "insert into categorias (nombre_categoria,codigoProducto) values (?,?)";
            $datos = array($this->nombre_categoria,$this->codigoProducto);
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

    public function editarCategoria(int $id)
    {
        $sql="select * from categorias where id_categoria='$id'";
        $data=$this->select($sql);
        return $data;
    }

    public function modificarCategoria(string $nombre_categoria,int $codigoProducto,int $id_categoria)
    {
        $this->nombre_categoria = $nombre_categoria;
        $this->codigoProducto = $codigoProducto;
        $this->id_categoria= $id_categoria;
        $sql = "update categorias set nombre_categoria=?,codigoProducto=? where id_categoria=?";
        $datos = array($this->nombre_categoria,$this->codigoProducto, $this->id_categoria);
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
        $this->id_categoria = $id;
        $this->estado = $estado;
        $sql="update categorias set categoria_estado=? where id_categoria=?";
        $datos = array ($this->estado, $this->id_categoria);
        $data=$this->save($sql,$datos);
        return $data;
    }
}

?>