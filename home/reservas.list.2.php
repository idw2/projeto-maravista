<?php

        $html .= "<div class='pint_titulo Acomodacoes'>".getLabel('LABEL_NOSSAS_ACOMODACOES', $_SESSION['LANGUAGE'])."</div>";
        
		$tipos = mysql_query("SELECT 
			quartos_tipo.CODQUARTOTIPO,
			quartos_tipo.NOME,
			quartos_tipo.SIGLA,
			quartos_tipo.VALOR_BAIXA as VALOR,
			descricao.".$_SESSION['LANGUAGE'].",
			fotos.CODFOTO,
			fotos.TITULO,
			fotos.URL
		FROM
			quartos_tipo
		INNER JOIN quartos_tipo_rel_descricao ON quartos_tipo_rel_descricao.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
		INNER JOIN quartos_tipo_rel_fotos ON quartos_tipo_rel_fotos.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
		INNER JOIN descricao ON quartos_tipo_rel_descricao.CODDESCRICAO=descricao.CODDESCRICAO
		INNER JOIN fotos ON fotos.CODFOTO=quartos_tipo_rel_fotos.CODFOTO
		WHERE quartos_tipo.STATUS=1
		AND fotos.DESTAQUE=1
		GROUP BY quartos_tipo.CODQUARTOTIPO
		ORDER BY (quartos_tipo.ORDEM+0) ASC");		
		
		$count = 0;
		$i=0;
		if( mysql_num_rows($tipos) != 0)
		{
			while( $quarto_tipo = mysql_fetch_object($tipos))
			{
				$count++;	
				( $count % 2 == 0 )
				? $html .= "<div class='MasterListBody'>"
				: $html .= "<div class='MasterListBody MasterListBodyColor'>";
				
					$html .= "<div class='MasterList'>";
						$html .= "<div class='TopImageReserva'>";
							$html .= "<div class='ImgReserva'>";
	
								$fotos = mysql_query("SELECT  
										fotos.CODFOTO,
										DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA,
										fotos.TITULO,
										fotos.URL,
										fotos.STATUS,
										fotos.DESTAQUE,
										fotos.OWNER
								FROM fotos 
								INNER JOIN quartos_tipo_rel_fotos ON quartos_tipo_rel_fotos.CODFOTO=fotos.CODFOTO
								WHERE 
								quartos_tipo_rel_fotos.CODQUARTOTIPO='$quarto_tipo->CODQUARTOTIPO'
								ORDER BY (fotos.DESTAQUE) DESC
								");
								
								//$html .= "<p id='_$quarto_tipo->CODQUARTOTIPO' >";
								$html .= "<p class='loadGallery' id='_$quarto_tipo->CODQUARTOTIPO'>";
									$count = 0;
									
									if( mysql_num_rows($fotos) != 0)
									{
										while( $foto = mysql_fetch_object($fotos))
										{
											if( $foto->TITULO != "")
											{
												$titulo = "- $foto->TITULO";
											}
											
											($count == 0) ? $display = "display: block;" : $display = "display: none;";
											/*
                                                     $html .= "<div class='$quarto_tipo->CODQUARTOTIPO'data-fancybox-group='gallery' title='$quarto_tipo->NOME $titulo' style='$display;'>";
                                                     $html .= "<img src='$foto->URL' alt='$quarto_tipo->NOME $titulo' />";
                                                     $html .= "<a href='$foto->URL' class='melhores-icon'><span></span></a>";
                                                     $html .= "</div>";
                                                     
                                            */
											
											$html .= "<div class='$quarto_tipo->CODQUARTOTIPO' href='$foto->URL' data-fancybox-group='gallery' title='$quarto_tipo->NOME $titulo' style='$display'>";
											$html .= "<img src='$foto->URL' alt='$quarto_tipo->NOME $titulo' />";
                                            $html .= "<a href='$foto->URL' class='melhores-icon'><span></span></a>";
											$html .= "</div>";
											
											$count++;
										}
									}
								$html .= "</p>";		
								
							$html .= "</div>";
                                                        
						$html .= "</div>";
						
						$html .= "<div class='TopQuartoReserva'>";
							
							$html .= "<div class='ResultQuatosTableTRTitle'>$quarto_tipo->NOME</div>"; 
							
							( $quarto_tipo->VALOR == "0" || $quarto_tipo->VALOR == null)
							? $quarto_tipo->VALOR = "0,00"
							: $quarto_tipo->VALOR = formataReais($quarto_tipo->VALOR);
							
							$html .= "<div>".getLabel('LABEL_APARTIR_DE', $_SESSION['LANGUAGE'])." R$ ".$quarto_tipo->VALOR."</div>";
							//$html .= "<div class='DiariaLabel'>".getLabel('LABEL_DIARIA', $_SESSION['LANGUAGE']).": <!-- <span class='DiariaPre�o'>R$ $quarto_tipo->VALOR</div>";
							//$html .= "<div class='DiariaLabel'>Capacidade: <span class='DiariaPreco'>$quarto_tipo->PESSOAS ".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</span></div>";
							
						$html .= "</div>";
                                    
                                    $html .= "<div class='ReservaDescript' id='ReservaDescriptId_$quarto_tipo->CODQUARTO'>";
                                      $html .= "<input type='hidden' id='ReservaDescriptInputHidden_$quarto_tipo->CODQUARTO' value='$i'/>";

                                      $html .= "<div class='acord_each'>";
                                        $html .= "<div class='acord_title' id='ReservaDescript_$quarto_tipo->CODQUARTO' class='btn_azul font14'>".getLabel('LABEL_MAISINFO', $_SESSION['LANGUAGE'])."</div>";
                                        $html .= "<div class='acord_cont' id='ReservaDescriptShow_$quarto_tipo->CODQUARTO'>".$quarto_tipo->$_SESSION['LANGUAGE']."</div>";
                                      $html .= "</div>";
                                    $html .= "</div>";
                                    
					$html .= "</div>";
					
					$html .= "<div class='ResetFloat'></div>";
					
				
				$html .= "</div>";
				$i++;
			}
		}

?>