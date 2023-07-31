<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
              <form id="formUsuario" name="formUsuario" class="form-horizontal">
                <input type="hidden" id="idUsuario" name="idUsuario" value="">
                <p class="text-primary">Todos los campos son obligatorios.</p>
                
                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="txtIdentificacion">Alias</label>
                  <input class="form-control" id="txtIdentificacion" name="txtIdentificacion" type="text" placeholder="Ingrese un alias" >
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="txtNombre">Nombres</label>
                  <input class="form-control valid validText" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del empleado" >
                  </div>
                
                  <div class="form-group col-md-6">
                  <label for="txtApellido">Apellidos</label>
                  <input class="form-control valid validText" id="txtApellido" name="txtApellido" type="text" placeholder="Apellidos del empleado" >
                  </div>
                </div>


                  <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="txtTelefono">Telefono</label>
                  <input class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" type="text" placeholder="Telefono del empleado" onkeypress="return controlTag(event);">
                  </div>
                
                  <div class="form-group col-md-6">
                  <label for="txtEmail">Email</label>
                  <input class="form-control valid validEmail" id="txtEmail" name="txtEmail" type="email" placeholder="Ejm: compubyte@gmail.com" >
                  </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="listRolid">Tipo usuario</label>
                  <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" ></select>
                  </div>
                  
                
                  <div class="form-group col-md-6">
                  <label for="listStatus">Estado</label>
                  <select  class="form-control" name="listStatus" id="listStatus" >
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>
                  </div>

                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="txtPassword">Password</label>
                  <input class="form-control" id="txtPassword" name="txtPassword" type="password" placeholder="Contraseña" >
                  </div>
                  </div>

         
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText"> Guardar</span></button>&nbsp;&nbsp;&nbsp;

                  <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cerrar</button>

           
                </div>
              </form>
      
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalViewUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Informacion del usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-bordered">
             <tbody>

               <tr>
                 <td>Identificacion:</td>
                 <td id="celIdentificacion">656456</td>
               </tr>

               <tr>
                 <td>Nombres:</td>
                 <td id="celNombre">Juan</td>
               </tr>

               <tr>
                 <td>Apellidos:</td>
                 <td id="celApellido">Kin</td>
               </tr>

               <tr>
                 <td>Telefono:</td>
                 <td id="celTelefono">58964152</td>
               </tr>

               <tr>
                 <td>Email:</td>
                 <td id="celEmail">qwewq</td>
               </tr>

               <tr>
                 <td>Rol:</td>
                 <td id="celTipoUsuario">qewq</td>
               </tr>

               <tr>
                 <td>Estado:</td>
                 <td id="celEstado">qweqwe</td>
               </tr>

                <tr>
                 <td>Fecha registro:</td>
                 <td id="celFechaRegistro">qeqw</td>
               </tr>

             </tbody> 

          </table>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

