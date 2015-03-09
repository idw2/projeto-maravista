<?php

	header("Content-Type: text/html; charset=ISO-8859-1");
	require_once("../server/Connection.class.php");
	require_once("../server/lib.php");

	$conn = new Connection();
	/*
	SOMAQUARTOS=1
	SOMATOTAL=300,00
	SOMACRIANCAS=0
	SOMAPESSOAS=2
	SOMAADULTOS=2
	SOMACRIANCAS_ACIMA12=0
	SOMACRIANCAS_6A12=0
	SOMACRIANCAS_5A=0
	SOMACODQUARTO=F287E1D49FF83E175CFB390289B9789D;
	SOMAADULTOSEXCEDENTES=0
	SOMACAPACIDADE=2
	SOMADATAINICIOFINALIZE=25/11/2013
	SOMADATAFIMFINALIZE=26/11/2013
	*/
	
	//conferir se o total da capacidade dos quartos corresponde ao total ou 1 a menos de solicitação de reservas 
	
	
	//formataDataForUSA
	
	$somadatainiciofinalize = formataDataForUSA($_POST['SOMADATAINICIOFINALIZE']);
	$somadatafimfinalize = formataDataForUSA($_POST['SOMADATAFIMFINALIZE']);
	
	$compara_datas = mysql_query("SELECT DATEDIFF('$somadatafimfinalize','$somadatainiciofinalize') as DTA");
	
	$erro = "";
	
	if(mysql_num_rows($compara_datas) != 0)
	{
		$compara_datas = mysql_fetch_object($compara_datas);
		
		if( (int) $compara_datas->DTA < 1 )
		{
			$erro = "Data inicio inferior a data final ou data para reserva não permitido";
		}
		
	}
	
	if($erro == "" && ((int)$_POST['SOMAPESSOAS'] < ((int)$_POST['SOMAADULTOS'] + (int)$_POST['SOMACRIANCAS_ACIMA12'] + (int)$_POST['SOMACRIANCAS_6A12'] + (int)$_POST['SOMACRIANCAS_5A'])))
	{
		$erro = "A quantidade de pessoas não corresponde a quantidade informada de crianças e adultos";
	}
	
	if( $erro == "" && $_POST['SOMACAPACIDADE'] < (int)$_POST['SOMAPESSOAS'])
	{
		$erro = "A capacidade dos quartos é inferior ao número de pessoas informada";
	}
	
	print("$erro");
	
	//var_dump($_POST);
	
	/*
	$quartos = mysql_query("SELECT VALOR FROM quartos WHERE CODQUARTO='".$_POST['CODQUARTO']."'");
	
	if(mysql_num_rows($quartos) != 0)
	{
		
		$quarto = mysql_fetch_object($quartos);
		$valor = (int)limpaValorReal($quarto->VALOR);
		$total_geral = (int)limpaValorReal($_POST['TOTAL']);
		
		(int) $excedente = $_POST['EXCEDENTE'];
		(int) $sQuartos = $_POST['SQUARTOS'];
		(int) $adultos = $_POST['ADULTOS'];
		(int) $excvalor = (int)limpaValorReal($_POST['EXCVALOR']);
		
		//echo $_POST['RESTO'];
		//return;
		
		
		(string) $pieces = explode(';',$_POST['SOMACODQUARTO']);
		
		$i=0;
		foreach( $pieces as $name => $value)
		{
			if( $value != "")
			{
				($i==0)
				? $piece = "'$value'"
				: $piece .= ",'$value'";
				
				$i++;
			}
		}
		
		if( $piece != "")
		{
			$qv = mysql_query("SELECT SUM(VALOR) as TOTAL FROM quartos WHERE CODQUARTO IN($piece)");
			if(mysql_num_rows($qv) !=0)
			{
				$qv = mysql_fetch_object($qv);
				(int)$qvt = $qv->TOTAL;
			}
		}
		else
		{
			$qvt = 0;
		}
		
		(int)$diff = ( (int)$adultos - ((int)$sQuartos*2));
		if( (int)$qvt == 0 || $qvt == "" || $qvt == null)
		{
			$zerar = "SIM";
			(int) $percento = 0;
		}
		else
		{
			$zerar = "NAO";
			(int) $percento = round((($qvt/100)*30)*$excedente);
		}
		
		$xx = ( (int)$adultos - ((int)$sQuartos*2));
		
		if((int)$excedente > 0 && $xx > 0)
		{
			
			(int) $total = round( $qvt + $percento );
			$ref = $_POST['CODQUARTO'].":".formataReais($percento).":".formataReais($total).":$zerar:$diff";
		}
		else
		{
			(int) $total = round( $qvt );
			$ref = $_POST['CODQUARTO'].":0,00:".formataReais($total).":$zerar:$diff";
		}
		
		
	}
	else
	{
		$ref = $_POST['CODQUARTO'].":0,00:0,00:$zerar:$diff";
	}
	*/
	$conn->close ();
		
	print($ref);
	

?>