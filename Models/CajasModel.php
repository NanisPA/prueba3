<?php
class CajasModel extends Query{
    private $caja, $id_caja, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getCajas(){
        $sql = "select *
        from cajas";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarCaja(string $caja){
        $this->caja = $caja;
        $sql = "insert into cajas (caja) values (?)";
        $datos = array($this->caja);
        $data = $this->save($sql, $datos);
        if($data==1){
            $res= "ok";
        }else{
            $res = "error";
        }
        return $res;
    }

    public function editarCaja(int $id)
    {
        $sql="select * from cajas where id_caja='$id'";
        $data=$this->select($sql);
        return $data;
    }

    public function modificarCaja(string $caja, int $id_caja)
    {
        $this->caja = $caja;
        $this->id_caja = $id_caja;
        $sql = "update cajas set caja=? where id_caja=?";
        $datos = array($this->caja, $this->id_caja);
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
        $this->id_caja = $id;
        $this->estado = $estado;
        $sql="update cajas set caja_estado=? where id_caja=?";
        $datos = array ($this->estado, $this->id_caja);
        $data=$this->save($sql,$datos);
        return $data;
    }
}

?>