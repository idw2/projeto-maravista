<?php       	$html .= "<div id='corpo'>";		    $html .="<div class='container'>";    	$html .="<div class='fix_form col-xs-4' style='top: 0px;'></div>";                $html .="<div class='col-xs-4'>";                    require("side.topicos.php");                    $html .= "</div>";                $html .="<div class='pag_interna col-xs-8 right'>";        			$html .="<div class='pint_titulo Acomodacoes'>";					$html .= getLabel('LABEL_FACILIDADESESERVICOES', $_SESSION['LANGUAGE']);			$html .="</div>";                        									$facilidades_servicos = mysql_query("SELECT * FROM facilidades_servicos");										if( mysql_num_rows($facilidades_servicos) != 0 )			{				$facilidades_servicos = mysql_fetch_object($facilidades_servicos);				$html .= $facilidades_servicos->$_SESSION['LANGUAGE'];			}									        $html .= "</div>";		    $html .= "</div>"; $html .= "</div>"; ?>