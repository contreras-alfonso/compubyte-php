<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=media(); ?> /css/confirmarPasswords.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Roboto&display=swap" rel="stylesheet">
	<script src="<?= media();?>/js/fontawesomes.js"></script>
	<script src="<?= media(); ?>/js/getConfirmarPasswords.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
<!-- font awesome  -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= media();?>/images/logito.png">
    
    <title>cambiar password</title>

</head>
<body>
	<div class="contenedorTitulo">
		
		<div>
		<p class="txtContraseña"><a href="http://localhost/tienda_virtual/actualizarPassword"><i class="fa-solid fa-arrow-left"></i></a> Cambiar contraseña</p>
		</div>
	</div>
	<div class="borderLinea"></div>
	<div class="contenederInformacion">
		<p>Elige una contraseña segura y no la utilices en otras cuentas. Si cambias tu contraseña, se cerrará sesión en todos tus dispositivos, con algunas excepciones.</p>
		
	</div>

	<form id="formconfirmarPasswords" name="formconfirmarPasswords">
	<div id="borderCentral" class="borderCentral">
		<input type="hidden" id="txtemail" name="txtemail"  value="<?php echo $_SESSION['userData']['email_user'] ?>">


				  <div class="divContra">
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                  </div>
              <div class="form-floating mb-0">
                <input type="password" value="" class="input form-control" id="txtpassword" name="txtpassword" placeholder="Ingresa tu nueva contraseña" aria-label="password" aria-describedby="basic-addon1" />
                <label for="txtpassword">Ingresa tu nueva contraseña</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text" onclick="password_show_hide();">
                  <i class="fas fa-eye" id="show_eye1"></i>
                  <i class="fas fa-eye-slash d-none" id="hide_eye1"></i>
                </span>
              </div>
            </div>
                </div>


		<p class="textoWhite">Seguridad de la contraseña:</p>
		<p class="textoWhite">Utiliza al menos 8 caracteres. No uses una contraseña de otro sitio ni un nombre demasiado obvio, como el de tu mascota.</p>
		
		<div class="divContra">
                      <div class="input-group">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                    </div>
                <div class="form-floating mb-0">
                  <input  type="password" value="" class="input form-control" id="txtpasswordconfirm" name="txtpasswordconfirm" placeholder="Confirma tu nueva contraseña" aria-label="password" aria-describedby="basic-addon1" />
                  <label for="txtpassword">Confirma tu nueva contraseña</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text" onclick="password_show_hide2();">
                    <i class="fas fa-eye" id="show_eye2"></i>
                    <i class="fas fa-eye-slash d-none" id="hide_eye2"></i>
                  </span>
                </div>
                </div>
              </div>
              </div>
                

		<button class="btnCambiarContra" type="submit">Actualizar</button>

		

	</div>

	</form>



</body>
</html>