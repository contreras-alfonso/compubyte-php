<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= media();?>/images/logito.png">
    <link rel="stylesheet" href="<?=media();?>/css/factura.css">
    <script src="<?= media(); ?>/js/script.js"></script>
    <script src="<?= media(); ?>/js/plugins/html2pdf.bundle.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
   
    <title>Factura <?php echo $data['idfactura']; ?></title>
</head>
<body>
    <div class="container" id="contenedor">


<div class="cabecera">  
    <div>
    <p class="negrita">COMPUBYTE E.I.R.L</p>
    <p>PJ. GUARDIA CIVIL 482 A.H. HOGAR POLICIAL UNO</p>
    <p>VILLA MARIA DEL TRIUNFO - LIMA - LIMA</p>
    </div>
    
    <div class="titulo">
    <P class="negrita">FACTURA DE VENTA ELECTRONICA</P>
    <P class="negrita">RUC:20604074038</P>
    <p class="negrita" id="SOLfactura" class="SOLfactura"><?php echo $data['idfactura'];?></p>
    </div>
</div>

<div class="infoUsuario">
    <div class="etiquetasUsuario">
<p class="largowidth">Fecha de vencimiento :</p>
<p class="largowidth">Fecha de Emisión   <?php echo str_repeat('&nbsp;', 9); echo ": "; echo "<b>{$data['fechaEmision']}</b>";?> </p>
<p class="largowidth">Señor(es)     <?php echo str_repeat('&nbsp;', 23); echo ": ";echo "<b>{$data['señores']}</b>"; ?></p>
<p class="largowidth">RUC : <?php echo str_repeat('&nbsp;', 31); echo ": "; echo "<b>{$data['ruc']}</b>";?></p>
<p class="largowidth">Dirección del cliente  <?php echo str_repeat('&nbsp;', 5); echo ": "; echo "<b>{$data['direccion']}</b>"; ?></p>
<p class="largowidth">Tipo de Moneda  <?php echo str_repeat('&nbsp;', 12); echo ": ";echo "<b>SOLES</b>" ?></p>
<p class="largowidth">Observación :</p>
</div>
<?php /*  ?>
<div class="datosUsuario">
<input class="negritaSinBorde" type="text" value=":" disabled>
<input class="negritaSinBorde" type="text" value=": <?php echo $data['fechaEmision']; ?> " disabled>
<input class="negritaSinBorde" type="text" value=": <?php echo $data['señores']; ?> " disabled>
<input class="negritaSinBorde" type="text" value=": <?php echo $data['ruc']; ?> " disabled>
<input class="negritaSinBorde" type="text" value=": <?php echo $data['direccion']; ?> " disabled>
<input class="negritaSinBorde" type="text" value=": SOLES" disabled>
<input class="negritaSinBorde" type="text" value=":" disabled>
</div>
<?php */  ?>
    </div>

<div class="tablita">
    <table CELLPADDING="10">
        <tr BORDER="1" class="bordeTitulos">
            <th>Cantidad</th>
            <th>Unidad Medida</th>
           
            <th>Descripción</th>
            <th>Valor Unitario(*)</th>
             <th>Importe de venta (**)</th>
            <th>ICBPER</th>
        </tr>

        <?php for ($i=0; $i <count($_SESSION['arrProductos']) ; $i++) { ?>
            
         
        <tr class="bordeTitulos">
            <td><?php echo intval($_SESSION['arrProductos'][$i]['cantidad']); ?>.00</td>
            <td>UNIDAD</td>
            
            <td><?php echo $_SESSION['arrProductos'][$i]['nombreproducto']; ?></td>
            <td><?php echo intval($_SESSION['arrProductos'][$i]['precio'])*(85/100) ?></td>
            <td><?php echo $_SESSION['arrProductos'][$i]['precio']; ?></td>
            <td>0.00</td>  
        </tr>
        <?php }  ?>
     
    </table>

</div>



<div class="detallesPrecio">
    <div>
    <p>(*) Sin impuestos.</p>
    <p>(**) Incluye impuestos, de ser Op. Gravada.</p>
</div>

<div class="contenedorPrecios">
<div class="titulosPrecios">
    <p>Op. Gravada :</p>
    <p>Op. Exonerada :</p>
    <p>Op. Inafectada :</p>
    <p>ISC :</p>
    <p>IGV :</p>
    <p>ICBPER :</p>
    <p>Otros cargos :</p>
    <p>Otros tributos :</p>
    <p>Monto de Redondeo :</p>
    <p class="negrita">Importe Total:</p>
</div>
<div class="precios">
    <input class="camposTexto" type="text" value="S/ <?php echo $data['total']*(85/100) ?>" disabled>
    <input class="camposTexto" type="text" value="S/ 0.00" disabled>
    <input class="camposTexto" type="text" value="S/ 0.00" disabled>
    <input class="camposTexto" type="text" value="S/ 0.00" disabled>
    <input class="camposTexto" type="text" value="S/ <?php echo intval($data['total'])*(15/100); ?>" disabled>
    <input class="camposTexto" type="text" value="S/ 0.00" disabled>
    <input class="camposTexto" type="text" value="S/ 0.00" disabled>
    <input class="camposTexto" type="text" value="S/ 0.00" disabled>
    <input class="camposTexto" type="text" value="S/ 0.00" disabled>
    <input class="camposTexto textnegro" type="text" value="S/ <?php echo $data['total'] ?>" disabled>
</div>

</div>

</div>    


<div class="ultimo">
<p class="center">Esta es una representación impresa de la Factura de Venta Electrónica, generada en el Sistema de la SUNAT. El Emisor Electrónico puede verificarla utilizando su clave SOL, el Adquirente o Usuario puede consultar su validez en SUNAT Virtual: <a class="azul" href="https://www.sunat.gob.pe">www.sunat.gob.pe</a> en Opciones sin Clave SOL/ Consulta de Validez del CPE.</p>
</div>


</div>

<div class="contenedorBotones">

<button id="btnCrearPdf" class="btnImprimir">Imprimir</button>
<a href="<?= base_url();?>/comprobante"><button class="btnUltimo btnRegresar">Regresar</button></a>

</div>


</body>
</html>