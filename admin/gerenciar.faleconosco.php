<?php

	acessoDireto( "ADMINISTRADOR" );
	
	if($_POST[ACTION] == 'ACTION')
	{
	
		foreach( $_POST as $name => $value)
		{
			
			if( substr_count( $name, '_') == 1 )
			{
				$key = str_replace("_", "", $name);
				mysql_query("UPDATE faleconosco SET ORDEM='$value' WHERE CODFALECONOSCO='$key'");
			}
			
		}
	
	}
	
	$pi .= "<form name='List' method='post' action='index.php?actionType=gerenciar.faleconosco' enctype='multipart/form-data'>";								
		$pi .= "<div>";
			$pi .= "<div><br/></div>";
			
			$pi .= "<div style='float: left; cursor: pointer; margin-right: 5px;' onclick=\"location = 'index.php?actionType=gerenciar.faleconosco.add'\" title='".getLabel('LABEL_ADICIONAR', $_SESSION['LANGUAGE'])."'><span class='BtnProprio'>".getLabel('LABEL_ADICIONAR', $_SESSION['LANGUAGE'])."</span></div>";
			$pi .= "<div style='float: left; cursor: pointer; margin-right: 5px;' onclick=\"url('gerenciar.faleconosco.edit', '', '".getLabel('LABEL_JS_MAIS_DE_UM', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_JS_NENHUM', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_JS_UPDATE', $_SESSION['LANGUAGE'])."')\"  title='".getLabel('LABEL_EDITAR', $_SESSION['LANGUAGE'])."'><span class='BtnProprio'>".getLabel('LABEL_EDITAR', $_SESSION['LANGUAGE'])."</span></div>";
			
			$pi .= "<div class='ResetFloat'></div>";
			$pi .= "<div class='MasterList'>";
			
				$pi .= "<table class='Tableinter'>";
				$pi .= "<tr>";
					
					$pi .= "<td valign='top'>";
					
						$result = mysql_query("SELECT faleconosco.*, DATE_FORMAT( faleconosco.DTA, '%d/%m/%Y - %Hh%imin.' ) as `DTA` FROM `faleconosco` ORDER BY (ORDEM+0) ASC");
	
						$pi .=  "<div class='separador'></div>";
						
						$pi .=  "<div>";
						$pi .= "<table class='Tableinter'>";
							$pi .=  "<tr id='adminTopTable'>";
								$pi .=  "<td style='width: 10px;'></td>
								<td>".getLabel('LABEL_DTA_CADASTRO', $_SESSION['LANGUAGE']).":</td>
								<td>".getLabel('LABEL_TITULO', $_SESSION['LANGUAGE']).":</td>
								<td>".getLabel('LABEL_DEPARTAMENTO', $_SESSION['LANGUAGE']).":</td>
								<td>".getLabel('LABEL_EMAIL', $_SESSION['LANGUAGE']).":</td>
								<td>".getLabel('LABEL_ORDEM', $_SESSION['LANGUAGE']).":</td>
								<td>".getLabel('LABEL_SITUACAO', $_SESSION['LANGUAGE']).":</td>";
						$pi .=  "</tr>";
						
						$i = 0;
						while( $faleconosco = mysql_fetch_object( $result ) ) 
						{
						
							if ( $faleconosco->STATUS == "1" ) 
							{
								$status = "<span style='cursor: pointer' onclick=\"javascript:getAlterstatusfull('$faleconosco->CODFALECONOSCO', 'CODFALECONOSCO', 'STATUS', 'faleconosco', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\"><img src='../image/CommentStarOn.gif' border='0' alt='Estrela'/></span>";
							} 
							else 
							{
								$status = "<span style='cursor: pointer' onclick=\"javascript:getAlterstatusfull('$faleconosco->CODFALECONOSCO', 'CODFALECONOSCO', 'STATUS', 'faleconosco', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\"><img src='../image/CommentStarOff.gif' border='0' alt='Estrela'/></span>";
							}
							
							if ( $i % 2 == 0 ) 
							{
								$pi.=  "<tr style='background: #d6ecfa'>";
							} 
							else 
							{
								$pi.=  "<tr style='background: #fff'>";
							}
									$pi .= "<td align='right'><input type='checkbox' name='".$faleconosco->CODFALECONOSCO."'/></td>";
									$pi .= "<td>".$faleconosco->DTA."</td>";
									$pi .= "<td>".$faleconosco->$_SESSION["LANGUAGE"]."</td>";
									$departamento = "DEPARTAMENTO_".$_SESSION["LANGUAGE"];
									$pi .= "<td>".$faleconosco->$departamento."</td>";
									$pi .= "<td>".$faleconosco->EMAIL."</td>";
									$pi .= "<td><input type='text' name='_".$faleconosco->CODFALECONOSCO."' value='".$faleconosco->ORDEM."' style='width: 20px' maxlength='3' onkeypress='return formataNumDV(event, this, 3);'/></td>";
									$pi .= "<td align='center'>".$status."</td>";
								$pi .=  "</tr>";
							
							$i++;
						
						}
							
						$pi .=  "</table>";
						$pi .=  "</div>";
					
					$pi .= "</td>";
					
				$pi .= "</tr>";
			$pi .= "</table>";

		$pi .= "</div>";
		$pi .="<div><input type='hidden' value='ACTION' name='ACTION'/></div>";
		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";
	$pi .= "</form>";

?>