 <?php

        

$html .= "<div id='corpo'>";

		

    $html .="<div class='container'>";

    

	$html .="<div class='fix_form col-xs-4' style='top: 0px;'></div>";

        

        $html .="<div class='col-xs-4'>";

            require("side.topicos.php");
            

        $html .= "</div>";

        

        $html .="<div class='pag_interna col-xs-8 right'>";

		
			$html .="<div class='pint_titulo Acomodacoes'>";

					$html .= getLabel('LABEL_FACILIDADESESERVICOES', $_SESSION['LANGUAGE']);

			$html .="</div>";
                  
                  $html .="<div class='blog_container'>";

                      
			$listRespostas = mysql_query("SELECT 
				dicas.CODDICA, 
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
				AND dicas.CODDICA NOT IN ('887C46C78B521C123A80B5BBDD0B876C')
				ORDER BY (dicas.ORDEM+0) ASC");	

				
				if(mysql_num_rows($listRespostas) != 0) 
				{
					while($resposta = mysql_fetch_object($listRespostas))
					{
						$html .="<div class='blog_item'>";
                                    
                                    (string) $nome = getlinguagemdasessao();
						
							$fotos = mysql_query("SELECT  
							fotos.*,
								DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA
							FROM fotos 
							INNER JOIN dicas_rel_fotos ON dicas_rel_fotos.CODFOTO=fotos.CODFOTO
							WHERE dicas_rel_fotos.CODDICA='$resposta->CODDICA'
							AND fotos.DESTAQUE=1
							ORDER BY (fotos.DESTAQUE) DESC
							");
							
							if( mysql_num_rows($fotos) != 0)
							{
								while( $foto = mysql_fetch_object($fotos))
								{
									if( $foto->TITULO != "")
									{
										$titulo = "- $foto->TITULO";
									}
									$html .= "<div class='blog_pic'>"
                                                              . "<a href='index.php?actionType=facilidades.servicos.view&coddica=$resposta->CODDICA'><h2 class='blog_pic_titulo'>$resposta->TDICA</h2></a>"
                                                              . "<div class='loadGallery'>"
                                                              . "<div style='background: url(\"$foto->URL\")' title='$titulo' class='blog_img'></div>"
                                                              . "</div>" //LOADGALLERY		
                                                              . "</div>"; //BLOG PIC
									
								}
							}
                                      $html .= "<div class='blog_descricao'><span class='limit'>"
                                              . "$resposta->TDESC";
                                      $html .= "</span></div>"; //BLOG DESCRICAO
                                      
                                      $html .= "<div class='blog_mais'>"
                                              ."<a href='index.php?actionType=facilidades.servicos.view&coddica=$resposta->CODDICA' class='BtnFiltro small' >".getLabel('LABEL_mais', $_SESSION['LANGUAGE'])."</a>"
                                              . "</div>"; //BLOG MAIS
                                    $html .= "</div>"; //ITEM
							
					}
					$html .= "<script>$('.blog_descricao .limit').text(function(index, text) {
                                                return text.substr(0, 175)+' ...';
                                                });"
                                            . "</script>";
					
				}
                   $html .= "</div>"; //CONTAINER
        $html .= "</div>";

		

    $html .= "</div>"; 

$html .= "</div>"; 



?>