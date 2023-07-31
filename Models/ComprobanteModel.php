
<?php 

	class ComprobanteModel extends Mysql
	{

		public $intIdpersona;
		public $intIdpedido;
		public $strRuc;
		public $strRazonsocial;
		public $strReceptor;
		public $strDni;
		public $strNombreCliente;


		public $intidPedido;
		public function __construct()
		{
			parent::__construct();
		}

		public function obtenerComprobantes(){
			$sql = "SELECT  * FROM pedido WHERE estado_comprobante=0";
			/*$sql = "SELECT f.idfactura, p.idpedido,p.status,p.estado_comprobante,f.datecreated FROM pedido p INNER JOIN factura f ON f.pedidoid = p.idpedido";*/
			$request = $this->select_all($sql);
			return $request;
		}

		public function obtenerFacturas(){
			//$sql = "SELECT  * FROM pedido WHERE estado_comprobante=0";
			$sql = "SELECT f.idfactura, p.idpedido,p.status,p.estado_comprobante,f.datecreated FROM pedido p INNER JOIN comprobantes f ON f.pedidoid = p.idpedido WHERE p.estado_comprobante=2";
			$request = $this->select_all($sql);
			return $request;
		}

		public function obtenerBoletas(){
			$sql = "SELECT f.idfactura, p.idpedido,p.status,p.estado_comprobante,f.datecreated FROM pedido p INNER JOIN comprobantes f ON f.pedidoid = p.idpedido WHERE p.estado_comprobante=1";
			$request = $this->select_all($sql);
			return $request;
		}

		public function BuscarProductosDeProforma(int $idpedido){
			$this->intidPedido = intval($idpedido);

			$sql = "SELECT p.cantidad, d.nombreproducto, p.precio, p.subtotal  FROM proforma p INNER JOIN producto d ON  d.idproducto =p.productoid WHERE p.pedidoid = '{$this->intidPedido}' ";
			//$sql = "SELECT * FROM proforma WHERE pedidoid = '{$this->intidPedido}'";
			$request = $this->select_all($sql);

			return $request;
		}

		public function pruebitaa(){
			$sql = "SELECT MAX(datecreated) FROM persona";
			$request = $this->select($sql);
			$fecha = $request['MAX(datecreated)'];

			$sqlperosna = "SELECT * FROM persona WHERE datecreated = '{$fecha}'";
			$requestpersona = $this->select($sqlperosna);
			return $requestpersona;
		}


		public function generarFactura(int $idencargado, int $idpedido,string $ruc, string $razonsocial , string $direccion){
			$this->intIdpersona = intval($idencargado);
			$this->intIdpedido = intval($idpedido);
			$this->strRuc = $ruc;
			$this->strRazonsocial = $razonsocial;
			$this->strReceptor = $direccion;
			
			//Factura EB01-1
			//Boleta EC02-1


			//1.Obtener el dato del ultimo idfactura

			$sql = "SELECT MAX(datecreated) FROM comprobantes";
			$request = $this->select($sql);

			if(empty($request)){
				$strIdfactura = "EB01-1";

			}else{
				$fecha = $request['MAX(datecreated)'];
				$sqlfactura = "SELECT * FROM comprobantes WHERE datecreated = '{$fecha}'";
				$requestfactura = $this->select($sqlfactura);
				if(!empty($requestfactura)){
					$numeroFactura = $requestfactura['idfactura'];
				}
				
				if(strlen(strClean($numeroFactura))==6){
					$ultimoDigitoIdFactura = substr($numeroFactura, -1);
				}

				if(strlen(strClean($numeroFactura))==7){
					$ultimoDigitoIdFactura = substr($numeroFactura, -2);
				}

				$intultimoDigitoIdFactura = intval($ultimoDigitoIdFactura)+1;
				//$stringFactura = strval($intultimoDigitoIdFactura);
				$strIdfactura = "EB01-".$intultimoDigitoIdFactura;

			}
			
			//VERIFICANDO STOCK
			$sqlStock = "SELECT p.cantidad, d.stock,d.nombreproducto  FROM proforma p INNER JOIN producto d ON  d.idproducto =p.productoid WHERE p.pedidoid = '{$this->intIdpedido}' ";
			$requestStock = $this->select_all($sqlStock);
			$variable="correcto";
			$productosInsuficientes = array();

			for ($i=0; $i < count($requestStock)  ; $i++) { 
				if(intval($requestStock[$i]['cantidad']) > intval($requestStock[$i]['stock'])){
					$variable = "stockInsuficiente";
					array_push($productosInsuficientes, $requestStock[$i]['nombreproducto']);
				}
			}

			if($variable == "stockInsuficiente"){

				return $productosInsuficientes;
			}

			if($variable == "correcto"){

			
				$sqlFactura = "INSERT INTO comprobantes(idfactura,personaid,pedidoid,ruc,razonsocial,direccion) VALUES (?,?,?,?,?,?)";
			$arrDataFactura = array($strIdfactura,$this->intIdpersona,$this->intIdpedido,$this->strRuc,$this->strRazonsocial,$this->strReceptor);
			$request_insert = $this->insert($sqlFactura,$arrDataFactura);
			
			

				//status de estado_comprobante : 0 no emitido/ 1-boleta / 2-factura
			$sqlpedido = "UPDATE pedido SET estado_comprobante=? WHERE idpedido= '{$this->intIdpedido}'";
			$arrDatapedido = array(2);
			$request_updatepedido = $this->insert($sqlpedido,$arrDatapedido);
			return $variable;
			}



			
		}

		public function generarBoleta(int $idencargado, int $numProforma, string $dni,string $nombreCliente){
			
			$this->intIdpersona = intval($idencargado);
			$this->intIdpedido = intval($numProforma);
			$this->strDni = $dni;
			$this->strNombreCliente = $nombreCliente;
			
			//Factura EB01-1
			//Boleta EC02-1


			//1.Obtener el dato del ultimo idfactura

			$sql = "SELECT MAX(datecreated) FROM comprobantes";
			$request = $this->select($sql);

			if(empty($request)){
				$strIdfactura = "EB01-1";

			}else{
				$fecha = $request['MAX(datecreated)'];
				$sqlfactura = "SELECT * FROM comprobantes WHERE datecreated = '{$fecha}'";
				$requestfactura = $this->select($sqlfactura);
				if(!empty($requestfactura)){
					$numeroFactura = $requestfactura['idfactura'];
				}
				
				if(strlen(strClean($numeroFactura))==6){
					$ultimoDigitoIdFactura = substr($numeroFactura, -1);
				}

				if(strlen(strClean($numeroFactura))==7){
					$ultimoDigitoIdFactura = substr($numeroFactura, -2);
				}

				if(strlen(strClean($numeroFactura))==8){
					$ultimoDigitoIdFactura = substr($numeroFactura, -2);
				}

				$intultimoDigitoIdFactura = intval($ultimoDigitoIdFactura)+1;
				//$stringFactura = strval($intultimoDigitoIdFactura);
				$strIdfactura = "EB01-".$intultimoDigitoIdFactura;

			}
			
			//VERIFICANDO STOCK
			$sqlStock = "SELECT p.cantidad, d.stock,d.nombreproducto  FROM proforma p INNER JOIN producto d ON  d.idproducto =p.productoid WHERE p.pedidoid = '{$this->intIdpedido}' ";
			$requestStock = $this->select_all($sqlStock);
			$variable="correcto";
			$productosInsuficientes = array();

			for ($i=0; $i < count($requestStock)  ; $i++) { 
				if(intval($requestStock[$i]['cantidad']) > intval($requestStock[$i]['stock'])){
					$variable = "stockInsuficiente";
					array_push($productosInsuficientes, $requestStock[$i]['nombreproducto']);
				}
			}

			if($variable == "stockInsuficiente"){

				return $productosInsuficientes;
			}

			if($variable == "correcto"){

			
				$sqlFactura = "INSERT INTO comprobantes(idfactura,personaid,pedidoid,nombres,dni) VALUES (?,?,?,?,?)";
			$arrDataFactura = array($strIdfactura,$this->intIdpersona,$this->intIdpedido,$this->strNombreCliente,$this->strDni);
			$request_insert = $this->insert($sqlFactura,$arrDataFactura);
			
			

				//status de estado_comprobante : 0 no emitido/ 1-boleta / 2-factura
			$sqlpedido = "UPDATE pedido SET estado_comprobante=? WHERE idpedido= '{$this->intIdpedido}'";
			$arrDatapedido = array(1);
			$request_updatepedido = $this->insert($sqlpedido,$arrDatapedido);
			return $variable;
			}



			
		}

		
		/*		public function generarFactura(){
			
			
			//Factura EB01-1
			//Boleta EC02-1


			//1.Obtener el dato del ultimo idfactura

		
			
			//VERIFICANDO STOCK
			$sqlStock = "SELECT p.cantidad, d.stock,d.nombreproducto  FROM proforma p INNER JOIN producto2 d ON  d.idproducto =p.productoid WHERE p.pedidoid = 167 ";
			$requestStock = $this->select_all($sqlStock);
			$variable="correcto";
			//$productosInsuficientes = array();

			for ($i=0; $i < count($requestStock)  ; $i++) { 
				if(intval($requestStock[$i]['cantidad']) > intval($requestStock[$i]['stock'])){
					$variable = "stockInsuficiente";
					//array_push($productosInsuficientes, $requestStock[$i]['nombreproducto']);
				}
			}

		/*	if($variable == "stockInsuficiente"){

			
				$sqlFactura = "INSERT INTO factura(idfactura,personaid,pedidoid,ruc,razonsocial,direccion) VALUES (?,?,?,?,?,?)";
			$arrDataFactura = array($strIdfactura,$this->intIdpersona,$this->intIdpedido,$this->strRuc,$this->strRazonsocial,$this->strReceptor);
			$request_insert = $this->insert($sqlFactura,$arrDataFactura);
			
			

				//status de estado_comprobante : 0 no emitido/ 1-boleta / 2-factura
			$sqlpedido = "UPDATE pedido2 SET estado_comprobante=? WHERE idpedido= '{$this->intIdpedido}'";
			$arrDatapedido = array(2);
			$request_updatepedido = $this->insert($sqlpedido,$arrDatapedido);
			}



			return $variable;
		}*/


	/*	public function generarFactura(int $idencargado, int $idpedido,string $ruc, string $razonsocial , string $direccion){
			$this->intIdpersona = intval($idencargado);
			$this->intIdpedido = intval($idpedido);
			$this->strRuc = $ruc;
			$this->strRazonsocial = $razonsocial;
			$this->strReceptor = $direccion;
			
			//Factura EB01-1
			//Boleta EC02-1


			//1.Obtener el dato del ultimo idfactura

			$sql = "SELECT MAX(datecreated) FROM factura";
			$request = $this->select($sql);

			if(empty($request)){
				$strIdfactura = "EB01-1";

			}else{
				$fecha = $request['MAX(datecreated)'];
				$sqlfactura = "SELECT * FROM factura WHERE datecreated = '{$fecha}'";
				$requestfactura = $this->select($sqlfactura);
				if(!empty($requestfactura)){
					$numeroFactura = $requestfactura['idfactura'];
				}

				if(strlen(strClean($numeroFactura))==6){
					$ultimoDigitoIdFactura = substr($numeroFactura, -1);
				}

				if(strlen(strClean($numeroFactura))==7){
					$ultimoDigitoIdFactura = substr($numeroFactura, -2);
				}

				$intultimoDigitoIdFactura = intval($ultimoDigitoIdFactura)+1;
				//$stringFactura = strval($intultimoDigitoIdFactura);
				$strIdfactura = "EB01-".$intultimoDigitoIdFactura;

			}
			
			//VERIFICANDO STOCK
			$sqlStock = "SELECT p.cantidad, d.stock,d.nombreproducto  FROM proforma p INNER JOIN producto2 d ON  d.idproducto =p.productoid WHERE p.pedidoid = '{$this->intidPedido}' ";
			$requestStock = $this->select_all($sqlStock);
			$variable = "correcto";
			$productosInsuficientes = array();

			for ($i=0; $i < count($requestStock)  ; $i++) { 

				if(intval($requestStock[$i]['cantidad']) > intval($requestStock[$i]['stock']) ){
					$variable = "stockInsuficiente";
					array_push($productosInsuficientes, $requestStock[$i]['nombreproducto']);
				}
			}

			if($variable = "correcto"){
				$sqlFactura = "INSERT INTO factura(idfactura,personaid,pedidoid,ruc,razonsocial,direccion) VALUES (?,?,?,?,?,?)";
			$arrDataFactura = array($strIdfactura,$this->intIdpersona,$this->intIdpedido,$this->strRuc,$this->strRazonsocial,$this->strReceptor);
			$request_insert = $this->insert($sqlFactura,$arrDataFactura);
			
			

				//status de estado_comprobante : 0 no emitido/ 1-boleta / 2-factura
			$sqlpedido = "UPDATE pedido2 SET estado_comprobante=? WHERE idpedido= '{$this->intIdpedido}'";
			$arrDatapedido = array(2);
			$request_updatepedido = $this->insert($sqlpedido,$arrDatapedido);
			

			}


		return $productosInsuficientes;
		
			
		}
*/


		public function prueba(){
			$sqlStock = "SELECT p.cantidad, d.stock,d.nombreproducto  FROM proforma p INNER JOIN producto d ON  d.idproducto =p.productoid WHERE p.pedidoid = '171' ";
			$requestStock = $this->select_all($sqlStock);
			$productosInsuficientes = array();

			$variable = "correcto";

			for ($i=0; $i < count($requestStock)  ; $i++) { 
				if(intval($requestStock[$i]['cantidad']) > intval($requestStock[$i]['stock'])){
					$variable = "stockInsuficiente";
					array_push($productosInsuficientes, $requestStock[$i]['nombreproducto']);
				}
			}

			//return $productosInsuficientes;
			return $productosInsuficientes;
		}




		/*public function generarFactura(){
			
			$sqlFactura = "INSERT INTO factura(personaid,pedidoid,ruc,razonsocial,direccion) VALUES (?,?,?,?,?)";
			$arrDataFactura = array(9,140,"ruc","razonso","direcc");
			$request_insert = $this->insert($sqlFactura,$arrDataFactura);


			return $request_insert;
		}*/

	}
 ?>