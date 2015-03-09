<?php


	(int) $soma_adulto = 0;
	(int) $soma_crianca_5 = 0;
	(int) $soma_crianca_6_12 = 0;
	(int) $soma_crianca_12 = 0;
	
	for( $i=0; $i<(int)$_POST["Prepara_pessoas"]; $i++) { $guid_select = "quarto_1_select_".$i; switch($_POST[$guid_select]) { case '0': $soma_adulto++; break; case '1': $soma_crianca_5++; break; case '2': $soma_crianca_6_12++; break; case '3': $soma_crianca_12++; break; }}
	for( $i=0; $i<(int)$_POST["Prepara_pessoas"]; $i++) { $guid_select = "quarto_2_select_".$i; switch($_POST[$guid_select]) { case '0': $soma_adulto++; break; case '1': $soma_crianca_5++; break; case '2': $soma_crianca_6_12++; break; case '3': $soma_crianca_12++; break; }}
	for( $i=0; $i<(int)$_POST["Prepara_pessoas"]; $i++) { $guid_select = "quarto_3_select_".$i; switch($_POST[$guid_select]) { case '0': $soma_adulto++; break; case '1': $soma_crianca_5++; break; case '2': $soma_crianca_6_12++; break; case '3': $soma_crianca_12++; break; }}
	for( $i=0; $i<(int)$_POST["Prepara_pessoas"]; $i++) { $guid_select = "quarto_4_select_".$i; switch($_POST[$guid_select]) { case '0': $soma_adulto++; break; case '1': $soma_crianca_5++; break; case '2': $soma_crianca_6_12++; break; case '3': $soma_crianca_12++; break; }}
	
	//$compl = "<br/>";
	
	$qtp = mysql_query("SELECT NOME FROM `quartos_tipo` WHERE CODQUARTOTIPO='{$_POST['codquartotipo']}'");
	if(mysql_num_rows($qtp)){
		$qtp = mysql_fetch_object($qtp);
		$compl = " {$qtp->NOME}<br/>";
	}
	
	/*
	array(111) { 
	["email"]=> string(24) "rogerio@designlab.com.br" 
	["language"]=> string(9) "PORTUGUES" 
	["telefone"]=> string(15) "(11) 11111-1111" 
	["observacoes"]=> string(0) "" 
	["termos"]=> string(2) "on" 
	["select_quarto_tipo_0"]=> string(32) "3CFFCD5822534F90893EA96EF51FAAC4" 
	["screen_option_0_ok"]=> string(8) "NOACTION" 
	["nome_empresa"]=> string(14) "Rogerio Pontes" 
	["dtainicio"]=> string(10) "2014-09-25" 
	["datainicio"]=> string(10) "25/09/2014" 
	["dtafim"]=> string(10) "2014-09-30" 
	["datafim"]=> string(10) "30/09/2014" 
	["Prepara_datainicio"]=> string(10) "2014-09-25" 
	["Prepara_dtafim"]=> string(10) "2014-09-30" 
	["screen_pessoa_0"]=> string(1) "2" 
	["pessoas"]=> string(1) "2" 
	["Prepara_pessoas"]=> string(1) "2" 
	["Prepara_adultos"]=> string(1) "2" 
	["Prepara_criancas_5a"]=> string(1) "0" 
	["Prepara_criancas_6a12"]=> string(1) "0" 
	["Prepara_criancas_acima12"]=> string(1) "0" 
	["nQuartos"]=> string(1) "1" 
	["ACTION"]=> string(6) "ACTION" 
	["Prepara_nCrianca"]=> string(1) "0" 
	["codpacote"]=> string(0) "" 
	["dias_desconto"]=> string(0) "" 
	["n_adulto"]=> string(1) "2" 
	["n_crianca"]=> string(1) "0" 
	["diffDtainicio"]=> string(10) "2014-09-25" 
	["diffDtafim"]=> string(10) "2014-09-30" 
	["nom_temporada"]=> string(15) "Baixa Temporada" 
	["valor_Diadasemana"]=> string(5) "34500" 
	["valor_Finaldesemana"]=> string(5) "39500" 
	["qntd_Diadasemana"]=> string(1) "2" 
	["qntd_Finaldesemana"]=> string(1) "3" 
	["total"]=> string(6) "187500" 
	["total_formatado"]=> string(8) "1.875,00" 
	["total_dia_semana"]=> string(5) "69000" 
	["total_dia_semana_formatado"]=> string(6) "690,00" 
	["total_fim_semana"]=> string(6) "118500" 
	["total_fim_semana_formatado"]=> string(8) "1.185,00" 
	["codquartotipo"]=> string(32) "3CFFCD5822534F90893EA96EF51FAAC4" 
	["foto"]=> string(86) "../upload/fotos/162D3A887EE60F1467E08B452E87F0A6/10353BAB61DE746CE608E248DD11322F.jpeg" 
	["quartotipo_name"]=> string(14) "STD - Standard" 
	["adulto"]=> string(1) "2" 
	["crianca"]=> string(1) "0" 
	["crianca0a5"]=> string(1) "0" 
	["crianca6a12"]=> string(1) "0" 
	["crianca12"]=> string(1) "0" 
	["dta_inicio_alta"]=> string(10) "2014-12-19" 
	["dta_fim_alta"]=> string(10) "2015-02-28" 
	["dta_inicio_media"]=> string(10) "2014-10-03" 
	["dta_fim_media"]=> string(10) "2014-12-18" 
	["dta_inicio_baixa"]=> string(10) "2014-07-01" 
	["dta_fim_baixa"]=> string(10) "2014-10-02" 
	["acrescimo"]=> string(1) "0" 
	["adulto_perc"]=> string(2) "30" 
	["adulto_perc_mult"]=> string(0) "" 
	["adulto_valor"]=> string(0) "" 
	["adulto_excedente"]=> string(0) "" 
	["crianca_5_perc"]=> string(2) "15" 
	["crianca_5_perc_mult"]=> string(0) "" 
	["crianca_5_valor"]=> string(0) "" 
	["crianca_5_excedente"]=> string(0) "" 
	["crianca_6a12_perc"]=> string(2) "15" 
	["crianca_6a12_perc_mult"]=> string(0) "" 
	["crianca_6a12_valor"]=> string(0) "" 
	["crianca_6a12_excedente"]=> string(0) "" 
	["crianca_12_perc"]=> string(2) "30" 
	["crianca_12_perc_mult"]=> string(0) "" 
	["crianca_12_valor"]=> string(0) "" 
	["crianca_12_excedente"]=> string(0) "" 
	["https"]=> string(43) "https://ssl754.websiteseguro.com/maravista1" 
	["site"]=> string(27) "http://www.maravista.com.br" 
	["valorpacote"]=> string(0) "" 
	["nomepacote"]=> string(0) "" 
	["existe_acrescimo"]=> string(0) "" 
	["$this->nom_pacote"]=> string(0) "" 
	["hospede_adulto_1"]=> string(14) "Rogerio Pontes" 
	["hospede_adulto_2"]=> string(14) "Rogerio Pontes" 
	["responsavel_reserva"]=> string(14) "Rogerio Pontes" 
	["Reservar"]=> string(8) "Reservar" 
	["quarto_1_text_name_0"]=> string(14) "Rogerio Pontes" 
	["quarto_1_select_0"]=> string(1) "0" 
	["quarto_1_text_name_1"]=> string(14) "Rogerio Pontes" 
	["quarto_1_select_1"]=> string(1) "0" 
	["ACTION_FINALIZE"]=> string(15) "ACTION_FINALIZE" 
	["ADULTO_PERC"]=> string(1) "0" 
	["ADULTO_PERC_MULT"]=> string(1) "0" 
	["ADULTO_VALOR"]=> string(1) "0" 
	["ADULTO_EXCEDENTE"]=> string(1) "0" 
	["CRIANCA_5_PERC"]=> string(1) "0" 
	["CRIANCA_5_PERC_MULT"]=> string(1) "0" 
	["CRIANCA_5_VALOR"]=> string(1) "0" 
	["CRIANCA_5_EXCEDENTE"]=> string(1) "0" 
	["CRIANCA_6A12_PERC"]=> string(1) "0" 
	["CRIANCA_6A12_PERC_MULT"]=> string(1) "0" 
	["CRIANCA_6A12_VALOR"]=> string(1) "0" 
	["CRIANCA_6A12_EXCEDENTE"]=> string(1) "0" 
	["CRIANCA_12_PERC"]=> string(1) "0" 
	["CRIANCA_12_PERC_MULT"]=> string(1) "0" 
	["CRIANCA_12_VALOR"]=> string(1) "0" 
	["CRIANCA_12_EXCEDENTE"]=> string(1) "0" 
	["VALOR_BRUTO"]=> string(6) "187500" 
	["VALOR_ACRESCIMO"]=> string(1) "0" 
	["ACRESCIMO_PERC"]=> string(1) "0" 
	["VALOR_TOTAL"]=> string(6) "187500" 
	["PGTO_SINAL"]=> string(5) "93750" 
	["PGTO_RESTANTE"]=> string(5) "93750" 
	["N_CONHECIMENTO"]=> string(10) "STD0000015" 
	["FORMA_PGTO"]=> string(1) "2" 
	}
	*/
	
	/*
	$compl = "";
	for($i=0; $i<4; $i++)
	{
		$select_quarto_tipo = "select_quarto_tipo_".$i;
		$qtp = mysql_query("SELECT NOME FROM `quartos_tipo` WHERE CODQUARTOTIPO='".$_POST[$select_quarto_tipo]."'");
		if(mysql_num_rows($qtp) != 0)
		{
			$qtp = mysql_fetch_object($qtp);
			$count = ($i+1);
			//$compl .= "$count) $qtp->NOME<br/>";
			$compl .= " $qtp->NOME<br/>";
		}
	}
	
	*/
	
	$central_emails = mysql_query("SELECT 
	descricao.{$_SESSION['LANGUAGE']} as DESCRICAO
	FROM central_emails
	INNER JOIN central_emails_rel_descricao ON central_emails_rel_descricao.CODCENTRALEMAILS=central_emails.CODCENTRALEMAILS
	INNER JOIN descricao ON central_emails_rel_descricao.CODDESCRICAO=descricao.CODDESCRICAO
	WHERE central_emails.CODCENTRALEMAILS='854B57ABEBA3D0CD8C48CDF32E22188E'");
	
	if(mysql_num_rows($central_emails) != 0)
	{
		$central_emails = mysql_fetch_object($central_emails);
		
		$piece = "";
		$pieces = explode("(%%%%%)", $central_emails->DESCRICAO);
		
		$i = 0;
		foreach($pieces as $pce)
		{
			$piece .= $pce;
			
			switch($i)
			{
				case 0:
					$piece .= "&nbsp;".$_POST["N_CONHECIMENTO"]."&nbsp;";
				break;
				case 1:
					$piece .= $_POST["nome_empresa"];
				break;
				case 2:
					$piece .= $_POST["nome_empresa"];
				break;
				case 3:
					$piece .= $_POST["N_CONHECIMENTO"];
				break;
				case 4:
					$piece .= $_POST["datainicio"];
				break;
				case 5:
					$piece .= $_POST["datafim"];
				break;
				case 6:
					$piece .= $_POST["Prepara_pessoas"];
				break;
				case 7:
					$piece .= $soma_adulto;
				break;
				case 8:
					$piece .= ($soma_crianca_5+$soma_crianca_6_12+$soma_crianca_12);
				break;
				case 9:
					$piece .= $_POST["nQuartos"];
				break;
				case 10:
					$piece .= $compl;
				break;
				case 11:
					if($_POST["FORMA_PGTO"] == "1")
					{
						$piece .= getLabel('LABEL_DEPOSITO', $_SESSION['LANGUAGE']);
					}
					elseif($_POST["FORMA_PGTO"] == "2")
					{
						$piece .= getLabel('LABEL_CARTAO_CREDITO', $_SESSION['LANGUAGE']);
					}
				break;
				case 12:
					$s = limpaValorReal($_POST["VALOR_TOTAL"]);
					$result = mysql_query("SELECT ROUND({$s}/2) AS RES;");
					while ($row = mysql_fetch_object($result)) {
						$piece .= " ".formataReais($row->RES);
					}
					//$piece .= " ".formataReais($_POST["PGTO_SINAL"]);
				break;
				case 13:
					$piece .= " ".formataReais($_POST["VALOR_TOTAL"]);
				break;
				case 14:
					$piece .= " ".formataReais($_POST["PGTO_SINAL"]);
				break;
			}		
			
			$i++;
		}
		
	}

	$quebra_linha = "\n";
	$emailsender = "no-reply@maravista.com.br";
	$nomeremetente = "Pousada Maravista";
	$emaildesitnatario = $_POST["email"];
	$nomedesitnatario = $_POST["nome_empresa"];
	$comcopia = "pousada@maravista.com.br";
	$assunto =  getLabel('LABEL_PRE_RESERV_CONFIRM_2', $_SESSION['LANGUAGE'])." - Cod: ".$_POST["N_CONHECIMENTO"];
	$assunto = "=?UTF-8?B?" . base64_encode($assunto) . "?=";

	$mensagemHTML = $piece;

	$headers = "MIME-Version: 1.1{$quebra_linha}";
	$headers .= "Content-type: text/html; charset=UTF-8{$quebra_linha}";
	$headers .= "From: \"{$nomeremetente}\"<{$emailsender}>{$quebra_linha}";
	$headers .= "Return-Path: \"{$nomeremetente}\"<{$emailsender}>{$quebra_linha}";
	$headers .= "Cc: {$comcopia}{$quebra_linha}";
	$headers .= "Reply-To: \"{$nomeremetente}\"<{$emailsender}>{$quebra_linha}";
	$headers .= "X-Mailer: PHP/" . phpversion();
	
	mail($emaildesitnatario, $assunto, $mensagemHTML, $headers, $emailsender);
		

?>