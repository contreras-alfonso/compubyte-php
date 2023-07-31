<?php 
    headerAdmin($data); 
    getModal('modalUsuarios',$data);
?>
   
    <main class="app-content">
      <?php  
       /*dep($_SESSION['permisos']);
            dep($_SESSION['permisosMod']);
*/
            ?>

      <div class="app-title">
        <div>
            <h1><i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
                <button class="btn btn-primary" type="button" onclick="openModalUsuarios();" ><i class="fas fa-plus-circle"></i> Nuevo usuario</button>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/usuarios"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>

        <div class="row">
            <div class="col-md-12">
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableUsuarios">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Alias</th>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Telefono</th>
                         <!-- <th>Nombres</th>-->
                         <!-- <th>Apellidos</th>-->
                          <!--<th>Telefono</th>-->
                          <th>Email</th>
                          <th>Rol</th>
                          <th>Estado</th>
                          <th>Fecha de creación</th>
                          <th>Acciones</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Carlos</td>
                          <td>Hernandez</td>
                          <td>@gmail.com</td>
                          <td>9999</td>
                           <td>Administrador</td>
                           
                          
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
    