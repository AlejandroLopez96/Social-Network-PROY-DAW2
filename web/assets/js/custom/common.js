$(document).ready(function(){
	$(".abre-div-buscador").unbind("click").click(function(){
		$(".buscador-menu-movil").toggle();
	});
    
    setTimeout(function() {
        $(".mensaje-tiempo").fadeOut();
	},5000);
    
    if(document.getElementById('backendbundle_user_image') != null){
        
        document.getElementById('backendbundle_user_image').addEventListener('change', archivo, false);

        $('.boton-eliminar-archivo').on('click', function(e){
            var $el = $('#backendbundle_user_image');
            $el.wrap('<form>').closest('form').get(0).reset();
            $el.unwrap();
            $(".nombre-image").css("display", "none");
         });
        
        var insertar_en_doc = document.querySelector(".nombre-document");
        var archivo_doc = document.createElement("div");
        $('#backendbundle_user_document').on('change', function(e){
            file_in = document.querySelector("#backendbundle_user_document");
            var files = e.target.files;
            for(var i=0,f;f= files[i];i++){
                $(".nombre-document").css("display", "inline-block");
                archivo_doc.style.display= "inline-block";
                archivo_doc.style.float = "left";
                archivo_doc.style.margin = "3px";
                archivo_doc.innerHTML = f.name;
                insertar_en_doc.appendChild(archivo_doc);
            }
            $('.boton-eliminar-archivo-doc').on('click', function(e){
                var $el = $('#backendbundle_user_document');
                $el.wrap('<form>').closest('form').get(0).reset();
                $el.unwrap();
                $(".nombre-document").css("display", "none");
            });
        });
    }
	if($(".label-notifications").text() == 0){
		$(".label-notifications").addClass("hidden");
	}else{
		$(".label-notifications").removeClass("hidden");
	}
	
	if($(".label-notificaciones").text() == 0){
		$(".label-notificaciones").addClass("hidden");
	}else{
		$(".label-notificaciones").removeClass("hidden");
	}
	
	if($(".label-notifications-msg").text() == 0){
		$(".label-notifications-msg").addClass("hidden");
	}else{
		$(".label-notifications-msg").removeClass("hidden");
	}
	
	if($(".label-mensajes").text() == 0){
		$(".label-mensajes").addClass("hidden");
	}else{
		$(".label-mensajes").removeClass("hidden");
	}
	
	notifications();
	
	setInterval(function(){
		notifications();
	}, 2000);
	
});

function notifications(){
	$.ajax({
		url: URL+'/notifications/get',
		type: 'GET',
		success: function(response){
			$(".label-notifications").html(response);
			$(".label-notificaciones").html(response);
			
			if(response == 0){
				$(".label-notifications").addClass("hidden");
				$(".label-notificaciones").addClass("hidden");
			}else{
				$(".label-notifications").removeClass("hidden");
				$(".label-notificaciones").removeClass("hidden");
				if(($(window).width()) <= 400){
				    $(".label-notificaciones").parent().parent().css("margin-right", "1%");
				} else if((($(window).width()) > 400) && (($(window).width()) <= 489)){
				    $(".label-notificaciones").parent().parent().css("margin-right", "3%");
				} else if((($(window).width()) > 489) && (($(window).width()) <= 600)){
				    $(".label-notificaciones").parent().parent().css("margin-right", "5%");
				} else if(($(window).width()) > 600){
				    $(".label-notificaciones").parent().parent().css("margin-right", "9%");
				}
			}
			
		}
	});
	$.ajax({
		url: URL+'/private-message/notification/get',
		type: 'GET',
		success: function(response){
			$(".label-notifications-msg").html(response);
			$(".label-mensajes").html(response);
			
			if(response == 0){
				$(".label-notifications-msg").addClass("hidden");
				$(".label-mensajes").addClass("hidden");
			}else{
				$(".label-notifications-msg").removeClass("hidden");
				$(".label-mensajes").removeClass("hidden");
				if(($(window).width()) <= 400){
				    $(".label-mensajes").parent().parent().css("margin-right", "1%");
				} else if((($(window).width()) > 400) && (($(window).width()) <= 489)){
				    $(".label-mensajes").parent().parent().css("margin-right", "3%");
				} else if((($(window).width()) > 489) && (($(window).width()) <= 600)){
				    $(".label-mensajes").parent().parent().css("margin-right", "5%");
				} else if(($(window).width()) > 600){
				    $(".label-mensajes").parent().parent().css("margin-right", "9%");
				}
			}
			
		}
	});
	
}
 function archivo(evt) {
      var files = evt.target.files; // FileList object
       
        //Obtenemos la imagen del campo "file". 
      for (var i = 0, f; f = files[i]; i++) {         
           //Solo admitimos imágenes.
           if (!f.type.match('image.*')) {
                continue;
           }
       
           var reader = new FileReader();
           
           reader.onload = (function(theFile) {
               return function(e) {
               // Creamos la imagen.
                      document.getElementById("image").innerHTML = ['<img class="muestra-imagen" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
		      $(".nombre-image").css("display", "inline-block");
               };
           })(f);
 
           reader.readAsDataURL(f);
       }
	 }