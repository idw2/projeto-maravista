<?php

#
# pega o codigo dos quartos pelo tipo do quarto
#
function get_array_codquarto($codquartotipo){

	$dados = mysql_query("SELECT quartos.CODQUARTO FROM quartos
		INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
		INNER JOIN quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
		WHERE quartos_tipo.CODQUARTOTIPO='{$codquartotipo}'
		GROUP BY quartos.CODQUARTO");
		
	if(mysql_num_rows($dados)){
		while( $dado = mysql_fetch_object($dados)){
			$arr[] = $dado->CODQUARTO;	
		}
		return array_unique($arr);
	} else {
		return false;
	}


}

#
# retorna o codigo dos quartos ocupados
#
function resolve_primeiro_conflito(Array $get_array_codquarto, $codquartotipo, $dtainicio, $dtafim){
	
	$dados = mysql_query("SELECT reservas_rel_quartos.CODQUARTO FROM reservas 
	INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODRESERVA=reservas.CODRESERVA
	INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
	INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
	WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}'
	AND reservas_rel_datas.DTA BETWEEN DATE_ADD('{$dtainicio}', INTERVAL 1 DAY) AND DATE_ADD('{$dtafim}', INTERVAL -1 DAY)
	GROUP BY reservas_rel_quartos.CODQUARTO");
	
	/*echo "SELECT DATE_ADD('{$dtainicio}', INTERVAL 1 DAY)";
	exit();
	
	echo "SELECT reservas_rel_quartos.CODQUARTO FROM reservas 
	INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODRESERVA=reservas.CODRESERVA
	INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
	INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
	WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}'
	AND reservas_rel_datas.DTA BETWEEN DATE_ADD('{$dtainicio}', INTERVAL 1 DAY) AND DATE_ADD('{$dtafim}', INTERVAL -1 DAY)
	GROUP BY reservas_rel_quartos.CODQUARTO";
	exit();
	*/
	$arr = array();
	
	if(mysql_num_rows($dados)){
		while( $dado = mysql_fetch_object($dados)){
			$arr[] = $dado->CODQUARTO;	
		}
		return array_diff($get_array_codquarto, array_unique($arr));
	} else {
		return $arr;
	}
	
}

#
# retorna o codigo dos quartos ocupados
#
function get_codquarto_session(Array $array_codquarto, $codquartotipo, $pessoas){

	
	if( sizeof( $array_codquarto)){
		$_notin = "AND quartos.CODQUARTO IN('".implode("','", $array_codquarto)."')";
	}
	
	$dados = mysql_query("SELECT quartos.CODQUARTO, quartos.PESSOAS FROM quartos  
	INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
	WHERE quartos_rel_quartos_tipo.CODQUARTOTIPO='{$codquartotipo}'
	{$_notin}
	GROUP BY quartos.CODQUARTO
	ORDER BY (quartos.PESSOAS+0) ASC
	");
	
	if(mysql_num_rows($dados)){
		
		while( $row = mysql_fetch_object($dados)){
		
			if( (int)$row->PESSOAS >= (int)$pessoas){
				return $row->CODQUARTO;
			}				
		}		
		return false;
	} else {
		return false;
	}
}


#1º saber quais quartos estão alugados em determinado periodo 
#2º conflitar os quartos alugados com a intensão de aluguel
#3º checar se a data 

/*
return "SELECT quartos.CODQUARTO FROM quartos
INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
INNER JOIN quartos_tipo ON quartos_tipo.CODQUARTOTIPO=quartos_rel_quartos_tipo.CODQUARTOTIPO
INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODQUARTO=quartos.CODQUARTO
WHERE quartos_tipo.CODQUARTOTIPO='{$codquartotipo}'
GROUP BY quartos.CODQUARTO
";*/







?>