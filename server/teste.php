<?php

$adulto = 1;
$crianca12 = 1;
$crianca6 = 0;
$crianca5 = 1;

$adulto_bk = $adulto;
$crianca12_bk = $crianca12;
$crianca6_bk = $crianca6;
$crianca5_bk = $crianca5;

echo "adulto: ".$adulto;
  echo "<br />";
  echo "soma: ".$soma;
  echo "<br />";
  echo "<br />";
  
  echo "crianca12: ".$crianca12;
  echo "<br />";
  echo "crianca6: ".$crianca6;
  echo "<br />";
  echo "crianca5: ".$crianca5;
  echo "<br/>----------<br/>";

$soma = ($crianca12+$crianca6+$crianca5);

if($adulto == 1){
    if($soma >= 1){

      if($crianca12 >= 1 || $crianca6 >= 1 || $crianca12 >= 1){

      }

      if($crianca5 >= 1){
        $adulto = 2;
        $crianca5 = $crianca5-1;
        
        $crianca12 = $crianca12_bk;
        $crianca6 = $crianca6_bk;
      
        
      }
      if($crianca6 >= 1){
          $adulto = 2;
          $crianca6 = $crianca6-1;
          
          $crianca12 = $crianca12_bk;
          $crianca5 = $crianca5_bk;

          
      }
      
      if($crianca12 >= 1){
          $adulto = 2;
          $crianca12 = $crianca12-1;
//echo "asd";
          $crianca5 = $crianca5_bk;
          $crianca6 = $crianca6_bk;
        }else{
          echo "asd";
        }


    }else{

      echo "deu ruim";

    }
    
  }
  
  echo "<br/>----------<br/>";
  echo "adulto: ".$adulto;
  echo "<br />";
  echo "soma: ".$soma;
  echo "<br />";
  echo "<br />";
  
  echo "crianca12: ".$crianca12;
  echo "<br />";
  echo "crianca6: ".$crianca6;
  echo "<br />";
  echo "crianca5: ".$crianca5;
  echo "<br />";
  
?>