<?php

	header("Content-Type: text/html; charset=ISO-8859-1");
	require_once("../server/Connection.class.php");
	require_once("../server/lib.php");

	$conn = new Connection();
	
	mysql_query("UPDATE $_POST[NOME_TABELA] AS f
	INNER JOIN $_POST[TABLE_REFERENCIA] AS drf ON f.$_POST[CHAVE]=drf.$_POST[CHAVE]
	SET
	f.$_POST[NOME_COLUNA]='0'
	WHERE f.$_POST[CHAVE] IN (SELECT $_POST[CHAVE] FROM `$_POST[TABLE_REFERENCIA]` WHERE `$_POST[REFERENCIA]`='$_POST[COD_REFERENCIA]')");
	
	mysql_query("UPDATE `$_POST[NOME_TABELA]` SET `$_POST[NOME_COLUNA]`='1' WHERE `$_POST[CHAVE]`='$_POST[CODIGO]'");
	
	$ref = trim("$_POST[LABEL]");
	
	$conn->close ();
		
	print($ref);
	

?>