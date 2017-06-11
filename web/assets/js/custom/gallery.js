$(document).ready(function(){
	$(document).on("click", ".js-button", function() {
		var imageSrc = $(this).find("img").attr("src");
		$(".js-modal-image").attr("src", imageSrc);
		var textoPublicacion = $(".publicacion-oculta").eq($(this).index('.js-button')).text();
		var indice = $(this).index('.js-button');
		var fechaPublicacion = $(".fecha-publicacion-oculta").eq($(this).index('.js-button')).text();
		
		$(".texto-publicacion-recogido").text(textoPublicacion,fechaPublicacion);
		$(".fecha-publicacion-recogida").text(fechaPublicacion);
		$(".texto-publicacion-recogido").css({"font-weight": "bold", "margin-right": "2%", "word-break": "break-word"});
		$(".fecha-publicacion-recogida").css("color","#ccc");
	});
});