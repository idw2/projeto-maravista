<?php

	function sequenciaDtas( $dinicio, $dfim)
	{
		$di = $dinicio;
		$df = $ddfim;
		$arrDtas[] = $dinicio;
		
		while( $di != $dfim )
		{
			$adianta1 = mysql_query("SELECT DATE_ADD('".$di."', INTERVAL 1 DAY) as DTA");	
			$adianta1 = mysql_fetch_object($adianta1);
			$di = $adianta1->DTA;
			
			if (!in_array($di, $arrDtas)) {
				$arrDtas[] = $di;
			}

		}
		return $arrDtas;
	}
	
	#rotina que verifica se `reservas_rel_datas` está populada
	
	$rotinas = mysql_query("SELECT `CODRESERVA`,`DTAINICIO`,`DTAFIM` FROM `reservas` ORDER BY `DTA` DESC");
	if(mysql_num_rows($rotinas))
	{
		while( $rotina = mysql_fetch_object($rotinas))
		{
			$rrds = mysql_query("SELECT * FROM `reservas_rel_datas` WHERE `CODRESERVA` = '{$rotina->CODRESERVA}'");
			if(!mysql_num_rows($rrds))
			{
				$matriz = sequenciaDtas( $rotina->DTAINICIO, $rotina->DTAFIM);
				for($i=0; $i< sizeof($matriz); $i++)
				{
					mysql_query("INSERT INTO `reservas_rel_datas`(`CODRESERVA`,`DTA`)VALUES('{$rotina->CODRESERVA}','{$matriz[$i]}')");					
				}
			}
		}
	}
	
	
	//$rr = new RevisaReserva();
	//$rr->setIncodquarto($codquartotipo);
	
	/*
	/ *
	//$in = "IN('".implode("','", sequenciaDtas($dtainicio, $dtafim))."')";
	
	
	
	echo "SELECT reservas.DTAINICIO, reservas.DTAFIM FROM reservas
INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
WHERE reservas.DTAINICIO>=NOW()
AND reservas_rel_tipo_quarto.CODTIPOQUARTO='".$codquartotipo."'";
*/




	//preciso sabre quantos quartos estão disponiveis

	
	/*
	foreach(sequenciaDtas($dtainicio, $dtafim) as $name => $val )
	{
		
		//echo ."<br/>"; 
	
	}
	*/
	
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
	
	//preciso checar se existe quartos disponiveis a partir desta datas
	//$strDta
	
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
	/*
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
*/
	$igQuery = "
	SELECT 
		qts.CODQUARTO 
	FROM 
		quartos AS qts 
	INNER JOIN reservas_rel_quartos AS rrq ON rrq.CODQUARTO=qts.CODQUARTO 
	INNER JOIN reservas AS rsv ON rrq.CODRESERVA=rsv.CODRESERVA 
	INNER JOIN reservas_rel_datas AS rrd ON rrd.CODRESERVA=rsv.CODRESERVA 
	WHERE 
	qts.CODQUARTO != '' AND
	rrd.DTA BETWEEN '{$dtainicio}' AND  '{$dtafim}'
	AND (rsv.STATUS>=1 OR rsv.STATUS=3 OR rsv.STATUS=4 OR rsv.STATUS=5 OR rsv.STATUS=6 )";
	
	
	/*	
	SELECT qts.CODQUARTO FROM 
	quartos AS qts 
	INNER JOIN reservas_rel_quartos AS rrq ON rrq.CODQUARTO=qts.CODQUARTO 
	INNER JOIN reservas AS rsv ON rrq.CODRESERVA=rsv.CODRESERVA 
	INNER JOIN reservas_rel_datas AS rrd ON rrd.CODRESERVA=rsv.CODRESERVA 
	WHERE qts.CODQUARTO != '' 
	AND (rrd.DTA BETWEEN '2014-12-01' AND '2014-12-05') 
	AND (rsv.STATUS>=1 OR rsv.STATUS=3 OR rsv.STATUS=4 OR rsv.STATUS=5 OR rsv.STATUS=6 )
	
	SELECT qts.CODQUARTO FROM 
	quartos AS qts 
	INNER JOIN reservas_rel_quartos AS rrq ON rrq.CODQUARTO=qts.CODQUARTO 
	INNER JOIN reservas AS rsv ON rrq.CODRESERVA=rsv.CODRESERVA 
	WHERE qts.CODQUARTO != '' 
	AND 	
	rsv.DTAINICIO BETWEEN '2014-12-01' AND  '2014-12-02'
	OR 
	rsv.DTAFIM BETWEEN '2014-12-01' AND  '2014-12-02'
	AND (rsv.STATUS>=1 OR rsv.STATUS=3 OR rsv.STATUS=4 OR rsv.STATUS=5 OR rsv.STATUS=6 )
	
	
	SELECT * FROM teste
	WHERE CODRESERVA='0DE87EC92C5B0CFD40594847A7478470'
	AND
	DTAFIM BETWEEN '2014-12-01' AND '2014-12-02'
	
	
	SELECT qts.CODQUARTO FROM 
	quartos AS qts 
	INNER JOIN reservas_rel_quartos AS rrq ON rrq.CODQUARTO=qts.CODQUARTO 
	INNER JOIN reservas AS rsv ON rrq.CODRESERVA=rsv.CODRESERVA 
	WHERE qts.CODQUARTO != '' 
	AND rsv.DTAINICIO LIKE '%2014-12-01%' 
	OR rsv.DTAINICIO LIKE '%2014-12-02%' 
	OR rsv.DTAFIM LIKE '%2014-12-01%' 
	OR rsv.DTAFIM LIKE '%2014-12-02%' 
	AND (rsv.STATUS>=1 OR rsv.STATUS=3 OR rsv.STATUS=4 OR rsv.STATUS=5 OR rsv.STATUS=6 )	
	*/
	
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
		AND quartos_rel_quartos_tipo.CODQUARTOTIPO='".$codquartotipo."'
		$emenda 
		ORDER BY (quartos_tipo.VALOR+0),quartos.NOME ASC
	");
	
	if(mysql_num_rows($quarto_tipo) == 0)
	{
		echo Error("LABEL_NAO_TEMOS_QUARTOS_1");
		
	}
	else
	{
		
		$checagem_pessoas = true;
		$np = ($adulto + $crianca);
		
		$pessaos_excedentes = mysql_query("SELECT quartos.PESSOAS FROM 
		`quartos` 
		INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO 
		WHERE quartos_rel_quartos_tipo.CODQUARTOTIPO='".$codquartotipo."'
		AND quartos.PESSOAS >=$np
		$emenda");
		
		if( mysql_num_rows($pessaos_excedentes) == 0 )
		{
			echo Error("LABEL_NAO_TEMOS_QUARTOS_1");
		}
		else
		{
			$pqrs = new PesquisaReserva( $dtainicio, $dtafim, $adulto, $crianca, $language, $crianca0a5, $crianca6a12, $crianca12, $codquartotipo, $codpacote );		
			echo utf8_encode($pqrs->getTextos());
		}
		
	}

	
?>