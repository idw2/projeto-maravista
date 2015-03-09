<?php

	acessoDireto( "ADMINISTRADOR;" );

	set_time_limit(0);

	$erro = "";
	
	if ( $_POST['ACTION'] == "ACTION" ) 
	{
	
		
		$codreserva = strtoupper(md5(getTimestamp()));
		
		$nQuartos=0;
		$cod["select_quarto_tipo_1"] = "";	
		
		$pessoas = 0;
		$adultos = 0;
		$crianca_5 = 0;
		$crianca_6a12 = 0;
		$crianca_12 = 0;
		
		//for( $i=1;$i<5;$i++ )
		for( $i=1;$i<2;$i++ )
		{
			$select_quarto_tipo = "select_quarto_tipo_".$i;
			
			
			if ($_POST[$select_quarto_tipo]) 
			{ 		
				$sqt =  explode("_",$_POST[$select_quarto_tipo]);
		
				mysql_query("INSERT INTO `reservas_rel_tipo_quarto` (`CODRESERVA`,`CODTIPOQUARTO`)VALUES('$codreserva','$sqt[0]')");
				mysql_query("INSERT INTO `reservas_rel_quartos` (`CODRESERVA`,`CODQUARTO`,`REFERENCIA`)VALUES('$codreserva','$sqt[1]','$i')");
				
				
				if($i==1)
				{
					$cod["select_quarto_tipo_1"] = $sqt[0];
				}				
				
				for( $j=1;$j<11;$j++ )
				{
					$quarto_text_name = "quarto_".$j."_text_name_".$i;
					$select_guest_faixa_etaria = "select_guest_".$j."_faixa_etaria_".$i;
					if( $_POST[$quarto_text_name] != "")
					{
						$pessoas++;
						
						if((int)$_POST[$select_guest_faixa_etaria] == 0)
						{
							$adultos++;	
						}
						elseif((int)$_POST[$select_guest_faixa_etaria] == 1)
						{
							$crianca_5++;	
						}
						elseif((int)$_POST[$select_guest_faixa_etaria] == 2)
						{
							$crianca_6a12++;	
						}
						elseif((int)$_POST[$select_guest_faixa_etaria] == 3)
						{
							$crianca_12++;	
						}						
						
						$codguest = strtoupper(md5(getTimestamp().$j.$_POST[$select_quarto_tipo]));
						mysql_query("INSERT INTO `reservas_rel_guest`(`CODRESERVA`,`CODGUEST`,`REFERENCIA`)VAlUES('$codreserva','$codguest','$i')");
						mysql_query("INSERT INTO `guest` (`CODGUEST`,`NOME`,`FAIXA_ETARIA`)VALUES('$codguest','".$_POST[$quarto_text_name]."','".$_POST[$select_guest_faixa_etaria]."')");
					}
				
				}
				$nQuartos++;
				
			}
			
		}
		
		$n_conhecimento = mysql_query("SELECT * FROM reservas");
		(int) $n = mysql_num_rows($n_conhecimento);
		$n_conhecimento = ( $n + 1 );
		$n_conhecimento = compliteCod($n_conhecimento, $cod);
		
		$codpessoa = strtoupper(md5(getTimestamp().$codreserva));	
		$codlogin = strtoupper(md5(getTimestamp().$codpessoa));	
		$codtelefone = strtoupper(md5(getTimestamp().$codlogin));	
		$codvalor = strtoupper(md5(getTimestamp().$codtelefone));	
		
		mysql_query("INSERT INTO `reservas_rel_valor` (`CODRESERVA`,`CODVALOR`)VALUES('$codreserva','$codvalor')");
		mysql_query("INSERT INTO `valor` (`CODVALOR`,`ADULTO_PERC`,`ADULTO_PERC_MULT`,`ADULTO_VALOR`,`ADULTO_EXCEDENTE`,`CRIANCA_5_PERC`,`CRIANCA_5_PERC_MULT`,`CRIANCA_5_VALOR`,`CRIANCA_5_EXCEDENTE`,`CRIANCA_6A12_PERC`,`CRIANCA_6A12_PERC_MULT`,`CRIANCA_6A12_VALOR`,`CRIANCA_6A12_EXCEDENTE`,`CRIANCA_12_PERC`,`CRIANCA_12_PERC_MULT`,`CRIANCA_12_VALOR`,`CRIANCA_12_EXCEDENTE`,`VALOR_BRUTO`,`VALOR_DESC`,`VALOR_ACRESCIMO`,`ACRESCIMO_PERC`,`VALOR_SINAL`,`VALOR_TOTAL`,`FORMA_PGTO`,`PGTO_SINAL`,`PGTO_RESTANTE`,`STATUS`,`N_CONHECIMENTO`)VALUES('$codvalor','".$_POST["ADULTO_PERC"]."','".$_POST["ADULTO_PERC_MULT"]."','".$_POST["ADULTO_VALOR"]."','".$_POST["ADULTO_EXCEDENTE"]."','".$_POST["CRIANCA_5_PERC"]."','".$_POST["CRIANCA_5_PERC_MULT"]."','".$_POST["CRIANCA_5_VALOR"]."','".$_POST["CRIANCA_5_EXCEDENTE"]."','".$_POST["CRIANCA_6A12_PERC"]."','".$_POST["CRIANCA_6A12_PERC_MULT"]."','".$_POST["CRIANCA_6A12_VALOR"]."','".$_POST["CRIANCA_6A12_EXCEDENTE"]."','".$_POST["CRIANCA_12_PERC"]."','".$_POST["CRIANCA_12_PERC_MULT"]."','".$_POST["CRIANCA_12_VALOR"]."','".$_POST["CRIANCA_12_EXCEDENTE"]."','".$_POST["VALOR_BRUTO"]."','".$_POST["VALOR_DESC"]."','".$_POST["VALOR_ACRESCIMO"]."','".$_POST["ACRESCIMO_PERC"]."','".$_POST["VALOR_SINAL"]."','".$_POST["VALOR_TOTAL"]."','".$_POST["FORMA_PGTO"]."','".$_POST["PGTO_SINAL"]."','".$_POST["PGTO_RESTANTE"]."','0','".$n_conhecimento."')");
		
		$login = $_POST["email"];
		$senha = strtoupper(md5("12345"));
		
		$existe_login = mysql_query("SELECT * FROM login WHERE LOGIN = '$login'");
		
		if(mysql_num_rows($existe_login) == 0)
		{
			mysql_query("INSERT INTO `reservas_rel_pessoa` (`CODRESERVA`,`CODPESSOA`)VALUES('$codreserva','$codpessoa')");
			mysql_query("INSERT INTO `login` (`CODLOGIN`,`LOGIN`,`SENHA`,`PAPEL`,`STATUS`,`OWNER`) VALUES('$codlogin','$login','$senha','GUEST;','0','B4EC91ED6E6C92AC52099D19C0B1A40E')");
			mysql_query("INSERT INTO `login_rel_pessoa`(`CODPESSOA`,`CODLOGIN`)VALUES('$codpessoa','$codlogin')");
			mysql_query("INSERT INTO `pessoa` (`CODPESSOA`,`NOME`,`EMAIL`,`OWNER`) VALUES ('$codpessoa','".$_POST["nome_empresa"]."','".$_POST["email"]."','B4EC91ED6E6C92AC52099D19C0B1A40E')");
			mysql_query("INSERT INTO `pessoa_rel_telefones` (`CODPESSOA`,`CODTELEFONE`)VALUES('$codpessoa','$codtelefone')");
			mysql_query("INSERT INTO `telefones` (`CODTELEFONE`,`TELEFONE`,`STATUS`,`OWNER`)VALUES('$codtelefone','".$_POST["telefone"]."','1','B4EC91ED6E6C92AC52099D19C0B1A40E')");
		}
		else
		{
			$existe_login = mysql_fetch_object($existe_login);
			$pessoa = mysql_query("SELECT pessoa.*, login.* FROM pessoa
			INNER JOIN login_rel_pessoa ON pessoa.CODPESSOA=login_rel_pessoa.CODPESSOA
			INNER JOIN login ON login_rel_pessoa.CODLOGIN=login.CODLOGIN
			WHERE login.CODLOGIN='$existe_login->CODLOGIN'");
			
			if( mysql_num_rows($pessoa) != 0)
			{
				$pessoa = mysql_fetch_object($pessoa);
				$codpessoa = $pessoa->CODPESSOA;
				mysql_query("UPDATE pessoa SET NOME='".$_POST["nome_empresa"]."' WHERE CODPESSOA='{$pessoa->CODPESSOA}'");
				mysql_query("INSERT INTO `reservas_rel_pessoa` (`CODRESERVA`,`CODPESSOA`)VALUES('$codreserva','$codpessoa')");
				mysql_query("INSERT INTO `pessoa_rel_telefones` (`CODPESSOA`,`CODTELEFONE`)VALUES('$codpessoa','$codtelefone')");
				mysql_query("INSERT INTO `telefones` (`CODTELEFONE`,`TELEFONE`,`STATUS`,`OWNER`)VALUES('$codtelefone','".$_POST["telefone"]."','1','B4EC91ED6E6C92AC52099D19C0B1A40E')");
			}
		
		}
		
		$observacoes = stripslashes( $_POST["observacoes"] );
		$observacoes = str_replace("'", '&lsquo;', $observacoes);
			
		mysql_query("INSERT INTO `reservas` (`CODRESERVA`,`DTAINICIO`,`DTAFIM`,`PESSOAS`,`ADULTOS`,`CRIANCA5A`,`CRIANCA6A12`,`CRIANCA12A`,`STATUS`,`QUARTOS`,`OBSERVACOES`,`PREFERENCIA_IDIOMA`,`RESERVAS_EXTERNAS`) VALUES('$codreserva','".formataDataForUSA($_POST["datainicio"])."','".formataDataForUSA($_POST["datafim"])."','".$pessoas."','".$adultos."','".$crianca_5."','".$crianca_6a12."','".$crianca_12."','".$_POST["status"]."','$nQuartos','$observacoes','".$_SESSION["LANGUAGE"]."','1')");	
		
		
		echo "<script>alert('* ".getLabel('LABEL_ADD_SUCESSO_LABEL', $_SESSION['LANGUAGE'])."!')</script>";

		//echo "<script>window.location = 'index.php?actionType=gerenciar.reservas.externas';</script>";
		echo "<script>window.location = 'index.php?actionType=gerenciar.reservas';</script>";
		exit();

	} 

	if($erro == "")

	{

		$erro = getLabel('ERRO_PREENCHER_TODOS_CAMPOS', $_SESSION['LANGUAGE']);

	}
	
	

	$pi = "<form name='formReservaExternal' id='formReservaExternal' onsubmit='return false' method='post' action='index.php?actionType=gerenciar.reservas.externas.add2'>";
	
	/* debug
		if($_POST)
		{
			foreach($_POST as $name => $value)
			{
				$pi .= "<div class='ErroMessage'>$name: $value</div>";
				
			}
		}
		*/
		$pi .= "<div class='ErroMessage'>* $erro!</div>";
		$pi .= "<br/>";
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		$pi .= "<div style='margin-bottom: 3px;'></div>";
		$pi .="<div class='Acomodacoes painel-label'>";
			$pi .= getLabel('LABEL_RESP_RESERVA', $_SESSION['LANGUAGE']);
			$pi .="<br/><br/>";
		$pi .="</div>";
		
		$pi .= "<div class='EntradaText' style='margin-bottom: 3px'>";
			if( $_POST['nome_empresa'] == "")
			{
				$pi .= "<input type='text' value='".$_POST['nome_empresa']."' style='width: 328px;' class='LiloginText' name='nome_empresa' id='nome_empresa' maxlength='100' placeholder='".getLabel('LABEL_NOME_EMPRESA', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<b>".getLabel('LABEL_NOME_EMPRESA', $_SESSION['LANGUAGE'])."</b>: ".$_POST['nome_empresa'];
				$pi .= "<input type='hidden' name='nome_empresa' id='nome_empresa' value='".$_POST['nome_empresa']."'/>";
			}
		$pi .= "</div>";

		$pi .= "<div class='EntradaText' style='margin-bottom: 3px'>";
			if( $_POST['email'] == "")
			{
				$pi .= "<input type='text' value='".$_POST['email']."' style='width: 328px;' class='LiloginText' name='email' id='email' maxlength='50' onchange='caixaBaixa(this.id)' onkeypress='caixaBaixa(this.id)'  placeholder='E-mail'/>";
			}
			else
			{
				$pi .= "<b>E-mail</b>: ".$_POST['email']; 
				$pi .= "<input type='hidden' class='LiloginText' name='email' id='email' value='".$_POST['email']."' />";
			}
		$pi .= "</div>";

		$pi .= "<div class='EntradaText' style='margin-bottom: 3px'>";
			if( $_POST['telefone'] == "")
			{
				$pi .= "<input type='text' value='".$_POST['telefone']."' style='width: 328px;' class='LiloginText' name='telefone' id='telefone' maxlength='70'  placeholder='".getLabel('LABEL_FONE_CEL', $_SESSION['LANGUAGE'])."'/>"; 
			}
			else			
			{	
				$pi .= "<b>".getLabel('LABEL_FONE_CEL', $_SESSION['LANGUAGE'])."</b>: ".$_POST['telefone']; 
				$pi .= "<input type='hidden' name='telefone' id='telefone' value='".$_POST['telefone']."' />"; 
			}
		$pi .= "</div><br/>";
		
		$pi .= "<div class='LabelAcomodacaoTitle left'><b>decolar/booking</div><br/>";
		
		$pi .= "<div class='EntradaText' style='margin-bottom: 3px'>";

			$pi .= "<select name='status' id='status' class='LiloginText' size='3'>";
				
				switch((int)$_POST["status"])
				{
					case 3:
						$stt3 = "selected";
					break;
					case 4:
						$stt4 = "selected";
					break;
					case 5:
						$stt5 = "selected";
					break;
				}
				//$pi .= "<option value=''>--</option>";
				$pi .= "<option value='3' $stt3>booking.com</option>";
				$pi .= "<option value='4' $stt2>decolar.com</option>";
				$pi .= "<option value='5' $stt5>outros...</option>";
				
			$pi .= "</select>";
			
		$pi .= "</div>";
		$pi .= "<div class='EntradaText' style='margin-bottom: 3px'>";
			
			if( $_POST["datainicio"] == "" )
			{
				$pi .= "<input type='text' name='datainicio' id='datainicio' class='LiloginText dtaCalendario' value='".$_POST['datainicio']."' onkeypress='return formataData(event, this);' placeholder='".getLabel('LABEL_CHEGADA', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<b>".getLabel('LABEL_CHEGADA', $_SESSION['LANGUAGE'])."</b>: ".$_POST["datainicio"];
				$pi .= "<input type='hidden' name='datainicio' id='datainicio' value='".$_POST["datainicio"]."'/>";
			}
		$pi .= "</div>";
		$pi .= "<div class='EntradaText' style='margin-bottom: 3px'>";
			
			if( $_POST["datafim"] == "" )
			{
				$pi .= "<input type='text' name='datafim' id='datafim' class='LiloginText dtaCalendario' value='".$_POST['datafim']."' onkeypress='return formataData(event, this);' placeholder='".getLabel('LABEL_SAIDA_FORM', $_SESSION['LANGUAGE'])."'/>";
			}
			else
			{
				$pi .= "<b>".getLabel('LABEL_SAIDA_FORM', $_SESSION['LANGUAGE'])."</b>: ".$_POST['datafim'];
				$pi .= "<input type='hidden' name='datafim' id='datafim' value='".$_POST['datafim']."'/>";
			}
			
		$pi .= "</div>";
		
		
		/*for($i=1;$i<5;$i++)*/
		for($i=1;$i<2;$i++)
		{
		
			$reserva->DTAINICIO = formataDataForUSA($_POST["datainicio"]);
			$reserva->DTAFIM = formataDataForUSA($_POST["datafim"]);
			
			/*
			 * checa por meio das datas se existe o quarto da suite em questao ocupado
			 */
			
			$arrs = mysql_query("SELECT qts.CODQUARTO FROM quartos AS qts 
				INNER JOIN reservas_rel_quartos AS rrq ON rrq.CODQUARTO=qts.CODQUARTO 
				INNER JOIN reservas AS rsv ON rrq.CODRESERVA=rsv.CODRESERVA 
				WHERE 
				rsv.DTAINICIO BETWEEN '$reserva->DTAINICIO' AND '$reserva->DTAINICIO' 
				AND 
				rsv.DTAFIM BETWEEN '$reserva->DTAFIM' AND '$reserva->DTAFIM' 
				AND 
				(rsv.STATUS>=1 OR rsv.STATUS=3 OR rsv.STATUS=4 OR rsv.STATUS=5 OR rsv.STATUS=6 ) 
				");
			
			/*
			 * prepara uma string com chaveamento dos quartos da categoria em questao que nao pode ser
			 * ocupado pois ja possui visitantes
			 */
			$emenda = "";		
			if( mysql_num_rows($arrs) != 0)
			{
				while( $arr = mysql_fetch_object($arrs))
				{
					$emenda .= "'$arr->CODQUARTO'";
				}
			}
			
			/*
			 * monta string com as chaves e um not in mysql pra separar por criterios
			 * foi feito desta maneira pois nem o BETWEEN juntamente com SELECT e NOT IN estao funcionando corretamente 
			 */
			if( $emenda != "" )
			{
				$emenda = str_replace("''","','", $emenda);
				$emenda = "AND quartos.CODQUARTO NOT IN($emenda)";
			}
			$quarto_tipo = mysql_query("
				SELECT 
					quartos_tipo.CODQUARTOTIPO, 
					quartos_tipo.NOME as TIPO, 
					quartos_tipo.SIGLA, 
					quartos.CODQUARTO, 
					quartos.NOME
				FROM 
					quartos
				INNER JOIN quartos_rel_quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTO=quartos.CODQUARTO
				INNER JOIN quartos_tipo ON quartos_rel_quartos_tipo.CODQUARTOTIPO=quartos_tipo.CODQUARTOTIPO
				WHERE quartos.STATUS=1 AND quartos_tipo.STATUS=1
				$emenda 
				ORDER BY (quartos_tipo.VALOR+0),quartos.NOME ASC
			");
		
			if(mysql_num_rows($quarto_tipo) != 0)
			{
				//$pi .= "<div class='LabelAcomodacaoTitle left'><b>".getLabel('LABEL_ACOMODACAO', $_SESSION['LANGUAGE'])."($i)</div><br/>";
				$pi .= "<div class='LabelAcomodacaoTitle left'><b>".getLabel('LABEL_ACOMODACAO', $_SESSION['LANGUAGE'])."</div><br/>";
				$pi .= "<div class='EntradaText' style='margin-bottom: 3px'>";
					$pi .= "<select style='width: 328px;' name='select_quarto_tipo_$i' id='select_quarto_tipo_$i' class='LiloginText'>";
						$pi .= "<option value=''>--</option>";
						while( $qtipo = mysql_fetch_object($quarto_tipo))
						{
							$pi .= "<option value='$qtipo->CODQUARTOTIPO"."_"."$qtipo->CODQUARTO'>($qtipo->SIGLA/$qtipo->TIPO) $qtipo->NOME</option>";
						}
					$pi .= "</select>";
				$pi .= "</div>";
				
				$pi .= "<ol class='guest_$i'>";
					for($j=1;$j<6;$j++)
					{

						$pi .= "<li>";
							
							$pi .= "<table>";
								$pi .= "<tr>";
									
									$pi .= "<td>";
										$pi .= "<input type='text' value='' style='width: 328px;' class='LiloginText' name='quarto_".$j."_text_name_".$i."' id='quarto_".$j."_text_name_".$i."' placeholder='".getLabel('LABEL_NAME', $_SESSION['LANGUAGE'])."'/>";
									$pi .= "</td>";
									
									$pi .= "<td>";
										$pi .= "<select name='select_guest_".$j."_faixa_etaria_".$i."' id='select_guest_".$j."_faixa_etaria_".$i."' class='LiloginText'>";
											$pi .= "<option value='0'>".getLabel('LABEL_ADULTO', $_SESSION['LANGUAGE'])."</option>";
											$pi .= "<option value='1'>".getLabel('LABEL_CRIANCAS_5ANOS_2', $_SESSION['LANGUAGE'])."</option>";
											$pi .= "<option value='2'>".getLabel('LABEL_CRIANCAS_6A12_2', $_SESSION['LANGUAGE'])."</option>";
											$pi .= "<option value='3'>".getLabel('LABEL_CRIANCAS_ACIMA12_2', $_SESSION['LANGUAGE'])."</option>";
										$pi .= "</select>";
									$pi .= "</td>";
									
								$pi .= "</tr>";
							$pi .= "</table>";
							
						$pi .= "</li>";
			
					}
				$pi .= "</ol>";
				
				
			}
			
		}
		
		$pi .= "<script>
		
			function myFunctionSubmit()
			{
				var stt = $('#status').val();
				var select_quarto_tipo = $('#select_quarto_tipo_1').val();
				var quarto_1_text_name = $('#quarto_1_text_name_1').val();
				
				if( stt == null)
				{
					alert('".getLabel('ERRO_PREENCHER_TODOS_CAMPOS', $_SESSION['LANGUAGE'])."');
					return false;
				}
				else if( select_quarto_tipo == '')
				{
					alert('".getLabel('LABEL_ESCOLHER_QUARTO', $_SESSION['LANGUAGE'])."');
					return false;
				}
				else if( quarto_1_text_name == '')
				{
					alert('".getLabel('LABEL_HOSPEDE_REQUERIDO', $_SESSION['LANGUAGE'])."');
					return false;
				}
				else
				{
					document.getElementById('formReservaExternal').submit();
				}
				
			}
		
			$('.guest_1').hide();
			$('#select_quarto_tipo_1').change(function(){
				if(jQuery(this).val() == '')
				{
					$('.guest_1').hide('slow');
				}
				else
				{
					$('.guest_1').show('slow');
				}
			});
			
			
			$('.guest_2').hide();
			$('#select_quarto_tipo_2').change(function(){
				if(jQuery(this).val() == '')
				{
					$('.guest_2').hide('slow');
				}
				else
				{
					$('.guest_2').show('slow');
				}
			});
			
			$('.guest_3').hide();
			$('#select_quarto_tipo_3').change(function(){
				if(jQuery(this).val() == '')
				{
					$('.guest_3').hide('slow');
				}
				else
				{
					$('.guest_3').show('slow');
				}
			});
			
			$('.guest_4').hide();
			$('#select_quarto_tipo_4').change(function(){
				if(jQuery(this).val() == '')
				{
					$('.guest_4').hide('slow');
				}
				else
				{
					$('.guest_4').show('slow');
				}
			});
			
		</script>";
		
		$pi .= "<div class='LabelAcomodacaoTitle left'><b>".getLabel('LABEL_SOLICITACOES', $_SESSION['LANGUAGE'])."</div>";
		$pi .= "<div class='ResetFloat'></div>";
		$pi .= "<div class='EntradaText' style='margin-bottom: 3px'>";
			
			if( $_POST["observacoes"] == "")
			{
				$pi .= "<textarea type='text' cols='42' rows='10' name='observacoes' id='observacoes'/>".$_POST["observacoes"]."</textarea>";
			}
			else
			{
				$pi .= "<br/>";
				$pi .= $_POST["observacoes"];
				$pi .= "<input type='hidden' name='observacoes' id='observacoes' value='".$_POST["observacoes"]."'/>";
			}
			
		$pi .= "</div>";

		

		$pi .= "<div><br/></div>";

		$pi .="<div><input type='hidden' name='ACTION' value='ACTION'/></div>";

		$pi .="<div><button class='BtnProprio' type='buttom' onclick=\"myFunctionSubmit()\">".getLabel('LABEL_ENVIAR', $_SESSION['LANGUAGE'])."</button></div>";

	

	$pi .= "</form>";

	

?>

