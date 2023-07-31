<?php 
    headerAdmin($data); 
    //getModal('modalProformas',$data);
?>
   <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
                
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/reporteCaja"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

      <form action="" id="formReporteVentas" name="formReporteVentas">
      <div id="borderCentral" class="borderCentral">

     <p class="textFecha">Tipo de reporte:</p>
     <select class="form-control selectReporte" id="selectReporte" name="selectReporte">
    <?php  /* <option value="0" selected disabled>--Selecciona una opción--</option>  */?> 
       <option value="1" >Ingresos de la empresa</option>
       <option value="2" >Salidas de la empresa</option>
     </select>

    <input type="hidden" id="txtemail" name="txtemail"  value="<?php echo $_SESSION['userData']['email_user'] ?>">
    <p class="textFecha">Fecha inicial:</p>
    <input class="camposPassw" id="txtfechaInicio" name="txtfechaInicio" type="date"  >
    
    <p class="textFecha">Fecha limite:</p>
    <input class="camposPassw" id="txtfechaFinal" name="txtfechaFinal" type="date"  >
    <button class="btnCambiarContra" type="submit">Generar Reporte</button>

  </div>
  </form>
    </main>
<?php footerAdmin($data); ?>
    