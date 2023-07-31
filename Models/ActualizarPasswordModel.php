<?php 

	class ActualizarPasswordModel extends Mysql
	{

		public $strEmail;
		public $strPassword;

		public function __construct()
		{
			parent::__construct();
		}

		public function confirmarUsuario(string $email,string $password){

			$this->strEmail = $email;
			$this->strPassword = $password;

			$sql = "SELECT * FROM persona WHERE email_user = '{$this->strEmail}' and password = '{$this->strPassword}'";
			$request = $this->select($sql);

			return $request;
		}

	}
 ?>