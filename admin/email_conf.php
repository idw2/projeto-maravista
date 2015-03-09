<?php

	$acomodacoes = mysql_query("SELECT 
	quartos.NOME as QUARTO, quartos_tipo.NOME as TIPO, reservas_rel_quartos.REFERENCIA
	FROM quartos_tipo
	INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
	INNER JOIN quartos ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
	INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODTIPOQUARTO=quartos_rel_quartos_tipo.CODQUARTOTIPO
	INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODQUARTO=quartos.CODQUARTO
	WHERE reservas_rel_quartos.CODRESERVA='{$_GET['codreserva']}'
	AND reservas_rel_tipo_quarto.CODRESERVA='{$_GET['codreserva']}'
	GROUP BY reservas_rel_quartos.REFERENCIA
	ORDER BY (reservas_rel_quartos.REFERENCIA+0) ASC");
	
	$compl = "";
	
	if(mysql_num_rows($acomodacoes) != 0)
	{
		$i=1;
		while( $acomodacao = mysql_fetch_object($acomodacoes))
		{
		
			$compl .= "<div>{$i}. ({$acomodacao->TIPO})</div>";
			
			
			$guests = mysql_query("SELECT guest.NOME, guest.FAIXA_ETARIA FROM guest
			INNER JOIN reservas_rel_guest ON reservas_rel_guest.CODGUEST=guest.CODGUEST
			INNER JOIN reservas ON reservas_rel_guest.CODRESERVA=reservas.CODRESERVA
			WHERE reservas_rel_guest.REFERENCIA={$acomodacao->REFERENCIA}
			AND reservas.CODRESERVA='{$_GET['codreserva']}'
			ORDER BY FAIXA_ETARIA ASC");
			
			$compl .= "<ol style='list-style-type: lower-roman'>";
				
			while( $guest = mysql_fetch_object($guests))
			{
				switch($guest->FAIXA_ETARIA)
{
					case '0':
						$guest->FAIXA_ETARIA = "(".getLabel('LABEL_ADULTO', $_SESSION['LANGUAGE']).")";
					break;
					case '1':
						$guest->FAIXA_ETARIA = "(".getLabel('LABEL_CRIANCAS_5ANOS_2', $_SESSION['LANGUAGE']).")";
					break;
					case '2':
						$guest->FAIXA_ETARIA = "(".getLabel('LABEL_CRIANCAS_6A12_2', $_SESSION['LANGUAGE']).")";
					break;
					case '3':
						$guest->FAIXA_ETARIA = "(".getLabel('LABEL_CRIANCAS_ACIMA12_2', $_SESSION['LANGUAGE']).")";
					break;
				}
				$compl .= "<li>$guest->NOME $guest->FAIXA_ETARIA</li>";
			}
			
			$compl .= "</ol>";
			
			$i++;
		}
	}
	
	$especifica_pessoas = mysql_query("SELECT guest.NOME, guest.FAIXA_ETARIA FROM guest
	INNER JOIN reservas_rel_guest ON reservas_rel_guest.CODGUEST=guest.CODGUEST
	INNER JOIN reservas ON reservas_rel_guest.CODRESERVA=reservas.CODRESERVA
	WHERE reservas.CODRESERVA='{$_GET['codreserva']}'
	ORDER BY FAIXA_ETARIA ASC");
	
	$soma_adulto = 0;
	$soma_crianca_5 = 0;
	$soma_crianca_6_12 = 0;
	$soma_crianca_12 = 0;
	
	if(mysql_num_rows($especifica_pessoas) != 0)
	{
		while($esp_pessoas = mysql_fetch_object($especifica_pessoas))
		{
			switch($esp_pessoas->FAIXA_ETARIA)
			{
				case '0':
					$soma_adulto++;
				break;	
				case '1':
					$soma_crianca_5++;
				break;	
				case '2':
					$soma_crianca_6_12++;
				break;	
				case '3':
					$soma_crianca_12++;
				break;	
			}
		}
	}
	
	$reserva = mysql_query("SELECT reservas.*, valor.*, reservas.STATUS as STT FROM reservas 
	INNER JOIN reservas_rel_valor ON reservas_rel_valor.CODRESERVA=reservas.CODRESERVA
	INNER JOIN valor ON reservas_rel_valor.CODVALOR=valor.CODVALOR
	WHERE reservas.CODRESERVA='{$_GET['codreserva']}'");
	
	$reservas_rel_tipo_quarto = mysql_query("SELECT quartos_tipo.NOME, quartos_tipo.CODQUARTOTIPO FROM quartos_tipo
	INNER JOIN reservas_rel_tipo_quarto ON quartos_tipo.CODQUARTOTIPO=reservas_rel_tipo_quarto.CODTIPOQUARTO
	INNER JOIN reservas ON reservas.CODRESERVA=reservas_rel_tipo_quarto.CODRESERVA
	WHERE reservas.CODRESERVA='{$_GET['codreserva']}'");
	
	$pessoa = mysql_query("SELECT pessoa.*, telefones.TELEFONE FROM pessoa
	INNER JOIN reservas_rel_pessoa ON reservas_rel_pessoa.CODPESSOA=pessoa.CODPESSOA
	INNER JOIN reservas ON reservas.CODRESERVA=reservas_rel_pessoa.CODRESERVA
	INNER JOIN pessoa_rel_telefones ON pessoa_rel_telefones.CODPESSOA=pessoa.CODPESSOA
	INNER JOIN telefones ON telefones.CODTELEFONE=pessoa_rel_telefones.CODTELEFONE
	WHERE reservas.CODRESERVA='{$_GET['codreserva']}'");
	
	if(mysql_num_rows($reserva) !=0 )
	{
		$reserva = mysql_fetch_object($reserva);
		$pessoa = mysql_fetch_object($pessoa);
		$total = $reserva->VALOR_TOTAL;
		$sinal = ((int)$reserva->VALOR_TOTAL/2);
	}
	
	$central_emails = mysql_query("SELECT 
	descricao.{$reserva->PREFERENCIA_IDIOMA} as DESCRICAO
	FROM central_emails
	INNER JOIN central_emails_rel_descricao ON central_emails_rel_descricao.CODCENTRALEMAILS=central_emails.CODCENTRALEMAILS
	INNER JOIN descricao ON central_emails_rel_descricao.CODDESCRICAO=descricao.CODDESCRICAO
	WHERE central_emails.CODCENTRALEMAILS='D84C53CE927C9F9A5CD84B504AAB6B70'");
	
	
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
					$piece .= "&nbsp;".$reserva->N_CONHECIMENTO."&nbsp;";
				break;
				case 1:
					$piece .= $pessoa->NOME;
				break;
				case 2:
					$piece .= $pessoa->NOME;
				break;
				case 3:
					$piece .= $reserva->N_CONHECIMENTO;
				break;
				case 4:
					$piece .= formataDataForBrazil($reserva->DTAINICIO);
				break;
				case 5:
					$piece .= formataDataForBrazil($reserva->DTAFIM);
				break;
				case 6:
					$piece .= $reserva->PESSOAS;
				break;
				case 7:
					$piece .= $soma_adulto;
				break;
				case 8:
	
					$t = ($soma_crianca_5+$soma_crianca_6_12+$soma_crianca_12);
					$piece .= $t;
					$piece .= "<br/>";			
					$piece .= "<div>".getLabel('LABEL_CRIANCAS_5ANOS', $_SESSION['LANGUAGE']).": {$soma_crianca_5}</div>";
					$piece .= "<div>".getLabel('LABEL_CRIANCAS_6A12', $_SESSION['LANGUAGE']).": {$soma_crianca_6_12}</div>";
					$piece .= "<div>".getLabel('LABEL_CRIANCAS_ACIMA12', $_SESSION['LANGUAGE']).": {$soma_crianca_12}</div>";
					
				break;
				case 9:
					$piece .= $reserva->QUARTOS;
				break;
				case 10:
					$piece .= $compl;
				break;
				case 11:
					if($reserva->FORMA_PGTO == "1")
					{
						$piece .= "<br/>".getLabel('LABEL_DEPOSITO', $_SESSION['LANGUAGE']);
					}
				break;
				case 12:
					$s = limpaValorReal($total);
					$result = mysql_query("SELECT ROUND({$s}/2) AS RES;");
					while ($row = mysql_fetch_object($result)) {
						$piece .= " ".formataReais($row->RES);
					}
					//$piece .= " ".formataReais($sinal);
				break;
				case 13:
					$piece .= " ".formataReais($total);
				break;
			}		
			
			$i++;
		}
		
	}

	
	$quebra_linha = "\n";
	$emailsender = "no-reply@maravista.com.br";
	$nomeremetente = "Pousada Maravista";
	$emaildesitnatario = $pessoa->EMAIL;
	$nomedesitnatario = $pessoa->NOME;
	$comcopia = "pousada@maravista.com.br";
	$assunto = getLabel('LABEL_RESERVA_CONFIRMADA', $_SESSION['LANGUAGE'])." - Cod: {$reserva->N_CONHECIMENTO}";
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