<?php 

	class ReporteCajaModel extends Mysql
	{

		public $strFechaInicio;
		public $strFechaFinal;
		public $arrArregloReportes;

		public function __construct()
		{
			parent::__construct();
		}

		public function listadoReporteIngresos(string $fechaInicio, string $fechaFinal){

			$this->strFechaInicio=$fechaInicio;
			$this->strFechaFinal=$fechaFinal;

			$sql = "SELECT f.idfactura,p.idpedido,p.estado_comprobante,f.razonsocial,f.nombres,f.datecreated FROM pedido p INNER JOIN comprobantes f ON f.pedidoid = p.idpedido WHERE ((f.datecreated >= '{$this->strFechaInicio}') AND (f.datecreated <= '{$this->strFechaFinal}'))";
			$request = $this->select_all($sql);

			return $request;

		}


		public function listadoReporteSalidas(string $fechaInicio, string $fechaFinal){

			$this->strFechaInicio=$fechaInicio;
			$this->strFechaFinal=$fechaFinal;

			$sql = "SELECT * FROM salidas WHERE ((fecha >= '{$this->strFechaInicio}') AND (fecha <= '{$this->strFechaFinal}'))";

			$request = $this->select_all($sql);

			return $request;

		}


		public function obtenerSubTotalReporte(array $arregloReporte){

			$this->arrArregloReportes = $arregloReporte;

			$ReporteSubTotal = array();

			

			for ($i=0; $i < count($this->arrArregloReportes) ; $i++) { 

				$sql = "SELECT SUM(subtotal) FROM proforma WHERE pedidoid = '{$this->arrArregloReportes[$i]['idpedido']}' ";
				$request = $this->select($sql);

				array_push($ReporteSubTotal, $request['SUM(subtotal)']);
			}

			return $ReporteSubTotal;
			//return $request;	

		}

				public function obtenerSubTotalSalidas(array $arregloReporte){

			$this->arrArregloReportes = $arregloReporte;

			$ReporteSubTotal = array();

			

			for ($i=0; $i < count($this->arrArregloReportes) ; $i++) { 

				$sql = "SELECT SUM(importe) FROM salidas WHERE idsalida = '{$this->arrArregloReportes[$i]['idsalida']}' ";
				$request = $this->select($sql);

				array_push($ReporteSubTotal, $request['SUM(importe)']);
			}

			return $ReporteSubTotal;
			//return $request;	

		}			
	}
 ?>