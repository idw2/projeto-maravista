function showMasc(controle)
{
	var item = document.getElementById('byitem');
	var codigo = document.getElementById('bycodigo');
	
	if( controle == "2" )
	{
		item.style.display = "none";	
		codigo.style.display = "block";	
	}
	else
	{
		item.style.display = "block";	
		codigo.style.display = "none";	
	}
	document.getElementById('phone1').value='';
	document.getElementById('phone2').value='';

}

function getOperadora(valor)
{
	document.getElementById("operadora").value = valor;

}

jQuery(function($)
{
	$("#phone1").mask("(99)99999-9999",{placeholder:" "});
	$("#phone2").mask("(99)9999-9999",{placeholder:" "});
});


/*
	$("[alt=phone]").live('keypress', function (event) {  
		
		var target, phone, element;  
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
		phone = target.value.replace(/\D/g, '');  
		element = $(target);  
		element.unsetMask();  
	
		if (phone.length > 5 && phone.substr(0,3) == "119") 
		{ 
		  element.setMask("(99) 99999-9999");  
		} 
		else 
		{  
		  element.setMask("(99) 9999-9999");  
		}
	
	
		});
		*/
	/*
	$(document).ready(function(){
	
		$("#phone").mask("(99)99999-9999",{placeholder:" "});
		//$("#phone").keypress(function( event ) {
		
			//var target, phone;  
			
			//target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
			//phone = target.value.replace(/\D/g, ''); 
			
			if( phone.length == 3 && phone.substr(0,3) == "119")
			{
				$("#phone").mask("(99)99999-9999",{placeholder:" "})
			}
			else
			{
				$("#phone").mask("(99)9999-9999",{placeholder:" "})
			}	
			
		//});	
	
	});
	*/
		
	/*	
	$(document).ready(
		function(){
		
			//$("[alt=phone]").keypress(
			
			
			//$("#phone").live("keypress", function(){ alert("Goodbye!"); }); 
			
			$("#phone").keypress(function( event ) {
				
				var target, phone, element;  
				target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
				phone = target.value.replace(/\D/g, '');  
				$("#phone").val();
				//alert($("#control"))
				
				
				if( phone.length == 3 && phone.substr(0,3) == "119")
				{
					$("#phone").mask("(99)99999-9999",{placeholder:" "})
					$("#phone").val();
					//element.setMask("(99) 99999-9999");  
				}
				else
				{
					$("#phone").mask("(99)9999-9999",{placeholder:" "})
					//$("#phone").val()
				}
				
			});
			
		}	
	);
	jQuery(function($){
		
		alert(document.getElementById("phone").value.substr(0,3));
		
		
		
		if (document.getElementById("phone").value.length > 5 && documento.getElementById("phone").substr(0,3) == "119") 
		{ 
		  //$("#phone").mask("(99)9999-9999",{placeholder:" "});
		} 
		else 
		{  
		  //$("#phone").mask("(99)99999-9999",{placeholder:" "});
		}
		
	});
	*/
	
	/*
	$("#phone").live('keypress', function (event) { 
		alert('aqio	');
	});
	$(	
		function()
		{
			$("#phone");
			//$("#phone").mask("(999) 999-9999"
		}
	);*/