<?php
//AS FUNCOES RETORNA UMA PALAVRA ALEATORIA
function getLetras ( ) {

	$vogais = array( 'a', 'e', 'i', 'o', 'u');
	$consoantes = array( 'b', 'c', 'd', 'f', 'g', 'h', 'nh', 'lh', 'ch', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'qu', 'r', 'rr', 's', 'ss', 't', 'v', 'w', 'x', 'y', 'z' );

	$palavra = '';
	$tamanho_palavra = rand( 2,5 );
	$contar_silabas = 0;
	
	while( $contar_silabas < $tamanho_palavra ) {
	
	   $vogal = $vogais[ rand( 0, count( $vogais ) -1 ) ];
	   $consoante = $consoantes[ rand( 0, count( $consoantes ) -1 ) ];
	   $silaba = $consoante.$vogal;
	   $palavra .= $silaba;
	   $contar_silabas++;
	   unset( $vogal,$consoante,$silaba );
	   
	}
	
	return $palavra;
	
}

function gohtml ( $go ) {

	//simbolo
	$go = str_replace ( "&", "&amp;", $go );
	$go = str_replace ( "ß", "&sect;", $go );
	$go = str_replace ( "™", "&ordf;", $go );
	$go = str_replace ( "∫", "&ordm;", $go );
	$go = str_replace ( "<", "&lt;", $go );
	$go = str_replace ( ">", "&gt;", $go );
	$go = str_replace ( "∞", "&deg;", $go );

	//acentos graves
	$go = str_replace ( "·", "&aacute;", $go );
	$go = str_replace ( "¡", "&Aacute;", $go );
	$go = str_replace ( "È", "&eacute;", $go );
	$go = str_replace ( "…", "&Eacute;", $go );
	$go = str_replace ( "Ì", "&iacute;", $go );
	$go = str_replace ( "Õ", "&Iacute;", $go );
	$go = str_replace ( "Û", "&oacute;", $go );
	$go = str_replace ( "”", "&Oacute;", $go );
	$go = str_replace ( "˙", "&uacute;", $go );
	$go = str_replace ( "⁄", "&Uacute;", $go );
	
	//acentos crase
	$go = str_replace ( "‡", "&agrave;", $go );
	$go = str_replace ( "¿", "&Agrave;", $go );
	$go = str_replace ( "Ë", "&egrave;", $go );
	$go = str_replace ( "»", "&Egrave;", $go );
	$go = str_replace ( "Ï", "&igrave;", $go );
	$go = str_replace ( "Ã", "&Igrave;", $go );
	$go = str_replace ( "Ú", "&ograve;", $go );
	$go = str_replace ( "“", "&Ograve;", $go );
	$go = str_replace ( "˘", "&ugrave;", $go );
	$go = str_replace ( "Ÿ", "&Ugrave;", $go );
	
	//tio
	$go = str_replace ( "„", "&atilde;", $go );
	$go = str_replace ( "√", "&Atilde;", $go );
	$go = str_replace ( "ı", "&otilde;", $go );
	$go = str_replace ( "’", "&Otilde;", $go );
	
	//acento circunflexo
	$go = str_replace ( "‚", "&acirc;", $go );
	$go = str_replace ( "¬", "&Acirc;", $go );
	$go = str_replace ( "Í", "&ecirc;", $go );
	$go = str_replace ( " ", "&Ecirc;", $go );
	$go = str_replace ( "Ó", "&icirc;", $go );
	$go = str_replace ( "Œ", "&Icirc;", $go );
	$go = str_replace ( "Ù", "&ocirc;", $go );
	$go = str_replace ( "‘", "&Ocirc;", $go );
	$go = str_replace ( "˚", "&ucirc;", $go );
	$go = str_replace ( "€", "&Ucirc;", $go );
	
	//acento
	$go = str_replace ( "‰", "&auml;", $go );
	$go = str_replace ( "ƒ", "&Auml;", $go );
	$go = str_replace ( "Î", "&euml;", $go );
	$go = str_replace ( "À", "&Euml;", $go );
	$go = str_replace ( "Ô", "&iuml;", $go );
	$go = str_replace ( "œ", "&Iuml;", $go );
	$go = str_replace ( "ˆ", "&ouml;", $go );
	$go = str_replace ( "÷", "&Ouml;", $go );
	$go = str_replace ( "¸", "&uuml;", $go );
	$go = str_replace ( "‹", "&Uuml;", $go );


	return $go;
	
}

//funcao que retorna um timestamp corrente
function getTimestamp () {

	$result = mysql_query( "SELECT CURRENT_TIMESTAMP" );	
	return mysql_result( $result, 0 );

}

function getTitle( $title )
{
	
	switch($title)
	{
		case "pousada":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_APOUSADA', $_SESSION['LANGUAGE'])."</title>";
		break;
		case "reservas":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_QUARTOS', $_SESSION['LANGUAGE'])."</title>";
		break;
		
		case "reservas.form.submit":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_RESERVAS', $_SESSION['LANGUAGE'])."</title>";
		break;
		case "reservas.analisa":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_RESERVAS', $_SESSION['LANGUAGE'])."</title>";
		break;
		case "reservas.forma.pgto":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_RESERVAS', $_SESSION['LANGUAGE'])."</title>";
		break;
		case "reservas.forma.pgto.deposito":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_RESERVAS', $_SESSION['LANGUAGE'])."</title>";
		break;
		
		case "eventos":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_EVENTOSECASAMENTOS', $_SESSION['LANGUAGE'])."</title>";
		break;
		case "tarifas.promocoes":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_TARIFASEPROMOCOES', $_SESSION['LANGUAGE'])."</title>";
		break;
		case "localizacao":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_LOCALIZACAO', $_SESSION['LANGUAGE'])."</title>";
		break;
		case "galeria":
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])." - ".getLabel('LABEL_GALERIA', $_SESSION['LANGUAGE'])."</title>";
		break;
		default:
			$html .="<title>".getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE'])."</title>";
		break;
	}	
	
	return $html;

}

function getNavPrincipal () 
{	
		
		$login = mysql_query("SELECT LOGIN FROM login WHERE CODLOGIN='$_SESSION[CODLOGIN]' AND LOGIN NOT IN('admin','internet')");
		
		
		
		foreach ( $_SESSION as $name => $value ) 
		{
			if ( $name == 'USUARIODASESSAO' && trim($value) == 'ADMINISTRADOR' ) 
			{	
				//$menu .="<div class='Itemmenuheader'>".getLabel('LABEL_MENU_ADMINISTRATIVO', $_SESSION['LANGUAGE'])."</div>";
                        $menu .= "<h4 class='menu-ul-header'>".getLabel('LABEL_ADMINISTRACAO', $_SESSION['LANGUAGE'])."</h4>";
                        $menu .= linha("index.php?actionType=gerenciar.quartos", getLabel('LABEL_QUARTOS', $_SESSION['LANGUAGE']), "", "","entypo-house");
				$menu .= linha("index.php?actionType=gerenciar.a.pousada", getLabel('LABEL_APOUSADA', $_SESSION['LANGUAGE']), "", "","entypo-earth");
                        $menu .= linha("index.php?actionType=gerenciar.emails", getLabel('LABEL_CENTRAL_EMAILS', $_SESSION['LANGUAGE']), "", "","entypo-mail");
				$menu .= linha("index.php?actionType=gerenciar.cielo", getLabel('Cielo', $_SESSION['LANGUAGE']), "", "","entypo-credit-card");
				$menu .= linha("index.php?actionType=gerenciar.faleconosco", getLabel('LABEL_FALE_CONOSCO', $_SESSION['LANGUAGE']), "", "","entypo-chat");
				
				//$menu .= linha("index.php?actionType=gerenciar.cadastros", getLabel('LABEL_CADASTROS', $_SESSION['LANGUAGE']), "", "");
				
				/*
				$menu .= linha("index.php?actionType=gerenciar.extras", getLabel('LABEL_EXTRAS', $_SESSION['LANGUAGE']), "", "");*/
				
				$menu .= linha("index.php?actionType=gerenciar.reservas", getLabel('LABEL_RESERVAS', $_SESSION['LANGUAGE']), "", "","entypo-book2");
                        $menu .= linha("index.php?actionType=gerenciar.reservas.externas", getLabel('LABEL_RESERVAS_EXTERNAS', $_SESSION['LANGUAGE']), "", "","entypo-newspaper");
				
                        $menu .= linha("index.php?actionType=gerenciar.quartos.tipos", getLabel('LABEL_QUARTOS_TYPE', $_SESSION['LANGUAGE']), "", "","entypo-tag");
                        $menu .= linha("index.php?actionType=gerenciar.usuarios", getLabel('LABEL_USUARIOS', $_SESSION['LANGUAGE']), "", "","entypo-users");
				
                        $menu .= "<hr>";
                        
                        $menu .= "<h4 class='menu-ul-header'>".getLabel('LABEL_CONTEUDO', $_SESSION['LANGUAGE'])."</h4>";
                        $menu .= linha("index.php?actionType=gerenciar.carrossel", getLabel('LABEL_CARROSSEL', $_SESSION['LANGUAGE']), "", "","entypo-pictures");
                        $menu .= linha("index.php?actionType=gerenciar.eventos", getLabel('LABEL_EVENTOS', $_SESSION['LANGUAGE']), "", "","entypo-star2");
                        $menu .= linha("index.php?actionType=gerenciar.dicas", getLabel('LABEL_FACILIDADESESERVICOES', $_SESSION['LANGUAGE']), "", "","entypo-directions");
                        $menu .= linha("index.php?actionType=gerenciar.galeria", getLabel('LABEL_GALERIA', $_SESSION['LANGUAGE']), "", "","entypo-camera");
                        $menu .= linha("index.php?actionType=gerenciar.idiomas", getLabel('LABEL_IDIOMAS', $_SESSION['LANGUAGE']), "", "","entypo-language");
                        $menu .= linha("index.php?actionType=gerenciar.localizacao", getLabel('LABEL_LOCALIZACAO', $_SESSION['LANGUAGE']), "", "","entypo-map");
                        $menu .= linha("index.php?actionType=gerenciar.pacotes", getLabel('LABEL_PACOTES', $_SESSION['LANGUAGE']), "", "","entypo-bookmark");
                        $menu .= linha("index.php?actionType=gerenciar.sobre.nos", getLabel('LABEL_QUEMSOMOS', $_SESSION['LANGUAGE']), "", "","entypo-info");
                        $menu .= linha("index.php?actionType=gerenciar.rodape", getLabel('LABEL_RODAPE', $_SESSION['LANGUAGE']), "", "","entypo-box");
                        $menu .= linha("index.php?actionType=gerenciar.termos.servico", getLabel('LABEL_TERMOS', $_SESSION['LANGUAGE']), "", "","entypo-text");
                        $menu .= "<hr>";
				//$menu .= linha("index.php?actionType=gerenciar.facilidades.servicos", getLabel('LABEL_FACILIDADESESERVICOES', $_SESSION['LANGUAGE']), "", "");

			}                                                                              

		}                                                                                  

		/*                                                                                 
		$menu .= "<li><br/></li>";                                                         
		$menu .= linha("index.php?actionType=gerenciar.cadastros.edit.dados.pessoais&codpessoa=$_SESSION[CODPESSOA]", "Dados Pessoais", "", "");
		$menu .= linha("index.php?actionType=gerenciar.cadastros.edit.telefones&codpessoa=$_SESSION[CODPESSOA]", "Telefones", "", "");
		$menu .= linha("index.php?actionType=gerenciar.cadastros.edit.emails&codpessoa=$_SESSION[CODPESSOA]", "E-mails", "", "");
		$menu .= linha("index.php?actionType=gerenciar.cadastros.edit.endereco&codpessoa=$_SESSION[CODPESSOA]", "EndereÁos", "", "");
		*/                                                                                 
		//$menu .= linha("index.php?actionType=alterar.senha", getLabel('LABEL_ALTERAR_SENHA', $_SESSION['LANGUAGE']), "", "","entypo-clock");     
		//$menu .= linha("index.php?actionType=logout", getLabel('LABEL_SAIR', $_SESSION['LANGUAGE']), "", "","entypo-clock");                     
					                                                                     
                                                                                               
	return $menu;                                                                              
}                                                                                              
                                                                                               
                                                                                               
/*                                                                                             
 * Acrescenta a pontuacao correta em um numero de cpf                                          
 */                                                                                            
function formataCpf($cpf)                                                                      
{                                                                                              
	$p1 = substr($cpf, -2);                                                                    
	$p2 = substr($cpf, -5, 3);                                                                 
	$p3 = substr($cpf, -8, 3);                                                                 
	$p4 = substr($cpf, -11, 3);                                                                
	$result = $p4.".".$p3.".".$p2."-".$p1;                                                     
	return $result;                                                                            
}                                                                                              
                                                                                               
                                                                                               
function acessoDireto( $users )                                                                
{                                                                                              
	$userSession = explode(";", $users);                                                       
	$permitir = false;                                                                         
                                                                                               
	foreach( $userSession as $user )                                                           
	{                                                                                          
		                                                                                       
		if ( $_SESSION["USUARIODASESSAO"] == $user )                                           
		{                                                                                      
			$permitir = true;                                                                  
			                                                                                   
		}                                                                                      
	}                                                                                          
		                                                                                          
	if ( !$permitir )                                                                          
	{	                                                                                       
		header("Location: index.php?actionType=erro");                                         
	}                                                                                          
                                                                                               
}                                                                                              
                                                                                          
function getMenu($action)                                                                      
{        
	$li = "<div class='Mainmenu'>";
		
		$li .= "<div class='LinksMenu' title='".getLabel('LABEL_APOUSADA', $_SESSION['LANGUAGE'])."'><a href='$action/index.php?actionType=pousada'>".getLabel('LABEL_APOUSADA', $_SESSION['LANGUAGE'])."</a></div>";
		$li .= "<div class='LinksMenu' title='".getLabel('LABEL_QUARTOS', $_SESSION['LANGUAGE'])."'><a href='$action/index.php?actionType=reservas'>".getLabel('LABEL_QUARTOS', $_SESSION['LANGUAGE'])."</a></div>";
		$li .= "<div class='LinksMenu' title='".getLabel('LABEL_EVENTOSECASAMENTOS', $_SESSION['LANGUAGE'])."'><a href='$action/index.php?actionType=eventos'>".getLabel('LABEL_EVENTOSECASAMENTOS', $_SESSION['LANGUAGE'])."</a></div>";
		$li .= "<div class='LinksMenu' title='".getLabel('LABEL_TARIFASEPROMOCOES', $_SESSION['LANGUAGE'])."'><a href='$action/index.php?actionType=tarifas.promocoes'>".getLabel('LABEL_TARIFASEPROMOCOES', $_SESSION['LANGUAGE'])."</a></div>";
		$li .= "<div class='LinksMenu' title='".getLabel('LABEL_LOCALIZACAO', $_SESSION['LANGUAGE'])."'><a href='$action/index.php?actionType=localizacao'>".getLabel('LABEL_LOCALIZACAO', $_SESSION['LANGUAGE'])."</a></div>";
		$li .= "<div class='LinksMenu' title='".getLabel('LABEL_GALERIA', $_SESSION['LANGUAGE'])."'><a href='$action/index.php?actionType=galeria'>".getLabel('LABEL_GALERIA', $_SESSION['LANGUAGE'])."</a></div>";
		
	$li .= "</div>";
	$li .= "<div class='ResetFloat'></div>";
		                                                                                       
	return $li;                                                                              
}                                                                                              
                                                                                               
                                                                                               
function getMenu2($myhotsite)                                                                  
{                                                                                              
	$codigos = mysql_query("SELECT pessoa.CODPESSOA, empresa.CODEMPRESA, empresa.HOTSITE, empresa.PAGSEGURO FROM pessoa INNER JOIN empresa_rel_pessoa ON empresa_rel_pessoa.CODPESSOA=pessoa.CODPESSOA INNER JOIN empresa ON empresa.CODEMPRESA=empresa_rel_pessoa.CODEMPRESA WHERE empresa.HOTSITE='$myhotsite' GROUP BY empresa.CODEMPRESA");
	if( mysql_num_rows($codigos) != "" )                                                       
	{                                                                                          
		$html .= "<div class='NewMenu' style='position: relative; top: 12px; font-size: 109%; left: 25px; color: #fff;'>";
	}                                                                                          
	else                                                                                       
	{                                                                                          
		$html .= "<div class='NewMenu' style='position: relative; top: 12px; font-size: 109%; left: 25px; color: #fff;'>";
	}                                                                                          
		                                                                                       
		$html .= "<div style='width: 22px; position: relative; top: 3px;'><img src='../image/casa.png' width='80%'/>&nbsp;&nbsp;</div>";
		$html .= "<div onclick=\" window.location = '../$myhotsite' \"><span style='position: relative; bottom: 9px;'>MEU HOTSITE</span>&nbsp;&nbsp;&nbsp;<img src='../image/separator.png' border='0' alt='0'/>&nbsp;&nbsp;</div>";
		$html .= "<div onclick=\" window.location = '../index.php?actionType=pagina.inicial' \"><span style='position: relative; bottom: 9px;'>AGORA F¡CIL</span>&nbsp;&nbsp;&nbsp;<img src='../image/separator.png' border='0' alt='0'/>&nbsp;&nbsp;</div>";
		                                                                                       
	                                                                                           
		if( mysql_num_rows($codigos) != "" )                                                   
		{                                                                                      
			$codigos = mysql_fetch_object($codigos);                                           
			if($codigos->PAGSEGURO != "")                                                      
			{                                                                                  
				$html .= "<div onclick=\" location = '../index.php?actionType=produtos&codpessoa=$codigos->CODPESSOA&codempresa=$codigos->CODEMPRESA'\">&nbsp;&nbsp;<span style='position: relative; bottom: 9px;'>MEUS PRODUTOS</span>&nbsp;&nbsp;&nbsp;<img src='../image/separator.png' border='0' alt='0'/>&nbsp;&nbsp;</div>";
			}                                                                                  
		}                                                                                      
		                                                                                       
		//$html .= "<div onclick=\" location = '../index.php?actionType=agenda'\">&nbsp;&nbsp;<span style='position: relative; bottom: 9px;'>MINHA AGENDA</span>&nbsp;&nbsp;&nbsp;<img src='../image/separator.png' border='0' alt='0'/>&nbsp;&nbsp;</div>";
		//$html .= "<div onclick=\" location = '../index.php?actionType=galeria'\">&nbsp;&nbsp;<span style='position: relative; bottom: 9px;'>FOTOS</span>&nbsp;&nbsp;&nbsp;<img src='../image/separator.png' border='0' alt='0'/>&nbsp;&nbsp;</div>";
		$html .= "<div style='float: left; position: relative; bottom: 10px;' onmouseover=\"javascript: showMenu();\" onmouseout=\"javascript: showMenuOut();\">";
			$html .= "<span><input type='hidden' id='CONTROLE' value='0'/></span>";            
			$html .= "<div>SOBRE O AGORA F¡CIL<span class='menufilete' style='z-index: 100;'>&nbsp;<img border='0' alt='0' src='../image/separator.png' alt='' border='0' style='position: relative; top: 10px'/>&nbsp;</span></div>";
			$html .= "<ul id='Menumenu' style='position: absolute; z-index: 200; top: 9px; margin-left: auto; margin-right: auto; z-index: 1000;'>";
				                                                                               
				$item_menu = mysql_query("SELECT * FROM item_menu WHERE STATUS='1' ORDER BY TITULO ASC");
				                                                                               
				while ( $link = mysql_fetch_object($item_menu) )                               
				{                                                                              
					$html .= "<li style='width: 200px;'><a href='../index.php?actionType=online&coditemmenu=$link->CODITEMMENU'>$link->TITULO</a></li>";
				}                                                                              
				                                                                               
			$html .= "</ul>";                                                                  
		$html .= "</div>";                                                                     
		//$html .= "<div onclick=\" location = '../index.php?actionType=videos'\">&nbsp;&nbsp;<span style='position: relative; bottom: 9px;'>VIDEOS</span>&nbsp;&nbsp;&nbsp;<img src='../image/separator.png' border='0' alt='0'/>&nbsp;&nbsp;</div>";
		//$html .= "<div onclick=\" location = '../index.php?actionType=faleconosco'\">&nbsp;&nbsp;<span style='position: relative; bottom: 9px;'>FALE CONOSCO&nbsp;&nbsp;&nbsp;</span><img src='../image/separator.png' border='0' alt='0'/>&nbsp;&nbsp;</div>";
		$html .= "<div onclick=\" location = '../index.php?actionType=servicos&cod=2'\">&nbsp;&nbsp;<span style='position: relative; top: 4px;'>CADASTRE-SE</span></div>";
		$html .= "<div style='clear: both;'><br/></div>";                                      
	$html .= "</div>";                                                                         
	                                                                                           
	return $html;                                                                              
}                                                                                              
                                                                                               
// FunÁ„o que valida o CPF                                                                     
function validaCPF($cpf)                                                                       
{	                                                                                           
	$cpf = limpaCpf($cpf);                                                                     
	                                                                                           
	// Verifiva se o n˙mero digitado contÈm todos os digitos                                   
    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);                   
	                                                                                           
	// Verifica se nenhuma das sequÍncias abaixo foi digitada, caso seja, retorna falso        
   // if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
	{                                                                                          
	return false;                                                                              
    }                                                                                          
	else                                                                                       
	{   // Calcula os n˙meros para verificar se o CPF È verdadeiro                             
        for ($t = 9; $t < 11; $t++) {                                                          
            for ($d = 0, $c = 0; $c < $t; $c++) {                                              
                $d += $cpf{$c} * (($t + 1) - $c);                                              
            }                                                                                  
                                                                                               
            $d = ((10 * $d) % 11) % 10;                                                        
                                                                                               
            if ($cpf{$c} != $d) {                                                              
                return false;                                                                  
            }                                                                                  
        }                                                                                      
                                                                                               
        return true;                                                                           
    }                                                                                          
}                                                                                              
                                                                                               
                                                                                               
function validaCNPJ($cnpj)                                                                     
{                                                                                              
  if (strlen($cnpj) <> 14 || $cnpj == '00000000000000' || $cnpj == '11111111111111' || $cnpj == '22222222222222' || $cnpj == '33333333333333' || $cnpj == '44444444444444' || $cnpj == '55555555555555' || $cnpj == '66666666666666' || $cnpj == '77777777777777' || $cnpj == '88888888888888' || $cnpj == '99999999999999')
	return false;                                                                              
                                                                                               
  $soma = 0;                                                                                   
                                                                                               
  $soma += ($cnpj[0] * 5);                                                                     
  $soma += ($cnpj[1] * 4);                                                                     
  $soma += ($cnpj[2] * 3);                                                                     
  $soma += ($cnpj[3] * 2);                                                                     
  $soma += ($cnpj[4] * 9);                                                                     
  $soma += ($cnpj[5] * 8);                                                                     
  $soma += ($cnpj[6] * 7);                                                                     
  $soma += ($cnpj[7] * 6);                                                                     
  $soma += ($cnpj[8] * 5);                                                                     
  $soma += ($cnpj[9] * 4);                                                                     
  $soma += ($cnpj[10] * 3);                                                                    
  $soma += ($cnpj[11] * 2);                                                                    
                                                                                               
  $d1 = $soma % 11;                                                                            
  $d1 = $d1 < 2 ? 0 : 11 - $d1;                                                                
                                                                                               
  $soma = 0;                                                                                   
  $soma += ($cnpj[0] * 6);                                                                     
  $soma += ($cnpj[1] * 5);                                                                     
  $soma += ($cnpj[2] * 4);                                                                     
  $soma += ($cnpj[3] * 3);                                                                     
  $soma += ($cnpj[4] * 2);                                                                     
  $soma += ($cnpj[5] * 9);                                                                     
  $soma += ($cnpj[6] * 8);                                                                     
  $soma += ($cnpj[7] * 7);                                                                     
  $soma += ($cnpj[8] * 6);                                                                     
  $soma += ($cnpj[9] * 5);                                                                     
  $soma += ($cnpj[10] * 4);                                                                    
  $soma += ($cnpj[11] * 3);                                                                    
  $soma += ($cnpj[12] * 2);                                                                    
                                                                                               
                                                                                               
  $d2 = $soma % 11;                                                                            
  $d2 = $d2 < 2 ? 0 : 11 - $d2;                                                                
                                                                                               
  if ($cnpj[12] == $d1 && $cnpj[13] == $d2) {                                                  
	 return true;                                                                              
  }                                                                                            
  else {                                                                                       
	 return false;                                                                             
  }                                                                                            
}                                                                                              
                                                                                               
                                                                                               
/*                                                                                             
 * Limpa cpf                                                                                   
 */                                                                                            
function limpaCpf($cpf)                                                                        
{                                                                                              
	$cpf = str_replace(".", "", $cpf);                                                         
	$cpf = str_replace("-", "", $cpf);                                                         
	return $cpf;                                                                               
}                                                                                              
                                                                                               
/*                                                                                             
 * Limpa cpf                                                                                   
 */                                                                                            
function limpaCnpj($cnpj)                                                                      
{                                                                                              
	$cnpj = str_replace(".", "", $cnpj);                                                       
	$cnpj = str_replace("-", "", $cnpj);                                                       
	$cnpj = str_replace("/", "", $cnpj);                                                       
	return $cnpj;                                                                              
}                                                                                              
                                                                                               
/*                                                                                             
 * Limpa telefone                                                                              
 */                                                                                            
function limpaFoneAndCel ( $telAndCel )                                                        
{                                                                                              
	$telAndCel = str_replace("(", "", $telAndCel);                                             
	$telAndCel = str_replace(")", "", $telAndCel);                                             
	$telAndCel = str_replace("-", "", $telAndCel);                                             
	$telAndCel = str_replace(" ", "", $telAndCel);                                             
	return $telAndCel;	                                                                       
}                                                                                              
                                                                                               
/*                                                                                             
 * Acrescenta a pontuacao correta a um numero de telefone                                      
 */                                                                                            
function formataFoneAndCel ( $telAndCel )                                                      
{                                                                                              
	$p1 = substr($telAndCel, -4);                                                              
	$p2 = substr($telAndCel, -8, 4);                                                           
	$p3 = substr($telAndCel, -10, 2);                                                          
	$result = "(".$p3.")".$p2."-".$p1;                                                         
	return $result;	                                                                           
}                                                                                              
                                                                                               
/*                                                                                             
 * Tranforma datas do padrao Americano(2000-01-01) para o padrao brasileiro(01-01-2000)        
 */                                                                                            
function formataDataForBrazil($data)                                                           
{                                                                                              
	$dtaFormatada = $data;                                                                     
	$pieces = explode("-", $dtaFormatada);                                                     
	$pieces[0];                                                                                
	$pieces[1];                                                                                
	$pieces[2];                                                                                
	$newDate = $pieces[2]."/".$pieces[1]."/".$pieces[0];                                       
	return $newDate;                                                                           
}                                                                                              
                                                                                               
/*                                                                                             
 * Tranforma datas do padrao brasileiro(01-01-2000) para o padrao Americano(2000-01-01)        
 */                                                                                            
function formataDataForUSA($data)                                                              
{                                                                                              
	$dtaFormatada = $data;                                                                     
	$pieces = explode("/", $dtaFormatada);                                                     
	$pieces[0];                                                                                
	$pieces[1];                                                                                
	$pieces[2];                                                                                
	$newDate = $pieces[2]."-".$pieces[1]."-".$pieces[0];                                       
	return $newDate;                                                                           
}                                                                                              
                                                                                               
/*                                                                                             
 * Limpa cpf                                                                                   
 */                                                                                            
function limpaCep($cep)                                                                        
{                                                                                              
	$cep = str_replace("-", "", $cep);                                                         
	return $cep;                                                                               
}                                                                                              
                                                                                               
/*                                                                                             
 * Acrescenta a pontuacao ao cep no padrao Brasil                                              
 */                                                                                            
function formataCep($cep)                                                                      
{                                                                                              
	$p1 = substr($cep, -3);//72450050                                                          
	$p2 = substr($cep, 0, 5);                                                                  
	$result = $p2."-".$p1;                                                                     
	return $result;                                                                            
}                                                                                              
                                                                                               
/*                                                                                             
 * Limpa o valor de reais dos caracteres especiais                                             
 */                                                                                            
function limpaValorReal($valorReal)                                                            
{                                                                                              
	$valorReal = str_replace(".", "", $valorReal);                                             
	$valorReal = str_replace(",", "", $valorReal);                                             
	return $valorReal;                                                                         
}                                                                                              
                                                                                               
/*                                                                                             
 * Verifica de o valor em reais e negativo ou positivo                                         
 */                                                                                            
function trataValorMoedaReal($real)                                                            
{	                                                                                           
	if(substr_count($real,'-') == 1)                                                           
	{                                                                                          
		$real = str_replace("-", "", $real);                                                   
		$real = "<font color='red'>- ".formataReais($real)."</font>";                          
		return $real;                                                                          
	}                                                                                          
	else                                                                                       
	{                                                                                          
		return formataReais($real);                                                            
	}                                                                                          
}                                                                                              
                                                                                               
/*                                                                                             
 * Acrescenta a pontuacao correta em um numero para valor em reais                             
 */                                                                                            
function formataReais($valorReal) {
	$size = strlen($valorReal);
	$result = null;
	if ($size >= 9) {
		//9.999.999,99                                                                         
		if ($size == 9) {
			$p1 = substr($valorReal, -2);
			$p2 = substr($valorReal, -5, 3);
			$p3 = substr($valorReal, -8, 3);
			$p4 = substr($valorReal, -9, 1);
			$result = $p4 . "." . $p3 . "." . $p2 . "," . $p1;
		} elseif ($size == 10) {
			$p1 = substr($valorReal, -2);
			$p2 = substr($valorReal, -5, 3);
			$p3 = substr($valorReal, -8, 3);
			$p4 = substr($valorReal, -10, 2);
			$result = $p4 . "." . $p3 . "." . $p2 . "," . $p1;
		} elseif ($size == 11) {
			$p1 = substr($valorReal, -2);
			$p2 = substr($valorReal, -5, 3);
			$p3 = substr($valorReal, -8, 3);
			$p4 = substr($valorReal, -11, 3);
			$result = $p4 . "." . $p3 . "." . $p2 . "," . $p1;
		}
		return $result;
	} elseif ($size == 8) {
		//999.999,99                                                                           
		$p1 = substr($valorReal, -2);
		$p2 = substr($valorReal, -5, 3);
		$p3 = substr($valorReal, -8, 3);
		$result = $p3 . "." . $p2 . "," . $p1;
		return $result;
	} elseif ($size == 7) {
		//99.999,99                                                                            
		$p1 = substr($valorReal, -2);
		$p2 = substr($valorReal, -5, 3);
		$p3 = substr($valorReal, -7, 2);
		$result = $p3 . "." . $p2 . "," . $p1;
		return $result;
	} elseif ($size == 6) {
		//9.999,99                                                                             
		$p1 = substr($valorReal, -2);
		$p2 = substr($valorReal, -5, 3);
		$p3 = substr($valorReal, -6, 1);
		$result = $p3 . "." . $p2 . "," . $p1;
		return $result;
	} elseif ($size == 5) {
		//999,99                                                                               
		$p1 = substr($valorReal, -2);
		$p2 = substr($valorReal, -5, 3);
		$result = $p2 . "," . $p1;
		return $result;
	} elseif ($size == 4) {
		//99,99                                                                                
		$p1 = substr($valorReal, -2);
		$p2 = substr($valorReal, -4, 2);
		$result = $p2 . "," . $p1;
		return $result;
	} elseif ($size == 3) {
		//9,99                                                                                 
		$p1 = substr($valorReal, -2);
		$p2 = substr($valorReal, -3, 1);
		$result = $p2 . "," . $p1;
		return $result;
	} elseif ($size == 2) {
		//0,99                                                                                 
		$p1 = substr($valorReal, -2);
		$result = "0," . $p1;
		return $result;
	}

	return false;
}                                                                                             
                                                                                               
function infoNoticia( $codnoticia)                                                             
{                                                                                              
	$noticias = mysql_query("SELECT * FROM noticias WHERE CODNOTICIA='$codnoticia'");          
	if(mysql_num_rows($noticias) != 0)                                                         
	{                                                                                          
		$noticia = mysql_fetch_object($noticias);                                              
	}	                                                                                       
                                                                                               
	                                                                                           
	$categoria = mysql_query("SELECT * FROM `categoria_noticia` WHERE `CODCATEGORIANOTICIA`='$noticia->CODCATEGORIANOTICIA'");
	$categoria = mysql_fetch_object($categoria);                                               
			                                                                                   
	$itemNoticia .="<div style='margin-top: 3px; padding-left: 10px; padding-bottom: 10px;'>"; 
		$itemNoticia .= "<div style='color: #1a63a8; font-size: 18.0pt; text-align: left;'>$noticia->TITULO</div>";
		$itemNoticia .= "<div style='color: #000; font-size: 13.0pt; text-align: left;'><i>$noticia->DTA...</i></div>";
		$itemNoticia .= "<div style='color: #000; font-size: 13.0pt; text-align: left;'><i>$categoria->TITULO</i></div>";
		if( $noticia->DESCRICAO != "")                                                         
		{                                                                                      
			$itemNoticia .= "<div style='font-size: 15.0pt; margin-bottom: 9px; text-align: left;'><i>$noticia->DESCRICAO...</i></div>";
		}                                                                                      
	$itemNoticia .="</div>";                                                                   
	$itemNoticia .= "<div><br/></div>";                                                        
	return $itemNoticia;                                                                       
                                                                                               
}                                                                                              
                                                                                               
function  getNavegacao( $html, $title )                                                        
{                                                                                              
	$mlt = "<div class='menu-body'>";                                                                          
		$mlt .= "<ul class='menu-ul'>";                                                                 
                  $mlt .= "<li class='menu-item'>";
				$mlt .= getNavPrincipal ();
			$mlt .= "</li>";                                                                    
		$mlt .= "</ul>";                                                                       
	$mlt .= "</div>";                                                                        
	                                                                                           
	return $mlt;                                                                               
}                                                                                              
                                                                                               
function getH3title ( $titulo )                                                                
{                                                                                              
	
	if($_GET['actionType'] != "bem.vindo" )
	{
		$h3 = "<div class='Ultituloback'>";                                                         
			$h3 = "<div class='Litituloback'>";                                                     
				$h3 .= "<div class='Maintitle'>$titulo</div>";                                                       
				$h3 .= "<div class='Maintitle Btnback' style='cursor: pointer;' onclick=\"javascript:history.go(-1);\"><img src='../image/ico_back.png' alt='' border='' width='30px'/></div>";                 
			$h3 .= "</div>";
			$h3 .= "<div class='ResetFloat'></div>";		
		$h3 .= "</div>";                                                                            
		return $h3;                                                                                
	}
}                                                                                              
                                                                                               
function dadosConta()                                                                          
{	                                                                                           
	$dados = mysql_query("SELECT pessoa.NOME, login.LOGIN, pessoa.CPF FROM login INNER JOIN login_rel_pessoa ON login_rel_pessoa.CODLOGIN=login.CODLOGIN INNER JOIN pessoa ON login_rel_pessoa.CODPESSOA=pessoa.CODPESSOA WHERE pessoa.CODPESSOA='$_GET[codpessoa]' GROUP BY login.CODLOGIN");
	$dados = mysql_fetch_object($dados);                                                       
	                                                                                           
	$conta  = "<div class='Separador'></div>";                                                 
	$conta .= "<div>";                                                                         
		$conta .= "<ul class='SbNav'>";                                                        
			$conta .= "<li class='Exb'><h3><img src='../image/dadosdaconta.png' border='0' alt=''/></h3></li>";
			$conta .= "<li class='Exb'><b>Nome:</b></li>";                                     
			$conta .= "<li class='Exb'>$dados->NOME</li>";                                     
			$conta .= "<li class='Exb'><b>Login</b>:</li>";                                    
			$conta .= "<li class='Exb'>$dados->LOGIN</li>";                                    
			$conta .= "<li class='Exb'><b>CPF:</b></li>";                                      
			$conta .= "<li class='Exb'>";                                                      
				if( $dados->CPF != "") {$conta .= formataCpf($dados->CPF);}                    
			$conta .="</li>";                                                                  
			$conta .= "<li><br/></li>";                                                        
			                                                                                   
			$conta .= "<li class='Exb'><a href='index.php?actionType=gerenciar.cadastros.atualizar&codpessoa=$_GET[codpessoa]'>Atualizar cadastro ?</a> ";
			if( $_GET[actionType] != "gerenciar.empresa")                                      
			{                                                                                  
				$conta .= "| <a href='index.php?actionType=gerenciar.empresa&codpessoa=$_GET[codpessoa]'>Ir para Empresas ?</a></li>";	
			}                                                                                  
		$conta .= "</ul>";                                                                     
	$conta .= "</div>";                                                                        
	$conta .= "<div class='Separador'></div>";                                                 
	                                                                                           
	return $conta;                                                                             
}                                                                                              
                                                                                               
function dadosConta2()                                                                         
{	                                                                                           
	$existe_avatar = mysql_query("SELECT avatares.AVATAR, login_rel_pessoa.CODLOGIN FROM avatares INNER JOIN login_rel_pessoa ON login_rel_pessoa.CODLOGIN=avatares.CODLOGIN WHERE login_rel_pessoa.CODPESSOA='$_GET[codpessoa]'");
	                                                                                           
	if( mysql_num_rows($existe_avatar) == 0 )                                                  
	{                                                                                          
		$existe_avatar = mysql_fetch_object( $existe_avatar );                                 
		mysql_query("INSERT INTO avatares (CODLOGIN, AVATAR) VALUES ('$existe_avatar->CODLOGIN', '../image/default.gif')");
		$avatar = "../image/default.gif";                                                      
	}                                                                                          
	else                                                                                       
	{                                                                                          
		$existe_avatar = mysql_fetch_object( $existe_avatar );                                 
		$avatar = $existe_avatar->AVATAR;                                                      
	}                                                                                          
	                                                                                           
	$dados = mysql_query("SELECT pessoa.NOME, login.LOGIN, pessoa.CPF FROM login INNER JOIN login_rel_pessoa ON login.CODLOGIN=login_rel_pessoa.CODLOGIN INNER JOIN pessoa ON login_rel_pessoa.CODPESSOA=pessoa.CODPESSOA WHERE pessoa.CODPESSOA='$_GET[codpessoa]' GROUP BY pessoa.CODPESSOA");
	$dados = mysql_fetch_object($dados);                                                       
	                                                                                           
	$conta  = "<div class='Separador'></div>";                                                 
	                                                                                           
	$conta .= "<table>";                                                                       
		$conta .= "<tr>";                                                                      
			$conta .= "<td valign='TOP'>";                                                     
				$conta .= "<div>";                                                             
					$conta .= "<ul>";                                                          
						$conta .= "<li class='Exb'><h3><img src='../image/dadosdaconta.png' border='0' alt=''/></h3></li>";
						$conta .= "<li class='Exb'><b>Nome:</b></li>";                         
						$conta .= "<li class='Exb'>$dados->NOME</li>";                         
						$conta .= "<li class='Exb'><b>Login</b>:</li>";                        
						$conta .= "<li class='Exb'>$dados->LOGIN</li>";                        
						$conta .= "<li class='Exb'><b>CPF:</b></li>";                          
						$conta .= "<li class='Exb'>".formataCpf($dados->CPF)."</li>";          
						$conta .= "<li><br/></li>";                                            
					$conta .= "</ul>";                                                         
				$conta .= "</div>";                                                            
			$conta .= "</td>";                                                                 
			if($_SESSION[CODLOGIN] != $existe_avatar->CODLOGIN )                               
			{                                                                                  
				$conta .= "<td valign='center'>";                                              
					$conta .= "<div style='margin-left: 10px;'>";				               
						$conta .= "<img src='$avatar' alt='$dados->NOME' border='0' width='156px'/>";
					$conta .= "</div>";                                                        
				$conta .= "</td>";                                                             
			}                                                                                  
			                                                                                   
			                                                                                   
		$conta .= "</tr>";                                                                     
	$conta .= "</table>";                                                                      
	                                                                                           
	                                                                                           
	$conta .= "<div class='Separador'></div>";                                                 
	                                                                                           
	return $conta;                                                                             
}                                                                                              
                                                                                               
function dadosConta3($codpessoa)                                                               
{	                                                                                           
	$dados = mysql_query("SELECT pessoa.NOME, login.LOGIN, pessoa.CPF FROM login INNER JOIN pessoa ON login.CODLOGIN=pessoa.CODPESSOA WHERE login.CODLOGIN='$codpessoa' GROUP BY login.CODLOGIN");
	$dados = mysql_fetch_object($dados);                                                       
	                                                                                           
	$conta  = "<div class='Separador'></div>";                                                 
	$conta .= "<div>";                                                                         
		$conta .= "<ul class='SbNav'>";                                                        
			$conta .= "<li><h3><img src='../image/dadosdaconta.png' border='0' alt=''/></h3></li>";
			$conta .= "<li><b>Nome:</b></li>";                                                 
			$conta .= "<li>$dados->NOME</li>";                                                 
			$conta .= "<li><b>Login</b>:</li>";                                                
			$conta .= "<li>$dados->LOGIN</li>";                                                
			$conta .= "<li><b>CPF:</b></li>";                                                  
			$conta .= "<li>".formataCpf($dados->CPF)."</li>";                                  
			$conta .= "<li><br/></li>";                                                        
		$conta .= "</ul>";                                                                     
	$conta .= "</div>";                                                                        
	$conta .= "<div class='Separador'></div>";                                                 
	                                                                                           
	return $conta;                                                                             
}                                                                                              
                                                                                               
/*                                                                                             
 * Acrescenta a pontuacao correta em um numero de cpf                                          
 */                                                                                            
function formataCnpj($cnpj)                                                                    
{                                                                                              
	$p1 = substr($cnpj, -2);                                                                   
	$p2 = substr($cnpj, -6, 4);                                                                
	$p3 = substr($cnpj, -9, 3);                                                                
	$p4 = substr($cnpj, -12, 3);                                                               
	$p5 = substr($cnpj, -14, 2);                                                               
	$result = "$p5.$p4.$p3/$p2-$p1";                                                           
	return $result;                                                                            
}                                                                                              
                                                                                               
                                                                                               
function getFooter()                                                                           
{                                                                                              
                                                                                               
$html = "<div style='margin-right: auto; margin-left: auto; width: 960px; background: #333; height: 35px; font-size: 10.5pt; color: #fff; border-top-left-radius: 10px; border-top-right-radius: 10px;'>";
	$html .= "<div style='margin-left: 30px; padding-top: 10px; font-weight: bold;'>Mapa do Site</div>";
$html .= "</div>";                                                                             
                                                                                               
//$html .= "<div id='footer' style='margin-right: auto; margin-left: auto; font-size: 10.5pt;'>";
$html .= "<div style='margin-right: auto; margin-left: auto; font-size: 10.5pt;'>";            
		                                                                                       
	$html .= "<div style='margin-right: auto; margin-left: auto; width: 960px; color: #000; padding-top: 20px; font-size: 10.5pt;'>";
		$html .="<table style='width: 95%; margin-left: auto; margin-right: auto;'>";          
			$html .="<tr>";                                                                    
			                                                                                   
				$html .="<td valign='top' style='width: 25%;  padding-right: 10px'>";          
				                                                                               
					$html .="<div class='CabecaNoticiaFooter' style='background: transparent'>ServiÁos</div>";
					$html .="<div class='CabecaNoticia2Footer'>";                              
						                                                                       
						$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.open('http://webmail.nossagoiania.com.br/','_blank')\"><b class='Seta'>õ</b>Webmail</div></li>";
						                                                                       
						if( $_GET[actionType] == 'servicos' )                                  
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>¡rea Restrita</div></li>";
						}                                                                      
						else                                                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=servicos'\"><b class='Seta'>õ</b>¡rea Restrita</div></li>";
						}                                                                      
							                                                                   
						if( $_GET[actionType] == 'faleconosco' )                               
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>Fale conosco</div></li>";
						}                                                                      
						else                                                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=faleconosco'\"><b class='Seta'>õ</b>Fale conosco</div></li>";
						}		                                                               
						                                                                       
						if( $_GET[actionType] == 'central.duvidas2' )                          
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>FAQ</div></li>";
						}                                                                      
						else                                                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=central.duvidas2'\"><b class='Seta'>õ</b>FAQ</div></li>";
						}		                                                               
						                                                                       
						if( $_GET[actionType] == 'trabalhe.conosco' )                          
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>Trabalhe conosco</div></li>";
						}                                                                      
						else                                                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=trabalhe.conosco'\"><b class='Seta'>õ</b>Trabalhe conosco</div></li>";
						}		                                                               
						                                                                       
						if( $_GET[actionType] == 'transparencia' )                             
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>Informativos</div></li>";
						}                                                                      
						else                                                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=transparencia'\"><b class='Seta'>õ</b>Informativos</div></li>";
						}		                                                               
						                                                                       
						if( $_GET[actionType] == 'galerias' )                                  
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>Galerias FAP</div></li>";
						}                                                                      
						else                                                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=galerias'\"><b class='Seta'>õ</b>Galerias FAP</div></li>";
						}		                                                               
						                                                                       
						if( $_GET[actionType] == 'links' )                                     
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>Links ⁄teis</div></li>";
						}                                                                      
						else                                                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=links'\"><b class='Seta'>õ</b>Links ⁄teis</div></li>";
						}		                                                               
						                                                                       
						if( $_GET[actionType] == 'videos' )                                    
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>VÌdeos</div></li>";
						}                                                                      
						else                                                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=videos'\"><b class='Seta'>õ</b>VÌdeos</div></li>";
						}                                                                      
						                                                                       
						if( $_GET[actionType] == 'enquete' )                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>Enquetes</div></li>";
						}                                                                      
						else                                                                   
						{                                                                      
							$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=enquete'\"><b class='Seta'>õ</b>Enquetes</div></li>";
						}		                                                               
						                                                                       
					$html .="</div>";                                                          
					                                                                           
					$html .="<div><br/></div>";                                                
					                                                                           
					$html .="<div class='CabecaNoticiaFooter' style='background: transparent'>Judici·rio</div>";
					$html .="<div class='CabecaNoticia2Footer'>";                              
					                                                                           
						$hs = mysql_query("SELECT * FROM categoria_noticia WHERE FORMATACAO IN('04') AND STATUS=1 ORDER BY FORMATACAO,TITULO ASC");
						                                                                       
							                                                                   
						if( mysql_num_rows($hs) !=0 )                                          
						{                                                                      
							while($h = mysql_fetch_object($hs))                                
							{                                                                  
								if($h->CODCATEGORIANOTICIA == $_GET[codcategorianoticia] )     
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
								else                                                           
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=noticias&codcategorianoticia=$h->CODCATEGORIANOTICIA'\"><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
							}                                                                  
						}				                                                       
						                                                                       
					$html .="</div>";                                                          
					                                                                           
				$html .="</td>";                                                               
				                                                                               
				                                                                               
				$html .="<td valign='top' style='width: 25%; padding-right: 10px'>";           
				                                                                               
					$html .="<div class='CabecaNoticiaFooter' style='background: transparent'>Principal</div>";
					$html .="<div class='CabecaNoticia2Footer'>";                              
					                                                                           
						$hs = mysql_query("SELECT * FROM categoria_noticia WHERE FORMATACAO='01' AND STATUS=1 ORDER BY ORDEM ASC");
						                                                                       
							                                                                   
						if( mysql_num_rows($hs) !=0 )                                          
						{                                                                      
							while($h = mysql_fetch_object($hs))                                
							{                                                                  
								if($h->CODCATEGORIANOTICIA == $_GET[codcategorianoticia] )     
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
								else                                                           
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=noticias&codcategorianoticia=$h->CODCATEGORIANOTICIA'\"><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
							}                                                                  
						}				                                                       
						                                                                       
					$html .="</div>";                                                          
					                                                                           
					$html .="<div><br/></div>";                                                
					                                                                           
					$html .="<div class='CabecaNoticiaFooter' style='background: transparent'>Comunidade</div>";
					$html .="<div class='CabecaNoticia2Footer'>";                              
					                                                                           
						$hs = mysql_query("SELECT * FROM categoria_noticia WHERE FORMATACAO IN('02') AND STATUS=1 ORDER BY FORMATACAO,TITULO ASC");
						                                                                       
							                                                                   
						if( mysql_num_rows($hs) !=0 )                                          
						{                                                                      
							while($h = mysql_fetch_object($hs))                                
							{                                                                  
								if($h->CODCATEGORIANOTICIA == $_GET[codcategorianoticia] )     
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
								else                                                           
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=noticias&codcategorianoticia=$h->CODCATEGORIANOTICIA'\"><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
							}                                                                  
						}				                                                       
						                                                                       
					$html .="</div>";                                                          
					                                                                           
				$html .="</td>";                                                               
				                                                                               
				$html .="<td valign='top' style='width: 25%; padding-right: 10px'>";           
				                                                                               
					                                                                           
					                                                                           
					                                                                           
					$html .="<div class='CabecaNoticiaFooter' style='background: transparent'>Prefeitura</div>";
					$html .="<div class='CabecaNoticia2Footer'>";                              
					                                                                           
						$hs = mysql_query("SELECT * FROM categoria_noticia WHERE FORMATACAO IN('03') AND STATUS=1 ORDER BY FORMATACAO,TITULO ASC");
						                                                                       
							                                                                   
						if( mysql_num_rows($hs) !=0 )                                          
						{                                                                      
							while($h = mysql_fetch_object($hs))                                
							{                                                                  
								if($h->CODCATEGORIANOTICIA == $_GET[codcategorianoticia] )     
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
								else                                                           
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=noticias&codcategorianoticia=$h->CODCATEGORIANOTICIA'\"><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
							}                                                                  
						}				                                                       
						                                                                       
					$html .="</div>";                                                          
					                                                                           
					$html .= "<div><br/></div>";                                               
					                                                                           
					$html .="<div class='CabecaNoticiaFooter' style='background: transparent'>C‚mara Municipal</div>";
					$html .="<div class='CabecaNoticia2Footer'>";                              
					                                                                           
						$hs = mysql_query("SELECT * FROM categoria_noticia WHERE FORMATACAO IN('05') AND STATUS=1 ORDER BY FORMATACAO,TITULO ASC");
						                                                                       
							                                                                   
						if( mysql_num_rows($hs) !=0 )                                          
						{                                                                      
							while($h = mysql_fetch_object($hs))                                
							{                                                                  
								if($h->CODCATEGORIANOTICIA == $_GET[codcategorianoticia] )     
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
								else                                                           
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=noticias&codcategorianoticia=$h->CODCATEGORIANOTICIA'\"><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
							}                                                                  
						}				                                                       
						                                                                       
					$html .= "</div>";                                                         
					                                                                           
				$html .="</td>";                                                               
				                                                                               
				$html .="<td valign='top' style='width: 25%; padding-right: 10px'>";           
				                                                                               
					$html .="<div class='CabecaNoticiaFooter' style='background: transparent'>Nossa Goi‚nia</div>";
					$html .="<div class='CabecaNoticia2Footer'>";                              
					                                                                           
						$hs = mysql_query("SELECT * FROM categoria_noticia WHERE FORMATACAO IN('06') AND STATUS=1 ORDER BY FORMATACAO,TITULO ASC");
						                                                                       
							                                                                   
						if( mysql_num_rows($hs) !=0 )                                          
						{                                                                      
							while($h = mysql_fetch_object($hs))                                
							{                                                                  
								if($h->CODCATEGORIANOTICIA == $_GET[codcategorianoticia] )     
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
								else                                                           
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=noticias&codcategorianoticia=$h->CODCATEGORIANOTICIA'\"><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
							}                                                                  
						}				                                                       
						                                                                       
					$html .="</div>";                                                          
					                                                                           
					$html .="<div class='CabecaNoticiaFooter' style='background: transparent'>Utilidade P˙blica</div>";
					$html .="<div class='CabecaNoticia2Footer'>";                              
					                                                                           
						$hs = mysql_query("SELECT * FROM categoria_agenda2 WHERE STATUS=1 ORDER BY ORDEM ASC");
						                                                                       
							                                                                   
						if( mysql_num_rows($hs) !=0 )                                          
						{                                                                      
							while($h = mysql_fetch_object($hs))                                
							{                                                                  
								if($h->CODCATEGORIAAGENDA == $_GET[codcategoriaagenda] )       
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: text; color: #000066; font-weight: bold;'><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
								else                                                           
								{                                                              
									$html .="<div class='Itemmenu' style='cursor: pointer;' onclick=\"javascript:window.location='index.php?actionType=utilidade.publica&codcategoriaagenda=$h->CODCATEGORIAAGENDA'\"><b class='Seta'>õ</b>$h->TITULO</div></li>";
								}                                                              
							}                                                                  
						}				                                                       
						                                                                       
					$html .="</div>";                                                          
					                                                                           
				$html .="</td>";                                                               
				                                                                               
			$html .="</tr>";                                                                   
			                                                                                   
		$html .="</table>";                                                                    
		                                                                                       
		                                                                                       
		$rodape = mysql_query("SELECT * FROM rodape");                                         
		                                                                                       
		if(mysql_num_rows($rodape) != 0)                                                       
		{                                                                                      
			$rodape = mysql_fetch_object($rodape);                                             
		}                                                                                      
		$html .= "<div style='text-align: center;'>$rodape->LINHA1<br/></div>";                
		$html .= "<div style='text-align: center;'>$rodape->LINHA2<br/></div>";		           
		                                                                                       
		$html .= "<br/><br/>";			                                                       
		$html .= "<div align='center'><div id='IDW' style='font-size: 7.0pt'><a href='http://www.idesignerweb.com' target='_blank'>.::. IDESIGNERWEB - SoluÁıes para Web .::.</a></div>";	
		$html .= "<br/>";			                                                           
	                                                                                           
	$html .= "</div>";                                                                         
	                                                                                           
$html .="</div>";                                                                              
return $html;                                                                                  
                                                                                               
}                                                                                              
                                                                                               
function getMenuFooter($action)                                                                
{                                                                                              
	$html .= "<div class='NewMenu2' style='position: relative; bottom: 13px; font-size: 12.0pt; color: #000;'>";
		$html .= "<span style='cursor: pointer' onclick=\" window.location = 'index.php?actionType=pagina.inicial' \">P·gina inicial &nbsp;&nbsp;|&nbsp;&nbsp;</span>";
		$html .= "<span style='cursor: pointer' onclick=\" window.location = 'index.php?actionType=produtos'\">Lojas virtuais Gratuitas &nbsp;&nbsp;|&nbsp;&nbsp;</span>";
		$html .= "<span style='cursor: pointer' onclick=\" window.location = 'index.php?actionType=faleconosco'\">Fale conosco &nbsp;&nbsp;|&nbsp;&nbsp;</span>";
		$html .= "<span style='cursor: pointer' onclick=\" window.location = 'index.php?actionType=servicos&cod=2'\">Cadastre-se</span>";
	$html .= "</div>";                                                                         
	                                                                                           
	return $html;                                                                              
}                                                                                              
                                                                                               
function getMenuFooter2($action)                                                               
{                                                                                              
	$html .= "<div class='NewMenu2' style='position: relative; bottom: 13px; font-size: 12.0pt; color: #000;'>";
		$html .= "<span style='cursor: pointer' onclick=\" window.location = '../index.php?actionType=pagina.inicial' \">P·gina inicial &nbsp;&nbsp;|&nbsp;&nbsp;</span>";
		$html .= "<span style='cursor: pointer' onclick=\" window.location = '../index.php?actionType=produtos'\">Lojas virtuais Gratuitas &nbsp;&nbsp;|&nbsp;&nbsp;</span>";
		$html .= "<span style='cursor: pointer' onclick=\" window.location = '../index.php?actionType=faleconosco'\">Fale conosco &nbsp;&nbsp;|&nbsp;&nbsp;</span>";
		$html .= "<span style='cursor: pointer' onclick=\" window.location = '../index.php?actionType=servicos&cod=2'\">Cadastre-se</span>";
	$html .= "</div>";                                                                         
	                                                                                           
	return $html;                                                                              
}                                                                                              
                                                                                               
function getDtaContrato($data)                                                                 
{                                                                                              
	$data = explode(" ", $data);                                                               
	$data = explode("-", $data[0]);                                                            
	                                                                                           
	$a = $data[0];                                                                             
	$m = $data[1];                                                                             
	$d = $data[2];                                                                             
                                                                                               
	switch($m)                                                                                 
	{                                                                                          
		case "01":                                                                             
			$m = "JANEIRO";                                                                    
		break;                                                                                 
		case "02":                                                                             
			$m = "FEVEREIRO";                                                                  
		break;                                                                                 
		case "03":                                                                             
			$m = "MAR«O";                                                                      
		break;                                                                                 
		case "04":                                                                             
			$m = "ABRIL";                                                                      
		break;                                                                                 
		case "05":                                                                             
			$m = "MAIO";                                                                       
		break;                                                                                 
		case "06":                                                                             
			$m = "JUNHO";                                                                      
		break;                                                                                 
		case "07":                                                                             
			$m = "JULHO";                                                                      
		break;                                                                                 
		case "08":                                                                             
			$m = "AGOSTO";                                                                     
		break;                                                                                 
		case "09":                                                                             
			$m = "SETEMBRO";                                                                   
		break;                                                                                 
		case "10":                                                                             
			$m = "OUTUBRO";                                                                    
		break;                                                                                 
		case "11":                                                                             
			$m = "NOVEMBRO";                                                                   
		break;                                                                                 
		case "12":                                                                             
			$m = "DEZEMBRO";                                                                   
		break;                                                                                 
	}                                                                                          
		                                                                                       
	return "GAMA/DF, $d DE $m DE $a";                                                          
}                                                                                              
                                                                                               
function getCodpessoa()                                                                        
{                                                                                              
	$codpessoa = mysql_query("SELECT * FROM login_rel_pessoa WHERE CODLOGIN='$_SESSION[CODLOGIN]'");	
	if(mysql_num_rows($codpessoa) != 0 )                                                       
	{                                                                                          
		$codpessoa = mysql_fetch_object($codpessoa);                                           
		return $codpessoa->CODPESSOA;                                                          
	}                                                                                          
}                                                                                              
                                                                                               
function getSubmitEnviar()                                                                     
{                                                                                              
	                                                                                           
	//return "<input type='image' name='submit' src='../image/novas/ENVIAR.png' alt='Bot„o Enviar'/>";
	return "<input type='submit' value='Enviar' style='background-color: silver; border: 1px solid #BCC6D0; border-radius: 3px 3px 3px 3px; padding: 5px;'/>";
                                                                                               
}                                                                                              
                                                                                               
function getSubmitEnviar2()                                                                    
{                                                                                              
	return "<input type='submit' value='Entrar' style='background-color: #3E831E; width: 50px; border: 0; padding: 1px; color: #fff;'/>";
}                                                                                              
                                                                                               
function maisRapido()                                                                          
{                                                                                              
	$mr ="<div class='RadiosNoticia'>";                                                        
		//$mr .= "<div style='color: #5B9028; font-size: 20.0pt; text-align: left; border-left: 6px solid #FF7800; padding-left: 10px;cursor: pointer;' onclick=\"javascript: location='index.php?actionType=noticias'\">+ NOTÕCIAS</div>";
		$mr .= toposecao("+ NotÌcias");                                                        
		                                                                                       
		$linha1 = mysql_query("SELECT * FROM categoria_noticia WHERE STATUS=1 AND FORMATACAO IN('01') ORDER BY TITULO ASC");
		                                                                                       
		if(mysql_num_rows($linha1) != 0)                                                       
		{                                                                                      
			while($li = mysql_fetch_object($linha1))                                           
			{                                                                                  
				if($_GET[codcategorianoticia] == $li->CODCATEGORIANOTICIA && $_GET[actionType] == "noticias")
				{                                                                              
					$mr .= "<div id='__$li->CODCATEGORIANOTICIA' style='cursor: pointer;' class='OverViewAcesso' onclick=\"espandemaisOpen('#$li->CODCATEGORIANOTICIA','$li->CODCATEGORIANOTICIA')\">";
						$mr .= "<div>";                                                        
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
					$mr .= "<div id='$li->CODCATEGORIANOTICIA' style='display: block;'>";      
						                                                                       
						if( $_GET[codcolunista] != "" )                                        
						{                                                                      
							$colunista = mysql_query("SELECT avatares.AVATAR, pessoa.NOME, pessoa.CODPESSOA FROM pessoa 
							INNER JOIN login_rel_pessoa ON login_rel_pessoa.CODPESSOA=pessoa.CODPESSOA
							INNER JOIN login ON login.CODLOGIN=login_rel_pessoa.CODLOGIN       
							INNER JOIN avatares ON login.CODLOGIN=avatares.CODLOGIN            
							WHERE pessoa.CODPESSOA='$_GET[codcolunista]'");                    
							                                                                   
							if(mysql_num_rows($colunista) != 0)                                
							{                                                                  
								$colunista = mysql_fetch_object($colunista);                   
								$codcolunista = " AND noticias.OWNER='$colunista->NOME' ";     
							}                                                                  
							                                                                   
							$query = mysql_query("SELECT `CODNOTICIA`, `CODCATEGORIANOTICIA`, `TITULO`, `DESCRICAO`, 
							DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA, `OWNER`, `FOTO`, `NOTICIA` FROM noticias 
							WHERE `STATUS`='1' AND `CODNOTICIA`!='$_GET[codnoticia]' AND CODCATEGORIANOTICIA='$li->CODCATEGORIANOTICIA' $codcolunista ORDER BY (DESTAQUE+0),(PESO+0), DTA DESC LIMIT 0,3");	
						}                                                                      
						else                                                                   
						{                                                                      
							$query = mysql_query("SELECT `CODNOTICIA`, `CODCATEGORIANOTICIA`, `TITULO`, `DESCRICAO`, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA, `OWNER`, `FOTO`, `NOTICIA` FROM noticias WHERE `STATUS`='1' AND `CODNOTICIA`!='$_GET[codnoticia]' AND CODCATEGORIANOTICIA='$li->CODCATEGORIANOTICIA' ORDER BY (DESTAQUE+0),(PESO+0), DTA DESC LIMIT 0,3");
						}                                                                      
						                                                                       
						                                                                       
						if(mysql_num_rows($query) != 0)                                        
						{                                                                      
							while( $noticia = mysql_fetch_object($query) )                     
							{                                                                  
								$mr .="<div class='RadiosNoticia' style='margin-top: 3px; padding: 5px; width: 231px; height: 131px; margin-right: 10px;'>";
									$mr .="<table>";                                           
										$mr .="<tr>";                                          
											$mr .="<td valign='top'>";                         
												$mr .= "<div style='color: #1a63a8; font-size: 15px; width: 100px;'><img src='$noticia->FOTO' border='0' alt='' width='100px;' height='80px;' style='border-radius: 5px 5px 5px 5px;'/></div>";
												$mr .= "<div/><br/></div>";	                   
												if($_GET[codcolunista] != "")                  
												{                                              
													$getcodcolunista = "&codcolunista=$_GET[codcolunista]";
													$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=colunistas$getcodcolunista&codnoticia=$noticia->CODNOTICIA&codcategorianoticia=$noticia->CODCATEGORIANOTICIA'\"><img src='../image/novas/bt_leiamais.gif' alt='Leia Mais' border='0'/></div>";	
												}                                              
												else                                           
												{                                              
													$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=noticias&codnoticia=$noticia->CODNOTICIA&codcategorianoticia=$noticia->CODCATEGORIANOTICIA'\"><img src='../image/novas/bt_leiamais.gif' alt='Leia Mais' border='0'/></div>";	
												}                                              
											$mr .="</td>";                                     
											$mr .="<td  valign='top'>";                        
												$string = $noticia->TITULO;                    
												$string = substr($string, 0, 40);              
												$mr .= "<div style='color: #000; font-size: 9.0pt;margin-bottom: 9px; text-align: left;'><i>$noticia->DTA...</i></div>";
												$mr .= "<div style='color: #1a63a8; font-size: 15px; text-align: left;'>$string ...</div>";
											$mr .="</td>";                                     
										$mr .="</tr>";                                         
									$mr .="</table>";								           
								$mr .="</div>";                                                
							}                                                                  
						}                                                                      
					$mr .= "</div>";                                                           
				}                                                                              
				elseif( $_GET[codcategorianoticia] == $li->CODCATEGORIANOTICIA && $_GET[actionType] == "noticias")
				{                                                                              
					$mr .= "<div class='OverViewAcesso' style='background: #5B9028;'>";        
						$mr .= "<div>";                                                        
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
				}                                                                              
				else                                                                           
				{                                                                              
					$mr .= "<div id='__$li->CODCATEGORIANOTICIA' style='cursor: pointer;' class='OverViewList OverView' onclick=\"espandemaisOpen('#$li->CODCATEGORIANOTICIA','$li->CODCATEGORIANOTICIA')\">";
						$mr .= "<div>";                                                        
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
					$mr .= "<div id='$li->CODCATEGORIANOTICIA' style='display: none;'>";       
						                                                                       
						if( $_GET[codcolunista] != "" )                                        
						{                                                                      
							$colunista = mysql_query("SELECT avatares.AVATAR, pessoa.NOME, pessoa.CODPESSOA FROM pessoa 
							INNER JOIN login_rel_pessoa ON login_rel_pessoa.CODPESSOA=pessoa.CODPESSOA
							INNER JOIN login ON login.CODLOGIN=login_rel_pessoa.CODLOGIN       
							INNER JOIN avatares ON login.CODLOGIN=avatares.CODLOGIN            
							WHERE pessoa.CODPESSOA='$_GET[codcolunista]'");                    
							                                                                   
							if(mysql_num_rows($colunista) != 0)                                
							{                                                                  
								$colunista = mysql_fetch_object($colunista);                   
								$codcolunista = " AND noticias.OWNER='$colunista->NOME' ";     
							}                                                                  
							                                                                   
							$query = mysql_query("SELECT `CODNOTICIA`, `CODCATEGORIANOTICIA`, `TITULO`, `DESCRICAO`, 
							DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA, `OWNER`, `FOTO`, `NOTICIA` FROM noticias 
							WHERE `STATUS`='1' AND `CODNOTICIA`!='$_GET[codnoticia]' AND CODCATEGORIANOTICIA='$li->CODCATEGORIANOTICIA' $codcolunista ORDER BY (DESTAQUE+0),(PESO+0), DTA DESC LIMIT 0,3");	
						}                                                                      
						else                                                                   
						{                                                                      
							$query = mysql_query("SELECT `CODNOTICIA`, `CODCATEGORIANOTICIA`, `TITULO`, `DESCRICAO`, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA, `OWNER`, `FOTO`, `NOTICIA` FROM noticias WHERE `STATUS`='1' AND `CODNOTICIA`!='$_GET[codnoticia]' AND CODCATEGORIANOTICIA='$li->CODCATEGORIANOTICIA' ORDER BY (DESTAQUE+0),(PESO+0), DTA DESC LIMIT 0,3");
						}                                                                      
						                                                                       
						if(mysql_num_rows($query) != 0)                                        
						{                                                                      
							while( $noticia = mysql_fetch_object($query) )                     
							{                                                                  
								$mr .="<div class='RadiosNoticia' style='margin-top: 3px; padding: 5px; width: 231px; height: 131px; margin-right: 10px;'>";
									$mr .="<table>";                                           
										$mr .="<tr>";                                          
											$mr .="<td valign='top'>";                         
												$mr .= "<div style='color: #1a63a8; font-size: 15px; width: 100px;'><img src='$noticia->FOTO' border='0' alt='' width='100px;' height='80px;' style='border-radius: 5px 5px 5px 5px;'/></div>";
												$mr .= "<div/><br/></div>";	                   
												if($_GET[codcolunista] != "")                  
												{                                              
													$getcodcolunista = "&codcolunista=$_GET[codcolunista]";
													$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=colunistas$getcodcolunista&codnoticia=$noticia->CODNOTICIA&codcategorianoticia=$noticia->CODCATEGORIANOTICIA'\"><img src='../image/novas/bt_leiamais.gif' alt='Leia Mais' border='0'/></div>";	
												}                                              
												else                                           
												{                                              
													$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=noticias&codnoticia=$noticia->CODNOTICIA&codcategorianoticia=$noticia->CODCATEGORIANOTICIA'\"><img src='../image/novas/bt_leiamais.gif' alt='Leia Mais' border='0'/></div>";	
												}                                              
											$mr .="</td>";                                     
											$mr .="<td  valign='top'>";                        
												$string = $noticia->TITULO;                    
												$string = substr($string, 0, 40);              
												$mr .= "<div style='color: #000; font-size: 9.0pt;margin-bottom: 9px; text-align: left;'><i>$noticia->DTA...</i></div>";
												$mr .= "<div style='color: #1a63a8; font-size: 15px; text-align: left;'>$string ...</div>";
											$mr .="</td>";                                     
										$mr .="</tr>";                                         
									$mr .="</table>";								           
								$mr .="</div>";                                                
							}                                                                  
						}                                                                      
					$mr .= "</div>";                                                           
				}                                                                              
			}                                                                                  
		}                                                                                      
	$mr .="</div>";                                                                            
	return $mr;                                                                                
}                                                                                              
                                                                                               
function maisRapidoVideos()                                                                    
{                                                                                              
	$mr ="<div class='RadiosNoticia'>";                                                        
		//$mr .= "<div style='color: #FF7800; font-size: 20.0pt; text-align: left; border-left: 6px solid #5B9028; padding-left: 10px; cursor: pointer;' onclick=\"javascript: location='index.php?actionType=videos'\">+ VIDEOS</div>";
		$mr .= toposecao("+ VÌdeos");                                                          
		$linha1 = mysql_query("SELECT * FROM categoria_noticia WHERE STATUS=1 AND FORMATACAO NOT IN('03','04','05','06','07') ORDER BY TITULO ASC");
		if(mysql_num_rows($linha1) != 0)                                                       
		{                                                                                      
			while($li = mysql_fetch_object($linha1))                                           
			{                                                                                  
				if($_GET[codcategorianoticia] == $li->CODCATEGORIANOTICIA  && $_GET[actionType] == "videos")
				{                                                                              
					$mr .= "<div id='___$li->CODCATEGORIANOTICIA' style='cursor: pointer;' class='OverViewAcesso2' onclick=\"espandemaisOpenVideo('#_$li->CODCATEGORIANOTICIA','_$li->CODCATEGORIANOTICIA')\">";
						$mr .= "<div>";                                                        
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
					$mr .= "<div id='_$li->CODCATEGORIANOTICIA' style='display: block;'>";     
						                                                                       
						$query = mysql_query("SELECT `CODVIDEO`, `CODCATEGORIANOTICIA`, `TITULO`, `FRAME`, `NOTA`, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA FROM videos WHERE `STATUS`='1' AND `CODVIDEO`!='$_GET[codvideo]' AND CODCATEGORIANOTICIA='$li->CODCATEGORIANOTICIA' ORDER BY DTA DESC LIMIT 0,3");
						                                                                       
						if(mysql_num_rows($query) != 0)                                        
						{                                                                      
							while( $video = mysql_fetch_object($query) )                       
							{                                                                  
								$mr .="<div class='RadiosNoticia' style='margin-top: 3px; padding: 5px; width: 231px; height: 141px; margin-right: 10px;'>";
									$mr .="<table>";                                           
										$mr .="<tr>";                                          
											$mr .="<td valign='top'>";                         
												                                               
												$pedaco = explode("v=", $video->FRAME );		
												$mr .= "<div style='color: #000; font-size: 9.0pt;margin-bottom: 9px; text-align: left;'><i>$video->DTA...</i></div>";
												$mr .= "<div>";                                
													$mr .= "<iframe width='105' height='85' src='http://www.youtube.com/embed/$pedaco[1]' frameborder='0' allowfullscreen></iframe>";
													$mr .= "<div>".getStar($video->NOTA)."<div>";
												$mr .= "</div>";                               
												                                               
												$mr .= "<div/><br/></div>";	                   
											$mr .="</td>";                                     
											$mr .="<td  valign='top'>";                        
												$string = $video->TITULO;                      
												$string = substr($string, 0, 40);              
												$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=videos&codvideo=$video->CODVIDEO&codcategorianoticia=$video->CODCATEGORIANOTICIA'\"><img src='../image/novas/video.png' alt='Ver Video' border='0' width='50%'/></div>";	
												$mr .= "<div style='color: #1a63a8; font-size: 15px; text-align: left;'>$string ...</div>";
											$mr .="</td>";                                     
										$mr .="</tr>";                                         
									$mr .="</table>";                                          
																				               
								$mr .="</div>";                                                
							}                                                                  
						}                                                                      
					$mr .= "</div>";                                                           
				}                                                                              
				elseif( $_GET[codcategorianoticia] == $li->CODCATEGORIANOTICIA && $_GET[actionType] == "videos")
				{                                                                              
					$mr .= "<div class='OverViewAcesso' style='background: #5B9028;'>";        
						$mr .= "<div>";                                                        
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
				}                                                                              
				else                                                                           
				{                                                                              
					$mr .= "<div id='___$li->CODCATEGORIANOTICIA' style='cursor: pointer;' class='OverViewList OverView3' onclick=\"espandemaisOpenVideo('#_$li->CODCATEGORIANOTICIA','_$li->CODCATEGORIANOTICIA')\">";
						$mr .= "<div>";                                                        
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
					$mr .= "<div id='_$li->CODCATEGORIANOTICIA' style='display: none;'>";      
						                                                                       
						$query = mysql_query("SELECT `CODVIDEO`, `CODCATEGORIANOTICIA`, `TITULO`, `FRAME`, `NOTA`, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA FROM videos WHERE `STATUS`='1' AND `CODVIDEO`!='$_GET[codvideo]' AND CODCATEGORIANOTICIA='$li->CODCATEGORIANOTICIA' ORDER BY DTA DESC LIMIT 0,3");
						                                                                       
						if(mysql_num_rows($query) != 0)                                        
						{                                                                      
							while( $video = mysql_fetch_object($query) )                       
							{                                                                  
								$mr .="<div class='RadiosNoticia' style='margin-top: 3px; padding: 5px; width: 231px; height: 141px; margin-right: 10px;'>";
									$mr .="<table>";                                           
										$mr .="<tr>";                                          
											$mr .="<td valign='top'>";                         
												                                               
												$pedaco = explode("v=", $video->FRAME );		
												$mr .= "<div style='color: #000; font-size: 9.0pt;margin-bottom: 9px; text-align: left;'><i>$video->DTA...</i></div>";
												$mr .= "<div>";                                
													$mr .= "<iframe width='105' height='85' src='http://www.youtube.com/embed/$pedaco[1]' frameborder='0' allowfullscreen></iframe>";
													$mr .= "<div>".getStar($video->NOTA)."<div>";
												$mr .= "</div>";                               
												                                               
												$mr .= "<div/><br/></div>";	                   
											$mr .="</td>";                                     
											$mr .="<td  valign='top'>";                        
												$string = $video->TITULO;                      
												$string = substr($string, 0, 40);              
												$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=videos&codvideo=$video->CODVIDEO&codcategorianoticia=$video->CODCATEGORIANOTICIA'\"><img src='../image/novas/video.png' alt='Ver Video' border='0' width='50%'/></div>";	
												$mr .= "<div style='color: #1a63a8; font-size: 15px; text-align: left;'>$string ...</div>";
											$mr .="</td>";                                     
										$mr .="</tr>";                                         
									$mr .="</table>";                                          
									                                                           
								$mr .="</div>";                                                
							}                                                                  
						}                                                                      
					$mr .= "</div>";                                                           
				}                                                                              
			}                                                                                  
		}                                                                                      
	$mr .="</div>";                                                                            
	return $mr;                                                                                
}                                                                                              
                                                                                               
function getStar( $nota )                                                                      
{                                                                                              
	$str = "";                                                                                 
	if( (int) $nota == 5 )                                                                     
	{                                                                                          
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
	}                                                                                          
	elseif( (int) $nota == 4 )                                                                 
	{                                                                                          
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
	}                                                                                          
	elseif( (int) $nota == 3 )                                                                 
	{                                                                                          
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
	}                                                                                          
	elseif( (int) $nota == 2 )                                                                 
	{                                                                                          
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
	}                                                                                          
	elseif( (int) $nota == 1 )                                                                 
	{                                                                                          
		$str .= "<img src='../image/novas/CommentStarOn.gif' border='0' alt='Estrela'/>";      
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
	}                                                                                          
	elseif( (int) $nota == 0 )                                                                 
	{                                                                                          
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
		$str .= "<img src='../image/novas/CommentStarOff.gif' border='0' alt='Estrela'/>";     
	}                                                                                          
	return $str;                                                                               
}                                                                                              
                                                                                               
function maisRapidoAgenda()                                                                    
{                                                                                              
	$mr ="<div class='RadiosNoticia'>";                                                        
		//$mr .= "<div style='color: #008080; font-size: 20.0pt; text-align: left; border-left: 6px solid #5B9028; padding-left: 10px; cursor: pointer;' onclick=\"javascript: location='index.php?actionType=agenda'\">+ AGENDA CULTURAL</div>";
		$mr .= toposecao("+ Agenda Cultural");                                                 
		$linha1 = mysql_query("SELECT * FROM categoria_agenda WHERE STATUS=1 ORDER BY TITULO ASC");
		if(mysql_num_rows($linha1) != 0)                                                       
		{                                                                                      
			while($li = mysql_fetch_object($linha1))                                           
			{                                                                                  
				if($_GET[codcategoriaagenda] == $li->CODCATEGORIAAGENDA  && $_GET[actionType] == "agenda")
				{                                                                              
					$mr .= "<div id='___$li->CODCATEGORIAAGENDA' style='cursor: pointer;' class='OverViewAcesso' onclick=\"espandemaisOpen('#_$li->CODCATEGORIANOTICIA','_$li->CODCATEGORIANOTICIA')\">";
						$mr .= "<div style='text-align: left'>";                               
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
					$mr .= "<div id='_$li->CODCATEGORIAAGENDA' style='display: block;'>";      
						                                                                       
						$query = mysql_query("SELECT `CODAGENDA`, `CODCATEGORIAAGENDA`, `DESCRICAO`, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA FROM agenda WHERE `CODAGENDA`!='$_GET[codagenda]' AND CODCATEGORIAAGENDA='$li->CODCATEGORIAAGENDA' ORDER BY DTA DESC LIMIT 0,3");
						                                                                       
						if(mysql_num_rows($query) != 0)                                        
						{                                                                      
							while( $agenda = mysql_fetch_object($query) )                      
							{                                                                  
								$mr .="<div class='RadiosNoticia' style='margin-top: 3px; padding: 5px; width: 231px; height: 141px; margin-right: 10px;'>";
									$mr .="<table>";                                           
										$mr .="<tr>";                                          
											$mr .="<td valign='top'>";                         
												                                               
												$mr .= "<div style='color: #000; font-size: 9.0pt;margin-bottom: 9px; text-align: left;'><i>$agenda->DTA...</i></div>";
											//$mr .="</td>";                                   
											//$mr .="<td  valign='top'>";                      
												$string = $agenda->DESCRICAO;                  
												$string = substr($string, 0, 40);              
												$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=agenda&codagenda=$agenda->CODAGENDA&codcategoriaagenda=$agenda->CODCATEGORIAAGENDA'\"><img src='../image/novas/agendaico.jpg' alt='Ver Agenda' border='0' width='50%'/></div>";	
												$mr .= "<div style='color: #1a63a8; font-size: 15px; text-align: left;'>$string ...</div>";
											$mr .="</td>";                                     
										$mr .="</tr>";                                         
									$mr .="</table>";                                          
																				               
								$mr .="</div>";                                                
							}                                                                  
						}                                                                      
					$mr .= "</div>";                                                           
				}                                                                              
				elseif( $_GET[codcategoriaagenda] == $li->CODCATEGORIAAGENDA && $_GET[actionType] == "agenda")
				{                                                                              
					$mr .= "<div class='OverViewAcesso' style='background: #5B9028;'>";        
						$mr .= "<div style='text-align: left'>";                               
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
				}                                                                              
				else                                                                           
				{                                                                              
					$mr .= "<div id='___$li->CODCATEGORIAAGENDA' style='cursor: pointer;' class='OverViewList OverView' onclick=\"espandemaisOpen('#_$li->CODCATEGORIAAGENDA','_$li->CODCATEGORIAAGENDA')\">";
						$mr .= "<div style='text-align: left'>";                               
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
					$mr .= "<div id='_$li->CODCATEGORIAAGENDA' style='display: none;'>";       
						                                                                       
						$query = mysql_query("SELECT `CODAGENDA`, `CODCATEGORIAAGENDA`, `DESCRICAO`, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA FROM agenda WHERE `CODAGENDA`!='$_GET[codagenda]' AND CODCATEGORIAAGENDA='$li->CODCATEGORIAAGENDA' ORDER BY DTA DESC LIMIT 0,3");
						                                                                       
						if(mysql_num_rows($query) != 0)                                        
						{                                                                      
							while( $agenda = mysql_fetch_object($query) )                      
							{                                                                  
								$mr .="<div class='RadiosNoticia' style='margin-top: 3px; padding: 5px; width: 231px; height: 141px; margin-right: 10px;'>";
									$mr .="<table>";                                           
										$mr .="<tr>";                                          
											$mr .="<td valign='top'>";                         
												                                               
												$mr .= "<div style='color: #000; font-size: 9.0pt;margin-bottom: 9px; text-align: left;'><i>$agenda->DTA...</i></div>";
											//$mr .="</td>";                                   
											//$mr .="<td  valign='top'>";                      
												$string = $agenda->DESCRICAO;                  
												$string = substr($string, 0, 40);              
												$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=agenda&codagenda=$agenda->CODAGENDA&codcategoriaagenda=$agenda->CODCATEGORIAAGENDA'\"><img src='../image/novas/agendaico.jpg' alt='Ver Agenda' border='0' width='50%'/></div>";	
												$mr .= "<div style='color: #1a63a8; font-size: 15px; text-align: left;'>$string ...</div>";
											$mr .="</td>";                                     
										$mr .="</tr>";                                         
									$mr .="</table>";                                          
																				               
								$mr .="</div>";                                                
							}                                                                  
						}                                                                      
					$mr .= "</div>";                                                           
				}                                                                              
			}                                                                                  
		}                                                                                      
	$mr .="</div>";                                                                            
	return $mr;                                                                                
}                                                                                              
                                                                                               
                                                                                               
                                                                                               
function maisRapidoColunistas()                                                                
{                                                                                              
	$mr ="<div class='RadiosNoticia'>";                                                        
		//$mr .= "<div style='color: red; font-size: 20.0pt; text-align: left; border-left: 6px solid #5B9028; padding-left: 10px; cursor: pointer;' onclick=\"javascript: location='index.php?actionType=colunistas'\">+ COLUNISTAS</div>";
		$mr .= toposecao("+ Colunistas");                                                      
		                                                                                       
		//$linha1 = mysql_query("SELECT * FROM categoria_agenda WHERE STATUS=1 ORDER BY TITULO ASC");
		                                                                                       
		$colunistas = mysql_query("SELECT avatares.AVATAR, pessoa.NOME, pessoa.CODPESSOA FROM pessoa 
					INNER JOIN login_rel_pessoa ON login_rel_pessoa.CODPESSOA=pessoa.CODPESSOA 
					INNER JOIN login ON login.CODLOGIN=login_rel_pessoa.CODLOGIN               
					INNER JOIN avatares ON login.CODLOGIN=avatares.CODLOGIN                    
					WHERE login.PAPEL LIKE '%COLUNISTA%' AND login.STATUS=1");                 
		                                                                                       
		if(mysql_num_rows($colunistas) != 0)                                                   
		{                                                                                      
			$mr .= "<div style='margin: 3px;'></div>";                                         
			while($colunista = mysql_fetch_object($colunistas))                                
			{                                                                                  
				$mr .= "<div style='margin-bottom: 3px;'></div>";                              
				if($_GET[codcolunista] == $colunista->CODPESSOA  && $_GET[actionType] == "colunistas")
				{                                                                              
					$mr .= "<table style='border: solid 1px silver; background: #e5f1fb;' width='100%'>";		
						$mr .= "<tr style='border: solid 1px silver;'>";                       
							$mr .= "<td style='width: 15%'><img src='$colunista->AVATAR' alt='$colunista->NOME' width='50px' height='50px' style='border-radius: 3px 3px 3px 3px;'/></td>";
								$mr .= "<td valign='top'  style='width: 85%;'><div>$colunista->NOME</div></td>";
						$mr .= "</tr>";                                                        
					$mr .= "</table>";	                                                       
				}                                                                              
				else                                                                           
				{                                                                              
					$mr .= "<table style='' width='100%'>";		                               
						$mr .= "<tr style='border: solid 1px silver;'>";                       
							$mr .= "<td style='width: 15%'><img src='$colunista->AVATAR' alt='$colunista->NOME' width='50px' height='50px' style='border-radius: 3px 3px 3px 3px;'/></td>";
								$mr .= "<td valign='top'  style='width: 85%; cursor: pointer;'><div class='SpanOver' onclick=\"location='index.php?actionType=colunistas&codcolunista=$colunista->CODPESSOA'\">$colunista->NOME</div></td>";
						$mr .= "</tr>";                                                        
					$mr .= "</table>";	                                                       
				}                                                                              
			}                                                                                  
			                                                                                   
		}                                                                                      
	$mr .="</div>";                                                                            
	return $mr;                                                                                
}                                                                                              
                                                                                               
                                                                                               
function maisRapidoAgenda2()                                                                   
{                                                                                              
	$mr ="<div class='RadiosNoticia'>";                                                        
		//$mr .= "<div style='color: #008080; font-size: 20.0pt; text-align: left; border-left: 6px solid #5B9028; padding-left: 10px; cursor: pointer;' onclick=\"javascript: location='index.php?actionType=utilidade.publica'\">+ UTILIDADE P⁄BLICA</div>";
		$mr .= toposecao("+ Utilidade P˙blica");                                               
		$linha1 = mysql_query("SELECT * FROM categoria_agenda2 WHERE STATUS=1 ORDER BY TITULO ASC");
		if(mysql_num_rows($linha1) != 0)                                                       
		{                                                                                      
			while($li = mysql_fetch_object($linha1))                                           
			{                                                                                  
				if($_GET[codcategoriaagenda] == $li->CODCATEGORIAAGENDA  && $_GET[actionType] == "agenda")
				{                                                                              
					$mr .= "<div id='___$li->CODCATEGORIAAGENDA' style='cursor: pointer;' class='OverViewAcesso' onclick=\"espandemaisOpen('#_$li->CODCATEGORIANOTICIA','_$li->CODCATEGORIANOTICIA')\">";
						$mr .= "<div style='text-transform: uppercase'>";                      
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
					$mr .= "<div id='_$li->CODCATEGORIAAGENDA' style='display: block;'>";      
						                                                                       
						$query = mysql_query("SELECT `CODAGENDA`, `CODCATEGORIAAGENDA`, `DESCRICAO`, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA FROM agenda2 WHERE `CODAGENDA`!='$_GET[codagenda]' AND CODCATEGORIAAGENDA='$li->CODCATEGORIAAGENDA' ORDER BY DTA DESC LIMIT 0,3");
						                                                                       
						if(mysql_num_rows($query) != 0)                                        
						{                                                                      
							while( $agenda = mysql_fetch_object($query) )                      
							{                                                                  
								$mr .="<div class='RadiosNoticia' style='margin-top: 3px; padding: 5px; width: 231px; height: 141px; margin-right: 10px;'>";
									$mr .="<table>";                                           
										$mr .="<tr>";                                          
											$mr .="<td valign='top'>";                         
												                                               
												$mr .= "<div style='color: #000; font-size: 9.0pt;margin-bottom: 9px; text-align: left;'><i>$agenda->DTA...</i></div>";
											//$mr .="</td>";                                   
											//$mr .="<td  valign='top'>";                      
												$string = $agenda->DESCRICAO;                  
												$string = substr($string, 0, 40);              
												$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=utilidade.publica&codagenda=$agenda->CODAGENDA&codcategoriaagenda=$agenda->CODCATEGORIAAGENDA'\"><img src='../image/novas/agendaico.jpg' alt='Ver Agenda' border='0' width='50%'/></div>";	
												$mr .= "<div style='color: #1a63a8; font-size: 15px; text-align: left;'>$string ...</div>";
											$mr .="</td>";                                     
										$mr .="</tr>";                                         
									$mr .="</table>";                                          
																				               
								$mr .="</div>";                                                
							}                                                                  
						}                                                                      
					$mr .= "</div>";                                                           
				}                                                                              
				elseif( $_GET[codcategoriaagenda] == $li->CODCATEGORIAAGENDA && $_GET[actionType] == "agenda")
				{                                                                              
					$mr .= "<div class='OverViewAcesso' style='background: #5B9028;'>";        
						$mr .= "<div style='text-transform: uppercase'>";                      
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
				}                                                                              
				else                                                                           
				{                                                                              
					$mr .= "<div id='___$li->CODCATEGORIAAGENDA' style='cursor: pointer;' class='OverViewList OverView' onclick=\"espandemaisOpen('#_$li->CODCATEGORIAAGENDA','_$li->CODCATEGORIAAGENDA')\">";
						$mr .= "<div style='text-transform: uppercase'>";                      
							$mr .= "$li->TITULO";                                              
						$mr .= "</div>";                                                       
					$mr .= "</div>";                                                           
					$mr .= "<div id='_$li->CODCATEGORIAAGENDA' style='display: none;'>";       
						                                                                       
						$query = mysql_query("SELECT `CODAGENDA`, `CODCATEGORIAAGENDA`, `DESCRICAO`, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %Hh%i' ) as DTA FROM agenda2 WHERE `CODAGENDA`!='$_GET[codagenda]' AND CODCATEGORIAAGENDA='$li->CODCATEGORIAAGENDA' ORDER BY DTA DESC LIMIT 0,3");
						                                                                       
						if(mysql_num_rows($query) != 0)                                        
						{                                                                      
							while( $agenda = mysql_fetch_object($query) )                      
							{                                                                  
								$mr .="<div class='RadiosNoticia' style='margin-top: 3px; padding: 5px; width: 231px; height: 141px; margin-right: 10px;'>";
									$mr .="<table>";                                           
										$mr .="<tr>";                                          
											$mr .="<td valign='top'>";                         
												                                               
												$mr .= "<div style='color: #000; font-size: 9.0pt;margin-bottom: 9px; text-align: left;'><i>$agenda->DTA...</i></div>";
											//$mr .="</td>";                                   
											//$mr .="<td  valign='top'>";                      
												$string = $agenda->DESCRICAO;                  
												$string = substr($string, 0, 40);              
												$mr .= "<div style='cursor: pointer;' onclick=\" window.location = 'index.php?actionType=utilidade.publica&codagenda=$agenda->CODAGENDA&codcategoriaagenda=$agenda->CODCATEGORIAAGENDA'\"><img src='../image/novas/agendaico.jpg' alt='Ver Agenda' border='0' width='50%'/></div>";	
												$mr .= "<div style='color: #1a63a8; font-size: 15px; text-align: left;'>$string ...</div>";
											$mr .="</td>";                                     
										$mr .="</tr>";                                         
									$mr .="</table>";                                          
																				               
								$mr .="</div>";                                                
							}                                                                  
						}                                                                      
					$mr .= "</div>";                                                           
				}                                                                              
			}                                                                                  
		}                                                                                      
	$mr .="</div>";                                                                            
	return $mr;                                                                                
}                                                                                              
                                                                                               
function dadosItemProduto( $codproduto )                                                       
{                                                                                              
	                                                                                           
	$row = mysql_query("SELECT *, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %H:%i hs.' ) as `DTA` FROM `produto` WHERE `CODPRODUTO`='$codproduto'");
	$row = mysql_fetch_object($row);                                                           
	                                                                                           
	$itemMenu .= "<div>";                                                                      
		$itemMenu .= "<ul class='SbNav'>";                                                     
			$itemMenu .= "<li style='font-size: 140%'><b>DADOS DA ITEM PRODUTO</b></h3></li>"; 
			$itemMenu .= "<li><b>Data de CriaÁ„o:</b> $row->DTA</li>";                         
			$itemMenu .= "<li><b>Titulo:</b> $row->TITULO</li>";                               
			                                                                                   
			$categoria = mysql_query("SELECT * FROM `categoria` WHERE `CODCATEGORIA`='$row->CODCATEGORIA'");
			$categoria = mysql_fetch_object($categoria);                                       
			                                                                                   
			$fabricante = mysql_query("SELECT * FROM `fabricante` WHERE `CODFABRICANTE`='$row->CODFABRICANTE'");
			$fabricante = mysql_fetch_object($fabricante);                                     
			                                                                                   
			$itemMenu .= "<li><b>Categoria:</b> $categoria->TITULO</li>";                      
			$itemMenu .= "<li><b>Fabricante:</b> $fabricante->TITULO</li>";;                   
			$itemMenu .= "<li><br/><b>Imagem Principal:</b> <br/><img src='$row->FOTO' alt='' border='0'/></li>";
			$itemMenu .= "<li><br/></li>";                                                     
			                                                                                   
		$itemMenu .= "</ul>";                                                                  
	$itemMenu .= "</div>";                                                                     
	                                                                                           
	return $itemMenu;                                                                          
                                                                                               
}                                                                                              
                                                                                               
function dadosItemProduto2( $codanunciante )                                                   
{                                                                                              
	                                                                                           
	$row = mysql_query("SELECT *, DATE_FORMAT( `DTA`, '%d/%m/%Y ‡s %H:%i hs.' ) as `DTA` FROM `anunciantes` WHERE `CODANUNCIANTE`='$codanunciante'");
	$row = mysql_fetch_object($row);                                                           
	                                                                                           
	$itemMenu .= "<div>";                                                                      
		$itemMenu .= "<ul class='SbNav'>";                                                     
			$itemMenu .= "<li style='font-size: 140%'><b>DADOS DO ANUNCIANTE</b></h3></li>";   
			$itemMenu .= "<li><b>Data de CriaÁ„o:</b> $row->DTA</li>";                         
			$itemMenu .= "<li><b>Empresa/Raz„o Social:</b> $row->TITULO</li>";                 
			                                                                                   
			$segmento = mysql_query("SELECT * FROM `segmentos` WHERE `CODSEGMENTO`='$row->CODSEGMENTO'");
			$segmento = mysql_fetch_object($segmento);                                         
			                                                                                   
			$itemMenu .= "<li><b>Segmento:</b> $segmento->TITULO</li>";                        
			$itemMenu .= "<li><br/><b>Imagem Principal:</b> <br/><img src='$row->FOTO' alt='' border='0'/></li>";
			$itemMenu .= "<li><br/></li>";                                                     
			                                                                                   
		$itemMenu .= "</ul>";                                                                  
	$itemMenu .= "</div>";                                                                     
	                                                                                           
	return $itemMenu;                                                                          
                                                                                               
}                                                                                              
                                                                                               
function linha($link, $name, $value, $image, $icone)                                                   
{                                                                                              
	$li .="<li class='menu-item' ><a href=\"$link\"><span class='$icone'></span>$name</a></li>";
	return $li;                                                                                
}                                                                                              
                                                                                               
function toposecao($texto)                                                                     
{                                                                                              
	$tp = "<div class='Capa'>";                                                                
		$tp .= "<div style='float: left; width: 9px; height: 21px; background: url(../image/pontilhado.png); margin-right: 7px'></div>";
		$tp .= "<div style='float: left; font-weight: bold; font-size: 16.5pt; position: relative; bottom: 1px; color:#A80000'>$texto</div>";
		$tp .= "<div style='clear: both;'></div>";                                             
	$tp .= "</div>";                                                                           
	                                                                                           
	return $tp;                                                                                
                                                                                               
}                                                                                              
                                                                                               
function formataNamesobrenome($nome, $sobrenome)                                               
{                                                                                              
	$count = strlen($nome);                                                                    
	$l1 = strtoupper(substr($nome, 0, 1));                                                     
	$l2 = strtolower(substr($nome, 1, $count));                                                
	                                                                                           
	$nome = "$l1$l2";                                                                          
	                                                                                           
	$count = strlen($sobrenome);                                                               
	$l1 = strtoupper(substr($sobrenome, 0, 1));                                                
	$l2 = strtolower(substr($sobrenome, 1, $count));                                           
	                                                                                           
	$sobrenome = "$l1$l2";                                                                     
	                                                                                           
	return "$nome $sobrenome";                                                                 
}                                                                                              
                                                                                               
function getNomepelologin( $login )                                                            
{                                                                                              
	$nome = mysql_query("SELECT pessoa.NOME FROM pessoa                                        
	INNER JOIN login_rel_pessoa ON login_rel_pessoa.CODPESSOA=pessoa.CODPESSOA                 
	INNER JOIN login ON login.CODLOGIN=login_rel_pessoa.CODLOGIN                               
	WHERE login.LOGIN='$login'                                                                 
	");                                                                                        
	                                                                                           
	if(mysql_num_rows($nome) != 0)                                                             
	{						                                                                   
		$nome = mysql_fetch_object($nome);                                                     
		return $nome->NOME;                                                                    
	}                                                                                          
}                                                                                              
                                                                                               
                                                                                               
function queryNoticiasdefault( $exst_capa, $codcategorianoticia, $limit )                      
{                                                                                              
	return "SELECT                                                                             
	noticias.CODNOTICIA,                                                                       
	noticias.STATUS,                                                                           
	noticias.FOTO,                                                                             
	noticias.DESTAQUE,                                                                         
	noticias.CODCATEGORIANOTICIA,                                                              
	noticias.OWNER, noticias.PESO,                                                             
	noticias.TITULO,                                                                           
	DATE_FORMAT( noticias.DTA, '%d/%m/%Y<br/>%Hh%i' ) as DTA,                                  
	noticias.DESCRICAO, categoria_noticia.TITULO as CTITULO                                    
	FROM                                                                                       
	noticias                                                                                   
	INNER JOIN                                                                                 
	categoria_noticia ON categoria_noticia.CODCATEGORIANOTICIA=noticias.CODCATEGORIANOTICIA    
	WHERE                                                                                      
	noticias.STATUS=1                                                                          
	$exst_capa                                                                                 
	AND noticias.RELEVANTE=1	                                                               
	AND categoria_noticia.CODCATEGORIANOTICIA IN ($codcategorianoticia)                        
	GROUP BY noticias.CODNOTICIA                                                               
	ORDER BY (noticias.PESO+0),noticias.DTA DESC LIMIT $limit";                                
} 

function getInternacionalizacao()
{
	$li = "<div class='ShowBandeiras'>";
		
		$link = explode("/", $_SERVER['REQUEST_URI']);
		
		$li .= "<div class='ShowBandeirasInter'>";
			$li .= "<form name='Liinglesform' id='Liinglesform' method='post' action='$link[1]'>";
				$li .= "<input class='ShowInputBandeiras' type='image' title='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."' alt='".getLabel('LABEL_INGLES', $_SESSION['LANGUAGE'])."' src='../image/eua.jpg'/>";
				$li .= "<input type='hidden' value='INGLES' name='LANGUAGE'/>";
			$li .= "</form>";
		$li .= "</div>";
		
		$li .= "<div class='ShowBandeirasInter'>";
			$li .= "<form name='Liespanholform' id='Liespanhouform' method='post' action='$link[1]'>";
				$li .= "<input class='ShowInputBandeiras' type='image' title='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."' alt='".getLabel('LABEL_ESPANHOL', $_SESSION['LANGUAGE'])."' src='../image/espanha.jpg'/>";
				$li .= "<input type='hidden' value='ESPANHOL' name='LANGUAGE'/>";
			$li .= "</form>";
		$li .= "</div>";
		
		$li .= "<div class='ShowBandeirasInter'>";
			$li .= "<form name='Liportuguesfrom' id='Liportuguesfrom' method='post' action='$link[1]'>";
				$li .= "<input class='ShowInputBandeiras' type='image' title='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."' alt='".getLabel('LABEL_PORTUGUES', $_SESSION['LANGUAGE'])."' src='../image/brasil.jpg'/>";
				$li .= "<input type='hidden' value='PORTUGUES' name='LANGUAGE'/>";
			$li .= "</form>";
		$li .= "</div>";
		
		$li .= "<div class='ResetFloat'></div>";
		
	$li .= "</div>";
	
	return $li;
}

function tratapost($_post)
{
	return isset($_post) ? $_post : '';
}

function trataget($_get)
{
	return isset($_get) ? $_get : '';
}

function getLabel($key, $column)
{
	$label = mysql_query("SELECT $column FROM internacionalizacao WHERE NOM_LABEL='$key'");	
	
	if(mysql_num_rows($label) == 0)
	{
		return $key;
      }
	else
	{
		$label = mysql_fetch_object($label);
		return $label->$column;
	}
	
}

function getlinguagemdasessao()
{
	foreach( $_SESSION as $name => $value)
	{
		if($name == "LANGUAGE")
		{
			if( $value == "PORTUGUES" || $value == "INGLES" || $value == "ESPANHOL" )
			{
				return $value;
			}
		}
	}
}

function permutations( array $array, $key = 0, $limit = 100 )
{
	static $result;
	$count = count( $array );
	
	try
	{
		
		if( $count > $limit )
		{
			throw new LengthException( sprintf( 'Error!: Unable to generate permutations with more than %d values' , $limit ) );
		}
		
		if( $key == $count )
		{
			$result[ ] = $array;
		}
		else
		{
			for( $i = $key; $i < $count; $i++ )
			{
				list( $array[ $key ], $array[ $i ] ) = array( $array[ $i ], $array[ $key ] );
				permutations( $array, $key + 1 );
			}
		}
		
		return $result;
	}
	catch( LengthException $e )
	{
		echo $e->getMessage( );
	}
}

//function compliteCod($number)
function compliteCod($number, $arr = array())
{
  
    if((int)$number == 0)
    {
     $number = "1";
    }
  
	$key = "";
	for($i=0;$i<4;$i++)
	{
		$select_quarto_tipo = "select_quarto_tipo_".$i;
		if( $arr[$select_quarto_tipo] != "")
		{
			$key .= "'".$arr[$select_quarto_tipo]."'";
		}
	}
	
	$key = str_replace("''","','",$key);
	$sigla = mysql_query("SELECT SIGLA, VALOR FROM `quartos_tipo` WHERE `CODQUARTOTIPO` IN ($key) ORDER BY (VALOR +0) DESC");
	
	if(mysql_num_rows($sigla) != 0)
	{
		$sigla = mysql_fetch_object($sigla);
		$sigla = $sigla->SIGLA;
	}
	
	switch(strlen($number))
	{
		case 1:
			$str = "000000000$number"; 
		break;
		case 2:
			$str = "00000000$number"; 
		break;
		case 3:
			$str = "0000000$number"; 
		break;
		case 4:
			$str = "000000$number"; 
		break;
		case 5:
			$str = "00000$number"; 
		break;
		case 6:
			$str = "0000$number"; 
		break;
		case 7:
			$str = "000$number"; 
		break;
		case 8:
			$str = "00$number"; 
		break;
		case 9:
			$str = "0$number"; 
		break;
		case 10:
			$str = "$number"; 
		break;
	}
	
	(int)$x = strlen($str);
	(int)$z = strlen($sigla);
	
	return $sigla.substr($str, -($x-$z));
}
                                                                                               
?>