<?php 

	class SalidaDinero extends Controllers{
		public $strfecha;
			public $strDescri;
			public $strComprob;
			public $strPrecio;
		public function __construct()
		{
			

			parent::__construct();

			session_start();
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/login');
			}

				//para eliminar una variable de session
			  unset($_SESSION['cambiarContraseña']);   

			 			getPermisos(7);

			if(empty($_SESSION['permisos'][7]['r'])){
				header('location:'.base_url().'/inicio');
			} 
			
		}

		public function salidaDinero()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Salida de dinero";
			$data['page_title'] = "Registrar salida de dinero";
			$data['page_name'] = "Salida de dinero";
			$this->views->getView($this,"salidaDinero",$data);
		}

		public function pruebita(){

			 $this->strfecha="23Agos";
			 $this->strDescri="televisor";
			 $this->strComprob="ESEAE45";
			 $this->strPrecio="526.23";

			 unset($_SESSION['arraySalida']);   
			$_SESSION['arraySalida'] = array($this->strfecha,$this->strDescri,$this->strComprob,$this->strPrecio);
			dep($_SESSION['arraySalida']);
		}

		public function getSalidas(){
			$arrData = $this->model->obtenerAuxSalidas();

					for ($i=0; $i < count($arrData); $i++) { 
			

					$arrData[$i]['options'] = '<div class="text-center">

				<button class="btn btn-primary btnViewUsuario" onClick="fntEliminarSalida('.$arrData[$i]['idsalida'].')"  type="button">Eliminar</button>
				</div>';
					
				

				
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();

		}

		public function eliminarSalida($idSalida){

			$intIdSalida = intval($idSalida);

			$request = $this->model->EliminarAuxSalida($intIdSalida);

			if($request>0){
				$arrData = array('status'=>true,'msg'=>'Eliminado con éxito.');
			}else{
				$arrData = array('status'=>false,'msg'=>'No se pudo eliminar.');
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();	

		}


		public function agregarSalidaAux(){
			if($_POST){

				$numeroComprobante= $_POST['txtcomprobante'];
				$importe= $_POST['txtimporte'];
				$detalle = $_POST['txtdetalle'];

				$request = $this->model->agregarSalidasAuxi($numeroComprobante,$importe,$detalle);

		if($request>0){
				$arrData = array('status'=>true,'msg'=>'Agregado con éxito.');
			}else{
				$arrData = array('status'=>false,'msg'=>'No se pudo agregar.');
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();

			}
		}

		public function agregarSalidasReal($idTrabajador){

			$intIdtrabajador = intval($idTrabajador);

			$request = $this->model->agregarSalidasReal($intIdtrabajador);


			if($request=="agregado"){
				$arrData = array('status'=>true,'msg'=>'Salidas agregadas con exito.');
			}

			if($request=="vacio"){
				$arrData = array('status'=>false,'msg'=>'Aún no ha asignado salidas.');
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();

		}

	}
 ?>