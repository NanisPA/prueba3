<?php
class Pedidos extends Controller{
    public function __construct(){
        session_start();
        parent::__construct();
    }

    public function index()
    {
        $this->views->getView($this, "index");
    }

    public function listar()
    {
        $data=$this->model->getPedidos();
        for($i = 0; $i < count($data); $i++){
            if($data[$i]['factura_estado'] == 1){
                $data[$i]['factura_estado'] = '<span class="badge bg-success">Activo</span>';
           }else{
                $data[$i]['factura_estado'] = '<span class="badge bg-danger">Inactivo</span>';
                
            }
            $data[$i]['acciones']='<div>
            <button class="btn btn-primary" type="button" onclick="btnImprimirFactura('.$data[$i]['id_factura'].')
            "><i class="fas fa-print"></i></button>
            <a href="https://pilotosiat.impuestos.gob.bo/consulta/QR?nit=13492810016
            &cuf='.$data[$i]['cuf'].'&numero='.$data[$i]['numeroFactura'].'&t=2" class="btn btn-success" target="_blank"
            "><i class="fas fa-file-signature"></i></button>
            </div>';
        }
        echo json_encode($data);
        die();
    }

    public function nuevo_pedido()
    {
        $this->views->getView($this, "nuevo_pedido");
    }

    public function buscarCliente()
    {
        $documentoid = $_POST['documentoid'];
        $data=$this->model->buscarCliente($documentoid);
        if($data){
            echo json_encode($data);
        }else{
            $msg = "error";
            echo json_encode($msg);
        }
    }

    public function buscarProducto()
    {
        $codigo = $_POST['codigo'];
        $data=$this->model->buscarProducto($codigo);
        if($data){
            echo json_encode($data);
        }else{
            $msg = "error";
            echo json_encode($msg);
        }
    }

    public function verificarComunicacion()
    {
        require "Siat.php";
        $siat = new Siat();
        $res = $siat->verificarComunicacion();
        if($res->RespuestaComunicacion->transaccion==true){
            if(!isset($_SESSION['scuis'])){
                $rescuis = $siat->cuis();
                if($rescuis->RespuestaCuis->mensajesList->codigo==980){
                    $_SESSION['scuis'] = $rescuis->RespuestaCuis->codigo;
                    $_SESSION['sfechavigenciaCuis'] = $rescuis->RespuestaCuis->fechaVigencia;
                }else{
                    $res= "Error al solicitar codigo CUIS";
                }
            }
            echo json_encode($res);
        }else{
            echo "Fallo la comunicacion";
        }
    }

    public function cuis(){
        require "Siat.php";
        $siat = new Siat();
        $res = $siat->cuis();
        //var_dump($res);
        if($res->RespuestaCuis->mensajesList->codigo==980){
            $_SESSION['scuis'] = $res->RespuestaCuis->codigo;
            $_SESSION['sfechavigenciaCuis'] = $res->RespuestaCuis->fechaVigencia;
        }else{
            echo "Error al solicitar codigo CUIS";
        }
    }

    public function cufd(){
        if(!isset($_SESSION['scufd'])){
            require "Siat.php";
            $siat = new Siat();
            $rescufd = $siat->cufd();
            if($rescufd->RespuestaCufd->transaccion == true){
                $cufd = $rescufd->RespuestaCufd->codigo;
                $codigoControl = $rescufd->RespuestaCufd->codigoControl;
                $fechaVigencia = $rescufd->RespuestaCufd->fechaVigencia;
                $_SESSION['scufd'] = $cufd;
                $_SESSION['scodigoControl'] = $codigoControl;
                $_SESSION['svigenciaCufd'] = $fechaVigencia;
            }else{
            $rescufd = false;
            }
        }else{
            $fechaVigente=substr($_SESSION['svigenciaCufd'],0,16);
            $fechaVigente = str_replace("T","",$fechaVigente);
            if($_SESSION['svigenciaCufd']<date('Y-m-d H:i')){
            require "Siat.php";
            $siat = new Siat();
            $rescufd = $siat->cufd();
            if($rescufd->RespuestaCufd->transaccion == true){
                $cufd = $rescufd->RespuestaCufd->codigo;
                $codigoControl = $rescufd->RespuestaCufd->codigoControl;
                $fechaVigencia = $rescufd->RespuestaCufd->fechaVigencia;
                $_SESSION['scufd'] = $cufd;
                echo $cufd;
                $_SESSION['scodigoControl'] = $codigoControl;
                $_SESSION['svigenciaCufd'] = $fechaVigencia;
            }else{
            $rescufd = false;
            }
        }else{
            $rescufd['transaccion']=true;
            $rescufd['codigo'] = $_SESSION['scufd'];
            $rescufd['fechaVigencia'] = $_SESSION['svigenciaCufd'];
        }
      } 
      echo json_encode($rescufd);
    }

   public function sincronizarListaProductosServicios(){
        require "Siat.php";
        $siat = new Siat();
        $resync = $siat->sincronizarListaProductosServicios();
        echo json_encode($resync);

    }

    public function sincronizarListaLeyendasFactura(){
        require "Siat.php";
        $siat = new Siat();
        $resley = $siat->sincronizarListaLeyendasFactura();
        
        echo json_encode($resley);
        //echo array_rand($resley);
    }

    public function generaFactura()
    {
        $datos=$_POST['factura'];
        $id_cliente = $_POST['id_cliente'];
        $valores = $datos['factura'][0]['cabecera'];
        $nitEmisor = str_pad($valores['nitEmisor'],13,"0",STR_PAD_LEFT);
        $fechaEmision = $valores['fechaEmision'];
        $fechat = str_replace("T","",$fechaEmision);
        $fechat = str_replace("-","",$fechat);
        $fechat = str_replace(":","",$fechat);
        $fechat = str_replace(".","",$fechat);
        $sucursal = str_pad(0,4,"0",STR_PAD_LEFT);
        $modalidad = 2;
        $tipoEmision = 1;
        $tipoFactura= 1;
        $tipoDocumentoSector = str_pad(1,2,"0",STR_PAD_LEFT);
        $numeroFactura = str_pad($valores['numeroFactura'],10,"0",STR_PAD_LEFT); 
        $puntoVenta = str_pad(0,4,"0",STR_PAD_LEFT);
        $cadena = $nitEmisor.$fechat.$sucursal.$modalidad.$tipoEmision.$tipoFactura.$tipoDocumentoSector.$numeroFactura.$puntoVenta;
        ini_set('soap.wsdl_cache_enabled',0);
        $wsdl = "https://indexingenieria.com/webservices/wssiatcuf.php?wsdl";
        $client = new SoapClient($wsdl);
        $client->__getFunctions();
        $params=array(
            "factura_numero" => $numeroFactura,
            "nit_emisor" => $nitEmisor,
            "fechaEmision" => $fechaEmision,
            "codigoControl" => $_SESSION['scodigoControl']
        );
        $cuf = $client->__soapCall('generaCuf',$params);
        echo "CUF: ".$cuf;
        $datos['factura'][0]['cabecera']['cuf']=$cuf;
        //echo json_encode($datos);
        $temporal = $datos['factura'];
        $xml_temporal = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><facturaComputarizadaCompraVenta xsi:noNamespaceSchemaLocation=\"facturaComputarizadaCompraVenta.xsd\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"></facturaComputarizadaCompraVenta>");
        $this->formato_xml($temporal, $xml_temporal);
        $xml_temporal->asXML("docs/facturaxml.xml");
        $archivoXml="";
        $fp = fopen("docs/facturaxml.xml","r");
        while(!feof($fp)){
            $linea=fgets($fp);
            $archivoXml .= $linea;
        }
        fclose($fp);
        $archivo = "";
        $gzdata = gzencode(file_get_contents("docs/facturaxml.xml"),9);
        $fp=fopen("docs/facturaxml.xml.zip","w");
        fwrite($fp, $gzdata);
        fclose($fp);
        $archivo = $gzdata;
        $hashArchivo = hash("sha256",file_get_contents("docs/facturaxml.xml"));
        //echo $hashArchivo;
        $numeroFactura = $valores['numeroFactura'];
        $codigoMetodoPago = 1;
        $montoTotal = $valores['montoTotal'];
        $montoTotalSujetoIva = $valores['montoTotalSujetoIva'];
        $descuentoAdicional = $valores['descuentoAdicional'];
        $productos = file_get_contents("docs/facturaxml.xml");
        $result=$this->model->insertFactura($id_cliente,$numeroFactura,$cuf,$fechaEmision,$codigoMetodoPago,$montoTotal,$montoTotalSujetoIva,$descuentoAdicional,$productos);
        /*$siat = new Siat();
        $resFactura = $siat->recepcionFactura($archivo, $fechaEmision, $hashArchivo);
        $data['mensaje']= $resFactura->RespuestaServicioFacturacion->codigoDescripcion;
        $codigoRecepcion= $resFactura->RespuestaServicioFacturacion->codigoRecepcion;
       
        return $result;*/
    }

    public function formato_xml($temporal, $xml_temporal)
    {
        $ns_xsi = "http://www.w3.org/2001/XMLSchema-instance";
        foreach($temporal as $key => $value){
            if(is_array($value)){
                if(!is_numeric($key)){
                    $subnode = $xml_temporal->addChild("$key");
                    $this->formato_xml($value, $subnode);
                }else{
                    $this->formato_xml($value, $xml_temporal);
                }
            }else{
                if($value == null && $value <> '0'){
                    $hijo = $xml_temporal->addChild("$key", "$value");
                    $hijo->addAttribute('xsi:nil','true',$ns_xsi);
                }else{
                    $xml_temporal->addChild("$key","$value");
                }
            }
        }
    }
   
    public function imprimirFactura()
    {
        
        $id_factura=$_POST['id'];
        $res = $this->model->getFactura($id_factura);
        print_r($res);
        $xml = $res['productos'];
        $archivoXML = new SimpleXMLElement($xml);
        $nitEmisor= $archivoXML->cabecera[0]->nitEmisor;
        echo $nitEmisor;
        exit();
        $numeroFactura= $archivoXML->cabecera[0]->numeroFactura;
        $cuf = $archivoXML->cabecera[0]->cuf;
        $fechaEmision = $archivoXML->cabecera[0]->fechaEmision;
        $numeroDocumento = $archivoXML->cabecera[0]->numeroDocumento.''.$archivoXML->cabecera[0]->complemento;
        $nombreRazonSocial = $archivoXML->cabecera[0]->nombreRazonSocial;
        $codigoCliente = $archivoXML->cabecera[0]->numeroDocumento;
        $descuentoAdicional = $archivoXML->cabecera[0]->descuentoAdicional;
        $leyenda = $archivoXML->cabecera[0]->leyenda;

        require "assets/fpdf/fpdf.php";
        $pdf = new FPDF('P','mm','Letter');
        $pdf->AddPage();
        //linea1
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(70,5,utf8_decode('Metales Totai S.R.L.'),0,0,'C');
        $pdf->Cell(30,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(20,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(40,5,utf8_decode('NIT'),0,0,'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(40,5,$nitEmisor,0,1,'L');
        //linea 2
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(70,5,utf8_decode('SUCURSAL N. 5'),0,0,'C');
        $pdf->Cell(30,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(20,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(40,5,utf8_decode('FACTURA N°'),0,0,'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(40,5,$numeroFactura,0,1,'L');
        //linea3
        $pdf->Cell(70,5,utf8_decode('No. Punto de Venta 0'),0,0,'C');
        $pdf->Cell(30,5,utf8_decode(''),0,0,'C');
        $pdf->Cell(20,5,utf8_decode(''),0,0,'C');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(40,5,utf8_decode('CÓD. AUTORIZACIÓN'),0,0,'L');
        $pdf->SetFont('Arial','',9);
        $y = $pdf->GetY();
        $pdf->MultiCell(40,5,$cuf,0,'L');
        //linea4
        $pdf->SetY($y+5);
        $pdf->Cell(70,5,utf8_decode('Av. Juan XXIII'),0,1,'C');
        $pdf->Cell(70,5,utf8_decode('Teléfono: 2824512'),0,1,'C');
        $pdf->Cell(70,5,utf8_decode('La Paz'),0,1,'C');
        $pdf->Ln(10);
        //linea5
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,5,utf8_decode('FACTURA'),0,1,'C');
        //LINEA 6
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,5,utf8_decode('(Con Derecho a Crédito Fiscal)'),0,1,'C');
        $pdf->Ln();
        //
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(40,5,utf8_decode('Fecha:'),0,0,'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(60,5,$fechaEmision,0,0,'L');
        $pdf->Cell(30,5,'',0,0,'C');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(30,5,utf8_decode('NIT/CI/CEX:'),0,0,'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(40,5,$numeroDocumento,0,1,'L');
        //
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(40,5,utf8_decode('Nombre/Razón Social:'),0,0,'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(60,5,$nombreRazonSocial,0,0,'L');
        $pdf->Cell(30,5,'',0,0,'C');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(30,5,utf8_decode('Cod. Cliente: '),0,0,'L');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(40,5,$codigoCliente,0,1,'L');
        $pdf->Ln();
        //tabla
        $pdf->SetFont('Arial','B',9);
        $y = $pdf->GetY();
        $pdf->MultiCell(30,4,utf8_decode('CÓDIGO PRODUCTO / SERVICIO'),1,'C');
        $pdf->SetY($y);
        $pdf->SetX(40);
        $y = $pdf->GetY();
        $pdf->MultiCell(25,4,utf8_decode("\nCANTIDAD \n "),1,'C');
        $pdf->SetY($y);
        $pdf->SetX(65);
        $y = $pdf->GetY();
        $pdf->MultiCell(20,4,utf8_decode("\nUNIDAD DE MEDIDA "),1,'C');
        $pdf->SetY($y);
        $pdf->SetX(85);
        $y = $pdf->GetY();
        $pdf->MultiCell(50,4,utf8_decode("\nDESCRIPCIÓN \n "),1,'C');
        $pdf->SetY($y);
        $pdf->SetX(135);
        $y = $pdf->GetY();
        $pdf->MultiCell(22,4,utf8_decode("\nPRECIO UNITARIO"),1,'C');
        $pdf->SetY($y);
        $pdf->SetX(157);
        $y = $pdf->GetY();
        $pdf->MultiCell(22,4,utf8_decode("\nDESCUENTO \n"),1,'C');
        $pdf->SetY($y);
        $pdf->SetX(179);
        $y = $pdf->GetY();
        $pdf->MultiCell(30,4,utf8_decode("\nSUBTOTAL \n "),1,'C');
        $pdf->SetFont('Arial','',8);
        //incluir foreach
        $productos_lista = $archivoXML->detalle;
        $total=0;
        foreach($productos_lista as $p){
            $data = $this->model->getUniMedida($p->unidadMedida);
            $pdf->Cell(30,5,utf8_decode($p->codigoProducto),1,0,'L');
            $pdf->Cell(25,5,$p->cantidad,1,0,'R');
            $pdf->Cell(20,5,$data['descripcion_medida'],1,0,'L');
            $pdf->Cell(50,5,utf8_decode($p->descripcion),1,0,'L');
            $pdf->Cell(22,5,number_format(floatval($p->precioUnitario,2)),1,0,'R');
            $pdf->Cell(22,5,number_format(floatval($p->montoDescuento,2)),1,0,'R');
            $pdf->Cell(30,5,number_format(floatval($p->subTotal,2)),1,1,'R');
            $total +=$p->subtotal;
        //
        }
        //
        $pdf->SetFont('Arial','',8);
        
        $pdf->Cell(125,4,'',0,0,'L');
        $pdf->Cell(44,4,'SUBTOTAL Bs',1,0,'R');
        $pdf->Cell(30,4,number_format($total,2),1,1,'R');
        $pdf->Cell(125,4,'',0,0,'L');
        $pdf->Cell(44,4,'DESCUENTO Bs',1,0,'R');
        $pdf->Cell(30,4,number_format(floatval($descuentoAdicional,2)),1,1,'R');
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(125,4,utf8_decode("Son: Trescientos nueve 51/100 Bolivianos"),0,0,'L');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(44,4,'TOTAL Bs',1,0,'R');
        $pdf->Cell(30,4,number_format(($total-$descuentoAdicional),2),1,1,'R');
        $pdf->Cell(125,4,'',0,0,'L');
        $pdf->Cell(44,4,'MONTO GIFT CARD Bs',1,0,'R');
        $pdf->Cell(30,4,'0.00',1,1,'R');
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(125,4,'',0,0,'L');
        $pdf->Cell(44,4,'MONTO A PAGAR Bs',1,0,'R');
        $pdf->Cell(30,4,number_format(($total-$descuentoAdicional),2),1,1,'R');
        $pdf->Cell(125,4,'',0,0,'L');
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(44,4,utf8_decode('IMPORTE BASE CRÉDITO FISCAL'),1,0,'R');
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(30,4,number_format(($total-$descuentoAdicional),2),1,1,'R');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','',7);
        $y=$pdf->GetY();
        $pdf->Cell(170,10,utf8_decode('ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE ACUERDO A LEY'),0,1,'C');
        $pdf->Cell(170,4,utf8_decode($leyenda),0,1,'C');
        $pdf->Cell(170,7,utf8_decode('"Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido en una modalidad de facturación en línea"'),0,1,'C');
        $pdf->Image('Assets/img/qr.png',180,$y,25);
        $pdf->Output('docs/factura.pdf','F');
       
    }
}


?>