<?php

		$text_tarifas = mysql_query("SELECT ".$_SESSION['LANGUAGE']." FROM `text_tarifas`");
		
		if(mysql_num_rows($text_tarifas) !=0)
		{
			$text_tarifas = mysql_fetch_object($text_tarifas);
			
			$html .= "<div class='pag_interna right' style='border: none; margin-top: 25px'>";
				$html .= "<div class='alert-blue' style='padding: 15px 25px'>";
					$html .= "<div>";
						$html .= $text_tarifas->$_SESSION['LANGUAGE'];
					$html .= "</div>";				
				$html .= "</div>";
			$html .= "</div>";
			
		
		}		
		
		//baixa temporada
		$html .= "<div class='blog_header'>";
			$html .= "<ul class='left'>";
				$html .= "<li class=''><strong>".getLabel('LABEL_BAIXA_TEMPORADA', $_SESSION['LANGUAGE'])."</strong><br>".formataDataForBrazil($dados_relevantes->DTA_INICIO_BAIXA)." ".getLabel('LABEL_ATE', $_SESSION['LANGUAGE'])." ".formataDataForBrazil($dados_relevantes->DTA_FIM_BAIXA)."</li>";
				//$html .= "<li style='padding-left:12px'></li>";
			$html .= "</ul>";
			$html .= "<ul class='blog_labels'>";
				$html .= "<li>".getLabel('LABEL_SEGASEX', $_SESSION['LANGUAGE'])."</li>";
				$html .= "<li>".getLabel('LABEL_SABADOM', $_SESSION['LANGUAGE'])."</li>";
			$html .= "</ul>";
		$html .= "</div>";
        
        $html .= "<div class='sep-pattern-1'></div>";
        
		$quarto_tipos = mysql_query("
			SELECT 
				quartos_tipo.*, 
				quartos_tipo.NOME as TIPO, 
				descricao.".$_SESSION["LANGUAGE"]." as DESCRICAO,
				fotos.URL,
				fotos.TITULO
			FROM quartos_tipo
			INNER JOIN quartos_tipo_rel_descricao ON quartos_tipo_rel_descricao.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
			INNER JOIN descricao ON descricao.CODDESCRICAO=quartos_tipo_rel_descricao.CODDESCRICAO
			INNER JOIN quartos_tipo_rel_fotos ON quartos_tipo_rel_fotos.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
			INNER JOIN fotos ON quartos_tipo_rel_fotos.CODFOTO=fotos.CODFOTO
			WHERE 
			quartos_tipo.STATUS=1
			AND fotos.STATUS=1
			AND fotos.DESTAQUE=1
			ORDER BY (quartos_tipo.ORDEM+0) ASC
		");
		
		if(mysql_num_rows($quarto_tipos) != 0)
		{
		
			$html .= "<table class='fotos_container'>";
				while($qtp = mysql_fetch_object($quarto_tipos))
				{
					$html .= "<tr class='post_simples'>"; 
						$html .= "<td><input type='button' onclick='location.href=\"http://www.maravista.com.br/acomodacoes\" ' value='".getLabel('LABEL_MAIS', $_SESSION['LANGUAGE'])."'class='BtnFiltro small'/></td>";
						$html .= "<td class='post_simples_titulo'>".$qtp->TIPO."</td>";
						$html .= "<td class='fotos_descricao blog_tarifas' >";
							$html .= "<div class='blog_colbaixa blog_col temporada valor'><strong>R$</strong> ".formataReais($qtp->VALOR_BAIXA)."</div>";
						$html .= "</td>"; 
						$html .= "<td class='fotos_descricao blog_tarifas last' >";
							$html .= "<div class='blog_col_alta blog_col temporada valor'><strong>R$</strong> ".formataReais($qtp->VALOR_BAIXA_FINAL)."</div>";
						$html .= "</td>"; 
					$html .= "</tr>";    
				}
			
			$html .= "</table>";
		
		}
		
		//media temporada
		$html .= "<div class='blog_header'>";
			$html .= "<ul class='left'>";
				$html .= "<li class=''><strong>".getLabel('LABEL_MEDIA_TEMPORADA', $_SESSION['LANGUAGE'])."</strong><br>".formataDataForBrazil($dados_relevantes->DTA_INICIO_MEDIA)." ".getLabel('LABEL_ATE', $_SESSION['LANGUAGE'])." ".formataDataForBrazil($dados_relevantes->DTA_FIM_MEDIA)."</li>";
				//$html .= "<li style='padding-left:12px'></li>";
			$html .= "</ul>";
			$html .= "<ul class='blog_labels'>";
				$html .= "<li>".getLabel('LABEL_SEGASEX', $_SESSION['LANGUAGE'])."</li>";
				$html .= "<li>".getLabel('LABEL_SABADOM', $_SESSION['LANGUAGE'])."</li>";
			$html .= "</ul>";
		$html .= "</div>";
        
        $html .= "<div class='sep-pattern-1'></div>";
        
		$quarto_tipos = mysql_query("
			SELECT 
				quartos_tipo.*, 
				quartos_tipo.NOME as TIPO, 
				descricao.".$_SESSION["LANGUAGE"]." as DESCRICAO,
				fotos.URL,
				fotos.TITULO
			FROM quartos_tipo
			INNER JOIN quartos_tipo_rel_descricao ON quartos_tipo_rel_descricao.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
			INNER JOIN descricao ON descricao.CODDESCRICAO=quartos_tipo_rel_descricao.CODDESCRICAO
			INNER JOIN quartos_tipo_rel_fotos ON quartos_tipo_rel_fotos.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
			INNER JOIN fotos ON quartos_tipo_rel_fotos.CODFOTO=fotos.CODFOTO
			WHERE 
			quartos_tipo.STATUS=1
			AND fotos.STATUS=1
			AND fotos.DESTAQUE=1
			ORDER BY (quartos_tipo.ORDEM+0) ASC
		");
		
		if(mysql_num_rows($quarto_tipos) != 0)
		{
		
			$html .= "<table class='fotos_container'>";
				while($qtp = mysql_fetch_object($quarto_tipos))
				{
					$html .= "<tr class='post_simples'>"; 
						$html .= "<td><input type='button' onclick='location.href=\"index.php?actionType=reservas\" ' value='".getLabel('LABEL_MAIS', $_SESSION['LANGUAGE'])."'class='BtnFiltro small'/></td>";
						$html .= "<td class='post_simples_titulo'>".$qtp->TIPO."</td>";
						$html .= "<td class='fotos_descricao blog_tarifas' >";
							$html .= "<div class='blog_colbaixa blog_col temporada valor'><strong>R$</strong> ".formataReais($qtp->VALOR_MEDIA)."</div>";
						$html .= "</td>"; 
						$html .= "<td class='fotos_descricao blog_tarifas last' >";	
							$html .= "<div class='blog_col_alta blog_col temporada valor'><strong>R$</strong> ".formataReais($qtp->VALOR_MEDIA_FINAL)."</div>";
						$html .= "</td>"; 
					$html .= "</tr>";    
				}
			
			$html .= "</table>";
		
		}
		
		//alta temporada
		$html .= "<div class='blog_header'>";
			$html .= "<ul class='left'>";
				$html .= "<li class=''><strong>".getLabel('LABEL_ALTA_TEMPORADA', $_SESSION['LANGUAGE'])."</strong><br>".formataDataForBrazil($dados_relevantes->DTA_INICIO_ALTA)." ".getLabel('LABEL_ATE', $_SESSION['LANGUAGE'])." ".formataDataForBrazil($dados_relevantes->DTA_FIM_ALTA)."</li>";
				$html .= "<li style='padding-left:12px'></li>";
			$html .= "</ul>";
			$html .= "<ul class='blog_labels'>";
				$html .= "<li>".getLabel('LABEL_SEGASEX', $_SESSION['LANGUAGE'])."</li>";
				$html .= "<li>".getLabel('LABEL_SABADOM', $_SESSION['LANGUAGE'])."</li>";
			$html .= "</ul>";
		$html .= "</div>";
        
        $html .= "<div class='sep-pattern-1'></div>";
        
		$quarto_tipos = mysql_query("
			SELECT 
				quartos_tipo.*, 
				quartos_tipo.NOME as TIPO, 
				descricao.".$_SESSION["LANGUAGE"]." as DESCRICAO,
				fotos.URL,
				fotos.TITULO
			FROM quartos_tipo
			INNER JOIN quartos_tipo_rel_descricao ON quartos_tipo_rel_descricao.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
			INNER JOIN descricao ON descricao.CODDESCRICAO=quartos_tipo_rel_descricao.CODDESCRICAO
			INNER JOIN quartos_tipo_rel_fotos ON quartos_tipo_rel_fotos.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
			INNER JOIN fotos ON quartos_tipo_rel_fotos.CODFOTO=fotos.CODFOTO
			WHERE 
			quartos_tipo.STATUS=1
			AND fotos.STATUS=1
			AND fotos.DESTAQUE=1
			ORDER BY (quartos_tipo.ORDEM+0) ASC
		");
		
		if(mysql_num_rows($quarto_tipos) != 0)
		{
		
			$html .= "<table class='fotos_container'>";
				while($qtp = mysql_fetch_object($quarto_tipos))
				{
					$html .= "<tr class='post_simples'>"; 
						$html .= "<td><input type='button' onclick='location.href=\"index.php?actionType=reservas\" ' value='".getLabel('LABEL_MAIS', $_SESSION['LANGUAGE'])."'class='BtnFiltro small'/></td>";
						$html .= "<td class='post_simples_titulo'>".$qtp->TIPO."</td>";
						$html .= "<td class='fotos_descricao blog_tarifas' >";
							$html .= "<div class='blog_colbaixa blog_col temporada valor'><strong>R$</strong> ".formataReais($qtp->VALOR)."</div>";	
						$html .= "</td>"; 
						$html .= "<td class='fotos_descricao blog_tarifas last' >";	
							$html .= "<div class='blog_col_alta blog_col temporada valor'><strong>R$</strong> ".formataReais($qtp->VALOR_FINAL)."</div>";
						$html .= "</td>"; 
					$html .= "</tr>";    
				}
			
			$html .= "</table>";
		
		}
		
		
?>