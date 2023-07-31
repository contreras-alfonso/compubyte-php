<?php 

	class Inicio extends Controllers{
		public function __construct()
		{
			parent::__construct();

			session_start();
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/login');
			}

				//para eliminar una variable de session
			  unset($_SESSION['cambiarContraseña']);   

			getPermisos(1);


		/*	if(empty($_SESSION['permisos'][1]['r'])){
				header('location:'.base_url().'/logout');
			}
*/
			
		}

		public function inicio()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Inicio - Tienda Virtual";
			$data['page_title'] = "Inicio - Tienda Virtual";
			$data['page_name'] = "inicio";
			$this->views->getView($this,"inicio",$data);
		}

	}
 ?>