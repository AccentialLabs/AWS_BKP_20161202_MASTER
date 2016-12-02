$(document).ready(function () {

    $("#buttonAddNewUser").click(function () {
        $("#secundary_user_name").val("");
        $("#secundary_user_email").val("");
        $("#secundary_user_type").val("");
        $('#myModal').modal('show');
		$("#editSecondaryUser").val("false");
		$("#editSecondaryUserID").val(" ");
    });

    $("#userModalButom").click(function () {
		
		var isEdit = $("#editSecondaryUser").val();
			 $('#deleteUserModal').modal('toggle');
			 $('#deleteUserModal').modal('show');
	
		if(isEdit == "false"){
	
        var secUserName = $("#secundary_user_name").val();
        var secUserEmail = $("#secundary_user_email").val();
        var secUserType = $("#secundary_user_type").val();
        if (secUserName === "" || secUserEmail === "" || secUserType === "") {
            alert("Todos os campos são obrigatórios.");
            return false;
        }
        addNewLineOnSecondUser(secUserName, secUserEmail, secUserType).done(function (msg) {
            if (msg !== "0") {
                var user = jQuery.parseJSON(msg);
                console.log(user);
                var tableline =
                        '<tr>' +
                            '<td>' + user.secondary_users.name + '</td>' +
                            '<td>' + user.secondary_users.email + '</td>' +
                            '<td>' + user.secondary_users_types.name + '</td>' +
							 '<td><span id="edit-' + user.secondary_users.name + '" class="glyphicon glyphicon-pencil glyph-button" onclick="editUser(' + user.secondary_users.name + ', ' + user.secondary_users.email + ', '+ user.secondary_users_types.name +', ' + user.secondary_users.id + ')"></span></td>' +
                            '<td><span id="' + user.secondary_users.id + '" class="glyphicon glyphicon-remove-sign"></span></td>' +
                        '</tr>';
                $("#secundaryUserTable").append(tableline);
            } else {
                alert("Não foi");
            }
        });
        $('#myModal').modal('hide');
		
		}else{
			
			var id = $("#editSecondaryUserID").val();
			var secUserName = $("#secundary_user_name").val();
			var secUserEmail = $("#secundary_user_email").val();
			var secUserType = $("#secundary_user_type").val();
			
			$.ajax({
				method: "POST",
				url: "/jezzy-business/portal/user/editSecondaryUser",
				data: {SecondaryUser: {name: secUserName, email: secUserEmail, type: secUserType, id: id}}
			});
			$('#myModal').modal('hide');
		}
		
		 
    });

	//CLIQUE EM REMOVER
    $("#secundaryUserTable").on("click", ".glyphicon-remove-sign", function () {
        var userId = $(this).children("td").context.id;
		
		$("#userIdDelete").val(userId);
		$('#deleteUserModal').modal('toggle');
		$('#deleteUserModal').modal('show');
		
      /*  removeSecondUser(userId).done(function (msg) {
            if (msg !== "0") {
                $($("#" + userId)).closest('tr').remove();
                alert("Usuário removido");
            } else {
                alert("Não foi possivel remover o usuário. Regarregue a pagina e tente novamente");
            }
        }); */
    });
	
	$("#btnDeleteUser").click(function(){
		var userId = $("#userIdDelete").val();
		
		removeSecondUser(userId).done(function (msg) {
            if (msg !== "0") {
                $($("#" + userId)).closest('tr').remove();
                alert("Usuário removido");
            } else {
                alert("Não foi possivel remover o usuário. Regarregue a pagina e tente novamente");
            }
        });
			$('#deleteUserModal').modal('toggle');
			 $('#deleteUserModal').modal('hide');
	});
	
	$("#btnReativeUser").click(function(){
		var userId = $("#userIdReative").val();
		alert(userId);
		
		reativeSecondUser(userId).done(function (msg) {
            if (msg !== "0") {
                $($("#" + userId)).closest('tr').remove();
                alert("Usuário reativado");
            } else {
                alert("Não foi possivel reativar o usuário. Regarregue a pagina e tente novamente");
            }
        });
			$('#deleteUserModal').modal('toggle');
			 $('#deleteUserModal').modal('hide');
	});
});


function reativeUser(id){

	$("#userIdReative").val(id);
	$('#reativeUserModal').modal('toggle');
	$('#reativeUserModal').modal('show');
}

function addNewLineOnSecondUser(userName, userEmail, userType) {
    return $.ajax({
        method: "POST",
        url: getControllerPath("User") + "addSecondaryUver",
        data: {SecondaryUser: {name: userName, email: userEmail, type: userType}}
    });
}

function removeSecondUser(userId) {
    return $.ajax({
        method: "POST",
        url: getControllerPath("User") + "removeSecondUser",
        data: {SecondaryUser: {id: userId}}
    });
}

function reativeSecondUser(userId){

	 return $.ajax({
        method: "POST",
        url: getControllerPath("User") + "reativeSecondUser",
        data: {SecondaryUser: {id: userId}}
    });
}

function editUser(name, email, cargo, id){
	
	$("#editSecondaryUserID").val(id);
	$("#editSecondaryUser").val("true");
	$("#secundary_user_name").val(name);
	$("#secundary_user_email").val(email);
	$("#secundary_user_type").val(cargo);
	$('#myModal').modal('show');
}