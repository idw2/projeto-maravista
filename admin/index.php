<?php
session_start();

require_once("../server/Connection.class.php");
require_once("../server/Redimensionar.class.php");
require_once("../server/lib_n.php");
require_once("../server/GExtenso.php");

$conn = new Connection();
//$_GET['actionType'] = isset($_GET['actionType']) ? $_GET['actionType'] : '';
if (isset($_GET['actionType'])) {
    $_GET['actionType'] = trataget($_GET['actionType']);
} else {
    $_GET['actionType'] = 'topo.login';
}

if (!empty($_POST) && isset($_POST['LANGUAGE'])) {
    $_SESSION['LANGUAGE'] = $_POST['LANGUAGE'];
} else {
    if (!isset($_SESSION['LANGUAGE'])) {
        $_SESSION['LANGUAGE'] = "PORTUGUES";
    }
}

$dados_relevantes = mysql_query("SELECT * FROM dados_relevantes");
$dados_relevantes = mysql_fetch_object($dados_relevantes);

$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$html .="<html xmlns='http://www.w3.org/1999/xhtml'>";
$html .="<head>";

$html .="<title>" . getLabel('LABEL_POUSADA_MARAVISTA', $_SESSION['LANGUAGE']) . " - Admin</title>";
$html .="<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />";

/* fiveico */
$html .="<link rel='SHORTCUT ICON' href='../image/fav_admin.png'/>";

/* styles */
$html .="<link rel='stylesheet' href='../style/folha-admin_n.css' type='text/css' />";
$html .="<link rel='stylesheet' href='../style/entypo.css' type='text/css' />";
$html .="<link rel='stylesheet' href='../style/perfect-scrollbar-0.4.8.min.css' type='text/css' />";
//$html .="<link rel='stylesheet' href='../style/default2.css' type='text/css' />";
//$html .="<link rel='stylesheet' href='../style/default_new.css' type='text/css' />";
$html .="<link rel='stylesheet' href='../style/jquery-ui.css' />";

/* javascript */
$html .= "<script language='javascript'  src='../script/jquery-1.9.1.min.js'></script>";
$html .= "<script language='javascript'  src='../script/funcoes.js'></script>";
$html .= "<script language='javascript'  src='../script/lib.js'></script>";
$html .= "<script language='javascript'  src='../script/default.js'></script>";
$html .= "<script language='javascript'  src='../script/jquery.flow.1.1.min.js'></script>";

$html .= "<script language='javascript'  src='../script/perfect-scrollbar-0.4.8.with-mousewheel.min.js'></script>";
$html .= "<script language='javascript'  src='../script/masc.js'></script>";
$html .= "<script language='javascript'  src='../script/telefones.js'></script>";
$html .= "<script language='javascript'  src='../script/js_admin.js'></script>";
$html .= "<script src='../script/jquery-ui.js'></script>";
/*
  $html .= "<script type='text/javascript' src='../script/jquery.fancybox.js'></script>";
  $html .= "<script type='text/javascript' src='../script/jquery.mousewheel-3.0.6.pack.js'></script>";
  $html .= "<script type='text/javascript' src='../script/jquery.fancybox.js?v=2.1.5'></script>";
  $html .= "<script type='text/javascript' src='../script/jquery.fancybox-buttons.js?v=1.0.5'></script>";
  $html .= "<script type='text/javascript' src='../script/jquery.fancybox-thumbs.js?v=1.0.7'></script>";
  $html .= "<script type='text/javascript' src='../script/jquery.fancybox-media.js?v=1.0.6'></script>";
  $html .= "<script type='text/javascript' src='../script/hour.js'></script>";
 */


if ($_GET['actionType'] == 'pagina.inicial' || $_GET['actionType'] == '') {

    $html .= "<script language='javascript'  src='../script/jCarousel.js'></script>";
    $html .= "<script language='javascript'>
			
			$(function() {
				$('.anyClass').jCarouselLite({				
					auto: 5000,
					speed: 500,					
					btnNext: '.next',
					btnPrev: '.prev',
					visible: 1	
					});
				});
                               
		</script>";
}
$html .= "<script language='javascript'>
                  $(function() {
                      $('.menu-body').perfectScrollbar();
                  });
			jQuery(document).ready(function($){
                        $('a[href=#config]').click(function(){
                        $('.menu-bottom-op').toggleClass('hide');
                        });
			}); 
			
			$('.dtaCalendario').datepicker({
				dateFormat: 'dd/mm/yy',
				dayNames: [
				'" . getLabel('LABEL_DOMINGO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_SEGUNDA', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_TERCA', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_QUARTA', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_QUINTA', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_SEXTA', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_SABADO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_DOMINGO', $_SESSION['LANGUAGE']) . "'],
				dayNamesMin: [
				'" . getLabel('LABEL_D1', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_D2', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_D3', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_D4', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_D5', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_D6', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_D7', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_D1', $_SESSION['LANGUAGE']) . "'],
				dayNamesShort: [
				'" . getLabel('LABEL_DOM', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_SEG', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_TER', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_QUA', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_QUI', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_SEX', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_SAB', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_DOM', $_SESSION['LANGUAGE']) . "'],
				monthNames: [
				'" . getLabel('LABEL_JANEIRO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_FEVEREIRO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_MARCO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_ABRIL', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_MAIO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_JUNHO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_JULHO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_AGOSTO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_SETEMBRO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_OUTUBRO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_NOVEMBRO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_DEZEMBRO', $_SESSION['LANGUAGE']) . "'],
				monthNamesShort: [
				'" . getLabel('LABEL_JAN', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_FEV', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_MAR', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_ABR', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_MAI', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_JUN', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_JUL', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_AGO', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_SET', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_OUT', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_NOV', $_SESSION['LANGUAGE']) . "',
				'" . getLabel('LABEL_DEZ', $_SESSION['LANGUAGE']) . "'],
				nextText: '" . getLabel('LABEL_NEXT', $_SESSION['LANGUAGE']) . "',
				prevText: '" . getLabel('LABEL_PREVIOUS', $_SESSION['LANGUAGE']) . "',
				minDate: 0,
				maxDate: '+365D',
				numberOfMonths: 1
				
			});
			
        </script>";

$html .="</head>";

$html .="<body class='" . $_SESSION['LANGUAGE'] . "'>";

if (!strlen($_SESSION['CODPESSOA']) == 32) {
    $html .="<div class='container-outer'>";
    $html .="<div class='container-inside'>";
    $html .="<div class='logo_b'>";
    $html .="</div>";
    require("login.topo.php");
    $html .="</div>";
    $html .="</div>";
} else {

    $html .="<div class='side-menu'>";
    $html .="<div class='menu-top'>";
    $html .="<a class='logo left' href='../admin'></a>";
    $html .="<div class='dropout inter'>";
    $html .="<a class='dropdown config right' data-dropdown='drop_inter'><span class='entypo-cog'></span></a>"
            . "<ul id='drop_inter' class='dropctnr'>"
            . getInternacionalizacao_admin()
            . "</ul>";
    $html .="</div>";
    $html .="</div>";
    $html .= getNavegacao($pi, "pagina");
    $html .="<div class='menu-bottom'>
                <div class='menu-bottom-op hide'>
                <ul>
                
                </ul>
                </div>
                <a href='../image/help.pdf' target='_blank' style='position:relative;top: 18px;'><span class='entypo-help'></span></a>
                <a href='../admin_old/index.php?actionType=pagina.inicial' target='_blank' style='position:relative;top: 18px;'><span class='entypo-help'></span></a>
              </div>";
    $html .="</div>";

    $html .="<div class='cnt-container'>";
    if (strlen($_SESSION['CODPESSOA']) == 32) {
        $html .="<div class='cnt-header'>";
        $html .="<div class='InitTop left'>";
        $html .="<a href='../home/' target='_blank'><div class='logo_min'></div></a>";
        $html .="</div>";
        $html .= "<div class='right'>"
                . "<div class='dropout'>"
                . "<a class='dropdown btn_user btn' style='border-left:solid 1px #3272B8;box-shadow:-2px 0 6px rgba(0,0,0,0.1);' data-dropdown='drop_user'>" . $_SESSION['NOME'] . "<span class='entypo-arrow-down5 cima'></span><span class='entypo-arrow-up4 baixo'></span></a>"
                . "<ul id='drop_user' class='dropctnr'>"
                . "<li style='border-bottom: solid 1px #292929;'><a href='index.php?actionType=alterar.senha'>" . getLabel('LABEL_ALTERAR_SENHA', $_SESSION['LANGUAGE']) . "</a></li>"
                . "<li><a class='dropdown' href='index.php?actionType=logout'>" . getLabel('LABEL_SAIR', $_SESSION['LANGUAGE']) . "</a></li>"
                . "</ul>"
                . "</div>"
                . "</div>";
        $html .="<div class='Bandeiras right'>";

        $html .="<div class='Pouzada'>";
        $html .="<span id='linguagem' class='" . $_SESSION['LANGUAGE'] . "'></span>";
        $html .="</div>";
        $html .="<div style='display:none'>";
        $html .= getInternacionalizacao_admin();
        $html .="</div>";

        $html .="</div>";
        $html .="</div>";
        //$html .= "<div class='ResetFloat'></div>";	
    } else {
        
    }

    $html .="<div class='cnt-body'>";

    if ($_GET['actionType'] == 'logout') {
        require("logout.php");
    }



    if ($_GET['actionType'] == 'mypapers') {
        require("mypapers.php");
    } elseif ($_GET['actionType'] == 'tarifas.reservas') {
        require("tarifas.reservas.php");
    } elseif ($_GET['actionType'] == 'resultado') {
        require("resultado.php");
    } elseif ($_GET['actionType'] == 'bem.vindo') {
        require("bem.vindo.php");
    } elseif ($_GET['actionType'] == 'gerenciar.usuarios') {
        require("gerenciar.usuarios.php");
    } elseif ($_GET['actionType'] == 'gerenciar.usuarios.add') {
        require("gerenciar.usuarios.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.usuarios.edit') {
        require("gerenciar.usuarios.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.rel.eventos') {
        require("gerenciar.pacotes.rel.eventos.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.tipos.descricao') {
        require("gerenciar.quartos.tipos.descricao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.a.pousada') {
        require("gerenciar.a.pousada.php");
    } elseif ($_GET['actionType'] == 'gerenciar.emails') {
        require("gerenciar.emails.php");
    } elseif ($_GET['actionType'] == 'gerenciar.emails.add') {
        require("gerenciar.emails.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.emails.edit') {
        require("gerenciar.emails.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.datas.del') {
        require("gerenciar.pacotes.datas.del.php");
    } elseif ($_GET['actionType'] == 'gerenciar.emails.descricao') {
        require("gerenciar.emails.descricao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.tipos.fotos.list') {
        require("gerenciar.quartos.tipos.fotos.list.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.tipos.fotos.add') {
        require("gerenciar.quartos.tipos.fotos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.tipos.fotos.del') {
        require("gerenciar.quartos.tipos.fotos.del.php");
    } elseif ($_GET['actionType'] == 'alterar.senha') {
        require("alterar.senha.php");
    } elseif ($_GET['actionType'] == 'gerenciar.galeria') {
        require("gerenciar.galeria.php");
    } elseif ($_GET['actionType'] == 'gerenciar.galeria.fotos.list') {
        require("gerenciar.galeria.fotos.list.php");
    } elseif ($_GET['actionType'] == 'gerenciar.galeria.edit') {
        require("gerenciar.galeria.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.galeria.add') {
        require("gerenciar.galeria.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.galeria.fotos.add') {
        require("gerenciar.galeria.fotos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.galeria.fotos.del') {
        require("gerenciar.galeria.fotos.del.php");
    } elseif ($_GET['actionType'] == 'gerenciar.galeria.descricao') {
        require("gerenciar.galeria.descricao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.idiomas') {
        $pag_title = getLabel('LABEL_GERENCIAR_IDIOMAS', $_SESSION['LANGUAGE']);
        require("gerenciar.idiomas.php");
    } elseif ($_GET['actionType'] == 'gerenciar.idiomas.add') {
        require("gerenciar.idiomas.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.idiomas.edit') {
        require("gerenciar.idiomas.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.tipos') {
        require("gerenciar.quartos.tipos.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.tipos.add') {
        require("gerenciar.quartos.tipos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.faleconosco') {
        require("gerenciar.faleconosco.php");
    } elseif ($_GET['actionType'] == 'gerenciar.faleconosco.add') {
        require("gerenciar.faleconosco.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.faleconosco.edit') {
        require("gerenciar.faleconosco.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.rel.quartos') {
        require("gerenciar.pacotes.rel.quartos.php");
    } elseif ($_GET['actionType'] == 'gerenciar.localizacao') {
        require("gerenciar.localizacao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.tipos.edit') {
        require("gerenciar.quartos.tipos.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.rodape') {
        require("gerenciar.rodape.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos') {
        require("gerenciar.quartos.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.add') {
        require("gerenciar.quartos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.edit') {
        require("gerenciar.quartos.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.descricao') {
        require("gerenciar.quartos.descricao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.fotos.list') {
        require("gerenciar.quartos.fotos.list.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.fotos.add') {
        require("gerenciar.quartos.fotos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.fotos.del') {
        require("gerenciar.quartos.fotos.del.php");
    } elseif ($_GET['actionType'] == 'gerenciar.extras') {
        require("gerenciar.extras.php");
    } elseif ($_GET['actionType'] == 'gerenciar.extras.add') {
        require("gerenciar.extras.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.extras.edit') {
        require("gerenciar.extras.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.extras.fotos.list') {
        require("gerenciar.extras.fotos.list.php");
    } elseif ($_GET['actionType'] == 'gerenciar.extras.fotos.add') {
        require("gerenciar.extras.fotos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes') {
        require("gerenciar.pacotes.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.add') {
        require("gerenciar.pacotes.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.quartos.tipos.configuracao') {
        require("gerenciar.quartos.tipos.configuracao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.edit') {
        require("gerenciar.pacotes.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.fotos.list') {
        require("gerenciar.pacotes.fotos.list.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.fotos.add') {
        require("gerenciar.pacotes.fotos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.descricao') {
        require("gerenciar.pacotes.descricao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.datas') {
        require("gerenciar.pacotes.datas.php");
    } elseif ($_GET['actionType'] == 'gerenciar.dicas') {
        require("gerenciar.dicas.php");
    } elseif ($_GET['actionType'] == 'gerenciar.carrossel') {
        require("gerenciar.carrossel.php");
    } elseif ($_GET['actionType'] == 'gerenciar.cielo') {
        require("gerenciar.cielo.php");
    } elseif ($_GET['actionType'] == 'gerenciar.carrossel.fotos.add') {
        require("gerenciar.carrossel.fotos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.carrossel.fotos.del') {
        require("gerenciar.carrossel.fotos.del.php");
    } elseif ($_GET['actionType'] == 'gerenciar.dicas.add') {
        require("gerenciar.dicas.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.dicas.edit') {
        require("gerenciar.dicas.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.dicas.fotos.list') {
        require("gerenciar.dicas.fotos.list.php");
    } elseif ($_GET['actionType'] == 'gerenciar.dicas.descricao') {
        require("gerenciar.dicas.descricao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.dicas.fotos.add') {
        require("gerenciar.dicas.fotos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.extras.fotos.del') {
        require("gerenciar.extras.fotos.del.php");
    } elseif ($_GET['actionType'] == 'gerenciar.pacotes.fotos.del') {
        require("gerenciar.pacotes.fotos.del.php");
    } elseif ($_GET['actionType'] == 'gerenciar.dicas.fotos.del') {
        require("gerenciar.dicas.fotos.del.php");
    } elseif ($_GET['actionType'] == 'gerenciar.termos.servico') {
        require("gerenciar.termos.servico.php");
    } elseif ($_GET['actionType'] == 'gerenciar.termos.servico.edit') {
        require("gerenciar.termos.servico.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.eventos') {
        require("gerenciar.eventos.php");
    } elseif ($_GET['actionType'] == 'gerenciar.reservas') {
        require("gerenciar.reservas.php");
    } elseif ($_GET['actionType'] == 'gerenciar.reservas.descricao') {
        require("gerenciar.reservas.descricao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.reservas.status') {
        require("gerenciar.reservas.status.php");
    } elseif ($_GET['actionType'] == 'gerenciar.sobre.nos') {
        require("gerenciar.sobre.nos.php");
    } elseif ($_GET['actionType'] == 'gerenciar.facilidades.servicos') {
        require("gerenciar.facilidades.servicos.php");
    } elseif ($_GET['actionType'] == 'gerenciar.reservas.externas') {
        require("gerenciar.reservas.externas.php");
    } elseif ($_GET['actionType'] == 'gerenciar.reservas.externas.add') {
        require("gerenciar.reservas.externas.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.reservas.externas.add2') {
        require("gerenciar.reservas.externas.add2.php");
    } elseif ($_GET['actionType'] == 'gerenciar.eventos.add') {
        require("gerenciar.eventos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.eventos.edit') {
        require("gerenciar.eventos.edit.php");
    } elseif ($_GET['actionType'] == 'gerenciar.eventos.descricao') {
        require("gerenciar.eventos.descricao.php");
    } elseif ($_GET['actionType'] == 'gerenciar.eventos.fotos.list') {
        require("gerenciar.eventos.fotos.list.php");
    } elseif ($_GET['actionType'] == 'gerenciar.eventos.fotos.add') {
        require("gerenciar.eventos.fotos.add.php");
    } elseif ($_GET['actionType'] == 'gerenciar.eventos.fotos.del') {
        require("gerenciar.eventos.fotos.del.php");
    } elseif ($_GET['actionType'] == 'gerenciar.text.tarifas') {
        require("gerenciar.text.tarifas.php");
    } else {
        require("bem.vindo.php");
    }

    $html .="<div class='cnt-body-inside'>";
    $html .= "<div class='pag_title'>" . $pag_title . "</div>";
    $html .= $pi;
    $html .="</div>";
    $html .="</div>";
    $html .="</div>";
}

$html .="</body>";
$html .="</html>";

$html = stripslashes($html);

print ( $html);

$conn->close();
if ($_GET['actionType'] == "gerenciar.quartos.descricao" || $_GET['actionType'] == "gerenciar.dicas.descricao" || $_GET['actionType'] == "gerenciar.eventos.descricao" || $_GET['actionType'] == "gerenciar.rodape" || $_GET['actionType'] == "gerenciar.localizacao" || $_GET['actionType'] == "gerenciar.galeria.descricao" || $_GET['actionType'] == "gerenciar.quartos.tipos.descricao" || $_GET['actionType'] == "gerenciar.a.pousada" || $_GET['actionType'] == "gerenciar.text.tarifas" || $_GET['actionType'] == "gerenciar.pacotes.descricao") {
    require("tinymce2.php");
} elseif ($_GET[actionType] == "gerenciar.emails.descricao") {
    require("../home/tinymce_full.php");
} elseif ($_GET[actionType] == "gerenciar.reservas.externas.add") {
    require("tinymce3.php");
} elseif ($_GET[actionType] == "gerenciar.termos.servico.edit" || $_GET[actionType] == "gerenciar.emails.descricao" || $_GET[actionType] == "gerenciar.sobre.nos" || $_GET[actionType] == "gerenciar.facilidades.servicos"
) {
    require("tinymce.php");
}
/*
  elseif( $_GET[actionType] == "faleconosco" )
  {
  require("tinymce3.php");
  }
  elseif( $_GET[actionType] == "gerenciar.hotsite"
  || $_GET[actionType] == "gerenciar.produto.add"
  || $_GET[actionType] == "gerenciar.produto.edit"
  || $_GET[actionType] == "gerenciar.noticias.add"
  || $_GET[actionType] == "gerenciar.informativos.add"
  || $_GET[actionType] == "gerenciar.informativos.edit"
  || $_GET[actionType] == "gerenciar.colunistas.perfil.edit"
  || $_GET[actionType] == "gerenciar.banner.eventos.add"
  || $_GET[actionType] == "gerenciar.banner.eventos.edit"
  || $_GET[actionType] == "gerenciar.galeria.add"
  || $_GET[actionType] == "gerenciar.galeria.edit"
  || $_GET[actionType] == "gerenciar.enviar.amigo"
  || $_GET[actionType] == "gerenciar.noticias.edit"
  || $_GET[actionType] == "gerenciar.informativos.add2"
  || $_GET[actionType] == "gerenciar.informativos.edit2"
  || $_GET[actionType] == "gerenciar.agenda.add"
  || $_GET[actionType] == "gerenciar.agenda.edit"
  || $_GET[actionType] == "gerenciar.agenda.add2"
  || $_GET[actionType] == "gerenciar.noticias.edit2"
  || $_GET[actionType] == "gerenciar.agenda.edit2"
  || $_GET[actionType] == "gerenciar.pgn.html.add"
  || $_GET[actionType] == "gerenciar.pgn.html.edit" )
  {
  require("tinymce.php");
  }
 */
?>

<script>
    $(document).ready(function() {
        $("#txtFromDate").datepicker({
            minDate: 0,
            maxDate: "+365D",
            numberOfMonths: 1,
            onSelect: function(selected) {
                $("#txtToDate").datepicker("option", "minDate", selected)
            }
        });
        $("#txtToDate").datepicker({
            minDate: 0,
            maxDate: "+365D",
            numberOfMonths: 1,
            onSelect: function(selected) {
                $("#txtFromDate").datepicker("option", "maxDate", selected)
            }
        });
    });

</script>