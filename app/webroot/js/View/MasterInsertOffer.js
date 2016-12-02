/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
    $("#offers_questionsSaveButton").click(function(){
        
        var hairtype = $("input[name=hairtype]");
        var application = $("input[name=application]");
        var product_categories = $("input[name=product_categories]");
        var public = $("input[name=public]");
        var hairtypes = '';
        var applications = '';
        var product_categoriess = '';
         var publics = '';
        for(var i=0;i<hairtype.length;i++){
            
            if(hairtype[i].checked == true){
               hairtypes += hairtype[i].value+';' 
            }
            
        }
       for(var i=0;i<application.length;i++){
            
            if(application[i].checked == true){
               applications += application[i].value+';' 
            }
            
        }
        for(var i=0;i<product_categories.length;i++){
            
            if(product_categories[i].checked == true){
               product_categoriess += product_categories[i].value+';' 
            }
            
        }
        for(var i=0;i<public.length;i++){
            
            if(public[i].checked == true){
               publics += public[i].value+';' 
            }
            
        }
    
        if(publics == ''){
                        $("#myModalOfferQuestions").modal('hide');
                        $(".modal-backdrop").hide();
                        $("#modelContent").addClass("textCenterModal");
                        $("#modelContent").html('Escolha um gênero para o produto');
                        $('#divMessageErrorOffer').modal('show'); 
        }else{
                   var data = {
          offer_id_modal: $("#offer_id_modal").val(),
          hairtype: hairtypes,
          application: applications,
          product_categories: product_categoriess,
          public: publics
        };
       
    $.ajax({
        url:getControllerPath("MasterInsertOffer") +'addCharacteristicsandCategories',
        type: "POST",
        data: data
    }).done(function(result) {
            
                if(result == ''|| result == '1' ){
                        $("#myModalOfferQuestions").modal('hide');
                        $(".modal-backdrop").hide();
                        $("#modelContent").addClass("textCenterModal");
                        $("#modelContent").html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvo com sucesso');
                        $('#divMessageErrorOffer').modal('show'); 
    }
      
    });
        }
   
    });
    
    
   
    //lista automaticamente nomes dos serviços
    $("#OfferTitle").keyup(function() {
        var inputValue = $("#OfferTitle").val();
        if ($("#offerTypeServiceRadio").is(":checked")) {

            $.ajax({
                type: "POST",
                data: {
                    searchService: inputValue},
                url: "/jezzy-master/portal/service/getServiceByName",
                success: function(result) {
                    $("#search-return").fadeIn(0);
                    $('#search-return').html(result);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });

        } else {
            $("#search-return").fadeIn(0);
        }
    });

   
   $("#offerBrand").keyup(function() {
        var inputValue = $("#offerBrand").val();
     
    if ($("#offerTypeProductRadio").is(":checked")) {
         //alert(inputValue);
            $.ajax({
                type: "POST",
                data: {
                    searchService: inputValue},
                    url: "/jezzy-master/portal/service/getProviderByName",
                success: function(result) {
                 
                    if(result != ''){
                   $("#search-return2").fadeIn(0);
                   $('#search-return2').html(result);
                    }else{
                      
                         
                          $("#search-return2").fadeOut(200);
                          $("#search-return2").addClass('hide');
                    }
                 
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    $("#search-return2").fadeOut(200);
                }
            });
            }else{
                 $("#search-return2").fadeIn(0);
            }
       
    });
   
   
    var elementoHelper = false;
    //mostrando text de help para cada campo
    $(".helper-field").click(function() {
        elementoHelper = $(this).attr("id");
        $("#" + elementoHelper + "Helper").fadeIn(100);
    });

    $(".helper-field").mouseout(function() {
        $("#" + elementoHelper + "Helper").fadeOut(300);
    });

    $("#uper").change(function() {

        readURL(this, 'principal-editimage');
    });

    $("#uper1").change(function() {
        readURL(this, 'editimage1');
    });

    $("#uper2").change(function() {
        readURL(this, 'editimage2');
    });

    $("#uper3").change(function() {
        readURL(this, 'editimage3');
    });

    $("#uper4").change(function() {
        readURL(this, 'editimage4');
    });

    $("#uper5").change(function() {
        readURL(this, 'editimage5');
    });

    $("#offerNoEnds").change(function() {
        if ($(this).is(":checked")) {
            $("#dateHtmlEnd").val("00/00/0000");
            $("#dateHtmlEnd").attr("disabled", "disabled");
        } else {
            $("#dateHtmlEnd").removeAttr('disabled');
        }
    });

    //executar input file quando imagem for clicada
    $("#principal-editimage").bind('click', function() {
        if ($("#offer_id").val() == "") {
            return showErrorAlert("Salve sua oferta antes de começar a colocar as imagens");
        } else {
            $('#uper').click( );
        }
    });
    $("#editimage1").bind('click', function() {
        if ($("#offer_id").val() == "") {
            return showErrorAlert("Salve sua oferta antes de começar a colocar as imagens");
        } else {
            $('#uper1').click( );
        }
    });
    $("#editimage2").bind('click', function() {
        if ($("#offer_id").val() == "") {
            return showErrorAlert("Salve sua oferta antes de começar a colocar as imagens");
        } else {
            $('#uper2').click( );
        }
    });
    $("#editimage3").bind('click', function() {
        if ($("#offer_id").val() == "") {
            return showErrorAlert("Salve sua oferta antes de começar a colocar as imagens");
        } else {
            $('#uper3').click( );
        }
    });
    $("#editimage4").bind('click', function() {
        if ($("#offer_id").val() == "") {
            return showErrorAlert("Salve sua oferta antes de começar a colocar as imagens");
        } else {
            $('#uper4').click( );
        }
    });
    $("#editimage5").bind('click', function() {
        if ($("#offer_id").val() == "") {
            return showErrorAlert("Salve sua oferta antes de começar a colocar as imagens");
        } else {
            $('#uper5').click( );
        }
    });

    $("#optionIfNotPostOffice").hide();

    $("#postNotOfficeOption").click(function() {
        $("#optionIfNotPostOffice").show();
    });

    $("#postOfficeOption").click(function() {
        $("#optionIfNotPostOffice").hide();
    });

    $("#productWeith").hide();

    $("#offerTypeProduct").click(function() {
        $("#productWeithInputField").addClass("requireFild");
        $("#productWeithInputField").attr("required", true);
        $("#offerBrand").removeClass('hide');
        $("#offerLine").removeClass('hide');
        $("#productWeith").show();
        $("#productFreight").show();
        $('#search-return').fadeOut(200);
    });

    $("#offerTypeService").click(function() {
         $("#offerBrand").addClass('hide');
        $("#offerLine").addClass('hide');
        $("#productWeithInputField").removeClass("requireFild");
        $("#productWeithInputField").attr("required", false);
        $("#productWeith").hide();
        $("#productFreight").fadeOut(0);
        $('#search-return2').fadeOut(200);

    });

    $("#canParcelOfferYes").click(function() {
        $("#parcelOfferPercentage").addClass("requireFild");
        $("#parcelOfferPercentage").attr("required", true);
    });

    $("#canParcelOfferNo").click(function() {
        $("#parcelOfferPercentage").removeClass("requireFild");
        $("#parcelOfferPercentage").attr("required", false);
        $("#parcelOfferPercentage").val("");
    });

    $("#addOptionOnOffer").click(function() {
       if ($("#offer_id").val() == "") {
            return showErrorAlert("Salve sua oferta antes de começar a adicionar configurações a ela");
        } else {
            $('#myModalOfferQuestions').modal('show');
        }
       

    });

    $("#mountTableButton").click(function() {
        if ($("#categoryOfferModal").val() === "0" || $("#selectboxY").val() === "0" || $("#selectboxX").val() === "0") {
            var htmlErro = '<div class="well well-sm wellExtraElemnts">Todos os campos são obrigatórios.</div>';
            $('#productOptionsContent').html(htmlErro);
        } else {
            productsOptions();
        }
    });

    $("#targetOffer").click(function() {
        $('#myModalOfferTarget').modal('show');
    });

    $(".glyphicon.glyphicon-remove").click(function() {
        removeImage(this.id);
    });

    $('#resume').summernote({
        height: 150, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear', 'fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('#description').summernote({
        height: 150, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear', 'fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('#specification').summernote({
        height: 150, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear', 'fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    
  

    $("#saveProduct").click(function() {

        if (validadeMinimalFilds()) {
            var data = {
                offer_id: $("#offer_id").val(),
                offer_type: $("input[name='data[Offer][extra_infos][offer_type]']:checked").val(),
                weight: $("#productWeithInputField").val(),
                title: $("#OfferTitle").val(),
                brand: $("#offerBrand").val(),
                line: $("#offerLine").val(),
                resume: $('#resume').code(),
                price: $("#offerPrice").val(),
                price_offer: $("#Offer_discounted_value").val(),
                qtd: $("#offerQtd").val(),
                use_correios_api: $("input[name='data[CompanyPreference][use_correios_api]']:checked").val(),
                delivery_dealine: $("#delivery_dealine").val(),
                delivery_value: $("#delivery_value").val(),
                parcels: $("input[name='data[Offer][parcels]']:checked").val(),
                percentage: $("#parcelOfferPercentage").val(),
                begins_at: $("#dateHtmlBegin").val(),
                ends_at: $("#dateHtmlEnd").val(),
                description: $('#description').code(),
                specification: $('#specification').code(),
                sku: $("#offer_sku").val(),
                split_percentage: $("#percentage_split").val(),
		parcels_quantity: $("#parcels_quantity").val(),
		cost: $("#offerCost").val(),
            };
            $.ajax({
                url: getControllerPath("MasterInsertOffer") + "addEditBasicOfferInformation/",
                type: "POST",
                data: data
            }).done(function(msg) {
			
			console.log(msg);
			var arr_from_json = JSON.parse(msg);
                
                //console.log(arr_from_json);
                // console.log(arr_from_json.Offer);
                console.log(arr_from_json.data.Offer.id);
                if (arr_from_json.status === 'SAVE_OK') {
                    if (showSuccessAlert()) {
                        window.location.replace(getControllerPath("MasterProduct") + "/index/" + arr_from_json.data.Offer.id)+"/";
                    }
                } else {
                    return showErrorAlert("Não foi possivel realizar sua requisição. Tente novamente mais tarde.", "Bad, bad server. No donuts for you!");
                }
            });
        }
        return false;

    });


    $("#myModalOfferOptions").on("submit", "#offerFormOptions", function() {
        var offerId = $("#offer_id").val();
        var actionUrl = getControllerPath("masterInsertOffer") + "saveOptions/";
        $('#offerFormOptions').attr('action', actionUrl);
        $('<input>').attr({type: 'hidden', value: offerId, name: 'offerId'}).appendTo('#offerFormOptions');
        return true;
    });

    $("#myModalOfferTarget").on("submit", "#offerTargetOptions", function() {
        var offerId = $("#offer_id").val();
        var actionUrl = getControllerPath("masterInsertOffer") + "saveFilters/";
        $('#offerTargetOptions').attr('action', actionUrl);
        $('<input>').attr({type: 'hidden', value: offerId, name: 'offerId'}).appendTo('#offerTargetOptions');
        return true;
    });

    lastFormConfiguration();
});

function lastFormConfiguration() {

    if ($('#dateHtmlBegin').val() === "") {
        $('#dateHtmlBegin').val(returnTodayDateDatabaseFormat());
    }

    if ($("#offer_type_jquery").val() !== "") {
        if ($("#offer_type_jquery").val() === "PRODUCT") {
            $("#offerTypeProduct").trigger("click");
        } else {
            $("#offerTypeService").trigger("click");
        }
    }

    if ($("#offer_parcels_jquery").val() !== "") {
        if ($("#offer_parcels_jquery").val() === "INACTIVE") {
            $("#canParcelOfferNo").trigger("click");
        } else {
            $("#canParcelOfferYes").trigger("click");
        }
    }

    if ($("#use_correios_api_jquery").val() !== "") {
        if ($("#use_correios_api_jquery").val() === "CORREIO") {
            $("#postOfficeOption").trigger("click");
        } else {
            $("#postNotOfficeOption").trigger("click");
        }
    }

    if ($("#selectboxY").val() != 0 && $("#selectboxX").val() != 0 && $("#categoryOfferModal").val() != 0) {
        productsOptions();
    }

}

function validadeMinimalFilds() {
    if (!$("input[name='data[Offer][extra_infos][offer_type]']").is(":checked")) {
        return showErrorAlert("Campo " + $("input[name='data[Offer][extra_infos][offer_type]']").attr("placeholder") + " é obrigatório.");
    }
    if ($("input[name='data[Offer][extra_infos][offer_type]']:checked").val() === "PRODUCT") {
        if ($("#productWeithInputField").val() === "") {
            return showErrorAlert("Campo " + $("#productWeithInputField").attr("placeholder") + " é obrigatório.");
        }
    }
    if ($("#OfferTitle").val() === "") {
        return showErrorAlert("Campo " + $("#OfferTitle").attr("placeholder") + " é obrigatório.");
    }
    if ($("#OfferBrand").val() === "") {
        return showErrorAlert("Campo " + $("#OfferBrand").attr("placeholder") + " é obrigatório.");
    }
    if ($('#resume').code() === "") {
        return showErrorAlert("Campo Resumo é obrigatório.");
    }
    if ($("#offerPrice").val() === "") {
        return showErrorAlert("Campo " + $("#offerPrice").attr("placeholder") + " é obrigatório.");
    }
    if ($("#offerQtd").val() === "") {
        return showErrorAlert("Campo " + $("#offerQtd").attr("placeholder") + " é obrigatório.");
    }
    if ($("input[name='data[CompanyPreference][use_correios_api]']:checked").val() === "2") {
        if ($("#delivery_dealine").val() === "") {
            return showErrorAlert("Campo " + $("#delivery_dealine").attr("placeholder") + " é obrigatório.");
        }
        if ($("#delivery_value").val() === "") {
            return showErrorAlert("Campo " + $("#delivery_value").attr("placeholder") + " é obrigatório.");
        }
    }
    if (!$("input[name='data[Offer][parcels]']").is(":checked")) {
        return showErrorAlert("Campo " + $("input[name='data[Offer][parcels]']").attr("placeholder") + " é obrigatório.");
    }
    if ($("input[name='data[Offer][parcels]']:checked").val() === "ACTIVE") {
        if ($("#parcelOfferPercentage").val() === "") {
            return showErrorAlert("Campo " + $("#parcelOfferPercentage").attr("placeholder") + " é obrigatório.");
        }
    }
    return true;
}

function showErrorAlert(mesage, msgHeader) {
    if (msgHeader != null && msgHeader != "" && msgHeader != undefined) {
        $("#errorModalHeader").html(msgHeader);
    }
    $("#modelContent").removeClass("textCenterModal");
    $("#alertContent").html(mesage);
    $('#divMessageErrorOffer').modal('show');
    return false;
}

function showSuccessAlert() {
    $("#modelContent").addClass("textCenterModal");
    $("#modelContent").html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Salvo com sucesso');
    $('#divMessageErrorOffer').modal('show');
    return true;
}

function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#' + id).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        sendImage(id, input.files[0]);
    }
}

function sendImage(id, input) {
    var dataForm = new FormData();

    if (id === "principal-editimage") {
        dataForm.append("sendImageFirst", input);
    } else {
        dataForm.append("sendImage", input);
        dataForm.append("photo_id", $('#' + id).attr('photo_id'));
    }
    dataForm.append("offerId", $("#offer_id").val());
    $('#loading').show();
//    $.ajax({
//        url: getControllerPath("Product") + "uploadOfferImage",
//        type: "POST",
//        cache: false,
//        contentType: false,
//        processData: false,
//        data: dataForm
//    }).done(function(msg) {
//        $('#loading').hide();
//        if (msg !== 'false') {
//            if (showSuccessAlert()) {
//                window.location.replace(getControllerPath("Product") + "productManipulation/" + $("#offer_id").val());
//            }
//        } else {
//            return showErrorAlert("Não foi possivel realizar sua requisição. Tente novamente mais tarde.", "Bad, bad server. No donuts for you!");
//        }
//    });


    $.ajax({
        url: "https://secure.jezzy.com.br/jezzy-master/portal/masterInsertOffer/uploadOfferImage",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: dataForm
    }).done(function(msg) {
        $('#loading').hide();
        if (msg !== 'false') {
            if (showSuccessAlert()) {
                window.location.replace(getControllerPath("Product") + "/productManipulation/" + $("#offer_id").val());
            }
        } else {
            return showErrorAlert("Não foi possivel realizar sua requisição. Tente novamente mais tarde.", "Bad, bad server. No donuts for you!");
        }
    });
}

function removeImage(id) {
    var data = {
        offer_id: $("#offer_id").val(),
        photo_id: id
    };
    $.ajax({
        url: getControllerPath("Product") + "removeImage/",
        type: "POST",
        data: data
    }).done(function(msg) {
        if (msg !== 'false') {
            console.log(msg);
            if (showSuccessAlert()) {
                window.location.replace(getControllerPath("Product") + "/productManipulation/" + $("#offer_id").val());
            }
        } else {
            return showErrorAlert("Não foi possivel realizar sua requisição. Tente novamente mais tarde.", "Bad, bad server. No donuts for you!");
        }
    });
}

function productsOptions() {
    eixoY = $("#selectboxY").val();
    eixoX = $("#selectboxX").val();
    $.ajax({
        method: "POST",
        url: getControllerPath("Product") + "productOptionsTable",
        data: {col: eixoY, line: eixoX, offerId: $("#offer_id_modal").val(), category: $("#categoryOfferModal").val()}
    }).done(function(msg) {
        if (msg !== 'false') {
            $('#productOptionsContent').html(msg);
        } else {
            return showErrorAlert("Não foi possivel realizar sua requisição. Tente novamente mais tarde.", "Bad, bad server. No donuts for you!");
        }
    }).error(function(XMLHttpRequest, textStatus, errorThrown) {
        //alert(errorThrown);
    });
}

function clickInSearch(elementValue) {
    $('#search-return').fadeOut(200);
    $("#OfferTitle").val(elementValue);


}
function clickInSearchBrand(elementValue) {
    $('#search-return2').fadeOut(200);
    $("#offerBrand").val(elementValue);


}
