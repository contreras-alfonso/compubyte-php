/*
setInterval(function(){
	var ajaxUrl = base_url+'/Home/variableSesion';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {

			 var objData = JSON.parse(request.responseText);

				if(objData.status==0){
					
					console.log(objData.msg);
					window.location = base_url+"/login";

				}



		}

	}
},100);
*/

var tablaProductosProforma
var tablaProforma
document.addEventListener('DOMContentLoaded', function(){

	tablaProductosProforma = $('#tablaProductosProforma').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Proformas/getProductosProforma",
            "dataSrc":""
        },
        "columns":[
            {"data":"cantidad"},
            {"data":"producto"},
            {"data":"precio"},
            {"data":"subtotal"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });



	tablaProforma = $('#tablaProforma').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Proformas/getProformas",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpedido"},
            {"data":"fechaRegistro"},
            {"data":"encargado"},
            {"data":"options"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]  
    });


	var formProformas = document.querySelector('#formProformas');
	formProformas.onsubmit = function(e){
		//evita que se recarge la pagina
		e.preventDefault();

		let precio = document.querySelector('#txtPrecio').value;
		let cantidad = document.querySelector('#txtCantidad').value;
		let stock = document.querySelector('#stockProducto').value;

		if(precio == ""){
			swal("Proformas", "Selecciona primero un producto.","info");
			return false;
		}

		if(parseInt(cantidad)<=0){
			swal("Proformas", "Seleccione una cantidad correcta.","info");
			return false;

		}

		if(cantidad == ""){
			swal("Proformas", "Elige una cantidad.","info");
			return false;
		}

		if(parseInt(stock)<parseInt(cantidad)){
			Swal.fire({
  icon: 'error',
  title: 'Stock insuficiente',
  text: `Solo cuenta con ${stock} unidades del producto.`,
  showCloseButton: true,
  focusConfirm: true,
  confirmButtonText:'Aceptar',
  confirmButtonColor: '#3085d6',
})
			return false;
		}



		/*else{
			swal("Proformas", "Producto añadido con exito.","success");
		}*/


	//validando en que navegador estamos
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	//creando la ruta en donde enviaremos los datos
	var ajaxUrl = base_url+'/Proformas/setProductoProforma';
	//creando la variable formData, que sera igual al objeto Formdata
	var formData = new FormData(formProformas);
	//abriendo la conexion indicando que enviaremos datos por el metodo post
	request.open("POST",ajaxUrl,true);
	//enviar la informacion que es igual al objeto
	request.send(formData);

	request.onreadystatechange = function(){
	if(request.readyState == 4 && request.status == 200){
			//obteniendo los datos enviados desde el controlador $arrResponse
			var objData = JSON.parse(request.responseText);

				if(objData.status){


				//console.log("Agregado desde console log");
				swal("Proformas",objData.msg, "success");

				
				tablaProductosProforma.api().ajax.reload();
				document.querySelector('#txtCantidad').value=1;
				
				}else{
					swal("Error",objData.msg,"error");
				}


		}/*else{
			console.log("Error desde console log");
		}*/


	}

}

});






function fntDelProductoProforma(idProductoProforma){

		var idProducto = idProductoProforma;
	     /*       swal({
                title: "Eliminar producto",
                text: "¿Realmente desea eliminar el producto en lista?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {

            	if (isConfirm) 
                {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/Proformas/delProductoProforma/';
                    var strData = "idProducto="+idProducto;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status == 200){
                            var objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                swal("Eliminar!", objData.msg , "success");
                                tablaProductosProforma.api().ajax.reload();
                            }else{
                                swal("Atención!", objData.msg , "error");
                            }
                        }
                    }
                }

            });*/

           Swal.fire({
  title: 'Proformas',
  text: "¿Realmente desea eliminar el producto en lista?",
  icon: 'question',
  showCancelButton: true,
  showCloseButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sí, eliminar',
  cancelButtonText: 'No, cancelar',
}).then((result) => {
  if (result.isConfirmed) {
  

                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/Proformas/delProductoProforma/';
                    var strData = "idProducto="+idProducto;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status == 200){
                            var objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                Swal.fire({
      title: 'Suceso!',
      text: `${objData.msg}`,
      icon: 'success',
      confirmButtonColor: '#3085d6',
    })
                                tablaProductosProforma.api().ajax.reload();
                            }else{
                                Swal.fire({
      title: 'Error',
      text: `${objData.msg}`,
      icon: 'error',
      confirmButtonColor: '#3085d6',
    })
                            }
                        }
                    }

  }
})

}





window.addEventListener('load',function(){
fntCategoriasProductos();


}, false);



function fntCategoriasProductos(){
	var ajaxUrl = base_url+'/Proformas/getselectCategorias';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {

				document.querySelector('#listCategoria').innerHTML = request.responseText;
				document.querySelector('#listCategoria').value=0;
				$('#listCategoria').selectpicker('render');



		}

	}
}


function ftnCargarProductos(){


	document.querySelector('#txtPrecio').value = "";
	document.querySelector('#txtCantidad').value = "1";

	var idCategoria = document.querySelector('#listCategoria').value;
	//var idCategoria = 1;
	//alert(`La categoria es: ${idCategoria}`)
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	//var ajaxUrl = base_url+'/Proformas/getProductos/'+idCategoria;
	var ajaxUrl = base_url+'/Proformas/getProductos/'+idCategoria;
	request.open("GET",ajaxUrl,true);
	request.send();
			request.onreadystatechange = function(){

				if(request.readyState == 4 && request.status==200){

				document.querySelector('#listProducto').innerHTML = request.responseText;
				document.querySelector('#listProducto').value=100;
				$('#listProducto').selectpicker('refresh');
				
				}
			}

}


function ftnCargarPrecio(){
	var idProducto = document.querySelector('#listProducto').value;
	document.querySelector('#txtCantidad').value = "1";

	//alert(`El producto es: ${idProducto}`)
		var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	//var ajaxUrl = base_url+'/Proformas/getProductos/'+idCategoria;
	var ajaxUrl = base_url+'/Proformas/getPrecio/'+idProducto;
	request.open("GET",ajaxUrl,true);
	request.send();
			request.onreadystatechange = function(){

				if(request.readyState == 4 && request.status==200){
					var objData = JSON.parse(request.responseText);

				document.querySelector('#txtPrecio').value = objData.data.precio;
				document.querySelector('#stockProducto').value = objData.data.stock;
				
				
				}
			}

}



function fntDelAuxProforma(){

	            swal({
                title: "Proformas",
                text: "¿Desea cancelar el proceso?",
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
	var ajaxUrl = base_url+'/Proformas/delProductosAuxProforma';
	//creando la variable formData, que sera igual al objeto Formdata
	var formData = new FormData(formProformas);
	//abriendo la conexion indicando que enviaremos datos por el metodo post
	request.open("POST",ajaxUrl,true);
	//enviar la informacion que es igual al objeto
	request.send(formData);

	request.onreadystatechange = function(){
	if(request.readyState == 4 && request.status == 200){
			//obteniendo los datos enviados desde el controlador $arrResponse
			var objData = JSON.parse(request.responseText);
			if(objData.status){
				tablaProductosProforma.api().ajax.reload();
				 $('#modalProformas').modal('hide');
				swal("Suceso!","Proceso cancelado","success");
				
			}else{
				swal("PRformas","UPPS ","error");
			}
                            

		}
	}
	    

	    }
            });

	
}


function CrearProforma(){
            swal({
                title: "Proformas",
                text: "¿Desea generar la proforma?",
                type: "info",
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
	var ajaxUrl = base_url+'/Proformas/crearProforma';
	//creando la variable formData, que sera igual al objeto Formdata
	var formData = new FormData(formProformas);
	//abriendo la conexion indicando que enviaremos datos por el metodo post
	request.open("POST",ajaxUrl,true);
	//enviar la informacion que es igual al objeto
	request.send(formData);

	request.onreadystatechange = function(){
	if(request.readyState == 4 && request.status == 200){
			//obteniendo los datos enviados desde el controlador $arrResponse
			var objData = JSON.parse(request.responseText);
			if(objData.status){
				tablaProforma.api().ajax.reload();
				tablaProductosProforma.api().ajax.reload();
				 $('#modalProformas').modal('hide');
				swal("Suceso!",objData.msg,"success");
				
			}else{
				swal("Error",objData.msg,"error");
			}
                            

		}
	}
	    

	    }
            });

}


function fntDelProforma(idProforma){

		var idProforma = idProforma;
	            swal({
                title: "Eliminar proforma",
                text: "¿Realmente desea eliminar la proforma seleccionada?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {

            	if (isConfirm) 
                {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/Proformas/delProforma/';
                    var strData = "idProforma="+idProforma;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status == 200){
                            var objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                swal("Eliminar!", objData.msg , "success");
                                tablaProforma.api().ajax.reload();

                            }else{
                                swal("Atención!", objData.msg , "error");
                            }
                        }
                    }
                }

            });

}


function openModalProformas(){

	document.querySelector('#txtPrecio').value="";
	document.querySelector('#listCategoria').value=0;
	document.querySelector('#listProducto').value=100;
	$('#modalProformas').modal('show');
}