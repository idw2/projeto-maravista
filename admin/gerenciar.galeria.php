<?php	acessoDireto( "ADMINISTRADOR;" );		$pi = "<div style='margin-bottom: 10px;'>";		$pi .= "<form name='formsearch1' method='post' action='index.php?actionType=".$_GET['actionType']."'>";			$pi .= "<table>";					$pi .= "<tr>";					$pi .= "<td>";											$pi .= "<div class='EntradaTextForm'>";							if(!empty($_POST) && isset($_POST['ACTION']))							{								$pi .= "<div class='Floatbusca'><input class='LiloginText' type='text' name='buscar' value='$_POST[buscar]' placeholder='".getLabel('LABEL_BUSCAR', $_SESSION['LANGUAGE'])."'/></div>";								$pi .= "<div class='Floatbusca'><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";							}							else							{								$pi .= "<div class='Floatbusca'><input class='LiloginText' type='text' name='buscar' value='' placeholder='".getLabel('LABEL_BUSCAR', $_SESSION['LANGUAGE'])."'/></div>";								$pi .= "<div class='Floatbusca'><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";							}							$html .= "<div class='ResetFloat'></div>";						$pi .= "</div>";											$pi .= "</td>";				$pi .= "</tr>";			$pi .= "</table>";				$pi .="<div><input type='hidden' name='ACTION' value='BUSCAR'/></div>";		$pi .= "</form>";	$pi .= "</div>";		if($_POST[ACTION] == 'ACTION')	{			foreach( $_POST as $name => $value)		{						if( substr_count( $name, '_') == 1 )			{								$key = str_replace("_", "", $name);				mysql_query("UPDATE galerias SET ORDEM='$value' WHERE CODGALERIA='$key'");							}					}				echo "<script>alert('* ".getLabel('LABEL_EDIT_SUCESSO_LABEL', $_SESSION['LANGUAGE'])."!')</script>";		echo "<script>window.location = 'index.php?actionType=gerenciar.galeria';</script>";		}			$pi .= "<form name='List' method='post' action='index.php?actionType=gerenciar.galeria'>";										$pi .= "<div class='BtnButtomManage' onclick=\"location = 'index.php?actionType=gerenciar.galeria.add'\" title='".getLabel('LABEL_ADICIONAR', $_SESSION['LANGUAGE'])."'><span class='BtnProprio'>".getLabel('LABEL_ADICIONAR', $_SESSION['LANGUAGE'])."</span></div></li>";		$pi .= "<div class='BtnButtomManage' onclick=\"url('gerenciar.galeria.edit', '', '".getLabel('LABEL_JS_MAIS_DE_UM', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_JS_NENHUM', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_JS_UPDATE', $_SESSION['LANGUAGE'])."')\"  title='".getLabel('LABEL_EDITAR', $_SESSION['LANGUAGE'])."'><span class='BtnProprio'>".getLabel('LABEL_EDITAR', $_SESSION['LANGUAGE'])."</span></div></li>";				$pi .= "<div class='BtnButtomManage' onclick=\"url('gerenciar.galeria.descricao', '', '".getLabel('LABEL_JS_MAIS_DE_UM', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_JS_NENHUM', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_JS_UPDATE', $_SESSION['LANGUAGE'])."')\"  title='".getLabel('LABEL_DESCRICAO', $_SESSION['LANGUAGE'])."'><span class='BtnProprio'>".getLabel('LABEL_DESCRICAO', $_SESSION['LANGUAGE'])."</span></div></li>";		$pi .= "<div class='BtnButtomManage' onclick=\"url('gerenciar.galeria.fotos.list', '', '".getLabel('LABEL_JS_MAIS_DE_UM', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_JS_NENHUM', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_JS_UPDATE', $_SESSION['LANGUAGE'])."')\"  title='".getLabel('LABEL_LIST_FOTOS', $_SESSION['LANGUAGE'])."'><span class='BtnProprio'>".getLabel('LABEL_LIST_FOTOS', $_SESSION['LANGUAGE'])."</span></div></li>";				$pi .= "<div class='ResetFloat'></div>";		$pi .= "<div class='MasterList'>";					$pi .= "<table class='Tableinter'>";				$pi .= "<tr>";										$pi .= "<td valign='top'>";												$criterio = "";												if( !empty($_POST['buscar']) )						{							$xnome = trim( htmlentities( $_POST['buscar'] ) );							$criterio = "WHERE galerias.PORTUGUES LIKE '%$xnome%' OR galerias.INGLES LIKE '%$xnome%' OR galerias.ESPANHOL LIKE '%$xnome%' ";							}												$result = mysql_query("SELECT 						galerias.*,						DATE_FORMAT( galerias.DTA, '%d/%m/%Y - %Hh%i' ) as DTA						FROM galerias						$criterio						ORDER BY (galerias.ORDEM+0) ASC						");												$pi .=  "<div class='separador'></div>";						$pi .=  "<div>";						$pi .= "<table class='Tableinter'>";							$pi .=  "<tr id='adminTopTable'>";								$pi .=  "<td style='width: 10px;'></td>								<td>".getLabel('LABEL_DTA_CADASTRO', $_SESSION['LANGUAGE']).":</td>								<td>".getLabel('LABEL_NAME', $_SESSION['LANGUAGE']).":</td>								<td>".getLabel('LABEL_ORDEM', $_SESSION['LANGUAGE']).":</td>																<td>".getLabel('LABEL_DESTAQUE', $_SESSION['LANGUAGE']).":</td>								<td>Home:</td>																<td>".getLabel('LABEL_SITUACAO', $_SESSION['LANGUAGE']).":</td>								<td>".getLabel('LABEL_CRIADO_POR', $_SESSION['LANGUAGE']).":</td>";							$pi .=  "</tr>";													$i = 0;						while( $qtos_tipo = mysql_fetch_object( $result ) ) {							if ( $qtos_tipo->STATUS == "1" ) 							{								$status = "<span class='AtivoStatus' onclick=\"javascript:getAlterstatusfull('$qtos_tipo->CODGALERIA', 'CODGALERIA', 'STATUS', 'galerias', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_ATIVO', $_SESSION['LANGUAGE'])."</span>";							} 							else 							{								$status = "<span class='InativoStatus' onclick=\"javascript:getAlterstatusfull('$qtos_tipo->CODGALERIA', 'CODGALERIA', 'STATUS', 'galerias', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_INATIVO', $_SESSION['LANGUAGE'])."</span>";							}														if ( $qtos_tipo->CAPA == "1" ) 							{								$capa = "<span class='AtivoStatus' onclick=\"javascript:getAlterstatusfull('$qtos_tipo->CODGALERIA', 'CODGALERIA', 'CAPA', 'galerias', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_ATIVO', $_SESSION['LANGUAGE'])."</span>";							} 							else 							{								$capa = "<span class='InativoStatus' onclick=\"javascript:getAlterstatusfull('$qtos_tipo->CODGALERIA', 'CODGALERIA', 'CAPA', 'galerias', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_INATIVO', $_SESSION['LANGUAGE'])."</span>";							}														if ( $qtos_tipo->DESTAQUE == "1" ) 							{								$destaque = "<span class='AtivoStatus' onclick=\"javascript:getAlterstatusfull('$qtos_tipo->CODGALERIA', 'CODGALERIA', 'DESTAQUE', 'galerias', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_ATIVO', $_SESSION['LANGUAGE'])."</span>";							} 							else 							{								$destaque = "<span class='InativoStatus' onclick=\"javascript:getAlterstatusfull('$qtos_tipo->CODGALERIA', 'CODGALERIA', 'DESTAQUE', 'galerias', '".getLabel('LABEL_JS_REGISTRO', $_SESSION['LANGUAGE'])."')\">".getLabel('LABEL_INATIVO', $_SESSION['LANGUAGE'])."</span>";							}														if ( $i % 2 == 0 ) 							{								$pi.=  "<tr class='LinhaPar'>";							} 							else 							{								$pi.=  "<tr class='LinhaImpar'>";							}																$pi .= "<td align='right'><input type='checkbox' name='$qtos_tipo->CODGALERIA'/></td>";									$pi .= "<td>$qtos_tipo->DTA</td>";																		(string) $nome = getlinguagemdasessao();									$pi .= "<td>".$qtos_tipo->$nome."</td>";																		$pi.= "<td align='center'><input type='text' name='_$qtos_tipo->CODGALERIA' value='$qtos_tipo->ORDEM' style='width: 20px' maxlength='3' onkeypress='return formataNumDV(event, this, 3);'/></td>";									$pi .= "<td align='center'>$destaque</td>";																		$pi .= "<td align='center'>$capa</td>";																		$pi .= "<td align='center'>$status</td>";																		$owner = mysql_query("SELECT login.LOGIN FROM login									INNER JOIN login_rel_pessoa ON login_rel_pessoa.CODLOGIN=login.CODLOGIN									WHERE login_rel_pessoa.CODPESSOA='$qtos_tipo->OWNER'");																		$owner = mysql_fetch_object($owner);									$pi .=  "<td>$owner->LOGIN</td>";								$pi .=  "</tr>";														$i++;												}													$pi .=  "</table>";						$pi .=  "</div>";										$pi .= "</td>";									$pi .= "</tr>";			$pi .= "</table>";		$pi .= "</div>";						$pi .="<div><input type='hidden' value='ACTION' name='ACTION'/></div>";		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";	$pi .= "</form>";?>