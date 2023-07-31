<?php 
    headerAdmin($data); 
    getModal('modalComprobante',$data);
?>
   
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/proformas"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablaComprobantes">
                      <thead>
                        <tr>
                         
                          <th>Nro</th>
                         <!-- <th>Nombres</th>-->
                         <th>Fecha de creación</th>
                          <th>Estado</th>
                         
                    
                          <th>Acciones</th>
                          

                        </tr>
                      </thead>
                      <tbody>
                        <tr>

                          <td>00205</td>
                          <td>12/10/2022</td>
                          <td>Eliminar</td>
                          <td>Eliminar</td>
                  
                          
                           
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="contenedor">
                <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablaFacturas1">
                      <thead>
                        <tr>
                         
                          <th>Nro</th>
                         <!-- <th>Nombres</th>-->
                         <th>Fecha de creación</th>
                          <th>Estado</th>
                         
                    
                          <th>Acciones</th>
                          

                        </tr>
                      </thead>
                      <tbody>
                        <tr>

                          <td>00205</td>
                          <td>12/10/2022</td>
                          <td>Eliminar</td>
                          <td>Eliminar</td>
                  
                          
                           
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>


                <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablaBoletas1">
                      <thead>
                        <tr>
                         
                          <th>Nro</th>
                         <!-- <th>Nombres</th>-->
                         <th>Fecha de creación</th>
                          <th>Estado</th>
                         
                    
                          <th>Acciones</th>
                          

                        </tr>
                      </thead>
                      <tbody>
                        <tr>

                          <td>00205</td>
                          <td>12/10/2022</td>
                          <td>Eliminar</td>
                          <td>Eliminar</td>
                  
                          
                           
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </div>
    </main>
<?php footerAdmin($data); ?>
    