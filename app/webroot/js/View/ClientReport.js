$(document).ready(function () {

});

function showUserDetail(id){
		
	$.ajax({			
			type: "POST",			
			data:{
				userId:id
			},			
			url: "/jezzy-business/portal/clientReport/getClienteDetail",
			success: function(result){	
				
			$("#recebe").html(result);
			$('#myModalSchedulesRequisitions').modal('toggle');
			 $('#myModalSchedulesRequisitions').modal('show');
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
		}
	  });
	
}