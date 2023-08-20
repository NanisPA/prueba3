<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    
    public function index(){
        $data['cajas']=$this->model->getCajas();
        $this->views->getView($this,"index",$data);
    }

    public function validar()
    {
        if(empty($_POST['nick'])||empty($_POST['clave'])){
            $msg = "Todos los campos son obligatorios";
        }else{
            $nick = $_POST['nick'];
            $clave = md5($_POST['clave']);
            $data=$this->model->getUsuario($nick, $clave);
            if($data){
                $_SESSION['id_usuario'] = $data['id_usuario'];
                $_SESSION['nick'] = $data['nick'];
                $_SESSION['nombre'] = $data['nombre'];
                $msg="ok";
            }else{
                $msg="Usuario o Contrasena incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function listar()
    {
        $data=$this->model->getUsuarios();
        for($i=0;$i<count($data);$i++){
            if($data[$i]['usuario_estado']==1){
                $data[$i]['usuario_estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarUsuario('.$data[$i]['id_usuario'].')
                "><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnInactivarUsuario('.$data[$i]['id_usuario'].')
                "><i class="fas fa-trash"></i></button>
    
                </div>';
            }else{
                $data[$i]['usuario_estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-success" type="button" onclick="btnReactivarUsuario('.$data[$i]['id_usuario'].')
                "><i class="fas fa-plus"></i></button>
                </div>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {   
        $id_usuario = $_POST['id_usuario'];
        $nick = $_POST['nick'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $id_caja = $_POST['id_caja'];
        
        //echo $nick;
        if(empty($nick)|| empty($nombre)|| empty($clave)){
            $msg = "Todos los campos son obligatorios";
        }else{
                if($id_usuario ==""){
                    if($clave != $confirmar){
                        $msg ="Las contrasenas no coinciden";
                    }else{
                        $data=$this->model->registrarUsuario($nick,$nombre,$clave,$id_caja);
                        if($data=="ok"){
                            $msg = "si";
                        }else{
                            $msg = "Error al registrar usuario";
                        }
                    }
                }else{
                    $data=$this->model->modificarUsuario($nick,$nombre,$id_caja,$id_usuario);
                    if($data == "modificado"){
                        $msg="modificado";
                    }else{
                        $msg = "Error al modificar el usuario";
                    }
                }

            }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
         $data = $this->model->editarUsuario($id);
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
    }
    
    public function inactivar(int $id){
        $data=$this->model->accion(0, $id);
        if($data == 1){
            $msg = "ok";
        }else{
            $msg="Error al inactivar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function activar(int $id)
    {
        $data=$this->model->accion(1,$id);
        if($data == 1){
            $msg = "ok";
        }else{
            $msg="Error al activar el usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>

