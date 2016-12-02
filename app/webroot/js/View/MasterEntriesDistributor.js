
$( document ).ready(function() {
   
});
	
function clickEditDistributor(index) {


    $.ajax({
        type: "POST",
        data: {
            companyIndex: index
        },
        url: "/jezzy-master/portal/masterEntries/editDistribute",
        success: function(result) {

            $("#distributorCompanyForm").attr('action', 'masterEntries/saveDistribute');

            $("#cadastro-recebe").html(result);
            $('#myModal').modal('toggle');
            $('#myModal').modal('show');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Houve algume erro no processamento dos dados desse usuÃ¡rio, atualize a pÃ¡gina e tente novamente!");
        }
    });
}
function SaveCommission(id, commission){
   var com = commission;
    $.ajax({
        type: "POST",
        data: {
            id: id,
            commission:commission
        },
        url: "/jezzy-master/portal/masterEntries/SaveCommission",
        success: function(result) {
            commission = (com/1).toFixed(2);
            document.getElementById('Commission'+id).value = commission;
            // $($("#" + id)).closest('tr').remove();
            alert("Salvo com Sucesso!");
           
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
                     
            alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
        }
    });
}
function clickEditFinancialParameter(index) {


    $.ajax({
        type: "POST",
        data: {
            financialParameterIndex: index
        },
        url: "/jezzy-master/portal/masterEntries/editFinancialParameter",
        success: function(result) {

            $("#distributorCompanyForm").attr('action', 'masterEntries/saveDistribute');

            $("#cadastro-paramentros-financeiros").html(result);
            $('#myModalNewFinancialParameter').modal('toggle');
            $('#myModalNewFinancialParameter').modal('show');
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Houve algume erro no processamento dos dados desse usuÃ¡rio, atualize a pÃ¡gina e tente novamente!");
        }
    });
}

