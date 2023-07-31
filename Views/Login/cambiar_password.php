<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="autor" content="Alfonso Contreras">
    <meta name="theme-color" content="#009688">  
    <link rel="shortcut icon" href="<?=media(); ?>/images/logito.png">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=media(); ?> /css/main.css">
    <link rel="stylesheet" type="text/css" href="<?=media(); ?> /css/styles.css">
    <script src="<?= media(); ?>/js/getLogin.js"></script>
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?php echo $data['page_tag']; ?></title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo ">
        <h1 class="titulo_login"><?= $data['page_title'];?></h1>
      </div>
      <div class="login-box flipped" >
        
        <form id="formCambiarPass" name="formCambiarPass" class="forget-form" action="">
          <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $data['idpersona']; ?>">
          <input type="hidden" id="txtEmail" name="txtEmail" value="<?= $data['email'];?>">
          <input type="hidden" id="txtToken" name="txtToken" value="<?= $data['token'];?>">

          <h3 class="login-head">Actualiza tu contraseña :)</h3>

          <div class="form-group">
           
            <input id="txtPassword" value="" name="txtPassword" class="form-control" type="password" placeholder="Nueva contraseña"  autofocus>
          </div>

            <div class="form-group">
              
            <input id="txtPasswordConfirm" name="txtPasswordConfirm" class="form-control" type="password" placeholder="Repite tu contraseña"  >
          </div>

          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Actualizar</button>
          </div>
       
        </form>
      </div>
    </section>

    <script>
      const base_url = "<?php echo base_url(); ?>";
    </script>

    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/fontawesomes.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <script src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script  src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>

   
  </body>
</html>