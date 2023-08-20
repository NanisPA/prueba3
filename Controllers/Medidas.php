<?php
class Medidas extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    
    public function index(){
        //$data['medidas']=$this->model->getMedidas();
        $this->views->getView($this,"index");
    }

    public function listar()
    {
        $data=$this->model->getMedidas();
        for($i=0;$i<count($data);$i++){
            if($data[$i]['medida_estado']==1){
                $data[$i]['medida_estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarMedida('.$data[$i]['id_medida'].')
                "><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnInactivarMedida('.$data[$i]['id_medida'].')
                "><i class="fas fa-trash"></i></button>
    
                </div>';
            }else{
                $data[$i]['medida_estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-success" type="button" onclick="btnReactivarMedida('.$data[$i]['id_medida'].')
                "><i class="fas fa-plus"></i></button>
                </div>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {   
        $id_medida = $_POST['id_medida'];
        $descripcion_medida = $_POST['descripcion_medida'];
        $descripcion_corta= $_POST['descripcion_corta'];
        //$medida_estado = $_POST['medida_estado'];     
        //echo $nick;
        if(empty($descripcion_medida)||empty($descripcion_corta)){
            $msg = "Los campos son obligatorios";
        }else{
                if($id_medida ==""){
                        $data=$this->model->registrarMedida($descripcion_medida,$descripcion_corta);
                        if($data=="ok"){
                            $msg = "si";
                        }else{
                            $msg = "Error al registrar medida";
                        }
                    }else{
                    $data=$this->model->modificarMedida($descripcion_medida,$descripcion_corta,$id_medida);
                    if($data == "modificado"){
                        $msg="modificado";
                    }else{
                        $msg = "Error al modificar medida";
                    }
                }

         }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
         $data = $this->model->editarMedida($id);
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
    }
    
    public function inactivar(int $id){
        $data=$this->model->accion(0, $id);
        if($data == 1){
            $msg = "ok";
        }else{
            $msg="Error al inactivar medida";
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
            $msg="Error al activar medida";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
