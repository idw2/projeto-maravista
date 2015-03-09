<?php
	
	$papel = explode( ";", $_SESSION["PAPEL"] );
	
	if ( isset($_POST) && !empty($_POST['USUARIODASESSAO']) ) {			
		$_SESSION["USUARIODASESSAO"] = trim($_POST["USUARIODASESSAO"]);
		echo "<script>window.location='index.php?actionType=bem.vindo'</script>";		exit();
	}
	
	
	foreach ( $papel as $value ) 
	{
	
		if ( trim( $value ) == 'ADMINISTRADOR') 		{
			
			$_SESSION["USUARIODASESSAO"] = 'ADMINISTRADOR';
		    echo "<script>window.location='index.php?actionType=bem.vindo'</script>";
			exit();
		}		elseif ( trim( $value ) == 'GUEST') 		{
			$_SESSION["USUARIODASESSAO"] = 'GUEST';
		    echo "<script>window.location='index.php?actionType=logout'</script>";			exit();
		} 	
	}
				

?>