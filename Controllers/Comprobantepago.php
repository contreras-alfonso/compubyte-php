<?php 

	class Comprobantepago extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
						
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/login');
			}

			getPermisos(4);

			if(empty($_SESSION['permisos'][4]['r'])){
				header('location:'.base_url().'/inicio');
			}

		}

		public function comprobantepago()
		{
			$data['page_id'] = 7;
			$data['page_tag'] = "Facturas";
			$data['page_title'] = "Facturas";
			$data['page_name'] = "Facturas";
			$this->views->getView($this,"comprobantepago",$data);
		}

		public function confirmFactura(string $params){

			if(empty($params)){
				header('Location:'.base_url()."/comprobante");
			}else{

				$arrParams = explode(',',$params);
				$idFactura = strClean($arrParams[0]);

				//aqui obtendre señores(razon social),RUC,direccionCliente, IDFactura, PEDIDOID
				$arrResponse = $this->model->buscarFactura($idFactura);
				//obteniendo el id pedido
				
				if(empty($arrResponse['ruc'])){
					header('Location:'.base_url()."/comprobante");
				}


				if(empty($arrResponse)){
					header('Location:'.base_url()."/comprobante");
				}else{
					$idPedido = $arrResponse['pedidoid'];
					//obteniendo todos los productos de la factura
					$ProductosPedido = $this->model->buscarProductosPedido($idPedido);
					//obteniendo el totalDeLaCompra
					$ImporteTotal = $this->model->ObtenerImporteTotal($idPedido);
					$data['idfactura']=$idFactura;
					$data['fechaEmision']=$arrResponse['datecreated'];
					$data['señores']=$arrResponse['razonsocial'];
					$data['ruc']=$arrResponse['ruc'];
					$data['direccion']=$arrResponse['direccion'];
					$data['productos'] = $ProductosPedido;
					$data['total'] = $ImporteTotal;
					$_SESSION['arrProductos'] = $ProductosPedido;
					$this->views->getView($this,"mostrar_factura",$data);
				}


			}

			die();


		}



		public function confirmBoleta(string $params){

			if(empty($params)){
				header('Location:'.base_url()."/comprobante");
			}else{

				$arrParams = explode(',',$params);
				$idFactura = strClean($arrParams[0]);

				//aqui obtendre señores(razon social),RUC,direccionCliente, IDFactura, PEDIDOID
				$arrResponse = $this->model->buscarFactura($idFactura);
				//obteniendo el id pedido
				
				if(empty($arrResponse['dni'])){
					header('Location:'.base_url()."/comprobante");
				}


				if(empty($arrResponse)){
					header('Location:'.base_url()."/comprobante");
				}else{
					$idPedido = $arrResponse['pedidoid'];
					//obteniendo todos los productos de la factura
					$ProductosPedido = $this->model->buscarProductosPedido($idPedido);
					//obteniendo el totalDeLaCompra
					$ImporteTotal = $this->model->ObtenerImporteTotal($idPedido);
					$data['idfactura']=$idFactura;
					$data['fechaEmision']=$arrResponse['datecreated'];
					$data['señores']=$arrResponse['nombres'];
					$data['dni']=$arrResponse['dni'];
					$data['productos'] = $ProductosPedido;
					$data['total'] = $ImporteTotal;
					$_SESSION['arrProductos'] = $ProductosPedido;
					$this->views->getView($this,"mostrar_boleta",$data);
				}


			}

			die();


		}

		/*public function pruebita(){
			$ImporteTotal = $this->model->ObtenerImporteTotal2();
			echo ($ImporteTotal);

		}
*/
	}
 ?>