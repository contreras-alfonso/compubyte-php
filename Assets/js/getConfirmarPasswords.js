const base_url = "http://localhost/tienda_virtual";

   function password_show_hide() {
  var x = document.getElementById("txtpassword");
  var show_eye1 = document.getElementById("show_eye1");
  var hide_eye1 = document.getElementById("hide_eye1");
  hide_eye1.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye1.style.display = "none";
    hide_eye1.style.display = "block";
  } else {
    x.type = "password";
    show_eye1.style.display = "block";
    hide_eye1.style.display = "none";
  }
}



   function password_show_hide2() {
  var x = document.getElementById("txtpasswordconfirm");
  var show_eye2 = document.getElementById("show_eye2");
  var hide_eye2 = document.getElementById("hide_eye2");
  hide_eye2.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye2.style.display = "none";
    hide_eye2.style.display = "block";
  } else {
    x.type = "password";
    show_eye2.style.display = "block";
    hide_eye2.style.display = "none";
  }
}






document.addEventListener('DOMContentLoaded', function(){

document.querySelector('#txtpassword').value="";
document.querySelector('#txtpasswordconfirm').value="";

let formconfirmarPasswords = document.querySelector("#formconfirmarPasswords");
 formconfirmarPasswords.onsubmit = function(e){
e.preventDefault();

	var contraseña = document.querySelector('#txtpassword').value;
	var contraseñarepeat = document.querySelector('#txtpasswordconfirm').value;


if(contraseña == "" ){
	Swal.fire({
            title: "Password",
            text: `Ingrese primero una contraseña.`,
            icon: "info",
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            iconColor: '#B24858',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
                            
})
	return false;
}



if(contraseñarepeat == "" ){
	Swal.fire({
            title: "Password",
            text: `Ingrese la confirmación de la contraseña.`,
            icon: "info",
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            iconColor: '#B24858',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
                            
})
	return false;
}


	if(contraseña != contraseñarepeat){
		Swal.fire({
            title: "Password",
            text: `Las contraseñas ingresadas no son iguales.`,
            icon: "info",
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            iconColor: '#B24858',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
                            
})
		return false;
	}


	if(contraseña.length <= 8){
	Swal.fire({
            title: "Password",
            text: `La nueva contraseña debe tener almenos 8 caracteres.`,
            icon: "info",
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            iconColor: '#B24858',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
                            
})

	return false;
	}


            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            //creando la ruta en donde enviaremos los datos
            var ajaxUrl = base_url+'/ConfirmarPasswords/updatePassword';
            //creando la variable formData, que sera igual al objeto Formdata
            var formData = new FormData(formconfirmarPasswords);
            //abriendo la conexion indicando que enviaremos datos por el metodo post
            request.open("POST",ajaxUrl,true);
            //enviar la informacion que es igual al objeto
            request.send(formData);


     request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){

    	var objData = JSON.parse(request.responseText);

    	if(objData.status){
    			Swal.fire({
            title: "Password",
            text: `${objData.msg}`,
            icon: "success",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            allowOutsideClick: false,
                            
}).then((result) => {
  if (result.isConfirmed) {
		window.location = base_url+'/inicio';
  }
})
    	}else{
    		  Swal.fire({
            title: "Password",
            text: `${objData.msg}`,
            icon: "error",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
            showCloseButton: true,
           
                            
})
    	}


    }
}

}

	});