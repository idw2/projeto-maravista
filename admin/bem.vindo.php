<?php

	$login  = mysql_query("SELECT 
	pessoa.NOME,  
	login.LOGIN 
	FROM login 
	INNER JOIN login_rel_pessoa ON login.CODLOGIN=login_rel_pessoa.CODLOGIN 
	INNER JOIN pessoa ON pessoa.CODPESSOA=login_rel_pessoa.CODPESSOA 
	WHERE login.CODLOGIN='".$_SESSION['CODLOGIN']."' GROUP BY login.CODLOGIN");
	
	$login  = mysql_fetch_object( $login );

	$pi = "";

	$pi .= "<ul class='BemVindo'>";
	
		$pi .= "<li><h3><div>".getLabel('LABEL_ALO', $_SESSION['LANGUAGE']).", $login->NOME! </div></h3></li>";
		
		$pi .= "<li><br/></li>";

		$pi .= "<li class='Exb'><h3>".getLabel('LABEL_DADOS_CONTA', $_SESSION['LANGUAGE'])."</h3></li>";

		$pi .= "<li class='Exb'><br/><b>".getLabel('LABEL_NAME', $_SESSION['LANGUAGE']).":</b> $login->NOME</li>";

		$pi .= "<li class='Exb'><br/><b>".getLabel('LABEL_LOGIN', $_SESSION['LANGUAGE']).":</b> $login->LOGIN</li>";

		$pi .= "<li><br/></li>";
		
		$pi .= "<li><div class='Exb2'>* ".getLabel('LABEL_BEM_VINDO_1', $_SESSION['LANGUAGE'])." $login->NOME ".getLabel('LABEL_POR_FAVOR', $_SESSION['LANGUAGE'])." <a href='index.php?actionType=logout' class='Exb'><b>".getLabel('LABEL_BEM_VINDO_2', $_SESSION['LANGUAGE'])."</b></a> ".getLabel('LABEL_BEM_VINDO_3', $_SESSION['LANGUAGE'])."!</div></li>";
		
	$pi .= "</ul>";
	

?>