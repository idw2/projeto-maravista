<?php
	
	session_start();
	
	require("Connection.class.php");
	require("Reserva.class.php");
	require("lib.php");
	require("PesquisaReserva.class.php");
	
	$conn = new Connection();

	$dtainicio = trim($_POST["dtainicio"]);
	$dtafim = trim($_POST["dtafim"]);
	$adulto = trim($_POST["adulto"]);
	$crianca = trim($_POST["crianca"]);
	
	if( (int)$crianca == 0 )
	{
		//echo "NAO_EXISTE_CRIANCA";
	}
	else
	{
		echo "EXISTE_CRIANCA"; 
	}
	
	$conn->close ();

?>


