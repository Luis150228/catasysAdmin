$(document).ready(function () {
    const btnInfo = document.getElementsByClassName('btn-info');
    
    searchValores();

    $('#buscar').keyup(()=>{
        searchValores();
      });

    $('#edit').click(()=>{
      multasEdit();
    })
});

  function searchValores() {
    let registros = $('#frm-buscar').serialize();
    $.ajax({
      type: 'POST',
      url: '../ajax/recodDrawMultas.php',
      data: registros,
      beforeSend: function (objeto) {
        $("#content-valor").html("Buscando...");
      },
      success: function (data) {
        $('#content-valor').html(data);
      },
    });
    return false;
  }


  function multasEdit() {
    event.preventDefault();
    let registros = $('#frm_EditValores').serialize();
    console.log(registros);
    // return;
    $.ajax({
      type: 'POST',
      url: '../ajax/recordSaveMultasRecargos.php',
      data: registros,
      beforeSend: function (objeto) {
        $('#mensajes').html(`
        <div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-warning"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Espere!</strong> Modificando ...</a>.
        </div>
    `);
      },
      success: function (data) {
        let datos = JSON.parse(data);
  
        if (datos.codigo == '200') {
          window.location="./frontEditmultasRecargos.php";
          $('#mensajes').html(`
            <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Correcto!!! </strong><a href="#" class="alert-link">${datos.codigo}</a>.
            </div>
            `);
            // showDias();
        } else if(datos.codigo == '203'){
          $('#mensajes').html(`
        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Tenemos un problema!</strong> ${datos.mensaje} <a href="#" class="alert-link">${datos.codigo}</a> reintente el guardar.
        </div>
    `); 
        } 
      },
    });
    return false;
  }