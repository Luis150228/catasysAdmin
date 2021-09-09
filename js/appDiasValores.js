$(document).ready(function () {
    const btnInfo = document.getElementsByClassName('btn-info');

    showDias();
    $('#frm_dias').submit(()=>{
        diasSave();
      });
    $('#buscar').keyup(()=>{
        searchDias();
      });

    $('#delete').click(()=>{
        diasDelete();
    })

    $('#edit').click(()=>{
        diasEdit();
    })
});

const descripcion = document.querySelector('#descripcion');
const f_ini = document.querySelector('#f_ini');
const f_fin = document.querySelector('#f_fin');

function diasSave() {
    event.preventDefault();
    let registros = $('#frm_dias').serialize();
    // console.log(registros);
    // return;
    $.ajax({
      type: 'POST',
      url: '../ajax/recordSaveDiaH.php',
      data: registros,
      beforeSend: function (objeto) {
        $('#mensajes').html(`
        <div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-warning"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Espere!</strong> guardando ...</a>.
        </div>
    `);
      },
      success: function (data) {
        let datos = JSON.parse(data);
  
        if (datos.codigo == '200' || datos.id >= '1') {
          $('#mensajes').html(`
            <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Correcto!</strong> ${datos.mensaje}.
            </div>
            `);
            descripcion.value = '';
            f_ini.value = '';
            f_fin.value = '';
            showDias();
        } else if(datos.respuesta == 'fallo'){
          $('#mensajes').html(`
        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Tenemos un problema!</strong> no se agrego la fecha <a href="#" class="alert-link">${datos.id}</a> reintente el guardar.
        </div>
    `); 
        } 
      },
    });
    return false;
  }

  function showDias() {
    let registros = $('#frm_dias').serialize();
    $.ajax({
      type: 'POST',
      url: '../ajax/recodDrawDiaInhabil.php',
      data: registros,
      beforeSend: function (objeto) {
        $("#content-dia").html("Buscando...");
      },
      success: function (data) {
        $('#content-dia').html(data);
      },
    });
    return false;
  }
  
  function searchDias() {
    let registros = $('#frm-buscar').serialize();
    $.ajax({
      type: 'POST',
      url: '../ajax/recodDrawDiaInhabil.php',
      data: registros,
      beforeSend: function (objeto) {},
      success: function (data) {
        $('#content-dia').html(data);
      },
    });
    return false;
  }

//   btnInfo.addEventListener('click', (e)=>{
//     console.log(e.target);
//   })
function diasDelete() {
    event.preventDefault();
    let registros = $('#frm_Editdias').serialize();
    // console.log(registros);
    // return;
    $.ajax({
      type: 'POST',
      url: '../ajax/recodDeleteDiaInhabil.php',
      data: registros,
      beforeSend: function (objeto) {
        $('#mensajes').html(`
        <div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-warning"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Espere!</strong> Borrando ...</a>.
        </div>
    `);
      },
      success: function (data) {
        let datos = JSON.parse(data);
  
        if (datos.mensaje == 'Se elimino con exito' || datos.id >= '1') {
          $('#mensajes').html(`
            <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Correcto!</strong> ${datos.mensaje}.
            </div>
            `);
            // showDias();
            window.location="./frontEditDias.php";
        } else if(datos.respuesta == 'fallo'){
          $('#mensajes').html(`
        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Tenemos un problema!</strong> no se agrego la fecha <a href="#" class="alert-link">${datos.id}</a> reintente el guardar.
        </div>
    `); 
        } 
      },
    });
    return false;
  }

  function diasEdit() {
    event.preventDefault();
    let registros = $('#frm_Editdias').serialize();
    // console.log(registros);
    // return;
    $.ajax({
      type: 'POST',
      url: '../ajax/recordSaveDiaH.php',
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
  
        if (datos.mensaje == 'Se modifico con exito' || datos.id >= '1') {
          $('#mensajes').html(`
            <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Correcto!</strong>.
            </div>
            `);
            // showDias();
            window.location="./frontEditDias.php";
        } else if(datos.respuesta == 'fallo'){
          $('#mensajes').html(`
        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Tenemos un problema!</strong> no se agrego la fecha <a href="#" class="alert-link">${datos.id}</a> reintente el guardar.
        </div>
    `); 
        } 
      },
    });
    return false;
  }