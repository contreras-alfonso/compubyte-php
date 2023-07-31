<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
							

require_once ('PHPMailer/Exception.php');
require_once ('PHPMailer/PHPMailer.php');
require_once ('PHPMailer/SMTP.php');

	class Login extends Controllers{
		public function __construct()
		{
			session_start();
			/*si existe la sesion activa y te diriges a http://localhost/tienda_virtual/login , te redirigira a http://localhost/tienda_virtual/dashboard

			*/
			if(isset($_SESSION['login'])){
				header('location:'.base_url().'/inicio');
			}
			parent::__construct();
		}

		public function login()
		{
			
			$data['page_tag'] = "Login - Tienda Virtual";
			$data['page_title'] = "COMPUBYTE";
			$data['page_name'] = "login";
			$data['page_functions_js'] = "getLogin.js";
			$this->views->getView($this,"login",$data);
		}


		public function confirmUser(string $params){

			if(empty($params)){
				header('Location:'.base_url()."/login");

			}else{
				
				$arrParams = explode(',',$params);

				$strEmail = strClean($arrParams[0]);
				$strToken = strClean($arrParams[1]);

				$arrResponse = $this->model->getUsuario($strEmail,$strToken);

				if(empty($arrResponse)){
					header('Location:'.base_url()."/login");
				}else{

			$data['page_tag'] = "Cambiar contraseña";
			$data['page_title'] = "COMPUBYTE";
			$data['page_name'] = "Cambiar contraseña COMPUBYTE";
			$data['idpersona'] = $arrResponse['idpersona'];
			$data['email']= $strEmail;
			$data['token']=$strToken;
			$data['page_functions_js'] = 'getLogin.js';

			$this->views->getView($this,"cambiar_password",$data);

				}
				
			}
			die();

	
		}

		public function loginUser(){

			if($_POST){

				$strEmail = strtolower(strClean($_POST['txtEmail']));
				$strPassword = hash("SHA256", $_POST['txtPassword']); 

				$requestUser = $this->model->getUser($strEmail,$strPassword);

				if(empty($requestUser)){

					$arrResponse = array('status'=>false,'msg'=>"El usuario o contraseña son incorrectos");
				}else{
					
					$arrData = $requestUser;
					if($arrData['status']==1){
						//creando las variables de sesion
						$_SESSION['idUser'] = $arrData['idpersona'];
						$_SESSION['login'] = true;
						$arrData = $this->model->sessionLogin($_SESSION['idUser']);
						$_SESSION['userData'] = $arrData;

						$arrResponse = array('status'=>true, 'msg'=>'ok');

					}else{
						$arrResponse = array('status'=>false, 'msg'=> 'Usuario inactivo');
					}
				}

				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

			}
			die();
		}


		public function resetPass(){
			if(empty($_POST['txtEmailReset'])){
				$arrResponse = array('status'=>false,'msg'=>"Error de datos");
			}else{
				$token = token();
				$strEmail = strtolower(strClean($_POST['txtEmailReset']));
				$arrData = $this->model->getUserEmail($strEmail);

				if(empty($arrData)){
					/*$arrResponse = array('status'=>false,'msg' => "Tu búsqueda no ha devuelto ningún resultado. Vuelve a intentar con otro correo.");*/
					$arrResponse = array('status'=>false,'msg' => "Correo no existente. Intente con otro");
				}else{
					$idpersona = $arrData['idpersona'];
					$nombreUsuario = $arrData['nombres'].' '.$arrData['apellidos'];

					$url_recovery = base_url().'/login/confirmUser/'.$strEmail.'/'.$token;

					

					//$dataUsuario = array('nombreUsuario'=>$nombreUsuario,'email'=>$strEmail,'asunto'=>'Recuperar cuenta - '.NOMBRE_REMITENTE, 'url_recovery'=>$url_recovery);





					$requestUpdate = $this->model->setTokenUser($idpersona,$token);

					if($requestUpdate){

						   $arrResponse = array('status'=>true,'msg'=>'Se ha enviado un correo a tu email, por favor revise su bandeja de entrada.');

						enviar_email($url_recovery);
						

					}else{
						$arrResponse = array('status'=>false,'msg'=>'No es posible realizar el proceso, regrese mas tarde.');
					}
				}
				
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setPassword(){
		if($_POST){

			if(empty($_POST['txtToken']) || empty($_POST['txtEmail']) || empty($_POST['idUsuario']) || empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm'])){
				$arrResponse = array('status'=>false,'msg'=>'Error de datos.');
			}else{
				$intIdpersona = intval($_POST['idUsuario']);
				$strPassword = $_POST['txtPassword'];
				$strEmail = strClean($_POST['txtEmail']);
				$strToken = strClean($_POST['txtToken']);
				$strPasswordConfirm = $_POST['txtPasswordConfirm'];

				if ($strPassword != $strPasswordConfirm) {
					$arrResponse = array('status'=>false,'msg'=>'Las contraseñas no son iguales.');
				}else{
					$arrResponse = $this->model->getUsuario($strEmail,$strToken);

					if(empty($arrResponse)){
						$arrResponse = array('status'=>false,'msg'=>'Error de datos.');
					}else{
						$strPassword = hash("SHA256",$strPassword);
						$requestPass = $this->model->RecuperarPassword($intIdpersona,$strPassword);

						if($requestPass){
							$arrResponse = array('status'=>true,'msg'=>'Tu contraseña ha sido actualizada.');
						}else{
							$arrResponse = array('status'=>false,'msg'=>'No fue posible realizar el proceso, intente mas tarde.');
						}
					}

					
				}
				
			}



		};
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();


		}

		
	}
 ?>