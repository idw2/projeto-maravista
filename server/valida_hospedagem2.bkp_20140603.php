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
	$codpacote = trim($_POST["codpacote"]);
	
	function Error($erroname)
	{
		if( $erroname == "DATAS_RESERVADAS_PACOTES" )
		{
			$html = "<div id='inline1' style='display: block;'>";
				$html .= "<p>";
					  $html .= "<form id='formReserva' name='form1' method='post' novalidate action='index.php?actionType=reservas.forma.pgto.cielo' style='max-width: initial'>";
								  $html .= "<div class='ContainerAcomodacao pag-deposito'>";
										$html .= "<p>";
										$html .="<div class='sep-pattern-1'></div>";
											  $html .="<center>";
													$html .="<h1 class='alert-green' style='font-size: 2.4rem; padding: 98px;'>";
														  $html .= getLabel('LABEL_DTA_RESERVAS', $_SESSION['LANGUAGE']);
													$html .="</h1>";
											  $html .="</center>";
											 
											  $html .="<div class='sep-pattern-1'></div>";
										$html .= "</p>";
								  $html .= "</div>";	
								  $html .= "<div><a class='BtnFiltro small full-width push-right' href='index.php?actionType=pacotes'>".getLabel('LABEL_PACOTES', $_SESSION['LANGUAGE'])."</a></div>";		
					  $html .= "</form>";
				$html .= "</p>";
			$html .= "</div>";
			
			return utf8_encode($html);
		}
		elseif( $erroname == "DATAS_INDIPONIVEL" )
		{
			 $html .= "<div id='inline1' style='display: block;'>";
				$html .= "<p>";
					  $html .= "<form id='formReserva' name='form1' method='post' novalidate action='index.php?actionType=reservas.forma.pgto.cielo' style='max-width: initial'>";
								  $html .= "<div class='ContainerAcomodacao pag-deposito'>";
										$html .= "<p>";
										$html .="<div class='sep-pattern-1'></div>";
											  $html .="<center>";
													$html .="<h1 class='alert-green' style='font-size: 2.4rem; padding: 98px;'>";
														  $html .= getLabel('LABEL_NAO_TEMOS_QUARTOS', $_SESSION['LANGUAGE']);
													$html .="</h1>";
											  $html .="</center>";
											 
											  $html .="<div class='sep-pattern-1'></div>";
										$html .= "</p>";
								  $html .= "</div>";		
					  $html .= "</form>";
				$html .= "</p>";
			$html .= "</div>";

			return utf8_encode($html);
		}
		elseif( $erroname == "PESSOAS_EXCEDENTES" )
		{
			$html .= "<div id='inline1' style='display: block;'>";
                $html .= "<p>";
                      $html .= "<form id='formReserva' name='form1' method='post' novalidate action='index.php?actionType=reservas.forma.pgto.cielo' style='max-width: initial'>";
                                  $html .= "<div class='ContainerAcomodacao pag-deposito'>";
                                        $html .= "<p>";
                                        $html .="<div class='sep-pattern-1'></div>";
                                              $html .="<center>";
                                                    $html .="<h1 class='alert-green' style='font-size: 2.4rem; padding: 98px;'>";
                                                          $html .= getLabel('LABEL_NAO_TEMOS_QUARTOS', $_SESSION['LANGUAGE']);
                                                    $html .="</h1>";
                                              $html .="</center>";
                                             
                                              $html .="<div class='sep-pattern-1'></div>";
                                        $html .= "</p>";
                                  $html .= "</div>";		
                      $html .= "</form>";
                $html .= "</p>";
			$html .= "</div>";
		
			return utf8_encode($html);
		}
	}
	
	
	//query que pesquisa as datas e seus intervalos dentro de um pacote
	$pacote_envolvido = mysql_query("SELECT 1 FROM datas
	INNER JOIN pacotes_rel_datas ON pacotes_rel_datas.CODDTA=datas.CODDTA
	INNER JOIN pacotes ON pacotes.CODPACOTE=pacotes_rel_datas.CODPACOTE
	WHERE datas.STATUS=1
	AND ((datas.DTAINICIO BETWEEN '".$dtainicio."' AND '".$dtainicio."') OR (datas.DTAFIM BETWEEN '".$dtainicio."' AND '".$dtainicio."'))
	AND pacotes.CODQUARTOTIPO='".$codquartotipo."'
	GROUP BY datas.CODDTA");
	
	if( mysql_num_rows($pacote_envolvido) == 1 )
	{
		echo Error("DATAS_RESERVADAS_PACOTES");
	}			
	else
	{
	
		$checagem_pessoas = true;
		(int)$accc = ((int)$adulto+(int)$crianca0a5+(int)$crianca6a12+(int)$crianca12);
		
		$pessaos_excedentes = mysql_query("SELECT quartos.PESSOAS FROM 
		`quartos` 
		INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO 
		WHERE quartos_rel_quartos_tipo.CODQUARTOTIPO='".$codquartotipo."'
		AND quartos.PESSOAS >= $accc");
		
		if( mysql_num_rows($pessaos_excedentes) == 0 )
		{
			echo Error("PESSOAS_EXCEDENTES");
		}
		else
		{
			
			$arrDtas = array();
			$dtasPacote = false;
			
			
			$datas = mysql_query("
				SELECT 
				datas.DTAINICIO,
				datas.DTAFIM
				FROM datas
				INNER JOIN pacotes_rel_datas ON pacotes_rel_datas.CODDTA=datas.CODDTA
				INNER JOIN pacotes ON pacotes.CODPACOTE=pacotes_rel_datas.CODPACOTE
				WHERE datas.STATUS=1
				AND pacotes.CODQUARTOTIPO='".$codquartotipo."'
				GROUP BY datas.CODDTA
			");	
			
			
			
			if( mysql_num_rows($datas) != 0)
			{
				while( $data = mysql_fetch_object($datas) )
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
			
			$di = $dtainicio;
			$df = $dtafim;
			$strDta = "";
			
			while( $di != $df )
			{
				$strDta .= "$di;";
				
				$adianta1 = mysql_query("SELECT DATE_ADD('".$di."', INTERVAL 1 DAY) as DTA");	
				$adianta1 = mysql_fetch_object($adianta1);
				$di = $adianta1->DTA;
				
				if (in_array($di, $arrDtas)) {
					$dtasPacote = true;
				}
					
			}
			
			$strDta .= "$df;";
			$strDta = explode(";", $strDta);
			
			$likei = "";
			$likef = "";
			
			//aqui ele está montando a query para checar as datas corretamente
			if(sizeof($strDta) != 0)
			{
				$i=0;
				foreach($strDta as $g)
				{
					if($g != "")
					{
						($i == 0)
						? $likei .=" rsv.DTAINICIO LIKE '%$g%'"
						: $likei .=" OR rsv.DTAINICIO LIKE '%$g%'";
						
						$likef .=" OR rsv.DTAFIM LIKE '%$g%'"; 
						$i++;
					}
				}
			}
			
			
			$igQuery = "
			SELECT 
				qts.CODQUARTO 
			FROM 
				quartos AS qts 
			INNER JOIN reservas_rel_quartos AS rrq ON rrq.CODQUARTO=qts.CODQUARTO 
			INNER JOIN reservas AS rsv ON rrq.CODRESERVA=rsv.CODRESERVA 
			WHERE 
			qts.CODQUARTO != '' AND
			$likei
			$likef
			AND (rsv.STATUS>=1 OR rsv.STATUS=3 OR rsv.STATUS=4 OR rsv.STATUS=5 OR rsv.STATUS=6 )";
			
			$arrs = mysql_query($igQuery);
			$emenda = "";		
			
			if( mysql_num_rows($arrs) != 0)
			{
				while( $arr = mysql_fetch_object($arrs))
				{
					$emenda .= "'$arr->CODQUARTO'";
				}
			}
			
			if( $emenda != "" )
			{
				$emenda = str_replace("''","','", $emenda);
				$emenda = "AND quartos.CODQUARTO NOT IN($emenda)";
			}
			
			$quarto_tipo = mysql_query("
				SELECT 
					quartos_tipo.CODQUARTOTIPO, 
					quartos_tipo.NOME as TIPO, 
					quartos_tipo.SIGLA, 
					quartos.CODQUARTO, 
					quartos.NOME
				FROM 
					quartos
				INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
				INNER JOIN quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
				WHERE quartos.STATUS=1 AND quartos_tipo.STATUS=1
				AND quartos_rel_quartos_tipo.CODQUARTOTIPO='".$_POST["codquartotipo"]."'
				$emenda 
				ORDER BY (quartos_tipo.VALOR+0),quartos.NOME ASC
			");
			
			if(mysql_num_rows($quarto_tipo) == 0)
			{
				echo Error("DATAS_INDIPONIVEL");
			}
			else
			{
				$pqrs = new PesquisaReserva( $dtainicio, $dtafim, $adulto, $crianca, $language, $crianca0a5, $crianca6a12, $crianca12, $codquartotipo, $codpacote );		
				echo utf8_encode($pqrs->getTextos());
			}
			
		}
		
	}
	
	
	
	return;
	
	
	
	/*
	 * verifica se existe as datas solicitadas estão dentro de algum pacote
	 */
	
	
	$arrDtas = array();
	$dtasPacote = false;
	
	
	//aqui estamos conferindo quais são as datas onde existem pacotes
	
	$datas = mysql_query("
		SELECT 
		datas.DTAINICIO,
		datas.DTAFIM
		FROM datas
		INNER JOIN pacotes_rel_datas ON pacotes_rel_datas.CODDTA=datas.CODDTA
		INNER JOIN pacotes ON pacotes.CODPACOTE=pacotes_rel_datas.CODPACOTE
		WHERE datas.STATUS=1
		AND pacotes.CODQUARTOTIPO='".$codquartotipo."'
		GROUP BY datas.CODDTA
	");

	
	//aqui estamos montando um array de datas para filtragem
	//as funções de comparação de datas no mysql não estão funcionando corretamente neste ambiente
	
	if( mysql_num_rows($datas) != 0)
	{
		while( $data = mysql_fetch_object($datas) )
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
	
	$di = $dtainicio;
	$df = $dtafim;
	$strDta = "";
	
	//aqui ele está checando se existe alguma data maracada por meio de um loop
	while( $di != $df )
	{
		$strDta .= "$di;";
		
		$adianta1 = mysql_query("SELECT DATE_ADD('".$di."', INTERVAL 1 DAY) as DTA");	
		$adianta1 = mysql_fetch_object($adianta1);
		$di = $adianta1->DTA;
		
		//aqui ele está indicando nesta variável que existe uma data escolhida pelo cliente que provavelmente é a mesma de um pacote
		if (in_array($di, $arrDtas)) {
			$dtasPacote = true;
		}

	}
	
	$strDta .= "$df;";
	$strDta = explode(";", $strDta);
	
	$likei = "";
	$likef = "";
	
	//aqui ele está montando a query para checar as datas corretamente
	if(sizeof($strDta) != 0)
	{
		$i=0;
		foreach($strDta as $g)
		{
			if($g != "")
			{
				($i == 0)
				? $likei .=" rsv.DTAINICIO LIKE '%$g%'"
				: $likei .=" OR rsv.DTAINICIO LIKE '%$g%'";
				
				$likef .=" OR rsv.DTAFIM LIKE '%$g%'"; 
				$i++;
			}
		}
	}
	
	
	$igQuery = "
	SELECT 
		qts.CODQUARTO 
	FROM 
		quartos AS qts 
	INNER JOIN reservas_rel_quartos AS rrq ON rrq.CODQUARTO=qts.CODQUARTO 
	INNER JOIN reservas AS rsv ON rrq.CODRESERVA=rsv.CODRESERVA 
	WHERE 
	qts.CODQUARTO != '' AND
	$likei
	$likef
	AND (rsv.STATUS>=1 OR rsv.STATUS=3 OR rsv.STATUS=4 OR rsv.STATUS=5 OR rsv.STATUS=6 )";
	
	/*
	 * verifica a quantidade de pessoas nos quartos
	 */
	
	$checagem_pessoas = true;
	(int)$accc = ((int)$adulto+(int)$crianca0a5+(int)$crianca6a12+(int)$crianca12);
	
	$quartos = mysql_query("SELECT quartos.PESSOAS FROM 
	`quartos` 
	INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO 
	WHERE quartos_rel_quartos_tipo.CODQUARTOTIPO='".$codquartotipo."'
	AND quartos.PESSOAS >= $accc");
	 
	 /*
	 * verifica a disponibilidade de pessoas nos quartos
	 */
	
	
	if( mysql_num_rows($quartos) != 0 )
	{
		
		$reserva->DTAINICIO = formataDataForUSA($_POST["dtainicio"]);
		$reserva->DTAFIM = formataDataForUSA($_POST["dtafim"]);
		
		/*
		 * checa por meio das datas se existe o quarto da suite em questao ocupado
		 */
		
		$arrs = mysql_query($igQuery);
		
		/*
		 * prepara uma string com chaveamento dos quartos da categoria em questao que nao pode ser
		 * ocupado pois ja possui visitantes
		 */
		$emenda = "";		
		if( mysql_num_rows($arrs) != 0)
		{
			while( $arr = mysql_fetch_object($arrs))
			{
				$emenda .= "'$arr->CODQUARTO'";
			}
		}
		
		/*
		 * monta string com as chaves e um not in mysql pra separar por criterios
		 * foi feito desta maneira pois nem o BETWEEN juntamente com SELECT e NOT IN estao funcionando corretamente 
		 */
		if( $emenda != "" )
		{
			$emenda = str_replace("''","','", $emenda);
			$emenda = "AND quartos.CODQUARTO NOT IN($emenda)";
		}
		
		$quarto_tipo = mysql_query("
			SELECT 
				quartos_tipo.CODQUARTOTIPO, 
				quartos_tipo.NOME as TIPO, 
				quartos_tipo.SIGLA, 
				quartos.CODQUARTO, 
				quartos.NOME
			FROM 
				quartos
			INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
			INNER JOIN quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
			WHERE quartos.STATUS=1 AND quartos_tipo.STATUS=1
			AND quartos_rel_quartos_tipo.CODQUARTOTIPO='".$_POST["codquartotipo"]."'
			$emenda 
			ORDER BY (quartos_tipo.VALOR+0),quartos.NOME ASC
		");
			
		if(mysql_num_rows($quarto_tipo) == 0)
		{
			$html .= "<div id='inline1' style='display: block;'>";
                $html .= "<p>";
                      $html .= "<form id='formReserva' name='form1' method='post' novalidate action='index.php?actionType=reservas.forma.pgto.cielo' style='max-width: initial'>";
                                  $html .= "<div class='ContainerAcomodacao pag-deposito'>";
                                        $html .= "<p>";
                                        $html .="<div class='sep-pattern-1'></div>";
                                              $html .="<center>";
                                                    $html .="<h1 class='alert-green' style='font-size: 2.4rem; padding: 98px;'>";
                                                          $html .= getLabel('LABEL_NAO_TEMOS_QUARTOS_1', $_SESSION['LANGUAGE']);
                                                    $html .="</h1>";
                                              $html .="</center>";
                                             
                                              $html .="<div class='sep-pattern-1'></div>";
                                        $html .= "</p>";
                                  $html .= "</div>";		
                      $html .= "</form>";
                $html .= "</p>";
          $html .= "</div>";
		 echo utf8_encode($html);
			
		}
		else
		{
			//if($dtasPacote && strlen($codpacote) != 32)
			if( mysql_num_rows($pacote_envolvido) == 1 )
			{
				echo Error("DATAS_RESERVADAS_PACOTES");
			}			
			else
			{
				$pqrs = new PesquisaReserva( $dtainicio, $dtafim, $adulto, $crianca, $language, $crianca0a5, $crianca6a12, $crianca12, $codquartotipo, $codpacote );		
				echo utf8_encode($pqrs->getTextos());
			}
		}
	
	}
	else
	{		 
		 $html .= "<div id='inline1' style='display: block;'>";
                $html .= "<p>";
                      $html .= "<form id='formReserva' name='form1' method='post' novalidate action='index.php?actionType=reservas.forma.pgto.cielo' style='max-width: initial'>";
                                  $html .= "<div class='ContainerAcomodacao pag-deposito'>";
                                        $html .= "<p>";
                                        $html .="<div class='sep-pattern-1'></div>";
                                              $html .="<center>";
                                                    $html .="<h1 class='alert-green' style='font-size: 2.4rem; padding: 98px;'>";
                                                          $html .= getLabel('LABEL_NAO_TEMOS_QUARTOS', $_SESSION['LANGUAGE']);
                                                    $html .="</h1>";
                                              $html .="</center>";
                                             
                                              $html .="<div class='sep-pattern-1'></div>";
                                        $html .= "</p>";
                                  $html .= "</div>";		
                      $html .= "</form>";
                $html .= "</p>";
          $html .= "</div>";
		
		echo utf8_encode($html);
	}
	
	
	$conn->close ();

?>


