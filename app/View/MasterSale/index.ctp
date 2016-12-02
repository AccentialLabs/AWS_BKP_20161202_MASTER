	<?php

	/* 
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */
	echo $this->Html->css('View/MasterSale', array('inline' => false)); 
	echo $this->Html->script('View/MasterSale', array('inline' => false));

	$todasTotal = 0;
	foreach($todasVendas as $vend){
		$todasTotal += $vend['Checkout']['total_value'];
	}
	 
	$minhasTotal = 0;
	foreach ($minhasVendas as $minhs) {
		$minhasTotal += $minhs['Checkout']['total_value'];
	}

	$anualTotal = 0;
	foreach($todasVendas as $ven){
		if(date("Y") ==  date('Y', strtotime($ven['Checkout']['date']))){
			
			$anualTotal += $ven['Checkout']['total_value'];
		}
	}

	$mensalTotal = 0;
	foreach($todasVendas as $ven){
		if(date("Y") ==  date('Y', strtotime($ven['Checkout']['date']))){
		 
			 if(date("M") ==  date('M', strtotime($ven['Checkout']['date']))){
			
			$mensalTotal += $ven['Checkout']['total_value'];
		}
			
		}
	}

	$atualMonth  = date('m');
	?>

	<br/>
	<h1 class="page-header" id="code">Vendas</h1>
	<?php //print_r($todasVendas);?>
	<div class="panel panel-default">
		<div class="panel-body">
			<table class="table">
				<thead>
					<tr>
						<th>TOTAL DE VENDAS:</th>
						<th>TOTAL MINHAS VENDAS:</th>
						<th>TOTAL MENSAL:</th>
						<th>TOTAL ANUAL:</th>
						<th>QUANTIDADE DE VENDAS:</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo 'R$'.number_format($todasTotal, 2, ',', '.'); ?></td>
						<td><?php echo 'R$'.number_format($minhasTotal, 2, ',', '.'); ?></td>
						<td><?php echo 'R$'.number_format($mensalTotal, 2, ',', '.'); ?></td>
						<td><?php echo 'R$'.number_format($anualTotal, 2, ',', '.'); ?></td>
						<td><?php echo count($todasVendas); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div id="">
		<ul class="nav nav-tabs">
			<li ><a data-toggle="tab" href="#section0">Minhas Vendas</a></li>
			<li class="active"><a data-toggle="tab" href="#sectionB">Todas as Vendas</a></li>
			<li><a data-toggle="tab" href="#sectionInicioTransacao">Status - Inicio da Transação</a></li>
			<li><a data-toggle="tab" href="#sectionAutorizado">Status - Autorizado</a></li>
			<li><a data-toggle="tab" href="#sectionIniciado">Status - Iniciado</a></li>
			<li><a data-toggle="tab" href="#sectionBoletoImpresso">Status - Boleto Impresso</a></li>
			<li><a data-toggle="tab" href="#sectionConcluido">Status - Concluido</a></li>
			<li><a data-toggle="tab" href="#sectionCancelado">Status - Cancelado</a></li>
			<li><a data-toggle="tab" href="#sectionEmAnalise">Status - Em Analise</a></li>
			<li><a data-toggle="tab" href="#sectionEstornado">Status - Estornado</a></li>
			<li><a data-toggle="tab" href="#sectionEmRevisao">Status - Em Revisao</a></li>
			<li><a data-toggle="tab" href="#sectionReembolsado">Status - Reembolsado</a></li>
		</ul>
		<div class="tab-content">
			<div id="section0" class="tab-pane fade"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Minhas Vendas
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaAllCheckouts" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<div class="col-md-3">
		<div class="input-group pull-left" >
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-filter"></span> </span>
			<select id="selectFilterMonth" class="form-control">
				<option>Lista por Mês</option>
				<?php if($atualMonth >= 1){?>
				<option value="1">Jan</option>
				<?php } ?>
				<?php if($atualMonth >= 2){?>
				<option value="2">Fev</option>
				<?php } ?>
				<?php if($atualMonth >= 3){?>
				<option value="3">Mar</option>
				<?php } ?>
				<?php if($atualMonth <= 4){?>
				<option value="4">Abr</option>
				<?php } ?>
				<?php if($atualMonth >= 5){?>
				<option value="5">Mai</option>
				<?php } ?>
				<?php if($atualMonth >= 6){?>
				<option value="6">Jun</option>
				<?php } ?>
				<?php if($atualMonth >= 7){?>
				<option value="7">Jul</option>
				<?php } ?>
				<?php if($atualMonth >= 8){?>
				<option value="8">Ago</option>
				<?php } ?>
				<?php if($atualMonth >= 9){?>
				<option value="9">Set</option>
				<?php } ?>
				<?php if($atualMonth >= 10){?>
				<option value="10">Out</option>
				<?php } ?>
				<?php if($atualMonth >= 11){?>
				<option value="11">Nov</option>
				<?php } ?>
				<?php if($atualMonth >= 12){?>
				<option value="12">Dez</option>
				<?php }?>
				</select>
				</div>
				<br/>
		</div>
				<div class="col-md-4 text-center"> 
				<div class="panel panel-default">
					<div class="panel-body">
				<span id="recebeTotalMensal"></span>
				</div>
				</div>
				<br/>
				</div>
				<table class="table table-hover" id="allMyCheckouts">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody id="tbodyMinhasVendas">
						<?php foreach ($minhasVendas as $venda) { ?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_state_id']) {
		case 1:
			echo "AUTORIZADO";
			break;
		case 2:
			echo "INICIADO";
			break;
		case 3:
			echo "BOLETO IMPRESSO";
			break;
		 case 4:
			echo "CONCLUIDO";
			break;
		 case 5:
			echo "CANCELADO";
			break;
		 case 6:
			echo "EM ANALISE";
			break;
		 case 7:
			echo "ESTORNADO";
			break;
		 case 8:
			echo "EM REVISAO";
			break;
		 case 9:
			echo "REEMBOLSADO";
			break;
		 case 14:
			echo "INICIO DA TRANSACAO";
			break;
	}
								?>

							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
			
			
	<!-- TODAS AS VENDAS -->
			  <div id="sectionB" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Todas Vendas
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaAllCheckouts2" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckouts">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { ?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><?php echo $venda['Company']['fancy_name']; ?></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_state_id']) {
		case 1:
			echo "AUTORIZADO";
			break;
		case 2:
			echo "INICIADO";
			break;
		case 3:
			echo "BOLETO IMPRESSO";
			break;
		 case 4:
			echo "CONCLUIDO";
			break;
		 case 5:
			echo "CANCELADO";
			break;
		 case 6:
			echo "EM ANALISE";
			break;
		 case 7:
			echo "ESTORNADO";
			break;
		 case 8:
			echo "EM REVISAO";
			break;
		 case 9:
			echo "REEMBOLSADO";
			break;
		 case 14:
			echo "INICIO DA TRANSACAO";
			break;
	}
								?>

							</td>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</div>

			
	<!-- INICIO TRANSACAO -->
			  <div id="sectionInicioTransacao" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Inicio da Transação
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaInicioTransacao" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsInicioTransacao">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 14){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								INICIO DA TRANSAÇÃO
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			
			
	<!-- AUTORIZADO -->
			  <div id="sectionAutorizado" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
					   Autorizado
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaAutorizado" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsAutorizado">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 1){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								AUTORIZADO
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			
	<!-- Iniciado -->
			  <div id="sectionIniciado" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Iniciado
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaIniciado" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsIniciado">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 2){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								INICIADO
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			
			
	<!-- BOLETO IMPRESSO -->
			  <div id="sectionBoletoImpresso" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Boleto Impresso
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaBoletoImpresso" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsBoletoImpresso">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 3){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								BOLETO IMPRESSO
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			
			
			
	<!-- CONCLUIDO -->
			  <div id="sectionConcluido" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Concluido
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaConcluido" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsConcluido">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 4){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								CONCLUIDO
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			
			
			<!-- CANCELADO -->
			  <div id="sectionCancelado" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Cancelado
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaCancelado" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsConcluido">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 5){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								CANCELADO
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			
			<!-- em analise -->
			  <div id="sectionEmAnalise" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Em Analise
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaEmAnalise" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsEmAnalise">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 6){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								EM ANALISE
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			
			
			
			
				<!-- em analise -->
			  <div id="sectionEstornado" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Estornado
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaEstornado" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsEstornado">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 7){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								ESTORNADO
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			
		
			<!-- em revisao -->
			  <div id="sectionEmRevisao" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Em Revisão
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaEmRevisao" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsEmRevisao">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 8){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								Em Revisão 
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
			
			
			
			<!-- em revisao -->
			  <div id="sectionReembolsado" class="tab-pane"> 

				<br/>
				<div class="panel panel-default">
					<div class="panel-body">
						Reembolsado
					</div>
				</div>

				<div class="col-md-4">
					<div class="input-group pull-left" >
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
						<input type="text" id="txtBuscaReembolsado" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
					</div>
				</div>
				<br/><br/>
				<table class="table table-hover" id="allCheckoutsReembolsado">
					<thead>
						<tr>
							<th>ID</th>
							<th>DATA</th>
							<th>PRODUTO</th>
							<th>COMPRADOR</th>
							<th>EMPRESA</th>
							<th>VALOR</th>
							<th>METODO DE PAGAMENTO</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($todasVendas as $venda) { 
							if($venda['Checkout']['payment_state_id'] == 9){?>
						<tr>
							<td><?php echo $venda['Checkout']['id']; ?></td>
							<td><?php echo date('d/m/Y', strtotime($venda['Checkout']['date']));?></td>
							<td><?php echo $venda['Offer']['title']; ?></td>
							<td><?php echo $venda['User']['name']; ?></td>
							<td><a href="http://localhost/jezzy-master/portal/masterCompany/index/<?php echo $venda['Checkout']['id']; ?>"><?php echo $venda['Company']['fancy_name']; ?></a></td>
							<td><?php echo number_format($venda['Checkout']['total_value'], 2, ',', '.'); ?></td>

							<td>
								<?php 
								
								switch ($venda['Checkout']['payment_method_id']) {
		case 3:
			echo "CARTÃO DE CRÉD. VISA";
			break;
		case 5:
			echo "CARTÃO DE CRÉD. MASTER CARD";
			break;
		case 7:
			echo "CARTÃO DE CRÉD. AMERICAN EX.";
			break;
		 case 8:
			echo "CARTÃO DE CRÉD. DINERS";
			break;
		 case 10:
			echo "CARTÃO DE CRÉD. ELO";
			break;
		 case 15:
			echo "CARTÃO DE CRÉD. HIPER";
			break;
		 case 73:
			echo "BOOLETO BRADESCO";
			break;
		 case 999:
			echo "EM REVISAO";
			break;
		 case 0:
			echo "ops...";
			break;
	}
								?>

							</td>

							<td>
								Reembolsado
							</td>
						</tr>
						<?php }}?>
					</tbody>
				</table>
			</div>
		
		</div>
	</div>

