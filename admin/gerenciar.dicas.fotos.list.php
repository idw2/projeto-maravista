<?php	acessoDireto( "ADMINISTRADOR;" );			$nom_extra = mysql_query("SELECT * FROM dicas WHERE CODDICA='".$_GET['coddica']."'");	if(mysql_num_rows($nom_extra) != 0)	{		$nom_extra = mysql_fetch_object($nom_extra);		$pi .= "<div class='TitleServName'><b>".getLabel('LABEL_NOM_DICA', $_SESSION['LANGUAGE']).":</b></div>";				(string) $nome = getlinguagemdasessao();		$pi .= "<div class='TitleServNameResult'>".$nom_extra->$nome."</div>";			}		$pi .= "<br/>";			$pi .= "<form name='List'>";								$pi .= "<div class='BtnButtomManage' onclick=\"location = 'index.php?actionType=gerenciar.dicas'\" title='".getLabel('LABEL_VOLTAR', $_SESSION['LANGUAGE'])."'><span class='BtnProprio'>".getLabel('LABEL_VOLTAR', $_SESSION['LANGUAGE'])."</span></div></li>";		$pi .= "<div class='BtnButtomManage' onclick=\"location = 'index.php?actionType=gerenciar.dicas.fotos.add&coddica=".$_GET['coddica']."'\" title='".getLabel('LABEL_ADICIONAR', $_SESSION['LANGUAGE'])."'><span class='BtnProprio'>".getLabel('LABEL_ADICIONAR', $_SESSION['LANGUAGE'])."</span></div></li>";				$pi .= "<div class='ResetFloat'></div>";		$pi .= "<div class='MasterList'>";					$pi .= "<table class='Tableinter'>";				$pi .= "<tr>";										$pi .= "<td valign='top'>";												$result = mysql_query("SELECT  							fotos.CODFOTO,							DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA,							fotos.TITULO,							fotos.URL,							fotos.STATUS,							fotos.DESTAQUE,							fotos.OWNER						FROM fotos 						INNER JOIN dicas_rel_fotos ON dicas_rel_fotos.CODFOTO=fotos.CODFOTO						WHERE dicas_rel_fotos.CODDICA='".$_GET['coddica']."'");												$pi .=  "<div class='separador'></div>";						$pi .=  "<div>";						$pi .= "<table class='Tableinter'>";							$pi .=  "<tr id='adminTopTable'>";								$pi .=  "<td style='width: 100px;'></td>								<td>".getLabel('LABEL_DTA_CADASTRO', $_SESSION['LANGUAGE']).":</td>								<td>".getLabel('LABEL_TITULO', $_SESSION['LANGUAGE']).":</td>								<td>".getLabel('LABEL_LINK', $_SESSION['LANGUAGE']).":</td>								<td>".getLabel('LABEL_DESTAQUE', $_SESSION['LANGUAGE']).":</td>								<td>".getLabel('LABEL_SITUACAO', $_SESSION['LANGUAGE']).":</td>								<td>".getLabel('LABAL_EXCLUIR', $_SESSION['LANGUAGE']).":</td>								<td>".getLabel('LABEL_CRIADO_POR', $_SESSION['LANGUAGE']).":</td>";							$pi .=  "</tr>";												$i = 0;						while( $qtos_tipo = mysql_fetch_object( $result ) ) {							if ( $qtos_tipo->STATUS == "1" ) 							{								$status = "<span class='AtivoStatus' onclick=\"javascript:getAlterstatusfull('$qtos_tipo->CODFOTO', 'CODFOTO', 'STATUS', 'fotos', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_ATIVO', $_SESSION['LANGUAGE'])."</span>";							} 							else 							{								$status = "<span class='InativoStatus' onclick=\"javascript:getAlterstatusfull('$qtos_tipo->CODFOTO', 'CODFOTO', 'STATUS', 'fotos', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_INATIVO', $_SESSION['LANGUAGE'])."</span>";							}														if ( $qtos_tipo->DESTAQUE == "1" ) 							{								$destaque = "<span class='AtivoStatus' onclick=\"javascript:getAlterstatusfullunico('$qtos_tipo->CODFOTO', 'CODFOTO', 'DESTAQUE', 'fotos', 'CODDICA', 'dicas_rel_fotos', '".$_GET['coddica']."', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_ATIVO', $_SESSION['LANGUAGE'])."</span>";							} 							else 							{								$destaque = "<span class='InativoStatus' onclick=\"javascript:getAlterstatusfullunico('$qtos_tipo->CODFOTO', 'CODFOTO', 'DESTAQUE', 'fotos', 'CODDICA', 'dicas_rel_fotos', '".$_GET['coddica']."', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_INATIVO', $_SESSION['LANGUAGE'])."</span>";							}														if ( $i % 2 == 0 ) 							{								$pi.=  "<tr class='LinhaPar'>";							} 							else 							{								$pi.=  "<tr class='LinhaImpar'>";							}																$foto = str_replace("..", $dados_relevantes->SITE, $qtos_tipo->URL );																		$pi .= "<td align='right'><img src='$qtos_tipo->URL' title='$qtos_tipo->TITULO' alt='$qtos_tipo->TITULO' width='100%'/></td>";									$pi .= "<td>$qtos_tipo->DTA</td>";									$pi .= "<td>$qtos_tipo->TITULO</td>";									$pi .= "<td><textarea rows='4' cols='40'>$foto</textarea></td>";									$pi .= "<td align='center'>$destaque</td>";									$pi .= "<td align='center'>$status</td>";									$pi .= "<td align='center'><div onclick=\"window.location='index.php?actionType=gerenciar.dicas.fotos.del&coddica=".$_GET['coddica']."&codfoto=$qtos_tipo->CODFOTO'\">".getLabel('LABAL_ICO_DEL', $_SESSION['LANGUAGE'])."</div></td>";																		$owner = mysql_query("SELECT login.LOGIN FROM login									INNER JOIN login_rel_pessoa ON login_rel_pessoa.CODLOGIN=login.CODLOGIN									WHERE login_rel_pessoa.CODPESSOA='$qtos_tipo->OWNER'");																		$owner = mysql_fetch_object($owner);									$pi .=  "<td>$owner->LOGIN</td>";								$pi .=  "</tr>";														$i++;												}													$pi .=  "</table>";						$pi .=  "</div>";										$pi .= "</td>";									$pi .= "</tr>";			$pi .= "</table>";		$pi .= "</div>";	$pi .= "</form>";	?>