$(document).ready(function(){
	
	$(".nick-input").blur(function() {
		var nick = this.value;

		$.ajax({
			url: URL+"/nick-test",//Esta va a ser la ruta en sí de esa accion del controlador que va acomprobar que el nick que le pasamos existe o no
			data: {nick: nick},//Le pasamos como data nick que es el parametro que luego va a recoger por POST la accion del controlador
			type: "POST",
			success: function(response){
				if(response == "used"){
					$(".nick-input").css("border", "1px solid red");
					$(".form-submit").attr("disabled", true);
				}else{
					$(".nick-input").css("border", "1px solid green");
					$(".form-submit").attr("disabled", false);
				}
			}
		});
	});
	
});

