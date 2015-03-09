<?php


	acessoDireto( "ADMINISTRADOR;" );
	$row = mysql_query("SELECT * FROM dados_relevantes");
	if(mysql_num_rows($row) != 0)
	{
		$row = mysql_fetch_object($row);
	}

	$erro = "";

	if ( !empty($_POST) && isset($_POST['ACTION']) ) 
	{
		$dta_fim_baixa    = formataDataForUSA($_POST["dta_fim_baixa"]);
		$dta_inicio_baixa = formataDataForUSA($_POST["dta_inicio_baixa"]);
		
		$dta_fim_media    = formataDataForUSA($_POST["dta_fim_media"]);
		$dta_inicio_media = formataDataForUSA($_POST["dta_inicio_media"]);
		
		$dta_fim_alta     = formataDataForUSA($_POST["dta_fim_alta"]);
		$dta_inicio_alta  = formataDataForUSA($_POST["dta_inicio_alta"]);
		
		mysql_query("UPDATE dados_relevantes SET 
		`DTA_INICIO_ALTA`='".$dta_inicio_alta."', 
		`DTA_FIM_ALTA`='".$dta_fim_alta."', 
		`DTA_INICIO_MEDIA`='".$dta_inicio_media."', 
		`DTA_FIM_MEDIA`='".$dta_fim_media."', 
		`DTA_INICIO_BAIXA`='".$dta_inicio_baixa."', 
		`DTA_FIM_BAIXA`='".$dta_fim_baixa ."'");
		
		echo "<script>alert('* ".getLabel('LABEL_ADD_SUCESSO_LABEL', $_SESSION['LANGUAGE'])."!')</script>";
		echo "<script>window.location = 'index.php?actionType=gerenciar.quartos.tipos';</script>";
		exit();

	} 

	else 

	{

		$erro = getLabel('ERRO_PREENCHER_TODOS_CAMPOS', $_SESSION['LANGUAGE']);

	}

	

	

	

	$pi = "<form name='formCpf' method='post' action='index.php?actionType=gerenciar.quartos.tipos.configuracao'>";

		$pi .= "<div class='ErroMessage'>* $erro!</div>";

		$pi .= "<br/>";

		

		$nom_extra = mysql_query("SELECT * FROM pacotes WHERE CODPACOTE='".$_GET['codpacote']."'");

		if(mysql_num_rows($nom_extra) != 0)

		{

			$nom_extra = mysql_fetch_object($nom_extra);

			$pi .= "<div class='TitleServName'><b>".getLabel('LABEL_NOM_PACOTE', $_SESSION['LANGUAGE']).":</b></div>";

			

			(string) $nome = getlinguagemdasessao();

			$pi .= "<div class='TitleServNameResult'>".$nom_extra->$nome."</div>";

			

		}

		$pi .= "<br/>";

		$pi .= "<div style='margin-bottom: 3px;'></div>";

	
		//alta temporada
		$pi .= "<div style='margin-bottom: 3px;'>".getLabel('LABEL_ALTA_TEMPORADA', $_SESSION['LANGUAGE'])."</div>";

		$pi .= "<div class='EntradaTextForm'>";

			if(!empty($_POST) && isset($_POST['ACTION']) )

			{

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_inicio_alta' name='dta_inicio_alta' value='".$_POST['dta_inicio_alta']."' maxlength='70' placeholder='".getLabel('LABEL_DTA_INICIO', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

			else

			{

				if( substr_count( $row->DTA_INICIO_ALTA, "-") == 2 )

				{

					$row->DTA_INICIO_ALTA = formataDataForBrazil($row->DTA_INICIO_ALTA);

				}

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_inicio_alta' name='dta_inicio_alta' value='$row->DTA_INICIO_ALTA' maxlength='70' placeholder='".getLabel('LABEL_DTA_INICIO', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

		$pi .= "</div>";

		

		$pi .= "<div style='margin-bottom: 3px;'></div>";

		$pi .= "<div class='EntradaTextForm'>";

			if(!empty($_POST) && isset($_POST['ACTION']) )

			{

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_fim_alta' name='dta_fim_alta' value='".$_POST['dta_fim_alta']."' maxlength='70' placeholder='".getLabel('LABEL_DTA_FIM', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

			else

			{

				if( substr_count( $row->DTA_FIM_ALTA, "-") == 2 )

				{

					$row->DTA_FIM_ALTA = formataDataForBrazil($row->DTA_FIM_ALTA);

				}

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_fim_alta' name='dta_fim_alta' value='$row->DTA_FIM_ALTA' maxlength='70' placeholder='".getLabel('LABEL_DTA_FIM', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

		$pi .= "</div>";

		
		$pi .= "<br/>";

		$pi .= "<div style='margin-bottom: 3px;'></div>";

	
		//media temporada
		$pi .= "<div style='margin-bottom: 3px;'>".getLabel('LABEL_MEDIA_TEMPORADA', $_SESSION['LANGUAGE'])."</div>";

		$pi .= "<div class='EntradaTextForm'>";

			if(!empty($_POST) && isset($_POST['ACTION']) )

			{

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_inicio_media' name='dta_inicio_media' value='".$_POST['dta_inicio_media']."' maxlength='70' placeholder='".getLabel('LABEL_DTA_INICIO', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

			else

			{

				if( substr_count( $row->DTA_INICIO_MEDIA, "-") == 2 )

				{

					$row->DTA_INICIO_MEDIA = formataDataForBrazil($row->DTA_INICIO_MEDIA);

				}

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_inicio_media' name='dta_inicio_media' value='$row->DTA_INICIO_MEDIA' maxlength='70' placeholder='".getLabel('LABEL_DTA_INICIO', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

		$pi .= "</div>";

		$pi .= "<div style='margin-bottom: 3px;'></div>";

		$pi .= "<div class='EntradaTextForm'>";

			if(!empty($_POST) && isset($_POST['ACTION']) )

			{

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_fim_media' name='dta_fim_media' value='".$_POST['dta_fim_media']."' maxlength='70' placeholder='".getLabel('LABEL_DTA_FIM', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

			else

			{

				if( substr_count( $row->DTA_FIM_MEDIA, "-") == 2 )

				{

					$row->DTA_FIM_MEDIA = formataDataForBrazil($row->DTA_FIM_MEDIA);

				}

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_fim_media' name='dta_fim_media' value='$row->DTA_FIM_MEDIA' maxlength='70' placeholder='".getLabel('LABEL_DTA_FIM', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

		$pi .= "</div>";
		
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		
		//baixa temporada
		$pi .= "<div style='margin-bottom: 3px;'>".getLabel('LABEL_BAIXA_TEMPORADA', $_SESSION['LANGUAGE'])."</div>";

		$pi .= "<div class='EntradaTextForm'>";

			if(!empty($_POST) && isset($_POST['ACTION']) )

			{

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_inicio_baixa' name='dta_inicio_baixa' value='".$_POST['dta_inicio_baixa']."' maxlength='70' placeholder='".getLabel('LABEL_DTA_INICIO', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

			else

			{

				if( substr_count( $row->DTA_INICIO_BAIXA, "-") == 2 )

				{

					$row->DTA_INICIO_BAIXA = formataDataForBrazil($row->DTA_INICIO_BAIXA);

				}

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_inicio_baixa' name='dta_inicio_baixa' value='$row->DTA_INICIO_BAIXA' maxlength='70' placeholder='".getLabel('LABEL_DTA_INICIO', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

		$pi .= "</div>";

		$pi .= "<div style='margin-bottom: 3px;'></div>";

		$pi .= "<div class='EntradaTextForm'>";

			if(!empty($_POST) && isset($_POST['ACTION']) )

			{

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_fim_baixa' name='dta_fim_baixa' value='".$_POST['dta_fim_baixa']."' maxlength='70' placeholder='".getLabel('LABEL_DTA_FIM', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

			else

			{

				if( substr_count( $row->DTA_FIM_BAIXA, "-") == 2 )

				{

					$row->DTA_FIM_BAIXA = formataDataForBrazil($row->DTA_FIM_BAIXA);

				}

				$pi .= "<input class='LiloginText' style='width: 250px'  type='text' id='dta_fim_baixa' name='dta_fim_baixa' value='$row->DTA_FIM_BAIXA' maxlength='70' placeholder='".getLabel('LABEL_DTA_FIM', $_SESSION['LANGUAGE'])."' onkeypress='return formataData(event, this);'/>";

			}

		$pi .= "</div>";
		

		$pi .= "<div style='margin-bottom: 3px;'></div>";

		$pi .= "<div><br/></div>";

		$pi .="<div><input type='hidden' name='ACTION' value='ACTION'/></div>";

		$pi .="<div><input class='BtnProprio' type='submit' value='".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."'/></div>";

		$pi .= "<div><br/></div>";

	

	$pi .= "</form>";

	
?>

