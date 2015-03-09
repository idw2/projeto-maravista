function resizando() {
    var win = $('.divFrameEvent').width();
    var win2 = Math.round(win/2);
    $('.divFrameEvent').css('height', hei);
    $('.banner-home').rcarousel({width: wind});
}

$(window).resize(function() {
    wid = $(window).width();
    var win = $('.divFrameEvent').width();
    var win2 = Math.round(win/2);
    wind = $('body').width();
    $('.banner-home').rcarousel({width: wid});
    if(wind < 1179){
        $('.banner-home .Imagem').css('width', wind);
        $('#eventos_iframe').contents().find('#eventos_carousel, .eventos_item').css('width', win);
        $('#eventos_iframe').contents().find('#eventos_carousel, .eventos_item').css('height', 307);
    }else{
        $('.banner-home .Imagem').css('width', wind);
        $('#eventos_iframe').contents().find('#eventos_carousel, .eventos_item').css('width', win);
        $('#eventos_iframe').contents().find('#eventos_carousel, .eventos_item').css('height', 377);
    }
});

$('#eventos_iframe').ready(function() {
    $(window).resize(); 
});

$(document).ready(function() {
    $('#eventos_iframe').contents().find.('.eventos_item_inner h3 p').text(function(index, text) {
                    return text.substr(0, 175)+' ...';
                  });
    var win = $('.divFrameEvent').width();
    var win2 = Math.round(win/2);
    wind = $('body').width();
    if(wind < 1179){
        $()}$('.n_pessoas').fancySelect();
    $('.EntradaText select').fancySelect();
    $('#forma_pgto').fancySelect();
    var win = $('.divFrameEvent').width();
    var hei = Math.round(win/2);
    $('.divFrameEvent').css('height', hei);
    var url = window.location.href;
				$('.LinksMenu a[href="'+url+'"]').addClass('pag_active');
				$('.LinksMenu a').filter(function() {
					return this.href == url;
				}).addClass('pag_active');
    if(wind > 1550){
        var bannerH = (wind*0.348);
                   }
				$('.dtaCalendario').datepicker({
					dateFormat: 'dd/mm/yy',
					dayNames: [
					'Domingo',
					'Segunda',
					'Terça',
					'Quarta',
					'Quinta',
					'Sexta',
					'Sábado',
					'Domingo'],
					dayNamesMin: [
					'D',
					'S',
					'T',
					'Q',
					'Q',
					'S',
					'S',
					'D'],
					dayNamesShort: [
					'Dom',
					'Seg',
					'Ter',
					'Qua',
					'Qui',
					'Sex',
					'Sáb',
					'Dom'],
					monthNames: [
					'Janeiro',
					'Fevereiro',
					'Mar&ccedil;o',
					'Abril',
					'Maio',
					'Junho',
					'Julho',
					'Agosto',
					'Setembro',
					'Outubro',
					'Novembro',
					'Dezembro'],
					monthNamesShort: [
					'Jan',
					'Fev',
					'Mar',
					'Abr',
					'Mai',
					'Jun',
					'Jul',
					'Ago',
					'Set',
					'Out',
					'Nov',
					'Dez'],
					nextText: 'Pr&oacute;ximo',
					prevText: 'Anterior',
					minDate: 0,
					maxDate: '+365D',onSelect: function(date) {
							
							var name = jQuery(this).prop('name');
							var start = date.split('/');
							var str = start[2] + '-' + start[1] + '-' + start[0];
							
							(name == 'datainicio')?setDiffdtainicio(str):setDiffdtafim(str);
							date_diff();
							
						 },numberOfMonths: 1
					
				});
				
				function setDiffdtainicio(dataUSA)
				{
					$("input[name='diffDtainicio']").val(dataUSA);
				}
				
				function setDiffdtafim(dataUSA)
				{
					$("input[name='diffDtafim']").val(dataUSA);
				}
				
				
				//openAdultosecriancas(2, 'Adultos', 'Criança até 5 anos', 'de 6 a 12 anos', 'acima de 12 anos');
				
				$('#nQuartos').change(function(){
					if((parseInt(jQuery('#nQuartos').val()) == 0) || ($('#pessoas').val() == 0) || (parseInt(jQuery('#nQuartos').val()) > parseInt(jQuery('#pessoas').val())) ){ 
                               $('#nQuartos').val($('#pessoas').val());
                              }
				});
				
				function date_diff()
				{
					var start = Date.parse($("input[name='diffDtainicio']").val());
                              var startVal = $("input[name='diffDtainicio']").val();
					var end = Date.parse($("input[name='diffDtafim']").val());
					var days = (end - start)/1000/60/60/24;
                              
                              startVal = startVal.replace('-','/');
                              startVal = startVal.replace('-','/');
                              
                              var startValF = new Date(startVal); 
                              startValF.setDate(startValF.getDate() + 1);
					if( parseInt(days) > 0 )
					{
                                
						if((parseInt(jQuery('#nQuartos').val()) == 0) || ($('#pessoas').val() == 0) || (parseInt(jQuery('#nQuartos').val()) > parseInt(jQuery('#pessoas').val())) ){ 
                                    //if(parseInt(jQuery('#nQuartos').val()) == 0){ 
                                    //$('.btnCliqueAqui').hide();
                                    
                                    $('#nQuartos').val('0');
                                    }
                                    else { 
                                    //$('.btnCliqueAqui').show();
                                    }
                                    
					}
					else
					{
						//alert('As datas não são válidas para reserva!');
                                    //$('.ui-state-active').removeClass('.ui-state-active');
                                    $("input[name='datafim']").datepicker('setDate', startValF);
                                    $("input[name='datafim']").attr('value', startVal);
                                    //$("input[name='diffDtafim']").val(startVal);
                                    $("input[name='diffDtafim']").datepicker('setDate', startValF);
                                    $("input[name='diffDtafim']").val(startValF);
                                    
						//dialogDefault('As datas não são válidas para reserva!');
						//$('.btnCliqueAqui').hide();
						document.getElementById('nQuartos').selectedIndex = 0;
					}
					
				}
				
				jQuery(function($) {$('.banner-home').rcarousel({auto: {enabled:true}, step:1, visible:1, width: wid, height: 540, startAtPage:2  });});
					
					jQuery('.loadGallery').each(function(i){
					
						var rpc = this.id.replace('_','');
						var fcybx = '.' + rpc;
						$(fcybx).fancybox({
                                          prevEffect	: 'none',
                                          nextEffect	: 'none',
                                          helpers	: {
                                                title	: {
                                                      type: 'outside'
                                                },
                                                thumbs	: {
                                                      width	: 50,
                                                      height	: 50
                                                }
                                          }
                                    });
                                    
					});
