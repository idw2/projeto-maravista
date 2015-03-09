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
	$compl = "";
	for($i=0; $i<4; $i++)
	{
		$select_quarto_tipo = "select_quarto_tipo_{$i}";
		$qtp = mysql_query("SELECT NOME FROM `quartos_tipo` WHERE CODQUARTOTIPO='".$_POST[$select_quarto_tipo]."'");
		if(mysql_num_rows($qtp) != 0)
		{
			$qtp = mysql_fetch_object($qtp);
			$count = ($i+1);
			//$compl .= "$count) $qtp->NOME<br/>";
			$compl .= " {$qtp->NOME}<br/>";
		}
	}
	
	$central_emails = mysql_query("SELECT 
	descricao.{$_SESSION['LANGUAGE']} as DESCRICAO
	FROM central_emails
	INNER JOIN central_emails_rel_descricao ON central_emails_rel_descricao.CODCENTRALEMAILS=central_emails.CODCENTRALEMAILS
	INNER JOIN descricao ON central_emails_rel_descricao.CODDESCRICAO=descricao.CODDESCRICAO
	WHERE central_emails.CODCENTRALEMAILS='E1681700B2402F040D00CF68AF57B985'");
	
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
					//$piece .= " ";
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
	$assunto = getLabel('LABEL_PRE_RESERV_CONFIRM', $_SESSION['LANGUAGE'])." - Cod: ".$_POST["N_CONHECIMENTO"];
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