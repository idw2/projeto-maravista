<?php

	if($_GET["actionType"] == "")
	{
		$_GET["actionType"] = "pagina.inicial";
	}
	/*
	if($_GET["actionType"] != "pagina.inicial"
          && $_GET["actionType"] != "reservas.analisa"    
          && $_GET["actionType"] != "reservas.form.submit"
          && $_GET["actionType"] != "reservas.forma.pgto"
          && $_GET["actionType"] != "reservas.forma.pgto.deposito")
	{
		$html .="<div class='melhores-home interna'>";
			$html .="<span class='melhores-titulo'>".getLabel('LABEL_MELHORES_PRECOS', $_SESSION['LANGUAGE'])."</span>";
		$html .="</div>";
	}
      */
	$html .= "<div class='LuaDeMel'>";

		$html .="<div class='ImagemTopLeft'><img src='./image/cantoneira_left.png' alt='' border='0' title=''/></div>";	

		$html .= "<h2 class='LuadeMel_titulo'>".getLabel('LABEL_SERVICOSE', $_SESSION['LANGUAGE'])." <strong>".getLabel('LABEL_LAZER', $_SESSION['LANGUAGE'])."</strong></h2>";

            
			
			if( $_GET["coddica"] == "45A61C35E5F2E69969893D84A141BE3B"){
				
				//Café da Manhã
				$html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=F2444F8355902EC49469352AC615A10A'><p>".getLabel('LABEL_CAFEDAMANHA', $_SESSION['LANGUAGE'])."</p></a>";
				$html .= "<span class='l-separador'></span>";
				//Restaurante
				$html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=93618B36B30CED28828689B9234EC405'><p>".getLabel('LABEL_RESTAURANTE', $_SESSION['LANGUAGE'])."</p></a>";
			}
			
			
			if( $_GET["coddica"] == "F2444F8355902EC49469352AC615A10A"){
				
				//Instalações
				$html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=45A61C35E5F2E69969893D84A141BE3B'><p>".getLabel('LABEL_INSTALACOES', $_SESSION['LANGUAGE'])."</p></a>";
				$html .= "<span class='l-separador'></span>";				
				//Restaurante
				$html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=93618B36B30CED28828689B9234EC405'><p>".getLabel('LABEL_RESTAURANTE', $_SESSION['LANGUAGE'])."</p></a>";
			}
			
			if( $_GET["coddica"] == "93618B36B30CED28828689B9234EC405"){
				
				//Café da Manhã
				$html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=F2444F8355902EC49469352AC615A10A'><p>".getLabel('LABEL_CAFEDAMANHA', $_SESSION['LANGUAGE'])."</p></a>";
				$html .= "<span class='l-separador'></span>";
				//Instalações
				$html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=45A61C35E5F2E69969893D84A141BE3B'><p>".getLabel('LABEL_INSTALACOES', $_SESSION['LANGUAGE'])."</p></a>";
			} 
			
			
			if( $_GET["coddica"] == "" ) {
				
				//Instalações
				$html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=45A61C35E5F2E69969893D84A141BE3B'><p>".getLabel('LABEL_INSTALACOES', $_SESSION['LANGUAGE'])."</p></a>";
				$html .= "<span class='l-separador'></span>";				
				//Restaurante
				$html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=93618B36B30CED28828689B9234EC405'><p>".getLabel('LABEL_RESTAURANTE', $_SESSION['LANGUAGE'])."</p></a>";
			
			}
			
			
			/*
			if( $_GET["coddica"] != "45A61C35E5F2E69969893D84A141BE3B"){
              $html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=45A61C35E5F2E69969893D84A141BE3B'><p>".getLabel('LABEL_INSTALACOES', $_SESSION['LANGUAGE'])."</p></a>";
            }
            
            $html .= "<span class='l-separador'></span>";
            
            if( $_GET["coddica"] != "93618B36B30CED28828689B9234EC405"){
              
			  if( $_GET["actionType"] != "facilidades.servicos")
              {
                $html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=93618B36B30CED28828689B9234EC405'><p>".getLabel('LABEL_RESTAURANTE', $_SESSION['LANGUAGE'])."</p></a>";
              }
              else
              {
                $html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=93618B36B30CED28828689B9234EC405'><p>".getLabel('LABEL_RESTAURANTE_ALACARTE', $_SESSION['LANGUAGE'])."</p></a>";
              }
			  
            } 
			else 
			{
				$html .= "<a class='LuadeMel_items trans02' href='{$dados_relevantes->SITE}/index.php?actionType=facilidades.servicos.view&coddica=93618B36B30CED28828689B9234EC405'><p>".getLabel('LABEL_RESTAURANTE_ALACARTE', $_SESSION['LANGUAGE'])."</p></a>";
			}
			*/
		
		$html .= "<a class='melhores-icon' href='{$dados_relevantes->SITE}/servicos-e-lazer'><span></span></a>";

	$html .= "</div>";



?>