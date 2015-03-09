<?php

        //$html .= "<div class='pint_titulo Acomodacoes'>".getLabel('LABEL_PACOTES', $_SESSION['LANGUAGE'])."</div>";
        
		$pacotes = mysql_query("
			SELECT 
				pacotes.CODPACOTE, 
				pacotes.ISTEMPORADA, 
				pacotes.VALOR_DE , 
				pacotes.VALOR_PARA, 
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
			INNER JOIN datas ON datas.CODDTA=pacotes_rel_datas.CODDTA
			INNER JOIN descricao ON descricao.CODDESCRICAO=pacotes_rel_descricao.CODDESCRICAO
			INNER JOIN quartos_tipo ON quartos_tipo.CODQUARTOTIPO=pacotes.CODQUARTOTIPO
			WHERE 
			quartos_tipo.STATUS=1
			AND datas.STATUS=1
			AND pacotes.STATUS=1
			AND pacotes.DISPONIVEL=1
			AND datas.DTAINICIO>=CURRENT_DATE 
			AND	datas.DTAFIM<=datas.DTAFIM 
		");
		
		if(mysql_num_rows($pacotes) != 0)
		{
		
			$html .= "<div class='pacotes_container'>";
				while($pacote = mysql_fetch_object($pacotes))
				{
                            $html .= "<div class='pacotes_item'>";
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
                                      $html .= "<div class='pacotes_quarto'>".$pacote->NOME."</div>"; 
                                      
						$html .= "</div>"; 
						$diff =  mysql_query("SELECT DATEDIFF('".$pacote->DTAFIM."','".$pacote->DTAINICIO."') as DiffDate");
						
						if(mysql_num_rows($diff) != 0)
						{
							$diff = mysql_fetch_object($diff);
							($diff->DiffDate == "1")
							? $html .= "<div class='pacotes_noites'>".$diff->DiffDate." ".getLabel('LABEL_NOITE', $_SESSION['LANGUAGE'])."</div>" 
							: $html .= "<div class='pacotes_noites'>".$diff->DiffDate." ".getLabel('LABEL_NOITES', $_SESSION['LANGUAGE'])."</div>"; 
						}
						
						//( $pacote->ISTEMPORADA == '1' ) 
						//? $html .= "<div>".getLabel('LABEL_BAIXA_TEMPORADA', $_SESSION['LANGUAGE'])."</div>" 
						//: $html .= "<div>".getLabel('LABEL_ALTA_TEMPORADA', $_SESSION['LANGUAGE'])."</div>";
						
						$html .= "<div class='pacotes_right'>";
							//$html .= "<div>".getLabel('LABEL_VALOR_DE', $_SESSION['LANGUAGE']).": ".formataReais($pacote->VALOR_DE)."</div>";
							$html .= "<div>R$ ".formataReais($pacote->VALOR_PARA)."</div>";
						//$html .= "</div>"; 
						
						
							$html .= "<div>".$pacote->DTAINICIOBRAZIL." a ".$pacote->DTAFIMBRAZIL."</div>";
						
						
						$html .= "<div>".$pacote->DESCRICAO."</div>"; 	
						
						$html .= "<div>".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</div>";
						
						$html .= "<div>";
							$html .= "<select name='pessoas' id='pessoas' onchange=\"setPessoas(this.value)\">";	  		
								$html .= "<option value='2'>02</option>";
								$html .= "<option value='3'>03</option>";
								$html .= "<option value='4'>04</option>";
							$html .= "</select>";
						$html .= "</div>";
						$html .= "<div><input type='submit' value='".getLabel('LABEL_RESERVAS_PRE', $_SESSION['LANGUAGE'])."'/></div>";
						
					$html .= "</form>";	
                            $html .= "</div>";  
				}
			$html .= "</div>";
		
		}
		
?>