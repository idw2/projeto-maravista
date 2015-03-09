<?php
     
	$html .= "<div id='corpo'>";
      

    $html .="<div class='container'>";


        $html .="<div class='Backazul col-xs-4'>";
          $html .= "<div class='cont_reservas'>";
                require("reservas.form.php");
                $html .= "<br/>";    
                require("lua.mel.php");
          $html .= "</div>";    
        $html .="</div>";
		

        $html .="<div class='pag_interna col-xs-8 right'>";

			$html .= "<div id='inline1' style='display: block;'>";

				$html .= "<p>";

					$html .= "<form id='formReserva' name='form1' method='post' novalidate action='index.php?actionType=reservas.forma.pgto.cielo'>";

							$html .= "<div class='ContainerAcomodacao pag-deposito'>";
	
                                $html .= "<p>";
									
                                $html .="<div class='sep-pattern-1'></div>";
									
									$html .="<center>";
										
										$html .="<h1 class='alert-green'>";
											$html .= getLabel('LABEL_DTA_RESERVAS', $_SESSION['LANGUAGE']);
										$html .="</h1>";

									$html .="</center>";
									
									$html .="<div class='sep-pattern-1'></div>";
									
								$html .= "</p>";
								
                              
							$html .= "</div>";
							
							$html .= "<div><a class='BtnFiltro small full-width push-right' href='index.php?actionType=tarifas.promocoes'>".getLabel('LABEL_PACOTES', $_SESSION['LANGUAGE'])."</a></div>";
							
					$html .= "</form>";

				$html .= "</p>";

			$html .= "</div>";
			

        $html .= "</div>";

		

    $html .= "</div>"; 

$html .= "</div>";

?>
