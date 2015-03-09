<?php


	$html .= "<script type='text/javascript'>";
	
	
			 if( $_GET['actionType'] == "facilidades.servicos.view" || $_GET['actionType'] == "eventos.view" ){
                  /*$html .= "$('.fb_ne').fancybox({
                              prevEffect	: 'none',
                              nextEffect	: 'none',
                              closeBtn	: false,
                              helpers	: {
                                  title	: { type : 'inside' },
                                  buttons	: {},
                                  thumbs	: {
                                    width	: 50,
                                    height	: 50
                                  }
                              }
                            });";*/
							
							$html .= "$('.fb_ne').fancybox();";
                  }
	
	
			$html .= " 
                  (function(){
                  
                    $(document).ready();
                    $(window).resize();
                  })
                  var wind;   
			var wid = $(window).width();
                  
			function dialogDefault(erro){
			
				$('#dialogDefault').dialog({
					title: '".getLabel('LABEL_ATENCAO', $_SESSION['LANGUAGE'])."',
					open: function (event, ui) {
						$('#dialogDefault').html( '<p>' + erro + '</p>' );
					},
					close: function (event, ui) {
						$('#dialogDefault').dialog( 'destroy' );
					}
				});
				$('#dialogDefault').dialog();
				
			}
			
			";
                  
                  $html .= "$(function() {
                            $('#dtainicio').datepicker({
                              numberOfMonths: 2,
                              onSelect: function( selectedDate ) {
                              
                                var date2 = $('#dtainicio').datepicker('getDate');
                                date2.setDate(date2.getDate()+1);
                                $('#dtafim').datepicker( 'option', 'minDate', date2 );
                              },
					dateFormat: 'dd/mm/yy',
					dayNames: [
					'".getLabel('LABEL_DOMINGO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SEGUNDA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_TERCA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_QUARTA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_QUINTA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SEXTA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SABADO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_DOMINGO', $_SESSION['LANGUAGE'])."'],
					dayNamesMin: [
					'".getLabel('LABEL_D1', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D2', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D3', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D4', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D5', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D6', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D7', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D1', $_SESSION['LANGUAGE'])."'],
					dayNamesShort: [
					'".getLabel('LABEL_DOM', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SEG', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_TER', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_QUA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_QUI', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SEX', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SAB', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_DOM', $_SESSION['LANGUAGE'])."'],
					monthNames: [
					'".getLabel('LABEL_JANEIRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_FEVEREIRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_MARCO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_ABRIL', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_MAIO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_JUNHO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_JULHO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_AGOSTO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SETEMBRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_OUTUBRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_NOVEMBRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_DEZEMBRO', $_SESSION['LANGUAGE'])."'],
					monthNamesShort: [
					'".getLabel('LABEL_JAN', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_FEV', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_MAR', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_ABR', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_MAI', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_JUN', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_JUL', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_AGO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SET', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_OUT', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_NOV', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_DEZ', $_SESSION['LANGUAGE'])."'],
					nextText: '".getLabel('LABEL_NEXT', $_SESSION['LANGUAGE'])."',
					prevText: '".getLabel('LABEL_PREVIOUS', $_SESSION['LANGUAGE'])."',
                              minDate: 0,
					maxDate: '+365D'";
					$html .= "});
                                
                          $('#dtafim').datepicker({
                              numberOfMonths: 2,
                              onSelect: function( selectedDate ) {
                                //$( '#dtainicio' ).datepicker( 'option', 'maxDate', selectedDate );
                              },
					dateFormat: 'dd/mm/yy',
					dayNames: [
					'".getLabel('LABEL_DOMINGO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SEGUNDA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_TERCA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_QUARTA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_QUINTA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SEXTA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SABADO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_DOMINGO', $_SESSION['LANGUAGE'])."'],
					dayNamesMin: [
					'".getLabel('LABEL_D1', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D2', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D3', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D4', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D5', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D6', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D7', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_D1', $_SESSION['LANGUAGE'])."'],
					dayNamesShort: [
					'".getLabel('LABEL_DOM', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SEG', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_TER', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_QUA', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_QUI', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SEX', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SAB', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_DOM', $_SESSION['LANGUAGE'])."'],
					monthNames: [
					'".getLabel('LABEL_JANEIRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_FEVEREIRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_MARCO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_ABRIL', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_MAIO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_JUNHO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_JULHO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_AGOSTO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SETEMBRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_OUTUBRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_NOVEMBRO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_DEZEMBRO', $_SESSION['LANGUAGE'])."'],
					monthNamesShort: [
					'".getLabel('LABEL_JAN', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_FEV', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_MAR', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_ABR', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_MAI', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_JUN', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_JUL', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_AGO', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_SET', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_OUT', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_NOV', $_SESSION['LANGUAGE'])."',
					'".getLabel('LABEL_DEZ', $_SESSION['LANGUAGE'])."'],
					nextText: '".getLabel('LABEL_NEXT', $_SESSION['LANGUAGE'])."',
					prevText: '".getLabel('LABEL_PREVIOUS', $_SESSION['LANGUAGE'])."',
                              minDate: '+1d',
					maxDate: '+365D'";
					$html .= "});
				/*
				function setDiffdtainicio(dataUSA)
				{
					$(\"input[name='diffDtainicio']\").val(dataUSA);
				}
				
				function setDiffdtafim(dataUSA)
				{
					$(\"input[name='diffDtafim']\").val(dataUSA);
				}
				*/
				});";
			
                  $html .= "
                          
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
                                    $('#eventos_iframe').contents().find('#eventos_carousel, .eventos_item').css('height', 372);
                                }else{
                                    $('.banner-home .Imagem').css('width', wind);
                                    $('#eventos_iframe').contents().find('#eventos_carousel, .eventos_item').css('width', win);
                                    $('#eventos_iframe').contents().find('#eventos_carousel, .eventos_item').css('height', 377);
                                }
                            });

                            $(document).ready(function() {
                                var win = $('.divFrameEvent').width();
                                var win2 = Math.round(win/2);
                                wind = $('body').width();
                                if(wind < 1179){
                                    $()}$('.n_pessoas').fancySelect();
                                $('.EntradaText select').not('.nofancy').fancySelect();
                                $('#forma_pgto').fancySelect();
                                var win = $('.divFrameEvent').width();
                                var hei = Math.round(win/2);
                                //$('.divFrameEvent').css('height', hei);
                                var url = window.location.href;
                                                    $('.LinksMenu a[href=\"'+url+'\"]').addClass('pag_active');
                                                    $('.LinksMenu a').filter(function() {
                                                          return this.href == url;
                                                    }).addClass('pag_active');
                                if(wind > 1550){
                                    var bannerH = (wind*0.348);
                                }
                                $('.btn_submit').click(function(){
                                  $(this).parent('form').submit();
                                  });
                          ";
			
				                         
				if($_GET['actionType'] != ''
                                /*
                                && $_GET['actionType'] != 'pagina.inicial' 
                                && $_GET['actionType'] != 'reservas.analisa'
                                && $_GET['actionType'] != 'reservas.form.submit'
                                && $_GET['actionType'] != 'reservas.forma.pgto'
                                && $_GET['actionType'] != 'reservas.forma.pgto.deposito'
                                && $_GET['actionType'] != 'reservas.forma.pgto.cielo'
                                && $_GET['actionType'] != 'reservas.error'
                                */
                                && $_GET['actionType'] == 'acomodacoes' 
                                )
				{
					$html .= "
					$(window).scroll(function(){
                                  
						var fotpos = $('.footer_container_out').offset().top-705;
						var divpos = $('.Backazul').offset().top;
                                                   
						var scrollpos = $(window).scrollTop();
                                                if ($('html').height() > 1738){    
						if (scrollpos > 201){
                                                    if (scrollpos <= (fotpos+200)){
							$('.Backazul').addClass('back_fixed'); 
                                                        $('.Backazul').removeClass('back_absolute'); 
							$('.fix_form').show();
                                                        $('.Backazul').css('top', '');
                                                        }
						}
						else
						{
							$('.Backazul').removeClass('back_fixed');
                                                        $('.Backazul').css('top', '');
							$('.fix_form').hide();
						}
                                                
						if (scrollpos > (fotpos+200)){
							$('.Backazul').removeClass('back_fixed');
                                                        $('.Backazul').addClass('back_absolute');
							$('.Backazul').css('top', (fotpos));
							
						}else{ $('.Backazul').removeClass('back_absolute'); }
						
						
						var flutpos = $('.Flutuante').position().top;

						if ((scrollpos > 280)&&(scrollpos < (fotpos-300))){
							$('.Flutuante').css('top',40);
						}
						else
						{
							$('.Flutuante').css('top',((scrollpos/1.5)*-1)+240);
						}

						/*
						if (scrollpos > 201){
							$('.Flutuante').css('top',(scrollpos-220)); }
						else{
							$('.Flutuante').css('top',0);
						}
						*/
                                                }
					});
					
					";
				}
			
					
			/*http://leobalter.net/desenvolvimento/como-desabilitar-datas-no-datepicker-do-jquery-ui/*/
		
			if( $_GET['actionType'] == "" 
			|| $_GET['actionType'] == "dicas"
			|| $_GET['actionType'] == "pagina.inicial"
			|| $_GET['actionType'] == "eventos.view"
                  || $_GET['actionType'] == "acomodacoes"
                  || $_GET['actionType'] == "tarifas.promocoes"
                  || $_GET['actionType'] == "pacotes-e-promocoes"
                  || $_GET['actionType'] == "galeria"
                          
			)
			{
				
				$html .= "
				//openAdultosecriancas(2, '".getLabel('LABEL_ADULTOS', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_5ANOS', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_6A12', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_ACIMA12', $_SESSION['LANGUAGE'])."');
				
				$('#nQuartos').change(function(){
					if((parseInt(jQuery('#nQuartos').val()) == 0) || ($('#pessoas').val() == 0) || (parseInt(jQuery('#nQuartos').val()) > parseInt(jQuery('#pessoas').val())) ){ 
                               $('#nQuartos').val($('#pessoas').val());
                              }
				});
				
				function date_diff()
				{
					var start = Date.parse($(\"input[name='diffDtainicio']\").val());
                              var startVal = $(\"input[name='diffDtainicio']\").val();
					var end = Date.parse($(\"input[name='diffDtafim']\").val());
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
						//alert('".getLabel('LABEL_DTA_IGUAIS', $_SESSION['LANGUAGE'])."!');
                                    //$('.ui-state-active').removeClass('.ui-state-active');
                                    $(\"input[name='datafim']\").datepicker('setDate', startValF);
                                    $(\"input[name='datafim']\").attr('value', startVal);
                                    //$(\"input[name='diffDtafim']\").val(startVal);
                                    $(\"input[name='diffDtafim']\").datepicker('setDate', startValF);
                                    $(\"input[name='diffDtafim']\").val(startValF);
                                    
						//dialogDefault('".getLabel('LABEL_DTA_IGUAIS', $_SESSION['LANGUAGE'])."!');
						//$('.btnCliqueAqui').hide();
						document.getElementById('nQuartos').selectedIndex = 0;
					}
					
				}
				
				";
				
				
				$html .= "jQuery(function($) {";
				$html .= "$('.banner-home').rcarousel({auto: {enabled:true}, step:1, visible:1, width: wid, height: 540  });";
				$html .= "});";	
				
				$html .= "
					
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
				
				";	
                        
                        if($_GET['actionType'] == "acomodacoes") {
				$html .= "
					$('.acord_container').accordion({ 
						header: '.acord_title',
						content: '.acord_cont',
						collapsible: true,
						active: false,
						heightStyle: 'content'
					});";
                        }
			}
			elseif
			( $_GET['actionType'] == "quartos" 
			|| $_GET['actionType'] == "quartos.resultado"
                  || $_GET['actionType'] == "acomodacoes"
                  )
			{
                   
				$html .= "$(document).ready(function() {
                              
					$('.acord_container').accordion({ 
						header: '.acord_title',
						content: '.acord_cont',
						collapsible: true,
						active: false,
						heightStyle: 'content'
					});
                          });
				
				//jQuery(document).ready(function($){
					var url = window.location.href;
					$('.LinksMenu a[href=\"'+url+'\"]').addClass('pag_active');
					$('.LinksMenu a').filter(function() {
						return this.href == url;
					}).addClass('pag_active');
				//});
				
				$('.fancyboxForm').fancybox();
					
				$('.loadGallery').each(function(i){
					
					var rpc = this.id.replace('_','');
					var fcybx = '.' + rpc;
					$(fcybx).fancybox({
                                prevEffect	: 'none',
                              nextEffect	: 'none',
                              closeBtn	: false,
                              helpers	: {
                                  title	: { type : 'inside' },
                                  buttons	: {},
                                  thumbs	: {
                                    width	: 50,
                                    height	: 50
                                  }
                              }
                              });
					
				});
				
				
				";
			
			}
			elseif( $_GET['actionType'] == "reservas.forma.pgto" )
			{
				/*$html .= "
					/*
					$('#forma_pgto').change(function(){
						if(jQuery(this).val() == '')
						{
							$('.continuacao').hide();
							(jQuery(this).val() == '1') ? $('.Texto50').css('display','block') : $('.Texto50').css('display','none');
						}
						else
						{
							$('.continuacao').show();
							(jQuery(this).val() == '1') ? $('.Texto50').css('display','block') : $('.Texto50').css('display','none');
						}
						
					});
					* /
					$('.btnCliqueAqui').click(function(){
						$('#formReserva').submit();	
					});
					
				";*/
			}
			elseif( $_GET['actionType'] == "reservas.form.submit" )
			{
				$html .= "
					
					$('.dd-selected-value').each(function(i){
						var byname = 'select_quarto_tipo_'+i;
						jQuery(this).attr('name', byname);
					});
					
					$('.n_pessoas').each(function(i){
						jQuery(this).change(function(){
							var retorno = chequePessoas();
						});						
					});
					
					function chequePessoas()
					{
						var adultos = parseInt($('#Prepara_pessoas').val());
						var somaOcupantes = 0;
						
						$('.n_pessoas').each(function(i){
							somaOcupantes += parseInt(jQuery(this).val());
						});
						
						if( somaOcupantes != adultos )
						{
							$('#dialog').dialog({
								title: '".getLabel('LABEL_ATENCAO', $_SESSION['LANGUAGE'])."',
								open: function (event, ui) {
									$('#dialog').html( '<p>".getLabel('LABEL_BOOKING', $_SESSION['LANGUAGE'])." '+ adultos +' ".getLabel('LABEL_PERSON', $_SESSION['LANGUAGE']).".</p><p>".getLabel('LABEL_DIFF_SOLICITACAO', $_SESSION['LANGUAGE'])."</p>' );
								},
								close: function (event, ui) {
									$('#dialog').dialog( 'destroy' );
								}
							});
							
							$('.continuacao').hide();
							
							return false;
						}
						else
						{	
							var count = 0;
							$('.dd-selected-value').each(function(i){
								if( jQuery(this).val() == '')
								{
									count++;	
								}								
							});
							
							var pessoas = parseInt($('#Prepara_pessoas').val());
							var somaOcupantes = 0;
							
							$('.n_pessoas').each(function(i){
								somaOcupantes += parseInt(jQuery(this).val());
							});
							
							( somaOcupantes != pessoas )? chck = false : chck = true;
							
							if(count==0 && chck)
							{
								$('.continuacao').show();
							}
							else
							{
								$('.continuacao').hide();
							}
							return true;			
						}
					
					}
					
				";
				
			}
			elseif( $_GET['actionType'] == "reservas.analisa" )
			{
				$html .= "
                              $(document).ready(function(){
                                $('#formReserva').validate({
                                  rules: {
                                    email: {
                                        required: true,
                                        email: true
                                    },
                                    nome_empresa: {required:true, minlength: 3},
                                    telefone: 'required',
                                    termos: 'required',";
                                    for($q=1;$q<=4;$q++){
                                      $html .= "screen_pessoa_".$q.": 'required', ";
                                      for($p=0;$p<=9;$p++){
                                        if(($q==4) && ($p==9)){
                                          $html .= "\n quarto_".$q."_text_name_".$p.": { required:true, minlength: 3 }";
                                        }else{
                                          $html .= "\n quarto_".$q."_text_name_".$p.": { required:true, minlength: 3 },";
                                        }
                                      }
                                    }
                                  $html .="},
                                  messages: {
                                    email: '',";
                                    for($q=1;$q<=4;$q++){
                                      for($p=0;$p<=9;$p++){
                                        if(($q==4) && ($p==9)){
                                          $html .= "\n quarto_".$q."_text_name_".$p.": ''";
                                        }else{
                                          $html .= "\n quarto_".$q."_text_name_".$p.": '',";
                                        }
                                      }
                                    }
                                  $html .= "}
                                });

                                $('#formReserva').validate({
                                  rules: {
                                    email: {
                                        required: true,
                                        email: true
                                    },
                                    nome_empresa: 'required',
                                    telefone: 'required',
                                    termos: 'required',";
                                    for($q=1;$q<=4;$q++){
                                      for($p=0;$p<=9;$p++){
                                        if(($q==4) && ($p==9)){
                                          $html .= "\n quarto_".$q."_text_name_".$p.": { required:true, minlength: 3 }";
                                        }else{
                                          $html .= "\n quarto_".$q."_text_name_".$p.": { required:true, minlength: 3 },";
                                        }
                                      }
                                    }
                                  $html .="},
                                  messages: {
                                    email: '',";
                                    for($q=1;$q<=4;$q++){
                                      for($p=0;$p<=9;$p++){
                                        if(($q==4) && ($p==9)){
                                          $html .= "\n quarto_".$q."_text_name_".$p.": ''";
                                        }else{
                                          $html .= "\n quarto_".$q."_text_name_".$p.": '',";
                                        }
                                      }
                                    }
                                  $html .= "}
                                });
                              });
				";
			}
			elseif( $_GET['actionType'] == "" 
			|| $_GET['actionType'] == "acomodacoes" 
			|| $_GET['actionType'] == "pagina.inicial")
			{
			
				$html .= "
				
					//  $('.btnCliqueAqui').hide();
					
					openAdultosecriancas(2, '".getLabel('LABEL_ADULTOS', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_5ANOS', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_6A12', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_ACIMA12', $_SESSION['LANGUAGE'])."');
					
					$('#nQuartos').change(function(){	
                                    
						//date_diff();
					});
					
					function date_diff()
				{
					var start = Date.parse($(\"input[name='diffDtainicio']\").val());
                              var startVal = $(\"input[name='diffDtainicio']\").val();
					var end = Date.parse($(\"input[name='diffDtafim']\").val());
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
						//alert('".getLabel('LABEL_DTA_IGUAIS', $_SESSION['LANGUAGE'])."!');
                                    //$('.ui-state-active').removeClass('.ui-state-active');
                                    $(\"input[name='datafim']\").datepicker('setDate', startValF);
                                    $(\"input[name='datafim']\").attr('value', startVal);
                                    //$(\"input[name='diffDtafim']\").val(startVal);
                                    $(\"input[name='diffDtafim']\").datepicker('setDate', startValF);
                                    $(\"input[name='diffDtafim']\").val(startValF);
                                    
						//dialogDefault('".getLabel('LABEL_DTA_IGUAIS', $_SESSION['LANGUAGE'])."!');
						//$('.btnCliqueAqui').hide();
						document.getElementById('nQuartos').selectedIndex = 0;
					}
					
				}
					
					function addLinhas(number)
					{
						if( parseInt(number) >= 2 )
						{
							var str = '';
							
							for(var i=0; i<parseInt(number); i++)
							{
								str += '<div><span class=\"LabelAcomodacaoTitle\">' + $('.LabelAcomodacaoTitle').html() + '</span><span class=\"LabelAcomodacaoNumber\">' + parseInt( i + 1 ) + '</span></div>';
								str += '<div class=\"EscolhaAcomodacaoContinue\">' + $('.EscolhaAcomodacaoContinue').html() + '</div>';
							}
							
							$('.ContainerAcomodacao').html(str);
							
							var opt = '';
							
							for(i=0; i<parseInt($('#pessoas').val()); i++)
							{
								count = (i+1);
								opt += '<option value=\"'+ count +'\">' + count + '</option>';
							}
							
							$('.InformePessoas').each(function(i){
								var slct = '<select name=\"pessoa_'+i+'\" id=\"pessoa_'+i+'\">' + opt + '</select>';
								this.innerHTML = slct;
							});
							
							$('.InformeAcomodacao select').each(function(i){
								var name = 'acomodacao_'+i;
								$(this).attr('id', name);
								$(this).attr('name', name);
							});
							
							
							
						}
						
					}
					
					$('.fancyboxForm').fancybox();
					
					$('.loadGallery').each(function(i){
						
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
					
					$(document).ready(function() {
						$('.acord_container').accordion({ 
							header: '.acord_title',
							content: '.acord_cont',
							collapsible: true,
							active: false,
							heightStyle: 'content'
						});
					});
					
					
					/*$( '.ReservaDescript' ).click(function(){
				
						var key = this.id.replace('ReservaDescriptId_','');
						var ico = 'ReservaDescript_'+key;
						var div = 'ReservaDescriptShow_'+key;
						var show = '#ReservaDescriptShow_'+key;
						
						if( document.getElementById(div).style.display == 'none')
						{
							guid = show+':hidden';
							$(guid).show('slow');
							document.getElementById(ico).innerHTML = '[-]';
						}
						
						
						$( '.ReservaDescript' ).each(function( i ) {
						
							var key2 = this.id.replace('ReservaDescriptId_','');
							var ico2 = 'ReservaDescript_'+key2;
							var div2 = 'ReservaDescriptShow_'+key2;
							var show2 = '#ReservaDescriptShow_'+key2;
							
							var c1 = document.getElementById(div).id;
							var c2 = document.getElementById(div2).id;
							
							if( c1 != c2 )
							{
								guid = show2+':visible';
								$(guid).slideUp();
								document.getElementById(ico2).innerHTML = '[+]';
							}
						
						});
					
					});*/
					
					$('#pessoas').change(function(){
							
						$('#pessoasFinalize').html(this.value);
						$('#somaPessoas').val(this.value);
						/*	
						$('#adultos').change( function(){
							loadResults();
						});
                                    */
					});
					
					function loadResults()
					{
						
							var ext_value = this.value;
							if( ext_value == 0 || ext_value == null )
							{
								this.value = 2;
							}
							
							$('#adultosFinalize').html(this.value);
							
							var n_pessoas_quartos = ( parseInt( parseInt($('#SomaQuartos').val()) * 2 ) );
							
							var diff = ( parseInt($('#somaAdultos').val(this.value).val()) - n_pessoas_quartos );
							/*
							if(diff > 0)
							{
								var excesso = (parseInt(this.value) - 2);
								$('#adultosExcedentesFinalize').html(excesso);
								$('#somaAdultosExcedentes').val(excesso);
							}
							*/
							adultoExcedente();
							
						$('#criancas_5a').change(
							function(){
								updateQntdCrianca( this.id );
						});
						
						$('#criancas_6a12').change(
							function(){
								updateQntdCrianca( this.id );
						});
						
						$('#criancas_acima12').change(
							function(){
								updateQntdCrianca( this.id );
						});
					}
					
					$('.ReservaAjax').click(
						function(){
						
							var idSelect = this.id;
							
							var keySelect = this.id.replace('ReservaDescriptInput_','');
							var referencia = 'ReservaLoopReferencia_'+keySelect;
							
							$('.ReservaAjaxReferencia').each(function(i){
							
								if( this.id == referencia)
								{
									var ref = '#ReservaLoopReferencia_'+keySelect;
									var refHidden = $(ref).val();
									
									if( refHidden == 'SOMAR')
									{
										$(ref).val('DIMINUIR');
										var n1 = parseInt( $('#SomaQuartos').val() );
										var soma = n1 + 1;
										$('#SomaQuartos').val( soma );
										$('#quartosFinalize').html( soma );
										updateReservas( this.id, '".getLabel('LABEL_FALHA_REQUISICAO', $_SESSION['LANGUAGE'])."');
									}
									else
									{
										$(ref).val('SOMAR');
										var n1 = parseInt( $('#SomaQuartos').val() );
										var soma = n1 - 1;
										$('#SomaQuartos').val( soma );
										$('#quartosFinalize').html( soma );
										updateReservas( this.id, '".getLabel('LABEL_FALHA_REQUISICAO', $_SESSION['LANGUAGE'])."');
									}
									
								}
						
						});	
					
					});
					
					$(document).ready(function() {
						$('.checkbox_quartos').hide();
					});
					
					$(document).ready(function() {
						openAdultosecriancas(2, '".getLabel('LABEL_ADULTOS', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_5ANOS', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_6A12', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_ACIMA12', $_SESSION['LANGUAGE'])."');
						document.getElementById('adultos').selectedIndex = '2';
						$('#pessoasFinalize').html(2);
						$('#somaPessoas').val(2);
						//$('#adultosFinalize').html(2);
						$('#somaAdultos').val(2);
						$('#ReservaTotalliBtn').hide();
						$('#ReservaPreload').hide();
						loadResults();
						esc();
					});
					
					function esc()
					{
						var valor = $('.seladulto').val();
						if(valor != '0')
						{
						   $('.checkbox_quartos').show();
					   }
					}
					
				";
				
				
				
			}elseif( $_GET['actionType'] == "contato" )
			{
                    $html .= "
                            $(document).ready(function(){
                                $('#telefone').mask('(00) 00000-0000');
                                $('#form_contato').validate({
                                  rules: {
                                    email: {
                                        required: true,
                                        email: true
                                    },
                                    nome_empresa: 'required',
                                    telefone: 'required',
                                    assunto: 'required'
                                    }
                                    });
                             });";
                  }if( $_GET['actionType'] == "reservas.analisa" )
			{
                    $html .= "
                            $(document).ready(function(){
                                $('#telefone').mask('(00) 000000000');
                             });";
                  }
                  
                  if($_GET['actionType'] == "tarifas.promocoes"
                    || $_GET['actionType'] == "eventos.view"
                    || $_GET['actionType'] == "pacotes-e-promocoes")
                    {
                    
                    $html .= "$('.acord_container').accordion({ 
						header: '.acord_title',
						content: '.acord_cont',
						collapsible: true,
						active: false,
						heightStyle: 'content'
					});";
                    $html .= "$( '#tabs' ).tabs();";
                    $html .= "$('.pte_pessoas').fancySelect();";
                    /*
                    $html .= "$('.pacotes_btn_desc').click(function(){"
                            . "var desc = $(this).parents('.pacotes_item').children('.pacotes_desc');"
                            . "$('.pacotes_btn_desc').not($(this)).removeClass('active');"
                            . "$(this).toggleClass('active');"
                            . "$('.pacotes_desc').not(desc).removeClass('active');"
                            . "desc.toggleClass('active');"
                            . "});";
                    */
                    $html .= "$('.pacotes_btn_desc').click(function(){"
                            . "var desc = $(this).parents('.pacotes_item');"
                            . "$('.pacotes_item').not(desc).removeClass('active');"
                            . "desc.toggleClass('active');"
                            . "});";
                    
                  }
                  
                  if( $_GET['actionType'] == "facilidades.servicos" )
                  {
                    $html .= "
                      function getParameterByName(name) {
                          name = name.replace(/[\[]/, '\\\[').replace(/[\]]/, '\\\]');
                          var regex = new RegExp('[\\?&]' + name + '=([^&#]*)'),
                              results = regex.exec(location.search);
                          return results == null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
                      }'
                        var stab = GetURLParameter('t');
                        alert(stab);
                      ";
                  }
				  
                 
                  
				  /*
                  if( $_GET['actionType'] == "eventos.view" ){
                  $html .= "$('.fb_ne').fancybox({
                              prevEffect	: 'none',
                              nextEffect	: 'none',
                              closeBtn	: false,
                              helpers	: {
                                  title	: { type : 'inside' },
                                  buttons	: {},
                                  thumbs	: {
                                    width	: 50,
                                    height	: 50
                                  }
                              }
                            });";
                  }
                  */
					
		$html .= "});";
		
	$html .= "</script>";
        

?>