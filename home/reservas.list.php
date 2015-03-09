<?php

	require("reservas.form.ajax.php");
	
	
	$html .="<div class='acord_container col-xs-8 ResultQuartosPrincipal' style='top: -112px;'>";
        ///// FILTROS ********************************
            
                $html .= "<form name='formsearch1' method='post' action='index.php?actionType=".$_GET['actionType']."'>";
                    $html .= "<div class='FormFiltroDiv'>";
                        if(!empty($_POST) && isset($_POST['ACTION']))
                        {
                            $html .= "<div class='InputTextBuscaDiv'><input class='InputTextBusca' type='text' name='buscar' value='$_POST[buscar]' placeholder='".getLabel('LABEL_BUSCAR', $_SESSION['LANGUAGE'])."'/></div>";		
                        }
                        else
                        {
                            $html .= "<div class='InputTextBuscaDiv'><input class='InputTextBusca' type='text' name='buscar' value='' placeholder='".getLabel('LABEL_BUSCAR', $_SESSION['LANGUAGE'])."'/></div>";
                        }

                        $html .= "<div class='SelectDiv'>";
                        $tipos = mysql_query("SELECT * FROM quartos_tipo WHERE STATUS=1 ORDER BY FIELD('Suite Master','Deluxe Vista Mar','Deluxe','Superior','Standart')");

                        if(mysql_num_rows($tipos) !=0)
                        {
                                $html .= "<select class='SelectDivLoop' style='width: 180px' name='codquartotipo' id='codquartotipo' >";

                                        $html .= "<option value=''>Todos</option>";
                                        while( $tipo = mysql_fetch_object($tipos) )
                                        {
                                                if(!empty($_POST) && isset($_POST['ACTION']) )
                                                {
                                                        ( $_POST['codquartotipo'] == $tipo->CODQUARTOTIPO ) 
                                                        ? $html .= "<option value='$tipo->CODQUARTOTIPO' selected>$tipo->NOME</option>"				
                                                        : $html .= "<option value='$tipo->CODQUARTOTIPO'>$tipo->NOME</option>";				
                                                }
                                                else
                                                {
                                                        $html .= "<option value='$tipo->CODQUARTOTIPO'>$tipo->NOME</option>";				
                                                }
                                        }
                                $html .= "</select>";
                        }
                        $html .= "</div>";
                        $html .= "<input type='hidden' name='ACTION' value='ACTION'>";
                        $html .= "<div class='BtnFiltroDiv'><input class='BtnFiltro' type='submit' value='".getLabel('LABEL_OK', $_SESSION['LANGUAGE'])."'/></div>";	

                    $html .= "</div>";
		$html .= "</form>";
			
		$quartos = mysql_query("SELECT 
			quartos.*,
			DATE_FORMAT( quartos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA,
			fotos.URL,
			fotos.TITULO,
			quartos_tipo.NOME as TIPO,
			quartos_descricao.".$_SESSION['LANGUAGE']."
			FROM quartos
			INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
			INNER JOIN quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
			INNER JOIN quartos_descricao ON quartos_descricao.CODQUARTO=quartos.CODQUARTO
			INNER JOIN quartos_rel_fotos ON quartos_rel_fotos.CODQUARTO=quartos.CODQUARTO
			INNER JOIN fotos ON fotos.CODFOTO=quartos_rel_fotos.CODFOTO
			WHERE fotos.DESTAQUE=1
			AND quartos.CODQUARTO NOT IN( SELECT l.CODQUARTO FROM quartos_rel_reservas as l WHERE  l.DTAINICIO='$datafim' )
			GROUP BY quartos.CODQUARTO
			ORDER BY quartos.NOME ASC");		
		
		$count = 0;
		$i=0;
		if( mysql_num_rows($quartos) != 0)
		{
			while( $quarto = mysql_fetch_object($quartos))
			{
				$count++;	
				( $count % 2 == 0 )
				? $html .= "<div class='MasterListBody'>"
				: $html .= "<div class='MasterListBody MasterListBodyColor'>";
				
					$html .= "<div class='MasterList'>";
						$html .= "<div class='TopImageReserva'>";
							$html .= "<div class='ImgReserva'>";
							   $html .= "<script>
									$('.$quarto->CODQUARTO').fancybox({'titleShow': true, arrows: true});
								</script>";

								$html .="<a href='$quarto->URL' title='$quarto->TIPO, $quarto->NOME' rel='fancybox-button' class='melhores-icon $quarto->CODQUARTO' ><span></span></a>";
								$html .= "<img src='$quarto->URL' alt='$quarto->TIPO, $quarto->NOME' title='$quarto->TIPO, $quarto->NOME' border='0'/>";


								$fotos = mysql_query("SELECT  
										fotos.CODFOTO,
										DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA,
										fotos.TITULO,
										fotos.URL,
										fotos.STATUS,
										fotos.DESTAQUE,
										fotos.OWNER
								FROM fotos 
								INNER JOIN quartos_rel_fotos ON quartos_rel_fotos.CODFOTO=fotos.CODFOTO
								WHERE quartos_rel_fotos.CODQUARTO='$quarto->CODQUARTO'");

								if( mysql_num_rows($fotos) != 0)
								{
									while( $foto = mysql_fetch_object($fotos))
									{
										if( $foto->TITULO != "")
										{
											$titulo = "- $foto->TITULO";
										}
										$html .= "<a class='$quarto->CODQUARTO' rel='fancybox-button' href='$foto->URL' title='$quarto->TIPO, $quarto->NOME $titulo' style='display: none;'>";
												$html .= "<img src='$foto->URL' alt=$quarto->TIPO, $quarto->NOME $titulo' />";
										$html .= "</a>";
									}
								}
								
							$html .= "</div>";
                                                        
						$html .= "</div>";
						
						$html .= "<div class='TopQuartoReserva'>";
							$html .= "<div>"; 
								$html .= "<span class='ResultQuatosTableTRTitle'>$quarto->NOME</span>"; 
								$html .= "<span class='SubTitle'> $quarto->TIPO</span>";
							$html .= "</div>"; 
							
							//$valor = ( $valor + $quarto->VALOR );
							
							( $quarto->VALOR == "0" || $quarto->VALOR == null)
							? $quarto->VALOR = "0,00"
							: $quarto->VALOR = formataReais($quarto->VALOR);
							$html .= "<div><span class='DiariaLabel'>".getLabel('LABEL_DIARIA', $_SESSION['LANGUAGE']).": <span class='DiariaPreço'>R$ $quarto->VALOR</span></div>";
							$html .= "<div><span class='DiariaLabel'>Capacidade: <span class='DiariaPreço'>$quarto->PESSOAS ".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</span></div>";
							
						$html .= "</div>";
                        $html .= "<div class='checkbox_quartos'>";
							$html .= "<input type='checkbox' class='ReservaAjax acomodacoes' id='ReservaDescriptInput_$quarto->CODQUARTO' />";
                            $html .= "<span class='checkbox_quartos_bg'></span>";
							$html .= "<input type='hidden' class='ReservaAjaxReferencia' id='ReservaLoopReferencia_$quarto->CODQUARTO' value='SOMAR' />";
							$html .= "<input type='hidden' class='ReservaAjaxAcomodacoes' id='ReservaLoopAcomodacoes_$quarto->CODQUARTO' value='$quarto->PESSOAS' />";             
						$html .= "</div>";
					$html .= "</div>";
					
					$html .= "<div class='ResetFloat'></div>";
					
					$html .= "<div class='ReservaDescript' id='ReservaDescriptId_$quarto->CODQUARTO'>";
						$html .= "<input type='hidden' id='ReservaDescriptInputHidden_$quarto->CODQUARTO' value='$i'/>";
						
                        $html .= "<div class='acord_each'>";
							$html .= "<div class='acord_title' id='ReservaDescript_$quarto->CODQUARTO' class='btn_azul font14'>Mais Informações</div>";
							$html .= "<div class='acord_cont' id='ReservaDescriptShow_$quarto->CODQUARTO'>".$quarto->$_SESSION['LANGUAGE']."</div>";
                        $html .= "</div>";
					$html .= "</div>";
				
				
				$html .= "</div>";
				$i++;
			}
		}
			
	$html .="</div>";

?>
<script language='javascript' src='../script/jquery-1.9.1.min.js'></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
		$('.acord_container').accordion({ 
			header: ".acord_title",
			content: ".acord_cont",
			collapsible: true,
			active: false,
			heightStyle: "content"
		});
	   
	});
    
</script>