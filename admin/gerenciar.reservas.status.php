<?php	acessoDireto( "ADMINISTRADOR;" );		if($_POST["ACTION"] == "ACTION" && $_POST["status"] != "")	{				mysql_query("UPDATE reservas SET STATUS=".$_POST["status"]." WHERE CODRESERVA='".$_GET["codreserva"]."'");		mysql_query("DELETE FROM `reservas_rel_quartos` WHERE CODRESERVA='".$_GET["codreserva"]."'");					$i=1;		foreach($_POST as $name => $value)		{			$quarto = "quarto_".$i;						if($_POST[$quarto] != "")			{				$q = $_POST[$quarto];				$q = explode("_",$q);								$codquartotipo = $q[0];				$codquarto = $q[1];								if( (int)$_POST["status"] != 2 )				{									switch($i)					{						case 1:							mysql_query("INSERT INTO `reservas_rel_quartos` (`CODRESERVA`,`CODQUARTO`,`REFERENCIA`)VALUES('".$_GET["codreserva"]."','$codquarto','1')");						break;							case 2:							mysql_query("INSERT INTO `reservas_rel_quartos` (`CODRESERVA`,`CODQUARTO`,`REFERENCIA`)VALUES('".$_GET["codreserva"]."','$codquarto','2')");						break;						case 3:							mysql_query("INSERT INTO `reservas_rel_quartos` (`CODRESERVA`,`CODQUARTO`,`REFERENCIA`)VALUES('".$_GET["codreserva"]."','$codquarto','3')");						break;						case 4:							mysql_query("INSERT INTO `reservas_rel_quartos` (`CODRESERVA`,`CODQUARTO`,`REFERENCIA`)VALUES('".$_GET["codreserva"]."','$codquarto','4')");						break;					}										}												$i++;				}				}				if($_POST["status"] == "1" && $_POST["NAO_DISPARAR_EMAIL"] == "on")		{			require("email_conf.php");		}		elseif($_POST["status"] == "2")		{			require("email_cancel.php");		}				echo "<script>alert('* ".getLabel('LABEL_ADD_SUCESSO_LABEL', $_SESSION['LANGUAGE'])."!')</script>";		echo "<script>window.location = 'index.php?actionType=gerenciar.reservas';</script>";		exit();			}		$reserva = mysql_query("SELECT reservas.*, valor.*, reservas.STATUS as STT FROM reservas 	INNER JOIN reservas_rel_valor ON reservas_rel_valor.CODRESERVA=reservas.CODRESERVA	INNER JOIN valor ON reservas_rel_valor.CODVALOR=valor.CODVALOR	WHERE reservas.CODRESERVA='".$_GET["codreserva"]."'");			if(mysql_num_rows($reserva) != 0)	{		$reserva = mysql_fetch_object($reserva);				/*		$i=1;				foreach($_POST as $name => $value)		{			$quarto = "quarto_".$i;			if( $_POST[$quarto] != "")			{				$cods = explode("_", $_POST[$quarto]);				$codquartotipo = $cods[0];				$codquarto = $cods[1];			}			$i++;		}*/			}		$reservas_rel_tipo_quarto = mysql_query("SELECT quartos_tipo.NOME, quartos_tipo.CODQUARTOTIPO FROM quartos_tipo	INNER JOIN reservas_rel_tipo_quarto ON quartos_tipo.CODQUARTOTIPO=reservas_rel_tipo_quarto.CODTIPOQUARTO	INNER JOIN reservas ON reservas.CODRESERVA=reservas_rel_tipo_quarto.CODRESERVA	WHERE reservas.CODRESERVA='".$_GET["codreserva"]."'");		$pessoa = mysql_query("SELECT pessoa.*, telefones.TELEFONE FROM pessoa	INNER JOIN reservas_rel_pessoa ON reservas_rel_pessoa.CODPESSOA=pessoa.CODPESSOA	INNER JOIN reservas ON reservas.CODRESERVA=reservas_rel_pessoa.CODRESERVA	INNER JOIN pessoa_rel_telefones ON pessoa_rel_telefones.CODPESSOA=pessoa.CODPESSOA	INNER JOIN telefones ON telefones.CODTELEFONE=pessoa_rel_telefones.CODTELEFONE	WHERE reservas.CODRESERVA='$reserva->CODRESERVA'");		$total = $reserva->VALOR_TOTAL;	$sinal = ((int)$reserva->VALOR_TOTAL/2);		if(mysql_num_rows($pessoa) != 0)	{		$pessoa = mysql_fetch_object($pessoa);	}		if($reserva->FORMA_PGTO == "1")	{		$forma_pgto = getLabel('LABEL_DEPOSITO', $_SESSION['LANGUAGE']);	}			$especifica_pessoas = mysql_query("SELECT guest.NOME, guest.FAIXA_ETARIA FROM guest	INNER JOIN reservas_rel_guest ON reservas_rel_guest.CODGUEST=guest.CODGUEST	INNER JOIN reservas ON reservas_rel_guest.CODRESERVA=reservas.CODRESERVA	WHERE reservas.CODRESERVA='".$_GET["codreserva"]."'	ORDER BY FAIXA_ETARIA ASC");	/*	echo "SELECT guest.NOME, guest.FAIXA_ETARIA FROM guest	INNER JOIN reservas_rel_guest ON reservas_rel_guest.CODGUEST=guest.CODGUEST	INNER JOIN reservas ON reservas_rel_guest.CODRESERVA=reservas.CODRESERVA	WHERE reservas.CODRESERVA='".$_GET["codreserva"]."'	ORDER BY FAIXA_ETARIA ASC";		SELECT guest.CODGUEST, guest.NOME, guest.FAIXA_ETARIA FROM guest	INNER JOIN reservas_rel_guest ON reservas_rel_guest.CODGUEST=guest.CODGUEST	WHERE reservas_rel_guest.CODRESERVA='0530EA4248BB49D7ED8F19E4AC54D81E'	ORDER BY guest.FAIXA_ETARIA ASC	echo "teste: {$_SESSION['LANGUAGE']}";	*/		$soma_adulto = 0;	$soma_crianca_5 = 0;	$soma_crianca_6_12 = 0;	$soma_crianca_12 = 0;		if(mysql_num_rows($especifica_pessoas) != 0)	{		while($esp_pessoas = mysql_fetch_object($especifica_pessoas))		{			switch($esp_pessoas->FAIXA_ETARIA)			{				case '0':					$soma_adulto++;				break;					case '1':					$soma_crianca_5++;				break;					case '2':					$soma_crianca_6_12++;				break;					case '3':					$soma_crianca_12++;				break;				}		}	}		$pi .= "<form name='List' method='post' action='index.php?actionType=gerenciar.reservas.status&codreserva=".$_GET["codreserva"]."'>";			$pi .= "<table width='100%' border='0'>			<tbody>				<tr>					<td>						<table class='container' style='background: #ffffff; width: 630px; text-align: center; border-collapse: collapse;' border='0' cellspacing='0' cellpadding='0'>							<tbody>																<tr class='table'>									<td>										<table width='100%' border='0' cellspacing='4px' cellpadding='0'>											<tbody>";																								$existe_pacote = mysql_query("SELECT * FROM `reservas_rel_pacotes` WHERE CODRESERVA='".$_GET["codreserva"]."'");												if( mysql_num_rows($existe_pacote) != 0)												{													$existe_pacote = mysql_fetch_object($existe_pacote);																										$pi .="<tr>";														$pi .="<td style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; margin: 2px;'>";																													$pi .= "<div class='pint_titulo Acomodacoes'>".getLabel('LABEL_PACOTE_PROMOCIONAL', $_SESSION['LANGUAGE'])."</div>";																					$pacotes = mysql_query("																SELECT 																	pacotes.CODPACOTE, 																	pacotes.ISTEMPORADA, 																	pacotes.VALOR_DE , 																	pacotes.VALOR_PARA, 																	pacotes.".$_SESSION["LANGUAGE"]." as PACOTE, 																	datas.DTAINICIO, 																	datas.DTAFIM, 																	DATE_FORMAT( datas.DTAINICIO, '%d/%m/%Y' ) as DTAINICIOBRAZIL,																	DATE_FORMAT( datas.DTAFIM, '%d/%m/%Y' ) as DTAFIMBRAZIL,																	descricao.".$_SESSION["LANGUAGE"]." as DESCRICAO, 																	quartos_tipo.CODQUARTOTIPO,																	quartos_tipo.NOME																FROM pacotes																INNER JOIN pacotes_rel_datas ON pacotes_rel_datas.CODPACOTE=pacotes.CODPACOTE																INNER JOIN pacotes_rel_descricao ON pacotes_rel_descricao.CODPACOTE=pacotes.CODPACOTE																INNER JOIN datas ON datas.CODDTA=pacotes_rel_datas.CODDTA																INNER JOIN descricao ON descricao.CODDESCRICAO=pacotes_rel_descricao.CODDESCRICAO																INNER JOIN quartos_tipo ON quartos_tipo.CODQUARTOTIPO=pacotes.CODQUARTOTIPO																WHERE 																quartos_tipo.STATUS=1																AND datas.STATUS=1																AND pacotes.STATUS=1																AND pacotes.DISPONIVEL=1																AND datas.DTAINICIO>=CURRENT_DATE 																AND	datas.DTAFIM<=datas.DTAFIM 																AND	pacotes.CODPACOTE='".$existe_pacote->CODPACOTE."' 															");																														if(mysql_num_rows($pacotes) != 0)															{																$pacote = mysql_fetch_object($pacotes);																																$pi .= "<div>";																																		$pi .= "<div>".$pacote->PACOTE."</div>"; 																	$pi .= "<div>".$pacote->NOME."</div>"; 																																		$diff =  mysql_query("SELECT DATEDIFF('".$pacote->DTAFIM."','".$pacote->DTAINICIO."') as DiffDate");																																		if(mysql_num_rows($diff) != 0)																	{																		$diff = mysql_fetch_object($diff);																		($diff->DiffDate == "1")																		? $pi .= "<div>".$diff->DiffDate." ".getLabel('LABEL_NOITE', $_SESSION['LANGUAGE'])."</div>" 																		: $pi .= "<div>".$diff->DiffDate." ".getLabel('LABEL_NOITES', $_SESSION['LANGUAGE'])."</div>"; 																	}																																		( $pacote->ISTEMPORADA == '1' ) 																	? $pi .= "<div>".getLabel('LABEL_BAIXA_TEMPORADA', $_SESSION['LANGUAGE'])."</div>" 																	: $pi .= "<div>".getLabel('LABEL_ALTA_TEMPORADA', $_SESSION['LANGUAGE'])."</div>";																																		$pi .= "<div>";																		$pi .= "<div>".getLabel('LABEL_VALOR_DE', $_SESSION['LANGUAGE']).": ".formataReais($pacote->VALOR_DE)."</div>";																		$pi .= "<div>".getLabel('LABEL_VALOR_PARA', $_SESSION['LANGUAGE']).": ".formataReais($pacote->VALOR_PARA)."</div>";																	$pi .= "</div>"; 																																		$pi .= "<div>".$pacote->DESCRICAO."</div>"; 																																	$pi .= "<div>";															}																																										$pi .="</td>";													$pi .="</tr>";												}																						$pi .="<tr>													<td class='tab_title' style='background-color: #1776a0; padding: 15px 22px; font-size: 1.125rem; color: #ffffff; margin: 2px;'>$pessoa->NOME</td>													<td class='tab_title' style='background-color: #1776a0; padding: 15px 22px; font-size: 1.125rem; color: #ffffff; margin: 2px;'>C&oacute;d.:".$reserva->N_CONHECIMENTO."</td>												</tr>												<tr>													<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>E-mail:<br/>".$pessoa->EMAIL." </td>													<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>".getLabel('LABEL_FONE_CEL', $_SESSION['LANGUAGE']).":<br/>".$pessoa->TELEFONE." </td>												</tr>												<tr>													<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>Data de Entrada:<br/>".formataDataForBrazil($reserva->DTAINICIO)." </td>													<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>Data de Sa&iacute;da:<br/>".formataDataForBrazil($reserva->DTAFIM)." </td>												</tr>												<tr>													<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>N&uacute;meros de Pessoas: ".$reserva->PESSOAS."</td>													<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>N&uacute;meros de Adultos: ".$soma_adulto."</td>												</tr>												<tr>													<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>N&uacute;meros de Crian&ccedil;as: ".($reserva->CRIANCA5A+$reserva->CRIANCA6A12+$reserva->CRIANCA12A)."																											<div>".getLabel('LABEL_CRIANCAS_5ANOS', $_SESSION['LANGUAGE']).": $soma_crianca_5</div>														<div>".getLabel('LABEL_CRIANCAS_6A12', $_SESSION['LANGUAGE']).": $soma_crianca_6_12</div>														<div>".getLabel('LABEL_CRIANCAS_ACIMA12', $_SESSION['LANGUAGE']).": $soma_crianca_12</div>																										</td>													<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>N&uacute;meros de Quartos: ".$reserva->QUARTOS."</td>												</tr>												<tr>";														 														$reservas_rel_guest = mysql_query("SELECT * FROM reservas_rel_guest WHERE CODRESERVA='".$_GET["codreserva"]."' ORDER BY (REFERENCIA) ASC");																												//if($reserva->STT == 0)														//if($reserva->STT >= 0)														//{															$pi .="<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;' colspan='2'>".getLabel('LABEL_ESCOLHER_QUARTO', $_SESSION['LANGUAGE']).": ";																																$pi .="<div id='chequeQuartos'>";																	if(mysql_num_rows($reservas_rel_tipo_quarto) != 0)																{																	$i=1;																	while( $rrtq = mysql_fetch_object($reservas_rel_tipo_quarto))																	{																		$tipo = mysql_query("SELECT * FROM quartos_tipo WHERE CODQUARTOTIPO='$rrtq->CODQUARTOTIPO'");																																				if(mysql_num_rows($tipo) != 0)																		{																			$tipo = mysql_fetch_object($tipo);																		}																																				/*																		 * checa por meio das datas se existe o quarto da suite em questao ocupado																		 */																																				$arrs = mysql_query("SELECT qts.CODQUARTO FROM quartos AS qts 																			INNER JOIN reservas_rel_quartos AS rrq ON rrq.CODQUARTO=qts.CODQUARTO 																			INNER JOIN reservas AS rsv ON rrq.CODRESERVA=rsv.CODRESERVA 																			WHERE 																			rsv.DTAINICIO BETWEEN '$reserva->DTAINICIO' AND '$reserva->DTAINICIO' 																			AND 																			rsv.DTAFIM BETWEEN '$reserva->DTAFIM' AND '$reserva->DTAFIM' 																			AND 																			(rsv.STATUS>=1 OR rsv.STATUS=3 OR rsv.STATUS=4 OR rsv.STATUS=5 OR rsv.STATUS=6 ) 																			");																																																							/*																		 * prepara uma string com chaveamento dos quartos da categoria em questao que nao pode ser																		 * ocupado pois ja possui visitantes																		 */																		$emenda = "";																				if( mysql_num_rows($arrs) != 0)																		{																			while( $arr = mysql_fetch_object($arrs))																			{																				$emenda .= "'$arr->CODQUARTO'";																			}																		}																																				/*																		 * monta string com as chaves e um not in mysql pra separar por criterios																		 * foi feito desta maneira pois nem o BETWEEN juntamente com SELECT e NOT IN estao funcionando corretamente 																		 */																		if( $emenda != "" )																		{																			$emenda = str_replace("''","','", $emenda);																			$emenda = "AND quartos.CODQUARTO NOT IN($emenda)";																		}																																					/*																		 * renderiza a selecao de quartos disponiveis para os ocupantes																		 */																		$quarto = mysql_query("SELECT quartos.CODQUARTO, quartos.NOME FROM quartos 																		INNER JOIN quartos_rel_quartos_tipo ON quartos.CODQUARTO=quartos_rel_quartos_tipo.CODQUARTO 																		WHERE quartos_rel_quartos_tipo.CODQUARTOTIPO='$rrtq->CODQUARTOTIPO' 																		$emenda");																																				if( mysql_num_rows($quarto) != 0)																		{																			$pi .= "<br/>$i) $tipo->NOME: <select name='quarto_$i' id='quarto'>";																				while( $q = mysql_fetch_object($quarto) )																				{																					$pi .= "<option value='$rrtq->CODQUARTOTIPO"."_"."$q->CODQUARTO'>$q->NOME</option>";																						}																			$pi .= "</select>";																																						$i++;																			}																		else																		{																			$impedir = true;																		}																																					}																}																																$pi .="</div>";																	$pi .="<div id='ErroChequeQuartos' style='display: none'>* ".getLabel('LABEL_INDISPONIVEL', $_SESSION['LANGUAGE'])."!</div>";																																	if($impedir)																{																	$pi .="																	<script>																																					$('#chequeQuartos').ready(function(){																			jQuery('#chequeQuartos').hide();																			$('#ErroChequeQuartos').show();																		});																		</script>";																	}																																$pi .="</td>";																$pi .="</tr>";														//}														//else														//{																																/*Esta linha faz exibir o quatro previamente reservado*/																$existe_quarto_salvo = mysql_query("SELECT rrqt.CODTIPOQUARTO, rrq.CODQUARTO FROM																reservas AS r																INNER JOIN reservas_rel_tipo_quarto AS rrqt ON rrqt.CODRESERVA=r.CODRESERVA																INNER JOIN reservas_rel_quartos AS rrq ON rrqt.CODRESERVA=rrq.CODRESERVA																WHERE r.CODRESERVA='".$_GET["codreserva"]."'");																$existe = @mysql_num_rows($existe_quarto_salvo);																																//if( (int)$reserva->STT != 2)																if( $existe != 0 )																{																	$pi .="<tr>";																	$pi .="<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;' colspan='2'>".getLabel('LABEL_ACOMODACOES', $_SESSION['LANGUAGE']).":<br/><br/>";																		$acomodacoes = mysql_query("SELECT 																		quartos.NOME as QUARTO, quartos_tipo.NOME as TIPO, reservas_rel_quartos.REFERENCIA																		FROM quartos_tipo																		INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO																		INNER JOIN quartos ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO																		INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODTIPOQUARTO=quartos_rel_quartos_tipo.CODQUARTOTIPO																		INNER JOIN reservas_rel_quartos ON reservas_rel_quartos.CODQUARTO=quartos.CODQUARTO																		WHERE reservas_rel_quartos.CODRESERVA='".$_GET["codreserva"]."'																		AND reservas_rel_tipo_quarto.CODRESERVA='".$_GET["codreserva"]."'																		GROUP BY reservas_rel_quartos.REFERENCIA																		ORDER BY (reservas_rel_quartos.REFERENCIA+0) ASC");																																				if(mysql_num_rows($acomodacoes) != 0)																		{																			$i=1;																			while( $acomodacao = mysql_fetch_object($acomodacoes))																			{																																							$pi .= "<div>$i. ($acomodacao->TIPO) $acomodacao->QUARTO</div>";																																																												$guests = mysql_query("SELECT guest.CODGUEST, guest.NOME, guest.FAIXA_ETARIA FROM guest																				INNER JOIN reservas_rel_guest ON reservas_rel_guest.CODGUEST=guest.CODGUEST																				INNER JOIN reservas ON reservas_rel_guest.CODRESERVA=reservas.CODRESERVA																				WHERE reservas_rel_guest.REFERENCIA=$acomodacao->REFERENCIA																				AND reservas.CODRESERVA='".$_GET["codreserva"]."'																				GROUP BY guest.CODGUEST																				ORDER BY FAIXA_ETARIA ASC");																																								$pi .= "<ol style='list-style-type: lower-roman'>";																																									while( $guest = mysql_fetch_object($guests))																				{																					switch($guest->FAIXA_ETARIA)					{																						case '0':																							$guest->FAIXA_ETARIA = "(".getLabel('LABEL_ADULTO', $_SESSION['LANGUAGE']).")";																						break;																						case '1':																							$guest->FAIXA_ETARIA = "(".getLabel('LABEL_CRIANCAS_5ANOS_2', $_SESSION['LANGUAGE']).")";																						break;																						case '2':																							$guest->FAIXA_ETARIA = "(".getLabel('LABEL_CRIANCAS_6A12_2', $_SESSION['LANGUAGE']).")";																						break;																						case '3':																							$guest->FAIXA_ETARIA = "(".getLabel('LABEL_CRIANCAS_ACIMA12_2', $_SESSION['LANGUAGE']).")";																						break;																					}																					$pi .= "<li>$guest->NOME $guest->FAIXA_ETARIA</li>";																				}																																								$pi .= "</ol>";																																								$i++;																			}																		}																																			$pi .="</td>";																		$pi .="</tr>";																}																														//}																																																	$pi .="<tr>";													$pi .="<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;' colspan='2'>".getLabel('LABEL_SOLICITACOES', $_SESSION['LANGUAGE']).": ";														if( $reserva->OBSERVACOES == "")														{															$pi .="<br/>----";														}														else														{															$pi .= $reserva->OBSERVACOES;														}													$pi .="</td>";												$pi .="</tr>";																								if( (int)$reserva->STT >= 0 && (int)$reserva->STT <=2 )												{													$pi .="<tr>";														$pi .="<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>Forma de Pagamento:<br/>Cart�o de Cr�dito</td>";																	$s = limpaValorReal($total);														$result = mysql_query("SELECT ROUND({$s}/2) AS RES;");														while ($row = mysql_fetch_object($result)) {															$pi .="<td class='tab_cont' style='color: #4d4d4d; padding: 15px 22px; font-size: 1.125rem; background-color: #f2f2f2; margin: 2px;'>50% = R$ ".formataReais($row->RES)."</td>";														}																											$pi .="</tr>";																										$pi .="<tr><td class='tab_footer' style='color: #ffffff; padding: 15px 22px; text-align: center; font-size: 1.125rem; background-color: #31a1d2; margin: 2px;' colspan='2'>Valor Total da Reserva: R$ ".formataReais($total)."</td></tr>";												}																							//if( (int)$reserva->STT == 0)												//{													$pi .= "<tr>														<td class='tab_footer' style='color: #ffffff; padding: 15px 22px; text-align: center; font-size: 1.125rem; background-color: #31a1d2; margin: 2px;' colspan='2'>Status: ";															if( (int)$reserva->STT == "")															{																$pi .= "<input type='hidden' name='NAO_DISPARAR_EMAIL' value='on'/>";															}															$pi .= "<select name='status' id='status'>";																$pi .= "<option value=''>--</option>";																																( (int)$reserva->STT == 0)																? $pi .= "<option value='0' selected>".getLabel('LABEL_RESERVAS_PRE', $_SESSION['LANGUAGE'])."</option>"																: $pi .= "<option value='0'>".getLabel('LABEL_RESERVAS_PRE', $_SESSION['LANGUAGE'])."</option>";																																( (int)$reserva->STT == 1)																? $pi .= "<option value='1' selected>".getLabel('LABEL_RESERVA_CONFIRMADA', $_SESSION['LANGUAGE'])."</option>"																: $pi .= "<option value='1'>".getLabel('LABEL_RESERVA_CONFIRMADA', $_SESSION['LANGUAGE'])."</option>";																																( (int)$reserva->STT == 2)																? $pi .= "<option value='2' selected>".getLabel('LABEL_RESERVA_CANCELADA', $_SESSION['LANGUAGE'])."</option>"																: $pi .= "<option value='2'>".getLabel('LABEL_RESERVA_CANCELADA', $_SESSION['LANGUAGE'])."</option>";																																( (int)$reserva->STT == 3)																? $pi .= "<option value='3' selected>booking.com</option>"																: $pi .= "<option value='3'>booking.com</option>";																																( (int)$reserva->STT == 4)																? $pi .= "<option value='4' selected>decolar.com</option>"																: $pi .= "<option value='4'>decolar.com</option>";																																( (int)$reserva->STT == 5)																? $pi .= "<option value='5' selected>outros...</option>"																: $pi .= "<option value='5'>outros...</option>";																 																/*																$pi .= "<option value='3'>booking.com</option>";																$pi .= "<option value='4'>decolar.com</option>";																*/															$pi .= "</select>";																										$pi .="</td>";													$pi .= "</tr>";												//}												$pi .= "<tr>";																																																				switch((int)$reserva->STT)														{																														case 1:																$pi .= "<td style='padding: 15px 22px; text-align: center; font-size: 1.125rem; margin: 2px; background: yellow;' colspan='2'><span style='color: #003580;'>".getLabel('LABEL_RESERVA_CONFIRMADA', $_SESSION['LANGUAGE'])."</span></td>";															break;															case 2:																$pi .= "<td style='padding: 15px 22px; text-align: center; font-size: 1.125rem; margin: 2px; background: red;' colspan='2'><span style='color: #fff;'>".getLabel('LABEL_RESERVA_CANCELADA', $_SESSION['LANGUAGE'])."</span></td>";															break;															case 3:																$pi .= "<td style='padding: 15px 22px; text-align: center; font-size: 1.125rem; margin: 2px; background: #DAA300;' colspan='2'><span style='color: #003580;'>booking.com</span></td>";															break;															case 4:																$pi .= "<td style='padding: 15px 22px; text-align: center; font-size: 1.125rem; margin: 2px; background: #84a8fb;' colspan='2'><span style='color: #ef1b24;'>decolar.com</span></td>";															break;															default:																$pi .= "<td style='padding: 15px 22px; text-align: center; font-size: 1.125rem; margin: 2px; background: green;' colspan='2'><span style='color: #fff;'>".getLabel('LABEL_RESERVAS_PRE', $_SESSION['LANGUAGE'])."</span></td>";															break;														}																																																			$pi .= "</tr>";																						$pi .= "</tbody>										</table>									</td>								</tr>							</tbody>						</table>					</td>				</tr>			</tbody>		</table>";		//if( (int)$reserva->STT == 0)		//{			$pi .="<div><input type='hidden' value='ACTION' name='ACTION'/></div>";			$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";				//}			$pi .= "</form>";	?>