<?php

header("Content-Type: text/html; charset=ISO-8859-1");
require_once("Connection.class.php");
//require_once("lib.php");

$conn = new Connection();

$params = $_POST["param"];


if (strlen($params) == 33) {
    echo auaua;
} else {

    $param = explode(';', $_POST["param"]);

    foreach ($param as $name => $value) {
        if ($value != '') {

            //exclui o pacote
            mysql_query("DELETE FROM pacotes WHERE CODPACOTE='{$value}'");

            $prds = mysql_query("SELECT * FROM pacotes_rel_data WHERE CODPACOTE='{$value}'");
            if (mysql_num_rows($prds) != 0) {
                while ($prd = mysql_fetch_object($prds)) {
                    mysql_query("DELETE FROM `datas` WHERE CODDTA='{$prd->CODDTA}'");
                }
            }

            mysql_query("DELETE FROM `pacotes_rel_datas` WHERE CODPACOTE='{$value}'");

            //pega o coddescricao
            $coddescricao = mysql_query("SELECT CODDESCRICAO FROM pacotes_rel_descricao WHERE CODPACOTE='{$value}'");
            if (mysql_num_rows($coddescricao) != 0) {
                $coddescricao = mysql_fetch_object($coddescricao);
                mysql_query("DELETE FROM pacotes_rel_descricao WHERE CODPACOTE='{$value}' AND CODDESCRICAO='{$coddescricao->CODDESCRICAO}'");
                mysql_query("DELETE FROM descricao WHERE CODDESCRICAO='{$coddescricao->CODDESCRICAO}'");
            }

            //pega o codfoto
            $fotos = mysql_query("SELECT fotos.* FROM fotos
			INNER JOIN pacotes_rel_fotos ON pacotes_rel_fotos.CODFOTO=fotos.CODFOTO
			WHERE pacotes_rel_fotos.CODPACOTE='{$value}'");

            if (mysql_num_rows($fotos) != 0) {

                while ($foto = mysql_fetch_object($fotos)) {
                    //aqui exclui as fotos
                    if (file_exists($foto->URL)) {

                        @unlink($foto->URL);
                        $foto->URL = str_replace("../", "", $foto->URL);
                        $folder = explode("/" . $foto->URL);
                        $dir = "../" . $folder[0] . "/" . $folder[1] . "/" . $folder[2];
                        //aqui exclui o diretorio da foto
                        if (is_dir($dir)) {
                            @rmdir($dir);
                        }
                    }

                    mysql_query("DELETE FROM pacotes_rel_fotos WHERE CODPACOTE='" . $value . "' AND CODFOTO='{$foto->CODFOTO}'");
                    mysql_query("DELETE FROM fotos WHERE CODFOTO='{$foto->CODFOTO}'");
                }
            }
        }
    }
}



$conn->close();

print($ref);
