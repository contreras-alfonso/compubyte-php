<!-- Modal -->
<div class="modal fade" id="modalEstadoComprobante" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal" name="titleModal">Asignar una dirección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formEstadoComprobante" name="formEstadoComprobante">

                <input type="hidden" id="txtidPedido" name="txtidPedido">

                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del receptor" >
                </div>


                 <div class="form-group">
                  <label class="control-label">Teléfono</label>
                  <input class="form-control" id="txttelefono" name="txttelefono" type="text" maxlength="9" onkeypress="return controlTag(event);" placeholder="Telefono del receptor" >
                </div>


                <div class="form-group">
                  <label class="control-label">DNI</label>
                  <input class="form-control" id="txtdni" name="txtdni" type="text" maxlength="8" onkeypress="return controlTag(event);" placeholder="DNI del receptor" >
                </div>

                  <div class="form-group">
                  <label class="control-label">Dirección</label>
                  <textarea class="form-control" id="txtdireccion" name="txtdireccion" rows="3" placeholder="Dirección de envio" ></textarea>
                </div>

                

                <div class="form-group">
                  <label class="control-label">Referencia</label>
                  <textarea class="form-control" id="txtreferencia" name="txtreferencia" rows="3" placeholder="Referencia del lugar de envio" ></textarea>
                </div>

                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Confirmar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

