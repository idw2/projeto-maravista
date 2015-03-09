function getParameterHidden()
{
	var requestData = "";
	
	$('#formSolicitarReservas input[type=hidden]').each(function(i){
		requestData += "&"+this.id.toUpperCase()+"="+this.value;
	});
	
	request = createRequest();
	
	if( request == null )
	{
		alert("* "+texto+"!");
	} 
	else 
	{
	
		$('#ReservaTotalliBtn').hide(); 
		$('#ReservaPreload').show(); 
		
		//alert(requestData);
		
		url="../server/getsomaadultosexcedentes.php";
		url += (url.indexOf("?") === -1) ? "?" : "&amp;";
		url += "ridwes="+Math.random();
		request.open("POST",url,true);
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.onreadystatechange = requestGetparameterhidden;
		request.send(requestData);
		
	}
	
}

function requestGetparameterhidden() {
	if(request.readyState == 4){
		if(request.status == 200){
			
			//alert(request.responseText); 
			
			var erro = request.responseText.trim();
			
			if( erro == "")
			{
				$('#ReservaTotalliBtn').show(); 
				$('#ReservaPreload').hide(); 	
				$("#ErroAjaxMassage").html('');
			}
			else
			{
				$('#ReservaPreload').hide(); 
				$("#ErroAjaxMassage").html(erro);
			}
		}	
	}
}


function updateReservas( id, texto )
{
	var result = existeAdultoexcedente( id, texto );	
	
	setaValoressemadultosexcedentes( id, texto )	
	
	var acomodacoes = $("#somaCapacidade").val();
	var somatoria = $("#pessoas").val();
	
	$('#ReservaTotalliBtn').hide(); 
	$('#ReservaPreload').hide(); 
	
	getParameterHidden();
}

function existeAdultoexcedente( id, texto )
{
	var pessoas = $("#pessoas").val();
	var adultos = $("#adultos").val();
	var soma_pessoas = $("#somaPessoas").val();
	var soma_adultos = $("#somaAdultos").val();
	var nQuartos = $("#nQuartos").val();
	var criancas_5a = $("#criancas_5a").val();
	var criancas_6a12 = $("#criancas_6a12").val();
	var criancas_acima12 = $("#criancas_acima12").val();
	var somaCriancas_5a = $("#somaCriancas_5a").val();
	var somaCriancas_6a12 = $("#somaCriancas_6a12").val();
	var somaCriancas_acima12 = $("#somaCriancas_acima12").val();
	
	if( id != "")
	{
		somarQuartos(id);
		
	}
		
		var codquartos = $("#somaCodquarto").val();
		codquartos = codquartos.split(";");
		
		var acomodacoes = 0;
		var guid = "";
		
		var n = 0;
		
		for (var i in codquartos)
		{
			if(codquartos[i] != "")
			{
				guid = codquartos[i].replace("ReservaLoopReferencia_","");
				guid = "#ReservaLoopAcomodacoes_"+guid;
				acomodacoes = (acomodacoes + parseInt($(guid).val()));
			}
		}
		
	$("#somaCapacidade").val(acomodacoes);
	
	
	var somatoria = pessoas;
	var resultado_somatoria = ( parseInt(acomodacoes) - parseInt(somatoria));
	
	if(parseInt(acomodacoes) < parseInt(somatoria))
	{
		if( resultado_somatoria < 0 )
		{
			var resultado_somatoria = ( parseInt(somatoria) - parseInt(acomodacoes));
		}
		$("#adultosExcedentesFinalize").html(resultado_somatoria);
		$("#somaAdultosExcedentes").val(resultado_somatoria);
	}
	else
	{
		$("#somaAdultosExcedentes").val(0);
		$("#adultosExcedentesFinalize").html(0);
	}
	
	var soma_pessoas = $("#somaPessoas").val(pessoas);
	var soma_adultos = $("#somaAdultos").val(adultos);
	var somaCriancas_5a = $("#somaCriancas_5a").val(criancas_5a);
	var somaCriancas_6a12 = $("#somaCriancas_6a12").val(criancas_6a12);
	var somaCriancas_acima12 = $("#somaCriancas_acima12").val(criancas_acima12);

}

function somarQuartos(id)
{
	var codquarto = escape(id.replace('ReservaLoopReferencia_',''));
	var ckeque = 'ReservaDescriptInput_'+codquarto;
	var sQuartos = parseInt(document.getElementById('SomaQuartos').value);
	
	if( document.getElementById(ckeque).checked == true)
	{
		var somaCodquarto = document.getElementById('somaCodquarto').value;
		var add = somaCodquarto+codquarto+';';
		document.getElementById('somaCodquarto').value = add;
		sQuartos = sQuartos++;
		document.getElementById('nQuartos').selectedIndex = sQuartos;
		
	}
	else
	{
		var somaCodquarto = document.getElementById('somaCodquarto').value;
		var del = codquarto+';';
		var str = somaCodquarto.replace(del,'');
		document.getElementById('somaCodquarto').value = str;
		sQuartos = sQuartos--;
		document.getElementById('nQuartos').selectedIndex = sQuartos;
	}
	
}

function setaValoressemadultosexcedentes( id, texto )
{
	
	request = createRequest();
	
	if( request == null )
	{
		alert("* "+texto+"!");
	} 
	else 
	{
		document.getElementById('ReservaTotalliBtn').style.display = 'none'; 
		document.getElementById('ReservaPreload').style.display = "none"; 
		document.getElementById('totalFinalize').innerHTML = "<span class='DiariaPreço right' id='totalFinalize'><i><img src='../image/preload.gif' alt='' border=''/><i></span>"; 
		
		var total = escape(document.getElementById('SomaTotal').value);
		
		var codquarto = escape(id.replace('ReservaLoopReferencia_',''));
		var ckeque = 'ReservaDescriptInput_'+codquarto;
		
		if( document.getElementById(ckeque).checked == true)
		{
			var calculo = 'SOMAR';
		}
		else
		{
			var calculo = 'SUBTRAIR';
		}
		
		var requestData 
		= "CODQUARTO="+codquarto
		+ "&TOTAL="+total
		+ "&CALCULO="+calculo;
		
		url="../server/setavaloressemadultosexcedentes.php";
		url += (url.indexOf("?") === -1) ? "?" : "&amp;";
		url += "ridwes="+Math.random();
		request.open("POST",url,true);
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.onreadystatechange =  requestGetsetavaloressemadultosexcedentes;
		request.send(requestData);
		
		
	}

}

function requestGetsetavaloressemadultosexcedentes() {
	if(request.readyState == 4){
		if(request.status == 200){
			
			var req = request.responseText;
			var tto = req.split(":");
			
			var codquarto = tto[0].trim();
			var vlor = tto[1].trim();
			
			document.getElementById('SomaTotal').value = vlor;
			if( tto[1] == "")
			{
				document.getElementById('totalFinalize').innerHTML = "0,00";
			}
			else
			{
				document.getElementById('totalFinalize').innerHTML = vlor;
			}
			
		}	
	}
}

/*
function adultoExcedente( guid )
{
	
	request = createRequest();
	
	var codquarto = escape(guid);
	
	if( request == null )
	{
		//alert("* "+texto+"!");
	} 
	else 
	{
		
		document.getElementById('adultosExcedentesFinalizeValor').innerHTML = "<span class='DiariaPreço right'><i><img src='../image/preload.gif' alt='' border=''/><i></span>"; 
		var excedente = document.getElementById('somaAdultosExcedentes').value;
		
		if( parseInt(excedente) == 0 )
		{
			
			document.getElementById('adultosExcedentesFinalizeValor').innerHTML = "<span class='DiariaPreço right'><i>0,00<i></span>"; 
		}
		else
		{
			var total = document.getElementById('SomaTotal').value;
			var input = "ReservaDescriptInput_"+codquarto;
			
			var sQuartos = parseInt(document.getElementById('SomaQuartos').value);
			var excValor = parseInt(document.getElementById('somaAdultosExcedentesValor').value);
			var somaCodquarto = document.getElementById('somaCodquarto').value;
			
			if(document.getElementById(input).checked == true)
			{
				var calculo = "SOMAR";
				sQuartos = sQuartos++;
				document.getElementById('SomaQuartos').value = sQuartos;
				document.getElementById('nQuartos').selectedIndex = (sQuartos-1);
				var n_pessoas_quartos = (sQuartos*2);
				var adultos = document.getElementById('adultos').value;
				var diff = ( parseInt(adultos) - parseInt(n_pessoas_quartos));
				
			}
			else
			{
				var calculo = "SUBTRAIR";			
				sQuartos = sQuartos--;
				document.getElementById('SomaQuartos').value = sQuartos;
				document.getElementById('nQuartos').selectedIndex = (sQuartos-1);
				var n_pessoas_quartos = (sQuartos*2);
				var adultos = document.getElementById('adultos').value;
				var diff = ( parseInt(adultos) - parseInt(n_pessoas_quartos));
				
				if( parseInt(diff) > 0)
				{
					var n = ( parseInt(adultos) - 2 );
					document.getElementById('adultosExcedentesFinalize').innerHTML = n;
					document.getElementById('somaAdultosExcedentes').value = n;
				}
			}
			
			var px = parseInt(n_pessoas_quartos)
			var py = parseInt(adultos);
			
			if( px > py)
			{
				var resto = (parseInt(n_pessoas_quartos) - parseInt(adultos));
			}
			else if(px == py)
			{
				var resto = 0;
			}
			else
			{
				var resto = (parseInt(adultos)-parseInt(n_pessoas_quartos));
			}
			
			if( parseInt(diff) > 0)
			{
				var n = ( parseInt(adultos) - 2 );
				document.getElementById('adultosExcedentesFinalize').innerHTML = n;
				document.getElementById('somaAdultosExcedentes').value = n;
			}
			
			var requestData 
			= "CODQUARTO="+escape(codquarto)
			+ "&EXCEDENTE="+escape(excedente)
			+ "&CALCULO="+calculo
			+ "&SQUARTOS="+sQuartos
			+ "&ADULTOS="+adultos
			+ "&EXCVALOR="+excValor
			+ "&RESTO="+resto
			+ "&SOMACODQUARTO="+somaCodquarto
			+ "&TOTAL="+total;
			
			url="../server/getsomaadultosexcedentes.php";
			url += (url.indexOf("?") === -1) ? "?" : "&amp;";
			url += "ridwes="+Math.random();
			request.open("POST",url,true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.onreadystatechange = requestGetsomaadultosexcedentes;
			request.send(requestData);
		}
		
	}	
}

function requestGetsomaadultosexcedentes() {
	if(request.readyState == 4){
		if(request.status == 200){
			
			alert(request.responseText);
			//return;
			
			var param = request.responseText.split(":");
			
			var codquarto = param[0].trim();
			var excedente = param[1].trim();
			var total = param[2].trim();
			var zerar = param[3].trim();
			var adultosExcedentes = param[4].trim();
			
			if(zerar == "SIM")
			{
				/*alert(request.responseText);
				excedente = "0,00";
				document.getElementById('adultosExcedentesFinalize').innerHTML = '0';
				document.getElementById('somaAdultosExcedentes').value = 0;
			}
			if(total == "")
			{
				total = "0,00";
			}
			
			document.getElementById('SomaTotal').value = total;
			document.getElementById('totalFinalize').innerHTML = total;
			
			document.getElementById('adultosExcedentesFinalizeValor').innerHTML = excedente; 
			document.getElementById('somaAdultosExcedentesValor').innerHTML = excedente; 
			
			if( parseInt(adultosExcedentes) < 0)
			{
				adultosExcedentes = 0;
			}
			
			document.getElementById('somaAdultosExcedentes').innerHTML = adultosExcedentes; 
			document.getElementById('adultosExcedentesFinalize').innerHTML = adultosExcedentes;
			
			document.getElementById('ReservaTotalliBtn').style.display = 'block'; 
			document.getElementById('ReservaPreload').style.display = 'none'; 
			
		}	
	}
}

function getPostparams()
{
	$('input').ready(function(){
		
		var params = "";
		
		$('input').each(function(i){
		//$('input').not(search(/ReservaDescriptInput_/i),search(/ReservaDescriptInputHidden_/i),search(/ReservaLoopReferencia_/i)).each(function(i){
			
			if( this.id != "")
			{
				var ok = 0;
				if( this.id.indexOf("ReservaDescriptInput_") != -1 )
				{
					ok++;
				}
				if( this.id.indexOf("ReservaDescriptInputHidden_") != -1 )
				{
					ok++;
				}
				if( this.id.indexOf("ReservaLoopReferencia_") != -1 )
				{
					ok++;
				}
				
				if(ok==0)
				{
					params += "&"+this.id.toUpperCase()+"="+this.value;
					alert(params);
				}
				
			}
		});
	});
}

$(document).ready(function(){
	//getPostparams();
});

*/

/*
function getAlterstatusnoticia(id) {
	
	var chave = escape(id);
	
	request = createRequest();
	
	if( request == null ){
		alert("* Ocorreu uma falha na requisição da turma, por favor tente mais tarde!");
	} else {
	
		var requestData = "CHAVE="+chave;
		url="../server/getalterstatusnoticia.php";
		url += (url.indexOf("?") === -1) ? "?" : "&amp;";
		url += "ridwes="+Math.random();
		request.open("POST",url,true);
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		request.onreadystatechange = requestGetalterstatusnoticia;
		request.send(requestData);
	
	}

}
 
function requestGetalterstatusnoticia() {
	if(request.readyState == 4){
		if(request.status == 200){
			
			var id = request.responseText;
			var str = id.split(":");
			
			var guid = str[0];
			var stt = str[1];
			
			if ( stt == 0 )
			{
				document.getElementById(guid).innerHTML = "<font color='red'>Inativo</font>";
			}
			else
			{
				document.getElementById(guid).innerHTML = "<font color='green'>Ativo</font>";
			}
			alert("* Status atualizado com sucesso!");
			window.location.reload();
		}	
	}
}

*/