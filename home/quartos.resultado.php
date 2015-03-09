<?php

	$html .= "<div id='corpo'>";
		
        $html .="<div class='container'>";
                $html .="<div class='fix_form col-xs-4' style='top: 0px;'></div>";
                
                require("reservas.form.php");
                   
            $html .="<div class='pag_interna col-xs-8 right'>";
			
				$html .="<div class='pint_titulo Acomodacoes'>";
					$html .= getLabel('LABEL_ACOMODACOES', $_SESSION['LANGUAGE']);
				$html .="</div>";
				
				$html .= "<form name='formsearch1' method='post' action='index.php?actionType=quartos.resultado'>";
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
							
							$tipos = mysql_query("SELECT * FROM quartos_tipo WHERE STATUS=1 ORDER BY (ORDEM+0) ASC");

							if(mysql_num_rows($tipos) !=0)
							{
								$html .= "<select class='SelectDivLoop' style='width: 180px' name='codquartotipo' id='codquartotipo' >";

									$html .= "<option value=''>--</option>";
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
                        $html .= "<div class='BtnFiltroDiv'><input class='BtnFiltro' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";	

                    $html .= "</div>";
				$html .= "</form>";
				
				$quartos = mysql_query("SELECT * FROM quartos WHERE STATUS=1");
				
				$n = mysql_num_rows($quartos);
				
				$html .="<div class='NoHotel'>";
					$html .= getLabel('LABEL_NO_HOTEL', $_SESSION['LANGUAGE']);
				$html .="</div>";
				$html .="<div class='NumQuartos'>";
					$html .= "<span class='Xquartos'>$n</span> <span class='XquartosText'>".getLabel('LABEL_QUARTOS', $_SESSION['LANGUAGE'])."</span>";
				$html .="</div>";
				
				if(!empty($_POST) && isset($_POST['ACTION']))
				{
					if( $_POST['buscar'] != "" )
					{
						$xnome = trim( htmlentities( $_POST['buscar'] ) );
						$titulo_quarto = " AND quartos.NOME LIKE '%$xnome%'";
						
						$xdescricao = trim( htmlentities( $_POST['buscar'] ) );
						$descricao_quarto = " OR quartos_descricao.".$_SESSION['LANGUAGE']." LIKE '%$xdescricao%'";				
						if( $_POST['codquartotipo'] != "" )
						{
							$codquartotipo = "AND quartos_tipo.CODQUARTOTIPO='".$_POST['codquartotipo']."'";			
						}
					}
					else
					{
						if( $_POST['codquartotipo'] != "" )
						{
							$codquartotipo = " AND quartos_tipo.CODQUARTOTIPO='".$_POST['codquartotipo']."'";			
						}
					}
					
				}
				
				///// LISTAGEM DOS QUARTOS ********************************
                
                
                $html .="<style>.ResultQuartosPrincipal{ top:0 !important; }</style>";
                require("reservas.list.4.php");
                /////  ********************************
                $html .="</div>"; // COL 8
				$html .= "<div class='ResetFloat'></div>";	
		
			$html .="</div>";
			
		$html .="</div>";
	$html .="</div>";
	$html .= "</div>";	
	$html .="<div style='clear: both'></div>";  

?>