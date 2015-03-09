<?php
        
		$html .="<div class='QuemSomos'>";
		
			$row = mysql_query("SELECT * FROM pousada");
			
			if(mysql_num_rows($row) != 0)
			{
				$row = mysql_fetch_object($row);
				$html .= $row->$_SESSION['LANGUAGE'];
			}
		
		$html .="</div>";

?>