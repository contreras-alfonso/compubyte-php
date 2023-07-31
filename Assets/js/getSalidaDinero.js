
var tablaSalidaDinero




document.addEventListener('DOMContentLoaded', function(){



	tablaSalidaDinero = $('#tableSalidaDinero').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/SalidaDinero/getSalidas",
            "dataSrc":""
        },
        "columns":[
            {"data":"fecha"},
            {"data":"detalle"},
            {"data":"comprobante"},
            {"data":"importe"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });



var formSalidaDinero = document.querySelector('#formSalidaDinero');
formSalidaDinero.onsubmit = function(e){
        e.preventDefault();
var comprobante = document.querySelector('#txtcomprobante').value;
var importe = document.querySelector('#txtimporte').value;
var detalle = document.querySelector('#txtdetalle').value;


       if(comprobante==""){
       	  
             Swal.fire({
            title: "Verificar comprobante",
            text: `Por favor, ingrese el número de comprobante`,
            icon: "info",
            confirmButtonColor: '#4880B2',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#B24858',
                            
			});
             return false;
       
   }


          if(importe==""){
       	  
             Swal.fire({
            title: "Verificar importe",
            text: `Por favor, ingrese el importe`,
            icon: "info",
            confirmButtonColor: '#4880B2',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#B24858',
                            
			});
             return false;
       
   }



          if(detalle==""){
       	  
             Swal.fire({
            title: "Verificar campo",
            text: `Por favor, ingrese el detalle`,
            icon: "info",
            confirmButtonColor: '#4880B2',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#B24858',
                            
			});
             return false;
       
   }
                    //validando en que navegador estamos
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    //creando la ruta en donde enviaremos los datos
    var ajaxUrl = base_url+'/SalidaDinero/agregarSalidaAux';
    //creando la variable formData, que sera igual al objeto Formdata
    var formData = new FormData(formSalidaDinero);
    //abriendo la conexion indicando que enviaremos datos por el metodo post
    request.open("POST",ajaxUrl,true);
    //enviar la informacion que es igual al objeto
    request.send(formData);

    request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){

        var objData = JSON.parse(request.responseText);

        if(objData.status){
            document.querySelector('#txtimporte').value="";
            document.querySelector('#txtdetalle').value="";
            swal("Suceso!",objData.msg,"success");
            tablaSalidaDinero.api().ajax.reload();
        
            
        }else{
         
            swal("Error",objData.msg,"error");
        }

    }
}}

   
});


function fntEliminarSalida(idSalida){

	Swal.fire({
            title: `Salida`,
            text: `¿Desea eliminar la salida?`,
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


		   var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/SalidaDinero/eliminarSalida/'+idSalida;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status==200){
                    var objData = JSON.parse(request.responseText);
                        if(objData.status){
                            Swal.fire({
            title: "Salida",
            text: `${objData.msg}`,
            icon: "success",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
});
                            tablaSalidaDinero.api().ajax.reload();


                        }else{
                                     Swal.fire({
            title: "Salida",
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


}
)}


function functionAgregarAuxSalida(){
	                 //validando en que navegador estamos

	    var idEmpleado = document.querySelector('#txtidTrabajador').value;

	   // alert(`${idEmpleado}`);    

	   	Swal.fire({
            title: `Salida`,
            text: `¿Desea generar las salidas?`,
            icon: "question",
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, cancelar',
            confirmButtonText: 'Sí, aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
}).then((result) => {        
	                 
	              if (result.isConfirmed) {  	 
		   var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/SalidaDinero/agregarSalidasReal/'+idEmpleado;
            request.open("GET",ajaxUrl,true);
            request.send();

    request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){

        var objData = JSON.parse(request.responseText);

        if(objData.status){
            document.querySelector('#txtimporte').value="";
             document.querySelector('#txtcomprobante').value="";
            document.querySelector('#txtdetalle').value="";
            swal("Suceso",objData.msg,"success");
            tablaSalidaDinero.api().ajax.reload();

        
            
        }else{
         
            swal("Error",objData.msg,"error");
        }

    }
}

}

}

)}


let input = document.getElementById('txtcomprobante');

input.addEventListener('keyup',(e)=>{
    let texto = e.target.value;
    input.value=input.value.toUpperCase();
    if(texto.length==4){
        
        input.value=input.value+"-";
    }
});