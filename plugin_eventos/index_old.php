    <?php

require_once("../server/Connection.class.php");
require_once("../server/lib.php");

//abre a conexao
$conn = new Connection();

//abre a conexao
$actionType = $_GET['actionType'];

$html ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$html .="<html xmlns='http://www.w3.org/1999/xhtml'>";
$html .="<head>";
$html .="<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />";
	
	$html .= getTitle($_GET['actionType']);
	
      
        $html .="<link rel='stylesheet' href='style/flexslider.css' />";
        $html .="<link rel='stylesheet' href='style/default.css' type='text/css' />";
        //$html .="<link rel='stylesheet' href='style/rcarousel.css' />";
		
	
$html .= "</head>";

$html .= "<body>";
		
		
	$mbanners = mysql_query("
		SELECT  
			fotos.CODFOTO,
			DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA,
			fotos.TITULO,
			fotos.URL,
			fotos.STATUS,
			fotos.DESTAQUE,
			fotos.OWNER,
			eventos.".$_GET['language']." as TITLE,
			descricao.".$_GET['language'].",
			eventos_rel_fotos.CODEVENTO
		FROM 
		fotos 
		INNER JOIN eventos_rel_fotos ON eventos_rel_fotos.CODFOTO=fotos.CODFOTO
		INNER JOIN eventos ON eventos_rel_fotos.CODEVENTO=eventos.CODEVENTO
		INNER JOIN eventos_rel_descricao ON eventos_rel_descricao.CODEVENTO=eventos.CODEVENTO
		INNER JOIN descricao ON eventos_rel_descricao.CODDESCRICAO=descricao.CODDESCRICAO
		WHERE fotos.DESTAQUE=1 
		AND fotos.STATUS=1
		AND eventos.STATUS=1
		GROUP BY eventos_rel_fotos.CODFOTO 
		ORDER BY fotos.DTA DESC 
		LIMIT 0,3");
		
		$n = mysql_num_rows($mbanners);
		
		if( $n != 0)
		{
			if( $n != 1 )
			{
				$html .= "<div class='eventos_container'>";
				
					$html .= "<ul id='eventos_carousel' class='eventos_ul slides'>";
				while( $mbanner = mysql_fetch_object($mbanners))
				{
					
					$nm = explode(" ", $mbanner->TITLE);
					$nome = "";
					
					$i = 0;
					foreach( $nm as $n => $valor)
					{
						( $i == 0 )? $nome .= "$valor ":$nome .= "<strong>$valor </strong>";
						$i++;		
					}
				
					//$html .= "<li><div class='eventos_item' onclick=\"window.open('../home/index.php?actionType=eventos.view&codevento=$mbanner->CODEVENTO');\" style='background: url($mbanner->URL);' >"
					$html .= "<li class='eventos_item' style='background: url($mbanner->URL);' >"
					//. "<img src='$mbanner->URL' alt='$mbanner->TITULO' title='$mbanner->TITULO' border='0' class='Imagem'/>"
					. "<div class='eventos_item_inner'>"
					. "<h2>$nome</h2>"
					. "<h3>".substr($mbanner->$_GET['language'], 0, 255)."</h3>"
					. "<span class='saibamais' onclick=\"window.open('../home/index.php?actionType=eventos.view&codevento=$mbanner->CODEVENTO');\">Saiba mais</span>"
					. "</div>"
					. "</li>";
				}
				
					$html .= "</ul>";
				$html .= "</div>";			
			}
			else
			{
				$html .= "<div class='anyClass'>";

				$mbanner = mysql_fetch_object($mbanners);	
				$html .= "<div onclick=\"location = 'window.open('../home/index.php?actionType=eventos.view&codevento=$mbanner->CODEVENTO');'\"><img src='$mbanner->URL' alt='$mbanner->TITULO' title='$mbanner->TITULO' border='0' class='Imagem'/></div>";
				
			}
		}
            
          $html .= "<script src='http://code.jquery.com/jquery-1.10.1.min.js'></script>";
          $html .=  "<script language='javascript'  src='script/jquery.easing.js'></script>"
                  . "<script type=''text/javascript'' src=''script/shCore.js''></script>"
                  . "<script type=''text/javascript'' src=''script/shBrushXml.js''></script>"
                  . "<script type=''text/javascript'' src=''script/shBrushJScript.js''></script>";
          
          //$html .= "<script language='javascript'  src='script/jquery.ui.widget.min.js'></script>";
          $html .= "<script language='javascript'  src='script/jquery.flexslider-min.js'></script>";
          $html .= "<script language='javascript'>"
                  . "var win = $(window).width();"
                  . "var hei = Math.round(win/2);"
                  //. "jQuery(function($) { $('#eventos_carousel').rcarousel("
                  //. "{auto: {enabled:true, interval: 2000}, step:1, visible:1, width: win, height: hei, startAtPage:1, orientation: 'vertical', speed: 1500, }"
                  //. ");"
                  //. "});"
                  . "$(window).load(function() {"
                  . "$('.eventos_container').flexslider({"
                  .   "animation: 'slide',"
                  .   "slideshow: false,"
                  .   "itemWidth: win"
                  .   "});"
                  . "});"
                  . "</script>";
	
$html .="</body>";
$html .="</html>";

$html = stripslashes( $html );
	
print ( $html );

$conn->close ();


?>