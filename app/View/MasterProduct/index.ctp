<?php

echo $this->Html->css('View/MasterProduct', array('inline' => false)); 
echo $this->Html->script('View/MasterProduct', array('inline' => false));
?>
<br/>
<div>
    <h1 class="page-header letterSize"><span>Ofertas</span></h1>
</div>

<div class="row">

    <div class="col-md-12">
        <div class="pull-right">
            <a href="/jezzy-master/portal/masterInsertOffer"><button class="btn btn-default pull-right" type="button" >Nova Oferta   <span class="glyphicon glyphicon-plus"></span></button></a>
            <button class="btn btn-default pull-right" type="button" id="openSpreadsheet" data-toggle="modal" data-target="#myModal">Importar planilha de produtos   <span class="glyphicon glyphicon-floppy-save"></span></button>
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#section0">Minhas Ofertas</a></li>
        <li><a data-toggle="tab" href="#sectionA">Todas Ofertas</a></li>
        <li><a data-toggle="tab" href="#sectionB">Ofertas Ativas</a></li>
        <li><a data-toggle="tab" href="#sectionC">Ofertas Inativas</a></li>
    </ul>
    <div class="tab-content">

        <div id="section0" class="tab-pane fade in active">
            <br/>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBusca" placeholder="Pesquise por Nome da Oferta, Empresa, Data..." class="form-control"/>
                    </div>
                </div>
            </div>
            <br/><br/>
            <table class="table table-hover" id="myOffers">
                <thead>
                    <tr>
                        <th><small>ID</small></th>
                        <th><small>TITULO</small></th>
                        <th><small>VALOR</small></th>
			<th class="text-center"><small>PORCENTAGEM<BR/>DESCONTO</small></th>
                        <th><small>INICIO</small></th>
                        <th><small>FINAL</small></th>
			<th class="text-center"><small>CLIQUES EM DETALHE</small></th>
			<th class="text-center"><small>CLIQUES EM COMPRAR</small></th>
			<th class="text-center"><small>COMPRAS COM BOLETO</small></th>
			<th class="text-center"><small>COMPRAS COM CARTÃO</small></th>
                        <th><small>STATUS</small></th>
                        <th><small>AVALIAÇÃO</small></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>


                    <?php
               
                    if(!empty($myOffers)){
                    foreach($myOffers as $offer){
                        
                                $nota = 0;
                           
                            $estrelas = $this->Html->image('jezzy_icons/' . $nota . '.png', array('class' => 'starOffer', 'title' => $nota));
                        ?>
                    <tr>
                        <td><small><?php echo $offer['Offer']['id'];?></small></td>
                        <td align="center"><small><span data-toggle="tooltip" data-placement="top" title="<?php echo $offer['Offer']['title']; ?>"><?php echo substr($offer['Offer']['title'],0, 13);?></span></small></td>
                        <td><small><?php echo str_replace(".", ",", $offer['Offer']['value']);?></small></td>
			<td align="center"><small><?php echo str_replace(".", ",", $offer['Offer']['percentage_discount']); ?></small></td>
                        <td align="center"><small><?php echo date('d/m/Y', strtotime($offer['Offer']['begins_at']));?></small></td>
                        <td align="center"><small><?php if($offer['Offer']['ends_at'] === '0000-00-00 00:00:00'){echo "<small>sem fim previsto</small>";}else{echo date('d/m/Y', strtotime($offer['Offer']['ends_at']));}?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['details_click'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['checkouts_click'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['purchased_billet'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['purchased_card'];?></small></td>
                        <td id="statustext<?php echo $offer['Offer']['id']?>"><small><?php 
                            if ($offer['Offer']['status'] == 'INACTIVE') {
                                echo "INATIVA";
                            } else {
                                echo "ATIVA";
                          
                            }
                        ?></small></td>
                        <td><small><?php echo $estrelas; ?></small></td>
                        <td><small>
                            <?php 
                           if ($offer['Offer']['status'] == 'INACTIVE') {
                               echo '<span id="statusicon'.$offer['Offer']['id'].'" class="glyphicon glyphicon-play active-icon" onclick="offerClickDesactivate('.$offer["Offer"]["id"].', 1)"></span>';
                            } else {
                                echo '<span id="statusicon'.$offer['Offer']['id'].'" class="glyphicon glyphicon-pause inactive-icon" onclick="offerClickActivate('.$offer["Offer"]["id"].', 1)"></span>';
                            } ?></small>
                        </td>
                        <td><small>
                            <?php echo $this->Html->link('editar', array('controller' => 'masterInsertOffer', 'action' => 'index', $offer['Offer']['id'])); ?></small>
                        </td>
                    </tr>
                    <?php }
                    }?>
					
                </tbody>
            </table>
        </div>

        <div id="sectionA" class="tab-pane fade">
            <br/>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBusca" placeholder="Pesquise por Nome da Oferta, Empresa, Data..." class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4 pull-right">
                    <button class="btn btn-default pull-right" type="button" >--</button>
                </div>
            </div>
            <br/><br/>
            <table class="table table-hover" id="allOffers">
                <thead>
                        <tr>
                        <th><small>ID</small></th>
                        <th><small>TITULO</small></th>
                        <th><small>VALOR</small></th>
			<th class="text-center"><small>PORCENTAGEM<BR/>DESCONTO</small></th>
                        <th><small>INICIO</small></th>
                        <th><small>FINAL</small></th>
			<th class="text-center"><small>CLIQUES EM DETALHE</small></th>
			<th class="text-center"><small>CLIQUES EM COMPRAR</small></th>
			<th class="text-center"><small>COMPRAS COM BOLETO</small></th>
			<th class="text-center"><small>COMPRAS COM CARTÃO</small></th>
                        <th><small>STATUS</small></th>
                        <th><small>AVALIAÇÃO</small></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					if(!empty($offers)){
					foreach($offers as $offer){
                         if ($offer['Offer']['status'] == 'INACTIVE') {
                                $iconPlayPause = '<span id="statusicon2'.$offer['Offer']['id'].'" onclick="offerClickDesactivate('.$offer["Offer"]["id"].', 2)" class="glyphicon glyphicon-play active-icon"></span>';
                            } else {
                                $iconPlayPause = '<span id="statusicon2'.$offer['Offer']['id'].'" onclick="offerClickActivate('.$offer["Offer"]["id"].', 2)" class="glyphicon glyphicon-pause inactive-icon"></span>';
                            }
                            
                        
                                $nota = 0;
                            
                            $estrelas = $this->Html->image('jezzy_icons/' . $nota . '.png', array('class' => 'starOffer', 'title' => $nota));
                        ?>
                    <tr>
                        <td><small><?php echo $offer['Offer']['id'];?></small></td>
                        <td align="center"><small><span data-toggle="tooltip" data-placement="top" title="<?php echo $offer['Offer']['title']; ?>"><?php echo substr($offer['Offer']['title'],0, 13);?></span></small></td>
                        <td><small><?php echo str_replace(".", ",", $offer['Offer']['value']);?></small></td>
                        <td align="center"><small><?php echo str_replace(".", ",", $offer['Offer']['percentage_discount']);?></small></td>
                        <td align="center"><small><?php echo date('d/m/Y', strtotime($offer['Offer']['begins_at']));?></small></td>
                        <td align="center"><small><?php echo date('d/m/Y', strtotime($offer['Offer']['ends_at']));?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['details_click'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['checkouts_click'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['purchased_billet'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['purchased_card'];?></small></td>
                        <td align="center"><small><?php echo $iconPlayPause; ?></td>
                        
                        <td><small><?php echo $estrelas; ?></td>
                    </tr>
                    <?php }}?>
                </tbody>
            </table>
        </div>

        <!-- OFERTAS ATIVAS -->
        <div id="sectionB" class="tab-pane fade">
            <br/>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBusca" placeholder="Pesquise por Nome da Oferta, Empresa, Data..." class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4 pull-right">
                    <button class="btn btn-default pull-right" type="button" >--</button>
                </div>
            </div>
            <br/><br/>
            <table class="table table-hover" id="activeOffers">
                <thead>
                      <tr>
                        <th><small>ID</small></th>
                        <th><small>TITULO</small></th>
                        <th><small>VALOR</small></th>
			<th class="text-center"><small>PORCENTAGEM<BR/>DESCONTO</small></th>
                        <th><small>INICIO</small></th>
                        <th><small>FINAL</small></th>
			<th class="text-center"><small>CLIQUES EM DETALHE</small></th>
			<th class="text-center"><small>CLIQUES EM COMPRAR</small></th>
			<th class="text-center"><small>COMPRAS COM BOLETO</small></th>
			<th class="text-center"><small>COMPRAS COM CARTÃO</small></th>
                        <th><small>STATUS</small></th>
                        <th><small>AVALIAÇÃO</small></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					if(!empty($offers)){
					foreach($offers as $offer){
                        if($offer['Offer']['status'] == 'ACTIVE'){
                         if ($offer['Offer']['status'] == 'INACTIVE') {
                                $iconPlayPause = '<span id="statusicon3'.$offer['Offer']['id'].'" onclick="offerClickDesactivate3('.$offer["Offer"]["id"].')" class="glyphicon glyphicon-play active-icon"></span>';
                            } else {
                                $iconPlayPause = '<span id="statusicon3'.$offer['Offer']['id'].'" onclick="offerClickActivate3('.$offer["Offer"]["id"].')" class="glyphicon glyphicon-pause inactive-icon"></span>';
                            }
                       
                                $nota = 0;
                         
                            $estrelas = $this->Html->image('jezzy_icons/' . $nota . '.png', array('class' => 'starOffer', 'title' => $nota));
                        ?>
                    <tr>
                        <td><small><?php echo $offer['Offer']['id'];?></small></td>
                        <td align="center"><small><span data-toggle="tooltip" data-placement="top" title="<?php echo $offer['Offer']['title']; ?>"><?php echo substr($offer['Offer']['title'],0, 13);?></span></td>
                        <td><small><?php echo str_replace(".", ",", $offer['Offer']['value']);?></small></td>
                        <td align="center"><small><?php echo str_replace(".", ",", $offer['Offer']['percentage_discount']);?></small></td>
                        <td align="center"><small><?php echo date('d/m/Y', strtotime($offer['Offer']['begins_at']));?></small></td>
                        <td align="center"><small><?php echo date('d/m/Y', strtotime($offer['Offer']['ends_at']));?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['details_click'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['checkouts_click'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['purchased_billet'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['purchased_card'];?></small></td>
                        <td align="center"><small><?php echo $iconPlayPause; ?></small></td>
                       
                        <td><small><?php echo $estrelas; ?></small></td>
                    </tr>
                    <?php }
                    
                            }}?>
                </tbody>
            </table>
        </div>

        <!-- OFERTAS ATIVAS -->
        <div id="sectionC" class="tab-pane fade">
            <br/>
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBusca" placeholder="Pesquise por Nome da Oferta, Empresa, Data..." class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4 pull-right">
                    <button class="btn btn-default pull-right" type="button" >--</button>
                </div>
            </div>
            <br/><br/>
            <table class="table table-hover" id="inactiveOffers">
                <thead>
                    <tr>
                        <th><small>ID</small></th>
                        <th><small>TITULO</small></th>
                        <th><small>VALOR</small></th>
			<th class="text-center"><small>PORCENTAGEM<BR/>DESCONTO</small></th>
                        <th><small>INICIO</small></th>
                        <th><small>FINAL</small></th>
			<th class="text-center"><small>CLIQUES EM DETALHE</small></th>
			<th class="text-center"><small>CLIQUES EM COMPRAR</small></th>
			<th class="text-center"><small>COMPRAS COM BOLETO</small></th>
			<th class="text-center"><small>COMPRAS COM CARTÃO</small></th>
                        <th><small>STATUS</small></th>
                        <th><small>AVALIAÇÃO</small></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					if(!empty($offers)){
					foreach($offers as $offer){
                        if($offer['Offer']['status'] == 'INACTIVE'){
                         if ($offer['Offer']['status'] == 'INACTIVE') {
                                $iconPlayPause = '<span id="statusicon4'.$offer['Offer']['id'].'" onclick="offerClickDesactivate4('.$offer["Offer"]["id"].')" class="glyphicon glyphicon-play active-icon"></span>';
                            } else {
                                $iconPlayPause = '<span id="statusicon4'.$offer['Offer']['id'].'" onclick="offerClickActivate4('.$offer["Offer"]["id"].')" class="glyphicon glyphicon-pause inactive-icon"></span>';
                            }
                            
                           /** $numeroVotantes = $offer['Statistics'][0]['votantes'];
                            if (!empty($offer['Statistics'][0]['votantes'])) {
                                $nota = $offer['Statistics'][0]['evaluation'] / $offer['Statistics'][0]['votantes'];
                            } else { **/
                                $nota = 0;
                           /** } **/
                            $estrelas = $this->Html->image('jezzy_icons/' . $nota . '.png', array('class' => 'starOffer', 'title' => $nota));
                        ?>
                    <tr>
                        <td><small><?php echo $offer['Offer']['id'];?></small></td>
                        <td align="center"><small><span data-toggle="tooltip" data-placement="top" title="<?php echo $offer['Offer']['title']; ?>"><?php echo substr($offer['Offer']['title'],0, 13);?></span></small></td>
                        <td><small><?php echo str_replace(".", ",", $offer['Offer']['value']);?></small></td>
                        <td align="center"><small><?php echo str_replace(".", ",", $offer['Offer']['percentage_discount']);?></small></td>
                        <td align="center"><small><?php echo date('d/m/Y', strtotime($offer['Offer']['begins_at']));?></small></td>
                        <td align="center"><small><?php echo date('d/m/Y', strtotime($offer['Offer']['ends_at']));?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['details_click'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['checkouts_click'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['purchased_billet'];?></small></td>
			<td align="center"><small><?php echo $offer['Statistics']['offers_statistics']['purchased_card'];?></small></td>
                        <td align="center"><small><?php echo $iconPlayPause; ?></small></td>
                        
                        <td><small><?php echo $estrelas; ?></small></td>
                    </tr>
                    <?php }
                    
                            }}?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL PLANILHA -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4  id="myModalLabel">Importar planilha de Produtos</h4>
            </div>
            <form action="masterProduct/configImportOfferINSERTandUPDATE" method="post" enctype="multipart/form-data">
                <div class="modal-body" id="recebe-offer-detail">

                    <input type="file" id="file" name="file">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
