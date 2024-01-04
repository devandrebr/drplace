function resetaCombo( el, msg ){
  $("select[name='"+el+"']").empty();
  var option = document.createElement('option');
  $( option ).attr( {value : ''} );
  $( option ).append( msg );
  $("select[name='"+el+"']").append( option );
}

function formatReal( int ){
  var tmp = int+'';
  tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
  if( tmp.length > 6 )
    tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

  return tmp;
}

function conversor(str) {
    if (typeof str == 'number') return str;
    var nr;
    var virgulaSeparaDecimais = str.match(/(,)\d{2}$/);
    if (virgulaSeparaDecimais)
      nr = str.replace('.', '').replace(',', '.')
    else
      nr = str.replace(',', '');

    return parseFloat(nr);
}

function valorEconomia(valor){
  var qtd_str = parseInt(valor.length);
  var valor_calc = conversor(valor);
  if( qtd_str > 10 )
    var valor_update = ((valor_calc * 6) / 100)+'00000';
  else
    var valor_update = ((valor_calc * 6) / 100)+'00';

  var valor_economia = formatReal(valor_update);
  console.log(valor_calc,qtd_str,valor_economia,valor_update);

  $('#valor-economia').html('R$ '+valor_economia);
}

$(document).ready(function(){
  $('.afocus').focus();

  if( $('.form-bv').length > 0 ){
    $('.form-bv').bootstrapValidator({
      live: 'disabled'
    });
  }

  // Custom dropdowns
  $('.select-text-1').select2({
    allowClear: true,
    language : 'pt-BR',
    placeholder: 'Escolha uma opção'
  });

  $(window).bind('scroll', function () {
    var sticky = $('.form-pesquisa'),
    scroll = $(window).scrollTop();

    var windowWidth = $(window).width();
    if(windowWidth > 500) {
      if (scroll >= 280) {
        sticky.addClass('form-fixed');
      } else {
        sticky.removeClass('form-fixed');
      }
    }
  });

  $('a[href="#full-page-search"]').on('click', function(event) {
    event.preventDefault();
    $('#full-page-search').addClass('open');
    $('#full-page-search > form > input[id="inp_pesq_string"]').focus();
  });

  $('#full-page-search, #full-page-search button.close').on('click keyup', function(event) {
    if (event.target === this || event.target.className === 'close' || event.keyCode === 27) {
      $(this).removeClass('open');
    }
  });

  $('#full-page-search, #full-page-search button.close').on('click keyup', function(event) {
    if (event.target === this || event.target.className === 'close' || event.keyCode === 27) {
      $(this).removeClass('open');
    }
  });

  $('#full-page-search form').submit(function(event) {
    event.preventDefault();
    alert('Envio do form');
    return false;
  });

  $('.m_cep').mask('00000-000');
  $('.m_data').mask('00/00/0000');
  $('.m_money').mask('###.###.###.#00,00', {reverse: true});
  var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };
  jQuery('.m_telefone').mask(SPMaskBehavior, spOptions);

  var options =  {
    reverse: true,
    onKeyPress: function(valor, event, currentField, options){
      valorEconomia(valor);
    }
  };

  $('.inp_calculo').mask('###.###.###.#00,00', options);

  $("#opt_estado").change(function(){
    var uf = $(this).val();
    if(uf === '')
      return false;

    beforeSend:$("#box-loading-1").show();
    resetaCombo('opt_cidade','Selecione uma cidade');
    $.getJSON(_base_url+'ajax/get-cidade/'+uf+'/', function(data){
      var option = new Array();

      $('#opt_cidade').select2('destroy');
      $.each(data, function(i,obj){
        var id = obj.cid_id;
        var nome = obj.cid_nome;

        option[i] = document.createElement('option');
        $(option[i]).attr({value:id});
        $(option[i]).append(nome);
        $('#opt_cidade').append(option[i]);
      });
      complete:$("#box-loading-1").hide();
      $('#opt_cidade').select2();
    });
  });

  $("#btn-favorito").on('click', function(){
    var id_favorito = $('#btn-favorito').data('id');
    var id_imo = $('#btn-favorito').data('idimovel');
    if(id_imo === '')
      return false;
      //fas fa-hand-holding-heart

    var url = _base_url+'ajax/imovel-favorito/'+parseInt(id_imo)+'/'+parseInt(id_favorito);

    // beforeSend:$("#box-loading-1").show();
    $.getJSON(url, function(data){
      var status = data.status;
      var msg = data.msg;
      // console.log(status,msg);

      alert("Status: "+status+"\nMensagem: "+msg);
      if( status == 'logar' )
        window.location.href=""+data.url+"";
      else
        window.location.reload(true);
    });
  });

});
