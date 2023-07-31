<?php 

	class ConfirmarPasswordsModel extends Mysql
	{

		public $strEmail;
		public $strPassword;

		public function __construct()
		{
			parent::__construct();
		}

		public function actualizarPassword(string $email,string $password){

			$this->strEmail = $email;
			$this->strPassword = $password;

			

			$sql = "SELECT * FROM persona WHERE email_user= '{$this->strEmail}' ";
			$requestget = $this->select($sql);
			$contraActual = $requestget['password'];

			if($contraActual==$this->strPassword){
				$variable = "contrasIguales";
			}else{

			$sql_update = "UPDATE persona SET password=? WHERE email_user='{$this->strEmail}' ";
			$arrData = array($this->strPassword);
			$request = $this->update($sql_update,$arrData);
			$variable = "cambiado";
			}
			

			return $variable;

		}	

	}
 ?>