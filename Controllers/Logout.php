<?php 

	class Logout {
		public function __construct()
		{
			//inicializando ssesion
			session_start();
			//limpiando todas las variables de sesion
			session_unset();
			//destruyendo todas las sesiones
			session_destroy();
			header('location:'.base_url().'/login');
		}



	}
 ?>