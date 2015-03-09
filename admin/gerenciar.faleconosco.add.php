<?php

	acessoDireto( "ADMINISTRADOR;" );
	
	$erro = "";
	
	if ( $_POST ) {
		
		$codfaleconosco  = strtoupper( md5( getTimestamp() ) );
		$portugues = trim( htmlentities( $_POST["PORTUGUES"] ) );
		$ingles = trim( htmlentities( $_POST["INGLES"] ) );
		$espanhol = trim( htmlentities( $_POST["ESPANHOL"] ) );
		$departamento_portugues = trim( htmlentities( $_POST["DEPARTAMENTO_PORTUGUES"] ) );
		$departamento_ingles = trim( htmlentities( $_POST["DEPARTAMENTO_INGLES"] ) );
		$departamento_espanhol = trim( htmlentities( $_POST["DEPARTAMENTO_ESPANHOL"] ) );
		$email = trim( $_POST["email"] );
		$status = trim( $_POST["status"] );
		( $status == 'on' ) ? $status = 1 : $status = 0;
				
		if ( $portugues == "" || $ingles == "" || $espanhol == "" && $erro == "" ) 
		{
			$erro = "<br/>* Titulo requerido!";
		} 
		elseif ( $departamento_portugues == "" || $departamento_ingles == "" || $departamento_espanhol == "" && $erro == "" ) 
		{
			$erro = "<br/>* Departamento requerido!";
		} 
		elseif ( ( substr_count( $email, ".") == 0 || substr_count( $email, "@") != 1 ) && $erro == "" ) 
		{
				$erro = "<br/>* Formato de <b>\"E-mail\"</b> inválido!";
		} 
		
		if ( $erro == "" ) 
		{
			
			mysql_query("INSERT INTO `faleconosco` (`CODFALECONOSCO`,`PORTUGUES`,`INGLES`,`ESPANHOL`,`DEPARTAMENTO_PORTUGUES`,`DEPARTAMENTO_INGLES`,`DEPARTAMENTO_ESPANHOL`,`EMAIL`,`OWNER`,`STATUS`)VALUES('".$codfaleconosco."','".$portugues."','".$ingles."','".$espanhol."','".$departamento_portugues."','".$departamento_ingles."','".$departamento_espanhol."','".$email."','".$_SESSION["LOGIN"]."','".$status."')");			

			echo "<script>alert('* Fale conosco criado com sucesso!')</script>";
			echo "<script>window.location = 'index.php?actionType=gerenciar.faleconosco';</script>";
			exit();
		} 		
	} 
	else 
	{
		$erro = "* Preencha todos os campos!";
	}
	
	$pi .= "<form name='formCpf' method='post' action='index.php?actionType=gerenciar.faleconosco.add'>";
			
		$pi .= "<div class='ErroMessage'>".$erro."</div>";
		$pi .= "<br/>";
	
		$pi .= "<div>".getLabel('LABEL_TITULO', $_SESSION['LANGUAGE'])."</div>";
		$pi .= "<div class='EntradaTextForm'>";
			$pi .= "<input class='LiloginText' type='text' id='titulo' name='PORTUGUES' value='".$_POST["PORTUGUES"]."' maxlength='70' placeholder='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."'/>";
		$pi .= "</div>";
		
		$pi .= "<div class='EntradaTextForm'>";
			$pi .= "<input class='LiloginText' type='text' id='titulo' name='INGLES' value='".$_POST["INGLES"]."' maxlength='70' placeholder='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."'/>";
		$pi .= "</div>";
		
		$pi .= "<div class='EntradaTextForm'>";
			$pi .= "<input class='LiloginText' type='text' id='titulo' name='ESPANHOL' value='".$_POST[ESPANHOL]."' maxlength='70' placeholder='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."'/>";
		$pi .= "</div>";
	
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		$pi .= "<div>".getLabel('LABEL_DEPARTAMENTO', $_SESSION['LANGUAGE'])."</div>";
		
		$pi .= "<div class='EntradaTextForm'>";
			$pi .= "<input class='LiloginText' type='text' id='DEPARTAMENTO_PORTUGUES' name='DEPARTAMENTO_PORTUGUES' value='".$_POST["DEPARTAMENTO_PORTUGUES"]."' maxlength='70' placeholder='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."'/>";
		$pi .= "</div>";
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		$pi .= "<div class='EntradaTextForm'>";
			$pi .= "<input class='LiloginText' type='text' id='DEPARTAMENTO_INGLES' name='DEPARTAMENTO_INGLES' value='".$_POST["DEPARTAMENTO_INGLES"]."' maxlength='70' placeholder='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."'/>";
		$pi .= "</div>";
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		$pi .= "<div class='EntradaTextForm'>";
			$pi .= "<input class='LiloginText' type='text' id='DEPARTAMENTO_ESPANHOL' name='DEPARTAMENTO_ESPANHOL' value='".$_POST["DEPARTAMENTO_ESPANHOL"]."' maxlength='70' placeholder='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."'/>";
		$pi .= "</div>";
	
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		
		$pi .= "<div class='EntradaTextForm'>";
			$pi .= "<input class='LiloginText' type='text' id='email' name='email' value='$_POST[email]' maxlength='70' onchange='caixaBaixa(this.id)' onkeypress='caixaBaixa(this.id)' placeholder='E-mail...'/>";
		$pi .= "</div>";
		
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		
		$pi .= "<div class='EntradaTextForm'>";
			( $_POST["status"] == 'on' ) 
			? $pi .= "<input type='checkbox' name='status' checked='true'/> <span class='Userlabel'>".getLabel("Ativo", $_SESSION['LANGUAGE'])."</span>" 
			: $pi .= "<input type='checkbox' name='status'/> <span class='Userlabel'>".getLabel("Ativo", $_SESSION['LANGUAGE'])."</span>";
		$pi .= "</div>";
		
		$pi .= "<div><br/></div>";
		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";
		$pi .= "<div><br/></div>";
	
	$pi .= "</form>";
	
	$html .= getNavegacao($pi, getLabel('LABEL_GER_FALECONOSCO_ADD', $_SESSION['LANGUAGE']));

?>
