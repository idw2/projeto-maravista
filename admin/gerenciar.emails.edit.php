<?php

	acessoDireto( "ADMINISTRADOR;" );			$row = mysql_query("SELECT * FROM central_emails WHERE CODCENTRALEMAILS='".$_GET["codcentralemails"]."'");			if( mysql_num_rows($row) != 0 )	{		$row = mysql_fetch_object($row);	}
	
	$erro = "";
	
	if ( !empty($_POST) && isset($_POST['ACTION']) ) 
	{
		$codcentralemails = $_GET["codcentralemails"];
		
		$titulo = trim( htmlentities( tratapost($_POST['titulo']) ) );
		$status = trim( tratapost($_POST['status']) );
		
		( $status == 'on' ) ? $status = 1 : $status = 0;
		mysql_query("UPDATE `central_emails` SET `TITULO`='$titulo', `STATUS`='$status' WHERE `CODCENTRALEMAILS`='$codcentralemails'");				
		echo "<script>alert('* ".getLabel('LABEL_EDIT_SUCESSO_LABEL', $_SESSION['LANGUAGE'])."!')</script>";
		echo "<script>window.location = 'index.php?actionType=gerenciar.emails';</script>";		exit();

	} 
	else 
	{
		$erro = getLabel('ERRO_PREENCHER_TODOS_CAMPOS', $_SESSION['LANGUAGE']);
	}
	
	$pi = "<form name='formCpf' method='post' action='index.php?actionType=gerenciar.emails.edit&codcentralemails=".$_GET["codcentralemails"]."'>";
		$pi .= "<div class='ErroMessage'>* $erro!</div>";
		$pi .= "<br/>";
		$pi .= "<div style='margin-bottom: 3px;'></div>";		
		$pi .= "<div class='EntradaTextForm'>";			if(!empty($_POST))
			{
				$pi .= "<input class='LiloginText' style='width: 250px' type='text' id='titulo' name='titulo' value='".$_POST['titulo']."' maxlength='70' placeholder='".getLabel('LABEL_TITULO', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<input class='LiloginText' style='width: 250px' type='text' id='titulo' name='titulo' value='$row->TITULO' maxlength='70' placeholder='".getLabel('LABEL_TITULO', $_SESSION['LANGUAGE'])."'/>";
			}		$pi .= "</div>";        		$pi .= "<div style='margin-bottom: 3px;'></div>";
		$pi .= "<div>";
			( $_POST['status'] == 'on' || $row->STATUS == '1' ) ? $pi .= "<input type='checkbox' name='status' checked='true'/> <span class='Userlabel'>".getLabel('LABEL_ATIVO_TEXT', $_SESSION['LANGUAGE'])."</span>" : $pi .= "<input type='checkbox' name='status'/> <span class='Userlabel'>".getLabel('LABEL_ATIVO_TEXT', $_SESSION['LANGUAGE'])."</span>";			
		$pi .= "</div>";		$pi .= "<div><br/></div>";
		$pi .="<div><input type='hidden' name='ACTION' value='ACTION'/></div>";
		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";
		
	
	$pi .= "</form>";
	
	$html .= getNavegacao($pi, getLabel('LABEL_EDIT_EMAIL', $_SESSION['LANGUAGE']));

?>
