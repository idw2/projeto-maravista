<?php

	#rotina que verifica se `reservas_rel_datas` est� populada
	
	$rotinas = mysql_query("SELECT `CODRESERVA`,`DTAINICIO`,`DTAFIM` FROM `reservas` ORDER BY `DTA` DESC");
	
	if(mysql_num_rows($rotinas)){
		while( $rotina = mysql_fetch_object($rotinas)){
			$rrds = mysql_query("SELECT * FROM `reservas_rel_datas` WHERE `CODRESERVA` = '{$rotina->CODRESERVA}'");
			if(!mysql_num_rows($rrds))
			{
				$matriz = sequenciaDtas( $rotina->DTAINICIO, $rotina->DTAFIM);
				$length = sizeof($matriz);
				
				for($i=0; $i< $length; $i++)
				{
					if( $i == 0)
					{
						mysql_query("INSERT INTO `reservas_rel_datas`(`CODRESERVA`,`DTA`,`CHECK_IN`)VALUES('{$rotina->CODRESERVA}','{$matriz[$i]}', 'entrada')");					
					} 
					else if($i == ($length-1))
					{
						mysql_query("INSERT INTO `reservas_rel_datas`(`CODRESERVA`,`DTA`,`CHECK_IN`)VALUES('{$rotina->CODRESERVA}','{$matriz[$i]}', 'saida')");					
					}
					else
					{
						mysql_query("INSERT INTO `reservas_rel_datas`(`CODRESERVA`,`DTA`,`CHECK_IN`)VALUES('{$rotina->CODRESERVA}','{$matriz[$i]}', 'estadia')");					
					}
				}
			}
		}
	}
	
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
		AND pacotes.CODQUARTOTIPO='{$codquartotipo}'
		GROUP BY datas.CODDTA
	");	
	
	
	if( mysql_num_rows($datas) )
	{
		while( $data = mysql_fetch_object($datas) )
		{
			$di = $data->DTAINICIO;
			$df = $datas->DTAFIM;
			$arrDtas[] = $data->DTAINICIO;
			
			while( $di != $data->DTAFIM )
			{
				$adianta1 = mysql_query("SELECT DATE_ADD('{$di}', INTERVAL 1 DAY) as DTA");	
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
		$strDta .= "{$di};";
		
		$adianta1 = mysql_query("SELECT DATE_ADD('{$di}', INTERVAL 1 DAY) as DTA");	
		$adianta1 = mysql_fetch_object($adianta1);
		$di = $adianta1->DTA;
		
		if (in_array($di, $arrDtas)) {
			$dtasPacote = true;
		}
			
	}
		
	$strDta .= "$df;";
	$strDta = explode(";", $strDta);
	
	//preciso checar se existe quartos disponiveis a partir desta datas
	
	$likei = "";
	$likef = "";
	
	//aqui ele est� montando a query para checar as datas corretamente
	if(sizeof($strDta) != 0)
	{
		$i=0;
		foreach($strDta as $g)
		{
			if($g != "")
			{
				($i == 0)
				? $likei .=" rsv.DTAINICIO LIKE '%{$g}%'"
				: $likei .=" OR rsv.DTAINICIO LIKE '%{$g}%'";
				
				$likef .=" OR rsv.DTAFIM LIKE '%{$g}%'"; 
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
	INNER JOIN reservas_rel_datas AS rrd ON rrd.CODRESERVA=rsv.CODRESERVA 
	WHERE 
	qts.CODQUARTO != '' AND rrd.DTA BETWEEN '{$dtainicio}' AND  '{$dtafim}'
	AND rsv.STATUS!=2";
	
	$arrs = mysql_query($igQuery);
	$emenda = "";		
	
	if( mysql_num_rows($arrs) != 0)
	{
		while( $arr = mysql_fetch_object($arrs))
		{
			$emenda .= "'{$arr->CODQUARTO}'";
		}
	}
	
	if( $emenda != "" )
	{
		$emenda = str_replace("''","','", $emenda);
		$emenda = "AND quartos.CODQUARTO NOT IN({$emenda})";
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
		AND quartos_rel_quartos_tipo.CODQUARTOTIPO='{$codquartotipo}'
		{$emenda} 
		ORDER BY (quartos_tipo.VALOR+0),quartos.NOME ASC
	");
	
	#aqui inicia a checagem dos quartos quanto a entrada e a saida
	
	$qntd_quartos = mysql_num_rows(mysql_query("SELECT * FROM quartos
	INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
	INNER JOIN quartos_tipo ON quartos_tipo.CODQUARTOTIPO=quartos_rel_quartos_tipo.CODQUARTOTIPO
	WHERE quartos_tipo.CODQUARTOTIPO='{$codquartotipo}' 
	AND quartos_tipo.STATUS=1 
	AND quartos.STATUS=1
	GROUP BY quartos.CODQUARTO"));
	
	$qntd_quartos_reservados = mysql_num_rows(mysql_query("SELECT * FROM reservas
	INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
	INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
	WHERE reservas_rel_datas.DTA  BETWEEN '{$dtainicio}' AND '{$dtafim}' 
	AND reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' AND reservas.STATUS=1
	GROUP BY reservas.CODRESERVA"));
		
	$saida = mysql_num_rows(mysql_query("SELECT * FROM reservas
	INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
	INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
	WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
	AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
	AND reservas_rel_datas.DTA='{$dtainicio}' AND reservas_rel_datas.CHECK_IN='entrada'
	GROUP BY reservas.CODRESERVA"));		
	
	if( $saida )
	{
		if( $qntd_quartos == $saida ){
			echo Error("LABEL_NAO_TEMOS_QUARTOS_1");
			return;
		}
		
	}
	else
	{ 
		$entrada = mysql_num_rows(mysql_query("SELECT * FROM reservas
		INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
		INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
		WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
		AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
		AND (reservas_rel_datas.DTA='{$dtafim}' AND reservas_rel_datas.CHECK_IN='saida')"));
		
		if( $qntd_quartos == $entrada ){
			echo Error("LABEL_NAO_TEMOS_QUARTOS_1");
			return;
		}
	}
	
	$_possibilidades = ($qntd_quartos*2);
	$_teste = mysql_num_rows(mysql_query("SELECT * FROM reservas
		INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
		INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
		WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
		AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
		AND reservas_rel_datas.DTA BETWEEN '{$dtainicio}' AND '{$dtafim}'
		GROUP BY reservas.CODRESERVA"));
	
	//echo $_teste."<br/>";
	//echo $_possibilidades."<br/>";
	
	$_teste2 = mysql_num_rows(mysql_query("SELECT * FROM reservas
		INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
		INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
		WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
		AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
		AND reservas_rel_datas.DTA BETWEEN '{$dtainicio}' AND '{$dtafim}'
		AND reservas_rel_datas.CHECK_IN='estadia'
		GROUP BY reservas.CODRESERVA"));
	
	if( $_teste >= $_possibilidades ){
		echo Error("LABEL_NAO_TEMOS_QUARTOS_1");
		return;
	}
	else
	{
		if( $qntd_quartos == $_teste2){
			echo Error("LABEL_NAO_TEMOS_QUARTOS_1");
			return;
		}
		
		#verifica quantos quartos estão ocupados conforme o numero de pessoas
		#aqui ele me devolve uma lista de chaves de quartos ocupados
		$_ocupados = mysql_query("SELECT reservas_rel_quartos.CODQUARTO FROM reservas
INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODRESERVA=reservas.CODRESERVA
INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
INNER JOIN quartos ON quartos.CODQUARTO=reservas_rel_quartos.CODQUARTO
INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO 
WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}'
AND reservas_rel_datas.DTA BETWEEN '{$dtainicio}' AND '{$dtafim}'
AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
GROUP BY reservas.CODRESERVA");

		if(mysql_num_rows($_ocupados)){
			while($rows = mysql_fetch_object($_ocupados)){
				$_quartos[] = $rows->CODQUARTO;
			}
		}
		
		if(is_array($_quartos)){
			$_qts = "('".implode("','", $_quartos)."')";
		}
		
		$checagem_pessoas = true;
		(int)$accc = ((int)$adulto+(int)$crianca0a5+(int)$crianca6a12+(int)$crianca12);
		
		if( $_qts == ""){
			$pessaos_excedentes = mysql_query("SELECT quartos.PESSOAS FROM 
			`quartos` 
			INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO 
			WHERE quartos_rel_quartos_tipo.CODQUARTOTIPO='{$codquartotipo}'
			AND quartos.PESSOAS >={$accc} ORDER BY (quartos.PESSOAS+0) ASC");
		} else {
			$pessaos_excedentes = mysql_query("SELECT quartos.PESSOAS FROM 
			`quartos` 
			INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO 
			WHERE quartos_rel_quartos_tipo.CODQUARTOTIPO='{$codquartotipo}'
			AND quartos.PESSOAS >={$accc} AND quartos.CODQUARTO NOT IN{$_qts} ORDER BY (quartos.PESSOAS+0) ASC");
		}
			
		if( mysql_num_rows($pessaos_excedentes) == 0 )
		{
			
			
			############################################################################################
			#                                                                                          #
			#      Checar se existe datas de entrada e saida e se é possível fazer a reserva.          #
			#                                                                                          #
			############################################################################################
						
			$qntd_quartos = mysql_num_rows(mysql_query("SELECT * FROM quartos
			INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
			INNER JOIN quartos_tipo ON quartos_tipo.CODQUARTOTIPO=quartos_rel_quartos_tipo.CODQUARTOTIPO
			WHERE quartos_tipo.CODQUARTOTIPO='{$codquartotipo}' 
			AND quartos_tipo.STATUS=1 
			AND quartos.STATUS=1
			AND quartos.PESSOAS >={$accc}
			GROUP BY quartos.CODQUARTO"));
			
			$qntd_quartos_reservados = mysql_num_rows(mysql_query("SELECT * FROM reservas
			INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
			INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
			INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODRESERVA=reservas.CODRESERVA
			INNER JOIN quartos ON quartos.CODQUARTO=reservas_rel_quartos.CODQUARTO
			WHERE reservas_rel_datas.DTA  BETWEEN '{$dtainicio}' AND '{$dtafim}' 
			AND reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
			AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
			AND quartos.PESSOAS >={$accc}
			GROUP BY reservas.CODRESERVA"));

			
			$saida = mysql_num_rows(mysql_query("SELECT * FROM reservas
			INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
			INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
			INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODRESERVA=reservas.CODRESERVA
			INNER JOIN quartos ON quartos.CODQUARTO=reservas_rel_quartos.CODQUARTO
			WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
			AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
			AND quartos.PESSOAS >={$accc}
			AND reservas_rel_datas.DTA='{$dtainicio}' AND reservas_rel_datas.CHECK_IN='entrada'
			GROUP BY reservas.CODRESERVA"));		
			
			//echo $qntd_quartos."<br/>";
			//echo $saida."<br/>";
			
			if( $saida )
			{
				if( $qntd_quartos == $saida ){
					echo Error("LABEL_NAO_TEMOS_QUARTOS");
					return;
				}
				
			}
			else
			{ 
				$entrada = mysql_num_rows(mysql_query("SELECT * FROM reservas
				INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
				INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
				INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODRESERVA=reservas.CODRESERVA
				INNER JOIN quartos ON quartos.CODQUARTO=reservas_rel_quartos.CODQUARTO
				WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
				AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
				AND quartos.PESSOAS >={$accc}
				AND (reservas_rel_datas.DTA='{$dtafim}' AND reservas_rel_datas.CHECK_IN='saida')"));
				
				if( $qntd_quartos == $entrada ){
					echo Error("LABEL_NAO_TEMOS_QUARTOS");
					return;
				}
			}
			
			$_possibilidades = ($qntd_quartos*2);
			$_teste = mysql_num_rows(mysql_query("SELECT * FROM reservas
				INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
				INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
				INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODRESERVA=reservas.CODRESERVA
				INNER JOIN quartos ON quartos.CODQUARTO=reservas_rel_quartos.CODQUARTO
				WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
				AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
				AND quartos.PESSOAS >={$accc}
				AND reservas_rel_datas.DTA BETWEEN '{$dtainicio}' AND '{$dtafim}'
				GROUP BY reservas.CODRESERVA"));
			
			//echo $_teste."<br/>";
			//echo $_possibilidades."<br/>";
			
			$_teste2 = mysql_num_rows(mysql_query("SELECT * FROM reservas
				INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
				INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
				INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODRESERVA=reservas.CODRESERVA
				INNER JOIN quartos ON quartos.CODQUARTO=reservas_rel_quartos.CODQUARTO
				WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
				AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
				AND quartos.PESSOAS >={$accc}
				AND reservas_rel_datas.DTA BETWEEN '{$dtainicio}' AND '{$dtafim}'
				AND reservas_rel_datas.CHECK_IN='estadia'
				GROUP BY reservas.CODRESERVA"));
			
			if( $_teste >= $_possibilidades ){
				echo Error("LABEL_NAO_TEMOS_QUARTOS");
				return;
			}
			else
			{
				if( $qntd_quartos == $_teste2){
					echo Error("LABEL_NAO_TEMOS_QUARTOS");
					return;
				}
			}
			
		}
		
		
		############################################################################################
		#                                                                                          #
		#    Checa a disposição de quartos, caso não tenha o sistema informa a falta de quartos.   #
		#                                                                                          #
		############################################################################################
							
		$get_array_codquarto = get_array_codquarto($codquartotipo);
	
		if($get_array_codquarto){
			
			$resolve_primeiro_conflito = resolve_primeiro_conflito($get_array_codquarto, $codquartotipo, $dtainicio, $dtafim);			
			
			if(is_array($resolve_primeiro_conflito)){
				
				$array_codquarto = $resolve_primeiro_conflito;
				
				$get_codquarto_session = get_codquarto_session($array_codquarto, $codquartotipo, $accc);
				
				if($get_codquarto_session){
					$codquarto = $get_codquarto_session;
				} else {
					echo Error("LABEL_NAO_TEMOS_QUARTOS_1");
					return;
				}
			} else {
				echo Error("LABEL_NAO_TEMOS_QUARTOS_1");
				return;
			}
		} else {
			echo Error("LABEL_NAO_TEMOS_QUARTOS_1");
			return;
		}
		
	
		
		/*
		else
		{
			//require("valida_hospedagem2_continue.php");
		}

		
		$adt = mysql_query("SELECT DATE_ADD('{$dtainicio}', INTERVAL 1 DAY) as DTA");	
		$adt = mysql_fetch_object($adt);
		
		$atrz = mysql_query("SELECT DATE_ADD('{$dtafim}', INTERVAL -1 DAY) as DTA");	
		$atrz = mysql_fetch_object($atrz);
		
		echo $adt->DTA."<br/>";
		echo $atrz->DTA."<br/>";
		*/
	}

	$pqrs = new PesquisaReserva( $dtainicio, $dtafim, $adulto, $crianca, $language, $crianca0a5, $crianca6a12, $crianca12, $codquartotipo, $codpacote, $codquarto );		
	echo utf8_encode($pqrs->getTextos());
	