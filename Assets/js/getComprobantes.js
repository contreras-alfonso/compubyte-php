const base_urll = "http://localhost/tienda_virtual";

var tablaComprobantes
var tablaProductosdeFactura
var tablaFacturas1
var tablaBoletas1
var tablaProductosdeBoleta

document.addEventListener('DOMContentLoaded', function(){
    //$('#modalComprobanteFactura').modal('hide');
   // $('#modalComprobanteFactura').modal({backdrop: 'static', keyboard: false})
closeOnClickOutside: false
    
    
	tablaComprobantes = $('#tablaComprobantes').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_urll+"/Comprobante/getComprobantes",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpedido"},
            {"data":"datecreated"},
            {"data":"estado_comprobante"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

    tablaFacturas1 = $('#tablaFacturas1').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_urll+"/Comprobante/obtenerFacturas",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpedido"},
            {"data":"datecreated"},
            {"data":"estado_comprobante"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 5,
        "order":[[0,"desc"]]  
    });


        tablaBoletas1 = $('#tablaBoletas1').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_urll+"/Comprobante/obtenerBoletas",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpedido"},
            {"data":"datecreated"},
            {"data":"estado_comprobante"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 5,
        "order":[[0,"desc"]]  
    });



let formFactura = document.querySelector("#formFactura");
 formFactura.onsubmit = function(e){
            e.preventDefault();
          var razonsocial = document.querySelector('#txtRazon').value;
          var ruc = document.querySelector('#txtRuc').value;

         // document.querySelector('#numeroRUC').value = document.querySelector('#txtRuc').value;

          if(ruc==""){
            document.querySelector('#txtRazon').value = "";
            document.querySelector('#txtDireccionReceptor').value = "";
           // swal("Factura","RUC vacío.","info");
            Swal.fire({
  title: 'RUC',
  icon: 'warning',
  html:'RUC vacío, por favor verifique el campo.',
  showCloseButton: true,
  focusConfirm: true,
  confirmButtonColor: '#3085d6',
    allowOutsideClick: false,
  confirmButtonText:'Aceptar',
 
  hideClass: {
    popup: 'animate__animated animate__bounceOutUp'
  }
  
})
            return false;
          }



            if( ruc.length!=11){
            document.querySelector('#txtRazon').value = "";
            swal("Factura","RUC incorrecto.","info");
            return false;
          }


          if(razonsocial=="-- NO ENCONTRADO --" || razonsocial=="" ){

           
            swal("Factura","Verifique la razón social.","info");

            return false;
          }


        swal({
                title: "Factura",
                text: "¿En realidad desea generar la factura?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {

                if (isConfirm) 
                {

            //validando en que navegador estamos
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    //creando la ruta en donde enviaremos los datos
    var ajaxUrl = base_urll+'/Comprobante/CrearFactura';
    //creando la variable formData, que sera igual al objeto Formdata
    var formData = new FormData(formFactura);
    //abriendo la conexion indicando que enviaremos datos por el metodo post
    request.open("POST",ajaxUrl,true);
    //enviar la informacion que es igual al objeto
    request.send(formData);

    request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){

        var objData = JSON.parse(request.responseText);

        if(objData.status){
            
            swal("Suceso!",objData.msg,"success");
            $('#modalComprobanteFactura').modal('hide');
            tablaComprobantes.api().ajax.reload();
            tablaBoletas1.api().ajax.reload();
            tablaFacturas1.api().ajax.reload();
            
        }else{
         
            swal("Verificar stock",objData.msg+objData.data,"error");
        }

    }
}}
  });

}


let formBoleta = document.querySelector("#formBoleta");
formBoleta.onsubmit = function(e){
    e.preventDefault();
var numeroDNI = document.querySelector('#txtdni').value;
var nombreCliente = document.querySelector('#txtNombreCliente').value;

if(numeroDNI=="" || numeroDNI.length!=8){
    swal("Boletas","Por favor, ingrese correctamente el DNI.","info");
    return false;
}

if(nombreCliente=="" || nombreCliente.length<7){
    swal("Boletas","Por favor, ingrese correctamente el nombre.","info");
    return false;
}

        swal({
                title: "Factura",
                text: "¿En realidad desea generar la Boleta?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {

                if (isConfirm) 
                {

            //validando en que navegador estamos
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    //creando la ruta en donde enviaremos los datos
    var ajaxUrl = base_urll+'/Comprobante/CrearBoleta';
    //creando la variable formData, que sera igual al objeto Formdata
    var formData = new FormData(formBoleta);
    //abriendo la conexion indicando que enviaremos datos por el metodo post
    request.open("POST",ajaxUrl,true);
    //enviar la informacion que es igual al objeto
    request.send(formData);

    request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){

        var objData = JSON.parse(request.responseText);

        if(objData.status){
            
            swal("Suceso!",objData.msg,"success");
            $('#modalComprobanteBoleta').modal('hide');
            tablaComprobantes.api().ajax.reload();
            tablaBoletas1.api().ajax.reload();
            tablaFacturas1.api().ajax.reload();
            
        }else{
         
            swal("Verificar stock",objData.msg+objData.data,"error");
        }

    }
}}
  });

}

    });




function fntFactura(idpedido){

    document.querySelector('#numeroComprobante').value = idpedido;
   var idNumeropedido = idpedido;

        tablaProductosdeFactura = $('#tablaProductosdeFactura').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_urll+"/Comprobante/getProductosDeProforma/"+idNumeropedido,
            "dataSrc":""
        },
        "columns":[
            {"data":"cantidad"},
            {"data":"nombreproducto"},
            {"data":"precio"},
            {"data":"subtotal"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });
    //

    document.querySelector('#txtRuc').value="";
    document.querySelector('#txtRazon').value="";
    document.querySelector('#txtDireccionReceptor').value="";

    $('#modalComprobanteFactura').modal('show');

    //




}

function fntBoleta(idpedido){
     document.querySelector('#numProforma').value = idpedido;
   var idNumeropedido = idpedido;

               tablaProductosdeBoleta = $('#tablaProductosdeBoleta').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_urll+"/Comprobante/getProductosDeProforma/"+idNumeropedido,
            "dataSrc":""
        },
        "columns":[
            {"data":"cantidad"},
            {"data":"nombreproducto"},
            {"data":"precio"},
            {"data":"subtotal"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });

          $('#modalComprobanteBoleta').modal('show');
}



function fntBuscarRazon(){
        
        var numeroRuc = document.querySelector('#txtRuc').value;
        document.querySelector('#txtRazon').value = "";
         document.querySelector('#txtDireccionReceptor').value = "";
        if(numeroRuc == ""){
            swal("RUC","Por favor ingrese primero el número de RUC.","info");
            return false;
        }

        if(numeroRuc.length!=11){
            swal("RUC","Por favor, ingrese los 12 digitos del RUC.","info");
            return false;
        }

        var loadingCarga2 = document.querySelector("#divLoading2");
        loadingCarga2.style.display = "flex";

        var ruc = document.querySelector('#txtRuc').value;
        //alert(`${ruc}`)
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    //var ajaxUrl = base_url+'/Proformas/getProductos/'+idCategoria;
    var ajaxUrl = base_urll+'/Comprobante/obtenerRUC/'+ruc;
    request.open("GET",ajaxUrl,true);
    request.send();
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status==200){
                var objData = JSON.parse(request.responseText);
                loadingCarga2.style.display = "none";

                if(objData.success==false){
                    document.querySelector('#txtRazon').value = "-- NO ENCONTRADO --";
                }else{
                    document.querySelector('#txtRazon').value = objData.razonSocial;
                    document.querySelector('#txtDireccionReceptor').value = objData.direccion;
                }
                
                
                }
            }

}