<?php 

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strEmail;
		private $strPassword;
		private $strToken;

		public function __construct()
		{
			parent::__construct();
		}


		public function getUser(string $email, string $password){
			$this->strEmail = $email;
			$this->strPassword = $password;

			$sql = "SELECT idpersona,status FROM persona WHERE email_user = '{$this->strEmail}' and password ='{$this->strPassword}' ";

			$request = $this->select($sql);
			return $request;
		}

		public function sessionLogin(int $iduser){
			$this->intIdUsuario = $iduser;
			$sql = "SELECT p.idpersona,p.identificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.nit,p.nombrefical,p.direccionfiscal,r.idrol,r.nombrerol,p.status FROM persona p INNER JOIN rol r ON p.rolid=r.idrol WHERE p.idpersona = '{$this->intIdUsuario}'";
			$request = $this->select($sql);
			return $request;

		}

		public function getUserEmail(string $email){
			$this->strEmail=$email;
			$sql = "SELECT idpersona,nombres,apellidos,status FROM persona WHERE email_user = '{$this->strEmail}' and status=1";

			$request = $this->select($sql);


			return $request;


		}

		public function setTokenUser(int $idpersona, string $token){
			$this->intIdUsuario = $idpersona;
			$this->strToken = $token;
			$sql = "UPDATE persona SET toke=? WHERE idpersona = '{$this->intIdUsuario}'";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;

		}


		public function getUsuario(string $email,string $token){
			$this->strEmail=$email;
			$this->strToken=$token;

			$sql = "SELECT idpersona FROM persona WHERE email_user = '{$this->strEmail}' and toke = '{$this->strToken}' and status=1";
			$request = $this->select($sql);
			return $request;
		}

		public function RecuperarPassword(int $idpersona,string $password){

			$this->intIdUsuario = $idpersona;
			$this->strPassword = $password;

			$sql = "UPDATE persona SET password=?, toke=? WHERE idpersona = '{$this->intIdUsuario}'";

			$arrData = array($this->strPassword,"");

			$request = $this->update($sql,$arrData);

			return $request;


		}	
	}
 ?>