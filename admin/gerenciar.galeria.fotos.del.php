<?php

	$query = mysql_query("SELECT * FROM fotos WHERE CODFOTO='".$_GET['codfoto']."'");

	$query = mysql_fetch_object($query);

	

	$folder = explode("/", $query->URL);

	$diretorio = "../upload/fotos/$folder[3]";

	if(is_file($query->URL))

	{

		@unlink($query->URL);

	}

	rmdir($diretorio);

	mysql_query("DELETE FROM fotos WHERE CODFOTO='".$_GET['codfoto']."'");
	mysql_query("DELETE FROM galerias_rel_fotos WHERE CODFOTO='".$_GET['codfoto']."' AND CODGALERIA='".$_GET['codgaleria']."'");

	echo "<script>alert('* ".getLabel('LABEL_DEL_IMAGE', $_SESSION['LANGUAGE'])."!')</script>";		

	echo "<script>window.location = 'index.php?actionType=gerenciar.galeria.fotos.list&codgaleria=".$_GET['codgaleria']."&codfoto=".$_GET['codfoto']."';</script>";		
	exit();
	

?>