<?php

	
	class ModelReserva
	{
		#returna um array com as chaves primarias dos quartos `CODQUARTO` passando o `CODQUARTOTIPO`
		public function getKey_quartos($codquartotipo)
		{
			
			$keys = mysql_query("SELECT `quartos`.CODQUARTO FROM `quartos` 
			INNER JOIN `quartos_rel_quartos_tipo` ON `quartos_rel_quartos_tipo`.CODQUARTO=`quartos`.CODQUARTO
			WHERE `quartos_rel_quartos_tipo`.CODQUARTOTIPO='{$codquartotipo}'");
			
			$arr = array();
			
			if(mysql_num_rows($keys))
			{
				while( $key = mysql_fetch_object($keys))
				{
					$arr[] = $key->CODQUARTO;	
				}
				
			}

			return $arr;	
			
		}
		
		/*
		public function getKey_quartos($codquartotipo)
		{
		
		
		}
		
		
		"IN('".implode("','", $this->getKey_quartos($codquartotipo))."')"
		
		SELECT `reservas`.* FROM `reservas`
		INNER JOIN `reservas_rel_quartos` ON `reservas_rel_quartos`.CODRESERVA=`reservas`.CODRESERVA
		WHERE `reservas_rel_quartos`.CODQUARTO=''
		
		*/
	
	}
	
?>