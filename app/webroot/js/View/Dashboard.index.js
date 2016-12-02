$globalSchedule = {
    "#colSchedule_1": "",
    "#colSchedule_2": "",
    "#colSchedule_3": "",
    "#colSchedule_4": ""};

	function newSugestionSchedule(indx){
		$("#new-sugestion-"+indx).toggle(100);
}

var globalScheduleSolicitation = 0;
	var intervalor = 0;
	
	function showUserDetail(id){
		
	$.ajax({			
			type: "POST",			
			data:{
				userId:id
			},			
			url: "/jezzy-business/portal/clientReport/getClienteDetail",
			success: function(result){	
				
			$("#recebe").html(result);
			$('#myModalUserDetails').modal('toggle');
			 $('#myModalUserDetails').modal('show');
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
		}
	  });
	
}

	
$(document).ready(function () {

	 $('#dateSchecule').val(new Date().toDateInputValue());

		$("#showmodalnewSchedule").click(function(){
		
			 $('#myModalNewSchedule').modal('toggle');
			 $('#myModalNewSchedule').modal('show');
			
		});
	 
		//PESQUISA USUARIO PARA CADASTRO DO AGENDAMENTO
			 $("#clientSchedule").keyup(function(){
			
		var valor = $("#clientSchedule").val();
		
		if(valor === ''){
			$("#content-names").fadeOut(0);
		}else{
		
		$.ajax({			
			type: "POST",			
			data:{				
			searchService: valor},			
			url: "/jezzy-business/portal/schedule/getUserByName",
			success: function(result){	
				//$("#search-return").fadeIn(0);			
				//$('#search-return').html(result);
				$("#content-names").html(result);
				$("#content-names").fadeIn(100);
							
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert(errorThrown);
		}
	  });}
		
		}); 
	

		 $("#serviceSchedule").bind("change", ".form-control", function () {

        if ($("#serviceSchedule").val() !== '0') {
			
            $.ajax({
                method: "POST",
                url: "/jezzy-business/portal/schedule/ajaxGetServicePrice",
                data: {Schedule: {
                        serviceId: $("#serviceSchedule").val()
                    }
                }
            }).done(function (msg) {
		
                if (msg !== 0 && msg !== "0") {
			
                    $("#valueSchedule").val(msg);
                }
            });
        } else {
		
            $("#valueSchedule").val("");
        }
    });


	//CRIANDO CONTADOR DE SOLICITAÇÕES 
	var counter = 0;

    $("button[name='employee']").click(function () {
        var userID = $(this).attr('id');
        if ($(this).hasClass("active")) {
            $(this).removeClass("active underline");
            $(getKeyByValue(userID, $globalSchedule)).html("");
            $globalSchedule[getKeyByValue(userID, $globalSchedule)] = "";
        } else {
            var freeColumn = checkFreeColumn();
            if (freeColumn !== false) {
                $(this).addClass("active underline");
                $(this).blur();
                getUserSchedule(freeColumn, userID, $("#dateSchedule").val());
                $globalSchedule[freeColumn] = userID;
            } else {
                alert("Libere uma vaga para o horario");
            }
        }
    });

    $("#limpar").click(function () {
        clearAllSchedule();
    });

    $("#columnsSchecule").on("click", ".glyphicon-plus", function () {
        alert("Função disponivel somente na área de agenda.");
    });

    $("#columnsSchecule").on("click", ".glyphicon-minus", function () {
        alert("Função disponivel somente na área de agenda.");
    });

    $("#dateSchedule").bind("change", ".form-control", function () {
        clearAllSchedule();
    });
	
	//$("#readFileBtn").click(function(){
	
		$.ajax({			
			type: "POST",			
			data:{},			
			url: "/jezzy-business/portal/dashboard/readFile",
			success: function(result){	
			
			var jsonReturn = JSON.parse(result);
			
			var htmlContent = '';
			
			//VERIFICANDO DE JSON TRAZ ALGUMA NOTIFICAÇÃO, CASO NÃO TENHA => NÃO MOSTRAR POP UP
			if(jsonReturn.length > 0){
			
			globalScheduleSolicitation = jsonReturn;
			
			$.each(jsonReturn, function(index, value){
			
				if(value.status == "WAITING_COMPANY_RESPONSE"){
			
					var div = "<div class='notification-item col-md-4' id='notification-item-"+index+"'><h4><a href='#' onclick='showUserDetail("+value.Cliente.id+")'>"+value.Cliente.name+"</a></h4><hr /><span class='notification-text'>"+value.Servico.name+"<br/>"+ findDayOfWeek(value.date) +" ("+formatDate(value.date)+")"+" às "+value.schedule+" </span><br/><span class='glyphicon glyphicon-remove glyphicon-btn remove-solicitation-schedule' onclick='removeScheduleSolicitation("+index+");' ></span> <span class='glyphicon-btn'>|</span> <span class='glyphicon glyphicon-ok glyphicon-btn' onclick='aproveScheduleSolicitation("+index+")'></span><div class='label-new-schedule'>"+
						"<span class='label' id='sugestion-"+index+"' onclick='newSugestionSchedule("+index+")'>Sugerir novo horário</span></div><div class='pull-left hidden-notify' id='new-sugestion-"+index+"'>"+
								"<input type='time' class='form-control pull-left notification-input' id='suggest-new-"+index+"' /><div class='confirm-sugestion-schedule pull-left'><span class='glyphicon glyphicon-ok-circle' onclick='suggestNewSchedule("+index+")'></span></div></div></div>";
			
					htmlContent = htmlContent+div;
					counter = index;
				
				}
				
			});
				
				console.log(jsonReturn);
			counter++;
			
			$("#notification-body").html(htmlContent);
			$("#notification-counter").html("<span>"+counter+"</span>");
			
			 $('#myModalSchedulesRequisitions').modal('toggle');
			 $('#myModalSchedulesRequisitions').modal('show');
			}else{
				
			}
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
			
		}
	  });
	  
	//});
	
	$("#fancy-name-comp").click(function(){
		if(counter!=0){
			 $('#myModalSchedulesRequisitions').modal('toggle');
			 $('#myModalSchedulesRequisitions').modal('show');
		}
	});
	
	
	
	/*var dias_semana = new Array("Domingo", "Segunda-feira",
      "Terça-feira", "Quarta-feira", "Quinta-feira",
      "Sexta-feira", "Sábado");
  var data = new Date("2016-02-17");
  var dia = data.getDay();
  
  alert("Data"+data+"Dia" + dia +  "---Dia da Semana: " + dias_semana[dia]); */
  
	$("#btn-fecha-modal").click(function(){
	 intervalor = window.setInterval(showModal, 60000);
	});
	
	// 
	$("#btnNewSchedule").click(function () {

        var userID = $("#userId").val();
		
        var chooseDay = $("#dateSchedule").val();
        if (chooseDay == "") {
            var diaAtual = new Date();
            chooseDay = diaAtual.getDate() + "/" + (diaAtual.getMonth() + 1) + "/" + diaAtual.getFullYear();
        }
        if (valdiateScheduleFilds()) {
	
			//executa criação do novo usuário CASO checkbox de novo usuário esteja clicado
			if($("#newUserSchedule").is(":checked")){
				addNewUser();
			}
		
            addNewSchedule(chooseDay).done(function (msg) {
		
               /* if (msg !== 'false') {
                    getUserSchedule(getKeyByValue(userID, $globalSchedule), userID, chooseDay);
                } else {
                    alert("Agendamento não realizado. Tente novamente.");
                } */
            }).always(function () {

                $("#initialTimeSchecule").val("");
                $("#serviceSchedule").val('0');
                $("#valueSchedule").val("");
                $("#clientSchedule").val("");
                $("#phoneSchedule").val("");
            });
			
            $('#myModalNewSchedule').modal('hide');
        }else{
			alert("no validate schedule fields");
		} 
    });
	
});

function addNewUser(){
	var name = $("#clientSchedule").val();
	var email = $("#emailSchedule").val();
	var password = $("#emailSchedule").val();
	
	  return $.ajax({
        method: "POST",
        url: "/jezzy-business/portal/user/ajaxAddNewUser",
        data: {User: {
                name: name,
                email: email,
                password: password
            }
        }
    });
}

function addNewSchedule(chooseDay) {
    var time = $("#initialTimeSchecule").val();
    var service = $("#serviceSchedule").val();
    var price = $("#valueSchedule").val();
    var client = $("#clientSchedule").val();
    var phone = $("#phoneSchedule").val();
	var userId = $("#userId").val();
	
	
	
    return $.ajax({
        method: "POST",
        url: "/jezzy-business/portal/schedule/ajaxAddSchedule",
        data: {Schedule: {
                schedulehour: time,
                serviceId: service,
                schedulePrice: price,
                scheduleClient: client,
                schedulePhone: phone,
                scheduleSecondaryUser: 4,
                scheduleDate: chooseDay,
				userId: userId
            }
        }
    });
}

function showModal(){
	$('#myModalSchedulesRequisitions').modal('toggle');
			 $('#myModalSchedulesRequisitions').modal('show');
			  clearInterval(intervalor);
}

function findDayOfWeek(data){
	
	var dias_semana = new Array("Domingo", "Segunda-feira",
      "Terça-feira", "Quarta-feira", "Quinta-feira",
      "Sexta-feira", "Sábado");
	var fragmentDate = data.split("/");
	
	fragmentDate[0]++;
	
	var stringDate = fragmentDate[2]+"-"+fragmentDate[1]+"-"+fragmentDate[0];
    var data = new Date(stringDate);
	var atualDate = new Date();
	
	if(data.getDate() == atualDate.getDate()){
		    var dia = data.getDay();
			return "Hoje";
	}else{
		 var dia = data.getDay();
			return "Proxima(o) "+dias_semana[dia];
	}
	
}

function formatDate(data){
	var fragmentDate = data.split("/");
	return fragmentDate[0]+"/"+fragmentDate[1];
}

function clearAllSchedule() {
    $("#colSchedule_1").html("");
    $("#colSchedule_2").html("");
    $("#colSchedule_3").html("");
    $("#colSchedule_4").html("");
    $globalSchedule["#colSchedule_1"] = "";
    $globalSchedule["#colSchedule_2"] = "";
    $globalSchedule["#colSchedule_3"] = "";
    $globalSchedule["#colSchedule_4"] = "";
    $("button[name='employee']").removeClass("active underline");
}

function checkFreeColumn() {
    if ($.trim($("#colSchedule_1").html()) === '') {
        return "#colSchedule_1";
    }
    if ($.trim($("#colSchedule_2").html()) === '') {
        return "#colSchedule_2";
    }
    if ($.trim($("#colSchedule_3").html()) === '') {
        return "#colSchedule_3";
    }
    if ($.trim($("#colSchedule_4").html()) === '') {
        return "#colSchedule_4";
    }
    return false;
}

function getUserSchedule(freeColumn, user, date) {
    if (date === undefined || date === "") {
        var diaAtual = new Date();
        date = diaAtual.getDate() + "/" + (diaAtual.getMonth() + 1) + "/" + diaAtual.getFullYear();
    }
    var urlToSchedule = getControllerPath("dashboard").replace("dashboard/", "");
    $.ajax({
        method: "POST",
        url: urlToSchedule + "/Schedule/personalSchedule",
        data: {userId: user, scheduleDay: date}
    }).done(function (msg) {
        if (msg != false) {
            $(freeColumn).html(msg);
        } else {
            alert("Não foi possivel buscar a agenda do usuario");
            return false;
        }
    });
}

function removeScheduleSolicitation(indice){
	
	globalScheduleSolicitation[indice].status = "SOLICITATION_DOES_NOT_ACCEPTED";
	var jsonText = JSON.stringify(globalScheduleSolicitation);
	
	$.ajax({			
			type: "POST",			
			data:{
				fileText:jsonText
			},			
			url: "/jezzy-business/portal/dashboard/writeFile",
			success: function(result){	
			
			$("#notification-item-"+indice).fadeOut(300);
	
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
				alert("ERROR")
		}
	  });
	  
	  $counter--;
	  $("#notification-counter").html("<span>"+counter+"</span>");
	  if($counter == 0){
		 $('#myModalSchedulesRequisitions').modal('toggle');
			 $('#myModalSchedulesRequisitions').modal('hide');
	  }

}

function aproveScheduleSolicitation(indice){
	alert(indice);
	globalScheduleSolicitation[indice].status = "SOLICITATION_ACCEPTED";
	var jsonText = JSON.stringify(globalScheduleSolicitation);
	$.ajax({			
			type: "POST",			
			data:{
				fileText:jsonText
			},			
			url: "/jezzy-business/portal/dashboard/writeFile",
			success: function(result){	
			
			$("#notification-item-"+indice).fadeOut(300);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
				alert("ERROR")
		}
	  });
	  
	    $counter--;
		$("#notification-counter").html("<span>"+counter+"</span>");
	  
	  if($counter == 0){
	  $('#myModalSchedulesRequisitions').modal('toggle');
			 $('#myModalSchedulesRequisitions').modal('hide');
	  }
	
}

function suggestNewSchedule(indice){
	var newSchedule = $("#suggest-new-"+indice).val();
	globalScheduleSolicitation[indice].status = "NEW_SUGGESTED_SCHEDULING";
	globalScheduleSolicitation[indice].suggestScheduling = newSchedule;
	var jsonText = JSON.stringify(globalScheduleSolicitation);
	
	$.ajax({			
			type: "POST",			
			data:{
				fileText:jsonText
			},			
			url: "/jezzy-business/portal/dashboard/writeFile",
			success: function(result){	
			
			$("#notification-item-"+indice).fadeOut(300);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
				alert("ERROR")
		}
	  });
	
	  $counter--;
	  $("#notification-counter").html("<span>"+counter+"</span>");
	  
	  if($counter == 0){
	  $('#myModalSchedulesRequisitions').modal('toggle');
			 $('#myModalSchedulesRequisitions').modal('hide');
	  }
}

/**
* Quando há um clique no usuário
*/
function userItemClicked(userName, userId, userEmail, userPhone){

	$("#userId").val(userId);
	$("#clientSchedule").val(userName);
	$("#content-names").fadeOut(0);
	$("#emailSchedule").val(userEmail);
	$("#phoneSchedule").val(userPhone);
	$("#emailSchedule").prop('disabled', true);
	$("#phoneSchedule").prop('disabled', true);
	$( "#newUserSchedule" ).prop( "checked", false );
	$("#user-profile-link").fadeIn(300); 
}

function valdiateScheduleFilds() {
    var time = $("#initialTimeSchecule").val();
    var service = $("#serviceSchedule").val();
    var price = $("#valueSchedule").val();
    var client = $("#clientSchedule").val();
    var phone = $("#phoneSchedule").val();
    if (time === '' || service === '0' || price === '' || client === '' || phone === '') {
        alert("Todos os campos são obrigatórios");
        return false;
    } else {
        return true;
    }

}





