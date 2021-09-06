$(document).ready(function () {
  
  honorarios();
  valoresFijos();
  multasRecargos();
  selectTipoVnt();
  selectFraccion();
  selectNotarios();
  selectClaves();
  // fnobs_pre();
  
  $('#imp_hons').change(()=>{
    honorarios();
  });
  $('#tipop').change(()=>{
    calcHonorarios();
    selectImpDivis();
  });
  $('#area').change(()=>{
    selectTipoFracc();
  });
  $('#v_fisc').change(()=>{
    valoresBase();
    multasRecargos();
  });
  $('#v_operac').change(()=>{
    valoresBase();
  });
  $('#v_peric').change(()=>{
    valoresBase();
    calcHonorarios();
    honorarios();
  });
  $('#f_escr').change(()=>{
    diasLaborales();
    multasRecargos();
  });
  $('#f_act').change(()=>{
    diasLaborales();
    multasRecargos();
  });

  $('#tipo_uma').change(()=>{
    valoresBase();
    diasLaborales();
    selectTipoFracc();
    multasRecargos();
  });
  
  $('#frmTraslados').change(()=>{
    totalTraslado();
    // multasRecargos();
  });

  $('#calcular').click(()=>{
    multasRecargos();
    totalTraslado();
  });

  $('#frmTraslados').submit(()=>{
    trasladoSave();
  });

  $('#save').submit(()=>{
    trasladoSave();
  });


});

  
  const numberFormat = new Intl.NumberFormat('es-MX')
  const tipop = document.querySelector('#tipop');
  const dias = document.querySelector('#dias_tr');
  const v_fisc = document.querySelector('#v_fisc');
  const v_operac = document.querySelector('#v_operac');
  const v_peric = document.querySelector('#v_peric');

  const b_imp_td = document.querySelector('#b_imp_td');
  const imp_td = document.querySelector('#imp_td');
  const imp_r_uma = document.querySelector('#imp_r_uma');
  const area = document.querySelector('#area');
  const rangoDias = document.querySelector('#rangoDias');
  const imp_multa = document.querySelector('#imp_multa');
  const imp_recar = document.querySelector('#imp_recar');
  const form_atd = document.querySelector('#form_atd');
  const imp_cert_na = document.querySelector('#imp_cert_na');
  const prc_recargo = document.querySelector('#prc_recargo');
  const imp_hons = document.querySelector('#imp_hons');
  const honorarios_recibo = document.querySelector('#honorarios_recibo');

  const tipovnt_select = document.querySelector('#tipovnt_select');
  const tipovnt = document.querySelector('#tipovnt');
  const impue_div = document.querySelector('#impue_div');

  const imp_fracc_select = document.querySelector('#imp_fracc_select');
  const imp_fracc = document.querySelector('#imp_fracc');
  const impue_fracc = document.querySelector('#impue_fracc');
    
  const strongTotal = document.querySelector('#strongTotal');
  const totalH4 = document.querySelector('#totalH4');
  const imp_total = document.querySelector('#imp_total');
  const obs_pre = document.querySelector('#obs_pre');
  const nota = document.querySelector('#nota');
  const num_escr = document.querySelector('#num_escr');
  

  $("#print").on('click', function () {
		window.open(`../print/printTraslado.php?nota=${nota.value}&num_escr=${num_escr.value}` , "Imprimir_Traslado" , "width=500,height=600,scrollbars=YES")
	})

function honorarios() {
  if (imp_hons.value <= 0 || imp_hons.value == '') {
    honorarios_recibo.required = true;
    $("#honorarios_recibo").show();
  } else {
    honorarios_recibo.required = false;
    $("#honorarios_recibo").hide();
  }
}


function valoresFijos() {
  let registros = $('#frmTraslados').serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/recodFijos.php',
    data: registros,
    beforeSend: function (objeto) {},
    success: function (data) {
      let datos = JSON.parse(data);
      form_atd.value = datos.formato;
      imp_cert_na.value = datos.noAdeudo;
      tipovnt.readOnly = true;
      impue_div.readOnly = true;
      imp_fracc.readOnly = true;
      impue_fracc.readOnly = true;
    },
  });
  return false;
}


function selectNotarios() {
  let registros = 1;
  $.ajax({
    type: 'POST',
    url: '../ajax/recordNotarios.php',
    data: registros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $('#notari').html(data);
    },
  });
  return false;
}

function selectClaves() {
  let registros = 1;
  $.ajax({
    type: 'POST',
    url: '../ajax/recordClaves.php',
    data: registros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $('#tipoMovn').html(data);
    },
  });
  return false;
}

function selectImpDivis() {
  let registros = $('#frmTraslados').serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/recodImpuestoDiv.php',
    data: registros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $('#tipovnt_select').html(data);
    },
  });
  return false;
}


function selectTipoVnt() {
  $('#tipovnt_select').change(()=>{
    // alert(tipovnt_select.value)
    $pericial = v_peric.value.replace(',', '');
    $operacion = v_operac.value.replace(',', '');
    tipovnt.value = (tipovnt_select.value);
    impue_div.value = numberFormat.format(Math.max($pericial, $operacion) * tipovnt_select.value);
    tipovnt.readOnly = true;
    impue_div.readOnly = true;
  })
}

function fnobs_pre() {
  $('#obs_pre').click(()=>{
    obs_pre.value = '';
  })
}



function selectTipoFracc() {
  let registros = $('#frmTraslados').serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/recodTipoFraccion.php',
    data: registros,
    beforeSend: function (objeto) {},
    success: function (data) {
      $('#imp_fracc_select').html(data);
    },
  });
  return false;
}

function selectFraccion() {
  $('#imp_fracc_select').change(()=>{
    imp_fracc.value = (imp_fracc_select.value);
    impue_fracc.value = Math.round10((area.value * imp_fracc_select.value), -1);
    imp_fracc.readOnly = true;
    impue_fracc.readOnly = true;
  })
}


function diasLaborales() {
  let registros = $('#frmTraslados').serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/recordDias.php',
    data: registros,
    beforeSend: function (objeto) {
      // $('#div_dias_tr').html('Enviando...');
      dias.value = ''
    },
    success: function (data) {
      // console.log(data);
      dias.value = data
    },
  });
  return false;
  //event.preventDefault()  
}

function calcHonorarios() {
  let registros = $('#frmTraslados').serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/recordHonorarios.php',
    data: registros,
    beforeSend: function (objeto) {},
    success: function (data) {
      let datos = JSON.parse(data);
      imp_hons.value = datos.honorarios;
      honorarios_recibo.required = false;
      $("#honorarios_recibo").hide();
    },
  });
  return false;
  //event.preventDefault()  
}


function valoresBase() {
  let registros = $('#frmTraslados').serialize();
  // console.log(registros);
  $.ajax({
    type: 'POST',
    url: '../ajax/recordValoresBase.php',
    data: registros,
    beforeSend: function (objeto) {
      $('#alert').html(`
      <div class="alert round bg-info alert-dismissible mb-2" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
          <strong>Validando!</strong> Multas y recargos, espere....
      </div>
  `);
    },
    success: function (data) {
      let datos = JSON.parse(data);
      b_imp_td.value = numberFormat.format(datos.valorBase);
      imp_td.value = numberFormat.format(datos.impuestoTD);
      imp_r_uma.value = datos.uma;
    },
  });
  return false;
  //event.preventDefault()  
}

function multasRecargos() {
  let registros = $('#frmTraslados').serialize();
  $.ajax({
    type: 'POST',
    url: '../ajax/recordMultasRecargos.php',
    data: registros,
    beforeSend: function (objeto) {},
    success: function (data) {
      let datos = JSON.parse(data);
      rangoDias.value = datos.rango;
      prc_recargo.value = datos.prcRecargo;
      imp_multa.value = numberFormat.format(datos.multa);
      // imp_recar.value = numberFormat.format(datos.prcRecargo*imp_td.value);
      imp_recar.value = numberFormat.format(Number.parseFloat((datos.prcRecargo*imp_td.value.replace(',', ''))).toFixed(2));
      rangoDias.readOnly = true;
      imp_multa.readOnly = true;
      imp_recar.readOnly = true;
      prc_recargo.readOnly = true;
      $("#prc_recargo").hide();
    },
  });
  return false;
  //event.preventDefault()  
}


function totalTraslado() {
  $imp_td = parseFloat(imp_td.value.replace(',', ''));
  $imp_hons = parseFloat(imp_hons.value .replace(',', ''));
  $impue_div = parseFloat(impue_div.value .replace(',', ''));
  $impue_fracc = parseFloat(impue_fracc.value .replace(',', ''));
  $imp_multa = parseFloat(imp_multa.value .replace(',', ''));
  $imp_recar = parseFloat(imp_recar.value .replace(',', ''));
  $form_atd = parseFloat(form_atd.value .replace(',', ''));
  $imp_cert_na = parseFloat(imp_cert_na.value .replace(',', ''));

  let suma = ($imp_td + $imp_hons + $impue_div + $impue_fracc + $imp_multa + $imp_recar + $form_atd + $imp_cert_na);
  let total = numberFormat.format(suma);

  $('#strongTotal').html(` ${total}`);
  $('#totalH4').html(`Total a pagar $ ${total}`);
  imp_total.value = total;

}


function trasladoSave() {
  event.preventDefault();
  let registros = $('#frmTraslados').serialize();
  // console.log(registros);
  // return;
  $.ajax({
    type: 'POST',
    url: '../ajax/recordModTraslado.php',
    data: registros,
    beforeSend: function (objeto) {
      $('#mensajes').html(`
      <div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
          <span class="alert-icon"><i class="la la-warning"></i></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
          <strong>Espere!</strong> guardando traslado <a href="#" class="alert-link">solo un momento</a>.
      </div>
  `);
    },
    success: function (data) {
      let datos = JSON.parse(data);
      rangoDias.value = datos.rango;
      // console.log(datos.id, datos.respuesta);
      $("#default").modal('hide');

      if (datos.respuesta == 'modificado' || datos.respuesta == 'agregado') {
        $('#mensajes').html(`
      <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
          <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
          <strong>Correcto!</strong> El traslado <strong><h4> Nota ${datos.id}</h4></strong> ha sido ${datos.respuesta}, <a href="#" class="alert-link">gracias por la espera</a>.
      </div>
  `);        
      } else if(datos.respuesta == 'fallo'){
        $('#mensajes').html(`
      <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
          <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
          <strong>Tenemos un problema!</strong> no se modifico la nota <a href="#" class="alert-link">${datos.id}</a> reintente el guardar.
      </div>
  `); 
      } 
    },
  });
  return false;
}


// Conclusión
(function() {
  /**
   * Ajuste decimal de un número.
   *
   * @param {String}  tipo  El tipo de ajuste.
   * @param {Number}  valor El numero.
   * @param {Integer} exp   El exponente (el logaritmo 10 del ajuste base).
   * @returns {Number} El valor ajustado.
   */
  function decimalAdjust(type, value, exp) {
    // Si el exp no está definido o es cero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Si el valor no es un número o el exp no es un entero...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }
})();