<?php 

	class EstadoComprobante extends Controllers{
		public function __construct()
		{
			parent::__construct();

			session_start();
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/login');
			}

			getPermisos(5);

			if(empty($_SESSION['permisos'][5]['r'])){
				header('location:'.base_url().'/inicio');
			}
			
		}

		public function estadoComprobante()
		{
			$data['page_id'] = 8;
			$data['page_tag'] = "Estado de comprobante";
			$data['page_title'] = "Estado de comprobante";
			$data['page_name'] = "Estado de comprobante";
			$this->views->getView($this,"estadoComprobante",$data);
		}


		public function getProformas(){
			$arrData = $this->model->obtenerProformas();
			//dep($arrData);

			if(!empty($arrData)){
				for ($i=0; $i < count($arrData); $i++) { 
				
					//si el estado es 0 , es decir aun no se ha cambiado el estado del comprobante, sucedera:

					if($arrData[$i]['status']==0){

					$arrData[$i]['status'] = '<div class="text-center"><h5><span class="badge badge-success">Activo</span></h5></div>';
					$arrData[$i]['options']='<div class="text-center">

				<button class="btn btn-info btnViewUsuario" onClick="despachoEnTienda('.$arrData[$i]['idpedido'].',`'.$arrData[$i]['idfactura'].'`);" title="Ver usuario" type="button"><i class="fa-sharp fa-solid fa-people-carry-box"></i> Despacho en tienda</button>

				<button class="btn btn-secondary btnEditUsuario" onClick="fntEnvioDomicilio('.$arrData[$i]['idpedido'].',`'.$arrData[$i]['idfactura'].'`)"  title="Editar usuario" type="button"><i class="fa-solid fa-truck-moving"></i> Envio a domicilio</button>

				


				</div>';

					}else{
						$arrData[$i]['status'] = '<div class="text-center"><h5><span class="badge badge-danger">Inactivo</span></h5></div>';
					$arrData[$i]['options'] = '';
					}
					
					//si es una factura
					if($arrData[$i]['estado_comprobante']==1){
						//$arrData[$i]['cliente'] == $arrData[$i]['nombres'];
						$arrData[$i]['estado_comprobante'] = '<div class="text-center"><h5><span class="badge badge-secondary">Boleta</span></h5></div>';
					}
					
					//si es una boleta
					if($arrData[$i]['estado_comprobante']==2){
						//$arrData[$i]['cliente'] == $arrData[$i]['razonsocial'];
						$arrData[$i]['estado_comprobante'] = '<div class="text-center"><h5><span class="badge badge-secondary">Factura</span></h5></div>';
					}


					//si esta vacio
					if(empty($arrData[$i]['razonsocial'])){
						$arrData[$i]['nombrePersona'] = strtoupper($arrData[$i]['nombres']);
					}else{
						$arrData[$i]['nombrePersona'] = $arrData[$i]['razonsocial'];
					}


					//idfactura - cliente - status - tipo_comprobante - options

				}
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function updateEstadoComprobante($idpedido){
			$numeroPedido = intval($idpedido);

			$request = $this->model->actualizarEstadoComprobante($idpedido);

			if($request=="Actualizado"){
				$arrData = array('status'=>true,'msg'=>"Estado del comprobante actualizado correctamente.");
			}else{
				$arrData = array('status'=>false,'msg'=>"No se pudo actualizar el estado.");
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();

		}

		public function setEnvioDomicilio(){
			if($_POST){

				$idPedido =  intval($_POST['txtidPedido']);
				$nombre = $_POST['txtNombre'];
				$telefono = $_POST['txttelefono'];
				$dni = $_POST['txtdni'];
				$direccion = $_POST['txtdireccion'];
				$referencia = $_POST['txtreferencia'];

				$request = $this->model->asignarDatosEnvioDomicilio($idPedido,$nombre,$telefono,$dni,$direccion,$referencia);

				if($request=="DatosAsignados"){
					$arrData = array('status'=>true,'msg'=>"Se asignaron los datos de envio correctamente.");
				}else{
					$arrData = array('status'=>false,'msg'=>"No se pudo asignar los datos de envio.");
				}

				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();


			}
		}

		public function pruebita(){
			//$codigo = codigoRecuperacion();
			//echo $codigo;
			$fechaActual = date('d/m/y');
			echo $fechaActual;

		}

	}
 ?>