<?php
require_once("../server/mobileController.php");

function callback($buffer){
  return (str_replace("Logo", "Joker", $buffer));
  //return $buffer;
}

define('SITE', 'http://www.maravista.com.br');

session_start();

$url_anterior = $_SERVER['HTTP_REFERER'];
require_once("../server/Connection.class.php");
require_once("../server/Redimensionar.class.php");
require_once("../server/lib.php");
require_once("../server/GExtenso.php");
require_once("../server/Reserva.class.php");
require_once("../server/Reserva.class.bkp.php");

$conn = new Connection();

if ($_POST["language"] != "") {
  $_SESSION['LANGUAGE'] = $_POST["language"];
}

if ($_SESSION['LANGUAGE'] == "") {
  $_SESSION['LANGUAGE'] = "PORTUGUES";
}

if ($_POST["FORMLANGUAGE"] == "FORMLANGUAGE") {
  $_SESSION['LANGUAGE'] = $_POST['LANGUAGE'];
}

$dta_inicio_default = mysql_query("SELECT DATE_FORMAT( CURRENT_DATE, '%d/%m/%Y' ) as DTA");
$dta_inicio_default = mysql_fetch_object($dta_inicio_default);

$dta_inicio_default_usa = mysql_query("SELECT CURRENT_DATE as DTA");
$dta_inicio_default_usa = mysql_fetch_object($dta_inicio_default_usa);

$dta_fim_default = mysql_query("SELECT DATE_FORMAT( DATE_ADD(CURRENT_DATE, INTERVAL 1 DAY), '%d/%m/%Y' ) as DTA");
$dta_fim_default = mysql_fetch_object($dta_fim_default);

$dta_fim_default_usa = mysql_query("SELECT DATE_ADD(CURRENT_DATE, INTERVAL 1 DAY) as DTA");
$dta_fim_default_usa = mysql_fetch_object($dta_fim_default_usa);

if (isset($_GET['actionType'])) {
  $_GET['actionType'] = trataget($_GET['actionType']);
} else {
  $_GET['actionType'] = '';
}

$dados_relevantes = mysql_query("SELECT * FROM dados_relevantes");
$dados_relevantes = mysql_fetch_object($dados_relevantes);

$html = '<!DOCTYPE>';
$html .="<html>";
$html .="<head>";
$html .= getTitle($_GET["actionType"]);


$html .="<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />";
$html .="<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

$useragent = $_SERVER['HTTP_USER_AGENT'];
$is_mobile = preg_match('/(android|bb\d+|meego)|android|ipad|playbook|silk.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));

if ($is_mobile) {
  $html .="<meta name='viewport' content='width=device-width, user-scalable=no'>";
} else {
  $html .="<meta name='viewport' content='width=device-width'>";
}

$html .="<meta name='keywords' content='pousada, maravista, hotel, buzios' />";
$html .="<meta name='description' content='" . utf8_decode("Desde 1999, a Pousada Maravista está sempre aprimorando o atendimento, buscando adaptar as necessidades de nossos hóspedes. Organizamos a estadia de grupos com interesses específicos como spa, eventos, comemorações ou negócios [workshops].") . "' />";
$html .="<meta name='author' content='DesignLab' />";

/* styles */
$html .= "<link rel='stylesheet' href='../style/jquery-ui.min.css' />";
$html .= "<link rel='stylesheet' href='../style/default.min.css' />";
$html .= "<link rel='stylesheet' href='../style/bootstrap.min.css' />";
$html .= "<link rel='stylesheet' href='../style/mobile.min.css' />";
$html .= "<link rel='stylesheet' href='../style/fancySelect.css' />";
$html .= "<link rel='stylesheet' href='../style/icones.css' />";
$html .= "<link rel='stylesheet' href='../style/ahmad.image.css' />";


if ($_GET['actionType'] == '' || $_GET['actionType'] == 'contato' || $_GET['actionType'] == "pagina.inicial" || $_GET['actionType'] == 'reservas.form.submit' || $_GET['actionType'] == 'reservas.analisa' || $_GET['actionType'] == 'acomodacoes' || $_GET['actionType'] == 'pacotes-e-promocoes') {
  $html .="<link rel='stylesheet' href='../style/folha-contato.min.css' />";
}
$html .= "<link rel='stylesheet' href='../style/folha-important.min.css' />";

/* fiveico */
$html .="<link rel='SHORTCUT ICON' href='../image/favicon.png'/>";

/* javascript */
$html .= "<script src='../script/jquery-1.10.2.min.js'></script>";
$html .= "<script language='javascript' src='../script/mobile.js'></script>";
$html .= "<script language='javascript' src='../script/lib.js'></script>";
$html .= "<script language='javascript' src='../script/funcoes.js'></script>";
$html .= "<script language='javascript' src='../script/default.min.js'></script>";
$html .= "<script language='javascript' src='../script/reservas.js'></script>";
$html .= "<script language='javascript' src='../script/jquery.flow.1.1.min.js'></script>";
$html .= "<script language='javascript' src='../script/masc.js'></script>";
$html .= "<script language='javascript' src='../script/telefones.js'></script>";
$html .= "<script language='javascript' src='../script/jquery-ui.min.js'></script>";
$html .= "<script language='javascript' src='../script/modernizr.js'></script>";
if ($_GET['actionType'] != 'reservas.forma.pgto.cielo') {
  $html .= "<script language='javascript' src='../script/jquery.validate.min.js'></script>";
}
$html .= "<script language='javascript' src='../script/jquery.mask.min.js'></script>";
$html .= "<script language='javascript' src='../script/ahmad.image.js'></script>";
//$html .= "<script language='javascript' src='../script/jquery.collagePlus.min.js'></script>";

$html .= "<script src='../script/fancySelect.js'></script>";

/* fancybox */
if ($_GET['actionType'] == 'acomodacoes' || $_GET['actionType'] == 'quartos' || $_GET['actionType'] == '' || $_GET['actionType'] == 'dicas' || $_GET['actionType'] == 'pagina.inicial' || $_GET['actionType'] == 'eventos.view' || $_GET['actionType'] == 'quartos.resultado' || $_GET['actionType'] == 'tarifas' || $_GET['actionType'] == 'pacotes-e-promocoes' || $_GET['actionType'] == 'facilidades.servicos.view' || $_GET['actionType'] == 'galeria') {
  $html .="<link rel='stylesheet' href='../style/jquery.fancybox.css?v=2.1.5' />";
  $html .="<link rel='stylesheet' href='../style/jquery.fancybox-buttons.css?v=1.0.5' />";
  $html .="<link rel='stylesheet' href='../style/jquery.fancybox-thumbs.css?v=1.0.7' />";

  $html .= "<script language='javascript' src='../script/jquery.mousewheel-3.0.6.pack.js'></script>";
  $html .= "<script language='javascript' src='../script/jquery.fancybox.js?v=2.1.5'></script>";
  $html .= "<script language='javascript' src='../script/jquery.fancybox-buttons.js?v=1.0.5'></script>";
  $html .= "<script language='javascript' src='../script/jquery.fancybox-thumbs.js?v=1.0.7'></script>";
  $html .= "<script language='javascript' src='../script/jquery.fancybox-media.js?v=1.0.6'></script>";
}

$html .= "<script language='javascript' src='../script/tofixed.js'></script>";

$html .= "<!--[if lt IE 9]>
		<script src='../script/respond.min.js'></script>
		<script src='../script/html5.js'></script>
	<![endif]-->";

if ($_GET['actionType'] == 'pagina.inicial' || $_GET['actionType'] == '') {
  $html .= "<link rel='stylesheet' href='../style/rcarousel.css' />";
  $html .= "<script language='javascript'  src='../script/jquery.ui.core.min.js'></script>";
  $html .= "<script language='javascript'  src='../script/jquery.ui.widget.min.js'></script>";
  $html .= "<script language='javascript'  src='../script/jquery.ui.rcarousel.min.js'></script>";
  $html .= "<script language='javascript'  src='../script/jquery.flexslider.min.js'></script>";
}

if ($_GET['actionType'] == 'reservas.forma.pgto.cielo' || $_GET['actionType'] == '') {
  $html .= "<script language='javascript'  src='../script/jquery.payment.js'></script>";
}



if ($_GET['actionType'] == "" || $_GET['actionType'] == "pagina.inicial" || $_GET['actionType'] == "reservas.form.submit") {
  $html .= "<script language='javascript' src='../script/jquery.ddslick.min.js'></script>";
}

require("scripts.php");

$html .="</head>";

$at = $_SESSION['LANGUAGE'];

$html .="<body class='" . $at . "' >";

$useragent = $_SERVER['HTTP_USER_AGENT'];
$is_mobile = preg_match('/(android|bb\d+|meego)|android|ipad|playbook|silk.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));
if ($is_mobile) {
  $html .="<div class='load_aguardando'> <div class='load_aguardando-label'>...</div></div>";
}

$html .="<div class='menu-bg'></div>";

if ($_GET["actionType"] == "pousada" || $_GET["actionType"] == "eventos-e-casamentos") {

  switch ($_GET['actionType']) {
    case "pousada":
      $limit = "LIMIT 1,2";
      break;
    case "eventos":
      $limit = "LIMIT 0,1";
      break;
    default:
      $limit = "LIMIT 1,2";
      break;
  }

  $codcarrossel = "E38232694E56B7F3D0C2844AB4704D4F";
  $carrossels = mysql_query("SELECT  
				fotos.CODFOTO,
				DATE_FORMAT( fotos.DTA, '%d/%m/%Y - %Hh%i' ) as DTA,
				fotos.TITULO,
				fotos.URL,
				fotos.STATUS,
				fotos.DESTAQUE,
				fotos.OWNER
			FROM 
				fotos 
			INNER JOIN carrossel_rel_fotos ON carrossel_rel_fotos.CODFOTO=fotos.CODFOTO
			WHERE 
			carrossel_rel_fotos.CODCARROSSEL='$codcarrossel'
			AND fotos.STATUS=1 
			ORDER BY fotos.DTA DESC
			$limit");

  if (mysql_num_rows($carrossels) != 0) {
    if ($_GET["actionType"] != 'pagina.inicial' && $_GET["actionType"] != '') {
      $html .= "<div class='banner-home' style='width: 100%'>";
    } else {
      $html .= "<div class='banner-home pag_inicial' style='width: 100%'>";
    }
    while ($carrossel = mysql_fetch_object($carrossels)) {
      $html .= "<div style='background-image: url(\"$carrossel->URL\")' class='Imagem'></div>";
    }
    $html .= "</div>";
  }
}
$html .="<div class='container menu-cont'>";
$html .="<div class='InitTop  col-xs-4'>";
$html .="<div class='menu-bg-l'></div>";
$html .="<div>";
require("login.topo.php");
$html .="</div>";
$html .="<a href='$dados_relevantes->SITE/'><div class='Logo'></div></a>";
$html .="</div>";

$html .="<div class='Bandeiras col-xs-8'>";

$html .="<div class='Pouzada'>";
$html .= getLabel('LABEL_POUZADA', $_SESSION['LANGUAGE']);
$html .="</div>";

$html .= getInternacionalizacao();

$html .= getMenu($dados_relevantes->SITE);



$html .="</div>";

$html .="</div>";

$html .= "<div class='ResetFloat'></div>";




if (isset($_GET["actionType"])) {


  $url = $_GET["actionType"] . ".php";

  if (is_file($url)) {
    require($url);
  } else {
    if ($_GET["actionType"] == "") {
      require('pagina.inicial.php');
    } else {
      echo "<script>window.location.href = '/404.html';</script>";
      //die('Página não encontrada');
    }
  }
}

$html .="<div id='dialogDefault' style='display: none;'></div>";

require("footer.php");

$html .="</body>";
$html .="</html>";

$html = stripslashes($html);

$mobile = new mobileController();

if ($mobile->mobile) {
  print ($html);
  //echo 'sim';
} else {
  print ($html);
  //echo $html;
  //die;
}

$conn->close();
if ($_GET['actionType'] == "gerenciar.quartos.descricao" || $_GET['actionType'] == "gerenciar.dicas.descricao" || $_GET['actionType'] == "gerenciar.pacotes.descricao") {
  require("tinymce2.php");
} elseif ($_GET[actionType] == "gerenciar.termos.servico.edit") {
  require("tinymce.php");
} elseif ($_GET[actionType] == "reservas.analisa") {
  require("tinymce3.php");
}

?>

<script language='javascript' src='../script/analisa_reserva.js'></script>