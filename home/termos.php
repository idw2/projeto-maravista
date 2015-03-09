<?php
       
      
      $html .= "<div id='corpo-cnt' style='position:relative'>";
	$html .= "<div id='corpo' class='pag_reserva'>";
        $html .= "<div id='corpo-bg-l'></div>";
        $html .= "<div id='corpo-bg-r'></div>";

		
    $html .="<div class='container'>";
    
	$html .="<div class='fix_form col-xs-4' style='top: 0px;'></div>";
        
        $html .="<div class='col-xs-4'>";

			require("side.topicos.php");

		$html .= "</div>";
        
        $html .="<div class='pag_interna col-xs-8 right'>";
        
			$html .="<div class='pint_titulo Acomodacoes'>";
					$html .= getLabel('LABEL_TERMOS', $_SESSION['LANGUAGE']);
			$html .="</div>";

			
			$html .= "<p class='Inittermo'>";
				
				$termos = mysql_query("SELECT * FROM termos WHERE IDIOMA='".$_SESSION['LANGUAGE']."'");	
							
				if(mysql_num_rows($termos) != 0) 
				{

					while($termo = mysql_fetch_object($termos))
					{
						$html .= "<div class='Termosservice'>$termo->CONTEUDO</div>";
					}
				}
			$html .= "</p>";
			
        $html .= "</div>";
		
    $html .= "</div>"; 
$html .= "</div>"; 
$html .= "</div>"; 
?>
