<?php
class UsuariosModel extends Query{
    private $nick, $nombre, $clave, $id_caja, $id_usuario, $estado;
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsuario(string $nick, string $clave){
        $sql = "select * from usuarios where nick='$nick' and clave='$clave' and usuario_estado=1";
        $data = $this->select($sql);
        return $data;
    }

    public function getUsuarios(){
        $sql = "select u.*, c.caja
        from usuarios u
        inner join cajas c on c.id_caja=u.id_caja";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getCajas(){
        $sql = "select * from cajas where caja_estado=1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarUsuario(string $nick,string $nombre,string $clave, int $id_caja){
        $this->nick = $nick;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->id_caja = $id_caja;
        $sql = "insert into usuarios (nick, nombre, clave, id_caja) values (?,?,?,?)";
        $datos = array($this->nick, $this->nombre, $this->clave, $this->id_caja);
        $data = $this->save($sql, $datos);
        if($data==1){
            $res= "ok";
        }else{
            $res = "error";
        }
        return $res;
    }

    public function editarUsuario(int $id)
    {
        $sql="select * from usuarios where id_usuario='$id'";
        $data=$this->select($sql);
        return $data;
    }

    public function modificarUsuario(string $nick,string $nombre,int $id_caja,int $id_usuario)
    {
        $this->nick = $nick;
        $this->nombre = $nombre;
        $this->id_caja = $id_caja;
        $this->id_usuario = $id_usuario;
        $sql = "update usuarios set nick=?, nombre=?, id_caja=? where id_usuario=?";
        $datos = array($this->nick, $this->nombre, $this->id_caja, $this->id_usuario);
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
        $this->id_usuario = $id;
        $this->estado = $estado;
        $sql="update usuarios set usuario_estado=? where id_usuario=?";
        $datos = array ($this->estado, $this->id_usuario);
        $data=$this->save($sql,$datos);
        return $data;
    }
}

?>