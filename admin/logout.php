<?php

	foreach ( $_SESSION as $name => $value ) 
	{		if($name != "LANGUAGE")		{			unset($_SESSION[$name]);
		}
	}	
	
	echo "<script>window.location = 'index.php?actionType=pagina.inicial';</script>";	exit();

?>