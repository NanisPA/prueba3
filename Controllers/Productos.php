<?php
class Productos extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }
    
    public function index(){
        $data['medidas']=$this->model->getMedidas();
        $data['categorias']=$this->model->getCategorias();
        $this->views->getView($this,"index",$data);
    }

    public function listar()
    {
        $data=$this->model->getProductos();
        for($i=0;$i<count($data);$i++){
            if($data[$i]['producto_estado']==1){
                $data[$i]['producto_estado'] = '<span class="badge bg-success">Activo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarProducto('.$data[$i]['id_producto'].')
                "><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnInactivarProducto('.$data[$i]['id_producto'].')
                "><i class="fas fa-trash"></i></button>
    
                </div>';
            }else{
                $data[$i]['producto_estado'] = '<span class="badge bg-danger">Inactivo</span>';
                $data[$i]['acciones']='<div>
                <button class="btn btn-success" type="button" onclick="btnReactivarProducto('.$data[$i]['id_producto'].')
                "><i class="fas fa-plus"></i></button>
                </div>';
            }
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {   
        $id_producto = $_POST['id_producto'];
        $codigo = $_POST['codigo'];
        $nombre_producto= $_POST['nombre_producto'];
        $costo_compra= $_POST['costo_compra'];
        $precio_venta= $_POST['precio_venta'];
        $cantidad= $_POST['cantidad'];
        $id_medida = $_POST['id_medida'];
        $id_categoria = $_POST['id_categoria'];
        //$producto_estado = $_POST['producto_estado'];     
        //echo $nick;
        if(empty($nombre_producto)||empty($precio_venta)){
            $msg = "Los campos son obligatorios";
        }else{
                if($id_producto ==""){
                        $data=$this->model->registrarProducto($codigo,$nombre_producto,$costo_compra,$precio_venta,$cantidad,$id_medida,$id_categoria);
                        if($data=="ok"){
                            $msg = "si";
                        }else{
                            $msg = "Error al registrar producto";
                        }
                    }else{
                    $data=$this->model->modificarProducto($codigo,$nombre_producto, $costo_compra,$precio_venta,$cantidad,$id_medida,$id_categoria,$id_producto);
                    if($data == "modificado"){
                        $msg="modificado";
                    }else{
                        $msg = "Error al modificar producto";
                    }
                }

         }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
         $data = $this->model->editarProducto($id);
         echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
    }
    
    public function inactivar(int $id){
        $data=$this->model->accion(0, $id);
        if($data == 1){
            $msg = "ok";
        }else{
            $msg="Error al inactivar producto";
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
            $msg="Error al activar producto";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
