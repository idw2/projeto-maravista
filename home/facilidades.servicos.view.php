<?php

        

$html .= "<div id='corpo'>";

		

    $html .="<div class='container'>";

    

	$html .="<div class='fix_form col-xs-4' style='top: 0px;'></div>";

        

        $html .="<div class='col-xs-4'>";

            require("side.topicos.php");
            

        $html .= "</div>";

        

        $html .="<div class='pag_interna col-xs-8 right'>";

		
			$html .="<div class='pint_titulo Acomodacoes'>";

					if($_GET["coddica"] != "887C46C78B521C123A80B5BBDD0B876C"){
					$html .= getLabel('LABEL_FACILIDADESESERVICOES', $_SESSION['LANGUAGE']);
                              }else{
                                $html .= getLabel('LABEL_SOBRE_BUZIOS', $_SESSION['LANGUAGE']);
                              }

			$html .="</div>";

                      
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
				AND dicas.CODDICA='{$_GET['coddica']}'
				ORDER BY (dicas.ORDEM+0) ASC");	
                                
				if(mysql_num_rows($listRespostas) != 0) 
				{
					
                                        while($resposta = mysql_fetch_object($listRespostas))
					{
						(string) $nome = getlinguagemdasessao();

						$html .="<div>";
                                          
                                    
                                    
                                          // ================== THUMB ==================
                                          $fotos = mysql_query("SELECT  
							fotos.*,
								DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA
							FROM fotos 
							INNER JOIN dicas_rel_fotos ON dicas_rel_fotos.CODFOTO=fotos.CODFOTO
							WHERE dicas_rel_fotos.CODDICA='$resposta->CODDICA'
							ORDER BY (fotos.DESTAQUE) DESC
                                          LIMIT 0,1
							");
							
							if( mysql_num_rows($fotos) != 0)
							{
								while( $foto = mysql_fetch_object($fotos))
								{
									if( $foto->TITULO != "")
									{
										$titulo = "$foto->TITULO";
									}
									$html .= "<div style='background-image: url(\"$foto->URL\")' class='blog_view_img' title='$titulo' >"
                                                              . "<h2 class='blog_view_title'>$resposta->TDICA</h2>"
                                                              . "<a class='fb_ne' href='$foto->URL' rel='$resposta->CODDICA' title='$titulo'><span class='blog_view_mais entypo-pictures'></span></a>"
                                                              . "</div>"; 		
									
								}
							}
                                          // ================== GALERIA ==================
							$fotos = mysql_query("SELECT  
							fotos.*,
								DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA
							FROM fotos 
							INNER JOIN dicas_rel_fotos ON dicas_rel_fotos.CODFOTO=fotos.CODFOTO
							WHERE dicas_rel_fotos.CODDICA='$resposta->CODDICA'
							ORDER BY (fotos.DESTAQUE) DESC
                                          LIMIT 1,50
							");
							
							if( mysql_num_rows($fotos) != 0)
							{
								while( $foto = mysql_fetch_object($fotos))
								{
									if( $foto->TITULO != "")
									{
										//$titulo = "- $foto->TITULO";
									}
									$html .= "<img class='fb_ne hide' rel='$resposta->CODDICA' src='$foto->URL' alt='$titulo' title='$titulo' />";
								}
							}
						$html .="</div>";
						$html .="<div style='font-size:1.6rem'>$resposta->TDESC</div>";
                                    
                                    
                                    // THUMBS DO BLOG
                                    $html .="<div class='blog_view_container'>";
                                    
                                    // PRIMEIRO THUMB
                                    if($_GET["coddica"] != "F2444F8355902EC49469352AC615A10A"){
                                        
                                        
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
                                      AND dicas.CODDICA IN ('F2444F8355902EC49469352AC615A10A')
                                      AND fotos.DESTAQUE=1");
                                    

                                      if(mysql_num_rows($listRespostas) != 0) 
                                      {
                                            while($resposta = mysql_fetch_object($listRespostas))
                                            {
                                                  $html .="<div class='blog_view_item'>";

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
                                                                    $html .= "<div class='blog_view_pic'>"
                                                                            . "<h2 class='blog_view_pic_titulo'>$resposta->TDICA</h2>"
                                                                            . "<div class='loadGallery'>"
                                                                            . "<div style='background: url(\"$foto->URL\")' title='$resposta->TDICA' class='blog_view_img'></div>"
                                                                            . "</div>" //LOADGALLERY		
                                                                            . "</div>"; //BLOG PIC

                                                              }
                                                        }
                                                    $html .= "<div class='blog_view_descricao'><span class='limit'>"
                                                            . "$resposta->TDESC";
                                                    $html .= "</span></div>"; //BLOG DESCRICAO

                                                    $html .="<script>"
                                                          . "$('.blog_view_descricao .limit').text(function(index, text) {
                                                              return text.substr(0, 175)+' ...';
                                                              });"
                                                          . "</script>";

                                                    $html .= "<div class='blog_mais'>"
                                                            ."<a href='index.php?actionType=facilidades.servicos.view&coddica=$resposta->CODDICA' class='BtnFiltro small' >".getLabel('LABEL_mais', $_SESSION['LANGUAGE'])."</a>"
                                                            . "</div>"; //BLOG MAIS
                                                  $html .= "</div>"; //ITEM

                                            }


                                      }
                                    }
                                    
                                    // SEGUNDO THUMB
                                      
                                    if($_GET["coddica"] == "45A61C35E5F2E69969893D84A141BE3B"){
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
                                        AND dicas.CODDICA IN ('93618B36B30CED28828689B9234EC405')
                                        AND fotos.DESTAQUE=1");	


                                        if(mysql_num_rows($listRespostas) != 0) 
                                        {
                                            while($resposta = mysql_fetch_object($listRespostas))
                                            {
                                              $html .="<div class='blog_view_item'>";

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
                                                              $html .= "<div class='blog_view_pic'>"
                                                                      . "<h2 class='blog_view_pic_titulo'>$resposta->TDICA</h2>"
                                                                      . "<div class='loadGallery'>"
                                                                      . "<div style='background: url(\"$foto->URL\")' title='$resposta->TDICA' class='blog_view_img'></div>"
                                                                      . "</div>" //LOADGALLERY		
                                                                      . "</div>"; //BLOG PIC

                                                        }
                                                  }
                                              $html .= "<div class='blog_view_descricao'><span class='limit'>"
                                                      . "$resposta->TDESC";
                                              $html .= "</span></div>"; //BLOG DESCRICAO

                                              $html .="<script>"
                                                  . "$('.blog_view_descricao .limit').text(function(index, text) {
                                                      return text.substr(0, 175)+' ...';
                                                      });"
                                                  . "</script>";

                                              $html .= "<div class='blog_mais'>"
                                                    ."<a href='index.php?actionType=facilidades.servicos.view&coddica=$resposta->CODDICA' class='BtnFiltro small' >".getLabel('LABEL_mais', $_SESSION['LANGUAGE'])."</a>"
                                                    . "</div>"; //BLOG MAIS
                                              $html .= "</div>"; //ITEM

                                        }
                                      }
                                }elseif($_GET["coddica"] == "93618B36B30CED28828689B9234EC405"){
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
                                        AND dicas.CODDICA IN ('45A61C35E5F2E69969893D84A141BE3B')
                                        AND fotos.DESTAQUE=1");	


                                        if(mysql_num_rows($listRespostas) != 0) 
                                        {
                                            while($resposta = mysql_fetch_object($listRespostas))
                                            {
                                              $html .="<div class='blog_view_item'>";

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
                                                              $html .= "<div class='blog_view_pic'>"
                                                                      . "<h2 class='blog_view_pic_titulo'>$resposta->TDICA</h2>"
                                                                      . "<div class='loadGallery'>"
                                                                      . "<div style='background: url(\"$foto->URL\")' title='$resposta->TDICA' class='blog_view_img'></div>"
                                                                      . "</div>" //LOADGALLERY		
                                                                      . "</div>"; //BLOG PIC

                                                        }
                                                  }
                                              $html .= "<div class='blog_view_descricao'><span class='limit'>"
                                                      . "$resposta->TDESC";
                                              $html .= "</span></div>"; //BLOG DESCRICAO

                                              $html .="<script>"
                                                  . "$('.blog_view_descricao .limit').text(function(index, text) {
                                                      return text.substr(0, 175)+' ...';
                                                      });"
                                                  . "</script>";

                                              $html .= "<div class='blog_mais'>"
                                                    ."<a href='index.php?actionType=facilidades.servicos.view&coddica=$resposta->CODDICA' class='BtnFiltro small' >".getLabel('LABEL_mais', $_SESSION['LANGUAGE'])."</a>"
                                                    . "</div>"; //BLOG MAIS
                                              $html .= "</div>"; //ITEM

                                        }
                                     }
                                     
                                }elseif($_GET["coddica"] == "F2444F8355902EC49469352AC615A10A"){
                                  
                                  
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
                                        AND dicas.CODDICA IN ('45A61C35E5F2E69969893D84A141BE3B')
                                        AND fotos.DESTAQUE=1");	


                                        if(mysql_num_rows($listRespostas) != 0) 
                                        {
                                            while($resposta = mysql_fetch_object($listRespostas))
                                            {
                                              $html .="<div class='blog_view_item'>";

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
                                                              $html .= "<div class='blog_view_pic'>"
                                                                      . "<h2 class='blog_view_pic_titulo'>$resposta->TDICA</h2>"
                                                                      . "<div class='loadGallery'>"
                                                                      . "<div style='background: url(\"$foto->URL\")' title='$resposta->TDICA' class='blog_view_img'></div>"
                                                                      . "</div>" //LOADGALLERY		
                                                                      . "</div>"; //BLOG PIC

                                                        }
                                                  }
                                              $html .= "<div class='blog_view_descricao'><span class='limit'>"
                                                      . "$resposta->TDESC";
                                              $html .= "</span></div>"; //BLOG DESCRICAO

                                              $html .="<script>"
                                                  . "$('.blog_view_descricao .limit').text(function(index, text) {
                                                      return text.substr(0, 175)+' ...';
                                                      });"
                                                  . "</script>";

                                              $html .= "<div class='blog_mais'>"
                                                    ."<a href='index.php?actionType=facilidades.servicos.view&coddica=$resposta->CODDICA' class='BtnFiltro small' >".getLabel('LABEL_mais', $_SESSION['LANGUAGE'])."</a>"
                                                    . "</div>"; //BLOG MAIS
                                              $html .= "</div>"; //ITEM

                                        }
                                      }
                                  
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
                                        AND dicas.CODDICA IN ('93618B36B30CED28828689B9234EC405')
                                        AND fotos.DESTAQUE=1");	


                                        if(mysql_num_rows($listRespostas) != 0) 
                                        {
                                            while($resposta = mysql_fetch_object($listRespostas))
                                            {
                                              $html .="<div class='blog_view_item'>";

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
                                                              $html .= "<div class='blog_view_pic'>"
                                                                      . "<h2 class='blog_view_pic_titulo'>$resposta->TDICA</h2>"
                                                                      . "<div class='loadGallery'>"
                                                                      . "<div style='background: url(\"$foto->URL\")' title='$resposta->TDICA' class='blog_view_img'></div>"
                                                                      . "</div>" //LOADGALLERY		
                                                                      . "</div>"; //BLOG PIC

                                                        }
                                                  }
                                              $html .= "<div class='blog_view_descricao'><span class='limit'>"
                                                      . "$resposta->TDESC";
                                              $html .= "</span></div>"; //BLOG DESCRICAO

                                              $html .="<script>"
                                                  . "$('.blog_view_descricao .limit').text(function(index, text) {
                                                      return text.substr(0, 175)+' ...';
                                                      });"
                                                  . "</script>";

                                              $html .= "<div class='blog_mais'>"
                                                    ."<a href='index.php?actionType=facilidades.servicos.view&coddica=$resposta->CODDICA' class='BtnFiltro small' >".getLabel('LABEL_mais', $_SESSION['LANGUAGE'])."</a>"
                                                    . "</div>"; //BLOG MAIS
                                              $html .= "</div>"; //ITEM

                                        }
                                     }
                                }else{
                                  
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
                                        AND dicas.CODDICA IN ('45A61C35E5F2E69969893D84A141BE3B')
                                        AND fotos.DESTAQUE=1");	


                                        if(mysql_num_rows($listRespostas) != 0) 
                                        {
                                            while($resposta = mysql_fetch_object($listRespostas))
                                            {
                                              $html .="<div class='blog_view_item'>";

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
                                                              $html .= "<div class='blog_view_pic'>"
                                                                      . "<h2 class='blog_view_pic_titulo'>$resposta->TDICA</h2>"
                                                                      . "<div class='loadGallery'>"
                                                                      . "<div style='background: url(\"$foto->URL\")' title='$resposta->TDICA' class='blog_view_img'></div>"
                                                                      . "</div>" //LOADGALLERY		
                                                                      . "</div>"; //BLOG PIC

                                                        }
                                                  }
                                              $html .= "<div class='blog_view_descricao'><span class='limit'>"
                                                      . "$resposta->TDESC";
                                              $html .= "</span></div>"; //BLOG DESCRICAO

                                              $html .="<script>"
                                                  . "$('.blog_view_descricao .limit').text(function(index, text) {
                                                      return text.substr(0, 175)+' ...';
                                                      });"
                                                  . "</script>";

                                              $html .= "<div class='blog_mais'>"
                                                    ."<a href='index.php?actionType=facilidades.servicos.view&coddica=$resposta->CODDICA' class='BtnFiltro small' >".getLabel('LABEL_mais', $_SESSION['LANGUAGE'])."</a>"
                                                    . "</div>"; //BLOG MAIS
                                              $html .= "</div>"; //ITEM

                                        }
                                      }
                                }
                                
                                
                                
                                
                                      
                                $html .="</div>";

                                $html .="<div><a style='cursor: pointer' href='index.php?actionType=facilidades.servicos' class='BtnFiltro small'>".getLabel('LABEL_VOLTAR', $_SESSION['LANGUAGE'])."</a></div>";						

                              }
					
                        }

        $html .= "</div>";

		

    $html .= "</div>"; 

$html .= "</div>"; 



?>