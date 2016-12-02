$(function(){

		$(".ratingStatus").click(function(){
		
				var id = $(this).attr("id");
				
				$.ajax({			
			type: "POST",			
			data:{
			id: id
			},			
			url: "/jezzy-master/portal/masterFinances/updateRatingPriceList",
			success: function(result){	
		
			$(".ratingStatus").prop('checked', false); 
			$("#"+id).prop('checked', true); 
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("Houve algume erro no processamento dos dados dessa compra, atualize a pÃ¡gina e tente novamente!");
			alert(errorThrown);
		}
	  });
		
		});
		
		
		$(".reatingDelete").click(function(){
			var id = $(this).attr("id");
			var ndx = $(this).parent().index() + 1;
			
			$.ajax({			
			type: "POST",			
			data:{
			id: id
			},			
			url: "/jezzy-master/portal/masterFinances/deleteRatingPriceList",
			success: function(result){	
			
			location.reload();
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("Houve algume erro no processamento dos dados dessa compra, atualize a pÃ¡gina e tente novamente!");
			alert(errorThrown);
		}
	  });
			
		});

});