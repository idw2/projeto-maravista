<?php

	header("Content-Type: text/html; charset=ISO-8859-1");
	require_once("../server/Connection.class.php");
	require_once("../server/lib.php");

	$conn = new Connection();
	
	$params = $_POST["param"];
	$param = explode(';', $params);
	
	foreach( $param as $name => $value)
	{
		if( $value != '')
		{
			//exclue evento
			mysql_query("DELETE FROM eventos WHERE CODEVENTO='".$value."'");
			
			//pega o coddescricao
			$coddescricao = mysql_query("SELECT CODDESCRICAO FROM eventos_rel_descricao WHERE CODEVENTO='".$value."'");
			if(mysql_num_rows($coddescricao) != 0)
			{		
				$coddescricao = mysql_fetch_object($coddescricao);
				mysql_query("DELETE FROM eventos_rel_descricao WHERE CODEVENTO='".$value."' AND CODDESCRICAO='".$coddescricao->CODDESCRICAO."'");
				mysql_query("DELETE FROM descricao WHERE CODDESCRICAO='".$coddescricao->CODDESCRICAO."'");
			}
			
			//pega o codfoto
			$fotos = mysql_query("SELECT fotos.* FROM fotos
			INNER JOIN eventos_rel_fotos ON eventos_rel_fotos.CODFOTO=fotos.CODFOTO
			WHERE eventos_rel_fotos.CODEVENTO='".$value."'");
			
			if(mysql_num_rows($fotos) != 0)
			{
				
				while( $foto = mysql_fetch_object($fotos))
				{
					//aqui exclui as fotos
					if(file_exists($foto->URL))
					{
						/*
						@unlink($foto->URL);
						$foto->URL = str_replace("../", "", $foto->URL);
						$folder = explode("/"$foto->URL);
						$dir = "../".$folder[0]."/".$folder[1]."/".$folder[2];
						//aqui exclui o diretorio da foto
						if(is_dir($dir))
						{
							@rmdir($dir);
						}*/
						
					}
					
					mysql_query("DELETE FROM eventos_rel_fotos WHERE CODEVENTO='".$value."' AND CODFOTO='".$foto->CODFOTO."'");
					mysql_query("DELETE FROM fotos WHERE CODFOTO='".$foto->CODFOTO."'");
				}
				
			}
			
		}
	}
	/*
	if( $params != "" )
	{
		$param = explode(';', $params);
		
		if( @sizeof($param) >= 1)
		{
			foreach( $param as $name => $value)
			{
				//exclue evento
				mysql_query("DELETE FROM eventos WHERE CODEVENTO='".$value."'");
				
				//pega o coddescricao
				$coddescricao = mysql_query("SELECT CODDESCRICAO FROM eventos_rel_descricao WHERE CODEVENTO='".$value."'");
				if(mysql_num_rows($coddescricao) != 0)
				{
					$coddescricao = mysql_fetch_object($coddescricao);
					mysql_query("DELETE FROM eventos_rel_descricao WHERE CODEVENTO='".$value."' AND CODDESCRICAO='".$coddescricao->CODDESCRICAO."'");
					mysql_query("DELETE FROM descricao WHERE CODDESCRICAO='".$coddescricao->CODDESCRICAO."'");
				}
				
				//pega o codfoto
				$fotos = mysql_query("SELECT fotos.* FROM fotos
				INNER JOIN eventos_rel_fotos ON eventos_rel_fotos.CODFOTO=fotos.CODFOTO
				WHERE eventos_rel_fotos.CODEVENTO='".$value."'");
				
				if(mysql_num_rows($fotos) != 0)
				{
					
					while( $foto = mysql_fetch_object($fotos))
					{
						//aqui exclui as fotos
						if(file_exists($foto->URL))
						{
							@unlink($foto->URL)
							$foto->URL = str_replace("../", "", $foto->URL);
							$folder = explode("/"$foto->URL);
							$dir = "../".$folder[0]."/".$folder[1]."/".$folder[2];
							//aqui exclui o diretorio da foto
							if(is_dir($dir))
							{
								@mrdir($dir);
							}
						}		
						mysql_query("DELETE FROM eventos_rel_fotos WHERE CODEVENTO='".$value."' AND CODFOTO='".$foto->CODFOTO."'");
						mysql_query("DELETE FROM fotos WHERE CODFOTO='".$foto->CODFOTO."'");
					}
					
				}
				
			}
			
		}
	}
	*/
	$conn->close ();
		
	print($ref);
	

?>