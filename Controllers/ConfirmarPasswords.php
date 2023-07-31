<?php 

	class ConfirmarPasswords extends Controllers{
		public function __construct()
		{
			parent::__construct();

			session_start();

			if(empty($_SESSION['cambiarContraseña'])){
				header('location:'.base_url().'/inicio');
			}
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/inicio');
			}

			
		}

		public function confirmarPasswords(){
			$this->views->getView($this,"confirmarPasswords");
		}

		public function updatePassword(){
			if($_POST){
				$email = $_POST['txtemail'];
				$password = hash("SHA256", $_POST['txtpassword']);

				$request = $this->model->actualizarPassword($email,$password);

				if($request=="cambiado"){
					$arrData = array('status'=>true,'msg'=>"Contraseña actualizada correctamente.");
				}

				if($request=="contrasIguales"){
					$arrData = array('status'=>false,'msg'=>"La nueva contraseña no puede ser igual a la anterior.");
				}


				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				die();

			}
		}

	}

 ?>