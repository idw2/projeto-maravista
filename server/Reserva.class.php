<?php

class Reserva {

	
	public $language, $dtainicio, $dtafim, $nom_temporada, $valor_Diadasemana, $valor_Finaldesemana, $qntd_Diadasemana, $qntd_Finaldesemana, $total, $total_formatado, $total_dia_semana, $total_dia_semana_formatado, $total_fim_semana, $total_fim_semana_formatado, $codquartotipo, $foto, $quartotipo_name, $adulto, $crianca, $crianca0a5, $crianca6a12, $crianca12, $codpacote, $dta_inicio_alta, $dta_fim_alta, $dta_inicio_media, $dta_fim_media, $dta_inicio_baixa, $dta_fim_baixa, $moeda = "<b class='BRL'>R$</b>", $acrescimo = 0, $adulto_perc = 30, $adulto_perc_mult, $adulto_valor, $adulto_excedente, $crianca_5_perc = 15, $crianca_5_perc_mult, $crianca_5_valor, $crianca_5_excedente, $crianca_6a12_perc = 15, $crianca_6a12_perc_mult, $crianca_6a12_valor, $crianca_6a12_excedente, $crianca_12_perc = 30, $crianca_12_perc_mult, $crianca_12_valor, $crianca_12_excedente, $https, $site, $adulto_tmp, $crianca_tmp, $crianca0a5_tmp, $crianca6a12_tmp, $crianca12_tmp, $valorpacote, $nomepacote, $existe_acrescimo = false, $nom_pacote, $codquarto;
	public $hidden = array('language', 'dtainicio', 'dtafim', 'nom_temporada', 'valor_Diadasemana', 'valor_Finaldesemana', 'qntd_Diadasemana', 'qntd_Finaldesemana', 'total', 'total_formatado', 'total_dia_semana', 'total_dia_semana_formatado', 'total_fim_semana', 'total_fim_semana_formatado', 'codquartotipo', 'foto', 'quartotipo_name', 'adulto', 'crianca', 'crianca0a5', 'crianca6a12', 'crianca12', 'codpacote', 'dta_inicio_alta', 'dta_fim_alta', 'dta_inicio_media', 'dta_fim_media', 'dta_inicio_baixa', 'dta_fim_baixa', 'acrescimo', 'adulto_perc', 'adulto_perc_mult', 'adulto_valor', 'adulto_excedente', 'crianca_5_perc', 'crianca_5_perc_mult', 'crianca_5_valor', 'crianca_5_excedente', 'crianca_6a12_perc', 'crianca_6a12_perc_mult', 'crianca_6a12_valor', 'crianca_6a12_excedente', 'crianca_12_perc', 'crianca_12_perc_mult', 'crianca_12_valor', 'crianca_12_excedente', 'https', 'site', 'valorpacote', 'nomepacote', 'existe_acrescimo', 'nom_pacote', 'codquarto');
	
	/*
	 *	metodo construtor
	 *  PARAMETROS:
	 *  1� a linguagem da sess�o: PORTUGUES, INGLES, ESPANHOL
	 *  2� data inicio da alta temporada yyyy-mm-dd
	 *  3� data fim da alta temporada yyyy-mm-dd
	 *  4� data inicio da media temporada yyyy-mm-dd 
	 *  5� data fim da media temporada yyyy-mm-dd 
	 *  6� data inicio da baixa temporada yyyy-mm-dd 
	 *  7� data fim da baixa temporada yyyy-mm-dd 
	 *  8� data inicio da reserva yyyy-mm-dd 
	 *  9� data fim da reserva yyyy-mm-dd 
	 * 10� codigo do tipo de quarto  
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
		
		$this->analisaPacote($dtainicio, $dtafim);
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
	 *	fun��o que soma os valores da diaria
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
	 *	retorna o totao de dias
	 */
	   
	public function total_dias() {
	
		return ((int)$this->qntd_Diadasemana + (int)$this->qntd_Finaldesemana);
	
	}
	
	/*
	 *	set nome do pacote
	 */
	   
	public function setNom_pacote() {
	
		$nom_pacote = mysql_query("SELECT $this->language FROM pacotes WHERE CODPACOTE='$this->codpacote'");
		(string) $l = $this->language;
		if( mysql_num_rows($nom_pacote) != 0)
		{
			$nom_pacote = mysql_fetch_object($nom_pacote);
			$this->nom_pacote = $nom_pacote->$l;
		}
	}
	
	/*
	 *	retorna input hiddens para o form
	 */
	   
	public function input_hidden() {
	
		$html = "";
		foreach($this->hidden as $hdd)
		{
			$html .= "<input type='hidden' name='".$hdd."' value='".$this->$hdd."'/>";	
		}
		return $html;
	}
	
	
	/*
	 *	calcula o excesso de adultos em um quarto
	 */
	public function somaAdulto()
	{
		$html = "";
		if( $this->adulto_tmp > 2 )
		{
			$adulto = ((int)$this->adulto-2);
			$soma_adulto_excedente = ($this->adulto-2);
			$perc_adulto = ($soma_adulto_excedente*30);
			
			if( (int)$this->total_dia_semana != 0)
			{
				$soma1 = round((int)$this->total_dia_semana/100*$perc_adulto);
			}
			else
			{
				$soma1 = 0;
			}
			
			if( (int)$this->total_fim_semana != 0)
			{
				$soma2 = round((int)$this->total_fim_semana/100*$perc_adulto);
			}
			else
			{
				$soma2 = 0;
			}
			
			$str = $this->getLabel('LABEL_ACRESCIMO');
			$str = str_replace("%", "$perc_adulto%", $str);
			$soma_adulto = ($soma1 + $soma2);
			$this->total_acrescimo($soma_adulto);
			
			$this->total = ((int)$this->total + (int)$soma_adulto);
			$this->total_formatado = $this->formataReais($this->total);
			
			$html .= "<h3>Adicionais</h3>";
			$html .= "(Base 30%) = ".$str." ( ".$adulto." ".$this->getLabel('LABEL_ADULTO').") =&nbsp;".$this->moeda." ".$this->formataReais($soma_adulto);		
			$this->adulto_perc = 30;
			$this->adulto_perc_mult = $perc_adulto;
			$this->adulto_valor = $soma_adulto;
			$this->adulto_excedente = $soma_adulto_excedente;
			
			return $html;
			
		}
		else
		{
			return false;
		}
	}
	
	/*
	 *	calcula o excesso de criancas com faixa de 0 a 5 anos
	 */
	public function somaCrianca0a5()
	{
		$html = "";
		
		if( $this->crianca0a5_tmp > 1 )
		{
			$crianca_5 = $this->crianca0a5_tmp ;
			$soma_crianca_5 = ($this->crianca0a5_tmp-1);
			$perc_crianca_5 = ($soma_crianca_5*15);
			
			if( (int)$this->total_dia_semana != 0)
			{
				$soma1 = round((int)$this->total_dia_semana/100*$perc_crianca_5);
			}
			else
			{
				$soma1 = 0;
			}
			
			if( (int)$this->total_fim_semana != 0)
			{
				$soma2 = round((int)$this->total_fim_semana/100*$perc_crianca_5);
			}
			else
			{
				$soma2 = 0;
			}
			
			$str = $this->getLabel('LABEL_ACRESCIMO');
			$str = str_replace("%", "$perc_crianca_5%", $str);
			$soma_crianca_5 = ($soma1 + $soma2);
			$this->total_acrescimo($soma_crianca_5);
			
			$this->total = ((int)$this->total + (int)$soma_crianca_5);
			$this->total_formatado = $this->formataReais($this->total);
			
			$html .= "(Base 15%) = ".$str." ( ".$crianca_5." ".$this->getLabel('LABEL_CRIANCAS_5ANOS_2_CORTESIA').") =&nbsp;".$this->moeda." ".formataReais($soma_crianca_5);					
			$this->crianca_5_perc = 15; 
			$this->crianca_5_perc_mult = $perc_crianca_5;
			$this->crianca_5_valor = $soma_crianca_5;
			$this->crianca_5_excedente = ($this->crianca0a5_tmp-1);
			
			return $html;
			
			
		}
		else
		{
			return false;
		}
	}
	
	/*
	 *	calcula o excesso de criancas com faixa de 6 a 12 anos
	 */
	public function somaCrianca6a12()
	{
		$html = "";
		
		if( $this->crianca6a12_tmp != 0 )
		{
			$crianca_6_12 = $this->crianca6a12_tmp;
			$perc_crianca_6_12 = ($crianca_6_12*15);
			
			if( (int)$this->total_dia_semana != 0)
			{
				$soma1 = round((int)$this->total_dia_semana/100*$perc_crianca_6_12);
			}
			else
			{
				$soma1 = 0;
			}
			
			if( (int)$this->total_fim_semana != 0)
			{
				$soma2 = round((int)$this->total_fim_semana/100*$perc_crianca_6_12);
			}
			else
			{
				$soma2 = 0;
			}
			
			$str = $this->getLabel('LABEL_ACRESCIMO');
			$str = str_replace("%", "$perc_crianca_6_12%", $str);
			$soma_crianca_6_12 = ($soma1 + $soma2);
			
			$this->total_acrescimo($soma_crianca_6_12);
			
			$this->total = ((int)$this->total + (int)$soma_crianca_6_12);
			$this->total_formatado = $this->formataReais($this->total);
			
			$html .= "(Base 15%) = ".$str." ( ".$crianca_6_12." ".$this->getLabel('LABEL_CRIANCAS_6A12_2').") =&nbsp;".$this->moeda." ".formataReais($soma_crianca_6_12);	
			$this->crianca_6a12_perc = 15;
			$this->crianca_6a12_perc_mult = $perc_crianca_6_12;
			$this->crianca_6a12_valor = $soma_crianca_6_12;
			$this->crianca_6a12_excedente = $this->crianca6a12_tmp;
			
			return $html;
			
		}
		else
		{
			return false;
		}
	}
	
	/*
	 *	calcula o excesso de criancas com acima de 12 anos
	 */
	public function somaCrianca12()
	{
		//$html = "<h4>this->crianca12_tmp: $this->crianca12_tmp<h4>";
		$html = "";
		
		if( $this->crianca12_tmp != 0 )
		{
			$crianca_12 = $this->crianca12_tmp;
			$perc_crianca_12 = ($crianca_12*30);
			
			if( (int)$this->total_dia_semana != 0)
			{
				$soma1 = round((int)$this->total_dia_semana/100*$perc_crianca_12);
			}
			else
			{
				$soma1 = 0;
			}
			
			if( (int)$this->total_fim_semana != 0)
			{
				$soma2 = round((int)$this->total_fim_semana/100*$perc_crianca_12);
			}
			else
			{
				$soma2 = 0;
			}
			
			$str = $this->getLabel('LABEL_ACRESCIMO');
			$str = str_replace("%", "$perc_crianca_12%", $str);
			$soma_crianca_12 = ($soma1 + $soma2);
			
			$this->total_acrescimo($soma_crianca_12);
			
			$this->total = ((int)$this->total + (int)$soma_crianca_12);
			$this->total_formatado = $this->formataReais($this->total);
			
			$html .= "(Base 30%) = ".$str." ( ".$crianca_12." ".$this->getLabel('LABEL_CRIANCAS_ACIMA12_2').") =&nbsp;".$this->moeda." ".formataReais($soma_crianca_12);	
			$crianca_12_perc = 30;	
			$crianca_12_perc_mult = $perc_crianca_12;
			$crianca_12_valor = $soma_crianca_12;
			$crianca_12_excedente = $this->crianca12_tmp;
			
			return $html;
		}
		else
		{
			return false;
		}
	}
	
	/*
	 *	prepara o valor do total de acrecimo
	 */
	public function total_acrescimo ($acrescimo) {
		$this->acrescimo = ($this->acrescimo + (int)$acrescimo);
		$this->existe_acrescimo = true;
	}
	
	/*
	 *	cria uma variavel das pessoas e criancas temporariamente
	 */
	public function start_tmp () {
		
		$this->adulto_tmp = $this->adulto;
		$this->crianca_tmp = $this->crianca;
		$this->crianca0a5_tmp = $this->crianca0a5;
		$this->crianca6a12_tmp = $this->crianca6a12;
		$this->crianca12_tmp = $this->crianca12;
				
	}
	
	/*
	 *	trata pessoas quando adulto for igual a 1
	 */
	public function isadulto1() {
		
		$adulto_bk = $this->adulto_tmp;
		$crianca12_bk = $this->crianca12_tmp;
		$crianca6_bk = $this->crianca6a12_tmp;
		$crianca5_bk = $this->crianca0a5_tmp;

		$soma = ($this->crianca12_tmp + $this->crianca6a12_tmp + $this->crianca0a5_tmp);
		
		if($this->adulto_tmp == 1){
			if($soma >= 1){
			  if($this->crianca0a5_tmp >= 1){
				$this->adulto_tmp = 2;
				$this->crianca0a5_tmp = $this->crianca0a5_tmp-1;
				$this->crianca12_tmp = $crianca12_bk;
				$this->crianca6a12_tmp = $crianca6_bk;
				//if($this->crianca0a5_tmp)
			  }
			  if($this->crianca6a12_tmp >= 1){
				  $this->adulto_tmp = 2;
				  $this->crianca6a12_tmp = $this->crianca6a12_tmp-1;
				  $this->crianca12_tmp = $crianca12_bk;
				  $this->crianca0a5_tmp = $crianca5_bk;
			  }
			  if($this->crianca12_tmp >= 1){
				  $this->adulto_tmp = 2;
				  $this->crianca12_tmp = $this->crianca12_tmp-1;
				  $this->crianca0a5_tmp = $crianca5_bk;
				  $this->crianca6a12_tmp = $crianca6_bk;
				} else {
				 return false;
				}
			} else {
			  return false;
			}
		  }	
	}
	
	/*
	 *	soma a quantidade de criancas
	 */
	public function somaQuantidadecriancas() {
		
		return ($this->crianca0a5_tmp + $this->crianca6a12_tmp + $this->crianca12_tmp);
				
	}
	
	
	function arrayDtas($objQuery)
	{
		if( mysql_num_rows($objQuery) != 0)
		{
			while( $data = mysql_fetch_object($objQuery) )
			{
			
				$di = $data->DTAINICIO;
				$df = $datas->DTAFIM;
				$arrDtas[] = $data->DTAINICIO;
				
				while( $di != $data->DTAFIM )
				{
					$adianta1 = mysql_query("SELECT DATE_ADD('".$di."', INTERVAL 1 DAY) as DTA");	
					$adianta1 = mysql_fetch_object($adianta1);
					$di = $adianta1->DTA;
					
					if (!in_array($di, $arrDtas)) {
						$arrDtas[] = $di;
					}

				}
					
			}
				
		}
		
		return $arrDtas;
	}
	
	
	/*
	 *	retorna os textos padr�o para conhecimento do usu�rio
	 */
	public function getTextos () {
		
		//$this->dtainicio, $this->dtafim
		
		 $datas = mysql_query("SELECT datas.DTAINICIO, datas.DTAFIM FROM 
		 datas 
		 INNER JOIN pacotes_rel_datas ON pacotes_rel_datas.CODDTA=datas.CODDTA
		 INNER JOIN pacotes ON pacotes.CODPACOTE=pacotes_rel_datas.CODPACOTE
		 WHERE datas.CODDTA!=''
		 AND datas.STATUS=1
		 AND (pacotes.STATUS=1 OR pacotes.STATUS=0)
		 AND pacotes.CODQUARTOTIPO='".$this->codquartotipo."'
		 GROUP BY datas.CODDTA
		 ORDER BY datas.DTAINICIO ASC");
	 
		$controle = false;
		if(mysql_num_rows($datas) != 0)
		{
			$arrDtas = arrayDtas($datas);
			
			if (in_array($this->dtainicio, $arrDtas) || in_array($this->dtafim, $arrDtas)) {
				$controle = true;
			}
		}
		$controle = false;
		//if( $this->analisaPacote( $this->dtainicio, $this->dtafim ) && $this->codpacote == "")
		if( $controle )
		{
				     $html .= "<div id='inline1' style='display: block;'>";
						$html .= "<p>";
							$html .= "<form id='formReserva' name='form1' method='post' novalidate action='index.php?actionType=reservas.forma.pgto.cielo'  style='max-width: initial'>";
									$html .= "<div class='ContainerAcomodacao pag-deposito'>";
										$html .= "<p>";
										$html .="<div class='sep-pattern-1'></div>";
											$html .="<center>";
												$html .="<h1 class='alert-green' style='font-size: 2.4rem;padding: 98px;'>";
													$html .= getLabel('LABEL_DTA_RESERVAS', $_SESSION['LANGUAGE']);
												$html .="</h1>";
											$html .="</center>";
											$html .="<div class='sep-pattern-1'></div>";
										$html .= "</p>";
									$html .= "</div>";		
									$html .= "<div><a class='BtnFiltro small full-width push-right' href='http://www.maravista.com.br/pacotes-e-promocoes'>".getLabel('LABEL_PACOTES', $_SESSION['LANGUAGE'])."</a></div>";
							$html .= "</form>";
						$html .= "</p>";
					$html .= "</div>";
		}
		else
		{
                $html = "<div class='pag_interna reserva_item' style='padding:0 !important;'>";
                      $html .="<div>";
                      
					
				if( $this->nom_pacote == "")
				{
					$html .= "<div class='pint_titulo Acomodacoes' style='border-bottom: none;height:8px'></div>";
				}				
				else
				{
					$html .= "<div class='pint_titulo Acomodacoes'>".$this->nom_pacote."</div>";
					/*$html .= "<div class='pint_titulo Acomodacoes'>".$this->nom_temporada."</div>";*/
				}
				
				$html .= "<div class='blog_view_img' style='background-image: url(".$this->foto.")'>";
                        $html .= "<h2 class='blog_view_title' >".$this->quartotipo_name."</h2>";
                        $html .="</div>";
                        $html .= "<div class='painel'>"; 
						//$html .= "<div class='Acomodacoes painel-label'>".getLabel('LABEL_PERIODO', $_SESSION['LANGUAGE'])."</div>";
                          $html .= "<h3>".$this->getLabel('LABEL_CHEGADA').": ".$this->formataDataparabrasil($this->dtainicio)."</h3>";
                          $html .= "<h3>".$this->getLabel('LABEL_SAIDA_FORM').": ".$this->formataDataparabrasil($this->dtafim)."</h3>";
                          
                          if($this->total_dias() == 1){
                            $html .= "<div>".$this->total_dias()." ".$this->getLabel('LABEL_DIA').".</div>";
                          }else{
                            $html .= "<div>".$this->total_dias()." ".$this->getLabel('LABEL_DIAS').".</div>";
                          }

                          $html .= "<div>".$this->getLabel('LABEL_ADULTOS').": ".$this->adulto."</div>";
                        $html .="</div>";
						
						$t = ((int)$this->crianca0a5 + (int)$this->crianca6a12 + (int)$this->crianca12);
						if( $t != 0)
						{
							$html .= "<div class='painel'>";
							  $html .= "<div class='Acomodacoes painel-label'>".$this->getLabel('LABEL_CRIANCAS')."</div>";
							  $html .= "<div>5 anos: ".$this->crianca0a5."</div>";
							  $html .= "<div>de 6 a 12 anos: ".$this->crianca6a12."</div>";
							  $html .= "<div>acima de 12 anos: ".$this->crianca12."</div>";
							$html .="</div>";
						}
						
                        
                          if( strlen($this->codpacote) == 32 )
						  {
							  $html .= "<div class='painel'>";
							  
								  $this->total = $this->getValorpacote();
								  $this->setNomepacote();
								  $this->total_formatado = $this->formataReais($this->getValorpacote());	
								 
								  $html .= "<div class='Acomodacoes painel-label'>".$this->getLabel('LABEL_PACOTES')."</div>";
								  $html .= "<div>".$this->getLabel('LABEL_NOM_PACOTE').": ".$this->nomepacote."</div>";
								  //$html .= "<div>".$this->getLabel('LABEL_TOTAL_PARCIAL').": ".$this->moeda." ".$this->total_formatado."</div>";
								  
							  $html .="</div>";
						  }
						  else 
						  {
							  //$html .= "<div class='Acomodacoes painel-label'>".$this->getLabel('LABEL_DIARIA')."</div>";
							  //$html .= "<div>".$this->getLabel("LABEL_SEGASEX").", ".$this->getLabel("LABEL_DIARIA")." ".$this->moeda." ".$this->formataReais($this->valor_Diadasemana)." x ".$this->qntd_Diadasemana." = ".$this->moeda." ".$this->total_dia_semana_formatado."</div>";
							  //$html .= "<div>".$this->getLabel("LABEL_SABADOM").", ".$this->getLabel("LABEL_DIARIA")." ".$this->moeda." ".$this->formataReais($this->valor_Finaldesemana)." x ".$this->qntd_Finaldesemana." = ".$this->moeda." ".$this->total_fim_semana_formatado."</div>";
							  //$html .= "<div>".$this->getLabel('LABEL_TOTAL_PARCIAL').": ".$this->moeda." ".$this->total_formatado."</div>";
						  }
						  
                          
                        $html .="</div>";
						
				$this->start_tmp ();
				$this->isadulto1();
                        
				$a = $this->somaAdulto();
				$b = $this->somaCrianca0a5();
				$c = $this->somaCrianca6a12();
				$d = $this->somaCrianca12();
				
                if($this->existe_acrescimo)
				{
                        
					$html .= "<div class='painel'>";
                        $html .= "<div class='Acomodacoes painel-label'>".getLabel('LABEL_RESERVA_ACRESCIMO', $_SESSION['LANGUAGE'])."</div>";
						$html .= "<div>".$a."</div>";
						$html .= "<div>".$b."</div>";
						$html .= "<div>".$c."</div>";
						$html .= "<div>".$d."</div>";
                        
                        
                          $html .= "<div>".$this->moeda." ".$this->formataReais($this->acrescimo)."</div>";
                          $html .= "</div>";
                }							
				
                        $html .= "<div class='painel'>";
                        $html .= "<div class='Acomodacoes painel-label'>".getLabel('LABEL_RESERVA', $_SESSION['LANGUAGE'])."</div>";
				$html .= "<div>";
					$html .= "<form name='formReserva".rand(10,100)."' id='formReserva".rand(10,100)."' method='post' action='".$this->https."/index.php?actionType=reservas.continue' onSubmit='testa_termos(this.id);return false;'>";
						$html .= "<br/>";
						$html .= "<script>
							function testa_termos(id)
							{
								var guid = '#'+id;
								if( $('#termos').is(':checked') )
								{
									field = document.getElementById('email');
									usuario = field.value.substring(0, field.value.indexOf('@')); 
									dominio = field.value.substring(field.value.indexOf('@')+ 1, field.value.length); 
									//alert('usuario: '+usuario+' dominio: '+ dominio);
									if ((usuario.length >=1) 
									&& (dominio.length >=3) 
									&& (usuario.search('@')==-1) 
									&& (dominio.search('@')==-1) 
									&& (usuario.search(' ')==-1) 
									&& (dominio.search(' ')==-1) 
									&& (dominio.search('.')!=-1) 
									&& (dominio.indexOf('.') >=1)
									&& (dominio.lastIndexOf('.') < dominio.length - 1)) 
									{ 
										$(guid).submit();
									} 
									else
									{ 
										$('#email').css('border-color','#fa4343');
										$('#email').css('background','#fecaca');
									} 
									
								}
								else
								{
									return false;
								}
							}
						
						</script>";
						$html .= $this->input_hidden();
                                    
                        $html .= "<div class='painel'>";
                        $html .= "<div class='Acomodacoes painel-label'>".$this->getLabel('LABEL_HOSPEDES')."</div><br />";
						
						if( $this->adulto != 0)
						{
							$html .= "<label>".$this->getLabel("LABEL_ADULTOS")."</label><br/>";
							$i = $this->adulto;
							$j = 1;
							$nm = 1;
							while( $i != 0 )
							{           
								
								$html .= "<div class='EntradaText' style='margin-bottom: 3px'>";
								  $html .= "<input type='text' name='hospede_adulto_".$j."' style='width: 328px;' required placeholder='".$this->getLabel('LABEL_ADULTO')." $nm' class='falecom' oninvalid=\"setCustomValidity('".$this->getLabel('LABEL_NOM_REQUERIDO')."');\" onchange=\"try{setCustomValidity('')}catch(e){}\"/>";
								$html .= "</div>";
                                                
								$i--;
								$j++;
								$nm++;
							}
						}
						
						if( $this->crianca0a5 != 0)
						{
							$html .= "<label>".$this->getLabel('LABEL_CRIANCAS_5ANOS_2')."</label><br/>";
							$i = $this->crianca0a5;
							$j = 1;
							while( $i != 0 )
							{     
                                                $html .= "<div class='EntradaText' style='margin-bottom: 3px'>";
                                                  $html .= "<input type='text' name='hospede_crianca0a5_".$j."' style='width: 328px;' required placeholder='".getLabel('LABEL_NOME', $_SESSION['LANGUAGE'])."' class='falecom' oninvalid=\"setCustomValidity('".$this->getLabel('LABEL_NOM_REQUERIDO')."');\" onchange=\"try{setCustomValidity('')}catch(e){}\"/>";
								$html .= "</div>";
                                                
                                                
								$i--;
								$j++;
							}
						}
						
						if( $this->crianca6a12 != 0)
						{
							$html .= "<label>".$this->getLabel('LABEL_CRIANCAS_6A12')."</label><br/>";
							$i = $this->crianca6a12;
							$j = 1;
							while( $i != 0 )
							{
                                                $html .= "<div class='EntradaText' style='margin-bottom: 3px'>";
                                                  $html .= "<input type='text' name='hospede_crianca6a12_".$j."' style='width: 328px;' required placeholder='".getLabel('LABEL_NOME', $_SESSION['LANGUAGE'])."' class='falecom' oninvalid=\"setCustomValidity('".$this->getLabel('LABEL_NOM_REQUERIDO')."');\" onchange=\"try{setCustomValidity('')}catch(e){}\"/>";
								$html .= "</div>";
                                                
								$i--;
								$j++;
							}
						}
						
						if( $this->crianca12 != 0)
						{
							$html .= "<label>".$this->getLabel('LABEL_CRIANCAS_ACIMA12')."</label><br/>";
							$i = $this->crianca12;
							$j = 1;
							while( $i != 0 )
							{
								$html .= "<div class='EntradaText' style='margin-bottom: 3px'>";
								  $html .= "<input type='text' name='hospede_crianca12_".$j."' style='width: 328px;' required placeholder='".getLabel('LABEL_NOME', $_SESSION['LANGUAGE'])."' class='falecom' oninvalid=\"setCustomValidity('".$this->getLabel('LABEL_NOM_REQUERIDO')."');\" onchange=\"try{setCustomValidity('')}catch(e){}\"/>";
								$html .= "</div>";
                                                
								$i--;
								$j++;
							}
						}
                                    
						$html .= "</div>";
						$html .= "<div class='painel'>";
                                      $html .= "<label class='painel-label'>".$this->getLabel('LABEL_RESP_RESERVA')."</label><br/>";
                                      $html .= "<div class='EntradaText' style='margin-bottom: 3px'>";
                                        $html .= "<input type='text' name='responsavel_reserva' style='width: 328px;' required placeholder='".$this->getLabel('LABEL_NOME')."' class='falecom' oninvalid=\"setCustomValidity('".$this->getLabel('LABEL_NOM_REQUERIDO')."');\" onchange=\"try{setCustomValidity('')}catch(e){}\"/>";
                                      $html .= "</div>";
                                      
                                      $html .= "<div class='EntradaText' style='margin-bottom: 3px'>";
                                        $html .= "<input type='text' name='email' id='email' style='width: 328px;' required placeholder='".$this->getLabel('LABEL_EMAIL')."' class='falecom' oninvalid=\"setCustomValidity('".$this->getLabel('LABEL_EMAIL_REQUERIDO')."');\" onchange=\"try{setCustomValidity('')}catch(e){}\"/>";
                                      $html .= "</div>";
                                      
                                      $html .= "<div class='EntradaText' style='margin-bottom: 3px'>";
                                        $html .= "<input type='text' name='telefone' id='telefone' maxlength='50' style='width: 328px;' required placeholder='".$this->getLabel('LABEL_FONE_CEL')."' class='falecom'  oninvalid=\"setCustomValidity('".$this->getLabel('LABEL_TEL_REQUERIDO')."');\" onchange=\"try{setCustomValidity('')}catch(e){}\"/>";
                                      $html .= "</div>";
                                     
                                     /* $html .="<script>$('#telefone').mask('(00) 00000-0000');</script>";*/
                                      
                                      $html .= "</div>";
                                      
									$html .= "<label>".$this->getLabel('LABEL_SOLICITACOES')."</label><br/>";
                                    
                                    $html .= "<div class='EntradaText' style='margin-bottom: 3px'>";
                                      $html .= "<textarea class='bloco' name='observacoes'></textarea><br/>";
                                    $html .= "</div>";
                        /*            
						$html .= "<label>Forma de Pagamento</label><br/>";
						$html .= "<select name='forma_pgto' id='forma_pgto' class='select'>";
							$html .= "<option value='1'>".$this->getLabel("LABEL_DEPOSITO")."</option>";
							$html .= "<option value='2'>".$this->getLabel("LABEL_CARTAO_CREDITO")."</option>";
						$html .= "</select><br/>";
						*/
						
									$html .= "<div class='EntradaText ckr-termos' style='margin-bottom: 3px'>";
										$html .= "<input type='checkbox' name='termos' id='termos' style='width: 10px !important'/> ".$this->getLabel('LABEL_DECL_TERMOS')." <span><a href='http://www.maravista.com.br/termos' target='_blank'>".getLabel('LABEL_LEIA_MAIS', $_SESSION['LANGUAGE'])."</a></span>"; 
									$html .= "</div>";
						
                                    $html .= "<div class='total'><span>Total:<span> ".$this->moeda." ".$this->total_formatado."</div>";
                                    $html .= "<div class='dtaCalendarioSubmit_div continuacao'>";
                                      $html .= "<input class='dtaCalendarioSubmit btnCliqueAqui' type='submit' name='Reservar' value='".$this->getLabel("LABEL_FAZER_RESERVA")."'/>";
                                    $html .= "</div>";
                                    
					$html .= "</form>";
				$html .= "</div>";
			$html .= "<div>";	
                  $html .= "<script>"
                          . "$('#forma_pgto').fancySelect();"
                          . "</script>";	
		}
		
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
	 *	seta o nome do quarto
	 */
	public function setQuartotipo_name ( $quartotipo_name ) {
		$this->quartotipo_name = $quartotipo_name;
	}
	
	public function getQuartotipo_name() {
		return $this->quartotipo_name;
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
	 *	seta a foto do tipo de quarto
	 */
	public function setFoto ( $foto ) {
		$this->foto = $foto;
	}
	
	public function getFoto() {
		return $this->foto;
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
	 *	par�metros: ALTA, MEDIA, BAIXA
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
			
		$query = mysql_query("SELECT 
			fotos.URL, fotos.TITULO, 
			quartos_tipo.SIGLA, 
			quartos_tipo.NOME, ".$dia_semana.", ".$fim_semana."  FROM `quartos_tipo` 
			INNER JOIN quartos_tipo_rel_fotos ON quartos_tipo_rel_fotos.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
			INNER JOIN fotos ON quartos_tipo_rel_fotos.CODFOTO=fotos.CODFOTO
			WHERE quartos_tipo.STATUS=1 
			AND quartos_tipo.CODQUARTOTIPO='".$this->codquartotipo."' AND fotos.DESTAQUE=1");	
		
		if(mysql_num_rows($query) !=0)
		{
			$query = mysql_fetch_object($query);
			$this->setValor_diadasemana($query->$dia_semana);
			$this->setValor_finaldesemana($query->$fim_semana);
			$this->setFoto($query->URL);
			$nom = $query->SIGLA." - ".$query->NOME; 
			$this->setQuartotipo_name($nom);
		}	
		
	}
	
	/*
	 *	set o nome correspondente ao pacote
	 */
	public function setNomepacote () {
		
		$nome = mysql_query("SELECT ".$this->language." FROM pacotes WHERE CODPACOTE='".$this->codpacote."'");
		$l = $this->language;
		if(mysql_num_rows($nome) != 0)
		{
			$nome = mysql_fetch_object($nome);
			$this->nomepacote = $nome->$l;
		}
		else
		{
			return false;
		}
	}
	
	/*
	 *	paga o valor correspondente ao pacote
	 */
	public function getNomepacote () {
		return $this->nomepacote;
	}
	
	/*
	 *	set o valor correspondente ao pacote
	 */
	public function setValorpacote () {
		$valor = mysql_query("SELECT VALOR_PARA FROM pacotes WHERE CODPACOTE='".$this->codpacote."'");
		if(mysql_num_rows($valor) != 0)
		{
			$valor = mysql_fetch_object($valor);
			$this->valorpacote = $valor->VALOR_PARA;
		}
		else
		{
			return false;
		}
	}
	
	/*
	 *	paga o valor correspondente ao pacote
	 */
	public function getValorpacote () {
		return $this->valorpacote;
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
	 *	segunda, ter�a, quarta, quinta
	 */
	public function setValor_diadasemana ( $valor_Diadasemana ) {
		$this->valor_Diadasemana = $valor_Diadasemana;
	}
	
	public function getValor_diadasemana() {
		return $this->valor_Diadasemana;
	}
	
	/*
	 *	seta o nome da temporada
	 *	os parametros passados s�o "ALTA","MEDIA" e "BAIXA"
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
	 *	esta fun��o retorn uma String com o nome da Label internacionalizado
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
		$loop = $datainicio;
		
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
	
	/*
	 *	passa por parametro as datas inicio e fina da reserva e checa se existe pacote para aquelas datas
	 */
	public function analisaPacote( $diffDtainicio, $diffDtafim )
	{
		$smd_dates = "'".$diffDtainicio."'";
		$loop = $diffDtafim;
		
		while($loop != $diffDtafim)
		{
			$query = mysql_query("SELECT DATE_ADD('".$loop."', INTERVAL 1 DAY) as DTA");
			$query = mysql_fetch_object($query);
			$smd_dates .= "'".$query->DTA."'";
			$loop = $query->DTA;
		}
		
		$smd_dates = str_replace("''","','",$smd_dates);
		$query = mysql_query("SELECT * FROM 
		datas 
		WHERE DTAINICIO IN(".$smd_dates.") OR DTAFIM IN(".$smd_dates.") AND STATUS=1");
		
		if(mysql_num_rows($query) != 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	
	}
	
	/*
	 *	busca os dados relevantes do sistema
	 */
	public function dados_relevantes()
	{
		
		$dr = mysql_query("SELECT * FROM dados_relevantes");
		if(mysql_num_rows($dr) != 0)
		{
			$dr = mysql_fetch_object($dr);
			
			$this->dta_inicio_alta = $dr->DTA_INICIO_ALTA; 
			$this->dta_fim_alta = $dr->DTA_FIM_ALTA;
			$this->dta_inicio_media = $dr->DTA_INICIO_MEDIA;
			$this->dta_fim_media = $dr->DTA_FIM_MEDIA;
			$this->dta_inicio_baixa = $dr->DTA_INICIO_BAIXA;
			$this->dta_fim_baixa = $dr->DTA_FIM_BAIXA;
			$this->https = $dr->HTTPS;
			$this->site = $dr->SITE;
		}
		
	}
	
	
	/*
	 *	configura os nomes correto da temporada
	 */
	public function configTemporada()
	{
		if($this->qualTemporada($this->matrizDatas($this->dta_inicio_alta,$this->dta_fim_alta)))
		{
			$this->setNom_temporada( "ALTA" );
			$this->setValuestemporada( "ALTA" );
		}
		elseif($this->qualTemporada($this->matrizDatas($this->dta_inicio_media,$this->dta_fim_media)))
		{
			$this->setNom_temporada( "MEDIA" );
			$this->setValuestemporada( "MEDIA" );
		}
		elseif($this->qualTemporada($this->matrizDatas($this->dta_inicio_baixa,$this->dta_fim_baixa)))
		{
			$this->setNom_temporada( "BAIXA" );
			$this->setValuestemporada( "BAIXA" );
		}
	}
	
	/*
	 *	formata as datas para o padrao brasil
	 */
	function formataDataparabrasil($data)                                                           
	{                                                                                              
		$dtaFormatada = $data;                                                                     
		$pieces = explode("-", $dtaFormatada);                                                     
		$pieces[0];                                                                                
		$pieces[1];                                                                                
		$pieces[2];                                                                                
		$newDate = $pieces[2]."/".$pieces[1]."/".$pieces[0];                                       
		return $newDate;                                                                           
	} 
	

}



?>