<?php

	
	class RevisaReserva extends ModelReserva
	{
	
		
		#passo 1 - descobrir quarto e verificar se tem algum disponivel em meio as datas
		public function setIncodquarto($codquartotipo)
		{
			return "IN('".implode("','", $this->getKey_quartos($codquartotipo))."')";
		}
		
		
		
	
	}
	
?>