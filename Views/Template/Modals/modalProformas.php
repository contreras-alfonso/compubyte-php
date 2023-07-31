<!-- Modal -->
<div class="modal fade" id="modalProformas" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Proforma de venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
              <form id="formProformas" name="formProformas" class="form-horizontal">

                <input type="hidden" id="idPedido" name="idPedido" value="">
                <input type="hidden" id="idProforma" name="idProforma" value="">
                <p style="font-size: 1rem; font-weight: bold;" class="text-primary">Encargado: <?php echo $_SESSION['userData']['nombres']; echo " "; echo $_SESSION['userData']['apellidos'] ?></p>
                
                <input type="hidden" id="nombreEncargado" name="nombreEncargado" value="<?php echo $_SESSION['userData']['nombres']; echo " "; echo $_SESSION['userData']['apellidos'] ?>">
                <input type="hidden" id="stockProducto" name="stockProducto" value="">
                  <div class="form-row">
                  <div class="form-group col-md-4">
                  <label for="listRolid">Categoria</label>
                  <select class="form-control" data-live-search="true" id="listCategoria" name="listCategoria" onchange="ftnCargarProductos()"></select>
                  </div>
                  
                
                  <div class="form-group col-md-5">
                  <label for="listStatus">Producto</label>
                  <select  class="form-control" data-live-search="true" name="listProducto" id="listProducto" onchange="ftnCargarPrecio()" >
                  </select>
                  </div>

                </div>

                  
                  <div class="form-row">
                  <div class="form-group col-md-4">
                  <label for="txtNombre">Precio</label>
                  <input class="form-control" id="txtPrecio" name="txtPrecio" type="text" readonly >
                  </div>
                  
                
                  <div class="form-group col-md-2.5">
                  <label for="txtNombre">Cantidad</label>
                  <input class="form-control" id="txtCantidad" name="txtCantidad" value="1" type="number" placeholder="Cantidad del producto" >
                  </div>

                  <div class="form-group col-md-1">
                  <label style="color: white;" for="txtNombre">x</label>
                 
                  <button id="btnActionForm" class="btn btn-info form-control" type="submit"><span id="btnText">Añadir</span></button>
                  </div>


                </div>


            <div class="row" >
            <div class="col-md-12" >
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablaProductosProforma" width="100%">
                      <thead>
                        <tr>
                         
                          <th>Cantidad</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Subtotal</th>
                          <th>Accion</th>

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>2</td>
                          <td>Radeon RX 6600 XT MECH 2X 8G OC - MSI</td>
                          <td>1200</td>
                          <td>2400</td>
                          <td>Eliminar</td>
                           
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div> 

                






         
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="button" onclick="CrearProforma()"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Generar proforma</span></button>&nbsp;&nbsp;&nbsp;

                  <button class="btn btn-danger" type="button" onclick="fntDelAuxProforma()"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>

           
                </div>

              </form>
      
      </div>
    </div>
  </div>
</div>

  