<?php	$row = mysql_query("SELECT * FROM eventos WHERE CODEVENTO='".$_GET['codevento']."'");		if(mysql_num_rows($row) != 0)	{		$row = mysql_fetch_object($row);	}		acessoDireto( "ADMINISTRADOR;" );		$erro = "";		if ( !empty($_POST) && isset($_POST['ACTION']) ) 	{		$codevento = $_GET['codevento'];				$ingles = trim( htmlentities( tratapost($_POST['ingles']) ) );		$espanhol = trim( htmlentities( tratapost($_POST['espanhol']) ) );		$portugues = trim( htmlentities( tratapost($_POST['portugues']) ) );				$ingles = str_replace("'", '&lsquo;', $ingles);		$espanhol = str_replace("'", '&lsquo;', $espanhol);		$portugues = str_replace("'", '&lsquo;', $portugues);			$status = trim( tratapost($_POST['status']) );				( $status == 'on' ) ? $status = 1 : $status = 0;		mysql_query("UPDATE `eventos` SET `INGLES`='$ingles', `PORTUGUES`='$portugues', `ESPANHOL`='$espanhol', `STATUS`='$status' WHERE `CODEVENTO`='$codevento'");		echo "<script>alert('* ".getLabel('LABEL_EDIT_SUCESSO_LABEL', $_SESSION['LANGUAGE'])."!')</script>";		echo "<script>window.location = 'index.php?actionType=gerenciar.eventos';</script>";		exit();	} 	else 	{		$erro = getLabel('ERRO_PREENCHER_TODOS_CAMPOS', $_SESSION['LANGUAGE']);	}		$pi = "<form name='formCpf' method='post' action='index.php?actionType=gerenciar.eventos.edit&codevento=".$_GET['codevento']."'>";		$pi .= "<div class='ErroMessage'>* $erro!</div>";		$pi .= "<br/>";		$pi .= "<div style='margin-bottom: 3px;'></div>";				$pi .= "<div style='margin-bottom: 3px;'></div>";		$pi .= "<div class='EntradaTextForm'>";			if(!empty($_POST) && isset($_POST['ACTION']) )			{				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='ingles' name='ingles' value='".$_POST['ingles']."' maxlength='70' placeholder='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."'/>";			}			else			{				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='ingles' name='ingles' value='$row->INGLES' maxlength='70' placeholder='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."'/>";			}		$pi .= "</div>";				$pi .= "<div style='margin-bottom: 3px;'></div>";		$pi .= "<div class='EntradaTextForm'>";			if(!empty($_POST) && isset($_POST['ACTION']) )			{				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='espanhol' name='espanhol' value='".$_POST['espanhol']."' maxlength='70' placeholder='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."'/>";			}			else			{				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='espanhol' name='espanhol' value='$row->ESPANHOL' maxlength='70' placeholder='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."'/>";			}		$pi .= "</div>";				$pi .= "<div style='margin-bottom: 3px;'></div>";		$pi .= "<div class='EntradaTextForm'>";			if(!empty($_POST) && isset($_POST['ACTION']) )			{				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='portugues' name='portugues' value='".$_POST['portugues']."' maxlength='70' placeholder='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."'/>";			}			else			{				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='portugues' name='portugues' value='$row->PORTUGUES' maxlength='70' placeholder='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."'/>";			}		$pi .= "</div>";				$pi .= "<div style='margin-bottom: 3px;'></div>";		$pi .= "<div>";			if(!empty($_POST) && isset($_POST['ACTION']) )			{				( $_POST['status'] == 'on' ) ? $pi .= "<input type='checkbox' name='status' checked='true'/> <span class='Userlabel'>".getLabel('LABEL_ATIVO_TEXT', $_SESSION['LANGUAGE'])."</span>" : $pi .= "<input type='checkbox' name='status'/> <span class='Userlabel'>".getLabel('LABEL_ATIVO_TEXT', $_SESSION['LANGUAGE'])."</span>";			}			else			{				( $row->STATUS == '1' ) ? $pi .= "<input type='checkbox' name='status' checked='true'/> <span class='Userlabel'>".getLabel('LABEL_ATIVO_TEXT', $_SESSION['LANGUAGE'])."</span>" : $pi .= "<input type='checkbox' name='status'/> <span class='Userlabel'>".getLabel('LABEL_ATIVO_TEXT', $_SESSION['LANGUAGE'])."</span>";			}		$pi .= "</div>";				$pi .= "<div><br/></div>";		$pi .="<div><input type='hidden' name='ACTION' value='ACTION'/></div>";		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";		$pi .= "</form>";     ?>