<?php
class Home extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    public function index(){
        if(!isset($_SESSION['id_usuario'])){
            $this->views->getView($this,"index");  
        }else{
            header('location: Usuarios');
        }
        
        $this->views->getView($this,"index"); 
    }

    public function cerrar_session(){
        session_destroy();
        header('location:'.base_url);
    }
}

?>