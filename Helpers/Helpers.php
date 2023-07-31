<?php 

use PHPMailer\PHPMailer\PHPMailer; 
require_once ('PHPMailer/PHPMailer.php');    

	//Retorla la url del proyecto
	function base_url()
	{
		return BASE_URL;
	}
    //Retorla la url de Assets
    function media()
    {
        return BASE_URL."/Assets";
    }
    function headerAdmin($data="")
    {
        $view_header = "Views/Template/header_admin.php";
        require_once ($view_header);
    }
    function footerAdmin($data="")
    {
        $view_footer = "Views/Template/footer_admin.php";
        require_once ($view_footer);        
    }
	//Muestra información formateada
	function dep($data)
    {
        $format  = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }



    
    function enviar_email($url_recovery){



                            
                            $mail = new PHPMailer(true);

try {

    

    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->SMTPOptions = array(

        'ssl' => array(

            'verify_peer' => false,

            'verify_peer_name' => false,

            'allow_self_signed' => true

        )

    ); 
    $mail->Username   = 'pruebaphpcode@gmail.com';                     //SMTP username
    $mail->Password   = 'vcliegeqymymqaer';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('compubyte-noreply@company.com', 'COMPUBYTE');
    $mail->addAddress('1923010051@untels.edu.pe', '');
    

   

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Cambio de password por olvido';
    $mail->Body    = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Recuperar cuenta</title>
    <style type="text/css">
        p{
            font-family: arial;
            letter-spacing: 1px;
            color: #7f7f7f;
            font-size: 15px;
        }
        a{
            color: #3b74d7;
            font-family: arial;
            text-decoration: none;
            text-align: center;
            display: block;
            font-size: 18px;
        }
        .x_sgwrap p{
            font-size: 20px;
            line-height: 32px;
            color: #244180;
            font-family: arial;
            text-align: center;
        }
        .x_title_gray {
            color: #0a4661;
            padding: 5px 0;
            font-size: 15px;
            border-top: 1px solid #CCC;
        }
        .x_title_blue {
            padding: 08px 0;
            line-height: 25px;
            text-transform: uppercase;
            border-bottom: 1px solid #CCC;
        }
        .x_title_blue h1{
            color: #0a4661;
            font-size: 25px;
            font-family: "arial";
        }
        .x_bluetext {
            color: #244180 !important;
        }
        .x_title_gray a{
            text-align: center;
            padding: 10px;
            margin: auto;
            color: #0a4661;
        }
        .x_text_white a{
            color: #FFF;
        }
        .x_button_link {
            width: 100%;
            max-width: 470px;
            height: 40px;
            display: block;
            color: #FFF;
            margin: 20px auto;
            line-height: 40px;
            text-transform: uppercase;
            font-family: Arial Black,Arial Bold,Gadget,sans-serif;
        }
        .x_link_blue {
            background-color: #307cf4;
        }
        .x_textwhite {
            background-color: rgb(50, 67, 128);
            color: #ffffff;
            padding: 10px;
            font-size: 15px;
            line-height: 20px;
        }
    </style>
</head>
<body>
    <table align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="text-align:center;">
        <tbody>
            <tr>
                <td>
                    <div class="x_sgwrap x_title_blue">
                        <h1> COMPUBYTE EIRL </h1>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="x_sgwrap">
                        <p>Hola Paulino Alfonso </p>
                    </div>
                    <p>Solicitud de acceso para el usuario: <strong>1923010051@untels.edu.pe</strong></p>
                    <p>Has solicitado los datos de tu usuario, accede al enlace de abajo para confirmar tu contraseña. </p>
                    <p class="x_text_white">
                    <a href="'.$url_recovery.'" target="_blank" class="x_button_link x_link_blue">Confirmar datos</a>
                    </p>
                    <br>
                    <p>Si no te funciona el botón puedes copiar y pegar la siguiente dirección en tu navegador.</p>
                    <span>'.$url_recovery.'</span>
                    
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>';
    

    $mail->send();
  
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



    }


   /* function sendEmail($data,$template)
    {
        $asunto = $data['asunto'];
        $emailDestino = $data['email'];
        $empresa = NOMBRE_REMITENTE;
        $remitente = EMAIL_REMITENTE;
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$empresa} <{$remitente}>\r\n";
        ob_start();
        require_once("Views/Template/Email/".$template.".php");
        $mensaje = ob_get_clean();
        $send = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    }
        */
    function cortarFrase($frase, $maxPalabras = 1, $noTerminales = ["de"]) {
    $palabras = explode(" ", $frase);
    $numPalabras = count($palabras);
    if ($numPalabras > $maxPalabras) {
        $offset = $maxPalabras - 1;
        while (in_array($palabras[$offset], $noTerminales) && $offset < $numPalabras) { $offset++; }
        return implode(" ", array_slice($palabras, 0, $offset+1));
    }
    return $frase;
}

  


//////////////////////
    function getModal(string $nameModal, $data)
    {
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once $view_modal;        
    }


    function getPermisos(int $idmodulo){
        require_once("Models/PermisosModel.php");
        $objPermisos = new PermisosModel();
        $idrol = $_SESSION['userData']['idrol'];
        $arrPermisos = $objPermisos->permisosModulo($idrol);
        $permisos = '';
        $permisosMod = '';
        
        if(count($arrPermisos)>0){
            $permisos = $arrPermisos;
            $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
        }

        $_SESSION['permisos'] = $permisos;
        $_SESSION['permisosMod'] = $permisosMod;

    }


    //Elimina exceso de espacios entre palabras
    function strClean($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }
    //Genera una contraseña de 10 caracteres
	function passGenerator($length = 10)
    {
        $pass = "";
        $longitudPass=$length;
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);

        for($i=1; $i<=$longitudPass; $i++)
        {
            $pos = rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);
        }
        return $pass;
    }
    //Genera un token
    function token()
    {
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }


        function codigoRecuperacion()
    {
        $r1 = strtoupper(bin2hex(random_bytes(3)));
        
        $codigo = $r1;
        return $codigo;
    }



    //Formato para valores monetarios
    function formatMoney($cantidad){
        $cantidad = number_format($cantidad,2,SPD,SPM);
        return $cantidad;
    }
    

 ?>