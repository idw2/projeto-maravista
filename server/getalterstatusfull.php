<?php

	header("Content-Type: text/html; charset=ISO-8859-1");
	require_once("../server/Connection.class.php");
	require_once("../server/lib.php");

	$conn = new Connection();
	
	$login = mysql_query("SELECT `$_POST[NOME_COLUNA]` FROM `$_POST[NOME_TABELA]` WHERE `$_POST[CHAVE]`='$_POST[CODIGO]'");
	$login = mysql_fetch_object($login);
	
	if($login->$_POST['NOME_COLUNA'])
	{
		mysql_query("UPDATE `$_POST[NOME_TABELA]` SET `$_POST[NOME_COLUNA]`='0' WHERE `$_POST[CHAVE]`='$_POST[CODIGO]'");
		$ref = trim("$_POST[LABEL]");
	}
	else
	{
		mysql_query("UPDATE `$_POST[NOME_TABELA]` SET `$_POST[NOME_COLUNA]`='1' WHERE `$_POST[CHAVE]`='$_POST[CODIGO]'");
		$ref = trim("$_POST[LABEL]");
	}
	
	
	$conn->close ();
		
	print($ref);
	

?>