<?php 

	class ReporteCaja extends Controllers{
		public function __construct()
		{
			parent::__construct();

			session_start();
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/login');
			}

				//para eliminar una variable de session
			  unset($_SESSION['cambiarContraseña']);   

			  			getPermisos(6);

			if(empty($_SESSION['permisos'][6]['r'])){
				header('location:'.base_url().'/inicio');
			}
	
			
		}

		public function reporteCaja()
		{
			$data['page_id'] = 11;
			$data['page_tag'] = "Reporte de caja";
			$data['page_title'] = "Reporte de caja";
			$data['page_name'] = "Reporte de caja";
			$this->views->getView($this,"reporteCaja",$data);
		}

		public function listaReporteVentas($numOpcion){

			$numeroOpcion = intval($numOpcion);
			$fechaInicio = $_POST['txtfechaInicio'];
			$fechaFinal = $_POST['txtfechaFinal'];

			if($numeroOpcion==1){
			$request = $this->model->listadoReporteIngresos($fechaInicio,$fechaFinal);


			if(empty($request)){
					$arrData  = array('status'=>false,'msg'=>"No existen reportes de ventas en las fechas indicadas.");
				}else{
					$arrData  = array('status'=>true);
					$_SESSION['reporteVentas']=$request;
					$_SESSION['FechasdeReporteVenta']= 'Reportes de ventas desde '.$fechaInicio.' hasta '.$fechaFinal;
					

					$requestSubTotal = $this->model->obtenerSubTotalReporte($_SESSION['reporteVentas']);
					$_SESSION['subTotalReporteVentas']=$requestSubTotal;
				}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();

			}
		}

		public function listaReporteSalidas($numOpcion){

			$numeroOpcion = intval($numOpcion);
			$fechaInicio = $_POST['txtfechaInicio'];
			$fechaFinal = $_POST['txtfechaFinal'];

			if($numeroOpcion==2){
			$request = $this->model->listadoReporteSalidas($fechaInicio,$fechaFinal);


			if(empty($request)){
					$arrData  = array('status'=>false,'msg'=>"No existen reportes de salidas en las fechas indicadas.");
				}else{
					$arrData  = array('status'=>true);
					$_SESSION['reporteVentas']=$request;
					$_SESSION['FechasdeReporteVenta']= 'Reportes de salidas desde '.$fechaInicio.' hasta '.$fechaFinal;
					

					$requestSubTotal = $this->model->obtenerSubTotalSalidas($_SESSION['reporteVentas']);
					$_SESSION['subTotalReporteSalidas']=$requestSubTotal;
				}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();

			}
		}


			public function listadoReporteVentas(){

			$data['reporteVentas'] = $_SESSION['reporteVentas'];
			

			$this->views->getView($this,"listaReporteVentas",$data);
		}


			public function listadoReporteSalidas(){

			$data['reporteVentas'] = $_SESSION['reporteVentas'];
			

			$this->views->getView($this,"listaReporteSalidas",$data);
		}


		public function pruebita(){
			
			$requestSubTotal = $this->model->obtenerSubTotalReporte($_SESSION['reporteVentas']);
			dep($requestSubTotal);
		}

	}
 ?>