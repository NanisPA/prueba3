<?php
class Cajas extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    
    public function index(){
        //$data['cajas']=$this->model->getCajas();
        $this->views->getView($this,"index");
    }

    public function listar()
    {
        $data=$this->model->getCajas();
        for($i=0;$i<count($data);$i++){
            if($data[$i]['caja_estado']==1){
                $data[$i]['caja_estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCaja('.$data[$i]['id_caja'].')
                "><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnInactivarCaja('.$data[$i]['id_caja'].')
                "><i class="fas fa-trash"></i></button>
    
                </div>';
            }else{
                $data[$i]['caja_estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-success" type="button" onclick="btnReactivarCaja('.$data[$i]['id_caja'].')
                "><i class="fas fa-plus"></i></button>
                </div>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {   
        $id_caja = $_POST['id_caja'];
        $caja = $_POST['caja'];       
        //echo $nick;
        if(empty($caja)){
            $msg = "El campo es obligatorio";
        }else{
                if($id_caja ==""){
                        $data=$this->model->registrarCaja($caja);
                        if($data=="ok"){
                            $msg = "si";
                        }else{
                            $msg = "Error al registrar caja";
                        }
                    }else{
                    $data=$this->model->modificarCaja($caja,$id_caja);
                    if($data == "modificado"){
                        $msg="modificado";
                    }else{
                        $msg = "Error al modificar el caja";
                    }
                }

         }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
         $data = $this->model->editarCaja($id);
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
    }
    
    public function inactivar(int $id){
        $data=$this->model->accion(0, $id);
        if($data == 1){
            $msg = "ok";
        }else{
            $msg="Error al inactivar la caja";
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
            $msg="Error al activar la caja";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
