<?php 
    headerAdmin($data); 
   getModal('modalEstadoComprobante',$data);
?>
   
    <main class="app-content">
      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
                
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/estadoComprobante"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablaEstadoComprobante">
                      <thead>
                        <tr>
                         
                          <th>ID</th>
                         <!-- <th>Nombres</th>-->
                         <th>Nombre del cliente</th>
                          <th>Estado</th>
                         <th>Tipo de comprobante</th>
                          <th>Acción</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>00205</td>
                          <td>RUC SAC</td>
                          <td>Activo</td>
                          <td>Factura</td>
                          <td>Eliminar</td>
                  
             
                           
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>
<?php footerAdmin($data); ?>
    