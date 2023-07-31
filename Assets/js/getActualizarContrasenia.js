const base_url = "http://localhost/tienda_virtual";

   function password_show_hide() {
  var x = document.getElementById("txtpassword");
  var show_eye = document.getElementById("show_eye");
  var hide_eye = document.getElementById("hide_eye");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}

document.addEventListener('DOMContentLoaded', function(){


let formActualizarPass = document.querySelector("#formActualizarPassword");
 formActualizarPass.onsubmit = function(e){
            e.preventDefault();

            if(document.querySelector('#txtpassword').value==""){
                Swal.fire({
            title: "Password",
            text: `Por favor, primero ingrese una contraseña.`,
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
            var ajaxUrl = " "+base_url+"/ActualizarPassword/confirmUser";
            //creando la variable formData, que sera igual al objeto Formdata
            var formData = new FormData(formActualizarPass);
            //abriendo la conexion indicando que enviaremos datos por el metodo post
            request.open("POST",ajaxUrl,true);
            //enviar la informacion que es igual al objeto
            request.send(formData);


     request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){

        var objData = JSON.parse(request.responseText);

        if(objData.status){
        	//swal("Confirmacion",objData.msg,"success");
            
            window.location = base_url+'/ConfirmarPasswords';
        }else{

            document.querySelector('#txtpassword').value="";
            document.querySelector('#txtpassword').focus();

        	Swal.fire({
            title: "Contraseña incorrecta",
            text: `${objData.msg}`,
            icon: "error",
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            focusConfirm: true,
           
           
            

})
        }


           }
}

        }

});
