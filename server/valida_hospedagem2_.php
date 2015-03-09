<?php
	
	session_start();
	
	require("Connection.class.php");
	require("Reserva.class.php");
	require("lib.php");
	require("PesquisaReserva.class.php");
	
	$conn = new Connection();
	
	$dtainicio = formataDataForUSA(trim($_POST["dtainicio"]));
	$dtafim = formataDataForUSA(trim($_POST["dtafim"]));
	$adulto = trim($_POST["adulto"]);
	$crianca = trim($_POST["crianca"]);
	$language = trim($_POST["language"]);
	$crianca0a5 = trim($_POST["crianca0a5"]);
	$crianca6a12 = trim($_POST["crianca6a12"]);
	$crianca12 = trim($_POST["crianca12"]);
	$codquartotipo = trim($_POST["codquartotipo"]);
	
	/*Quantidade de pessoas*/
	
	(int) $perc_adulto = 0;
	(int) $soma_adulto = $adulto;

	(int) $perc_crianca_5 = 0;
	(int) $soma_crianca_5 = $crianca6a12;

	(int) $perc_crianca_6_12 = 0;
	(int) $soma_crianca_6_12 = $crianca6a12;

	(int) $perc_crianca_12 = 0;
	(int) $soma_crianca_12 = $crianca12;
	
	/*
	$pqrs = new PesquisaReserva( $dtainicio, $dtafim, $adulto, $crianca, $language, $crianca0a5, $crianca6a12, $crianca12, $codquartotipo );
	echo utf8_encode($pqrs->getTextos());
	*/
	

	$tqts = mysql_query("SELECT 
		quartos_tipo.CODQUARTOTIPO,
		quartos_tipo.NOME,
		quartos_tipo.SIGLA,
		quartos_tipo.VALOR,
		quartos_tipo.VALOR_BAIXA
	FROM
		quartos_tipo
	WHERE quartos_tipo.CODQUARTOTIPO='".$codquartotipo."'
	GROUP BY quartos_tipo.CODQUARTOTIPO 
	ORDER BY (quartos_tipo.ORDEM+0) ASC");

	if(mysql_num_rows($tqts) != 0)
	{	
		$tqts = mysql_fetch_object($tqts);
	}

	if($_POST["codpacote"] != "" && strlen($_POST["codpacote"]) == 32)
	{
		$tqts->VALOR = $pacote->VALOR_PARA;
	}
	else
	{	
		
		$dados_relevantes = mysql_query("SELECT * FROM dados_relevantes");
		if(mysql_num_rows($dados_relevantes) != 0 )
		{
			$dados_relevantes = mysql_fetch_object($dados_relevantes);
			//var_dump($dados_relevantes);
			$dormitorio_1 = new Reserva(
				$_SESSION["LANGUAGE"],
				$dados_relevantes->DTA_INICIO_ALTA,	
				$dados_relevantes->DTA_FIM_ALTA,	
				$dados_relevantes->DTA_INICIO_MEDIA,	
				$dados_relevantes->DTA_FIM_MEDIA,	
				$dados_relevantes->DTA_INICIO_BAIXA,
				$dados_relevantes->DTA_FIM_BAIXA,
				$dtainicio,
				$dtafim,
				$codquartotipo
			);
			//var_dump($dormitorio_1);
			$tqts->VALOR = $dormitorio_1->total;
		}
		
		/*
		$pqrs = new PesquisaReserva( $dtainicio, $dtafim, $adulto, $crianca, $language, $crianca0a5, $crianca6a12, $crianca12, $codquartotipo );
		$tqts->VALOR = $pqrs->total;
		*/
	}

	$html .= "<div class='painel'>";
	$html .="<div class='Acomodacoes painel-label'>";
		$html .= getLabel('LABEL_ACOMODACAO', $_SESSION['LANGUAGE'])." (1)";
	$html .="</div>";
	$html .= "<div class='ResetFloat' style=''></div>";
	$html .= "<div class='LabelAcomodacaoTitle left'>$tqts->NOME</span></div>";
	$html .= "<div class='ResetFloat'></div>";

	$html .= "<div class='ResetFloat' style=''></div>";

	/*	
	(int) $perc_adulto = 0;
	(int) $soma_adulto = 0;

	(int) $perc_crianca_5 = 0;
	(int) $soma_crianca_5 = 0;

	(int) $perc_crianca_6_12 = 0;
	(int) $soma_crianca_6_12 = 0;

	(int) $perc_crianca_12 = 0;
	(int) $soma_crianca_12 = 0;
	
	for( $i=0; $i<(int)$_POST["screen_pessoa_0"]; $i++)
	{
		$html .= "<div class='' style=''>";

			$guid_text = "quarto_1_text_name_".$i;
			$guid_select = "quarto_1_select_".$i;
			
			switch($_POST[$guid_select])
			{
				case '0':
					$soma_adulto++;
					$idade = "(".getLabel('LABEL_ADULTO', $_SESSION['LANGUAGE']).")";
				break;
				case '1':
					$soma_crianca_5++;
					$idade = "(".getLabel('LABEL_CRIANCAS_5ANOS_2', $_SESSION['LANGUAGE']).")";
				break;
				case '2':
					$soma_crianca_6_12++;
					$idade = "(".getLabel('LABEL_CRIANCAS_6A12_2', $_SESSION['LANGUAGE']).")";
				break;
				case '3':
					$soma_crianca_12++;
					$idade = "(".getLabel('LABEL_CRIANCAS_ACIMA12_2', $_SESSION['LANGUAGE']).")";
				break;
			}
			
			$html .= "<div class='EntradaText' style=''><b>".getLabel('LABEL_NAME', $_SESSION['LANGUAGE']).":</b> ".$_POST[$guid_text]." ".$idade."</div>";
			
		$html .= "</div>";
		
	}

	$html .= "<div class='ResetFloat' style=''></div>";
	*/
	//$valor_1 = ($dias * $tqts->VALOR);
	$valor_1 = $tqts->VALOR;

	if($_POST["codpacote"] == "" && strlen($_POST["codpacote"]) != 32)
	{
		$html .= $dormitorio_1->getTextos();
	}
		
	if( $dias == 1 )
	{
		$html .= "<div class='LabelAcomodacaoTitle left'>";
		
		if($_POST["codpacote"] != "" && strlen($_POST["codpacote"]) == 32)
		{
			$html .= "<div class='LabelAcomodacaoTitle left'>".getLabel('LABEL_TOTAL', $_SESSION['LANGUAGE'])." R$ ".formataReais($tqts->VALOR)."</span></div>";	
		}
	}
	else
	{
		$html .= "<div class='LabelAcomodacaoTitle left'>";
		if($_POST["codpacote"] != "" && strlen($_POST["codpacote"]) == 32)
		{
			//$html .= "<div class='LabelAcomodacaoTitle left'>R$ ".formataReais($tqts->VALOR)." x $dias ".getLabel('LABEL_DIAS', $_SESSION['LANGUAGE'])."= ".formataReais($tqts->VALOR);
		}
		
		
		$html .= "</span></div>";
		if($_POST["dias_desconto"] != "0")
		{
			($_POST["dias_desconto"] == "1")
			? $d = strtolower(getLabel('LABEL_DIARIA', $_SESSION['LANGUAGE']))
			: $d = strtolower(getLabel('LABEL_DIAS', $_SESSION['LANGUAGE']));
			$mult = ($tqts->VALOR*(int)$_POST["dias_desconto"]);
			$valor_1 = ($valor_1-$mult);
			
			if($_POST["codpacote"] != "" && strlen($_POST["codpacote"]) == 32)
			{
				//$html .= "&nbsp;&nbsp;- ".$_POST["dias_desconto"]." $d, ".strtolower(getLabel('LABEL_TOTAL', $_SESSION['LANGUAGE']))." R$ ".formataReais($valor_1);
			}
		}
	}


	if($_POST["codpacote"] != "" && strlen($_POST["codpacote"]) == 32)
	{
		$valor_1=$tqts->VALOR;
	}

	$bruto = ($valor_1+$bruto);

	$fazer_soma = 0;

	for($i=0; $i<10; $i++)
	{
		$qt = "quarto_1_text_name_".$i;
		if($_POST[$qt] != "")
		{
			$fazer_soma++;
		}
	}

	if($soma_adulto==0)
	{
		
		for($i=0;$i<10;$i++)
		{
			for($j=0;$j<10;$j++)
			{
				for($b=0;$b<10;$b++)
				{
					if( $soma_crianca_12 == $i && $soma_crianca_6_12 == $j && $soma_crianca_5 == $b )
					{
						$arr = array($i,$j,$b);
						
						$max = $arr[0];
						$position = 0;
						
						
						for($y=0;$y<(int)count($arr);$y++)
						{
							$arr[$y];
							if( $arr[$y] > $max )
							{
								$position = $y;
								$max = $arr[$y];
							}
						}
						
						$sm = 0;
						
						if( $arr[0] >= 2 && $sm != 2 )
						{
							$soma_crianca_12 = ($soma_crianca_12-2);
							$sm=2;
						}
						elseif($arr[0] == 1 && $sm != 2)
						{
							$soma_crianca_12 = ($soma_crianca_12-1);
							$sm++;
						}	
						
						
						if( $arr[1] >= 2 && $sm != 2 )
						{
							$soma_crianca_6_12 = ($soma_crianca_6_12-2);
							$sm=2;
						}
						elseif($arr[1] == 1 && $sm != 2 )
						{
							$soma_crianca_6_12 = ($soma_crianca_6_12-1);
						}
						
						if( $arr[2] >= 2 && $sm != 2 )
						{
							$soma_crianca_5 = ($soma_crianca_5-2);
						}
						elseif($arr[2] == 1 && $sm != 2 )
						{
							$soma_crianca_5 = ($soma_crianca_5-1);
							$sm++;
						}	
						
					}	
					
				}
				
			}
			
		}
		
	}

	if( $fazer_soma > 2)
	{

		if( $soma_adulto > 2 )
		{
			$soma_adulto = ($soma_adulto-2);
			$adulto = $soma_adulto ;
			$perc_adulto = ($soma_adulto*30);
			
			( $dias == 1 ) ? $valor_pacote = $tqts->VALOR : $valor_pacote = $valor_1;
			
			$valor_pacote_1_perc = ( $valor_pacote/100);
			$soma_adulto = round($valor_pacote_1_perc*$perc_adulto);
		
			$str = getLabel('LABEL_ACRESCIMO', $_SESSION['LANGUAGE']);
			$str = str_replace("%", "$perc_adulto%", $str);
			
			$html .= "<div class='ResetFloat'></div>";
			$html .= "<div class='LabelAcomodacaoTitle left'>$str ( $adulto ".getLabel('LABEL_ADULTO', $_SESSION['LANGUAGE']).") =&nbsp;</span></div>";	
			$html .= "<div class='LabelAcomodacaoTitle left'>R$ ".formataReais($soma_adulto)."</span></div>";	
			
			$valor_1 = ($soma_adulto+$valor_1);
			
			$ADULTO_PERC = 30;
			$ADULTO_PERC_MULT = $perc_adulto;
			$ADULTO_VALOR = ($ADULTO_VALOR+$soma_adulto);
			$ADULTO_EXCEDENTE = ($ADULTO_EXCEDENTE+$adulto);
			
		}
		
		$html .= "<div class='ResetFloat'></div>";
		
		if( $soma_crianca_5 > 1 )
		{
			$crianca_5 = $soma_crianca_5 ;
			$soma_crianca_5 = ($soma_crianca_5-1);
			$perc_crianca_5 = ($soma_crianca_5*15);
			
			( $dias == 1 ) ? $valor_pacote = $tqts->VALOR : $valor_pacote = $valor_1;
			
			$valor_pacote_1_perc = ( $valor_pacote/100);
			$soma_crianca_5 = round($valor_pacote_1_perc*$perc_crianca_5);
		
			$str = getLabel('LABEL_ACRESCIMO', $_SESSION['LANGUAGE']);
			$str = str_replace("%", "$perc_crianca_5%", $str);
			
			$html .= "<div class='ResetFloat'></div>";
			$html .= "<div class='LabelAcomodacaoTitle left'>$str ( $crianca_5 ".getLabel('LABEL_CRIANCAS_5ANOS_2_CORTESIA', $_SESSION['LANGUAGE']).") =&nbsp;</span></div>";	
			$html .= "<div class='LabelAcomodacaoTitle left'>R$ ".formataReais($soma_crianca_5)."</span></div>";	
			
			$valor_1 = ($soma_crianca_5+$valor_1);
			
			$CRIANCA_5_PERC = 15; 
			$CRIANCA_5_PERC_MULT = $perc_crianca_5;
			$CRIANCA_5_VALOR = ($CRIANCA_5_VALOR+$soma_crianca_5);
			$CRIANCA_5_EXCEDENTE = ($CRIANCA_5_EXCEDENTE+$crianca_5);
		}
		
		$html .= "<div class='ResetFloat'></div>";
		
		if( $soma_crianca_6_12 != 0 )
		{
			$crianca_6_12 = $soma_crianca_6_12 ;
			$perc_crianca_6_12 = ($soma_crianca_6_12*15);
			
			( $dias == 1 ) ? $valor_pacote = $tqts->VALOR : $valor_pacote = $valor_1;
			
			$valor_pacote_1_perc = ( $valor_pacote/100);
			$soma_crianca_6_12 = round($valor_pacote_1_perc*$perc_crianca_6_12);
		
			$str = getLabel('LABEL_ACRESCIMO', $_SESSION['LANGUAGE']);
			$str = str_replace("%", "$perc_crianca_6_12%", $str);
			
			$html .= "<div class='ResetFloat'></div>";
			$html .= "<div class='LabelAcomodacaoTitle left'>$str ( $crianca_6_12 ".getLabel('LABEL_CRIANCAS_6A12_2', $_SESSION['LANGUAGE']).") =&nbsp;</span></div>";	
			$html .= "<div class='LabelAcomodacaoTitle left'>R$ ".formataReais($soma_crianca_6_12)."</span></div>";	
			
			$valor_1 = ($soma_crianca_6_12+$valor_1);
			
			$CRIANCA_6A12_PERC = 15;
			$CRIANCA_6A12_PERC_MULT = $perc_crianca_6_12;
			$CRIANCA_6A12_VALOR = ($CRIANCA_6A12_VALOR+$soma_crianca_6_12);
			$CRIANCA_6A12_EXCEDENTE = ($CRIANCA_6A12_EXCEDENTE+$crianca_6_12);
		}
		
		$html .= "<div class='ResetFloat'></div>";
		
		if( $soma_crianca_12 != 0 )
		{
			$crianca_12 = $soma_crianca_12 ;
			$perc_crianca_12 = ($soma_crianca_12*30);
			
			( $dias == 1 ) ? $valor_pacote = $tqts->VALOR : $valor_pacote = $valor_1;
			
			$valor_pacote_1_perc = ( $valor_pacote/100);
			$soma_crianca_12 = round($valor_pacote_1_perc*$perc_crianca_12);
		
			$str = getLabel('LABEL_ACRESCIMO', $_SESSION['LANGUAGE']);
			$str = str_replace("%", "$perc_crianca_12%", $str);
			
			$html .= "<div class='ResetFloat'></div>";
			$html .= "<div class='LabelAcomodacaoTitle left'>$str ( $crianca_12 ".getLabel('LABEL_CRIANCAS_ACIMA12_2', $_SESSION['LANGUAGE']).") =&nbsp;</span></div>";	
			$html .= "<div class='LabelAcomodacaoTitle left'>R$ ".formataReais($soma_crianca_12)."</span></div>";	
			
			$valor_1 = ($soma_crianca_12+$valor_1);
			
			$CRIANCA_12_PERC = 30;	
			$CRIANCA_12_PERC_MULT = $perc_crianca_12;
			$CRIANCA_12_VALOR = ($CRIANCA_12_VALOR+$soma_crianca_12);
			$CRIANCA_12_EXCEDENTE = ($CRIANCA_12_EXCEDENTE+$crianca_12);
		}

	}

	$html .= "<div></div>";

	$html .= "</div>";
	$html .= "<div class='ResetFloat'></div>";
	//$html .= utf8_encode($pqrs->getTextos());
	echo $html;
	
	$conn->close ();
?>