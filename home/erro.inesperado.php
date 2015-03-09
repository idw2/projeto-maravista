<?php
        

      
    $html .= "<div id='corpo-cnt' style='position:relative'>";
	$html .= "<div id='corpo'>";
        $html .= "<div id='corpo-bg-l'></div>";
        $html .= "<div id='corpo-bg-r'></div>";
		
    $html .="<div class='container'>";
    
	$html .="<div class='fix_form col-xs-4' style='top: 0px;'></div>";
        
        $html .="<div class='col-xs-4'>";
        
            require("side.topicos.php");
            
        $html .= "</div>";
        
        $html .="<div class='pag_interna col-xs-8 right'>";
        
		
			$html .= "<div id='inline1' style='display: block;'>";
				$html .= "<p>";
					$html .= "<form id='formReserva' name='form1' method='post' novalidate action='index.php?actionType=reservas.forma.pgto.cielo'  style='max-width: initial'>";
							$html .= "<div class='ContainerAcomodacao pag-deposito'>";
								$html .= "<p>";
								$html .="<div class='sep-pattern-1'></div>";
									$html .="<center>";
										$html .="<h1 class='alert-green' style='font-size: 2.4rem;padding: 98px;'>";
											$html .= getLabel('LABEL_ERRO_VOLTAR_RESERVA', $_SESSION['LANGUAGE']);
										$html .="</h1>";
									$html .="</center>";
									$html .="<div class='sep-pattern-1'></div>";
								$html .= "</p>";
							$html .= "</div>";			
					$html .= "</form>";
				$html .= "</p>";
			$html .= "</div>";
                      
					  
					  
					  
        $html .= "</div>";
		
    $html .= "</div>"; 
    $html .= "</div>"; 
$html .= "</div>"; 
?>
