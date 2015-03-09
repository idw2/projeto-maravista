<?php
 $nomedoarquivozip     = $_POST['nomedoarquivozip'];
$zip = new ZipArchive;
 
if ($zip->open($nomedoarquivozip) === TRUE) {
 
    $zip->extractTo('./');
 
    $zip->close();
 
    echo 'ok';
 
} else {
 
    echo 'failed';
 
}
 
?>