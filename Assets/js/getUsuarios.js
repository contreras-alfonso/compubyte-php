var tableUsuarios;


document.addEventListener('DOMContentLoaded',function(){


	CargarUsuarios();



	var formUsuario = document.querySelector('#formUsuario');
	formUsuario.onsubmit = function(e){
		//evita que se recarge la pagina
		e.preventDefault();
		var strIdentificacion = document.querySelector('#txtIdentificacion').value;
		var strNombre = document.querySelector('#txtNombre').value;
		var strApellido = document.querySelector('#txtApellido').value;
		var intTelefono = document.querySelector('#txtTelefono').value;
		var strEmail = document.querySelector('#txtEmail').value;
		var intTipoUsuario = document.querySelector('#listRolid').value;
		var strPassword = document.querySelector('#txtPassword').value;
		var intEstado = document.querySelector('#listStatus').value;


		if(strIdentificacion == "" || strNombre == "" || strApellido == "" || intTelefono=="" || strEmail==""){
			swal("Atencion","Todos los campos son obligatorios","error");
			return false;
		}

		let elementsValid = document.getElementsByClassName("valid");


		for (let i = 0; i < elementsValid.length; i++) {
			if(elementsValid[i].classList.contains('is-invalid')){
				swal("Usuarios","Por favor, verifique los campos en rojo.","info");
				return false;
			}
		}

		
	//validando en que navegador estamos
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	//creando la ruta en donde enviaremos los datos
	var ajaxUrl = base_url+'/Usuarios/setUsuario';
	//creando la variable formData, que sera igual al objeto Formdata
	var formData = new FormData(formUsuario);
	//abriendo la conexion indicando que enviaremos datos por el metodo post
	request.open("POST",ajaxUrl,true);
	//enviar la informacion que es igual al objeto
	request.send(formData);


	request.onreadystatechange = function(){

		if(request.readyState == 4 && request.status == 200){
			//obteniendo los datos enviados desde el controlador $arrResponse
			var objData = JSON.parse(request.responseText);
			//si el status del controlador es verdadero true
			if(objData.status){
				$('#modalFormUsuario').modal("hide");
				formUsuario.reset();
				swal("Usuarios",objData.msg, "success");
				tableUsuarios.api().ajax.reload();

			}else{
				swal("Error",objData.msg,"error");
			}

		}


	}




	}



},false);


function CargarUsuarios(){
			tableUsuarios = $('#tableUsuarios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Usuarios/getUsuarios",
            "dataSrc":""
        },
        "columns":[
            {"data":"idpersona"},
            {"data":"identificacion"},
            {"data":"nombres"},
            {"data":"apellidos"},
            {"data":"telefono"},
            {"data":"email_user"},
            {"data":"nombrerol"},
            {"data":"status"},
            {"data":"fechaRegistro"},
            {"data":"options"},
            
        ],
/*
         'dom': 'lBfrtip',
        	'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Esportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Esportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Esportar a CSV",
                "className": "btn btn-info"
            }
        ],*/

        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });
}


window.addEventListener('load',function(){
fntRolesUsuario();
/*	fntViewUsuario();
	fntEditUsuario();
	fntDelUsuario();*/
}, false);





function fntRolesUsuario(){
	var ajaxUrl = base_url+'/Usuarios/getSelectRoles';
	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	request.open("GET",ajaxUrl,true);
	request.send();

	//obteniendo los resultados del ajax
	request.onreadystatechange = function(){
		if (request.readyState == 4 && request.status == 200) {
			//incluyendo en la lista, el $htmlOptions a traves del request.response
			document.querySelector('#listRolid').innerHTML = request.responseText;
			// seleccionando el primer option
			document.querySelector('#listRolid').value=1;
			//actualizar el select para que se muestren los registros obtenidos
			$('#listRolid').selectpicker('render');

		}
	}
}








function fntViewUsuario(idpersona){


			var idpersona = idpersona;
			var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			var ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status==200){
					var objData = JSON.parse(request.responseText);
					if(objData.status){
						var estadoUsuario = objData.data.status == 1 ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>'
						
						document.querySelector('#celIdentificacion').innerHTML=objData.data.identificacion;
						document.querySelector('#celNombre').innerHTML=objData.data.nombres;
						document.querySelector('#celApellido').innerHTML=objData.data.apellidos;
						document.querySelector('#celTelefono').innerHTML=objData.data.telefono;
						document.querySelector('#celEmail').innerHTML=objData.data.email_user;
						document.querySelector('#celTipoUsuario').innerHTML=objData.data.nombrerol;
						document.querySelector('#celEstado').innerHTML=estadoUsuario;
						document.querySelector('#celFechaRegistro').innerHTML=objData.data.fechaRegistro;
						$('#modalViewUsuario').modal('show');
					}else{
						swal("Error",objData.msg,"error");
					}
				}
			};


				
	
}

function fntEditUsuario(idpersona){
	

			document.querySelector('#titleModal').innerHTML="Editar usuario";
			document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
			document.querySelector('#btnText').innerHTML="Actualizar";
			document.querySelector('.modal-header').classList.replace("headerRegister","headerUpdate");
			
			
			let elementsValid = document.querySelectorAll(".valid");
			elementsValid.forEach(function(e){
				if(e.classList.contains('is-invalid')){
				e.classList.remove('is-invalid');
			}
			});

		

	/*		document.querySelectorAll(".validEmail").classList.add('is-valid');
			document.querySelectorAll(".validText").classList.add('is-valid');
			document.querySelectorAll(".validNumber").classList.add('is-valid');
*/
			var idpersona = idpersona;
			var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			var ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function(){

				if(request.readyState == 4 && request.status==200){
					var objData = JSON.parse(request.responseText);

					if(objData.status){

						document.querySelector('#idUsuario').value = objData.data.idpersona;
						document.querySelector('#txtPassword').value = "";
						document.querySelector('#txtIdentificacion').value = objData.data.identificacion;
					/*	document.getElementById('txtIdentificacion').readOnly
                        = true;*/
						document.querySelector('#txtNombre').value = objData.data.nombres;
						document.querySelector('#txtApellido').value = objData.data.apellidos;
						document.querySelector('#txtTelefono').value = objData.data.telefono;
						document.querySelector('#txtEmail').value = objData.data.email_user;
						document.querySelector('#listRolid').value = objData.data.idrol;
						
						//para que se actualice la lista deplegable con jquery
						$('#listRolid').selectpicker('render');

						if(objData.data.status==1){
							document.querySelector('#listStatus').value = 1;
						}else{
							document.querySelector('#listStatus').value = 1;
						}
						$('listStatus').selectpicker('render');



						$('#modalFormUsuario').modal('show');
					}else{
						swal("Error",objData.msg,"error");
					}
				}

		
			};


				
	
}


function fntDelUsuario(idpersona){

    
            var iduser = idpersona;
            swal({
                title: "Eliminar Usuario",
                text: "¿Realmente quiere eliminar el usuario?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No, cancelar!",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function(isConfirm) {
                
                if (isConfirm) 
                {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = base_url+'/Usuarios/delUser/';
                    var strData = "iduser="+iduser;
                    request.open("POST",ajaxUrl,true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strData);
                    request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status == 200){
                            var objData = JSON.parse(request.responseText);
                            if(objData.status)
                            {
                                swal("Eliminar!", objData.msg , "success");
                                tableUsuarios.api().ajax.reload();
                            }else{
                                swal("Atención!", objData.msg , "error");
                            }
                        }
                    }
                }

            });

    
}



function openModalUsuarios(){
	document.querySelector('#idUsuario').value="";
	document.getElementById('txtIdentificacion').readOnly
                        = false;
	document.querySelector('.modal-header').classList.replace("headerUpdate","headerRegister");
	document.querySelector('#btnActionForm').classList.replace("btn-info","btn-primary");
	document.querySelector('#btnText').innerHTML="Guardar";
	document.querySelector('#titleModal').innerHTML="Nuevo usuario";
	document.querySelector('#formUsuario').reset();
	//fntRolesUsuario();
	$('#modalFormUsuario').modal('show');

}

