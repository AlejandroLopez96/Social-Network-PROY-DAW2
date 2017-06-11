$(document).ready(function(){
	
	var ias = jQuery.ias({
		container: ".profile-box #user-publications",//El contenedor que tiene todos los usuarios que vamos a paginar
		item: '.publication-item',//El item a paginar es el que tiene la clase .user-item
		pagination: '.profile-box .pagination',//Los controles de paginacion van a estar dentro de la clase .pagination
		next: '.profile-box .pagination .next_link',//Va a hacer una peticion a ajax para cargar la siguiente pag utilizando la url que esta dentro de ese selector
		triggerPageThreshold: 5//Cada cuantos elementos va a tener que lanzar la peticion ajax
	});
	
	//Lo que va a mostrar tras pasar 3 bloques de carga(paginaciones) y nos saldra el boton de ver mas personas
	ias.extension(new IASTriggerExtension({
		text: 'Ver más publicaciones',
		offset: 3
	}));
	
	//Con esto va a cargar la imagen de carga
	ias.extension(new IASSpinnerExtension({
		src: URL+'/assets/images/ajax-loader.gif'
	}));
	
	//El boton que saldra cuando ya no existan mas elementos a mostrar
	ias.extension(new IASNoneLeftExtension({
		text: 'No hay mas publicaciones'
	}));
	
	ias.on('ready', function(event){
		buttons();
		followButtons();
	});
	
	ias.on('rendered', function(event){
		buttons();
	});
	
});


function buttons(){
	
	$('[data-toggle="tooltip"]').tooltip();//Asi hacemos el bocadillito de me gusta
	
	$(".btn-img").unbind("click").click(function(){
		$(this).parent().find('.pub-image').fadeToggle();
	});
	
	$(".btn-delete-pub").unbind("click").click(function(){
		//$(this).parent().parent().fadeOut('slow');
		
		/*ORIGINAL BUENO AJAX
		$.ajax({
			url: URL+'/publication/remove/'+$(this).attr("data-id"),
			type: 'GET',
			success: function(response){
				console.log(response);
			}
		});*/
		
		$( "#dialogoborrar" ).dialog({
			autoOpen: false,
			resizable: false,
			modal: true,
			buttons: {
			  //BOTON DE BORRAR
			  "Borrar": function() {			
				//Ajax con post
				$.get(URL+'/publication/remove/'+id,function(data,status){
					$("#"+id).parent().parent().fadeOut('slow');
				});//post			
				//Cerrar la ventana de dialogo				
				$(this).dialog("close");												
			  },
			  "Cancelar": function() {
				  //Cerrar la ventana de dialogo
				  $(this).dialog("close");
			  }
			}//buttons
		});
		$(document).on("click",".btn-delete-pub",function(){	
			id = $(this).attr("data-id");
			$( "#dialogoborrar" ).dialog("open");	
		});
	});
	
	
	$(".btn-like").unbind('click').click(function(){
		$(this).addClass('hidden');
		$(this).parent().find('.btn-unlike').removeClass('hidden');
		
		$.ajax({
			url: URL+'/like/'+$(this).attr('data-id'),
			type: 'GET',
			success: function(response){
				console.log(response);
			}
		});
	});
	
	$(".btn-unlike").unbind('click').click(function(){
		$(this).addClass('hidden');
		$(this).parent().find('.btn-like').removeClass('hidden');
		
		$.ajax({
			url: URL+'/unlike/'+$(this).attr('data-id'),
			type: 'GET',
			success: function(response){
				console.log(response);
			}
		});
	});
}

