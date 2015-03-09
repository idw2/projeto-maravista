<?php

        //$html .= "<div class='pint_titulo Acomodacoes'>".getLabel('LABEL_PACOTES', $_SESSION['LANGUAGE'])."</div>";
        $exist =  mysql_query("SELECT * FROM `pacotes_rel_eventos` WHERE CODEVENTO='".$resposta->CODEVENTO."'");
		
		if( mysql_num_rows($exist) != 0)
		{
			$inner_join = "INNER JOIN pacotes_rel_eventos ON pacotes_rel_eventos.CODPACOTE=pacotes.CODPACOTE";	
			$and = "AND pacotes_rel_eventos.CODEVENTO='".$resposta->CODEVENTO."'";
		}
		
		$pacotes = mysql_query("
			SELECT 
				pacotes.CODPACOTE, 
				pacotes.ISTEMPORADA, 
				pacotes.VALOR_DE , 
				pacotes.VALOR_PARA, 
				pacotes.DIAS_DESCONTO, 
				pacotes.".$_SESSION["LANGUAGE"]." as PACOTE, 
				datas.DTAINICIO, 
				datas.DTAFIM, 
				DATE_FORMAT( datas.DTAINICIO, '%d/%m/%Y' ) as DTAINICIOBRAZIL,
				DATE_FORMAT( datas.DTAFIM, '%d/%m/%Y' ) as DTAFIMBRAZIL,
				descricao.".$_SESSION["LANGUAGE"]." as DESCRICAO, 
				quartos_tipo.CODQUARTOTIPO,
				quartos_tipo.NOME
			FROM pacotes
			INNER JOIN pacotes_rel_datas ON pacotes_rel_datas.CODPACOTE=pacotes.CODPACOTE
			INNER JOIN pacotes_rel_descricao ON pacotes_rel_descricao.CODPACOTE=pacotes.CODPACOTE
			$inner_join
			INNER JOIN datas ON datas.CODDTA=pacotes_rel_datas.CODDTA
			INNER JOIN descricao ON descricao.CODDESCRICAO=pacotes_rel_descricao.CODDESCRICAO
			INNER JOIN quartos_tipo ON quartos_tipo.CODQUARTOTIPO=pacotes.CODQUARTOTIPO
			WHERE 
			quartos_tipo.STATUS=1
			AND datas.STATUS=1
			AND pacotes.STATUS=1
			AND pacotes.DISPONIVEL=1
			AND pacotes.DIAS_DESCONTO=0
			$and
			AND datas.DTAINICIO>=CURRENT_DATE 
			AND	datas.DTAFIM<=datas.DTAFIM 
		");
		
		if(mysql_num_rows($pacotes) != 0)
		{
		
			$html .= "<div class='pacotes_container'>";
			
				$i=0;
				while($pacote = mysql_fetch_object($pacotes))
				{

$html .= "<div class='pacotes_item'>";
	
	$html .= "<div class='visualiza-resultados-".$i."' style='display: none'>";				
		$html .= "<div class='preloader_wrap'><span class='preloader page_preloader'></span></div>";				
	$html .= "</div>";				
	$html .= "<div class='pacotes_mostra hidden-information-".$i."'>";				
		$html .= "<div class='pacotes_left'>";
			$html .= "<div class='pacotes_titulo'>".$pacote->PACOTE."</div>"; 
			$html .= "<div class='pacotes_cat'>".$pacote->NOME."</div>"; 
				$html .= "<div class='pacotes_btm pt_left'>";
					/*
					$diff =  mysql_query("SELECT DATEDIFF('".$pacote->DTAFIM."','".$pacote->DTAINICIO."') as DiffDate");
					if(mysql_num_rows($diff) != 0)
					{
						$diff = mysql_fetch_object($diff);
						($diff->DiffDate == "1")
						? $html .= "<div class='pacotes_noites'>".$diff->DiffDate." ".getLabel('LABEL_NOITE', $_SESSION['LANGUAGE'])."</div>" 
						: $html .= "<div class='pacotes_noites'>".$diff->DiffDate." ".getLabel('LABEL_NOITES', $_SESSION['LANGUAGE'])."</div>"; 
					}
					*/

				$html .= "<div class='pacotes_data'>".$pacote->DTAINICIOBRAZIL." a ".$pacote->DTAFIMBRAZIL."</div>";
			$html .= "</div>";
			$html .= "<div>";
				$html .= $pacote->DESCRICAO; 
			$html .= "</div>";			
		$html .= "</div>"; 
		$html .= "<div class='pacotes_right'>";
			$html .= "<div class='valor'><strong>R$</strong> ".formataReais($pacote->VALOR_PARA)."</div>";
			
			/*
			 * inicio do formulario			
			 */
			$html .= "<form  onSubmit='return false' id='formReserva_".$i."' name='formReserva' method='post' action='$dados_relevantes->HTTPS/index.php?actionType=reservas.form.submit'>";
				/*	
				$html .= "<input type='hidden' name='language_".$i."' id='language_".$i."' value='".$_SESSION["LANGUAGE"]."'/>";
				$html .= "<input type='hidden' name='dtainicio_".$i."' id='dtainicio_".$i."' value='".$pacote->DTAINICIOBRAZIL."'/>";
				$html .= "<input type='hidden' name='dtafim_".$i."' id='dtafim_".$i."' value='".$pacote->DTAFIMBRAZIL."' />";
				$html .= "<input type='hidden' name='codquartotipo' id='codquartotipo' value='".$pacote->CODQUARTOTIPO."' />";
				$html .= "<input type='hidden' name='codpacote' id='codpacote' value='".$pacote->CODPACOTE."' />";
				
				$html .= "<div class='pacotes_select_pessoas field_reserva'>";
                          $html .= "<div class='field_reserva-text'>".getLabel('LABEL_ADULTOS', $_SESSION['LANGUAGE'])."</div>";
                          $html .= "<select name='adulto_".$i."' id='adulto_".$i."' class='pte_pessoas field_reserva-select'>";
						$html .= "<option value='2'>2</option>";
						$html .= "<option value='3'>3</option>";
						$html .= "<option value='4'>4</option>";
                          $html .= "</select>";
                        $html .= "</div>";
				$html .= "<div class='pacotes_select_pessoas field_reserva'>";
                          $html .= "<div class='field_reserva-text'>".getLabel('LABEL_CRIANCAS', $_SESSION['LANGUAGE'])."</div>";
                          $html .= "<select name='crianca_".$i."' id='crianca_".$i."' class='pte_pessoas criancas_select field_reserva-select'>";
						$html .= "<option value='0'>".getLabel('LABEL_NAO', $_SESSION['LANGUAGE'])."</option>";
						$html .= "<option value='1'>".getLabel('LABEL_SIM', $_SESSION['LANGUAGE'])."</option>";
                          $html .= "</select>";
                        $html .= "</div>";
                        
				$html .= "<div class='active-crianca-".$i." criancas_more' style='display: none;'>";  
					$html .= "<div class='pacotes_select_pessoas field_reserva'>";
                                $html .= "<div class='field_reserva-text'>".getLabel('LABEL_CRIANCAS_ACIMA12', $_SESSION['LANGUAGE'])."</div>";
                                $html .= "<select name='crianca12_".$i."' id='crianca12_".$i."' class='pte_pessoas field_reserva-select'>";
                                          $html .= "<option value='0'>0</option>";
							$html .= "<option value='1'>1</option>";
							$html .= "<option value='2'>2</option>";
							$html .= "<option value='3'>3</option>";
                                $html .= "</select>";
                              $html .= "</div>";
					$html .= "<div class='pacotes_select_pessoas field_reserva'>";
                                $html .= "<div class='field_reserva-text'>".getLabel('LABEL_CRIANCAS_6A12', $_SESSION['LANGUAGE'])."</div>";
                                $html .= "<select name='crianca6a12_".$i."' id='crianca6a12_".$i."' class='pte_pessoas field_reserva-select'>";
                                          $html .= "<option value='0'>0</option>";
							$html .= "<option value='1'>1</option>";
							$html .= "<option value='2'>2</option>";
							$html .= "<option value='3'>3</option>";
                                $html .= "</select>";
                              $html .= "</div>";
					$html .= "<div class='pacotes_select_pessoas field_reserva'>";
                                $html .= "<div class='field_reserva-text'>".getLabel('LABEL_CRIANCAS_ATE5ANOS', $_SESSION['LANGUAGE'])."</div>";
                                $html .= "<select name='crianca0a5_".$i."' id='crianca0a5_".$i."' class='pte_pessoas field_reserva-select'>";
                                    $html .= "<option value='0'>0</option>";
						$html .= "<option value='1'>1</option>";
						$html .= "<option value='2'>2</option>";
						$html .= "<option value='3'>3</option>";
                                $html .= "</select>";
                              $html .= "</div>";
				$html .= "</div>";
				*/
				$html .= "<div>";
					//$html .= "<button class='dtaCalendarioSubmit dtaCalendarioSubmit_".$i."' onclick=\"javascript:actionReserva_pacote(".$i.")\">".getLabel('LABEL_FAZER_RESERVA', $_SESSION['LANGUAGE'])."</button>";
					$html .= "<button class='dtaCalendarioSubmit dtaCalendarioSubmit_".$i."' onclick=\"javascript:window.location='$dados_relevantes->HTTP/contato'\">".getLabel('LABEL_FAZER_RESERVA', $_SESSION['LANGUAGE'])."</button>";
				$html .= "</div>";
			$html .= "</form>";
			
			/*
			 * final do formulario			
			 */
			
		$html .= "</div>";
	$html .= "</div>";
$html .= "</div>";
$i++;
				 
				 
					
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 /*
					$html .= "<div class='pacotes_item'>";
                              $html .= "<div class='pacotes_mostra'>";
					$html .= "<form id='form_".$pacote->CODPACOTE."_".$pacote->CODQUARTOTIPO."' name='form1' method='post' action='$dados_relevantes->HTTPS/index.php?actionType=reservas.analisa'>";
						
						$html .= "<div>";
							
							$html .= "<div><input type='hidden' name='codpacote' value='".$pacote->CODPACOTE."'/></div>";  
							$html .= "<div><input type='hidden' name='screen_option_0_ok' value='NOACTION'/></div>";
							$html .= "<div><input type='hidden' name='select_quarto_tipo_0' value='".$pacote->CODQUARTOTIPO."'/></div>";
							$html .= "<div><input type='hidden' name='diffDtainicio' value='".$pacote->DTAINICIO."'/></div>";
							$html .= "<div><input type='hidden' name='Prepara_datainicio' value='".$pacote->DTAINICIO."'/></div>";
							$html .= "<div><input type='hidden' name='diffDtafim' value='".$pacote->DTAFIM."'/></div>"; 
							$html .= "<div><input type='hidden' name='Prepara_dtafim' value='".$pacote->DTAFIM."'/></div>"; 
							$html .= "<div><input type='hidden' name='ACTION' value='ACTION'/></div>";
							$html .= "<div><input type='hidden' name='datainicio' value='".$pacote->DTAINICIOBRAZIL."'/></div>";  
							$html .= "<div><input type='hidden' name='datafim' value='".$pacote->DTAFIMBRAZIL."'/></div>"; 
							$html .= "<div><input type='hidden' name='dias_desconto' value='".$pacote->DIAS_DESCONTO."'/></div>"; 
							$html .= "<div><input type='hidden' name='nQuartos' value='1'/></div>"; 
							$html .= "<div><input type='hidden' name='n_adulto' value='0'/></div>"; 
							$html .= "<div><input type='hidden' name='n_crianca' value='0'/></div>"; 
							$html .= "<div><input type='hidden' name='Prepara_pessoas' value='0'/></div>";  
							$html .= "<div><input type='hidden' name='screen_pessoa_0' value='0'/></div>";  
							$html .= "<div><input type='hidden' name='Prepara_adultos' value='0'/></div>";  
							$html .= "<div><input type='hidden' name='Prepara_criancas_5a' value='0'/></div>";  
							$html .= "<div><input type='hidden' name='Prepara_criancas_6a12' value='0'/></div>";  
							$html .= "<div><input type='hidden' name='Prepara_criancas_acima12' value='0'/></div>";  
							$html .= "<div><input type='hidden' name='Prepara_nCrianca' value='0'/></div>";  
							
						$html .= "</div>"; 
						$html .= "<div class='pacotes_left'>";
                                    
                                      $html .= "<div class='pacotes_titulo'>".$pacote->PACOTE."</div>"; 
                                      $html .= "<div class='pacotes_cat'>".$pacote->NOME."</div>"; 
                                      
                                      $html .= "<div class='pacotes_btm pt_left'>";
                                      
                                        $diff =  mysql_query("SELECT DATEDIFF('".$pacote->DTAFIM."','".$pacote->DTAINICIO."') as DiffDate");
						
                                        if(mysql_num_rows($diff) != 0)
                                        {
                                              $diff = mysql_fetch_object($diff);
                                              ($diff->DiffDate == "1")
                                              ? $html .= "<div class='pacotes_noites'>".$diff->DiffDate." ".getLabel('LABEL_NOITE', $_SESSION['LANGUAGE'])."</div>" 
                                              : $html .= "<div class='pacotes_noites'>".$diff->DiffDate." ".getLabel('LABEL_NOITES', $_SESSION['LANGUAGE'])."</div>"; 
                                        }

                                          $html .= "<div class='pacotes_data'>".$pacote->DTAINICIOBRAZIL." a ".$pacote->DTAFIMBRAZIL."</div>";

                                        $html .= "</div>"; 
						$html .= "</div>"; 
						//( $pacote->ISTEMPORADA == '1' ) 
						//? $html .= "<div>".getLabel('LABEL_BAIXA_TEMPORADA', $_SESSION['LANGUAGE'])."</div>" 
						//: $html .= "<div>".getLabel('LABEL_ALTA_TEMPORADA', $_SESSION['LANGUAGE'])."</div>";
						
						$html .= "<div class='pacotes_right'>";
							//$html .= "<div>".getLabel('LABEL_VALOR_DE', $_SESSION['LANGUAGE']).": ".formataReais($pacote->VALOR_DE)."</div>";
							$html .= "<div class='valor'><strong>R$</strong> ".formataReais($pacote->VALOR_PARA)."</div>";
						//$html .= "</div>"; 
						
						//$html .= "<div>".$pacote->DESCRICAO."</div>"; 	
						
						
						$html .= "<div class='pacotes_btm pt_right'>";
						  $html .= "<div class='pacotes_select_pessoas field_reserva'>";
								$html .= "<div class='field_reserva-text'>".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</div>";
								$html .= "<select name='pessoas' id='pessoas' class='pte_pessoas field_reserva-select' onchange=\"setPessoas(this.value)\">";
									  $html .= "<option value='2'>02</option>";
									  $html .= "<option value='3'>03</option>";
									  $html .= "<option value='4'>04</option>";
								$html .= "</select>";
						  $html .= "</div>";
						  $html .= "<input type='submit' value='".getLabel('LABEL_RESERVAS_PRE', $_SESSION['LANGUAGE'])."'class='BtnFiltro small'/>";
						  $html .= "<div class='BtnFiltro small secudario push-right pacotes_btn_desc'>"
								  . "<i class='ico1 entypo-arrow-down4'></i>"
								  . "<i class='ico2 entypo-arrow-up3'></i>"
								  . "</div>";
						  
						$html .= "</div>"; 
					 $html .= "</div>";  	
					$html .= "</form>";	
                            $html .= "</div>"; 
                            $html .= "<div class='pacotes_desc'>";
                            $html .= $pacote->DESCRICAO; 
                            $html .= "</div>";
                            $html .= "</div>";
				*/
				}
			$html .= "</div>";
			
		}
		
?>