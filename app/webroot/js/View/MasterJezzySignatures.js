	$(function(){

			/**
			*clique no botão para desativar plano
			**/
			$(".inactivePlan").click(function(){
					
					var planCode = $(this).attr("id");
					var funcao = 'inactivate';
					
					  $.ajax({
				method: "POST",
				url: '/jezzy-master/portal/MasterJezzySignatures/activeOrInactivePlan',
				data:{
					activeOrInactive:funcao,
					planCode: planCode
				}
			}).done(function(result) {

				location.reload(); 

			}).error(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			});
			});
			
			
			/**
			*clique no botão para ativar plano
			**/
			$(".activePlan").click(function(){
			
				var planCode = $(this).attr("id");
				var funcao = 'activate';
				
				  $.ajax({
				method: "POST",
				url: '/jezzy-master/portal/MasterJezzySignatures/activeOrInactivePlan',
				data:{
					activeOrInactive:funcao,
					planCode: planCode
				}
			}).done(function(result) {

					location.reload(); 

			}).error(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			});
			
			});
			
			/**
			* clique no botão que suspende assinatura
			*/
			$(".inactiveSubscribe").click(function(){
				
				var cancelOrSuspend = "suspend";
				var codigo = $(this).attr("id");
				
				  $.ajax({
				method: "POST",
				url: '/jezzy-master/portal/MasterJezzySignatures/suspendOrCancelSubscribe',
				data:{
					subscriptionCode:codigo,
					suspendOrCancel: cancelOrSuspend
				}
			}).done(function(result) {

					location.reload(); 

			}).error(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			});
			
			});
			
			/**
			* clique no botão que cancela assinatura
			*/
			$(".cancelSubscribe").click(function(){
			
				var cancelOrSuspend = "cancel";
				var codigo = $(this).attr("id");
				
				  $.ajax({
				method: "POST",
				url: '/jezzy-master/portal/MasterJezzySignatures/suspendOrCancelSubscribe',
				data:{
					subscriptionCode:codigo,
					suspendOrCancel: cancelOrSuspend
				}
			}).done(function(result) {

					location.reload(); 

			}).error(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			});
			
			});
			
			/**
			* clique no botão que reativa assinatura
			**/
			$(".activeSubscribe").click(function(){
			
					var cancelOrSuspend = "activate";
				var codigo = $(this).attr("id");
				
				  $.ajax({
				method: "POST",
				url: '/jezzy-master/portal/MasterJezzySignatures/suspendOrCancelSubscribe',
				data:{
					subscriptionCode:codigo,
					suspendOrCancel: cancelOrSuspend
				}
			}).done(function(result) {

					location.reload(); 

			}).error(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			});
			
			});
			
			
			$(".alterNextInvoiceDate").click(function(){
			
			var code = $(this).attr("id");
			$("#subscriptionsCode").val(code);
			
			});
			
			$("#btnNextInvoiceDate").click(function(){
			
					var value = $("#amount").val();
					var date = $("#nextInvoiceDate").val();
					var code = $("#subscriptionsCode").val();
					
						  $.ajax({
				method: "POST",
				url: '/jezzy-master/portal/MasterJezzySignatures/chanceNextInvoiceDate',
				data:{
					amount:value,
					date: date,
					code: code
				}
			}).done(function(result) {

					location.reload(); 

			}).error(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			});
			});
			
			/**
			* clique no botão para editar plano
			*/
			$(".editPlan").click(function(){
				 var code = $(this).attr("id");
				 var name = $(this).attr("name");
				 $("#planCode").val(code);
				 $("#planName").val(name);
			
			});
			
			$("#btnSaveEditPlan").click(function(){
				
				var code = $("#planCode").val();
				var  newAmount = $("#newAmount").val();
				var planName = $("#planName").val();
				
							  $.ajax({
				method: "POST",
				url: '/jezzy-master/portal/MasterJezzySignatures/changePlanAmount',
				data:{
					amount:newAmount,
					code: code,
					planName:planName
				}
			}).done(function(result) {

					location.reload(); 

			}).error(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			});
				
			});
			
			$(".associateCoupon").click(function(){
			
				var code = $(this).attr("id");
				$("#subscriptionsCode").val(code);
			
			});
			
			$("#btnSaveCouponSubscribe").click(function(){
			
				var code = $("#subscriptionsCode").val();
				var coupon = $("#couponCode").val();
			
			alert(code);
			alert(coupon);
			
								  $.ajax({
				method: "POST",
				url: '/jezzy-master/portal/MasterJezzySignatures/associateCouponToSubscribe',
				data:{
					subscribeCode:code,
					couponCode: coupon
				}
			}).done(function(result) {

					alert(result);

			}).error(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			});
			
			});
			

		});