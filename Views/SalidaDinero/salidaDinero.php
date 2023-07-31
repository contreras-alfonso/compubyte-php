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
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/salidaDinero"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

      <form action="" id="formSalidaDinero" name="formSalidaDinero">
        <input type="hidden" id="txtidTrabajador" name="txtidTrabajador" value="<?php echo $_SESSION['userData']['idpersona']; ?> ">
      <div id="borderCentro" class="borderCentro">
      
      <div class="contenedor3">
        <div>
       <label for="listStatus">Fecha actual:</label>
        <input type="text" class="campotext campodia" readonly value="<?php echo date('d-m-Y'); ?>" >
        </div>

        <div>
       <label for="listStatus">Numero de comprobante:</label>
        <input class="campotext campoNumeroComprob" id="txtcomprobante" name="txtcomprobante"  type="text" maxlength="9">
        </div>

        <div>
       <label for="listStatus">Importe S/.</label>
         <input class="campotext" id="txtimporte" name="txtimporte" type="text" >
        </div>
        </div>


        <div class="contenedor2">
         
         <div class="dspflex">
        <label for="listStatus">Detalle:</label>
          <textarea class="textoarea campoDetalle" id="txtdetalle" name="txtdetalle"></textarea>
        </div>

        <div class="btnAgregarmarge"> 
          <button type="submit" class="btnAgregar">Agregar</button>
        </div>

        </div>
    

    <input type="hidden" id="txtemail" name="txtemail"  value="<?php echo $_SESSION['userData']['email_user'] ?>">

   

            <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableSalidaDinero">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Detalle</th>
                          <th>Nro Comprobante</th>
                          <th>Importe S/.</th>
                          <th>Eliminar</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Carlos</td>
                          <td>Hernandez</td>
                          <td>@gmail.com</td>
                          <td">@gmail.com</td>
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    
    <div class="contenedorGenerarSalida">
    <input type="button" class="btnSalida" value="Generar salida" onclick="functionAgregarAuxSalida()">
    </div>
  </div>
  </form>
    </main>
<?php footerAdmin($data); ?>
    