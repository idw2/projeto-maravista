<?php	acessoDireto( "ADMINISTRADOR;" );		$row = mysql_query("SELECT * FROM  cielo");	if(mysql_num_rows($row) == 1 )	{		$row = mysql_fetch_object($row);			}		$erro = "";		if ( !empty($_POST) && isset($_POST['ACTION']) ) 	{						$numero = trim( stripslashes( tratapost($_POST['numero']) ) );		$chave = trim( stripslashes( tratapost($_POST['chave']) ) );		$url = trim( stripslashes( tratapost($_POST['url']) ) );		mysql_query("UPDATE `cielo` SET `CIELO_NUMERO`='$numero', `CIELO_CHAVE`='$chave',`CIELO_URL`='$url'");					echo "<script>alert('* ".getLabel('LABEL_EDIT_SUCESSO_LABEL', $_SESSION['LANGUAGE'])."!')</script>";		echo "<script>window.location = 'index.php?actionType=gerenciar.cielo';</script>";	} 	else 	{		$erro = getLabel('ERRO_PREENCHER_TODOS_CAMPOS', $_SESSION['LANGUAGE']);	}		$pi = "<form name='formCpf' method='post' action='index.php?actionType=gerenciar.cielo'>";		$pi .= "<div class='ErroMessage'>* $erro!</div>";		$pi .= "<br/>";		$pi .= "<div style='margin-bottom: 3px;'></div>";		$pi .= "<div class='Userlabel'>".getLabel('N&uacute;mero', $_SESSION['LANGUAGE']).":</div>";		$pi .= "<div class='EntradaTextForm'>";			if(!empty($_POST) && isset($_POST['ACTION']) )			{				$pi .= "<input class='LiloginText' style='width: 250px' type='text' id='numero' name='numero' value='".$_POST['numero']."' placeholder='".getLabel('Cielo n˙mero', $_SESSION['LANGUAGE'])."'/>";			}			else			{				$pi .= "<input class='LiloginText' style='width: 250px' type='text' id='numero' name='numero' value='$row->CIELO_NUMERO' placeholder='".getLabel('Cielo n˙mero', $_SESSION['LANGUAGE'])."'/>";			}		$pi .= "</div>";				$pi .= "<div style='margin-bottom: 3px;'></div>";		$pi .= "<div class='Userlabel'>".getLabel('Chave', $_SESSION['LANGUAGE']).":</div>";		$pi .= "<div class='EntradaTextForm'>";			if(!empty($_POST) && isset($_POST['ACTION']) )			{				$pi .= "<input class='LiloginText' style='width: 250px' type='text' id='chave' name='chave' value='".$_POST['chave']."' placeholder='".getLabel('Cielo chave', $_SESSION['LANGUAGE'])."'/>";			}			else			{				$pi .= "<input class='LiloginText' style='width: 250px' type='text' id='chave' name='chave' value='$row->CIELO_CHAVE' placeholder='".getLabel('Cielo chave', $_SESSION['LANGUAGE'])."'/>";			}		$pi .= "</div>";				$pi .= "<div style='margin-bottom: 3px;'></div>";		$pi .= "<div class='Userlabel'>".getLabel('URL', $_SESSION['LANGUAGE']).":</div>";		$pi .= "<div class='EntradaTextForm'>";			if(!empty($_POST) && isset($_POST['ACTION']) )			{				$pi .= "<input class='LiloginText' style='width: 250px' type='text' id='url' name='url' value='".$_POST['url']."' placeholder='".getLabel('Cielo URL', $_SESSION['LANGUAGE'])."'/>";			}			else			{				$pi .= "<input class='LiloginText' style='width: 250px' type='text' id='url' name='url' value='$row->CIELO_URL' placeholder='".getLabel('Cielo URL', $_SESSION['LANGUAGE'])."'/>";			}		$pi .= "</div>";					$pi .= "<div style='margin-bottom: 3px;'></div>";				$pi .= "<div><br/></div>";		$pi .="<div><input type='hidden' name='ACTION' value='ACTION'/></div>";		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";		$pi .= "</form>";?>