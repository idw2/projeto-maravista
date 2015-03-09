<?php

$tqts = mysql_query("SELECT 
	quartos_tipo.CODQUARTOTIPO,
	quartos_tipo.NOME,
	quartos_tipo.SIGLA,
	fotos.URL,
	descricao.".$_SESSION['LANGUAGE']." as DESCRICAO
FROM
	quartos_tipo
INNER JOIN quartos_tipo_rel_fotos ON quartos_tipo_rel_fotos.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
INNER JOIN fotos ON quartos_tipo_rel_fotos.CODFOTO=fotos.CODFOTO
INNER JOIN quartos_tipo_rel_descricao ON quartos_tipo_rel_descricao.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
INNER JOIN descricao ON descricao.CODDESCRICAO=quartos_tipo_rel_descricao.CODDESCRICAO
INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
INNER JOIN quartos ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
WHERE fotos.DESTAQUE=1
AND 
quartos.CODQUARTO 
	NOT IN( 
		SELECT 
			qts.CODQUARTO 
		FROM 
			quartos AS qts 
		INNER JOIN reservas_rel_quartos AS rrq ON rrq.CODQUARTO=qts.CODQUARTO 
		INNER JOIN reservas AS rsv ON rrq.CODRESERVA=rsv.CODRESERVA 
		WHERE rsv.DTAINICIO>='".$_POST["diffDtainicio"]."' AND rsv.DTAFIM<='".$_POST["diffDtafim"]."' 
		AND rsv.STATUS=1 GROUP BY quartos.CODQUARTO ORDER BY quartos.NOME ASC 
	)	
GROUP BY quartos_tipo.CODQUARTOTIPO ORDER BY (quartos_tipo.ORDEM+0) ASC");

$html .= "<div class='HiddenDiv painel'>";

	$html .= "<div class='HiddenDiv_top'>";
		$html .="<div class='Acomodacoes painel-label'>";
			$html .= getLabel('LABEL_ACOMODACAO', $_SESSION['LANGUAGE'])." (3)";
		$html .="</div>";
        //$html .= "<span class='LabelAcomodacaoTitle right'>".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</span>";
        $html .= "</div>";
        
	$html .= "<table>";

		$html .= "<tr>";	
										
			$html .= "<td>";	
				$html .= "<input type='hidden' class='ScreenOptionOk screen_option_2_ok' name='screen_option_2_ok' value='NOACTION'/>";	
			$html .= "</td>";	
			
			//$html .= "<td>".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</td>";	

		$html .= "</tr>";	
		$html .= "<tr>";	

			$html .= "<td class='InformeAcomodacao'>";	
				$html .= "
                              <label for='myDropdown01'>".getLabel('LABEL_ACOMODACAO', $_SESSION['LANGUAGE'])."</label>
					<div id='myDropdown03'></div>
					<script>
						var ddData = [
				";		
					
				$i=0;
				(int)$count=mysql_num_rows($tqts);
				$count = ($count - 1);
				while( $tqt = mysql_fetch_object($tqts))
				{
					$html .= "
					{
						text: '$tqt->NOME',
						value: '$tqt->CODQUARTOTIPO',
						selected: false,
						description: '$tqt->SIGLA',
						imageSrc: '$tqt->URL'
					}";
					
					if( $count != $i)
					{
						$html .= ",";	
					}
					
				}
				
				$html .= "			
					];
					$('#myDropdown03').ddslick({
						data: ddData,
						width:250,
						selectText: '".getLabel('LABEL_ESC', $_SESSION['LANGUAGE'])."',
						imagePosition:'left',
						onSelected: function(selectedData){
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
							
						}   
					});
					
					</script>
				
				";	
				
			$html .= "</td>";
			$html .= "<td class='InformePessoas'>";	
                        $html .= "<label class='LabelAcomodacaoTitle'>".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</label>";
				$html .= "<select name='screen_pessoa_2' id='screen_pessoa_2' class='n_pessoas'>";
					$html .= "<option value='0'>--</option>";		
					$html .= "<option value='1'>1</option>";		
					$html .= "<option value='2'>2</option>";		
					$html .= "<option value='3'>3</option>";		
					$html .= "<option value='4'>4</option>";		
					$html .= "<option value='5'>5</option>";		
					$html .= "<option value='6'>6</option>";		
					$html .= "<option value='7'>7</option>";		
					$html .= "<option value='8'>8</option>";		
				$html .= "</select>";	
				
			$html .= "</td>";
		$html .= "</tr>";

	$html .= "</table>";
$html .= "</div>";

?>