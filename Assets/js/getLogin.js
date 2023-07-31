   // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });


   document.addEventListener('DOMContentLoaded',function(){
     
        

      
      if(document.querySelector('#formLogin')){
         let formLogin = document.querySelector("#formLogin");
  
         formLogin.onsubmit = function(e){
            e.preventDefault();

           
            let strEmail = document.querySelector("#txtEmail").value;
            let strPassword = document.querySelector("#txtPassword").value;

            if(verificarCampos()=="incorrecto"){
               swal("Login","Por favor, complete todos los campos","info");
               return false;       
            }else{

               verificarUsuario();


           
            }
         }
         }
         
      


      var loadingCarga = document.querySelector("#divLoading");

      if(document.querySelector('#formRecetPass')){
         let formRecet = document.querySelector('#formRecetPass');
         formRecet.onsubmit = function(e){
            e.preventDefault();

            let strEmail = document.querySelector('#txtEmailReset').value;
               

            if(strEmail == ""){
               swal("Atención","Por favor, ingrese su correo.","info");
               return false

            }else{
               loadingCarga.style.display = "flex"; 

            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            //creando la ruta en donde enviaremos los datos
            var ajaxUrl = base_url+'/Login/resetPass';
            //creando la variable formData, que sera igual al objeto Formdata
            var formData = new FormData(formRecet);
            //abriendo la conexion indicando que enviaremos datos por el metodo post
            request.open("POST",ajaxUrl,true);
            //enviar la informacion que es igual al objeto
            request.send(formData);
            //aqui recibimos todos los datos de request, es decir del controlador
               request.onreadystatechange = function(){
                   if(request.readyState == 4 && request.status == 200){
                     var objData = JSON.parse(request.responseText);

                     if(objData.status){



                        swal({
                           title: "",
                           text: objData.msg,
                           type:"success",
                           confirmButtonText: "Aceptar",
                           closeOnConfirm: false,

                        }, function(isConfirm){
                           if(isConfirm){
                              window.location = base_url+"/login";
                           }
                        });


                     }else{
                        swal("Atención",objData.msg,"error");
                     }

                   }else{
                     swal("Atención","Error en el proceso","error");
                   }
                   loadingCarga.style.display = "none"; 
                   return false;
               }
            }
         }
      }

      if(document.querySelector('#formCambiarPass')){
         let formCambiar = document.querySelector('#formCambiarPass');
         formCambiar.onsubmit = function(e){
            e.preventDefault();

            let txtPassword = document.querySelector("#txtPassword").value;
            let txtPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
            let idUsuario = document.querySelector('#idUsuario').value;

            if(txtPassword == "" || txtPasswordConfirm == ""){
               swal("Atención","Todos los campos son obligatorios","info");
               return false
            }else{
               if(txtPassword.length<7){
                  swal("Atención","La contraseña debe tener un mínimo de 7 caracteres","info");
                  return false;
               }

               if(txtPassword != txtPasswordConfirm){
               swal("Error", "Las contraseñas no son iguales.","error");
               return false;
               }

           var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            //creando la ruta en donde enviaremos los datos
            var ajaxUrl = base_url+'/Login/setPassword';
            //creando la variable formData, que sera igual al objeto Formdata
            var formData = new FormData(formCambiarPass);
            //abriendo la conexion indicando que enviaremos datos por el metodo post
            request.open("POST",ajaxUrl,true);
            //enviar la informacion que es igual al objeto
            request.send(formData);

            request.onreadystatechange = function(){
               if(request.readyState != 4) return;
               if(request.status == 200){
               var objData = JSON.parse(request.responseText);
               if (objData.status) {
                    swal({
                           title: "Genial",
                           text: objData.msg,
                           type:"success",
                           confirmButtonText: "Aceptar",
                           closeOnConfirm: false,

                        }, function(isConfirm){
                           if(isConfirm){
                              window.location = base_url+"/login";
                           }
                        });
               }else{
                  swal("Atención",objData.msg,"error");
               }

               }else{
                  swal("Atención","Error en el proceso","error");
               }
            }

            }  

         

         }
      }


   }, false);

      
window.addEventListener('load', function() {
    limpiarPassword();
}, false);


function verificarCampos(){
      let $valor = "correcto";
               let strEmail = document.querySelector("#txtEmail").value;
            let strPassword = document.querySelector("#txtPassword").value;

            if(strEmail=="" || strPassword ==""){
               $valor = "incorrecto";
              
               }

 return $valor;

}

function limpiarPassword(){
   let txtPassword = document.querySelector("#txtPassword");
   txtPassword.value = "";
}

function verificarUsuario(){
                  //validando en que navegador estamos
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            //creando la ruta en donde enviaremos los datos
            var ajaxUrl = base_url+'/Login/loginUser';
            //creando la variable formData, que sera igual al objeto Formdata
            var formData = new FormData(formLogin);
            //abriendo la conexion indicando que enviaremos datos por el metodo post
            request.open("POST",ajaxUrl,true);
            //enviar la informacion que es igual al objeto
            request.send(formData);
               request.onreadystatechange = function(){

            if(request.readyState == 4 && request.status == 200){
               var objData = JSON.parse(request.responseText);
               if(objData.status){
                  window.location = base_url+'/inicio';
                  return false;
               }else{   
                  swal("Login",objData.msg,"error");
                  document.querySelector('#txtPassword').value="";
               }

            }
}
}