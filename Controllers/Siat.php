<?php
class Siat {
    public function __construct()
    {

    }

    public function verificarComunicacion(){
        $wsdl="https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionCodigos?wsdl";
        $options = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJNYW51ZWxBSEMiLCJjb2RpZ29TaXN0ZW1hIjoiNzcxMTZEQkU4NUI2NTBERTkwQ0VGNjciLCJuaXQiOiJINHNJQUFBQUFBQUFBRE0wTnJFMHNqQTBNREEwQXdBVTZzdC1Dd0FBQUE9PSIsImlkIjozMDE0ODIxLCJleHAiOjE3MTAwMjg4MDAsImlhdCI6MTY3ODU3NTQ1OCwibml0RGVsZWdhZG8iOjEzNDkyODEwMDE2LCJzdWJzaXN0ZW1hIjoiU0ZFIn0.cJ7uniIfQHTjebkz3bEIhra8AdTkH6ToiUoq6I58LCu_HcWVj0Bj1KpVeuSNBr1McEzRZYE13Qgx7u3lVoa-yQ",
            'timeout' => 5
            )
        );

        $context = stream_context_create($options);
        try{
            $client = new \SoapClient($wsdl, [
                'stream_context' => $context,
                'catch_wsdl' => WSDL_CACHE_NONE,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
            ]);
            $result = $client->verificarComunicacion();
        }catch(SoapFault $fault){
            $result = false;
        }
        return $result;
    }
    
    public function cuis(){
        $wsdl="https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionCodigos?wsdl";
        
        $codigoAmbiente = 2;
        $codigoModalidad = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "77116DBE85B650DE90CEF67";
        $codigoSucursal = 0;
        $nit = "13492810016";

        $params = array("SolicitudCuis" => 
        array(
            "codigoAmbiente" => $codigoAmbiente,
            "codigoModalidad" => $codigoModalidad,
            "codigoPuntoVenta" => $codigoPuntoVenta,
            "codigoSistema" => $codigoSistema,
            "codigoSucursal" => $codigoSucursal,
            "nit" => $nit

        ));

        $options = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJNYW51ZWxBSEMiLCJjb2RpZ29TaXN0ZW1hIjoiNzcxMTZEQkU4NUI2NTBERTkwQ0VGNjciLCJuaXQiOiJINHNJQUFBQUFBQUFBRE0wTnJFMHNqQTBNREEwQXdBVTZzdC1Dd0FBQUE9PSIsImlkIjozMDE0ODIxLCJleHAiOjE3MTAwMjg4MDAsImlhdCI6MTY3ODU3NTQ1OCwibml0RGVsZWdhZG8iOjEzNDkyODEwMDE2LCJzdWJzaXN0ZW1hIjoiU0ZFIn0.cJ7uniIfQHTjebkz3bEIhra8AdTkH6ToiUoq6I58LCu_HcWVj0Bj1KpVeuSNBr1McEzRZYE13Qgx7u3lVoa-yQ",
                'timeout' => 5
            )
        );

        $context = stream_context_create($options);

        try{
            $client = new \SoapClient($wsdl,[
                'stream_context' => $context,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
            ]);
            $result = $client->cuis($params);
        }catch(SoapFault){
            $result = false;
        }
        return $result;
    }

    public function cufd(){
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionCodigos?wsdl";
        $codigoAmbiente = 2;
        $codigoModalidad = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "77116DBE85B650DE90CEF67";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "13492810016";

        $params = array("SolicitudCufd"=>
        array(
            "codigoAmbiente" => $codigoAmbiente,
            "codigoModalidad" => $codigoModalidad,
            "codigoPuntoVenta" => $codigoPuntoVenta,
            "codigoSistema" => $codigoSistema,
            "codigoSucursal" => $codigoSucursal,
            "cuis" => $cuis,
            "nit" => $nit
        ));

        $options = array(
            'http' => array (
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJNYW51ZWxBSEMiLCJjb2RpZ29TaXN0ZW1hIjoiNzcxMTZEQkU4NUI2NTBERTkwQ0VGNjciLCJuaXQiOiJINHNJQUFBQUFBQUFBRE0wTnJFMHNqQTBNREEwQXdBVTZzdC1Dd0FBQUE9PSIsImlkIjozMDE0ODIxLCJleHAiOjE3MTAwMjg4MDAsImlhdCI6MTY3ODU3NTQ1OCwibml0RGVsZWdhZG8iOjEzNDkyODEwMDE2LCJzdWJzaXN0ZW1hIjoiU0ZFIn0.cJ7uniIfQHTjebkz3bEIhra8AdTkH6ToiUoq6I58LCu_HcWVj0Bj1KpVeuSNBr1McEzRZYE13Qgx7u3lVoa-yQ",
                'timeout' => 5
            )
        );

        $context = stream_context_create($options);

        try{
            $client = new \SoapClient($wsdl,[
                'stream_context' => $context,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
            ]);
            $result = $client->cufd($params);
        }catch (SoapFault $fault){
            $result = false;
        }
        return $result;
    }

    public function sincronizarListaProductosServicios(){
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl";

        $codigoAmbiente = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "77116DBE85B650DE90CEF67";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "13492810016";

        $params = array("SolicitudSincronizacion" => 
        array(
            "codigoAmbiente" => $codigoAmbiente,
            "codigoPuntoVenta" => $codigoPuntoVenta,
            "codigoSistema" => $codigoSistema,
            "codigoSucursal" => $codigoSucursal,
            "cuis" => $cuis,
            "nit" => $nit
        ));

        $options = array(
            'http' => array (
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJNYW51ZWxBSEMiLCJjb2RpZ29TaXN0ZW1hIjoiNzcxMTZEQkU4NUI2NTBERTkwQ0VGNjciLCJuaXQiOiJINHNJQUFBQUFBQUFBRE0wTnJFMHNqQTBNREEwQXdBVTZzdC1Dd0FBQUE9PSIsImlkIjozMDE0ODIxLCJleHAiOjE3MTAwMjg4MDAsImlhdCI6MTY3ODU3NTQ1OCwibml0RGVsZWdhZG8iOjEzNDkyODEwMDE2LCJzdWJzaXN0ZW1hIjoiU0ZFIn0.cJ7uniIfQHTjebkz3bEIhra8AdTkH6ToiUoq6I58LCu_HcWVj0Bj1KpVeuSNBr1McEzRZYE13Qgx7u3lVoa-yQ",
                'timeout' => 5
            )
        );

        $context = stream_context_create($options);

        try{
            $client = new \SoapClient($wsdl,[
                'stream_context' => $context,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
            ]);
            $result = $client->sincronizarListaProductosServicios($params);
        }catch (SoapFault $fault){
            $result = false;
        }
        return $result;

    }

    public function sincronizarListaLeyendasFactura(){
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl";

        $codigoAmbiente = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "77116DBE85B650DE90CEF67";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "13492810016";

        $params = array("SolicitudSincronizacion" => 
        array(
            "codigoAmbiente" => $codigoAmbiente,
            "codigoPuntoVenta" => $codigoPuntoVenta,
            "codigoSistema" => $codigoSistema,
            "codigoSucursal" => $codigoSucursal,
            "cuis" => $cuis,
            "nit" => $nit
        ));

        $options = array(
            'http' => array (
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJNYW51ZWxBSEMiLCJjb2RpZ29TaXN0ZW1hIjoiNzcxMTZEQkU4NUI2NTBERTkwQ0VGNjciLCJuaXQiOiJINHNJQUFBQUFBQUFBRE0wTnJFMHNqQTBNREEwQXdBVTZzdC1Dd0FBQUE9PSIsImlkIjozMDE0ODIxLCJleHAiOjE3MTAwMjg4MDAsImlhdCI6MTY3ODU3NTQ1OCwibml0RGVsZWdhZG8iOjEzNDkyODEwMDE2LCJzdWJzaXN0ZW1hIjoiU0ZFIn0.cJ7uniIfQHTjebkz3bEIhra8AdTkH6ToiUoq6I58LCu_HcWVj0Bj1KpVeuSNBr1McEzRZYE13Qgx7u3lVoa-yQ",
                'timeout' => 5
            )
        );

        $context = stream_context_create($options);

        try{
            $client = new \SoapClient($wsdl,[
                'stream_context' => $context,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
            ]);
            $result = $client->sincronizarListaLeyendasFactura($params);
        }catch (SoapFault $fault){
            $result = false;
        }
        return $result;

    }

    public function recepcionFactura($archivo, $fechaEnvio, $hashArchivo){
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionCompraVenta?wsdl";

        $codigoAmbiente = 2;
        $codigoDocumentoSector = 1;
        $codigoEmision = 1;
        $codigoModalidad = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "77116DBE85B650DE90CEF67";
        $codigoSucursal = 0;
        $cufd = $_SESSION['scufd'];
        $cuis = $_SESSION['scuis'];
        $nit = "13492810016";
        $tipoFacturaDocumento = 1;
        $archivo = $archivo;
        $fechaEnvio = $fechaEnvio;
        $hashArchivo = $hashArchivo;

        $params = array("SolicitudServicioRecepcionFactura" => 
        array(
            "codigoAmbiente" => $codigoAmbiente,
            "codigoDocumentoSector" => $codigoDocumentoSector,
            "codigoEmision" => $codigoEmision,
            "codigoModalidad" => $codigoModalidad,
            "codigoPuntoVenta" => $codigoPuntoVenta,
            "codigoSistema" => $codigoSistema,
            "codigoSucursal" => $codigoSucursal,
            "cufd" => $cufd,
            "cuis" => $cuis,
            "nit" => $nit,
            "tipoFacturaDocumento" => $tipoFacturaDocumento,
            "archivo" => $archivo,
            "fechaEnvio" => $fechaEnvio,
            "hashArchivo" => $hashArchivo
        ));

        $options = array(
            'http' => array (
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJNYW51ZWxBSEMiLCJjb2RpZ29TaXN0ZW1hIjoiNzcxMTZEQkU4NUI2NTBERTkwQ0VGNjciLCJuaXQiOiJINHNJQUFBQUFBQUFBRE0wTnJFMHNqQTBNREEwQXdBVTZzdC1Dd0FBQUE9PSIsImlkIjozMDE0ODIxLCJleHAiOjE3MTAwMjg4MDAsImlhdCI6MTY3ODU3NTQ1OCwibml0RGVsZWdhZG8iOjEzNDkyODEwMDE2LCJzdWJzaXN0ZW1hIjoiU0ZFIn0.cJ7uniIfQHTjebkz3bEIhra8AdTkH6ToiUoq6I58LCu_HcWVj0Bj1KpVeuSNBr1McEzRZYE13Qgx7u3lVoa-yQ",
                'timeout' => 5
            )
        );

        $context = stream_context_create($options);

        try{
            $client = new \SoapClient($wsdl,[
                'stream_context' => $context,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
            ]);
            $result = $client->recepcionFactura($params);
        }catch (SoapFault $fault){
            $result = $fault;
        }
        return $result;

    }
}

?>