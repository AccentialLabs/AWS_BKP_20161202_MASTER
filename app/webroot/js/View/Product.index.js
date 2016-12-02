$(document).ready(function () {

    $(".glyphicon-share").click(function () {
        var id = $(this).attr("id");
        shareOffer('ACTIVE', 'ACTIVE', 'ACTIVE', id);
    });

    $("#sections").on("click", ".glyphicon-pause", function () {
        var offerId = $(this).closest('td')[0].id;
        changeOfferStatus(offerId, "INATIVO").done(function (msg) {
            console.log(msg);
            if (msg === "1") {
                $("#"+offerId).html('<span class="glyphicon glyphicon-play"></span>');
            } else {
                alert("Não foi possivel ativar sua oferta. Refresh a pagina e tente novamente.");
            }
        });
    });

    $("#sections").on("click", ".glyphicon-play", function () {
        var offerId = $(this).closest('td')[0].id;
        changeOfferStatus(offerId, "ATIVO").done(function (msg) {
            if (msg === "1") {
                $("#"+offerId).html('<span class="glyphicon glyphicon-pause"></span>');
            } else {
                alert("Não foi possivel pausar sua oferta. Refresh a pagina e tente novamente.");
            }
        });
    });
	
});

function changeOfferStatus(offerId, offerStatus) {
    return $.ajax({
        method: "POST",
        url: getControllerPath("Product") + "changeOfferStatus",
        data: {Offer: {id: offerId, status: offerStatus}}
    });
}

function shareOffer(fbk, twt, gplus, id) {
    var link = getControllerPath("product") + 'product/offerDetail?offer=' + id;
    if (fbk == 'ACTIVE') {
        window.open('http://www.facebook.com/sharer.php?u=' + link + '?title=facebook', 'share', 'toolbar=0, status=0, width=650, height=450');
    }
    if (twt == 'ACTIVE') {
        window.open("https://twitter.com/intent/tweet?text= &url=" + link, 'share1', 'toolbar=0, status=0, width=650, height=450');
    }
    if (gplus == 'ACTIVE') {
        window.open('https://plus.google.com/share?url=' + link, 'share2', 'toolbar=0, status=0, width=650, height=450');
    }
}

function showOfferDetail(id){
	
	$.ajax({			
			type: "POST",			
			data:{
				OfferId:id
			},			
			url: getControllerPath("Product") + "getOfferDetails",
			success: function(result){	
			
			$("#recebe-offer-detail").html(result);
			$('#myModal').modal('toggle');
			 $('#myModal').modal('show');
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
		}
	  });
	
}
