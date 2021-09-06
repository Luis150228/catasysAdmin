$(document).ready(function () {});

const nota = document.querySelector('#nota');
const num_escr = document.querySelector('#escr');
  

  $("#previewTraslado").on('click', function () {
		window.open(`./print/printTrasladoPublic.php?nota=${nota.value}&num_escr=${num_escr.value}` , "Imprimir_TrasladoPreview" , "width=500,height=600,scrollbars=YES")
	})