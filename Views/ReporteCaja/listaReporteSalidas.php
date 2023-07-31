<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= media();?>/images/logito.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=media();?>/css/listaReporteVentas.css">
    <script src="<?= media(); ?>/js/script3.js"></script>
    <script src="<?= media(); ?>/js/plugins/html2pdf.bundle.min.js"></script>
    
   
   
    <title>Lista reporte </title>
</head>
<body>

    <div class="contenedorTotal" id="contenedorTotal">
    <div id="container">
    <div class="contenedorSuper"> 
        <h1 class="tituloEmpresa">COMPUBYTE</h1>
        <p>C.C CYBERPLAZA - 3A STAND 130 - LIMA</P>
        
    </div>
    </div>

<p class="tituloFechas"><?php echo $_SESSION['FechasdeReporteVenta'] ?></p>
<div class="contenedorTabla" id="contenedorTabla">
<input type="hidden" value="salidas" id="nombreReporte">

<p class="negrita"  id="SOLfactura" class="SOLfactura"></p>

<div class="tablita">
    <table CELLPADDING="10" class="tablaPrincipal tablaPrincipal2">
        <tr class="bordeTitulos">
            <td>Detalle</td>
            <td>Nro Comprobante</td>
            <td>Fecha</td>
            <td>Total</td>
           
        </tr>

        
        <?php for ($i=0; $i <count($data['reporteVentas']) ; $i++) { ?>    
         
        <tr>
            <td><?php echo $data['reporteVentas'][$i]['detalle'] ?></td>
            <td><?php echo $data['reporteVentas'][$i]['numeroComprobante'] ?></td>
            <td><?php echo $data['reporteVentas'][$i]['fecha'] ?></td>
            <td><?php echo $data['reporteVentas'][$i]['importe'] ?></td>
             
        </tr>
        
        <?php } ?>
     
    </table>

</div>
</div>
</div>

<div class="contenedorBotones">
<button class="btnUltimo" id="btnCrearPdf">
<span></span>
        <span></span>
        <span></span>
        <span></span>
Descargar</button>
<a href="<?= base_url();?>/ReporteCaja"><button class="btnUltimo btnRegresar">
<span></span>
        <span></span>
        <span></span>
        <span></span>
Regresar</button></a>
</div>

</body>
</html>