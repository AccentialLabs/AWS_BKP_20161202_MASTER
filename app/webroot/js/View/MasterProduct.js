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


    $('#myOffers').each(function() {
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


    $('#allOffers').each(function() {
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

    $('#activeOffers').each(function() {
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


    $('#inactiveOffers').each(function() {
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

});
function offerClickActivate(id, n) {
          
     
         $.ajax({
                type: "POST",
                data: {
                    status: 'ACTIVE',
                    id: id
                },
                url: "/jezzy-master/portal/masterProduct/offerClickActivate",
                success: function(result) {
                    if(n == 1){
                     $("#statusicon"+id).removeClass('glyphicon-pause');
                     $("#statusicon"+id).addClass('glyphicon-play'); 
                     $("#statusicon"+id).attr("onclick", "offerClickDesactivate("+id+")");
                     $("#statustext"+id).html('INATIVA'); 
                    }else if (n == 2){
                     $("#statusicon2"+id).removeClass('glyphicon-pause');
                     $("#statusicon2"+id).addClass('glyphicon-play'); 
                     $("#statusicon2"+id).attr("onclick", "offerClickDesactivate("+id+")");
                    }
                  
                },  
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Houve algume erro no processamento dos dados dessa oferta, atualize a página e tente novamente!");
                }
            });
     
     
     
     
   

}
function offerClickDesactivate(id, n) {
          $.ajax({
                type: "POST",
                data: {
                    status: 'INACTIVE',
                    id: id
                },
                url: "/jezzy-master/portal/masterProduct/offerClickDesactivate",
                success: function(result) {
                    if(n == 1){
                       $("#statusicon"+id).removeClass('glyphicon-play'); 
                            $("#statusicon"+id).addClass('glyphicon-pause'); 
                            $("#statusicon"+id).attr("onclick", "offerClickActivate("+id+")"); 
                             $("#statustext"+id).html('ATIVA');  
                    }else if(n == 2){
                        $("#statusicon2"+id).removeClass('glyphicon-play'); 
                            $("#statusicon2"+id).addClass('glyphicon-pause'); 
                            $("#statusicon2"+id).attr("onclick", "offerClickActivate("+id+")"); 
                    }
                            
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Houve algume erro no processamento dos dados dessa oferta, atualize a página e tente novamente!");
                }
            }); 
     
  
}

