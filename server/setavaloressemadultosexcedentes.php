<?php

	header("Content-Type: text/html; charset=ISO-8859-1");
	require_once("../server/Connection.class.php");
	require_once("../server/lib.php");

	$conn = new Connection();
	
	$quartos = mysql_query("SELECT VALOR FROM quartos WHERE CODQUARTO='".$_POST['CODQUARTO']."'");
	
	if(mysql_num_rows($quartos) != 0)
	{
		
		$quarto = mysql_fetch_object($quartos);
		$total = (int)limpaValorReal($_POST['TOTAL']);
		$valor = (int)limpaValorReal($quarto->VALOR);
		
		if($_POST['CALCULO'] == 'SOMAR')
		{			
			(int) $soma = ($total + $valor);	
			(string) $n = formataReais($soma);
			$ref = trim($_POST['CODQUARTO'].":$n");
		}
		else
		{
			(int) $soma = ($total - $valor);	
			(string) $n = formataReais($soma);
			$ref = trim($_POST['CODQUARTO'].":$n");
		}
	}
	else
	{
		$ref = trim($_POST['CODQUARTO'].":".$_POST['TOTAL']);
	}
	
	$conn->close ();
		
	print($ref);
	

?>