<?php 

	class Comprobante extends Controllers{
		public function __construct()
		{	
			session_start();
			parent::__construct();
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/login');
			}
		}

		public function Comprobante()
		{
			$data['page_id'] = 6;
			$data['page_tag'] = "Comprobante de pago";
			$data['page_title'] = "Asignar Comprobante";
			$data['page_name'] = "Comprobantes";
			$this->views->getView($this,"comprobante",$data);
		}


		public function getComprobantes(){
			$arrData = $this->model->obtenerComprobantes();

			//dep($arrData);
			//die();
						for ($i=0; $i < count($arrData); $i++) { 
			

				if($arrData[$i]['estado_comprobante']==0){
					$arrData[$i]['estado_comprobante']='<span class="badge badge-danger">No asignado a un cliente</span>';
					$arrData[$i]['options'] = '<div class="text-center">

				<button class="btn btn-info btnViewUsuario" onClick="fntBoleta('.$arrData[$i]['idpedido'].')"  type="button">Boleta</button>

				<button class="btn btn-secondary btnEditUsuario" onClick="fntFactura('.$arrData[$i]['idpedido'].')"  type="button">Factura</button>
				</div>';
					
				}

				
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();

		}


			public function obtenerFacturas(){
			$arrData = $this->model->obtenerFacturas();

			//dep($arrData);
			//die();
						for ($i=0; $i < count($arrData); $i++) { 
		

				if($arrData[$i]['estado_comprobante']==2){
					$arrData[$i]['estado_comprobante']='<span class="badge badge-success">Ya asignado a un cliente</span>';

						$arrData[$i]['options'] = '<div class="text-center">

			

				<a href="http://localhost/tienda_virtual/Comprobantepago/confirmFactura/'.$arrData[$i]['idfactura'].'"><button class="btn btn-primary btnEditUsuario" onClick=""   type="button"><i class="fa-solid fa-eye"></i> Ver Factura</button></a>
				</div>';

					

				}

				
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();

		}


		public function obtenerBoletas(){
			$arrData = $this->model->obtenerBoletas();

			for ($i=0; $i < count($arrData); $i++) { 
		

				if($arrData[$i]['estado_comprobante']==1){
					$arrData[$i]['estado_comprobante']='<span class="badge badge-success">Ya asignado a un cliente</span>';

						$arrData[$i]['options'] = '<div class="text-center">

						<a href="http://localhost/tienda_virtual/Comprobantepago/confirmBoleta/'.$arrData[$i]['idfactura'].'"><button class="btn btn-primary btnEditUsuario" onClick=""   type="button"><i class="fa-solid fa-eye"></i> Ver Boleta</button></a>
						</div>';

					

				}

				
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();


		}


			public function obtenerRUC(string $ruc){
			$numeroruc = $ruc;

			$json = file_get_contents("https://dniruc.apisperu.com/api/v1/ruc/$ruc?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBydWViYXBocGNvZGVAZ21haWwuY29tIn0.FeINE7F1kgtaj3Eu69L1cq2kv_RU8HgdtHAURTlo3UI");
			/*$json= file_get_contents("https://dniruc.apisperu.com/api/v1/ruc/20165465009?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InBydWViYXBocGNvZGVAZ21haWwuY29tIn0.FeINE7F1kgtaj3Eu69L1cq2kv_RU8HgdtHAURTlo3UI");*/


			echo $json;

		}

		public function getProductosDeProforma(int $idproforma){

			$idpedido = intval($idproforma);

			$requestBusqueda = $this->model->BuscarProductosDeProforma($idpedido);

			//dep($requestBusqueda);

			if(!empty($requestBusqueda)){
				echo json_encode($requestBusqueda,JSON_UNESCAPED_UNICODE);
			}

		}

		public function pruebita(){
			$request = $this->model->pruebitaa();

			dep($request);
		}

		public function prueba(){
			$cadena1 = "hola";
				$cadena2 = " mundo";
			$sumacadena = $cadena1.$cadena2;
			echo $sumacadena;
		}

		public function CrearFactura(){
			

			if($_POST){

				$idEncargado = $_POST['idEncargado'];
				$idPedido = $_POST['numeroComprobante'];
				$numeroRuc  = $_POST['txtRuc'];
				$razonSocial = $_POST['txtRazon'];
				$direccionReceptor = $_POST['txtDireccionReceptor'];


				$requestFactura = $this->model->generarFactura($idEncargado,$idPedido,$numeroRuc,$razonSocial,$direccionReceptor);
				//dep($requestFactura);

				if($requestFactura=="correcto"){
					$arrResponse = array("status"=>true,"msg"=>"Factura generada con éxito.");
				
					}
					if(is_array($requestFactura)){
					$arregloString = implode("\n", $requestFactura);
					//echo $arregloString;
					 /*if($requestFactura=="stockInsuficiente")*/
					 if(count($requestFactura)>1){
						$arrResponse = array("status"=>false,"msg"=>"Stock insuficiente en los siguientes productos:\n\n",'data'=>$arregloString);}
						if(count($requestFactura)==1){
						$arrResponse = array("status"=>false,"msg"=>"Stock insuficiente en el siguiente producto:\n\n",'data'=>$arregloString);}
					}
			

				
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}	

			die();

		}


		public function CrearBoleta(){
			

			if($_POST){

				$idEncargado = $_POST['idEncargado'];
				$numProforma = $_POST['numProforma'];
				$dni = $_POST['txtdni'];
				$nombreUsuario  = $_POST['txtNombreCliente'];
				

				$requestFactura = $this->model->generarBoleta($idEncargado,$numProforma,$dni,$nombreUsuario);
				//dep($requestFactura);

				if($requestFactura=="correcto"){
					$arrResponse = array("status"=>true,"msg"=>"Boleta generada con éxito.");
				
					}
					if(is_array($requestFactura)){
					$arregloString = implode("\n", $requestFactura);
					//echo $arregloString;
					 /*if($requestFactura=="stockInsuficiente")*/
					 if(count($requestFactura)>1){
						$arrResponse = array("status"=>false,"msg"=>"Stock insuficiente en los siguientes productos:\n\n",'data'=>$arregloString);}
						if(count($requestFactura)==1){
						$arrResponse = array("status"=>false,"msg"=>"Stock insuficiente en el siguiente producto:\n\n",'data'=>$arregloString);}
					}
			

				
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}	

			die();

		}



		public function prueba2(){
			$arreglo = array("Pera","Manzana","Platano","Melocoton");
			$arregloString = implode("<br>", $arreglo);

			print_r($arreglo);
			echo "<br>";
			echo "La cadena es: <br> {$arregloString}";
		}

		public function prudebita(){
			$request = $this->model->prueba();
			$arregloString = implode("<br>", $request);

			//echo $request;
			dep($request);
			echo "<br>";
			echo "La cadena es: <br> {$arregloString}";
		}

		/*public function CrearFactura(){
			



				$requestFactura = $this->model->generarFactura();
				echo $requestFactura;
				
			die();
		}
			*/




	}
 ?>