<?php 

	class ComprobantepagoModel extends Mysql
	{
		public $intIdfactura;
		public $intIdpedido;
		public function __construct()
		{
			parent::__construct();
		}

		public function buscarFactura(string $idfactura){
			//aqui obtendre señores(razon social),RUC,direccionCliente, IDFactura, PEDIDOID
			$this->intIdfactura = $idfactura;
			$sql = "SELECT * FROM comprobantes WHERE idfactura= '{$this->intIdfactura}'";
			$request = $this->select($sql);

			return $request;
		}

		public function buscarProductosPedido(int $idpedido){
			$this->intIdpedido= intval($idpedido);
			//$sql = "SELECT * FROM proforma WHERE pedidoid = '{$this->intIdpedido}' ";
			$sql = "SELECT pr.cantidad, pr.precio, f.codigo, f.nombreproducto FROM proforma pr INNER JOIN producto f ON f.idproducto = pr.productoid WHERE pr.pedidoid = '{$this->intIdpedido}'";
			$request = $this->select_all($sql);
			//$sql = "SELECT * FROM proforma WHERE idproforma = 58";
			//$request = $this->select($sql);
			//obteniendo los productos relacionado a la factura
			return $request;
		}

		public function ObtenerImporteTotal(int $idpedido){
			$this->intIdpedido= intval($idpedido);
			$sql = "SELECT SUM(precio) FROM proforma WHERE pedidoid='{$this->intIdpedido}'";
			$request = $this->select($sql);
			$subtotal = round($request['SUM(precio)'],3);
			//obteniendo los productos relacionado a la factura
			return $subtotal;
		}

		/*public function ObtenerImporteTotal2(){
			
			$sql = "SELECT SUM(subtotal) FROM proforma WHERE pedidoid=139";
			$request = $this->select($sql);
			$subtotal = $request['SUM(subtotal)'];
			//obteniendo los productos relacionado a la factura
			return $subtotal;
		}*/


	}
 ?>