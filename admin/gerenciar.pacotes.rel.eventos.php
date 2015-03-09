<?php


	acessoDireto( "ADMINISTRADOR;" );

	$erro = "";

	if ( !empty($_POST) && isset($_POST['ACTION']) ) 
	{
		
		mysql_query("DELETE FROM `pacotes_rel_eventos` WHERE `CODPACOTE`='".$_GET["codpacote"]."'");	
		
		foreach($_POST as $name => $value)
		{
			if(strlen($name) == 32)
			{
				mysql_query("INSERT INTO `pacotes_rel_eventos` (`CODPACOTE`,`CODEVENTO`)VALUES('".$_GET["codpacote"]."','".$name."')");	
			}	
		}
				
		echo "<script>alert('* ".getLabel('LABEL_ADD_SUCESSO_LABEL', $_SESSION['LANGUAGE'])."!')</script>";
		echo "<script>window.location = 'index.php?actionType=gerenciar.pacotes';</script>";
		exit();

	} 

	else 

	{

		$erro = getLabel('ERRO_PREENCHER_TODOS_CAMPOS', $_SESSION['LANGUAGE']);

	}
	
	$nom_extra = mysql_query("SELECT * FROM pacotes WHERE CODPACOTE='".$_GET['codpacote']."'");

	if(mysql_num_rows($nom_extra) != 0)

	{

		$nom_extra = mysql_fetch_object($nom_extra);

		$pi .= "<div class='TitleServName'><b>".getLabel('LABEL_NOM_PACOTE', $_SESSION['LANGUAGE']).":</b></div>";

		

		(string) $nome = getlinguagemdasessao();

		$pi .= "<div class='TitleServNameResult'>".$nom_extra->$nome."</div>";

		

	}

	

	$pi .= "<br/>";

	$pi .= "<div style='margin-bottom: 3px;'></div>";

	$pi .= "<form name='List' method='post' action='index.php?actionType=".$_GET["actionType"]."&codpacote=".$_GET["codpacote"]."'>";						

		

		$pi .= "<div class='MasterList'>";

		

			$pi .= "<table class='Tableinter'>";

				$pi .= "<tr>";

					

					$pi .= "<td valign='top'>";

						
						$result = mysql_query("SELECT 

						eventos.*,

						DATE_FORMAT( eventos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA

						FROM eventos

						WHERE STATUS=1
						
						ORDER BY (ORDEM+0) ASC

						");
						
						
						$pi .=  "<div class='separador'></div>";

						$pi .=  "<div>";

						$pi .= "<table class='Tableinter'>";

							$pi .=  "<tr id='adminTopTable'>";

								$pi .=  "

								<td></td>	
								
								<td>".getLabel('LABEL_TITULO', $_SESSION['LANGUAGE']).":</td>";

							$pi .=  "</tr>";

							

						$i = 0;

						while( $qtos_tipo = mysql_fetch_object( $result ) ) {



							

							if ( $i % 2 == 0 ) 

							{

								$pi.=  "<tr class='LinhaPar'>";

							} 

							else 

							{

								$pi.=  "<tr class='LinhaImpar'>";

							}
									$cheque = mysql_query("SELECT * FROM pacotes_rel_eventos WHERE CODPACOTE='".$_GET["codpacote"]."' AND CODEVENTO='".$qtos_tipo->CODEVENTO."'");
									
									if(mysql_num_rows($cheque) == 0)
									{
										$pi .= "<td align='right'><input type='checkbox' name='$qtos_tipo->CODEVENTO'/></td>";
									}
									else
									{
										$pi .= "<td align='right'><input type='checkbox' name='$qtos_tipo->CODEVENTO' checked='true'/></td>";
									}
									
									
									$pi .= "<td align='center'>".$qtos_tipo->$_SESSION["LANGUAGE"]."</td>";


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

