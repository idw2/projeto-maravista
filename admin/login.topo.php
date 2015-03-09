<?php

	if( !empty($_POST['login']) && isset($_POST['ACTION']))
	{
		$login = $_POST['login'];
		$senha = strtoupper(md5($_POST['senha']));
		
		$exite_login = mysql_query("SELECT pessoa.*, login.* FROM login  INNER JOIN login_rel_pessoa ON login.CODLOGIN=login_rel_pessoa.CODLOGIN  INNER JOIN pessoa ON pessoa.CODPESSOA=login_rel_pessoa.CODPESSOA  WHERE login.LOGIN='$login' GROUP BY login.CODLOGIN");
		$exite_login = mysql_fetch_object($exite_login);
		
		if( isset($exite_login->LOGIN) == $login )
		{
			if( $exite_login->SENHA == $senha )
			{
			
				if( $exite_login->STATUS == "1")
				{
				
					foreach( $exite_login as $name => $value )
					{
						$_SESSION[$name] = $value;
					}
					
					/*$_SESSION["USUARIODASESSAO"] = 'ADMINISTRADOR';*/
					$link = explode("/home/", $_SERVER['REQUEST_URI']);
					/*echo "<script>window.location = '$link[1]'</script>";*/
					echo "<script>window.location = 'index.php?actionType=mypapers'</script>";
					exit();
					
				}
				else
				{
					$erro = "* ".getLabel('LABEL_USER_DESATIVADO', $_SESSION['LANGUAGE'])."!";	
				}
				
			}			
			else
			{
				$erro = "* ".getLabel('LABEL_SENHA_NAO_CONF', $_SESSION['LANGUAGE'])."!";
			}
		}
		else
		{
		
			//$erro = "* ".getLabel('LABEL_LOGIN_SENHA_NAO_CAD', $_SESSION['LANGUAGE'])."!";
		
		}
	
	
	}
	else
	{
		//$erro = "* ".getLabel('LABEL_INFORM_LOGIN_SENHA', $_SESSION['LANGUAGE'])."!";
	}
	
	if( isset($_SESSION['CODLOGIN']) != 32)
	{		
		$link = explode("/home/", $_SERVER['REQUEST_URI']);
		
		$html .= "<form name='Formlogin' id='Formlogin' method='post' action='$link[1]'>";					
			
			$html .= "<div class='Ullogin'>";
				
					if(!empty($_POST) && isset($_POST['ACTION']) )
					{
						$html .= "<label class='Lilabellogin'>".getLabel('LABEL_LOGIN', $_SESSION['LANGUAGE'])."</label>";
						$html .= "<div><input class='LiloginText' type='text' name='login' value='".$_POST['login']."'/></div>";
							
						$html .= "<label class='Lilabellogin'>".getLabel('LABEL_SENHA', $_SESSION['LANGUAGE'])."</label>";
						$html .= "<div><input class='LiloginText' type='password' name='senha' id='senha' value=''/></div>";
					}
					else
					{
						$html .= "<label class='Lilabellogin'>".getLabel('LABEL_LOGIN', $_SESSION['LANGUAGE'])."</label>";
						$html .= "<div><input class='LiloginText' type='text' name='login' value=''/></div>";
						
						$html .= "<label class='Lilabellogin'>".getLabel('LABEL_SENHA', $_SESSION['LANGUAGE'])."</label>";
						$html .= "<div><input class='LiloginText' type='password' name='senha' id='senha' value=''/></div>";
					}
					
					//$html .= "<div class='login-bottom'><input class='LiloginSubmit button ok' type='submit' value='".getLabel('LABEL_ENTRAR', $_SESSION['LANGUAGE'])."'/></div>";
                                        $html .= "<div class='login-bottom'><input class='LiloginSubmit button ok' type='submit' value='Entrar'/></div>";
					$html .= "<div><input type='hidden' name='ACTION' value='ACTION'/></div>";
					$html .= "<div class='LiloginError'>$erro</div>";
					
			$html .= "</div>";
			
			
			
		$html .= "</form>";					
	}
	else
	{
		$html .= "<div class='LoginUser'>";
			if(!empty($_SESSION['NOME']))
			{
				$nome = explode(" ", $_SESSION['NOME']);
				$html .= "<div class='LoginLabel'><span class='Seta'>››</span>$nome[0]</div>";
			}
			$html .= "<div class='LoginLabel'><span onclick=\"location='index.php?actionType=mypapers'\"><span class='Seta'>››</span>".getLabel('LABEL_GERENCIAMENTO', $_SESSION['LANGUAGE'])."</span></div>";
			$html .= "<div class='LoginLabel'><span onclick=\"location='index.php?actionType=logout'\"><span class='Seta'>››</span>".getLabel('LABEL_SAIR', $_SESSION['LANGUAGE'])."</span></div>";
			$html .= "<div class='ResetFloat'></div>";
		$html .= "</div>";
		
	}
			


?>
