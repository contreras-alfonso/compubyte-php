<?php 

	class ProformasModel extends Mysql
	{

		public $intIdproducto;
		public $intCategoriaid;
		public $strNombreproducto;
		public $intStock;
		public $fltPrecio;
		public $intCantidad;
		public $floatSubtotal;
		public $strEncargado;
		public $intPedidoId;
		public $intIdproformas;


		public function __construct()
		{
			parent::__construct();
		}


		public function selectCategorias(){

			$sql = "SELECT * FROM categoria";

			$request = $this->select_all($sql);

			return $request;

		}


		public function selectProductos(int $idcategoria){
			$this->intIdproducto = intval($idcategoria);

			$sql = "SELECT * FROM producto WHERE categoriaid = '{$this->intIdproducto}'";

			$request = $this->select_all($sql);

			return $request;
		}

		public function obtenerPrecio(int $idproducto){

			$this->intIdproducto = intval($idproducto);

			$sql = "SELECT * FROM producto WHERE idproducto = '{$this->intIdproducto}'";

			$request = $this->select($sql);

			return $request;
		}

		public function obtenerProductosProforma(){
			$sql = "SELECT * FROM auxiliarproforma";
			$request = $this->select_all($sql);
			return $request;
		}

		public function agregarProductoProforma(float $cantidad,int $idproducto,float $precio,float $subtotal){
			$this->intCantidad=$cantidad;
			$this->intIdproducto = $idproducto;
			$this->fltPrecio = $precio;
			$this->floatSubtotal = $subtotal;

			$sqlProducto = "SELECT * FROM producto WHERE idproducto = '{$this->intIdproducto}'";
			$requestProducto = $this->select($sqlProducto);


			$nombreProducto = $requestProducto['nombreproducto'];

			$sqlBusqueda = "SELECT * FROM auxiliarproforma WHERE producto = '{$nombreProducto}' ";
			$requestBusqueda = $this->select($sqlBusqueda);

			if(empty($requestBusqueda)){
				$respuesta = "agregado";
				$query_insert = "INSERT INTO auxiliarproforma(producto,precio,cantidad,subtotal) VALUES (?,?,?,?) ";

			$arrData = array($nombreProducto,$this->fltPrecio,$this->intCantidad,$this->floatSubtotal);
			$request_insert = $this->insert($query_insert,$arrData);
			}else{
				$respuesta = "existe";
			}

			return $respuesta;
		}


		public function eliminarProductoProforma(int $idproducto){
			$this->intIdproducto= $idproducto;

			$sql = "DELETE FROM auxiliarproforma WHERE idproforma = '{$this->intIdproducto}'";
			$requestDelete = $this->delete($sql);

			return $requestDelete;
		}

		public function eliminarProductosAuxProforma(){

			$sqlBusqueda = "SELECT * FROM auxiliarproforma";
			$requestSelect = $this->select_all($sqlBusqueda);



			for ($i=0; $i < count($requestSelect); $i++) { 
				$sqlDelete = "DELETE FROM auxiliarproforma WHERE idproforma = '{$requestSelect[$i]['idproforma']}' ";
				$requestDelete = $this->delete($sqlDelete);
			}



			return $requestDelete;
		}	

		public function crearTablaProforma(string $nombreUsuario){


				
			//2.Obtener el array de productos de la tabla auxiliar proforma


			$sqlProductosAuxProforma = "SELECT * FROM auxiliarproforma";
			$requestProductosAuxProforma = $this->select_all($sqlProductosAuxProforma);
			
		
			if(!empty($requestProductosAuxProforma)){

				$this->strEncargado = $nombreUsuario;
			$sql = "INSERT INTO pedido (idpedido) VALUES (?)";
			$arrData = array(NULL);
			//1. obtengo el ID del pedido
			$requestidpedido = $this->insert($sql,$arrData);

				$respuesta = "agregado";

			for ($i=0; $i <count($requestProductosAuxProforma) ; $i++) { 

				$nombreDeproducto = "{$requestProductosAuxProforma[$i]['producto']}";

	$sqlBuscarIdproducto = "SELECT idproducto FROM producto WHERE nombreproducto = '{$nombreDeproducto}' ";

				// 3.Capturando el idproducto segun el nombre
				$idproducto = $this->select($sqlBuscarIdproducto);
				$idproductoReal = $idproducto['idproducto'];
				// 4.Capturando el precio
				$precio = "{$requestProductosAuxProforma[$i]['precio']}";
				// 5.Capturando la cantidad
				$cantidad = "{$requestProductosAuxProforma[$i]['cantidad']}";

				$subtotal = "{$requestProductosAuxProforma[$i]['subtotal']}";
				
				//6.Agregando los productos de la tabla auxiliarproforma a la tabla proforma
				$sqlProforma = "INSERT INTO proforma(productoid,precio,cantidad,subtotal,encargado,pedidoid) VALUES(?,?,?,?,?,?)";

				$arrData = array(intval($idproductoReal),floatval($precio),intval($cantidad),floatval($subtotal),$this->strEncargado,$requestidpedido);

				$requestInsert  = $this->insert($sqlProforma,$arrData);
			}

			}else{
					$respuesta = "vacio";
			}
			
			return $respuesta;
			//return $idproducto;
			//return $requestProductosAuxProforma;
		}


		public function obtenerProformas(){
			
			//ROL HACIA PERSONA 1 A 3    PEDIDO HACIA PROFORMA

		
				$sql = "SELECT  DISTINCT  p.idpedido ,   r.datecreated as fechaRegistro , r.encargado FROM proforma r INNER JOIN pedido p ON  r.pedidoid =p.idpedido";

				$arrData = $this->select_all($sql);


				return $arrData;

		}
		

		/*public function crearTablaProforma(string $nombreUsuario){




			$sqlProductosAuxProforma = "SELECT * FROM auxiliarproforma";
			$requestProductosAuxProforma = $this->select_all($sqlProductosAuxProforma);
			
		
			if(!empty($requestProductosAuxProforma)){
				$respuesta = "agregado";

			for ($i=0; $i <count($requestProductosAuxProforma) ; $i++) { 

				$nombreDeproducto = "{$requestProductosAuxProforma[$i]['producto']}";

	$sqlBuscarIdproducto = "SELECT idproducto FROM producto2 WHERE nombreproducto = '{$nombreDeproducto}' ";

				// 3.Capturando el idproducto segun el nombre
				$idproducto = $this->select($sqlBuscarIdproducto);
				$idproducto2 = $idproducto['idproducto'];
				//$idstrproducto = " ASDSA";
				
			}

			}else{
					$respuesta = "vacio";
			}
			
			
			return $idproducto2;
			//return $requestProductosAuxProforma;
		}*/

		public function eliminarProforma(int $idProforma){
			$this->intIdproformas = $idProforma;
			$sql = "DELETE FROM proforma WHERE pedidoid = '{$this->intIdproformas}' ";
			$requestDelete = $this->delete($sql);

			$sqlDeleteidPedido = "DELETE FROM pedido WHERE idpedido = '{$this->intIdproformas}'";
			$requestDeleteidPedido = $this->delete($sqlDeleteidPedido);

			return $requestDelete;
		}

		public function obtenerDatosProforma(int $idproforma){
			$this->intIdproformas = $idproforma;
			$sql = "SELECT pr.cantidad, pr.precio, pr.subtotal, pr.encargado, f.codigo, f.nombreproducto FROM proforma pr INNER JOIN producto f ON f.idproducto = pr.productoid WHERE pr.pedidoid = '{$this->intIdproformas}'";
			$request = $this->select_all($sql);

			return $request;

		}

		public function ObtenerImporteTotal(int $idpedido){
			$this->intIdproformas= intval($idpedido);
			$sql = "SELECT SUM(subtotal) FROM proforma WHERE pedidoid='{$this->intIdproformas}'";
			$request = $this->select($sql);
			$subtotal = round($request['SUM(subtotal)'],3);
			//obteniendo los productos relacionado a la factura
			return $subtotal;
		}
	}
 ?>