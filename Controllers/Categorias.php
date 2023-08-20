<?php
class Categorias extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    
    public function index(){
        //$data['categorias']=$this->model->getCategorias();
        $this->views->getView($this,"index");
    }

    public function listar()
    {
        $data=$this->model->getCategorias();
        for($i=0;$i<count($data);$i++){
            if($data[$i]['categoria_estado']==1){
                $data[$i]['categoria_estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarCategoria('.$data[$i]['id_categoria'].')
                "><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnInactivarCategoria('.$data[$i]['id_categoria'].')
                "><i class="fas fa-trash"></i></button>
    
                </div>';
            }else{
                $data[$i]['categoria_estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-success" type="button" onclick="btnReactivarCategoria('.$data[$i]['id_categoria'].')
                "><i class="fas fa-plus"></i></button>
                </div>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {   
        $id_categoria = $_POST['id_categoria'];
        $nombre_categoria = $_POST['nombre_categoria'];
        $codigoProducto = $_POST['codigoProducto'];
        //$categoria_estado = $_POST['categoria_estado'];     
        //echo $nick;
        if(empty($nombre_categoria)||empty($codigoProducto)){
            $msg = "Los campos son obligatorios";
        }else{
                if($id_categoria ==""){
                        $data=$this->model->registrarCategoria($nombre_categoria,$codigoProducto);
                        if($data=="ok"){
                            $msg = "si";
                        }else{
                            $msg = "Error al registrar categoria";
                        }
                    }else{
                    $data=$this->model->modificarCategoria($nombre_categoria,$codigoProducto,$id_categoria);
                    if($data == "modificado"){
                        $msg="modificado";
                    }else{
                        $msg = "Error al modificar categoria";
                    }
                }

         }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
         $data = $this->model->editarCategoria($id);
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
    }
    
    public function inactivar(int $id){
        $data=$this->model->accion(0, $id);
        if($data == 1){
            $msg = "ok";
        }else{
            $msg="Error al inactivar categoria";
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
            $msg="Error al activar categoria";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
