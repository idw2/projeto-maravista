<?php



	acessoDireto( "ADMINISTRADOR;GUEST" );

	$erro = "";

	if ( !empty($_POST) && isset($_POST['ACTION']) ) 

	{

		

		$senha_atual = strtoupper( md5( $_POST['senha_atual'] ) );

		$senha = strtoupper( md5( $_POST['senha'] ) );

		$repetirsenha = strtoupper( md5( $_POST['repetirsenha'] ) );

		//$email = trim($_POST[email]); 

		

		$query = mysql_query("SELECT * FROM login WHERE CODLOGIN='$_SESSION[CODLOGIN]'");

		$existelogin = false;

		

		if ( mysql_num_rows($query) == 1 ) 

		{

			$existelogin = true;

			

		} 

		

		if ($existelogin)

		{

			$query = mysql_fetch_object($query);

			

			if($senha_atual != $query->SENHA)

			{

				$erro = "<br/>* A <b>\"Senha atual\"</b> informada n„o confere!";

			}			

			elseif ( $_POST['senha'] == "" && $erro == "" ) 

			{

				$erro = "<br/>* <b>\"Senha\"</b> deve ser preenchida!";

			} 

			elseif ( $_POST['repetirsenha'] == "" && $erro == "" ) 

			{

				$erro = "<br/>* <b>\"Repetir senha\"</b> deve ser preenchida!";

			} 

			elseif ( $repetirsenha != $senha && $erro == '' ) 

			{

				$erro = "<br/>* <b>\"Senhas\"</b> diferentes!";

			}

			/*elseif ( ( substr_count( $email, ".") == 0 || substr_count( $email, "@") != 1 ) && $erro == "" ) 

			{

				$erro = "<br/>* Formato de <b>\"E-mail\"</b> inv·lido!";

				

			}*/

			else

			{

				$_SESSION['SENHA'] = $senha;

				//$_SESSION[EMAIL] = $email;

				

				mysql_query("UPDATE login SET SENHA='$senha' WHERE CODLOGIN='$_SESSION[CODLOGIN]'");

				

				echo "<script>alert('* Sua senha foi atualizada com sucesso!')</script>";

				echo "<script>window.location = 'index.php?actionType=bem.vindo';</script>";

			}

			

		}

		

	} 

	else 

	{

		$erro = getLabel('ERRO_PREENCHER_TODOS_CAMPOS', $_SESSION['LANGUAGE']);

	}

	

	$pi = "<form name='formCpf' method='post' action='index.php?actionType=alterar.senha'>";

	

		$pi .= "<div class='ErroMessage'>$erro</div>";

		$pi .= "<br/>";

		$pi .= "<div class='Separador'></div>";

		$pi .= "<div class='Userlabel'>".getLabel('LABEL_NAME', $_SESSION['LANGUAGE']).":</div>";

		$pi .= "<div class='EntradaTextForm'>$_SESSION[NOME]</div>";

		$pi .= "<div class='Userlabel' style='margin-top:12px'>".getLabel('LABEL_LOGIN', $_SESSION['LANGUAGE']).":</div>";

		$pi .= "<div class='EntradaTextForm'>$_SESSION[LOGIN]</div>";

		$pi .= "<div class='Userlabel'><br/></div>";

		$pi .= "<div class='EntradaTextForm'><input class='LiloginText' style='width: 250px' type='password' name='senha_atual' value='' maxlength='40' placeholder='".getLabel('LABEL_SENHA', $_SESSION['LANGUAGE'])."'/></div>";

		$pi .= "<div class='EntradaTextForm'><input class='LiloginText' style='width: 250px' type='password' name='senha' value='' maxlength='40' placeholder='".getLabel('LABEL_SENHA_NOVA', $_SESSION['LANGUAGE'])."'/></div>";

		$pi .= "<div class='EntradaTextForm'><input class='LiloginText' style='width: 250px' type='password' name='repetirsenha' value='' maxlength='40' placeholder='".getLabel('LABEL_REPETIR_SENHA', $_SESSION['LANGUAGE'])."'/></div>";
		
		$pi .= "<div class='EntradaTextForm'><input type='hidden' name='ACTION' value='ACTION'/></div>";

		$pi .= "<div class='Separador'></div>";
		$pi .="<div><input type='hidden' name='ACTION' value='ACTION'/></div>";
		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";

		$pi .= "<div><br/></div>";

	

	$pi .= "</form>";

?>