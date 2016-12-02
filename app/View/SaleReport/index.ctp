<?php $this->Html->css('View/SaleReport.index', array('inline' => false)); ?>
<?php $this->Html->script('Library/Print/printThis', array('inline' => false)); ?>
<?php $this->Html->script('Library/Barcode/bytescoutbarcode128_1.00.07', array('inline' => false)); ?>
<?php $this->Html->script('util', array('inline' => false)); ?>
<?php $this->Html->script('View/SaleReport.index', array('inline' => false)); ?>



<div class="screen">
    <h1 class="page-header">Relatório de vendas</h1>
	
	<div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
		<input id="filter" type="text" class="form-control" placeholder="Pesquisa por produto, status, comprador ou data">
	</div>
	
	<br/>
    <div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#sectionA">Todas as Vendas</a></li>
            <li><a data-toggle="tab" href="#sectionB">Vendas Concluidas</a></li>
            <li><a data-toggle="tab" href="#sectionC">Vendas Pendentes</a></li>
        </ul>
        <div class="tab-content">
            <div id="sectionA" class="tab-pane fade in active">
                <table class="table table-bordered table-condensed small" id="tableId">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Status</th>
                            <th class="col-md-3">Produto</th>
                            <th>Comprador</th>
                            <th>Valor</th>
                            <th>Comentario</th>
                            <th>Etiqueta</th>
							<th>Detalhe</th>
                        </tr>
                    </thead>
                    <tbody class="searchable">
                        <?php
                        if (is_array($allSales)) {
                            foreach ($allSales as $saleAll) {
                                $payment_state_id = "";
                                switch ($saleAll['Checkout']['payment_state_id']) {
                                    case 1:
                                        $payment_state_id = "AUTORIZADO";
                                        break;
                                    case 2:
                                        $payment_state_id = "INICIADO";
                                        break;
                                    case 3:
                                        $payment_state_id = "BOLETO IMPRESSO";
                                        break;
                                    case 4:
                                        $payment_state_id = "CONCLUIDO";
                                        break;
                                    case 5:
                                        $payment_state_id = "CARTÃO DE CRÉDITO";
                                        break;
                                    case 6:
                                        $payment_state_id = "EM ANALISE";
                                        break;
                                    case 7:
                                        $payment_state_id = "CARTÃO DE CRÉDITO";
                                        break;
                                    case 8:
                                        $payment_state_id = "EM REVISAO";
                                        break;
                                    case 9:
                                        $payment_state_id = "REEMBOLSADO";
                                        break;
                                    case 14:
                                        $payment_state_id = "INICIO DA TRANSACAO";
                                        break;
                                    case 73:
                                        $payment_state_id = "BOLETO IMPRESSO";
                                        break;
                                }

                                if ($saleAll['OffersComment']) {
                                    $offerComment = substr($saleAll['OffersComment']['description'], 0, 300);
                                } else {
                                    $offerComment = "Não possui comentário.";
                                }
                                echo '
                                    <tr>
                                        <td>' . date('d/m/Y', strtotime($saleAll['Checkout']['date'])) . '</td>
                                        <td>' . $payment_state_id . '</td>
                                        <td>' . $saleAll['Offer']['title'] . '</td>
                                        <td>' . $saleAll['User']['name'] . '</td>
                                        <td> R$' . $saleAll['Checkout']['total_value'] . '</td>
                                        <td>' . $offerComment . '</td>
                                        <td><span id="' . $saleAll['Checkout']['id'] . '" class="glyphicon glyphicon-tags"></span></td>
										<td><a href="#" onclick="showCheckoutDetail('.$saleAll['Checkout']['id'] .')"><span class="glyphicon glyphicon-plus"></span></a></td>
                                    </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="sectionB" class="tab-pane fade">
                <table class="table table-bordered table-condensed small" id="tableId">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Status</th>
                            <th class="col-md-3">Produto</th>
                            <th>Comprador</th>
                            <th>Valor</th>
                            <th>Comentario</th>
                            <th>Etiqueta</th>
							<th>Detalhe</th>
                        </tr>
                    </thead>
                    <tbody class="searchable">
                        <?php
                        if (is_array($allSalesDone)) {
                            foreach ($allSalesDone as $saleDone) {
                                $payment_state_id = "";
                                switch ($saleDone['Checkout']['payment_state_id']) {
                                    case 1:
                                        $payment_state_id = "AUTORIZADO";
                                        break;
                                    case 2:
                                        $payment_state_id = "INICIADO";
                                        break;
                                    case 3:
                                        $payment_state_id = "BOLETO IMPRESSO";
                                        break;
                                    case 4:
                                        $payment_state_id = "CONCLUIDO";
                                        break;
                                    case 5:
                                        $payment_state_id = "CARTÃO DE CRÉDITO";
                                        break;
                                    case 6:
                                        $payment_state_id = "EM ANALISE";
                                        break;
                                    case 7:
                                        $payment_state_id = "CARTÃO DE CRÉDITO";
                                        break;
                                    case 8:
                                        $payment_state_id = "EM REVISAO";
                                        break;
                                    case 9:
                                        $payment_state_id = "REEMBOLSADO";
                                        break;
                                    case 14:
                                        $payment_state_id = "INICIO DA TRANSACAO";
                                        break;
                                    case 73:
                                        $payment_state_id = "BOLETO IMPRESSO";
                                        break;
                                }

                                if ($saleDone['OffersComment']) {
                                    $offerComment = substr($saleDone['OffersComment']['description'], 0, 300);
                                } else {
                                    $offerComment = "Não possui comentário.";
                                }
                                echo '
                                    <tr>
                                        <td>' . date('d/m/Y', strtotime($saleDone['Checkout']['date'])) . '</td>
                                        <td>' . $payment_state_id . '</td>
                                        <td>' . $saleDone['Offer']['title'] . '</td>
                                        <td>' . $saleDone['User']['name'] . '</td>
                                        <td> R$' . $saleDone['Checkout']['total_value'] . '</td>
                                        <td>' . $offerComment . '</td>
                                        <td><span id="' . $saleDone['Checkout']['id'] . '" class="glyphicon glyphicon-tags"></span></td>
										<td><a href="#" onclick="showCheckoutDetail('.$saleDone['Checkout']['id'] .')"><span class="glyphicon glyphicon-plus"></span></a></td>
                                    </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div id="sectionC" class="tab-pane fade">
                <table class="table table-bordered table-condensed small" id="tableId">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Status</th>
                            <th class="col-md-3">Produto</th>
                            <th>Comprador</th>
                            <th>Valor</th>
                            <th>Comentario</th>
                            <th>Etiqueta</th>
							<th>Detalhe</th>
                        </tr>
                    </thead>
                    <tbody class="searchable">
                        <?php
                        if (is_array($allSalesPending)) {
                            foreach ($allSalesPending as $salePending) {
                                $payment_state_id = "";
                                switch ($salePending['Checkout']['payment_state_id']) {
                                    case 1:
                                        $payment_state_id = "AUTORIZADO";
                                        break;
                                    case 2:
                                        $payment_state_id = "INICIADO";
                                        break;
                                    case 3:
                                        $payment_state_id = "BOLETO IMPRESSO";
                                        break;
                                    case 4:
                                        $payment_state_id = "CONCLUIDO";
                                        break;
                                    case 5:
                                        $payment_state_id = "CARTÃO DE CRÉDITO";
                                        break;
                                    case 6:
                                        $payment_state_id = "EM ANALISE";
                                        break;
                                    case 7:
                                        $payment_state_id = "CARTÃO DE CRÉDITO";
                                        break;
                                    case 8:
                                        $payment_state_id = "EM REVISAO";
                                        break;
                                    case 9:
                                        $payment_state_id = "REEMBOLSADO";
                                        break;
                                    case 14:
                                        $payment_state_id = "INICIO DA TRANSACAO";
                                        break;
                                    case 73:
                                        $payment_state_id = "BOLETO IMPRESSO";
                                        break;
                                }

                                if ($salePending['OffersComment']) {
                                    $offerComment = substr($salePending['OffersComment']['description'], 0, 300);
                                } else {
                                    $offerComment = "Não possui comentário.";
                                }
                                echo '
                                    <tr>
                                        <td>' . date('d/m/Y', strtotime($salePending['Checkout']['date'])) . '</td>
                                        <td>' . $payment_state_id . '</td>
                                        <td>' . $salePending['Offer']['title'] . '</td>
                                        <td>' . $salePending['User']['name'] . '</td>
                                        <td> R$' . $salePending['Checkout']['total_value'] . '</td>
                                        <td>' . $offerComment . '</td>
                                        <td><span id="' . $salePending['Checkout']['id'] . '" class="glyphicon glyphicon-tags"></span></td>
										<td><a href="#" onclick="showCheckoutDetail('.$salePending['Checkout']['id'] .')"><span class="glyphicon glyphicon-plus"></span></a></td>
                                    </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" >
            <div class="modal-content" id="modelContent">
                <div class="modal-header">
                    <?php echo $this->Html->image('jezzy_images/modal_header.png', array('class' => 'modalHeaderImg')); ?>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <strong>Destinarario:</strong>
                    </div>
                    <div class="row">
                        Nome: <span id="senderName">Matheus Odilon</span> 
                    </div>
                    <div class="row">
                        End: <span id="senderAddress">Rua Cubatão 411 - Sala 3 </span>
                    </div>
                    <div class="row">
                        Cidade: <span id="senderCity">São Paulo SP </span>
                    </div>
                    <div class="row">
                        CEP: <span id="senderPostal">04013041 </span>
                    </div>
                    <div class="row ">
                        <div>
                            <img id="barcodeImage" class="codeBarImage" />
                        </div>
                    </div>
                    <div class="row">
                        <strong>Remetente:</strong> 
                    </div>

                    <div class="row">
                        Nome: <span id="recipientName"><?php echo $this->Session->read('CompanyLoggedIn.Company.fancy_name'); ?></span>
                    </div>
                    <div class="row">
                        End: <span id="recipientAddress"><?php echo $this->Session->read('CompanyLoggedIn.Company.address') . ' ' . $this->Session->read('CompanyLoggedIn.Company.number') . ' - ' . $this->Session->read('CompanyLoggedIn.Company.complement') ?></span>
                    </div>
                    <div class="row">
                        Cidade: <span id="recipientCity"><?php echo $this->Session->read('CompanyLoggedIn.Company.city') . ' - ' . $this->Session->read('CompanyLoggedIn.Company.state') ?> </span>
                    </div>
                    <div class="row">
                        CEP: <span id="recipientPostal"><?php echo $this->Session->read('CompanyLoggedIn.Company.zip_code'); ?> </span>
                    </div>
                    <div class="row marginTop15">
                        <button  type="button" class="btn btn-default btn-xs print" id="btnPrint" >Imprimir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="printable"></div>

<!-- POP UP -->
<!-- DETALHE DE USUÁRIO -->
<div id="myModalSaleReport" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" >
        <div class="modal-content" id="modelContent">
            <div class="modal-body">
			<form action="<?php echo $this->Html->url("addSubclass"); ?>" method="post">
                <div class="form-horizontal" id="recebe">
				
                </div>
				</form>
				<hr />
				<div class="form-group">
                            <div class=" buttonLocation">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalSaleReport" id="btnShowModal">
  Launch modal
</button> 
	
