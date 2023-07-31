<?php 

	class Usuarios extends Controllers{
		public function __construct()
		{
			parent::__construct();



			session_start();
			if(empty($_SESSION['login'])){
				header('location:'.base_url().'/login');
			}

			

			getPermisos(2);

			if(empty($_SESSION['permisos'][2]['r'])){
				header('location:'.base_url().'/inicio');
			}
		}

		public function Usuarios()
		{
			
			$data['page_tag'] = "Usuarios de COMPUBYTE";
			$data['page_title'] = "USUARIOS";
			$data['page_name'] = "usuarios";
			
			
			$this->views->getView($this,"usuarios",$data);
		}

		public function setUsuario(){
			// si post es verdadero, es decir si hay una peticion post
			if($_POST){
			
					$strIdentificacion = strClean($_POST['txtIdentificacion']);
					$idUsuario = intval($_POST['idUsuario']);
					$strNombre = ucwords(strClean($_POST['txtNombre']));
					$strApellido = ucwords(strClean($_POST['txtApellido']));
					$intTelefono = intval($_POST['txtTelefono']);
					//con strtolower convierte todo en minusculas
					$strEmail = strtolower(strClean($_POST['txtEmail'])); 
					$intTipoRol = intval($_POST['listRolid']);
					$intStatus = intval($_POST['listStatus']);

					if($idUsuario==0){
						$strPassword = empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);
						$option = 1;
						$request_user = $this->model->insertUsuario($strIdentificacion,$strNombre,$strApellido,$intTelefono,$strEmail,$strPassword,$intTipoRol,$intStatus);
					}else{

						$option = 2;
						$strPassword = empty($_POST['txtPassword']) ? "" : hash("SHA256" ,$_POST['txtPassword']);
						$request_user = $this->model->updateUsuario($idUsuario,$strIdentificacion,$strNombre,$strApellido,$intTelefono,$strEmail,$strPassword,$intTipoRol,$intStatus);


					}
	
					
					if($request_user == 'modificado'){
						
						if($option==1){
							$arrResponse = array("status"=>true,"msg"=>'Datos guardados correctamente');
						}else{
							$arrResponse = array("status"=>true,"msg"=>'Datos mofidicados correctamente');
						}
						
					}
					if($request_user == 'exist'){
						$arrResponse = array("status"=>false,"msg"=>'¡Atención! el alias o email ya existen, ingrese otro.');
					}/*else{
						$arrResponse = array("status"=>false,"msg"=>'Ocurrio un problema al almacenar los datos');
					}*/

				

				
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);	
			}
			die();
		}

		public function getUsuarios(){
			$arrData = $this->model->selectUsuarios();
			for ($i=0; $i < count($arrData); $i++) { 
				if($arrData[$i]['status']==1){
					$arrData[$i]['status']='<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status']='<span class="badge badge-danger">Inactivo</span>';
				}

				$arrData[$i]['options'] = '<div class="text-center">
				
				

				<button class="btn btn-secondary btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['idpersona'].')"  title="Editar usuario" type="button"><i class="fa-solid fa-pen-to-square"></i></button>

				<button class="btn btn-danger btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['idpersona'].')" title="Eliminar usuario" type="button"><i class="fa-solid fa-trash"></i></button>


				</div>';
			}

			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function getUsuario(int $idpersona){
			$idusuario = intval($idpersona);
			if ($idusuario>0) {
				$arrData = $this->model->selectUsuario($idusuario);
				if(empty($arrData)){
					$arrResponse = array('status'=>false,'msg'=>'Datos no encontrados.');
				}else{
					$arrResponse = array('status'=>true,'data'=>$arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);


			}

			die();
		}

		public function delUser(){

			if ($_POST) {
				$intIdpersona = intval($_POST['iduser']);

				$requestDelete = $this->model->deleteUser($intIdpersona);

				if($requestDelete){
					$arrResponse = array('status'=>true, 'msg'=>'Usuario eliminado con exito');
				}else{
					$arrResponse = array('status'=>false, 'msg'=>'No se pudo eliminar el usuario');
				}

				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
			
		}


				public function getSelectRoles()
		{
			$htmlOptions = "";
			$arrData = $this->model->selectRoles();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
					}
				}
			}
			
			echo $htmlOptions;
			die();		
		}



	}
 ?>