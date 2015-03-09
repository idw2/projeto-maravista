function Horario( datas )
{ 
	var Hoje = new Date(); 
    var Horas = Hoje.getHours(); 
	
    if(Horas < 10)
	{ 
      Horas = "0"+Horas; 
    } 
    
	var Minutos = Hoje.getMinutes(); 
    if(Minutos < 10){ 
      Minutos = "0"+Minutos; 
    } 
	
    var Segundos = Hoje.getSeconds(); 
    
	if(Segundos < 10){ 
      Segundos = "0"+Segundos; 
    } 
	
	return datas +" - "+Horas+":"+Minutos+":"+Segundos;
} 

window.onload = getHour;
window.onload = startTime;

function getHour()
{
	var Elem = document.getElementById("Clock");
	Elem.innerHTML = Horario(myDta());
}

function startTime()
{
	setInterval(function(){getHour()},1000);
}

function myDta()
{
	
	var now = new Date();
	var mName = now.getMonth() +1 ;
	var dName = now.getDay() +1;
	var dayNr = now.getDate();
	var yearNr= now.getYear();
	
	var Day = "";
	var Month = "";
	
	var idioma = document.getElementById("linguagem").className;
	
	switch(idioma)
	{
		case "INGLES":
			var dayweek = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
			var daymonth = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		break;
		case "ESPANHOL":
			var dayweek = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");	
			var daymonth = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		break;
		default:
			var dayweek = new Array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");
			var daymonth = new Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	}
	
	var Day = "";
	  
	for( i=0;i<dayweek.length;i++)
	{
		if( i == (dName-1) )
		{
			Day = dayweek[i];
		}
	}
	
	var Month = "";
	  
	for( i=0;i<daymonth.length;i++)
	{
		if( i == (mName-1) )
		{
			Month = daymonth[i];
		}
	}
	
	var Year = "";
	
	if(yearNr < 2000) 
	{
		Year = 1900 + yearNr;
	}
	else 
	{
		Year = yearNr;
	}
	
	var str = Day + ", " + dayNr + " " + Month +", "+ Year;
	return str;
}