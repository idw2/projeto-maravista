<?php

class PesquisaReserva extends Reserva {

	
	/*
	 *	metodo construtor
	 *  PARAMETROS:
	 * 	1� data inicio yyyy-mm-dd
	 *  2� data fim yyyy-mm-dd
	 *  3� numero de adulto
	 *  4� numero total de criancas
	 *  5� a linguagem da sess�o: PORTUGUES, INGLES, ESPANHOL
	 *  6� numero de criancas ate 5 anos  
	 *  7� numero de criancas entre 6 a 12 anos  
	 *  8� numero de criancas ate 12 anos  
	 *  9� codigo do tipo do quarto
	 * 10� codigo do pacote
	 */
	 
	public function __construct( $dtainicio, $dtafim, $adulto, $crianca, $language, $crianca0a5, $crianca6a12, $crianca12, $codquartotipo, $codpacote, $codquarto )
	{
		
		$this->codquarto = $codquarto;
		$this->language = $language;
		$this->dtainicio = $dtainicio;
		$this->dtafim = $dtafim;
		$this->codquartotipo = $codquartotipo;
		$this->adulto = (int)$adulto;
		$this->crianca = (int)$crianca;
		$this->crianca0a5 = (int)$crianca0a5;
		$this->crianca6a12 = (int)$crianca6a12;
		$this->crianca12 = (int)$crianca12;
		$this->codpacote = $codpacote;
		
		/*	
			$this->nom_temporada, $
			$this->valor_Diadasemana, $
			$this->valor_Finaldesemana, $
			$this->qntd_Diadasemana, $
			$this->qntd_Finaldesemana, $
			$this->total, $
			$this->total_formatado, $
			$this->total_dia_semana, $
			$this->total_dia_semana_formatado, $
			$this->total_fim_semana, $
			$this->total_fim_semana_formatado, $
			$this->foto, $
			$this->quartotipo_name, $	
		*/
		
		if(strlen($codpacote) == 32)
		{
			$this->setValorpacote(); 
			$this->setNom_pacote(); 
		}
		$this->dados_relevantes();
		$this->configTemporada();
		$this->separaDiasdasemana();
		$this->multiplicaDiaria();
		
	}
	
	
	
		
	/*
	
	
	 * set e get crianca6a12
	 * /
	function setCrianca6a12($crianca6a12)
	{
		$this->crianca6a12 = (int)$crianca6a12;
	}
	
	public function getCrianca6a12()
	{
		return $this->crianca6a12;
	}
	
	/*
	 * set e get crianca12
	 * /
	public function setCrianca12($crianca12)
	{
		$this->crianca12 = (int)$crianca12;
	}
	
	public function getCrianca12()
	{
		return $this->crianca12;
	}
	
	/*
	 * set e get crianca
	 * /
	public function setCrianca($crianca)
	{
		$this->crianca = (int)$crianca;
	}
	
	function getCrianca()
	{
		return $this->crianca;
	}
	
	/*
	 * set e get crianca0a5
	 * /
	public function setCrianca0a5($crianca0a5)
	{
		$this->crianca0a5 = (int)$crianca0a5;
	}
	
	public function getCrianca0a5()
	{
		return $this->crianca0a5;
	}
	
	/*
	 * set e get crianca
	 * /
	public function analisaAdultos($crianca)
	{
		if( $this->getCrianca() == 0 )
		{
			return false;
		}
		else
		{
			/*
			$this->getCrianca0a5(); 
			$this->getCrianca6a12();
			$this->getCrianca12();	
			* /
		}
	}
	
	/*
	 * set e get crianca
	 * /
	 
	/*
	 * analisa quantas criancas de 0 a 5 e calcula valores
	 * /
	function analisaCrianca0a5()
	{
		if( $this->getCrianca0a5() == 0 )
		{
			return false;
		}
		else
		{
			$soma_crianca_5 = $this->getCrianca0a5();
			
			if( $this->getCrianca0a5() > 1 )
			{
				$crianca_5 = $soma_crianca_5 ;
				$soma_crianca_5 = ($soma_crianca_5-1);
				$perc_crianca_5 = ($soma_crianca_5*15);
				
				//( $dias == 1 ) ? $valor_pacote = $tqts->VALOR : $valor_pacote = $valor_1;
				
				$valor_pacote_1_perc = ( $this->total/100);
				$soma_crianca_5 = round($valor_pacote_1_perc*$perc_crianca_5);
			
				$str = $this->getLabel('LABEL_ACRESCIMO');
				$str = str_replace("%", "$perc_crianca_5%", $str);
				
				$html  = "<br/>";
				$html .= "<div>$str ( $crianca_5 ".$this->getLabel("LABEL_CRIANCAS_5ANOS_2_CORTESIA").") =&nbsp;</div>";	
				$html .= "<div>R$ ".formataReais($soma_crianca_5)."</div>";	
				
				$valor_1 = ($soma_crianca_5+$this->total);
				
				$CRIANCA_5_PERC = 15; 
				$CRIANCA_5_PERC_MULT = $perc_crianca_5;
				$CRIANCA_5_VALOR = ($CRIANCA_5_VALOR+$soma_crianca_5);
				$CRIANCA_5_EXCEDENTE = ($CRIANCA_5_EXCEDENTE+$crianca_5);
				
				$html .= "<div>";
					$html .= "<input type='hidden' name='CRIANCA_5_PERC' value='".$CRIANCA_5_PERC."'/>";
					$html .= "<input type='hidden' name='CRIANCA_5_PERC_MULT' value='".$CRIANCA_5_PERC_MULT."'/>";
					$html .= "<input type='hidden' name='CRIANCA_5_VALOR' value='".$CRIANCA_5_VALOR."'/>";
					$html .= "<input type='hidden' name='CRIANCA_5_EXCEDENTE' value='".$CRIANCA_5_EXCEDENTE."'/>";
				$html .= "</div>";
				
			}
			else
			{
				return false;
			}
		}
	}
	*/
}

?>