const url_base = "http://localhost/tienda_virtual";

var tablaEstadoComprobantes;




document.addEventListener('DOMContentLoaded', function(){

	tablaEstadoComprobantes = $('#tablaEstadoComprobante').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+url_base+"/EstadoComprobante/getProformas",
            "dataSrc":""
        },
        "columns":[
            {"data":"idfactura"},
            {"data":"nombrePersona"},
            {"data":"status"},
            {"data":"estado_comprobante"},
            {"data":"options"},
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
         
    });
/*
    let arreglode = [
{
    idfactura: 'EB01-1',
    nombrePersona: 'ESCUELA DE DETECTIVES PRIVADOS DEL PERU E.I.R.L. - ESDEPRIP',
    status: '<div class="text-center"><h5><span class="badge badge-success">Activo</span></h5></div>' ,
    estado_comprobante: 'Activo',
    options: 'Eliminar',
},
{
    idfactura: 'EB01-2',
    nombrePersona: 'ESCUELA',
    status: '<div class="text-center"><h5><span class="badge badge-success">Activo</span></h5></div>' ,
    estado_comprobante: 'Activo',
    options: 'Eliminar',
},

];

    tablaEstadoComprobantes = $('#tablaEstadoComprobante').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },

        "data": arreglode,

        "columns":[
            {"data":"idfactura"},
            {"data":"nombrePersona"},
            {"data":"status"},
            {"data":"estado_comprobante"},
            {"data":"options"},
        ],
       
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
         
    });

*/

    var formEstadoComprobante = document.querySelector('#formEstadoComprobante');
    formEstadoComprobante.onsubmit = function(e){
        e.preventDefault();

        var nombre = document.querySelector('#txtNombre').value;
        var telefono = document.querySelector('#txttelefono').value;
        var dni = document.querySelector('#txtdni').value;
        var direccion = document.querySelector('#txtdireccion').value;
        var referencia = document.querySelector('#txtreferencia').value;

        if(nombre==""){
             Swal.fire({
            title: "Verificar",
            text: `Por favor, ingrese el nombre.`,
            icon: "info",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#F69D32',
                            
});
             return false;
        }

                if(telefono==""){
             Swal.fire({
            title: "Verificar",
            text: `Por favor, ingrese el teléfono.`,
            icon: "info",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#F69D32',
                            
});  return false;
        }


                if(dni==""){
             Swal.fire({
            title: "Verificar",
            text: `Por favor, ingrese el DNI.`,
            icon: "info",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#F69D32',
                            
});  return false;
        }

            if(direccion==""){
             Swal.fire({
            title: "Verificar",
            text: `Por favor, ingrese la dirección.`,
            icon: "info",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#F69D32',
                            
});  return false;
        }

            if(referencia==""){
             Swal.fire({
            title: "Verificar",
            text: `Por favor, ingrese la referencia`,
            icon: "info",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#F69D32',
                            
});  return false;
        }

if(telefono.length!=9){
             Swal.fire({
            title: "Verificar",
            text: `Por favor, ingrese un teléfono correcto.`,
            icon: "info",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#F69D32',
                            
});  return false;
        }

            if(dni.length!=8){
             Swal.fire({
            title: "Verificar",
            text: `Por favor, ingrese un DNI correcto.`,
            icon: "info",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#F69D32',
                            
});  return false;
        }

         


       Swal.fire({
            title: `Comprobante`,
            text: `¿Desea asignar los datos de envio al comprobante?`,
            icon: "question",
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
}).then((result) => {
  if (result.isConfirmed) {


            //validando en que navegador estamos
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    //creando la ruta en donde enviaremos los datos
    var ajaxUrl = url_base+'/EstadoComprobante/setEnvioDomicilio';
    //creando la variable formData, que sera igual al objeto Formdata
    var formData = new FormData(formEstadoComprobante);
    //abriendo la conexion indicando que enviaremos datos por el metodo post
    request.open("POST",ajaxUrl,true);
    //enviar la informacion que es igual al objeto
    request.send(formData);


    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            //obteniendo los datos enviados desde el controlador $arrResponse
            var objData = JSON.parse(request.responseText);

            if(objData.status){
                Swal.fire({
            title: "Datos asignados",
            text: `${objData.msg}`,
            icon: "success",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
});             
                $('#modalEstadoComprobante').modal('hide');
                tablaEstadoComprobantes.api().ajax.reload();


            }else{
                   Swal.fire({
            title: "Datos no asignados",
            text: `${objData.msg}`,
            icon: "error",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
});
            }

        }

    }
      }
})
    }


});




function fntEnvioDomicilio(idpedido,idfactura){
    
	/*idSeleccionado = document.querySelectorAll('#selectOpciones').value;

        idSeleccionado.forEach(function(e){
            alert("asdsa");
        })
         */
         document.querySelector('#titleModal').innerHTML=`Comprobante N° ${idfactura}`;
         document.querySelector('#txtidPedido').value=`${idpedido}`;
         document.querySelector('#txtNombre').value="";
         document.querySelector('#txttelefono').value="";
         document.querySelector('#txtdni').value="";
         document.querySelector('#txtdireccion').value="";
         document.querySelector('#txtreferencia').value="";

         $('#modalEstadoComprobante').modal('show');
            
      
}

function despachoEnTienda(idpedido,idfactura){
        Swal.fire({
            title: `Comprobante N° ${idfactura}`,
            text: `¿Desea cambiar el estado del comprobante?`,
            icon: "question",
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
}).then((result) => {
  if (result.isConfirmed) {
      /*  Swal.fire({
            title: "Password",
            text: `asd`,
            icon: "success",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
})*/
        
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = url_base+'/EstadoComprobante/updateEstadoComprobante/'+idpedido;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                        if(objData.status){
                            Swal.fire({
            title: "Estado actualizado",
            text: `${objData.msg}`,
            icon: "success",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
});
                            tablaEstadoComprobantes.api().ajax.reload();


                        }else{
                                     Swal.fire({
            title: "Estado no actualizado",
            text: `${objData.msg}`,
            icon: "error",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
});
                        }
                }
            }
  }
})
}

