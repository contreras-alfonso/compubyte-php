<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=media();?>/css/mostrarProforma.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= media();?>/images/logito.png">
    <script src="<?= media(); ?>/js/script2.js"></script>
    <script src="<?= media(); ?>/js/plugins/html2pdf.bundle.min.js"></script>
    <title>Proforma N°<?php echo $data['numeroProforma']?></title>
</head>
<body>
    
    <div id="container">
    <div class="contenedorSuper"> 
        <h1 class="tituloEmpresa">COMPUBYTE</h1>
        <p>C.C CYBERPLAZA - 3A STAND 130 - LIMA</P>
        
    </div>
    
    <div class="FraseEmpresa" id="FraseEmpresa">
        <p>VENTA DE EQUIPOS DE COMPUTO AL POR MAYOR Y MENOR</p>
    </div>

    <p class="TituloProforma">PROFORMA N°<?php echo $data['numeroProforma']?></p>
    <input type="hidden" id="nmrProforma" value="<?php echo $data['numeroProforma']?>">

<div class="contenedorTabla">
    
    <table class="tableProductos">
     <tr class="PrimeraFilaTabla">
        <td>Cantidad</td>
        <td>Articulo</td>
        <td>P. uni</td>
        <td>Total</td>
       </tr>

       <?php for ($i=0; $i <count($_SESSION['productosProforma']) ; $i++) { ?>
          
       <tr>
        <td> <?php echo $_SESSION['productosProforma'][$i]['cantidad'] ?> </td>
        <td> <?php echo $_SESSION['productosProforma'][$i]['nombreproducto'] ?></td>
        <td> <?php echo $_SESSION['productosProforma'][$i]['precio'] ?></td>
        <td> <?php echo $_SESSION['productosProforma'][$i]['subtotal'] ?></td>
       </tr>

       <?php }  ?>
    </table>

    <div class="contenedorPrecio">
    <p class="PrecioTotal">S/.<?php echo $data['importeTotal']?></p>
    </div>
</div>

    <div class="ContenedorInfoVendedor" id="ContenedorInfoVendedor">
        <div>
        <img class="imagenInfoVendedor" src="<?= media();?>/images/trabajador.png" alt="Imagen trabajado">
        <p>Asesor: <?php echo $data['asesor'] ?> </p>
        </div>

        <div>
        <img class="imagenInfoVendedor" src="<?= media();?>/images/whatsapp.png" alt="Imagen trabajado">
        <p>981632216</p>
        </div>

        <div>
        <img class="imagenInfoVendedor" src="<?= media();?>/images/email.png" alt="Imagen trabajado">
        <p>jmag@compubyte200.com.pe</p>
        </div>
    </div>
    <h2>Medios de pago</h2>
    <div class="ContenedorMediosPago" id="ContenedorMediosPago">
        <div class="margenMedioPago">
            <img class="imagenMedioPagoBCP" src="<?= media();?>/images/logobcp.jpg" alt="Imagen trabajador">
            <p>Cuenta soles: 194-2619171-0-72</p>
            <p>Cuenta dólares: 194-3216153-2-71</p>
            <p>Corporación COMPUBYTE</p>
        </div>

        <div class="margenMedioPago">
            <img class="imagenMedioPagoBBVA" src="<?= media();?>/images/bbva.png" alt="Imagen trabajado">
            <p>Cuenta soles: 0011-0133-00053520</p>
            <p>Cuenta dólares: 0011-0133-00053520</p>
            <p>Corporación COMPUBYTE</p>
        </div>

        <div class="margenMedioPago">
            <img class="imagenMedioPagoInterbank" src="<?= media();?>/images/Interbank.png" alt="Imagen trabajado">
            <p>Corporación COMPUBYTE</p>
        </div>

    </div>



    <div class="contenedorImagesMarcas" id="contenedorImagesMarcas">
        <img class="imagenMedioPagoInterbank" src="<?= media();?>/images/ryzen.png" alt="Imagen trabajado">
        <img class="imagenMedioPagoInterbank" src="<?= media();?>/images/intel.png" alt="Imagen trabajado">
        <img class="imagenMedioPagonvidia" src="<?= media();?>/images/nvidia.png" alt="Imagen trabajado">
        <img class="imagenMedioPagoInterbank" src="<?= media();?>/images/gigabyte.png" alt="Imagen trabajado">
        <img class="imagenMedioPagoInterbank" src="<?= media();?>/images/msi.png" alt="Imagen trabajado">
    </div>

    <div class="contenedorImagesMarcasSuperior" id="contenedorImagesMarcasSuperior">
        <div class="ImageMarca">
        <img class="imagenMarcaAsus" src="<?= media();?>/images/asus.png" alt="Imagen trabajado">
        </div>

        <div class="ImageMarca">
        <img class="imagenMarcaAMD" src="<?= media();?>/images/amd.png" alt="Imagen trabajado">
    </div>

    <div class="ImageMarca">
        <img class="imagenMarcaKingston" src="<?= media();?>/images/kingston.png" alt="Imagen trabajado">
    </div>

    </div>

    <p class="urlPagina">www.compubyte.com.pe</p>

    <div class="infoTienda" id="infoTienda">
        <div class="infoTiendaFlex">
            <p><img class="imagenLogofacebook" src="<?= media();?>/images/facebook.png" alt="Imagen trabajado"> Corporación COMPUBYTE SAC</p>
        </div>

        <div class="infoTiendaFlex">
            <p><img class="imagenLogoInstagram" src="<?= media();?>/images/instagram.png" alt="Imagen trabajado"> CompubyteSAC</p>
        </div>
    </div>
        </div>
    <div class="contenedorBotones">
        <button class="btnUltimo" id="btnCrearPdf">DESCARGAR</button>
        <button class="btnUltimo"><a href="<?= base_url();?>/proformas">REGRESAR</a></button>
    </div>

</body>
</html>