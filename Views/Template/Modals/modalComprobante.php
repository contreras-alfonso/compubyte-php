<!-- Modal -->
<div class="modal fade" id="modalComprobanteFactura" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Factura electronica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             
              <form id="formFactura" name="formFactura" class="form-horizontal">

                <input type="hidden" id="idPedido" name="idPedido" value="">
                <input type="hidden" id="idProforma" name="idProforma" value="">
                <p style="font-size: 1rem; font-weight: bold;" class="text-primary">Encargado: <?php echo $_SESSION['userData']['nombres']; echo " "; echo $_SESSION['userData']['apellidos'] ?></p>
                
                <input type="hidden" id="idEncargado" name="idEncargado" value="<?php echo $_SESSION['userData']['idpersona']; ?>">
              
                <input type="hidden" id="numeroRUC" name="numeroRUC" value="">
                <input type="hidden" id="numeroComprobante" name="numeroComprobante" value="">
                  
                  <div class="form-row">
                  <div class="form-group col-md-4">
                  <label for="txtNombre">RUC</label>
                  <input class="form-control" id="txtRuc" name="txtRuc" type="text" maxlength="11" onkeypress="return controlTag(event);">
                  </div>
                  

                  <div class="form-group col-md-1.5">
                  <label style="color: white;" for="txtNombre">x</label>
                  <br>
                  <button id="btnActionForm" class="btn btn-info" type="button" onclick="fntBuscarRazon()"><span id="btnText">Buscar RUC</span></button>
                  </div>

            <div id="divLoading2">
              <div>
                <img src="<?= media();?>/images/loading.svg" alt="Loading">
              </div>
            </div>
                </div>

                <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtNombre">Razón Social</label>
                  <input class="form-control" id="txtRazon" name="txtRazon" type="text" readonly>
                  </div>
                  </div>

               <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtNombre">Dirección del receptor</label>
                  <input class="form-control" id="txtDireccionReceptor" name="txtDireccionReceptor" type="text" readonly>
                  </div>
                  </div>

            <div class="row" >
            <div class="col-md-12" >
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablaProductosdeFactura" width="100%">
                      <thead>
                        <tr>
                         
                          <th>Cantidad</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Subtotal</th>
                         

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>2</td>
                          <td>Radeon RX 6600 XT MECH 2X 8G OC - MSI</td>
                          <td>1200</td>
                          <td>2400</td>
                          
                           
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div> 

                






         
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Generar comprobante</span></button>&nbsp;&nbsp;&nbsp;

                  <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>

           
                </div>

              </form>
      
      </div>
    </div>
  </div>
</div>



//---------------------------

<div class="modal fade" id="modalComprobanteBoleta" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Boleta electronica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             
              <form id="formBoleta" name="formBoleta" class="form-horizontal">

               
                <p style="font-size: 1rem; font-weight: bold;" class="text-primary">Encargado: <?php echo $_SESSION['userData']['nombres']; echo " "; echo $_SESSION['userData']['apellidos'] ?></p>
                
                <input type="hidden" id="idEncargado" name="idEncargado" value="<?php echo $_SESSION['userData']['idpersona']; ?>">
              
                
                <input type="hidden" id="numProforma" name="numProforma" value="">
                  
                  <div class="form-row">
                  <div class="form-group col-md-4">
                  <label for="txtNombre">DNI</label>
                  <input class="form-control" id="txtdni" name="txtdni" type="text" maxlength="8" onkeypress="return controlTag(event);">
                  </div>
                  </div>

                <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtNombre">Nombres y apellidos:</label>
                  <input class="form-control" id="txtNombreCliente" name="txtNombreCliente" type="text">
                  </div>
                  </div>


            <div class="row" >
            <div class="col-md-12" >
              <div class="tile">
                <div class="tile-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tablaProductosdeBoleta" width="100%">
                      <thead>
                        <tr>
                         
                          <th>Cantidad</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Subtotal</th>
                         

                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>2</td>
                          <td>Radeon RX 6600 XT MECH 2X 8G OC - MSI</td>
                          <td>1200</td>
                          <td>2400</td>
                          
                           
                          
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div> 

                






         
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit" onclick=""><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Generar comprobante</span></button>&nbsp;&nbsp;&nbsp;

                  <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>

           
                </div>

              </form>
      
      </div>
    </div>
  </div>
</div>

  