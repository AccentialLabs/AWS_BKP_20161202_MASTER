/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {

	
	$("#selectFilterMonth").change(function(){
			
			
			var month = $(this).val();
			
			//alert(month);
			
			$.ajax({			
			type: "POST",			
			data:{
			month: month
			},			
			url: "/jezzy-master/portal/masterSale/getAllSalesByMonth",
			success: function(result){	
		
			//alert(result);
			console.log(result);
			$("#tbodyMinhasVendas").html(result);
			//$(".month-loading").fadeOut(200);
			var total = $("#totalValueMensal").val();
			total = total.replace(".", ",");
			$("#recebeTotalMensal").html("<h5><strong>TOTAL DE VENDAS DO MÊS "+month+":</strong></h5> R$"+total);
			
		},
		error: function(XMLHttpRequest, textStatus, errorThrown){
			alert("Houve algume erro no processamento dos dados dessa compra, atualize a pÃ¡gina e tente novamente!");
			alert(errorThrown);
		}
	  });
			
    });

     $('#txtBuscaAllCheckouts').keyup(function() {
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
	
	
     $('#txtBuscaAllCheckouts2').keyup(function() {
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
	
     $('#txtBuscaInicioTransacao').keyup(function() {
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
     $('#txtBuscaAutorizado').keyup(function() {
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
     $('#txtBuscaIniciado').keyup(function() {
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
     $('#txtBuscaBoletoImpresso').keyup(function() {
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
     $('#txtBuscaConcluido').keyup(function() {
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
     $('#txtBuscaCancelado').keyup(function() {
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
     $('#txtBuscaEmAnalise').keyup(function() {
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
     $('#txtBuscaEstornado').keyup(function() {
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
     $('#txtBuscaEmRevisao').keyup(function() {
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
     $('#txtBuscaReembolsado').keyup(function() {
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
    
    
    $('#allMyCheckouts').each(function() {
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

    $('#allCheckouts').each(function() {
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

    $('#allCheckoutsInicioTransacao').each(function() {
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

    $('#allCheckoutsAutorizado').each(function() {
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


    $('#allCheckoutsIniciado').each(function() {
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

    $('#allCheckoutsBoletoImpresso').each(function() {
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

    $('#allCheckoutsConcluido').each(function() {
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

    $('#allCheckoutsReembolsado').each(function() {
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

    $('#allCheckoutsEstornado').each(function() {
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

    $('#allCheckoutsEmAnalise').each(function() {
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
	
	   $('#allCheckoutsEmRevisao').each(function() {
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

    $('#allCheckoutsCancelado').each(function() {
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

    $(".company-logo").mouseover(function() {
        var id = $(this).attr("id");
        $("#" + id + "-logo").fadeIn();
    });

    $(".company-logo").mouseout(function() {
        var id = $(this).attr("id");
        $("#" + id + "-logo").fadeOut();
    });
});


