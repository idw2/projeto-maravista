function createRequest ( ) {

	try {
	
		request = new XMLHttpRequest();
		
	} catch ( tryMS ) {
	
		try {
		
			request = new ActiveXObject("Msmx12.XMLHTTP");
			
		} catch ( otherMS ) {
		
			try {
			
				request = new ActiveXObject("Microsoft.XMLHTTP");
				
			} catch ( failed ) {
			
				request = null;
				
			}
			
		}
		
	}
	
	return request;
} 

function getActivatedObject ( e ) {
  
	var obj;

	if ( !e ) {

		obj = window.event.srcElement;

	} else if ( e.srcElement ) {

		obj = e.srcElement;

	} else {

		obj = e.target;
	}

	return obj;
	
}

function addEventHandler ( obj, eventName, handler ) {
  
	if ( document.attachEvent ) {

		obj.attachEvent( "on" + eventName, handler );

	} else if ( document.addEventListener ) {

		obj.addEventListener( eventName, handler, false );

	}
  
}

function isNavegadorIE ( ) {

	var nomeNavegador = navigator.appName;
	
	if ( nomeNavegador == "Microsoft Internet Explorer" ) {
	
		return true;
		
	} else {
	
		return false;
		
	}
	
}

function loadXMLDoc ( docname ) {
	
	try {
	
		xmlDoc = new ActiveXObject( "Microsoft.XMLDOM" );
		
	} catch ( e ) {
	
		try {
			
			xmlDoc = document.implementation.createDocument( "", "", null );
		
		} catch ( e ) {
		
			alert( e.message ) 
		
		}
	}
		
	try {
	
		xmlDoc.async = false;
		xmlDoc.load ( docname );
		return xmlDoc;
		
	} catch ( e ) {
		
		alert ( e.message );
		
	}
	
	return null;
	
}

function caixaAlta ( id ) {

	var valor = document.getElementById( id ).value;
	document.getElementById( id ).value = valor.toUpperCase();
	
}

function caixaBaixa ( id ) {

	var valor = document.getElementById( id ).value;
	document.getElementById( id ).value = valor.toLowerCase();
	
}

function email_errado ( email ) {

	var valEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$/ ;
	
	if ( ! valEmail.test ( email ) ) {
	
		return false;		
		
	} else {
	
		return true;
		
	}

}

// ESCREVE A QUANTIDADE DE CARACTERES LIMITE PARA UM CAMPO
function limite ( e ) {
	
	var me = getActivatedObject( e );
		
	var type = $( '#' + me.id );
	var id = me.id;
		
	var total = 0;
	var restante = 0;
	var atual = 0;
	
	atual = parseInt ( type.value.length )
		
	total = parseInt ( type.getAttribute ( 'limite' ) );
	restante = ( total - atual );
	
	var inter = new Internacionalizacao();
	inter.setDocxml('../server/objects/entities/map/default.config.xml');	
	
	inter.setFild( 'validation', 'tamanhomaximotextarea' );
	var tamanhomaximotextarea = inter.getFild();
	
	inter.setFild( 'validation', 'limitetextarea' );
	var limitetextarea = inter.getFild();

	if ( restante < 0 ) {
	
		tamanhomaximotextarea = tamanhomaximotextarea.replace( "1%", type.getAttribute ( 'title' ) );
		tamanhomaximotextarea = tamanhomaximotextarea.replace( "2%", total );
		
		var obj = document.getElementById ( type.getAttribute ( 'response' ) );
		var text = tamanhomaximotextarea;
		
		new Validation().alertExpecifico ( obj, text );
		return false;
		
	} else {
	
		var obj = document.getElementById ( type.getAttribute ( 'response' ) );
		var text = limitetextarea.replace( "1%", restante );
		
		new Validation().alertExpecifico ( obj, text );
		
	}
	
}