function actionReserva_pacote(i)
{
  var indentificador = "#formReserva_" + i;
  var rplc = "_" + i;
  var param = "";

  $(indentificador).find("input,select").each(function(i) {

    if (jQuery(this).val() == "")
    {
      return false;
    }
    else
    {
      var nm = jQuery(this).attr("name");
      var nome = nm.replace(rplc, "");
      var _this = "#" + nm;
      var valor = jQuery(_this).val();
      param += nome + "=" + valor + "&";
    }

  });

  jQuery(".image-loading").show();

  $.ajax({
    type: 'post',
    data: param,
    url: '../server/valida_hospedagem.php',
    success: function(retorno) {

      jQuery(".image-loading").hide();
      jQuery(".dtaCalendarioSubmit").attr("onclick", "javascript:renderizeDados_pacote(" + i + ")");

      $(".ui-accordion").removeClass("ui-accordion");
      $(".ui-widget").removeClass("ui-widget");
      $(".ui-helper-reset").removeClass("ui-helper-reset");
      $(".tab-header").remove();
      $(".pint_titulo.Acomodacoes").remove();
      $(".pacotes_container").css('margin', '0');
      renderizeDados_pacote(i);
      if (retorno.trim() == "EXISTE_CRIANCA")
      {
        //var active_crianca = ".active-crianca-" + i;
        //jQuery(active_crianca).show();
        //var dtaCalendarioSubmit = ".dtaCalendarioSubmit_" + i;
        //jQuery(dtaCalendarioSubmit).attr("onclick", "javascript:renderizeDados_pacote(" + i + ")");
      }
      else
      {
        //renderizeDados_pacote(i);
      }
    }
  });
}

function actionReserva()
{
  var param = "";
  $("#formReserva").find("input,select").each(function(i) {

    if (jQuery(this).val() == "")
    {
      return false;
    }
    else
    {
      var nome = jQuery(this).attr("name");
      var valor = jQuery(this).val();
      param += nome + "=" + valor + "&";
    }

  });

  jQuery(".image-loading").show();
  //jQuery(".active-crianca").hide();

  $.ajax({
    type: 'post',
    data: param,
    url: '../server/valida_hospedagem.php',
    success: function(retorno) {

      jQuery(".image-loading").hide();
      jQuery(".dtaCalendarioSubmit").attr("onclick", "javascript:renderizeDados()");

      $(".ui-accordion").removeClass("ui-accordion");
      $(".ui-widget").removeClass("ui-widget");
      $(".ui-helper-reset").removeClass("ui-helper-reset");

      //alert(retorno);
      if (retorno.trim() == "EXISTE_CRIANCA")
      {
        //jQuery(".active-crianca").show();
        jQuery(".dtaCalendarioSubmit").attr("onclick", "javascript:renderizeDados()");
      }
      else
      {
        renderizeDados();
      }
    }
  });
}

function renderizeDados()
{
  $("div.visualiza-resultados").html("<div class='preloader_wrap'><span class='preloader page_preloader'></span></div>");
  
  var loader = ($('.preloader').offset().top-300);
  $("body").animate({scrollTop:loader},250);
  $('.Backazul.reserva').removeClass('back_fixed back_absolute');
  $('.Backazul.reserva').css('top', '');
  $('.fix_form').hide();
  var param = "";
  $("#formReserva").find("input,select").each(function(i) {

    if (jQuery(this).val() == "")
    {
      return false;
    }
    else
    {
      var nome = jQuery(this).attr("name");
      var valor = jQuery(this).val();
      param += nome + "=" + valor + "&";
    }

  });

  $.ajax({
    type: 'post',
    data: param,
    url: '../server/valida_hospedagem2.php',
    success: function(retorno) {
      //alert(retorno);  

      $(".ui-accordion").removeClass("ui-accordion");
      $(".ui-widget").removeClass("ui-widget");
      $(".ui-helper-reset").removeClass("ui-helper-reset");


      $("div.visualiza-resultados").html(retorno);
      
      //$('#telefone').mask('(00) 00000-0000');

    },
    error: function(data) {
      $(".formBackazul").addClass("maior");
      $(".msgerro").html(
              //"<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>"
              );
    }
  });

}

function renderizeDados_pacote(i)
{
  var visualiza_resultados = ".visualiza-resultados-" + i;
  var hidden_information = ".hidden-information-" + i;
  console.log('pacote');
  var wrap = $(visualiza_resultados).parents(".pacotes_item");
  var wrap_html = wrap.html();

  $(".pacotes_item").not(wrap).remove();

  $(visualiza_resultados).show();
  $(hidden_information).hide();

  var indentificador = "#formReserva_" + i;
  var rplc = "_" + i;
  var param = "";

  $(indentificador).find("input,select").each(function(i) {

    if (jQuery(this).val() == "")
    {
      return false;
    }
    else
    {
      var nm = jQuery(this).attr("name");
      var nome = nm.replace(rplc, "");
      var _this = "#" + nm;
      var valor = jQuery(_this).val();
      param += nome + "=" + valor + "&";
    }

  });

  $.ajax({
    type: 'post',
    data: param,
    url: '../server/valida_hospedagem2.php',
    success: function(retorno) {
      //alert(retorno);

      $(".ui-accordion").removeClass("ui-accordion");
      $(".ui-widget").removeClass("ui-widget");
      $(".ui-helper-reset").removeClass("ui-helper-reset");

      console.log("renderizeDados_pacote" + i);
      
      $(".visualiza-resultados").html(retorno);
      
      if( !$('.visualiza-resultados').hasClass('col-xs-8')){
        $('.visualiza-resultados').css('padding', '0 30px 0 35px');
        $('.visualiza-resultados').addClass('col-xs-8');
      }
      
     // $('#telefone').mask('(00) 00000-0000');

    },
    error: function(data) {
      $(".formBackazul").addClass("maior");
      $(".msgerro").html(
              //"<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><strong>Warning!</strong> Better check yourself, you're not looking too good.</div>"
              );
    } 
  });


}

$(document).ready(function() {
  $("#crianca.select").change(function() {
    var val = $(this).val();
    (val == 1) ? $(".active-crianca").fadeIn(250) : $(".active-crianca").fadeOut(250);
  });
  $('.criancas_select').change(function() {
    if ($(this).val() == '1') {
      $(this).parents('form').find('.criancas_more').fadeIn(250);
    } else {
      $(this).parents('form').find('.criancas_more').fadeOut(250);
    }
  });
});