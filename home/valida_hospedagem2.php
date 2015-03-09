<?php
	
	session_start();
	
	require("Connection.class.php");
	require("Reserva.class.php");
	require("lib.php");
	require("PesquisaReserva.class.php");
	
	$conn = new Connection();
	echo $dtainicio;
	$dtainicio = formataDataForUSA(trim($_POST["dtainicio"]));
	$dtafim = formataDataForUSA(trim($_POST["dtafim"]));
	$adulto = trim($_POST["adulto"]);
	$crianca = trim($_POST["crianca"]);
	$language = trim($_POST["language"]);
	$crianca0a5 = trim($_POST["crianca0a5"]);
	$crianca6a12 = trim($_POST["crianca6a12"]);
	$crianca12 = trim($_POST["crianca12"]);
	$codquartotipo = trim($_POST["codquartotipo"]);
	
	
	$pqrs = new PesquisaReserva( $dtainicio, $dtafim, $adulto, $crianca, $language, $crianca0a5, $crianca6a12, $crianca12, $codquartotipo );
	echo utf8_encode($pqrs->getTextos());
	
	$conn->close ();

?>


