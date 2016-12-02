
function selectTagType(id, name){

	$("#tagID").val(id);
	$("#tagName").val(name);
	$("#meuMenuDropDown").toggle();	
	$("#meuMenuDropDown").fadeOut(50);	

}

$(function(){

	$("#tagName").keyup(function(){
	
		var name = $("#tagName").val();

			$.ajax({			
					type: "POST",			
					data:{
						name:name
					},			
					url: "/jezzy-master/portal/masterUsersDiscountCoupon/getCouponTypeByName",
					success: function(result){	

					
					console.log(result);
					
					$("#meuMenuDropDown").html(result);		
					$("#meuMenuDropDown").fadeIn();						
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
				}
			  });
	
	});
	
	
	$("#discountType").change(function(){
	
		 var name = $("#discountType").val();
		 
		 if(name == 'CURRENCY'){
		 
		 $("#basic-addon1").html("R$");
		 
		 }else if(name == "PERCENTAGE"){
		 
		 		 $("#basic-addon1").html("%");
		 }
	
	});

});