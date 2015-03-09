<?php

	
	$html .="<div class='acord_container col-xs-8 ResultQuartosPrincipal' style='top: -112px;'>";
        
		require("reservas.form.submit.php");
	
		$tipos = mysql_query("SELECT 
					quartos.CODQUARTO,
					quartos.NOME,
					DATE_FORMAT( quartos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA,
					quartos.STATUS,
					quartos.PESSOAS,
					quartos.VALOR,
					quartos.OWNER,
					fotos.URL,
					fotos.TITULO,
					quartos_tipo.NOME as TIPO,
					quartos_descricao.".$_SESSION['LANGUAGE']."
					FROM quartos
					INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
					INNER JOIN quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
					INNER JOIN quartos_descricao ON quartos_descricao.CODQUARTO=quartos.CODQUARTO
					INNER JOIN quartos_rel_fotos ON quartos_rel_fotos.CODQUARTO=quartos.CODQUARTO
					INNER JOIN fotos ON fotos.CODFOTO=quartos_rel_fotos.CODFOTO
					WHERE fotos.DESTAQUE=1
					$titulo_quarto
					$descricao_quarto
					$codquartotipo
					GROUP BY quartos.CODQUARTO
					ORDER BY (quartos_tipo.ORDEM+0) ASC
				");	
		
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
										INNER JOIN quartos_rel_fotos ON quartos_rel_fotos.CODFOTO=fotos.CODFOTO
										WHERE quartos_rel_fotos.CODQUARTO='$quarto_tipo->CODQUARTO'");
								
								$html .= "<p class='loadGallery' id='_$quarto_tipo->CODQUARTO'>";
									
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
											
											$html .= "<div href='$foto->URL' data-fancybox-group='gallery' title='$quarto_tipo->NOME $titulo' class='$quarto_tipo->CODQUARTO' style='$display ; position:relative;'>";
												$html .= "<img src='$foto->URL' alt='$quarto_tipo->NOME $titulo' />";
                                                $html .= "<a class='melhores-icon'><span></span>";
											$html .= "</a></div>";
											
											$count++;
										}
									}
								$html .= "</p>";		
							$html .= "</div>";
							
							$html .= "<div>"; 
								$html .= "<form style='position:absolute; bottom: 0; left: 260px;' name='form_$quarto_tipo->CODQUARTOTIPO' method='post' action='index.php?actionType=quartos.resultado'>"; 
									$html .= "<input type='hidden' name='codquartotipo' value=''/>"; 
								$html .= "</form>"; 
							$html .= "</div>";
                                                        
						$html .= "</div>";
						
						$html .= "<div class='TopQuartoReserva'>";
							
							$html .= "<div class='ResultQuatosTableTRTitle'>$quarto_tipo->TIPO, $quarto_tipo->NOME</div>"; 
							
							( $quarto_tipo->VALOR == "0" || $quarto_tipo->VALOR == null)
							? $quarto_tipo->VALOR = "0,00"
							: $quarto_tipo->VALOR = formataReais($quarto_tipo->VALOR);
							
							$html .= "<div class='DiariaLabel'>".getLabel('LABEL_DIARIA', $_SESSION['LANGUAGE']).": <span class='DiariaPreço'>R$ $quarto_tipo->VALOR</div>";
							$html .= "<div class='DiariaLabel'>Capacidade: <span class='DiariaPreço'>$quarto_tipo->PESSOAS ".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</span></div>";
							
						$html .= "</div>";
					$html .= "</div>";
					
					$html .= "<div class='ResetFloat'></div>";
					
					$html .= "<div class='ReservaDescript' id='ReservaDescriptId_$quarto_tipo->CODQUARTO'>";
						$html .= "<input type='hidden' id='ReservaDescriptInputHidden_$quarto_tipo->CODQUARTO' value='$i'/>";
						/*
                        $html .= "<div class='acord_each'>";
							$html .= "<div class='acord_title' id='ReservaDescript_$quarto_tipo->CODQUARTO' class='btn_azul font14'>Mais Informações</div>";
							$html .= "<div class='acord_cont' id='ReservaDescriptShow_$quarto_tipo->CODQUARTO'>".$quarto_tipo->$_SESSION['LANGUAGE']."</div>";
                        $html .= "</div>";
						*/
					$html .= "</div>";
				
				
				$html .= "</div>";
				$i++;
			}
		}
			
	$html .="</div>";

?>