<?php

	foreach ( $_SESSION as $name => $value ) 
	{
		unset($_SESSION[$name]);
	}	
	
	echo "<script>window.location = 'index.php?actionType=pagina.inicial';</script>";

?>