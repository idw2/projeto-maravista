<?php

	acessoDireto( "ADMINISTRADOR;" );
	
	$row = mysql_query("SELECT * FROM faleconosco WHERE CODFALECONOSCO='$_GET[codfaleconosco]'");
	
	if(mysql_num_rows($row) != 0)
	{
		$row = mysql_fetch_object($row);
	}
	
	$erro = "";
	
	if ( $_POST ) {
		
		$codfaleconosco  = $_GET["codfaleconosco"];
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
				$erro = "<br/>* Formato de <b>\"E-mail\"</b> inv·lido!";
		} 
		
		if ( $erro == "" ) 
		{
			
			mysql_query("UPDATE `faleconosco` SET `PORTUGUES`='".$portugues."',`INGLES`='".$ingles."',`ESPANHOL`='".$espanhol."',`DEPARTAMENTO_PORTUGUES`='".$departamento_portugues."',`DEPARTAMENTO_INGLES`='".$departamento_ingles."',`DEPARTAMENTO_ESPANHOL`='".$departamento_espanhol."',`EMAIL`='".$email."',`OWNER`='".$_SESSION["LOGIN"]."',`STATUS`=".$status." WHERE `CODFALECONOSCO`='".$codfaleconosco."'");			
			
			echo "<script>alert('* Fale conosco atualizado com sucesso!')</script>";
			echo "<script>window.location = 'index.php?actionType=gerenciar.faleconosco';</script>";
			exit();
		} 		
	} 
	else 
	{
		$erro = "* Preencha todos os campos!";
	}
	
	$pi .= "<form name='formCpf' method='post' action='index.php?actionType=gerenciar.faleconosco.edit&codfaleconosco=$_GET[codfaleconosco]'>";
			
		$pi .= "<div class='ErroMessage'>".$erro."</div>";
		$pi .= "<br/>";
	
		$pi .= "<div>".getLabel('LABEL_TITULO', $_SESSION['LANGUAGE'])."</div>";
		$pi .= "<div class='EntradaTextForm'>";
			if($_POST["PORTUGUES"] != "" )
			{
				$pi .= "<input class='LiloginText' type='text' id='PORTUGUES' name='PORTUGUES' value='".$_POST["PORTUGUES"]."' maxlength='70' placeholder='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<input class='LiloginText' type='text' id='PORTUGUES' name='PORTUGUES' value='".$row->PORTUGUES."' maxlength='70' placeholder='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."'/>";
			}
		$pi .= "</div>";
		
		$pi .= "<div class='EntradaTextForm'>";
			if($_POST["INGLES"] != "" )
			{
				$pi .= "<input class='LiloginText' type='text' id='INGLES' name='INGLES' value='".$_POST["INGLES"]."' maxlength='70' placeholder='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<input class='LiloginText' type='text' id='INGLES' name='INGLES' value='".$row->INGLES."' maxlength='70' placeholder='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."'/>";
			}
		$pi .= "</div>";
		
		$pi .= "<div class='EntradaTextForm'>";
			if($_POST["ESPANHOL"] != "" )
			{
				$pi .= "<input class='LiloginText' type='text' id='ESPANHOL' name='ESPANHOL' value='".$_POST["ESPANHOL"]."' maxlength='70' placeholder='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<input class='LiloginText' type='text' id='ESPANHOL' name='ESPANHOL' value='".$row->ESPANHOL."' maxlength='70' placeholder='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."'/>";
			}
		$pi .= "</div>";
		
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		$pi .= "<div>".getLabel('LABEL_DEPARTAMENTO', $_SESSION['LANGUAGE'])."</div>";
		$pi .= "<div class='EntradaTextForm'>";
			if($_POST["DEPARTAMENTO_PORTUGUES"] != "" )
			{
				$pi .= "<input class='LiloginText' type='text' id='DEPARTAMENTO_PORTUGUES' name='DEPARTAMENTO_PORTUGUES' value='".$_POST["DEPARTAMENTO_PORTUGUES"]."' maxlength='70' placeholder='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<input class='LiloginText' type='text' id='DEPARTAMENTO_PORTUGUES' name='DEPARTAMENTO_PORTUGUES' value='".$row->DEPARTAMENTO_PORTUGUES."' maxlength='70' placeholder='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."'/>";
			}
		$pi .= "</div>";
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		$pi .= "<div class='EntradaTextForm'>";
			if($_POST["DEPARTAMENTO_INGLES"] != "" )
			{
				$pi .= "<input class='LiloginText' type='text' id='DEPARTAMENTO_INGLES' name='DEPARTAMENTO_INGLES' value='".$_POST["DEPARTAMENTO_INGLES"]."' maxlength='70' placeholder='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<input class='LiloginText' type='text' id='DEPARTAMENTO_INGLES' name='DEPARTAMENTO_INGLES' value='".$row->DEPARTAMENTO_INGLES."' maxlength='70' placeholder='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."'/>";
			}
		$pi .= "</div>";
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		$pi .= "<div class='EntradaTextForm'>";
			if($_POST["DEPARTAMENTO_ESPANHOL"] != "" )
			{
				$pi .= "<input class='LiloginText' type='text' id='DEPARTAMENTO_ESPANHOL' name='DEPARTAMENTO_ESPANHOL' value='".$_POST["DEPARTAMENTO_ESPANHOL"]."' maxlength='70' placeholder='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<input class='LiloginText' type='text' id='DEPARTAMENTO_ESPANHOL' name='DEPARTAMENTO_ESPANHOL' value='".$row->DEPARTAMENTO_ESPANHOL."' maxlength='70' placeholder='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."'/>";
			}
		$pi .= "</div>";
		$pi .= "<div style='margin-bottom: 3px;'></div>";
	
		$pi .= "<div class='EntradaTextForm'>";
			if($_POST["email"] != "" )
			{
				$pi .= "<input class='LiloginText' type='text' id='email' name='email' value='".$_POST["email"]."' maxlength='70' onchange='caixaBaixa(this.id)' onkeypress='caixaBaixa(this.id)' placeholder='E-mail...'/>";
			}
			else
			{
				$pi .= "<input class='LiloginText' type='text' id='email' name='email' value='".$row->EMAIL."' maxlength='70' onchange='caixaBaixa(this.id)' onkeypress='caixaBaixa(this.id)' placeholder='E-mail...'/>";
			}
		$pi .= "</div>";
		
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		
		$pi .= "<div class='EntradaTextForm'>";
			( $_POST["status"] == 'on' || $row->STATUS ) 
			? $pi .= "<input type='checkbox' name='status' checked='true'/> <span class='Userlabel'>".getLabel("Ativo", $_SESSION['LANGUAGE'])."</span>" 
			: $pi .= "<input type='checkbox' name='status'/> <span class='Userlabel'>".getLabel("Ativo", $_SESSION['LANGUAGE'])."</span>";
		$pi .= "</div>";
		
		$pi .= "<div><br/></div>";
		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";
		$pi .= "<div><br/></div>";
	
	$pi .= "</form>";
	
?>
