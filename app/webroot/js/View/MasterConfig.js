/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {

    $('#txtBusca').keyup(function() {
        var that = this;
        $.each($('tr'),
                function(i, val) {
                    if ($(val).text().indexOf($(that).val()) == -1) {
                        $('tr').eq(i).hide();
                    } else {
                        $('tr').eq(i).show();
                    }
                });
    });

    $('#allSecondaryUsers').each(function() {
        var currentPage = 0;
        var numPerPage = 7;
        var $table = $(this);
        $table.bind('repaginate', function() {
            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pager"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function(event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        $pager.insertAfter($table).find('span.page-number:first').addClass('active');

    });

    //SAVE NEW SECONDARY USER
    $("#userModalButom").click(function() {
        var name = $("#secundary_user_name").val();
        var email = $("#secundary_user_email").val();
        var type = $("#secundary_user_type").val();

        $.ajax({
            type: "POST",
            data: {
                secondary_type_id: type,
                name: name,
                email: email
            },
            url: "/jezzy-master/portal/masterConfig/createSecondUser",
            success: function(result) {
                // $($("#" + id)).closest('tr').remove();
                alert("Usuário cadastrado");
                $('#modal').modal('toggle');
                $('#modal').modal('hide');
                location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
            }
        });

    });

	 $("#comp-logo-preview").on('click', function () {
        $("#comp-logo-upper").click();
    });

    $("#comp-logo-upper").change(function () {
        readLogoURL(this);
    });

    $("#file-img").change(function () {
        readURL(this);
    });

});

function removeSecondaryUser(id) {

    $.ajax({
        type: "POST",
        data: {
            id: id
        },
        url: "/jezzy-master/portal/masterConfig/removeSecondaryUser",
        success: function(result) {
            // $($("#" + id)).closest('tr').remove();
            $("#status-" + id).html("<span class='label label-danger'>Inativo</span>");
            $("#button-" + id).html('<span class="glyphicon glyphicon-play table-icon reative" onclick="reativeSecondaryUser(' + id + ');"></span>');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
        }
    });
}

function reativeSecondaryUser(id) {

    $.ajax({
        type: "POST",
        data: {
            id: id
        },
        url: "/jezzy-master/portal/masterConfig/reativeSecondaryUser",
        success: function(result) {
            // $($("#" + id)).closest('tr').remove();
            $("#status-" + id).html("<span class='label label-success'>Ativo</span>");
            $("#button-" + id).html(' <span class="glyphicon glyphicon-remove table-icon remove" onclick="removeSecondaryUser(' + id + ');"></span>');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
        }
    });
}

function editSecondaryUser(index) {

    $.ajax({
        type: "POST",
        data: {
            index: index
        },
        url: "/jezzy-master/portal/masterConfig/showEditSecondUser",
        success: function(result) {
            // $($("#" + id)).closest('tr').remove();

            $("#form-insert-edit").html(result);
            $('#myModal').modal('toggle');
            $('#myModal').modal('show');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
        }
    });

}

function saveEditSecondary() {

    alert('2');
    var name = $("#secundary_user_name").val();
    var email = $("#secundary_user_email").val();
    var type = $("#secundary_user_type").val();
    var id = $("#secundary_user_id").val();

    $.ajax({
        type: "POST",
        data: {
            secondary_type_id: type,
            name: name,
            email: email,
            id: id
        },
        url: "/jezzy-master/portal/masterConfig/saveUpdateSecondaryUser",
        success: function(result) {
            // $($("#" + id)).closest('tr').remove();
            alert("Usuário editado");
            $('#modal').modal('toggle');
            $('#modal').modal('hide');
            location.reload();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
        }
    });
}

function readLogoURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#comp-logo-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#back-comp-img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}



