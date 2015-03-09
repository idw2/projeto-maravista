<?php

session_start();

require("Connection.class.php");
require("Reserva.class.php");
require("lib.php");
require("PesquisaReserva.class.php");
require("ModelReserva.class.php");
require("RevisaReserva.class.php");

$conn = new Connection();

require("DAO.php");

$dtainicio = formataDataForUSA(trim($_POST["dtainicio"]));
$dtafim = formataDataForUSA(trim($_POST["dtafim"]));
$adulto = trim($_POST["adulto"]);
$crianca = trim($_POST["crianca"]);
$language = trim($_POST["language"]);
$crianca0a5 = trim($_POST["crianca0a5"]);
$crianca6a12 = trim($_POST["crianca6a12"]);
$crianca12 = trim($_POST["crianca12"]);
$codquartotipo = trim($_POST["codquartotipo"]);
$codpacote = trim($_POST["codpacote"]);

function Error($erroname) {

    $html .= "<div id='inline1' style='display: block;'>";
    $html .= "<p>";
    $html .= "<form id='formReserva' name='form1' method='post' novalidate action='index.php?actionType=reservas.forma.pgto.cielo' style='max-width: initial'>";
    $html .= "<div class='ContainerAcomodacao pag-deposito'>";
    $html .= "<p>";
    $html .="<div class='sep-pattern-1'></div>";
    $html .="<center>";
    $html .="<h1 class='alert-green' style='font-size: 2.4rem; padding: 98px;'>";
    $html .= getLabel($erroname, $_SESSION['LANGUAGE']);
    $html .="</h1>";
    $html .="</center>";

    $html .="<div class='sep-pattern-1'></div>";
    $html .= "</p>";
    $html .= "</div>";
    $html .= "<div><a class='BtnFiltro small full-width push-right' href='./pacotes-e-promocoes'>" . getLabel('LABEL_PACOTES', $_SESSION['LANGUAGE']) . "</a></div>";
    $html .= "</form>";
    $html .= "</p>";
    $html .= "</div>";
    return utf8_encode($html);
}

$t1 = mysql_num_rows(mysql_query("SELECT * FROM dados_relevantes WHERE DTA_INICIO_ALTA <= '{$dtainicio}' AND DTA_FIM_ALTA >= '{$dtafim}'"));
$t2 = mysql_num_rows(mysql_query("SELECT * FROM dados_relevantes WHERE DTA_INICIO_MEDIA <= '{$dtainicio}' AND DTA_FIM_MEDIA >= '{$dtafim}'"));
$t3 = mysql_num_rows(mysql_query("SELECT * FROM dados_relevantes WHERE DTA_INICIO_BAIXA <= '{$dtainicio}' AND DTA_FIM_BAIXA >= '{$dtafim}'"));
$t4 = "{$t1}{$t2}{$t3}";

if ($t4 == "000") {
    echo Error("LABEL_DTA_RESERVAS_NOT");
    return;
}

function arrayDtas($objQuery) {
    if (mysql_num_rows($objQuery) != 0) {
        while ($data = mysql_fetch_object($objQuery)) {

            $_diferenca = mysql_fetch_object(mysql_query("SELECT DATEDIFF('{$data->DTAFIM}', '{$data->DTAINICIO}') AS DiffDate"));

            $_dtainicio = $data->DTAINICIO;
            $_dtafim = $data->DTAFIM;

            for ($i = 0; $i < ((int) $_diferenca->DiffDate + 1); $i++) {

                if ($_dtainicio == $data->DTAINICIO) {
                    $_checkin = "entrada";
                } else if ($_dtafim == $data->DTAINICIO) {
                    $_checkin = "saida";
                } else {
                    $_checkin = "estadia";
                }
                #rotina para popular `reservas_rel_datas_pacotes`
                if (!mysql_num_rows(mysql_query("SELECT * FROM  `reservas_rel_datas_pacotes` WHERE DTA='{$data->DTAINICIO}' AND CODPACOTE='{$data->CODPACOTE}'"))) {
                    mysql_query("INSERT INTO `reservas_rel_datas_pacotes` VALUES ('{$data->CODPACOTE}','{$data->DTAINICIO}','{$_checkin}')");
                }
                $arrDtas[] = $data->DTAINICIO;
                $_adiantar = mysql_query("SELECT DATE_ADD('{$data->DTAINICIO}', INTERVAL 1 DAY) as DTA");
                $_adiantar = mysql_fetch_object($_adiantar);
                $data->DTAINICIO = $_adiantar->DTA;
            }
        }
    }

    return array_unique($arrDtas);
}

function sequenciaDtas($dinicio, $dfim) {

    $di = $dinicio;
    $df = $dfim;
    $arrDtas[] = $dinicio;

    #echo "Teste 14: ".rand();
    #echo "<BR/>";
    #echo "SELECT DATEDIFF('{$df}','{$di}') AS DiffDate";
    #die();

    while ($di != $dfim) {
        #"SELECT DATE_ADD('{$di}', INTERVAL 1 DAY) as DTA<br/>";

        $adianta1 = mysql_query("SELECT DATE_ADD('{$di}', INTERVAL 1 DAY) as DTA");
        $adianta1 = mysql_fetch_object($adianta1);
        $di = $adianta1->DTA;

        if (!in_array($di, $arrDtas)) {
            $arrDtas[] = $di;
        }
    }

    return $arrDtas;
}

$datas = mysql_query("SELECT pacotes.CODPACOTE, datas.DTAINICIO, datas.DTAFIM FROM 
	datas 
	INNER JOIN pacotes_rel_datas ON pacotes_rel_datas.CODDTA=datas.CODDTA
	INNER JOIN pacotes ON pacotes.CODPACOTE=pacotes_rel_datas.CODPACOTE
	WHERE datas.CODDTA!=''
	AND datas.STATUS=1
	AND (pacotes.STATUS=1 OR pacotes.STATUS=0)
	AND pacotes.CODQUARTOTIPO='{$codquartotipo}'
	GROUP BY datas.CODDTA
	ORDER BY datas.DTAINICIO ASC");
     
        
        
        
if (mysql_num_rows($datas)) {

    $arrDtas = arrayDtas($datas);

    (int) $qntd_quartos = mysql_num_rows(mysql_query("SELECT * FROM quartos
		INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
		INNER JOIN quartos_tipo ON quartos_tipo.CODQUARTOTIPO=quartos_rel_quartos_tipo.CODQUARTOTIPO
		WHERE quartos_tipo.CODQUARTOTIPO='{$codquartotipo}' 
		AND quartos_tipo.STATUS=1 
		AND quartos.STATUS=1
		GROUP BY quartos.CODQUARTO"));

    (int) $qntd_quartos_reservados = mysql_num_rows(mysql_query("SELECT * FROM reservas
		INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
		INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
		WHERE reservas_rel_datas.DTA  BETWEEN '{$dtainicio}' AND '{$dtafim}' 
		AND reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' AND reservas.STATUS=1
		GROUP BY reservas.CODRESERVA"));

    (int) $saida = mysql_num_rows(mysql_query("SELECT * FROM reservas
		INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
		INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
		WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
		AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
		AND reservas_rel_datas.DTA='{$dtainicio}' AND reservas_rel_datas.CHECK_IN='entrada'
		GROUP BY reservas.CODRESERVA"));

    if ($saida) {

        if ($qntd_quartos == $saida) {
            echo Error("LABEL_DTA_RESERVAS");
            return;
        }
    } else {

        $entrada = mysql_num_rows(mysql_query("SELECT * FROM reservas
			INNER JOIN reservas_rel_tipo_quarto ON reservas_rel_tipo_quarto.CODRESERVA=reservas.CODRESERVA
			INNER JOIN reservas_rel_datas ON reservas_rel_datas.CODRESERVA=reservas.CODRESERVA
			WHERE reservas_rel_tipo_quarto.CODTIPOQUARTO='{$codquartotipo}' 
			AND (reservas.STATUS=1 OR reservas.STATUS=3 OR reservas.STATUS=4 OR reservas.STATUS=5)
			AND (reservas_rel_datas.DTA='{$dtafim}' AND reservas_rel_datas.CHECK_IN='saida')"));

        if ($qntd_quartos == $entrada) {
            echo Error("LABEL_DTA_RESERVAS");
            return;
        }
    }

    $sequenciaDtas = sequenciaDtas($dtainicio, $dtafim);

    $_in = "('" . implode("','", $sequenciaDtas) . "')";

    $_validando = mysql_num_rows(mysql_query("SELECT reservas_rel_datas_pacotes.* FROM reservas_rel_datas_pacotes
		INNER JOIN pacotes ON pacotes.CODPACOTE=reservas_rel_datas_pacotes.CODPACOTE
		INNER JOIN pacotes_rel_datas ON pacotes.CODPACOTE=pacotes_rel_datas.CODPACOTE
		INNER JOIN datas ON datas.CODDTA=pacotes_rel_datas.CODDTA 
		WHERE pacotes.CODQUARTOTIPO='{$codquartotipo}'
		AND reservas_rel_datas_pacotes.CHECK_IN='estadia'
		AND reservas_rel_datas_pacotes.DTA IN {$_in}
		GROUP BY reservas_rel_datas_pacotes.DTA"));

    if ($_validando) {
        echo Error("LABEL_DTA_RESERVAS");
        return;
    } else {
        require("valida_hospedagem2_continue.php");
    }
} else {

    require("valida_hospedagem2_continue.php");
}



$conn->close();
?>


