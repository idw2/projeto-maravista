<?php

	$html .="<div class='Flutuante'>";
		$html .= "<div class='TopQuartoReservaTotal'>";
		
			$html .= "<form id='formSolicitarReservas' name='formSolicitarReservas' method='post' action='index.php?actionType=reservas.continue'>";
		
				if( $_POST["datainicio"] == '' )
				{
					/*$_POST["datainicio"] = "<span class='DiariaPreço right'><i>".getLabel('LABEL_NAO_INFORMADO', $_SESSION['LANGUAGE'])."<i></span>";*/
					$_POST["datainicio"] = "<span class='DiariaPreço right'><i>$dta_inicio_default->DTA<i></span>";
				}
				
				$html .= "<div class='ReservaTotalli'><span class='DiariaLabel'>".getLabel('LABEL_CHEGADA', $_SESSION['LANGUAGE']).": <span class='DiariaPreço right' id='datainicioFinalize' >".$_POST["datainicio"]."</span></div>";
				
				if( $_POST["datafim"] == '' )
				{
					/*$_POST["datafim"] = "<span class='DiariaPreço right'><i>".getLabel('LABEL_NAO_INFORMADO', $_SESSION['LANGUAGE'])."<i></span>";*/
					$_POST["datafim"] = "<span class='DiariaPreço right'><i>$dta_fim_default->DTA<i></span>";
				}
				
				$html .= "<div class='ReservaTotalli'><span class='DiariaLabel'>".getLabel('LABEL_SAIDA_FORM', $_SESSION['LANGUAGE']).": <span class='DiariaPreço right' id='datafimFinalize'>".$_POST["datafim"]."</span></div>";
				
				if( $_POST["pessoas"] == '' )
				{
					$_POST["pessoas"] = 0;
				}
				
				$html .= "<div class='ReservaTotalli'><span class='DiariaLabel'><span class='DiariaPreço right' id='pessoasFinalize'>".$_POST["pessoas"]."</span> ".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</div>";
				
				if( $_POST["adultos"] == '' )
				{
					$_POST["adultos"] = 0;
				}
				
				$html .= "<div class='ReservaTotalli'><span class='DiariaLabel'><span class='DiariaPreço right' id='adultosFinalize'>".$_POST["adultos"]."</span> ".getLabel('LABEL_ADULTOS', $_SESSION['LANGUAGE'])."</div>";
				/*
				if( $_POST["nQuartos"] != '' )
				{
					$x = (int) $_POST["adultos"];
					$z = ((int)$_POST["nQuartos"] * 2);
					$adultosExcedentes = ( $x - $z );
					
					if((int) $adultosExcedentes < 0 )
					{
						$adultosExcedentes = 0;	
					}
				}
				else
				{
					$adultosExcedentes = 0;	
				}
				*/
				
				$html .= "<div class='ReservaTotalli'><span class='DiariaLabel'><span class='DiariaPreço right' id='adultosExcedentesFinalize'>0</span> ".getLabel('LABEL_EXCEDENTES', $_SESSION['LANGUAGE'])."</div>";
				
				//$html .= "<div class='ReservaTotalli'><span class='DiariaLabel'><span class='DiariaPreço right' id='adultosExcedentesFinalizeValor'><span class='DiariaPreço right'><i>0,00<i></span></span> ".getLabel('LABEL_ADULTOS_EXCEDENTES_VALOR', $_SESSION['LANGUAGE'])."</div>";
				
				$criancas = ($_POST["criancas_5a"] + $_POST["criancas_6a12"] + $_POST["criancas_acima12"]);
				if( $criancas == '' )
				{
					$criancas = 0;
				}
				
				$html .= "<div class='ReservaTotalli'><span class='DiariaPreço right' id='adultosCriancas'>$criancas</span> <span class='DiariaLabel'>".getLabel('LABEL_CRIANCAS', $_SESSION['LANGUAGE'])."</div>";
				
				if( $_POST["nQuartos"] == '' )
				{
					$_POST["nQuartos"] = "<span class='DiariaPreço right' ><i>".getLabel('LABEL_NAO_INFORMADO', $_SESSION['LANGUAGE'])."<i></span>";
				}
				
				$html .= "<div class='ReservaTotalli'><span class='DiariaPreço right' id='quartosFinalize'>".$_POST["nQuartos"]."</span> <span class='DiariaLabel'>".getLabel('LABEL_QUARTOS', $_SESSION['LANGUAGE'])."</div>";
				
				if( $valor == '' )
				{
					$valor = "<span class='DiariaPreço right' id='totalFinalize'><i>0,00<i></span>";
				}
				else
				{
					$valor = "<span class='DiariaPreço right' id='totalFinalize'><i>".formataReais($valor)."<i></span>";
				}
				
				$html .= "<div class='ReservaTotalli' style='display: none'><span class='DiariaLabel'>".getLabel('LABEL_VALOR_TOTAL', $_SESSION['LANGUAGE']).": R$ <span class='DiariaPreço'>".$valor."</span></div>";
				
				
				$html .= "<div class='ReservaPreload' id='ReservaPreloadSubmit' onclick=\"javascript: getParameterHidden();\">";
					$html .= "<div class='ReservaTotalliBtn' id='ReservaTotalliBtn'>";
						$html .= "<input class='DiariaReserva' type='submit' id='AjaxSubmit' value='".getLabel('LABEL_PROXIMO', $_SESSION['LANGUAGE'])."'/>";
					$html .= "</div>";
				$html .= "</div>";
				
				$html .= "<div class='ReservaPreload' id='ReservaPreload'>";
					$html .= "<img src='../image/preload.gif' alt='' border=''/>";
				$html .= "</div>";
				
				$html .= "<div class='ErroAjaxMassage' id='ErroAjaxMassage'></div>";
				
				$html .= "<div>";
					$html .= "<input type='hidden' name='SomaQuartos' id='SomaQuartos' value='0'/>";
					$html .= "<input type='hidden' name='SomaTotal' id='SomaTotal' value='0,00'/>";
					$html .= "<input type='hidden' name='somaCriancas' id='somaCriancas' value='0'/>";
					$html .= "<input type='hidden' name='somaAdultos' id='somaAdultos' value='0'/>";
					$html .= "<input type='hidden' name='somaPessoas' id='somaPessoas' value='0'/>";
					$html .= "<input type='hidden' name='somaCriancas_acima12' id='somaCriancas_acima12' value='0'/>";
					$html .= "<input type='hidden' name='somaCriancas_6a12' id='somaCriancas_6a12' value='0'/>";
					$html .= "<input type='hidden' name='somaCriancas_5a' id='somaCriancas_5a' value='0'/>";
					$html .= "<input type='hidden' name='somaCodquarto' id='somaCodquarto' value=''/>";
					$html .= "<input type='hidden' name='somaAdultosExcedentes' id='somaAdultosExcedentes' value='0'/>";
					$html .= "<input type='hidden' name='somaCapacidade' id='somaCapacidade' value='0'/>";
					
					if( $_POST["datainicio"] == '' )
					{
						$html .= "<input type='hidden' name='somaDatainiciofinalize' id='somaDatainiciofinalize' value='$dta_inicio_default->DTA'/>";
					}
					else
					{
						$html .= "<input type='hidden' name='somaDatainiciofinalize' id='somaDatainiciofinalize' value='".$_POST["datainicio"]."'/>";
					}
					
					if( $_POST["datafim"] == '' )
					{
						$html .= "<input type='hidden' name='somaDatafimFinalize' id='somaDatafimFinalize' value='$dta_fim_default->DTA'/>";		
					}
					else
					{
						$html .= "<input type='hidden' name='somaDatafimFinalize' id='somaDatafimFinalize' value='".$_POST["datafim"]."'/>";		
					}
					
				$html .= "</div>";
				
				
				
				
				
			$html .= "</form>";
										
		$html .= "</div>";
			
	$html .="</div>";



?>