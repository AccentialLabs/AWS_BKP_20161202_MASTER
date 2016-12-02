<?php

echo $this->Html->css('View/MasterCompany', array('inline' => false)); 
?>
<br/>
<div>
    <h1 class="page-header letterSize"><span><?php echo $company['Company']['fancy_name']; ?></span></h1>
</div>
<div class="row">

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#section0">Dados</a></li>
        <li><a data-toggle="tab" href="#sectionB">Vendas</a></li>
        <li><a data-toggle="tab" href="#sectionD">Ofertas</a></li>
        <li><a data-toggle="tab" href="#sectionC">Seguidores</a></li>
    </ul>

    <div class="tab-content">
        <div id="section0" class="tab-pane fade in active"> 
            <br/>
            <div><strong>Dados da empresa: </strong></div><br/>
            <div class="line"><div class="pull-left text-box"><strong>Nome Fantasia:</strong> <?php echo $company['Company']['fancy_name']; ?></div> <div class="pull-left"><strong>Razão Social:</strong> <?php echo $company['Company']['corporate_name']; ?></div></div>
            <br/>
            <div class="line"><div class="pull-left text-box"><strong>CNPJ:</strong> <?php echo $company['Company']['cnpj']; ?></div> <div class="pull-left text-box"><strong>Telefone:</strong> <?php echo $company['Company']['phone']; ?></div><div class="pull-left text-box"><strong>Telefone 2:</strong> <?php echo $company['Company']['phone_2']; ?></div> <div class="pull-left text-box"><strong>Email:</strong> <a href="<?php echo $company['Company']['email']; ?>"><?php echo $company['Company']['email']; ?></a></div></div>
            <br/><div class="line"><div class="pull-left"><strong>Site:</strong> <?php echo $company['Company']['site_url']; ?></div> </div>
            <br/><hr/><br/>

            <div><strong>Dados da empresa: </strong></div><br/>
            <div class="line"><div class="pull-left text-box"><strong>Nome:</strong> <?php echo $company['Company']['responsible_name']; ?></div> </div>
            <br/><div class="line"><div class="pull-left"><strong>Email:</strong><a href="mailto:<?php echo $company['Company']['responsible_email']; ?>"> <?php echo $company['Company']['responsible_email']; ?></a></div> </div>
            <br/>
            <div class="line">
                <div class="pull-left text-box"><strong>CPF:</strong> <?php echo $company['Company']['responsible_cpf']; ?></div>
                <div class="pull-left text-box "><strong>Telefone:</strong> <?php echo $company['Company']['responsible_phone']; ?></div>
                <div class="pull-left text-box"><strong>Telefone 2:</strong> <?php echo $company['Company']['responsible_phone_2']; ?></div>
                <div class="pull-left"><strong>Celular:</strong> <?php echo $company['Company']['responsible_cell_phone']; ?></div>
            </div>
            <br/><hr/><br/>

            <div><strong>Endereço: </strong></div><br/>
            <div class="line">
                <div class="pull-left text-box "><strong>CEP:</strong> <?php echo $company['Company']['zip_code']; ?></div>
                <div class="pull-left text-box"><strong>Rua:</strong> <?php echo $company['Company']['address']; ?></div>
                <div class="pull-left text-box "><strong>Número:</strong> <?php echo $company['Company']['number']; ?></div>
                <div class="pull-left"><strong>Complemento:</strong> <?php echo $company['Company']['complement']; ?></div>
            </div>
            <br/>
            <div class="line">
                <div class="pull-left text-box"><strong>Bairro:</strong> <?php echo $company['Company']['district']; ?></div>
                <div class="pull-left text-box"><strong>Cidade:</strong> <?php echo $company['Company']['city']; ?></div>
                <div class="pull-left"><strong>UF:</strong> <?php echo $company['Company']['state']; ?></div>
            </div>

            <br/><br/><br/>
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>QUANTIDADE DE VENDAS:</th>
                                <th>TOTAL DE VENDAS:</th>
                                <th>TOTAL DE SEGUIDORES:</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 

        <!-- VENDAS -->
        <div id="sectionB" class="tab-pane fade "> 

            <br/>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Produto</th>
                        <th>Data</th>
                        <th>Total</th>
                        <th>Status da Compra</th>
                        <th>Comprador</th>
                    </tr>
                </thead>
                <tbody>

                    <?php  if(!empty($checkouts)){
                        foreach ($checkouts as $check) {?>
                    <tr>
                        <td><?php echo $check['Checkout']['id']; ?></td>
                        <td><?php echo '<strong>'. $check['Offer']['title'].'</strong><br/> <small>'.$check['Offer']['resume'] .'</small>'; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($check['Checkout']['date'])); ?></td>
                        <td><?php echo 'R$'. str_replace('.', ',',$check['Checkout']['total_value']); ?></td>
                        <td>
                            <?php 
                                  switch ($check['Checkout']['payment_state_id']) {
                                    case 1:
                                        echo  "AUTORIZADO";
                                        break;
                                    case 2:
                                        echo  "INICIADO";
                                        break;
                                    case 3:
                                        echo  "BOLETO IMPRESSO";
                                        break;
                                    case 4:
                                        echo  "CONCLUIDO";
                                        break;
                                    case 5:
                                        echo "CANCELADO";
                                        break;
                                    case 6:
                                        echo  "EM ANALISE";
                                        break;
                                    case 7:
                                        echo  "ESTORNADO";
                                        break;
                                    case 8:
                                        echo  "EM REVISAO";
                                        break;
                                    case 9:
                                        echo  "REEMBOLSADO";
                                        break;
                                    case 14:
                                        echo  "INICIO DA TRANSACAO";
                                        break;
                                    case 73:
                                        echo  "BOLETO IMPRESSO";
                                        break;
                                }
                            ?>

                        </td>
                        <td>
                            <?php echo $check['User']['name']; ?>
                        </td>
                    </tr>
                    <?php }}?>
                </tbody>
            </table>
        </div>

        <!-- SEGUIDORES -->
        <div id="sectionC" class="tab-pane fade "> 
            <br/><br/>

            <?php 
            if(!empty($companiesUser)){
            foreach ($companiesUser as $compUser) {?>
            <ul class="media-list">
                <li class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="<?php echo $compUser['User']['photo'];?>" alt="..." width="100px" height="100px">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $compUser['User']['name'];?></h4>
                        <a href="mailto:<?php echo $compUser['User']['email'];?>"> <?php echo $compUser['User']['email'];?></a><br/>
                        <?php echo $compUser['User']['phone'];?><br/>
                        <?php if(!empty($compUser['User']['city'])){echo $compUser['User']['city'];}?>
                         <?php if(!empty($compUser['User']['state'])){echo ' - '. $compUser['User']['state'];}?>
                    </div>
                </li>
            </ul>
            <hr/>
            <?php }}?>

        </div>
        
          <!-- VENDAS -->
        <div id="sectionD" class="tab-pane fade "> 
        </div>
    </div>
</div>



