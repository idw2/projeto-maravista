<?php        $html .= "<div id='corpo'>";		    $html .="<div class='container'>";    	$html .="<div class='fix_form col-xs-4' style='top: 0px;'></div>";                $html .="<div class='col-xs-4'>";                    $html .="<div class='melhores-home interna'>";                $html .="<span class='melhores-titulo'>".getLabel('LABEL_MELHORES_PRECOS', $_SESSION['LANGUAGE'])."</span>";                $html .="<span class='melhores-btn'><a href='index.php?actionType=reservas'>".getLabel('LABEL_RESERVAS', $_SESSION['LANGUAGE'])."</a><a href='index.php?actionType=reservas' class='melhores-icon'><span></span></a></span>";            $html .="</div>";                    $html .= "<div class='LuaDeMel'>";                $html .="<div class='ImagemTopLeft'><img src='../image/cantoneira_left.png' alt='' border='0' title=''/></div>";	                $html .= "<h2 class='LuadeMel_titulo'>LUA DE MEL &<strong>CASAMENTOS</strong></h2>";                $html .= "<a class='LuadeMel_items trans02'><p>Momentos ".utf8_decode('inesquec�veis')." na Pousada Maravista</p></a>";                $html .= "<span class='l-separador'></span>";                $html .= "<a class='LuadeMel_items trans02'><p>Para mais ".utf8_decode('informa��es')."</p></a>";                $html .= "<a class='melhores-icon'><span></span></a>";            $html .= "</div>";                    $html .= "</div>";                $html .="<div class='pag_interna col-xs-8 right'>";  		$rows = mysql_query("SELECT eventos.*, DATE_FORMAT( eventos.DTA, 'Publicado em %d/%m/%Y �s %Hh%i.' ) as DTA, eventos.".$_SESSION['LANGUAGE']." as EVTITULO, fotos.TITULO, fotos.URL, descricao.".$_SESSION['LANGUAGE']."		FROM eventos		INNER JOIN eventos_rel_fotos ON eventos_rel_fotos.CODEVENTO=eventos.CODEVENTO		INNER JOIN eventos_rel_descricao ON eventos_rel_descricao.CODEVENTO=eventos.CODEVENTO		INNER JOIN descricao ON descricao.CODDESCRICAO=eventos_rel_descricao.CODDESCRICAO		INNER JOIN fotos ON fotos.CODFOTO=eventos_rel_fotos.CODFOTO		WHERE fotos.STATUS=1 		AND eventos.STATUS=1		AND eventos.CODEVENTO='".$_GET['codevento']."'");			if(mysql_num_rows($rows) != 0)		{			$row = mysql_fetch_object($rows);		}		(string) $nome = getlinguagemdasessao();		$html .="<div class='pint_titulo Acomodacoes'>";				$html .= $row->EVTITULO;		$html .="</div>";				$html .="<div class='eventos_fotos_pic'>";						$html .= "<div style='margin: 0;' class='loadGallery' id='_$row->CODEVENTO'>";							$html .= "<div class='$row->CODEVENTO gallery_img' data-fancybox-group='gallery' title='' style='cursor: default'>";					$html .= "<img src='$row->URL' alt='' title='' />";					$html .="<a href='$row->URL' class='melhores-icon'><span></span></a>";						$html .= "</div>";			$html .="</div>";					$html .="</div>";				$html .="<div class='eventos_fotos_text'>";			$html .= $row->$nome;		$html .="</div>";						$html .="<div style='back' onclick=\"location='index.php?actionType=eventos'\">";			$html .="<img src='../image/arrow-back.png' alt='".getLabel('LABEL_MAIS_EVENTOS', $_SESSION['LANGUAGE'])."' border='' title='".getLabel('LABEL_MAIS_EVENTOS', $_SESSION['LANGUAGE'])."' width='50px' />";		$html .="</div>";		        $html .= "</div>";		    $html .= "</div>"; $html .= "</div>"; ?>