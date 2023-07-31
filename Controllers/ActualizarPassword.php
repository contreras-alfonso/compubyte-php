<?php 

	class ActualizarPassword extends Controllers{
		public function __construct()
		{
			parent::__construct();

			session_start();
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/inicio');
			}

			
		}

		public function actualizarPassword()
		{
			
			$data['page_tag'] = "Actualizar contraseña";
			$data['page_title'] = "Actualizar contraseña";
			$data['page_name'] = "Actualizar contraseña";
			$this->views->getView($this,"actualizarPassword",$data);
		}


		

		public function confirmUser(){

			if($_POST){

				$email = $_POST['txtemail'];
				$password = hash("SHA256", $_POST['txtpassword']);

				$request = $this->model->confirmarUsuario($email,$password);

				if(!empty($request)){
					$arrData = array('status'=>true,'msg'=>"Confirmado que eres el usuario.",'data'=>$request);
					$_SESSION['cambiarContraseña'] = true;
					// unset($_SESSION['login']); 
				}else{
					$arrData = array('status'=>false,'msg'=>"La contraseña ingresada no es correcta.");
					$_SESSION['cambiarContraseña'] = false;
				}

			//	dep($arrData);
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				die();


			}

		}

				public function pruebaa(){

			

				$email = "1923010051@untels.edu.pe";
				$password = hash("SHA256", "alfonso123");

				$request = $this->model->confirmarUsuario($email,$password);

				if(!empty($request)){
					$arrData = array('status'=>true,'msg'=>"Confirmado que eres el usuario.",'data'=>$request);
				}else{
					$arrData = array('status'=>false,'msg'=>"La contraseña no es correcta.");
				}

			//	dep($arrData);
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				die();


			

		}



	}
 ?>