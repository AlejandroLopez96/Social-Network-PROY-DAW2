$(document).ready(function(){
	
	var ias = jQuery.ias({
		container: ".box-users",//El contenedor que tiene todos los usuarios que vamos a paginar
		item: '.user-item',//El item a paginar es el que tiene la clase .user-item
		pagination: '.pagination',//Los controles de paginacion van a estar dentro de la clase .pagination
		next: '.pagination .next_link',//Va a hacer una peticion a ajax para cargar la siguiente pag utilizando la url que esta dentro de ese selector
		triggerPageThreshold: 5//Cada cuantos elementos va a tener que lanzar la peticion ajax
	});
	
	//Lo que va a mostrar tras pasar 3 bloques de carga(paginaciones) y nos saldra el boton de ver mas personas
	ias.extension(new IASTriggerExtension({
		text: 'Ver más personas',
		offset: 3
	}));
	
	//Con esto va a cargar la imagen de carga
	ias.extension(new IASSpinnerExtension({
		src: URL+'/../assets/images/ajax-loader.gif'
	}));
	
	//El boton que saldra cuando ya no existan mas elementos a mostrar
	ias.extension(new IASNoneLeftExtension({
		text: 'No hay mas personas'
	}));
	
	ias.on('ready', function(event){
		followButtons();
	});
	
	ias.on('rendered', function(event){
		followButtons();
	});
	
});
