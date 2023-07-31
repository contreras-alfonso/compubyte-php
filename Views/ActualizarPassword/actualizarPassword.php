<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="<?=media(); ?> /css/confirmarPasswords.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<script src="<?= media();?>/js/fontawesomes.js"></script>
	<script src="<?= media(); ?>/js/getActualizarContrasenia.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />

<!-- font awesome  -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <link rel="shortcut icon" href="<?= media();?>/images/logito.png">
    
    <title>Confirmar Password</title>
</head>
<body>
	<div class="contenedorTitulo">
		<div>
		<p class="txtContraseña"><a href="http://localhost/tienda_virtual/inicio"><i class="fa-solid fa-arrow-left"></i></a> Contraseña</p>
		</div>
	</div>
	<div class="borderLinea"></div>
	<form id="formActualizarPassword" name="formActualizarPassword">
	<div id="borderCentrall" class="borderCentrall">
		<p class="campoNombre"><?php echo $_SESSION['userData']['nombres']; echo " "; echo $_SESSION['userData']['apellidos']; ?></p>
		<div class="contenedorcampoEmail">
		<p class="campoEmail"><?php echo $_SESSION['userData']['email_user']; ?></p>
		</div>
		<input type="hidden" id="txtemail" name="txtemail"  value="<?php echo $_SESSION['userData']['email_user'] ?>">
		<p style="text-align: center; margin-top: 20px;">Para continuar, primero debes verificar tu identidad.</p>

		          <div class="divContra">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    </div>
                    <input  type="password" class="input form-control" id="txtpassword" name="txtpassword" placeholder="Ingresa tu contraseña" aria-label="password" aria-describedby="basic-addon1" />
                    <div class="input-group-append">
                      <span class="input-group-text" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                      </span>
                    </div>
                  </div>
                </div>

     <div class="contenedorbtnCambiarContraa">
		<button class="btnCambiarContraa" id="txtpassword" name="txtpassword" type="submit">Siguiente</button>
		</div>
	</div>
	</form>
</body>
</html>