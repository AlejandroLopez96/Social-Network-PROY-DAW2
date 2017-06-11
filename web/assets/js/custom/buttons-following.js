function followButtons(){
	$(".btn-follow").unbind("click").click(function(){
		$(this).addClass("hidden");
		$(this).parent().find(".btn-unfollow").removeClass("hidden");
		
		$.ajax({
			url: URL+"/follow",
			type: "POST",
			data: {followed: $(this).attr("data-followed")},//Esto saca el id que hay guardado dentro del atributo data-followed del elemento html al que le hayamos dado click
			success: function(response){
				console.log(response);
			}
		});
	});
	
	$(".btn-unfollow").unbind("click").click(function(){
		$(this).addClass("hidden");
		$(this).parent().find(".btn-follow").removeClass("hidden");
		
		$.ajax({
			url: URL+"/unfollow",
			type: "POST",
			data: {followed: $(this).attr("data-followed")},//Esto saca el id que hay guardado dentro del atributo data-followed del elemento html al que le hayamos dado click
			success: function(response){
				console.log(response);
			}
		});
	});
}
