$(document).ready(function(){
     $(".phone").mask("(00) 0000-00009");

});
function exibeUserIndication(name, photo) {
          
        $("#recebe-usuario").html("<span class='col-md-12'><span class='col-md-3'></span><img id='imagem' src='"+photo+"' class='col-md-6' style='margin-bottom:15px;'/><span class='col-md-3'></span></span></br></br><span class='col-md-12' style='text-align:center; font-size:1.5em'>"+name+"</span>");
        
        $("#imagem").load(this, function(){

                if (navigator.appVersion.indexOf("iPhone")==-1) {

                    EXIF.getData(this, function () {
                        var make = EXIF.getTag(this, "Orientation");
                        console.log(make);
                        if (make == 6) {
                            $("#imagem").addClass("rotate");
                        }else if (make == 3) {
                            $("#imagem").addClass("rotateh");
                        }else if (make == 8) {
                            $("#imagem").addClass("rotatew");
                        }
                    });
                }

            });

}
function exibeInfoIndication(contato, email, telefone, salao, qtpessoas, dataindicacao) {
                       
                        var date = dataindicacao.split(' ');
                        var separateddate = date[0].split('-');
                        var getDate = separateddate[2]+"/"+separateddate[1]+'/'+separateddate[0];
                          
       $("#recebe-infoindication").html("<div style='text-align:center; color:#101010'><span style='font-weight:bolder'>NOME DO CONTATO: </span><span style='color:#101010'>"+contato + "</span></br><span style='font-weight:bolder'>EMAIL DO SALÃO: </span><span style='color:#101010'>" + email + "</span></br><span style='font-weight:bolder'>TELEFONE DO SALÃO: </span><span class='phone' style='color:#101010'>" + telefone+"</span></br><span style='font-weight:bolder'>DATA DA INDICAÇÃO: </span><span style='color:#101010'>" + getDate + "</span></br><span style='font-weight:bolder'>QUANTIDADE DE INDICAÇÕES: </span><span style='color:#101010'>" + qtpessoas+"</span></div>");
       $(".phone").mask("(00) 0000-00009");
        if(salao!==''){
           $("#TituloModal").html("<div style='text-align:center;color:#101010;font-weight:bolder'>SALÃO INDICADO</div><div style='text-align:center;color:#101010'>"+ salao + "</div>");
        }else{
           $("#TituloModal").html("<div style='text-align:center;color:#101010;font-weight:bolder'>INDICAÇÃO</div>");
        }
       
}
function mudarStatus(id, selectid) {

    var status =  $("#"+selectid).val();
    var url = '/jezzy-master/portal/Controller/MasterIndicationsUserController';

    
                 $.ajax({
                type: "POST",
                data: {
                    status: status,
                    id: id
                },
                url: "/jezzy-master/portal/masterIndicationsUser/changeStatusIndications",
                success: function(result) {
                        
                    var novatr = document.getElementById("trid"+id).outerHTML;
                    var tr = $("#trid"+id).closest('tr');
                    tr.fadeOut(400, function(){ 
                    tr.remove(); 
                    }); 
                    if(status === 'CONTATADO'){
                        $("#tbody-contatados").append(novatr);
                        $('#'+selectid+' option[value="CONTATADO"]').attr({ selected : "selected" });
                    }else if(status === 'REGISTRADO'){
                        $("#tbody-registrados").append(novatr);
                        $('#'+selectid+' option[value="REGISTRADO"]').attr({ selected : "selected" });
                    }else if(status === 'DESINTERESSADO'){
                        $("#tbody-desinteressados").append(novatr);
                        $('#'+selectid+' option[value="DESINTERESSADO"]').attr({ selected : "selected" });
                    }else if(status === 'INDICADO'){
                        $("#tbody-indicados").append(novatr);
                        $('#'+selectid+' option[value="INDICADO"]').attr({ selected : "selected" });
                    }
                    
                    
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Houve algume erro no processamento dos dados desse usuário, atualize a página e tente novamente!");
                }
            });
              
              
}
