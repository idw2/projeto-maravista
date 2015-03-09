
<?php
        $html .= "<div id='corpo'>";
        
		$codcarrossel = "E38232694E56B7F3D0C2844AB4704D4F";     
		$carrossels = mysql_query("SELECT  
			fotos.CODFOTO,
			DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA,
			fotos.TITULO,
			fotos.URL,
			fotos.STATUS,
			fotos.DESTAQUE,
			fotos.OWNER
		FROM fotos 
		INNER JOIN carrossel_rel_fotos ON carrossel_rel_fotos.CODFOTO=fotos.CODFOTO
		WHERE carrossel_rel_fotos.CODCARROSSEL='$codcarrossel'
		AND fotos.STATUS=1");
		
		if(mysql_num_rows($carrossels) != 0)
		{
			$html .= "<div class='banner-home' style='width: 100%'>";
					while($carrossel = mysql_fetch_object($carrossels))
					{
					
						$html .= "<img src='$carrossel->URL' class='Imagem'/>";
					
					}   
			$html .= "</div>";
		
		
		}
		
		$html .="<div class='container'>";
                        $html .="<div class='caption-home'>";
                        $html .="<span>".getLabel('LABEL_BEM_VINDOA', $_SESSION['LANGUAGE'])."<strong>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])."</strong></span>";
                        $html .="<span>".getLabel('LABEL_HOME_SUBTITULO', $_SESSION['LANGUAGE'])."</span>";
                        $html .="</div>";
                        
                        $html .="<div class='melhores-home'>";
                        $html .="<span class='melhores-titulo'>".getLabel('LABEL_MELHORES_PRECOS', $_SESSION['LANGUAGE'])."</span>";
                        $html .="<span class='melhores-btn'><a href='index.php?actionType=reservas'>".getLabel('LABEL_RESERVAS', $_SESSION['LANGUAGE'])."</a><a href='index.php?actionType=reservas' class='melhores-icon'><span></span></a></span>";
                        $html .="</div>";
			
                        $html .="<div class='Backazul col-xs-4'>";
                            $html .= "<div class='cont_reservas'>";
				$html .="<div class='TextBackzul'>";
					$html .="<span class='Reserve'>".getLabel('LABEL_RESERVE', $_SESSION['LANGUAGE'])."</span>";
					$html .="<span class='Seuquarto'>".getLabel('LABEL_SEU_QUARTO', $_SESSION['LANGUAGE'])."</span>";
					$html .="<div class='TextBackzul-bg'></div>";
				$html .="</div>";
				$html .="<div class='formBackazul'>";
					$html .="<div class='formBackazul-bg'></div>";
					
					$html .= "<div class='dv_main'>";

						$html .= "<form id='form1' name='form1' method='post' action='index.php?actionType=reservas'>";
								
						$html .= "<div class='CalendarClassMaster'>";
							
							$html .= "<div class='CalendarClass'>";	
								$html .= "<div class='CalendarLabel Lilabellogin' style='margin-bottom: 10px;'>".getLabel('LABEL_CHEGADA', $_SESSION['LANGUAGE'])."</div>";
								if(!empty($_POST) && isset($_POST['ACTION']) )
								{
									$html .= "<input type='text' name='datainicio' class='dtaCalendario' value='".$_POST['datainicio']."'/>";
								}
								else
								{
									$html .= "<input type='text' name='datainicio' class='dtaCalendario' />";
								}
							$html .= "</div>";
							
							
							$html .= "<div class='CalendarClass'>";	
								$html .= "<div class='CalendarLabel' style='margin-bottom: 10px;'>".getLabel('LABEL_SAIDA_FORM', $_SESSION['LANGUAGE'])."</div>";
								if(!empty($_POST) && isset($_POST['ACTION']) )
								{
									$html .= "<input type='text' name='datafim' class='dtaCalendario' value='".$_POST['datafim']."'/>";
								}
								else
								{
									$html .= "<input type='text' name='datafim' class='dtaCalendario' />";
								}
							$html .= "</div>";
							
							$html .= "<div class='ResetFloat'></div>";
							
							
							$html .= "<table class='tableCalendario'>";		
								
								$html .= "<tr>";			
									$html .= "<td valign='top'>";				
										
										
										$html .= "<div class='CalendarClassSel'>";		
											$html .= "<div class='CalendarLabel'>".getLabel('LABEL_PESSOAS', $_SESSION['LANGUAGE'])."</div>";
											$html .= "<div class='SelectCalendarioBg'>";		
												$html .= "<select class='dtaCalendarioSelect' name='pessoas' id='pessoas' onchange=\"javascript:openAdultosecriancas(this.value, '".getLabel('LABEL_ADULTOS', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_5ANOS', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_6A12', $_SESSION['LANGUAGE'])."', '".getLabel('LABEL_CRIANCAS_ACIMA12', $_SESSION['LANGUAGE'])."')\">";	  		
														
													if(!empty($_POST) && isset($_POST['ACTION']) )
													{
														switch( $_GET['pessoas'] )
														{
															case '1':
																$n1 = "selected";
															break;			
															case '2':
																$n2 = "selected";
															break;
															case '3':
																$n3 = "selected";
															break;
															case '4':
																$n4 = "selected";
															break;
															case '5':
																$n5 = "selected";
															break;
															case '6':
																$n6 = "selected";
															break;
															case '7':
																$n7 = "selected";
															break;
															case '8':
																$n8 = "selected";
															break;
															case '9':
																$n9 = "selected";
															break;
															case '10':
																$n10 = "selected";
															break;
														}
													}
													
													$html .= "<option value='1' $n1>01</option>";
													$html .= "<option value='2' $n2>02</option>";
													$html .= "<option value='3' $n3>03</option>";
													$html .= "<option value='4' $n4>04</option>";
													$html .= "<option value='5' $n5>05</option>";
													$html .= "<option value='6' $n6>06</option>";
													$html .= "<option value='7' $n7>07</option>";
													$html .= "<option value='8' $n8>08</option>";
													$html .= "<option value='9' $n9>09</option>";
													$html .= "<option value='10' $n10>10</option>";
												$html .= "</select>";
											$html .= "</div>";
										$html .= "</div>";
										
									$html .= "</td>";			
										
									
									$html .= "<td valign='top' class='col1'>";			
											
										$html .= "<div class='CalendarClassSel'>";		
											$html .= "<div class='CalendarLabel'>".getLabel('LABEL_QUARTOS', $_SESSION['LANGUAGE'])."</div>";
											$html .= "<div class='SelectCalendarioBg'>";		
												$html .= "<select class='dtaCalendarioSelect' name='nQuartos' id='nQuartos'>";	  		
														
													if(!empty($_POST) && isset($_POST['ACTION']) )
													{
														switch( $_GET['nQuartos'] )
														{
															case '1':
																$n1 = "selected";
															break;			
															case '2':
																$n2 = "selected";
															break;
															case '3':
																$n3 = "selected";
															break;
															case '4':
																$n4 = "selected";
															break;
															case '5':
																$n5 = "selected";
															break;
															case '6':
																$n6 = "selected";
															break;
															case '7':
																$n7 = "selected";
															break;
															case '8':
																$n8 = "selected";
															break;
															case '9':
																$n9 = "selected";
															break;
															case '10':
																$n10 = "selected";
															break;
														}
													}
													
													$html .= "<option value='1' $n1>01</option>";
													$html .= "<option value='2' $n2>02</option>";
													$html .= "<option value='3' $n3>03</option>";
													$html .= "<option value='4' $n4>04</option>";
													$html .= "<option value='5' $n5>05</option>";
													$html .= "<option value='6' $n6>06</option>";
													$html .= "<option value='7' $n7>07</option>";
													$html .= "<option value='8' $n8>08</option>";
													$html .= "<option value='9' $n9>09</option>";
													$html .= "<option value='10' $n10>10</option>";
												$html .= "</select>";
											$html .= "</div>";
										$html .= "</div>";
										
									$html .= "</td>";			
									
								$html .= "</tr>";			
							$html .= "</table>";		
							 

							
							
							
						$html .= "</div>";
						
						$html .= "<div class='ResetFloat'></div>";
							
						$html .= "<div class='CalendarClass'>";	
							$html .= "<div class='dtaCalendarioSubmit_div'><input type='submit' name='enviar' class='dtaCalendarioSubmit' value='".getLabel('LABEL_CLIQUEAQUI', $_SESSION['LANGUAGE'])."'/></div>";
							$html .= "<input type='hidden' name='ErroCrianca' id='ErroCrianca' value='* ".getLabel('LABEL_ERRO_CRIANCA', $_SESSION['LANGUAGE'])."!'/>";	
							$html .= "<input type='hidden' name='n_adulto' id='n_adulto' value='0'/>";	
							$html .= "<input type='hidden' name='n_crianca' id='n_crianca' value='0'/>";	
							$html .= "<input type='hidden' name='ACTION' value='ACTION'/>";
							$html .= "<div id='ErroPrintMassage' class='CalendarLabel' style='height: 37px;'></div>";	
						$html .= "</div>";		
							
						$html .= "</form>";

						 
					$html .= "</div>"; 
					
				$html .="</div>";
                            $html .= "</div>";
                            
                            $html .= "<div class='LuaDeMel'>";
                                $html .="<div class='ImagemTopLeft'><img src='../image/cantoneira_left.png' alt='' border='0' title=''/></div>";	
                                $html .= "<h2 class='LuadeMel_titulo'>LUA DE MEL &<strong>CASAMENTOS</strong></h2>";
                                $html .= "<a class='LuadeMel_items trans02'><p>Momentos ".utf8_decode('inesquecíveis')." na Pousada Maravista</p></a>";
                                $html .= "<span class='l-separador'></span>";
                                $html .= "<a class='LuadeMel_items trans02'><p>Para mais ".utf8_decode('informações')."</p></a>";
                                $html .= "<a class='melhores-icon'><span></span></a>";
                            $html .= "</div>";
                            
			$html .="</div>";
			
			$html .="<div class='col-xs-8 bannermedio' style='margin: 394px 0 0;'>";
				$banner = mysql_query("
				SELECT  
					fotos.CODFOTO,
					DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA,
					fotos.TITULO,
					fotos.URL,
					fotos.STATUS,
					fotos.DESTAQUE,
					fotos.OWNER,
					eventos_rel_fotos.CODEVENTO
				FROM 
				fotos 
				INNER JOIN eventos_rel_fotos ON eventos_rel_fotos.CODFOTO=fotos.CODFOTO
				WHERE fotos.DESTAQUE=1 
				AND fotos.STATUS=1
				GROUP BY eventos_rel_fotos.CODFOTO 
				ORDER BY fotos.DTA DESC 
				LIMIT 0,3");

				if( mysql_num_rows($banner) != 0 )
				{	
					$html .= "<div class='divFrameEvent'>";
						$html .= "<iframe src='../plugin_eventos/index.php?language=".$_SESSION['LANGUAGE']."' scrolling='no' width='100%' height='100%' frameborder='0'></iframe>"; 
					$html .= "</div>";
				}
				
				$html .="<div class='fotos_container'>";
					
					$galerias = mysql_query("SELECT 
						galerias.CODGALERIA, 
						galerias.".$_SESSION['LANGUAGE']." as NOME, 
						descricao.".$_SESSION['LANGUAGE']." as DESCRICAO
						FROM galerias
						INNER JOIN galerias_rel_descricao ON galerias_rel_descricao.CODGALERIA=galerias.CODGALERIA
						INNER JOIN descricao ON galerias_rel_descricao.CODDESCRICAO=descricao.CODDESCRICAO
						WHERE galerias.DESTAQUE=1
						ORDER BY (galerias.ORDEM+1) ASC LIMIT 0,2");
					
					if( mysql_num_rows($galerias) != 0)
					{
						
						while( $galeria = mysql_fetch_object($galerias))
						{
							$html .="<div class='fotos_item'>";
								
								$nm = explode(" ", $galeria->NOME);
								$nome = "";
								
								$i = 0;
								foreach( $nm as $n => $valor)
								{
									( $i == 0 )? $nome .= "$valor ":$nome .= "<strong>$valor </strong>";
									$i++;		
								}
								
									$fotos = mysql_query("SELECT  
										fotos.*,
										DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA
									FROM fotos 
									INNER JOIN galerias_rel_fotos ON galerias_rel_fotos.CODFOTO=fotos.CODFOTO
									WHERE 
									galerias_rel_fotos.CODGALERIA='$galeria->CODGALERIA'
									ORDER BY (fotos.DESTAQUE) DESC
									");
									
									$html .="<div class='fotos_pic'>";
									
										$html .="<span class='fotos_pic_titulo'>$nome</span>";
										
										$html .= "<div style='margin: 0;' class='loadGallery' id='_$galeria->CODGALERIA'>";
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
													
														$html .= "<div class='$galeria->CODGALERIA' data-fancybox-group='gallery' href='$foto->URL' title='$galeria->NOME' style='$display cursor: default'>";
															$html .= "<img src='$foto->URL' alt='$galeria->NOME' title='$galeria->NOME' />";
															if($count == 0)
															{
																$html .="<a href='$foto->URL' class='melhores-icon'><span></span></a>";
															}
														$html .= "</div>";
													
													$count++;
												}
											}
										$html .= "</div>";
										
										
									$html .= "</div>";
								
								$html .="<div class='fotos_descricao'>";
								$html .="<p>$galeria->DESCRICAO</p>";
								$html .="</div>";
								$html .="<span class='seta_bottom_right'></span>";
								$html .="<div class='ImagemTopRight'><img src='../image/cantoneira_right.png' alt='' border='0' title=''/></div>";
								
							$html .="</div>";						
						}
					
					}
		
				$html .="</div>";
				
			$html .="</div>";
		$html .="</div>";
		
	$html .="</div>";
?>