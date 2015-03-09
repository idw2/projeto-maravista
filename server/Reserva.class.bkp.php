<?php

class Reserva2 {

	
	public $language;
	public $dtainicio;
	public $dtafim;
	public $nom_temporada;
	public $valor_Diadasemana;
	public $valor_Finaldesemana;
	public $qntd_Diadasemana;
	public $qntd_Finaldesemana;
	public $total;
	public $total_formatado;
	public $total_dia_semana;
	public $total_dia_semana_formatado;
	public $total_fim_semana;
	public $total_fim_semana_formatado;
	public $codquartotipo;
	
	/*
	 *	metodo construtor
	 *  PARAMETROS:
	 *  1º a linguagem da sessão: PORTUGUES, INGLES, ESPANHOL
	 *  2º data inicio da alta temporada yyyy-mm-dd
	 *  3º data fim da alta temporada yyyy-mm-dd
	 *  4º data inicio da media temporada yyyy-mm-dd 
	 *  5º data fim da media temporada yyyy-mm-dd 
	 *  6º data inicio da baixa temporada yyyy-mm-dd 
	 *  7º data fim da baixa temporada yyyy-mm-dd 
	 *  8º data inicio da reserva yyyy-mm-dd 
	 *  9º data fim da reserva yyyy-mm-dd 
	 * 10º codigo do tipo de quarto  
	 *
	 */
	public function __construct( $language, $dta_inicio_alta, $dta_fim_alta, $dta_inicio_media, $dta_fim_media, $dta_inicio_baixa, $dta_fim_baixa, $dtainicio, $dtafim, $codquartotipo )
	{
		$this->setLanguage($language);
		$this->setDatainicio($dtainicio);
		$this->setDatafim($dtafim);
		$this->codquartotipo = $codquartotipo;
		
		
		if($this->qualTemporada($this->matrizDatas($dta_inicio_alta,$dta_fim_alta)))
		{
			$this->setNom_temporada( "ALTA" );
			$this->setValuestemporada( "ALTA" );
		}
		elseif($this->qualTemporada($this->matrizDatas($dta_inicio_media,$dta_fim_media)))
		{
			$this->setNom_temporada( "MEDIA" );
			$this->setValuestemporada( "MEDIA" );
		}
		elseif($this->qualTemporada($this->matrizDatas($dta_inicio_baixa,$dta_fim_baixa)))
		{
			$this->setNom_temporada( "BAIXA" );
			$this->setValuestemporada( "BAIXA" );
		}
		
		$this->separaDiasdasemana();
		$this->multiplicaDiaria();
		
	}
	
	/*
	 *	seta a quantidades de dias da semana separando alta temporada e baixa temporada
	 */
	public function separaDiasdasemana () {
		
		$dia_semana = 0;
		$fim_semana = 0;
		
		$DiffDate  = mysql_query("SELECT DATEDIFF('".$this->dtafim."','".$this->dtainicio."') AS DiffDate");
		$matriz = $this->matrizDatas($this->dtainicio,$this->dtafim);
		
		if(mysql_num_rows($DiffDate) != 0)
		{
			$DiffDate = mysql_fetch_object($DiffDate);
			
			if((int)$DiffDate->DiffDate == 1)
			{
				$week = mysql_query("SELECT DATE_FORMAT(  '".$this->dtainicio."',  '%W' ) as W");
				$week = mysql_fetch_object($week);
				
				switch($week->W)
				{
					case 'Monday': $dia_semana++; break;
					case 'Tuesday': $dia_semana++; break;
					case 'Wednesday': $dia_semana++; break;
					case 'Thursday': $dia_semana++; break;
					case 'Friday': $fim_semana++; break;
					case 'Saturday': $fim_semana++; break;
					case 'Sunday': $fim_semana++; break;
				}
				
			}
			else
			{
				$size = sizeof($matriz);
				$limit = ($size-1);
				
				foreach( $matriz as $dta )
				{
					if( $limit != 0)
					{
						$week = mysql_query("SELECT DATE_FORMAT(  '".$dta."',  '%W' ) as W");
						$week = mysql_fetch_object($week);
						
						switch($week->W)
						{
							case 'Monday': $dia_semana++; break;
							case 'Tuesday': $dia_semana++; break;
							case 'Wednesday': $dia_semana++; break;
							case 'Thursday': $dia_semana++; break;
							case 'Friday': $fim_semana++; break;
							case 'Saturday': $fim_semana++; break;
							case 'Sunday': $fim_semana++; break;
						}
						$limit--;
					}
				}
				
				
			}
			
			$this->setQntd_diadasemana($dia_semana);
			$this->setQntd_finaldesemana($fim_semana);
			
		}
		
	}
	
	/*
	 *	função que soma os valores da diaria
	 */
	public function multiplicaDiaria() {
		
		$this->total_dia_semana=0;
		$this->total_fim_semana=0;
		
		if( $this->qntd_Diadasemana != 0 )
		{
			$this->total_dia_semana = ($this->qntd_Diadasemana*$this->valor_Diadasemana);
		}
		
		if($this->qntd_Finaldesemana != 0)
		{
			$this->total_fim_semana = ($this->qntd_Finaldesemana*$this->valor_Finaldesemana);
		}
		
		$this->total_dia_semana_formatado = $this->formataReais($this->total_dia_semana);
		$this->total_fim_semana_formatado = $this->formataReais($this->total_fim_semana);
		
		if($this->total_dia_semana_formatado == "" || $this->total_dia_semana_formatado == null)
		{
			$this->total_dia_semana_formatado = "0,00";
		}
		
		if($this->total_fim_semana_formatado == "" || $this->total_fim_semana_formatado == null)
		{
			$this->total_fim_semana_formatado = "0,00";
		}
		
		$this->total = ( $this->total_dia_semana + $this->total_fim_semana );
		$this->totalFormatado();
		
	}
	
	
	/*
	 *	retorna os textos padrão para conhecimento do usuário
	 */
	   
	public function getTextos () {
		/*
		$html = "<div>";
			$html .= "<div class='LabelAcomodacaoTitle'>".$this->nom_temporada."</div>";
			$html .= "<div class='LabelAcomodacaoTitle'>".$this->getLabel("LABEL_SEGASEX").", ".$this->getLabel("LABEL_DIARIA")." R$ ".$this->formataReais($this->valor_Diadasemana)." x ".$this->qntd_Diadasemana." = ".$this->total_dia_semana_formatado."</div>";
			$html .= "<div class='LabelAcomodacaoTitle'>".$this->getLabel("LABEL_SABADOM").", ".$this->getLabel("LABEL_DIARIA")." R$ ".$this->formataReais($this->valor_Finaldesemana)." x ".$this->qntd_Finaldesemana." = ".$this->total_fim_semana_formatado."</div>";
			$html .= "<div class='LabelAcomodacaoTitle left'>".$this->getLabel("VALOR_TOTAL")." = ".$this->total_formatado."</div>";
		$html .= "</div>";
		*/
		return $html;
	}
	
	/*
	 *	formata o valor total da reserva
	 */
	public function totalFormatado () {
		$this->total_formatado = $this->formataReais($this->total);
	}
	
	/*
	 *	seta a quantidade de dias da semana
	 */
	public function setQntd_diadasemana ( $qntd_Diadasemana ) {
		$this->qntd_Diadasemana = $qntd_Diadasemana;
	}
	
	public function getQntd_diadasemana() {
		return $this->qntd_Diadasemana;
	}
	
	/*
	 *	seta a quantidade de dias de final de semana
	 */
	public function setQntd_finaldesemana ( $qntd_Finaldesemana ) {
		$this->qntd_Finaldesemana = $qntd_Finaldesemana;
	}
	
	public function getQntd_finaldesemana() {
		return $this->qntd_Finaldesemana;
	}
	
	/*
	 *	seta a linguagem corretente
	 */
	public function setLanguage ( $language ) {
		$this->language = $language;
	}
	
	public function getLanguage() {
		return $this->language;
	}
	
	/*
	 *	seta a data inicio da reserva
	 */
	public function setDatainicio ( $dtainicio ) {
		$this->dtainicio = $dtainicio;
	}
	
	public function getDatainicio() {
		return $this->dtainicio;
	}
	
	/*
	 *	seta a data final da reserva
	 */
	public function setDatafim ( $dtafim ) {
		$this->dtafim = $dtafim;
	}
	
	public function getDatafim() {
		return $this->dtafim;
	}
	
	/*
	 *	seta os valores relacionados a temporada
	 *	parâmetros: ALTA, MEDIA, BAIXA
	 */
	public function setValuestemporada ( $temporada ) {
		
		if( $temporada == "ALTA")
		{
			$dia_semana = "VALOR";
			$fim_semana = "VALOR_FINAL";
		}
		elseif( $temporada == "MEDIA")
		{
			$dia_semana = "VALOR_MEDIA";
			$fim_semana = "VALOR_MEDIA_FINAL";
		}
		elseif( $temporada == "BAIXA")
		{
			$dia_semana = "VALOR_BAIXA";
			$fim_semana = "VALOR_BAIXA_FINAL";
		}
			
		$query = mysql_query("SELECT ".$dia_semana.", ".$fim_semana." FROM `quartos_tipo` WHERE `STATUS`=1 AND CODQUARTOTIPO='".$this->codquartotipo."'");	
		
		if(mysql_num_rows($query) !=0)
		{
			$query = mysql_fetch_object($query);
			$this->setValor_diadasemana($query->$dia_semana);
			$this->setValor_finaldesemana($query->$fim_semana);
		}	
		
	}
	
	/*
	 *	seta ao valor da diaria final de semana
	 *	sexta, sabado, domingo
	 */
	public function setValor_finaldesemana ( $valor_Finaldesemana ) {
		$this->valor_Finaldesemana = $valor_Finaldesemana;
	}
	
	public function getValor_finaldesemana() {
		return $this->valor_Finaldesemana;
	}
	
	/*
	 *	seta ao valor da diaria durante a semana
	 *	segunda, terça, quarta, quinta
	 */
	public function setValor_diadasemana ( $valor_Diadasemana ) {
		$this->valor_Diadasemana = $valor_Diadasemana;
	}
	
	public function getValor_diadasemana() {
		return $this->valor_Diadasemana;
	}
	
	/*
	 *	seta o nome da temporada
	 *	os parametros passados são "ALTA","MEDIA" e "BAIXA"
	 */
	public function setNom_temporada ( $nom_temporada ) {
		
		if( $nom_temporada == "ALTA")
		{
			$this->nom_temporada = $this->getLabel("LABEL_ALTA_TEMPORADA");
		}
		elseif( $nom_temporada == "MEDIA")
		{
			$this->nom_temporada = $this->getLabel("LABEL_MEDIA_TEMPORADA");
		}
		elseif( $nom_temporada == "BAIXA")
		{
			$this->nom_temporada = $this->getLabel("LABEL_BAIXA_TEMPORADA");
		}
	}
	
	public function getNom_temporada() {
		return $this->nom_temporada;
	}
	
	/*
	 *	esta função retorn uma String com o nome da Label internacionalizado
	 *	os parametros passados a chave da Label
	 */
	public function getLabel($key)
	{
		$column = $this->getLanguage();
		$label = mysql_query("SELECT $column FROM internacionalizacao WHERE NOM_LABEL='$key'");	
		
		if(mysql_num_rows($label) == 0)
		{
			return $key;
		}
		else
		{
			$label = mysql_fetch_object($label);
			return $label->$column;
		}
		
	}
	
	/*
	 *	verifica a temporada passando a matriz de datas das temporadas
	 *	returna true ou false
	 */
	public function qualTemporada($matriz)
	{
		foreach($matriz as $dta_name)
		{
			if($this->getDatainicio()==$dta_name || $this->getDatafim()==$dta_name)
			{
				return true;		
			}		
		}
	}
	
	/*
	 *	retorna uma matriz de datas
	 */
	public function matrizDatas($datainicio, $datafim)
	{	
		$matriz[] = $datainicio;
		//$matriz[] = "2014-05-05";
		$loop = $datainicio;
		//$loop = "2014-05-05";
		
		while($loop != $datafim)
		{
			$query = mysql_query("SELECT DATE_ADD('".$loop."', INTERVAL 1 DAY) as DTA");
			$query = mysql_fetch_object($query);
			$matriz[] = $query->DTA;
			$loop = $query->DTA;
		}
		
		return $matriz;
		
		
	}
	
	
	/*
	 *	passa por parametro um valor real ex: 100000 e ele retorna 1.000,00
	 */
	public function formataReais($valorReal)                                                              
	{	                                                                                           
		$size = strlen($valorReal);                                                                
		$result = null;                                                                            
		if($size >= 9)                                                                             
		{                                                                                          
			//9.999.999,99                                                                         
			if($size == 9)                                                                         
			{                                                                                      
				$p1 = substr($valorReal, -2);                                                      
				$p2 = substr($valorReal, -5, 3);                                                   
				$p3 = substr($valorReal, -8, 3);                                                   
				$p4 = substr($valorReal, -9, 1);                                                   
				$result = $p4.".".$p3.".".$p2.",".$p1;                                             
			}                                                                                      
			elseif($size == 10)                                                                    
			{                                                                                      
				$p1 = substr($valorReal, -2);                                                      
				$p2 = substr($valorReal, -5, 3);                                                   
				$p3 = substr($valorReal, -8, 3);                                                   
				$p4 = substr($valorReal, -10, 2);                                                  
				$result = $p4.".".$p3.".".$p2.",".$p1;                                             
			}                                                                                      
			elseif($size == 11)                                                                    
			{                                                                                      
				$p1 = substr($valorReal, -2);                                                      
				$p2 = substr($valorReal, -5, 3);                                                   
				$p3 = substr($valorReal, -8, 3);                                                   
				$p4 = substr($valorReal, -11, 3);                                                  
				$result = $p4.".".$p3.".".$p2.",".$p1;                                             
			}                                                                                      
			return $result;                                                                        
																								   
		}                                                                                          
		elseif($size == 8)                                                                         
		{                                                                                          
			//999.999,99                                                                           
			$p1 = substr($valorReal, -2);                                                          
			$p2 = substr($valorReal, -5, 3);                                                       
			$p3 = substr($valorReal, -8, 3);                                                       
			$result = $p3.".".$p2.",".$p1;                                                         
			return $result;                                                                        
		}                                                                                          
		elseif($size == 7)                                                                         
		{                                                                                          
			//99.999,99                                                                            
			$p1 = substr($valorReal, -2);                                                          
			$p2 = substr($valorReal, -5, 3);                                                       
			$p3 = substr($valorReal, -7, 2);                                                       
			$result = $p3.".".$p2.",".$p1;                                                         
			return $result;                                                                        
		}                                                                                          
		elseif($size == 6)                                                                         
		{                                                                                          
			//9.999,99                                                                             
			$p1 = substr($valorReal, -2);                                                          
			$p2 = substr($valorReal, -5, 3);                                                       
			$p3 = substr($valorReal, -6, 1);                                                       
			$result = $p3.".".$p2.",".$p1;                                                         
			return $result;                                                                        
		}                                                                                          
		elseif($size == 5)                                                                         
		{                                                                                          
			//999,99                                                                               
			$p1 = substr($valorReal, -2);                                                          
			$p2 = substr($valorReal, -5, 3);                                                       
			$result = $p2.",".$p1;                                                                 
			return $result;                                                                        
		}                                                                                          
		elseif($size == 4)                                                                         
		{                                                                                          
			//99,99                                                                                
			$p1 = substr($valorReal, -2);                                                          
			$p2 = substr($valorReal, -4, 2);                                                       
			$result = $p2.",".$p1;                                                                 
			return $result;                                                                        
		}                                                                                          
		elseif($size == 3)                                                                         
		{                                                                                          
			//9,99                                                                                 
			$p1 = substr($valorReal, -2);                                                          
			$p2 = substr($valorReal, -3, 1);                                                       
			$result = $p2.",".$p1;                                                                 
			return $result;                                                                        
		}                                                                                          
		elseif($size == 2)                                                                         
		{                                                                                          
			//0,99                                                                                 
			$p1 = substr($valorReal, -2);                                                          
			$result = "0,".$p1;                                                                    
			return $result;                                                                        
		}                                                                                          
																								   
		return false;                                                                              
	}
	
	//fim

}



?>