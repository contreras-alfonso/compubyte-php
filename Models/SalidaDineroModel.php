<?php 

	class SalidaDineroModel extends Mysql
	{

		public $intIdSalida;
		public $strComprobante;
		public $fltImporte;
		public $strDetalle;
		public $intIdtrabajador;

		public function __construct()
		{
			parent::__construct();
		}

		public function obtenerAuxSalidas(){
			$sql = "SELECT * FROM auxiliarsalidas";
			$request = $this->select_all($sql);

			return $request;
		}

		public function EliminarAuxSalida(int $idsalida){
			$this->intIdSalida=$idsalida;

			$sql = "DELETE FROM auxiliarsalidas WHERE idsalida = '{$this->intIdSalida}'";
			$request = $this->delete($sql);

			return $request;

		}

		public function agregarSalidasAuxi(String $nmrComprobante, float $importe , String $detalle){
		 $this->strComprobante= $nmrComprobante;
		 $this->fltImporte= $importe;
		 $this->strDetalle= $detalle;

		 $sql = "INSERT INTO auxiliarsalidas(comprobante,importe,detalle) VALUES(?,?,?)";
		 $arrData = array($this->strComprobante,$this->fltImporte,$this->strDetalle);

		 $request= $this->insert($sql,$arrData);
		 return $request;

		}

		public function agregarSalidasReal(int $idTrabajador){

			$this->intIdtrabajador = $idTrabajador;

			$sqlSalidasAux = "SELECT * FROM auxiliarsalidas";
			$requestSalidasAux = $this->select_all($sqlSalidasAux);

			if(!empty($requestSalidasAux)){

				$repuesta = "agregado";
			for ($i=0; $i < count($requestSalidasAux) ; $i++) { 
				$sqlInsert ="INSERT INTO salidas(personaid,detalle,numeroComprobante,importe,fecha) VALUES(?,?,?,?,?)";
				$arrData = array($this->intIdtrabajador,$requestSalidasAux[$i]['detalle'],$requestSalidasAux[$i]['comprobante'],floatval($requestSalidasAux[$i]['importe']),$requestSalidasAux[$i]['fecha']);
				$request = $this->insert($sqlInsert,$arrData);

				
			}

			$sqlDelete = "DELETE FROM auxiliarsalidas";
				$requestDelete = $this->delete($sqlDelete);
			}else{
				$repuesta = "vacio";
			}
			return $repuesta;

		}	
	}
 ?>