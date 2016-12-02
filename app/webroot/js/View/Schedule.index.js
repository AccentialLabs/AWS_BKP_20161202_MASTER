$globalSchedule = {
    "#colSchedule_1": "",
    "#colSchedule_2": "",
    "#colSchedule_3": "",
    "#colSchedule_4": ""};
	
function showUserDetail(){
		var id = $("#userId").val();
		
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


Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

$(document).ready(function () {

	 $('#dateSchecule').val(new Date().toDateInputValue());

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

    $("#dateSchedule").bind("change", ".form-control", function () {
        clearAllSchedule();
    });

    $("#serviceSchedule").bind("change", ".form-control", function () {
        if ($("#serviceSchedule").val() !== '0') {
            $.ajax({
                method: "POST",
                url: getControllerPath("schedule") + "ajaxGetServicePrice",
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


    $("#columnsSchecule").on("click", ".glyphicon-plus", function () {
        $("#userId").val($(this).attr("name"));
        $('#myModal').modal('show');
		$("#showModal").trigger("click");
    });

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
		
            addNewSchedule(userID, chooseDay).done(function (msg) {
                if (msg !== 'false') {
                    getUserSchedule(getKeyByValue(userID, $globalSchedule), userID, chooseDay);
                } else {
                    alert("Agendamento não realizado. Tente novamente.");
                }
            }).always(function () {
                $("#initialTimeSchecule").val("");
                $("#serviceSchedule").val('0');
                $("#valueSchedule").val("");
                $("#clientSchedule").val("");
                $("#phoneSchedule").val("");
            });
			
            $('#myModal').modal('hide');
        }
    });

    $("#limpar").click(function () {
        clearAllSchedule();
    });

    $("#columnsSchecule").on("click", ".glyphicon-minus", function () {
        var ids = $(this).attr("id");
        var scheID = ids.split("-")[1];
        var secUserId = ids.split("-")[0];
        if (confirm("Tem certeza que deseja exluir o agendamento?")) {
            var chooseDay = $("#dateSchedule").val();
            removeSchedules(scheID).done(function (msg) {
                if (msg !== 'false') {
                    alert("Agendamento exluido com sucesso.");
                    getUserSchedule(getKeyByValue(secUserId, $globalSchedule), secUserId, chooseDay);
                } else {
                    alert("Não foi possivel excluir o agendamento");
                }
            });
        }
    });

    $("#columnsSchecule").on("click", ".glyphicon-ok", function () {
        var ids = $(this).attr("id");
        var scheID = ids.split("-")[1];
        var secUserId = ids.split("-")[0];
        if (confirm("Esta ação não pode ser desfeita.\n\nMarcar este agendamento como realizado?")) {
            var chooseDay = $("#dateSchedule").val();
            changeScheduleStatus(scheID).done(function (msg) {
                if (msg !== 'false') {
                    getUserSchedule(getKeyByValue(secUserId, $globalSchedule), secUserId, chooseDay);
                } else {
                    alert("Não foi realizar a ação no momento");
                }
            });
        }
    });


    $('.numbersOnly').keyup(function () {
        this.value = this.value.replace(/[^0-9()-\.]/g, '');
    });
	
	$("#newUserSchedule").change(function(){
		if($(this).is(":checked")){
			$("#emailSchedule").removeAttr('disabled');
			$("#phoneSchedule").removeAttr('disabled');
		}else{
			$("#emailSchedule").attr("disabled","disabled");
			$("#phoneSchedule").attr("disabled","disabled");
		}
	});
	
	
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
		
		$(".search-user-item").click(function(){
		
			alert("clique");
		});
		
			
		$("#clientSchedule").keyup(function(){
		
			$("#emailSchedule").prop('disabled', false);
			$("#phoneSchedule").prop('disabled', false);
			$( "#newUserSchedule" ).prop( "checked", true );
		});
		
		$('html').click(function() {
			$("#content-names").fadeOut(0);
		});

});


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

function removeSchedules(scheduleId) {
    return $.ajax({
        method: "POST",
        url: getControllerPath("schedule") + "ajaxRemoveSchedule",
        data: {Schedule: {
                scheduleId: scheduleId
            }
        }
    });
}

function changeScheduleStatus(scheduleId) {
    return $.ajax({
        method: "POST",
        url: getControllerPath("schedule") + "ajaxChangeScheduleStatus",
        data: {Schedule: {
                scheduleId: scheduleId
            }
        }
    });
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
    $.ajax({
        method: "POST",
        url: getControllerPath("Schedule") + "personalSchedule",
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

function addNewSchedule(secondaryUser, chooseDay) {
    var time = $("#initialTimeSchecule").val();
    var service = $("#serviceSchedule").val();
    var price = $("#valueSchedule").val();
    var client = $("#clientSchedule").val();
    var phone = $("#phoneSchedule").val();
	var userId = $("#userId").val();
    return $.ajax({
        method: "POST",
        url: getControllerPath("schedule") + "ajaxAddSchedule",
        data: {Schedule: {
                schedulehour: time,
                serviceId: service,
                schedulePrice: price,
                scheduleClient: client,
                schedulePhone: phone,
                scheduleSecondaryUser: secondaryUser,
                scheduleDate: chooseDay,
				userId: userId
            }
        }
    });
}

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