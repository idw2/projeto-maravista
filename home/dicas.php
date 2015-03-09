<?php

        

$html .= "<div id='corpo'>";

		

    $html .="<div class='container'>";

    

	$html .="<div class='fix_form col-xs-4' style='top: 0px;'></div>";

        

        $html .="<div class='col-xs-4'>";

            require("side.topicos.php");
            

        $html .= "</div>";

        

        $html .="<div class='pag_interna col-xs-8 right'>";

        

                        $html .="<div class='pint_titulo Acomodacoes'>";

                                $html .= getLabel('LABEL_DICAS_MENU', $_SESSION['LANGUAGE']);

                        $html .="</div>";

                 
						$html .="
						<script>
							
							$(function() {
								$( '#accordion' ).accordion();								
							});
							
							$(function() {
								var id = $('.loadGallery').attr('id');
								var rpc = id.replace('_','');
								var fcybx = '.' + rpc;
								jQuery(fcybx).fancybox();
							});
							
							
						</script>";
                                    
                                    $html .= "<div class=topico-list>";
                                    		$listRespostas = mysql_query("SELECT 
                                dicas.".$_SESSION['LANGUAGE']." as TDICA, 
                                dicas.ORDEM,
                                dicas.CODDICA,
                                descricao.".$_SESSION['LANGUAGE']." as TDESC, 
                                fotos.URL 
                                FROM dicas 
                                INNER JOIN dicas_rel_descricao ON dicas_rel_descricao.CODDICA=dicas.CODDICA
                                INNER JOIN descricao ON dicas_rel_descricao.CODDESCRICAO=descricao.CODDESCRICAO
                                INNER JOIN dicas_rel_fotos ON dicas_rel_fotos.CODDICA=dicas.CODDICA
                                INNER JOIN fotos ON dicas_rel_fotos.CODFOTO=fotos.CODFOTO
                                WHERE dicas.STATUS=1 
                                AND fotos.DESTAQUE=1
                                ORDER BY (dicas.ORDEM+0) ASC");	

								
								if(mysql_num_rows($listRespostas) != 0) 
                                {
									while($resposta = mysql_fetch_object($listRespostas))
									{
											(string) $nome = getlinguagemdasessao();

											$html .="<p class='topico-item'>$resposta->ORDEM - $resposta->TDICA</p>";
									}
                                }
						
                                    $html .= "</div>";
						
						$html .="<div class='topico'>";
							
							$listRespostas = mysql_query("SELECT 
                                dicas.".$_SESSION['LANGUAGE']." as TDICA, 
                                dicas.ORDEM,
                                dicas.CODDICA,
                                descricao.".$_SESSION['LANGUAGE']." as TDESC, 
                                fotos.URL 
                                FROM dicas 
                                INNER JOIN dicas_rel_descricao ON dicas_rel_descricao.CODDICA=dicas.CODDICA
                                INNER JOIN descricao ON dicas_rel_descricao.CODDESCRICAO=descricao.CODDESCRICAO
                                INNER JOIN dicas_rel_fotos ON dicas_rel_fotos.CODDICA=dicas.CODDICA
                                INNER JOIN fotos ON dicas_rel_fotos.CODFOTO=fotos.CODFOTO
                                WHERE dicas.STATUS=1 
                                AND fotos.DESTAQUE=1
                                ORDER BY (dicas.ORDEM+0) ASC");	

								
								if(mysql_num_rows($listRespostas) != 0) 
                                {
									while($resposta = mysql_fetch_object($listRespostas))
									{
											(string) $nome = getlinguagemdasessao();

											$html .="<hr>"
                                                                          . "<h3>$resposta->ORDEM - $resposta->TDICA</h3>";
											$html .="<div>";
											
												$fotos = mysql_query("SELECT  
													fotos.*,
													DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA
												FROM fotos 
												INNER JOIN dicas_rel_fotos ON dicas_rel_fotos.CODFOTO=fotos.CODFOTO
												WHERE 
												dicas_rel_fotos.CODDICA='$resposta->CODDICA'
												ORDER BY (fotos.DESTAQUE) DESC
												");
												
												$html .="<div class='fotos_pic'>";
													
													$html .= "<div style='margin: 0;' class='loadGallery' id='_$resposta->CODDICA'>";
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
																	$html .= "<a href='$foto->URL' class='$resposta->CODDICA' data-fancybox-group='gallery' title='$resposta->ORDEM - $resposta->TDICA' style='$display; cursor: pointer'>";
																		$html .= "<img src='$foto->URL' alt='$resposta->ORDEM - $resposta->TDICA' title='$resposta->ORDEM - $resposta->TDICA' />";	
																	$html .= "</a>";
																
																$count++;
															}
														}
													$html .= "</div>";
													
													
												$html .= "</div>";
											
												$html .="<p>";
													$html .="$resposta->TDESC";
												$html .="</p>";
											$html .="</div>";
											
									}
                                }
								
							
							
							
							
						$html .="</div>";
	

        $html .= "</div>";

		

    $html .= "</div>"; 

$html .= "</div>"; 



?>