<?php 

	class Proformas extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
					
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/login');
			}

			getPermisos(3);

			if(empty($_SESSION['permisos'][3]['r'])){
				header('location:'.base_url().'/inicio');
			}

		}



		public function proformas()
		{
			$data['page_id'] = 5;
			$data['page_tag'] = "Proformas";
			$data['page_title'] = "Proformas";
			$data['page_name'] = "Proformas";
			$data['page_functions_js'] = "functions_proformas.js";
			
			$this->views->getView($this,"proformas",$data);
		}



		public function getselectCategorias(){

			$htmlOptions = "";
			$arrData = $this->model->selectCategorias();

			if(count($arrData)>0){
				for ($i=0; $i <count($arrData) ; $i++) { 
					$htmlOptions .= '<option value="'.$arrData[$i]['idcategoria'].'" >'.$arrData[$i]['nombrecategoria'].'</option>';
				}
			}

			echo $htmlOptions;
			die();

			
		}

		public function getProductos(int $idcategoria){

			$htmlOptions = "";
			$arrData = $this->model->selectProductos($idcategoria);
			//$arrData = $this->model->selectProductos(1);

			if(count($arrData)>0){
				$htmlOptions .= '<option value="100" disabled="">Selecciona el producto</option>';
				for ($i=0; $i <count($arrData); $i++) { 
					$htmlOptions .= '<option value="'.$arrData[$i]['idproducto'].'" >'.$arrData[$i]['nombreproducto'].'</option>';
				}
			}

			echo $htmlOptions;
			die();


		}	

		public function getPrecio(int $idProducto){
			$arrData = $this->model->obtenerPrecio($idProducto);

			if(empty($arrData)){
			//	$precio = $arrData['precio'];
			//	echo $arrData;
				$arrResponse = array('status'=>false,'msg'=>'Datos no encontrados.');
				
			}else{
				$arrResponse = array('status'=>true,'data'=>$arrData);
			}

			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getProductosProforma(){

			$arrData = $this->model->obtenerProductosProforma();


			for ($i=0; $i < count($arrData) ; $i++) { 
				$arrData[$i]['options'] = '<div class="text-center">

					<button class="btn btn-danger btnDelProductoProforma" onClick="fntDelProductoProforma('.$arrData[$i]['idproforma'].')"  title="Eliminar" type="button"><i class="fa-solid fa-trash"></i></button>

				</div>';
			}


			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();


		}


		public function setProductoProforma(){

			if($_POST){

				$floatCantidad = floatval($_POST['txtCantidad']);
				//producto
				$idProducto = intval($_POST['listProducto']);
				$floatPrecio = floatval($_POST['txtPrecio']);
				$floatSubtotal = $floatCantidad*$floatPrecio;

				$requestProducto = $this->model->agregarProductoProforma($floatCantidad,$idProducto,$floatPrecio,$floatSubtotal);

				if($requestProducto=="agregado"){

					$arrResponse = array("status"=>true,"msg"=>"Producto agregado.");
				}else if($requestProducto=="existe") {
					$arrResponse = array("status"=>false,"msg"=>"El producto ya está añadido a la lista.");
				}else{
					$arrResponse = array("status"=>false,"msg"=>"Ocurrio un error.");
				}
				

				

				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);


			}

			die();
			
		}

		public function delProductoProforma(){
			if ($_POST) {
				$intIdProductoProforma = intval($_POST['idProducto']);

				$requestDelete = $this->model->eliminarProductoProforma($intIdProductoProforma);

				if($requestDelete>0){
					$arrData = array("status"=>true,"msg"=>"Producto eliminado con exito de la lista.");
				}else{
					$arrData = array("status"=>false,"msg"=>"No se pudo eliminar el producto");
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function delProductosAuxProforma(){
			$requestDelete = $this->model->eliminarProductosAuxProforma();

			if($requestDelete>0){
				$arrData = array("status"=>true);
			}else{
				$arrData = array("status"=>false);
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function crearProforma(){

			
		$nombreUsuario = $_POST['nombreEncargado'];
			//echo $nombreUsuario;
			//$nombreUsuario = "juan";
		
		//die();
			$request = $this->model->crearTablaProforma($nombreUsuario);

			//echo $request;
			//dep($request);
		//	die();
			if($request=="agregado"){
				$arrData = array("status"=>true,"msg"=>"Proforma generada exitosamente.");
				$this->model->eliminarProductosAuxProforma();
			}else if($request=="vacio"){
				$arrData = array("status"=>false,"msg"=>"No existen productos agregados.");
			}else{
				$arrData = array("status"=>false,"msg"=>"Ocurrió algo.");
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();

			
		}

			/*	public function crearProforma(){

			
		
			$nombreUsuario = "juan";
		
			$request = $this->model->crearTablaProforma($nombreUsuario);

			//echo $request;
			dep($request);
		

			
		}*/

		public function getProformas(){
			$arrData = $this->model->obtenerProformas();

			for ($i=0; $i < count($arrData) ; $i++) { 
				$arrData[$i]['options'] = '<div class="text-center">

					<a href="http://localhost/tienda_virtual/Proformas/confirmProforma/'.$arrData[$i]['idpedido'].'"><button class="btn btn-primary" title="Ver proforma" type="button"><i class="fa-solid fa-eye"></i></button></a>

					<button class="btn btn-secondary btnDelProductoProforma" onClick="fntDelProforma('.$arrData[$i]['idpedido'].')"  title="Eliminar" type="button"><i class="fa-solid fa-trash"></i></button>



				</div>';
			}

			if(isset($arrData)){
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				die();
			}

		}

		public function confirmProforma(string $params){

			if(empty($params)){
				header('Location:'.base_url()."/Proformas");
			}else{

				$arrParams = explode(',',$params);
				$nroProforma = intval(strClean($arrParams[0]));

				$arrResponse = $this->model->obtenerDatosProforma($nroProforma);

				if(empty($arrResponse)){
					header('Location:'.base_url()."/Proformas");
				}else{

					$_SESSION['productosProforma'] = $arrResponse;
					$data['asesor'] = $arrResponse[0]['encargado'];
					$data['numeroProforma'] = $nroProforma;
					$data['importeTotal'] = $this->model->ObtenerImporteTotal($nroProforma);
					$this->views->getView($this,"mostrar_proforma",$data);
				}
				
		}
			}




		public function delProforma(){
					if ($_POST) {
				$intIdProforma = intval($_POST['idProforma']);

				$requestDelete = $this->model->eliminarProforma($intIdProforma);

				if($requestDelete>0){
					$arrData = array("status"=>true,"msg"=>"Proforma eliminada con exito.");
				}else{
					$arrData = array("status"=>false,"msg"=>"No se pudo eliminar la proforma.");
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function pruebitass(){
			$frase = "zapatito roto dile a tu mamita";
			$palabrastres = cortarFrase($frase);
			echo $palabrastres;
		}

	}
 ?>