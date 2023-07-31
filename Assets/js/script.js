/*

  ____          _____               _ _           _       
 |  _ \        |  __ \             (_) |         | |      
 | |_) |_   _  | |__) |_ _ _ __ _____| |__  _   _| |_ ___ 
 |  _ <| | | | |  ___/ _` | '__|_  / | '_ \| | | | __/ _ \
 | |_) | |_| | | |  | (_| | |   / /| | |_) | |_| | ||  __/
 |____/ \__, | |_|   \__,_|_|  /___|_|_.__/ \__, |\__\___|
         __/ |                               __/ |        
        |___/                               |___/         
    
____________________________________
/ Si necesitas ayuda, contáctame en \
\ https://parzibyte.me               /
 ------------------------------------
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||
Creado por Parzibyte (https://parzibyte.me). Este encabezado debe mantenerse intacto,
excepto si este es un proyecto de un estudiante.
*/
document.addEventListener("DOMContentLoaded", () => {
    // Escuchamos el click del botón
    const $boton = document.querySelector("#btnCrearPdf");
    const container = document.querySelector('#contenedor');
    const solfactura = document.querySelector('#SOLfactura').innerHTML;
    container.classList.remove('cambiarTamanioContainer');
    

    $boton.addEventListener("click", () => {
        container.classList.add('cambiarTamanioContainer');
        const $elementoParaConvertir = document.querySelector('#contenedor'); // <-- Aquí puedes elegir cualquier elemento del DOM

        html2pdf()
            .set({
                margin: 1,
                filename: `Comrpobante - ${solfactura} `,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3, // A mayor escala, mejores gráficos, pero más peso
                    letterRendering: true,
                },
                jsPDF: {
                    unit: "in",
                    format: "a3",
                    orientation: 'portrait' // landscape o portrait
                }
            })

            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err));

        ;      sleep(500).then(function() {
     location.reload()
});
            
    });
    //

      
});


function sleep(time)
{
    return(new Promise(function(resolve, reject) {
        setTimeout(function() { resolve(); }, time);
    }));
}