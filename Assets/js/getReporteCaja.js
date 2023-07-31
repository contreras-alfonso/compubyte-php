

document.addEventListener('DOMContentLoaded', function(){
const base_url = "http://localhost/tienda_virtual";

var formReporteVentas = document.querySelector('#formReporteVentas');
    formReporteVentas.onsubmit = function(e){
        e.preventDefault();

       var selectReporte = document.querySelector('#selectReporte').value;
       var fecha_inicio = document.querySelector('#txtfechaInicio').value;
       var fecha_final  = document.querySelector('#txtfechaFinal').value;
       var año_final = fecha_final.substr(0,3);

    /*   if(selectReporte=="0"){
       	  
             Swal.fire({
            title: "Verificar campo",
            text: `Primero selecciona un tipo de reporte.`,
            icon: "info",
            confirmButtonColor: '#4880B2',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
            iconColor: '#B24858',
                            
			});
             return false;
       
   }*/


       if(fecha_inicio==""){
       	  
             Swal.fire({
            title: "Verificar campo",
            text: `Por favor, ingrese la fecha inicial`,
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

          if(fecha_final==""){
       	  
             Swal.fire({
            title: "Verificar campo",
            text: `Por favor, ingrese la fecha final`,
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


  		if(fecha_final<fecha_inicio){
       	  
             Swal.fire({
            title: "Verificar",
            text: `Las fecha final no puede ser menor a la inicial.`,
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


       /*

    con variable de sesion
    con window.location
       */
       

 if(selectReporte=="1"){
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            //creando la ruta en donde enviaremos los datos
            var ajaxUrl = base_url+'/ReporteCaja/listaReporteVentas/'+selectReporte;
            //creando la variable formData, que sera igual al objeto Formdata
            var formData = new FormData(formReporteVentas);
            //abriendo la conexion indicando que enviaremos datos por el metodo post
            request.open("POST",ajaxUrl,true);
            //enviar la informacion que es igual al objeto
            request.send(formData);


     request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){

        var objData = JSON.parse(request.responseText);

            if(objData.status){
                window.location = base_url+'/ReporteCaja/listadoReporteVentas';
            }else{
                 Swal.fire({
            title: "Reporte vacio",
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
}else{
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            //creando la ruta en donde enviaremos los datos
            var ajaxUrl = base_url+'/ReporteCaja/listaReporteSalidas/'+selectReporte;
            //creando la variable formData, que sera igual al objeto Formdata
            var formData = new FormData(formReporteVentas);
            //abriendo la conexion indicando que enviaremos datos por el metodo post
            request.open("POST",ajaxUrl,true);
            //enviar la informacion que es igual al objeto
            request.send(formData);


     request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){

        var objData = JSON.parse(request.responseText);

            if(objData.status){
                window.location = base_url+'/ReporteCaja/listadoReporteSalidas';
            }else{
                 Swal.fire({
            title: "Reporte vacio",
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
});