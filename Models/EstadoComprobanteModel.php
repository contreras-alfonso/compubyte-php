<?php 

	class EstadoComprobanteModel extends Mysql
	{
		public $intIdpedido;
		public $strNombre;
		public $strTelefono;
		public $strDni;
		public $strDireccion;
		public $strReferencia;

		public function __construct()
		{
			parent::__construct();
		}

		public function obtenerProformas(){
			$sql = "SELECT f.idfactura, p.idpedido,p.status,p.estado_comprobante,f.razonsocial,f.nombres,f.datecreated FROM pedido p INNER JOIN comprobantes f ON f.pedidoid = p.idpedido ORDER BY p.status ASC";

			$request = $this->select_all($sql);
			return $request;
		}

		public function actualizarEstadoComprobante($idpedido){
			$this->intIdpedido = $idpedido;
			$sql = "UPDATE pedido SET status=? WHERE idpedido= '{$this->intIdpedido}' ";
			$arrData = array(1);
			$request = $this->update($sql,$arrData);

			$variable = "";

			if($request>0){
				$variable="Actualizado";
			}

			return $variable;

		}

		public function asignarDatosEnvioDomicilio(int $idpedido, string $nombre, string $telefono, string $dni, string $direccion,string $referencia){

		 $this->intIdpedido=$idpedido;
		 $this->strNombre=$nombre;
		 $this->strTelefono=$telefono;
		 $this->strDni=$dni;
		 $this->strDireccion=$direccion;
		 $this->strReferencia=$referencia;

		 $sql = "UPDATE comprobantes SET nombre_receptor=?, telefono_receptor=?,dni_receptor=?,direccion_receptor=?,referencia_receptor=? WHERE pedidoid='{$this->intIdpedido}' ";

		 $arrData = array($this->strNombre,$this->strTelefono,$this->strDni,$this->strDireccion,$this->strReferencia);


		 $request = $this->update($sql,$arrData);

		 $sqlUpdate = "UPDATE pedido SET status=? WHERE idpedido= '{$this->intIdpedido}' ";
			$arrDataUpdate = array(2);
			$requestUpdate = $this->update($sqlUpdate,$arrDataUpdate);

		 $variable = "";
		 if($request>0){
				$variable="DatosAsignados";
			}

			return $variable;

		}

	}
 ?>