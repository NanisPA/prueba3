<?php
class Clientes extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    
    public function index(){
        //$data['clientes']=$this->model->getClientes();
        $this->views->getView($this,"index");
    }

    public function listar()
    {
        $data=$this->model->getClientes();
        for($i=0;$i<count($data);$i++){
            if($data[$i]['cliente_estado']==1){
                $data[$i]['cliente_estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCliente('.$data[$i]['id_cliente'].')
                "><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnInactivarCliente('.$data[$i]['id_cliente'].')
                "><i class="fas fa-trash"></i></button>
    
                </div>';
            }else{
                $data[$i]['cliente_estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-success" type="button" onclick="btnReactivarCliente('.$data[$i]['id_cliente'].')
                "><i class="fas fa-plus"></i></button>
                </div>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {   
        $id_cliente = $_POST['id_cliente'];
        $documentoid = $_POST['documentoid'];
        $complementoid = $_POST['complementoid'];
        $razon_social = $_POST['razon_social'];
        $cliente_email = $_POST['cliente_email'];  
        //$cliente_estado = $_POST['cliente_estado'];     
        //echo $nick;
        if(empty($documentoid)||empty($razon_social)){
            $msg = "Los campos son obligatorios";
        }else{
                if($id_cliente ==""){
                        $data=$this->model->registrarCliente($documentoid,$complementoid,$razon_social,$cliente_email);
                        if($data=="ok"){
                            $msg = "si";
                        }else{
                            $msg = "Error al registrar cliente";
                        }
                    }else{
                    $data=$this->model->modificarCliente($documentoid,$complementoid,$razon_social,$cliente_email,$id_cliente);
                    if($data == "modificado"){
                        $msg="modificado";
                    }else{
                        $msg = "Error al modificar el cliente";
                    }
                }

         }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
         $data = $this->model->editarCliente($id);
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
    }
    
    public function inactivar(int $id){
        $data=$this->model->accion(0, $id);
        if($data == 1){
            $msg = "ok";
        }else{
            $msg="Error al inactivar cliente";
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
            $msg="Error al activar cliente";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
