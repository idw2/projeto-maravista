<?php	acessoDireto( "ADMINISTRADOR;COLUNISTA" );		$erro = "";	$controlar = true;			if ( !empty($_POST) && isset($_POST['ACTION']) ) 	{				$codfoto = strtoupper( md5( getTimestamp() ) );		$titulo = htmlentities(trim($_POST["titulo"]));		$titulo = str_replace("'", '&lsquo;', $titulo);				$image = new Redimensionar();		$image->setImage( $_FILES['icone'] );				if ( $_FILES['icone']['name'] == "" )		{			$erro = "* ".getLabel('LABEL_IMAGE_REQUERIDA', $_SESSION['LANGUAGE'])."!";  		}		elseif ( strlen($titulo) > 255 )		{			$erro = "* ".getLabel('LABET_ERRO_TITLE_LIMITE255', $_SESSION['LANGUAGE'])."!";		}		else		{			if ( $image->imageType() )			{												if(	$erro == "")				{									$image->setWidth( 1200 );					$image->copy();					$image->setPath ( "../upload/fotos" );					$image->createFolder ( $codfoto );					$image->totalClear();					$image->set();										//este e o caminho d imagem					$foto = $image->getWay ();										$image->destroy();										( $_POST['status'] == 'on' ) ? $status = 1 : $status = 0;									mysql_query("INSERT INTO `galerias_rel_fotos`(`CODGALERIA`,`CODFOTO`) VALUES('".$_GET['codgaleria']."','$codfoto')");						mysql_query("INSERT INTO `fotos` (`CODFOTO`,`TITULO`,`URL`,`STATUS`,`OWNER`)VALUES('$codfoto','$titulo','$foto','$status','".$_SESSION['CODPESSOA']."')	");						echo "<script>alert('* ".getLabel('LABEL_ADD_SUCESSO_LABEL', $_SESSION['LANGUAGE'])."!')</script>";					echo "<script>window.location = 'index.php?actionType=gerenciar.galeria.fotos.list&codgaleria=".$_GET['codgaleria']."';</script>";											exit();									}							} 			else 			{				$erro = getLabel('LABEL_FORMATOS_SAO_ESTES', $_SESSION['LANGUAGE']);			} 				}							} 	else 	{			$erro = getLabel('ERRO_PREENCHER_TODOS_CAMPOS', $_SESSION['LANGUAGE']);	}		$pi = "<form name='formCpf' method='post' action='index.php?actionType=gerenciar.galeria.fotos.add&codgaleria=".$_GET['codgaleria']."' enctype='multipart/form-data' >";		$pi .= "<br/>";				$pi .= "<div class='ErroMessage'>$erro</div>";				$pi .= "<br/>";				$nom_extra = mysql_query("SELECT * FROM galerias WHERE CODGALERIA='".$_GET['codgaleria']."'");				if(mysql_num_rows($nom_extra) != 0)		{			$nom_extra = mysql_fetch_object($nom_extra);			$pi .= "<div class='TitleServName'><b>".getLabel('LABEL_NOM_GALERIA', $_SESSION['LANGUAGE']).":</b></div>";						switch($_SESSION['LANGUAGE'])			{				case 'PORTUGUES':					$pi .= "<div class='TitleServNameResult'>$nom_extra->PORTUGUES</div>";				break;				case 'ESPANHOL':					$pi .= "<div class='TitleServNameResult'>$nom_extra->ESPANHOL</div>";				break;				case 'INGLES':					$pi .= "<div class='TitleServNameResult'>$nom_extra->INGLES</div>";				break;			}			}				$pi .= "<br/>";				$pi .= "<div class='Userlabel'>".getLabel('LABEL_TITULO', $_SESSION['LANGUAGE']).":</div>";			if(!empty($_POST))		{			$pi .= "<div class='EntradaTextForm'><input class='LiloginText' type='text' value='$_POST[titulo]' name='titulo' id='titulo' class='' maxlength='255'/></div>";		} 		else 		{			$pi .= "<div class='EntradaTextForm'><input class='LiloginText' type='text' value='' name='titulo' id='titulo' class='' maxlength='255'/></div>";		}				$pi .= "<div class='Userlabel'>".getLabel('LABEL_IMAGEM', $_SESSION['LANGUAGE']).":</div>";		$pi .= "<div class='Userlabel'>";				$pi .= "<div class='EntradaTextForm'>";				$pi .= "<input type='file' type='file' name='icone' maxlength='200' title='".getLabel('LABEL_SELECT_IMAGE', $_SESSION['LANGUAGE'])."'/><br/>";		$pi .= "<font style='font-size: 11px;' class='Userlabel'>".getLabel('LABEL_SELECT_NEW_IMAGE', $_SESSION['LANGUAGE']).".</font><br/>";		$pi .= "<font style='font-size: 11px;' class='Userlabel'>".getLabel('LABEL_FORMATOS_SAO', $_SESSION['LANGUAGE']).": \".bmp\", \".gif\", \".jpg\", \".jpeg\" e \".png\";</font>";		$pi .= "</div>";				$pi .= "<div class='Separador'></div>";		$pi .= "<div>";					if(!empty($_POST))			{				( $_POST['status'] == 'on' ) ? $pi .= "<input type='checkbox' name='status' checked='true'/> <span class='Userlabel'>".getLabel('LABEL_ATIVO_TEXT', $_SESSION['LANGUAGE'])."</span>" : $pi .= "<input type='checkbox' name='status'/> <span class='Userlabel'>".getLabel('LABEL_ATIVO_TEXT', $_SESSION['LANGUAGE'])."</span>";			}			else			{				$pi .= "<input type='checkbox' name='status'/> <span class='Userlabel'>".getLabel('LABEL_ATIVO_TEXT', $_SESSION['LANGUAGE'])."</span>";			}										$pi .= "</div>";				$pi .= "<div><br/></div>";			$pi .="<div><input type='hidden' name='ACTION' value='ACTION'/></div>";		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";		$pi .= "<div><br/></div>";			$pi .= "</form>";?>