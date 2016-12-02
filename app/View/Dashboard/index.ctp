<?php

echo $this->Html->css('View/Dashboard.index', array('inline' => false)); ?>
<?php echo $this->Html->script('util', array('inline' => false)); ?>
<?php echo $this->Html->script('View/Dashboard.index', array('inline' => false)); ?>
<div >
    <h1 class="page-header letterSize"><span>Dashboard</span></h1>

</div>

<?php 
	$var[0] = array(
			"Cliente" => array(
				"name"=> "Matheus Odilon",
				
				"id"=> "279"
			),
			"Servico" => array(
				"name"=> "Banho de Brilho",
				"id"=> "7"
			),
			"schedule"=> "12:00",
			"date"=> "26/01/2016",
			"status"=> "WAITING_COMPANY_RESPONSE"
		);
		
		$var[1] = array(
			"Cliente" => array(
				"name"=> "Maria Marta",
				"id"=> "270"
			),
			"Servico" => array(
				"name"=> "Botox",
				"id"=> "9"
			),
			"schedule"=> "15:00",
			"date"=> "26/01/2016",
			"status"=> "WAITING_COMPANY_RESPONSE"
		);
		
		$variavel = json_encode($var);
		
		//echo $variavel;
?>

<div class="row ">
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="row saleFinalize">
                Compras finalizadas
                <a href="../portal/saleReport" >
                    <span class='glyphicon glyphicon-plus plus-btn pull-right' id="plusComprasFinalizadas"></span>
                </a>

            </div>
            <div class="row">
                <table class="table table-bordered" id="comprasFinalizadas">
                    <tbody>
                        <tr>
                            <?php
                            if (isset($checkouts1) && is_array($checkouts1)) {
                                switch ($checkouts1['Checkout']['payment_method_id']) {
                                    case 3:
                                    case 5:
                                    case 7:
                                        $modoPagamento = 'Cartão de Crédito';
                                        break;
                                    default:
                                        $modoPagamento = 'Boleto';
                                        break;
                                }
                                $offerTitle = $checkouts1['Offer']['title'];
                                $offerValue = $checkouts1['Offer']['value'];
                                $firstName = split(" ", $checkouts1['User']['name'])[0];
                                echo '
                                    <td>'.'<a href="#">'.$offerTitle.'</a>'.'</td>
                                    <td>Pagamento<br>R$ '.$offerValue.'</td>
                                    <td>Pagamento<br>'.$modoPagamento.'</td>
                                    <td>Cliente<br>'.$firstName.'</td>';
                            }    
                            ?>
                        </tr>
                        <tr>
                            <?php
                            if (isset($checkouts2) && is_array($checkouts2)) {
                                switch ($checkouts2['Checkout']['payment_method_id']) {
                                    case 3:
                                    case 5:
                                    case 7:
                                        $modoPagamento = 'Cartão de Crédito';
                                        break;
                                    default:
                                        $modoPagamento = 'Boleto';
                                        break;
                                }
                                $offerTitle = $checkouts2['Offer']['title'];
                                $offerValue = $checkouts2['Offer']['value'];
                                $firstName = split(" ", $checkouts2['User']['name'])[0];
                                echo '
                                    <td>'.'<a href="#">'.$offerTitle.'</a>'.'</td>
                                    <td>Pagamento<br>R$ '.$offerValue.'</td>
                                    <td>Pagamento<br>'.$modoPagamento.'</td>
                                    <td>Cliente<br>'.$firstName.'</td>';
                            }    
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-4">
            <div class="row heightSquare leftSquare darkBlue">
                <span class="verticalAlign box-dash">Crie uma nova<br/> oferta</span>
            </div>
            <div class="row heightFirstSpace">
            </div>
            <div class="row heightSquare leftSquare darkBlue delivery">
                <a href="<?php echo $this->Html->url("/Product/productManipulation");?>">
                    <span class="glyphicon glyphicon-tag iconWhite verticalAlign"></span>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row heightSquare leftSquare darkBlue">
                <span class="verticalAlign box-dash">Crie<br/>um novo<br/><span class="box-dash-agendamento">agendamento</span></span>
            </div>
            <div class="row heightFirstSpace">
            </div>
            <div class="row heightSquare leftSquare darkBlue delivery">
                <a href="#" id="showmodalnewSchedule"  data-toggle="modal" data-target="#myModalNewSchedule">
                    <span class="glyphicon glyphicon-calendar iconWhite verticalAlign"></span>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row heightSquare rightSquare darkBlue">
                <span class="verticalAlign box-dash">Entrega</br>para</br>hoje</span>
            </div>
            <div class="row heightFirstSpace">
            </div>
            <div class="row heightSquare rightSquare darkBlue delivery">
                <?php echo $deliveryToday; ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-12 lightblue heightFirstRow">
            <div class="row">
                <h4 class="birthDayColor">Aniversáriantes</br>do dia</h4>
            </div>
            <?php
            if (count($birthdays) > 0) {
                    foreach ($birthdays as $birthday) {
                        echo '<div class="row"><a href="#">' . $birthday['users']['name'] . '</a></div>';
                    }
            }
            ?>
        </div>
    </div>
</div>
<div class="hide">
    <div class="row marginTop15">
        <div class="col-md-12">
            <div class="btn-group">
                <input name="dateSchedule" type="date" class="form-control birthDayColor rowCenter" id="dateSchedule"/>
            </div>
            Funcionarios: 

        <?php
        if (isset($secundary_users)) {
            foreach ($secundary_users as $secundary_user) {
                echo '
                    <div class="btn-group">
                        <button name="employee" type="button" class="btn btn-primary" id="' . $secundary_user['secondary_users']['id'] . '" title="' . $secundary_user['secondary_users']['name'] . '">' . split(" ", $secundary_user['secondary_users']['name'])[0] . '</button>
                    </div>';
            }
        }
        ?>
            <div class="btn-group">
                <button name="limpar" type="button" class="btn-sm btn-default " id="limpar">Limpar</button>
            </div>
        </div>
    </div>
    <div class="row" id="columnsSchecule">
        <div class="col-md-3 marginTop15" id="colSchedule_1">

        </div>
        <div class="col-md-3 marginTop15" id="colSchedule_2">

        </div>
        <div class="col-md-3 marginTop15 " id="colSchedule_3">

        </div>
        <div class="col-md-3 marginTop15" id="colSchedule_4">

        </div>
    </div>
</div>
<!-- RELATORIO DE AGENDAMENTOS -->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#sectionA">Agendamentos Hoje</a></li>
    <li><a data-toggle="tab" href="#sectionB">Agendamentos Passados</a></li>
    <li><a data-toggle="tab" href="#sectionC">Agendamentos Futuros</a></li>
</ul>
<div class="tab-content">
    <div id="sectionA" class="tab-pane fade in active">
        <table class="table table-bordered table-condensed small" id="tableId">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Servico</th>
                    <th>Data</th>
                    <th>Horario</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Funcionario</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    if (is_array($schedules)) {
                        foreach ($schedules as $schedule) {
                            if ($schedule['schedules']['status'] == 0) {
                                $scheduleStatus = "AGENDADO";
                            } else {
                                $scheduleStatus = "REALIZADO";
                            }

                            echo '
                                <tr>
                                    <td><a href="#">' . $schedule['schedules']['client_name'] . '</a></td>
                                    <td>' . $schedule['schedules']['subclasse_name'] . '</td>
                                    <td>' . implode("/", array_reverse(explode("-", $schedule['schedules']['date']))) . '</td>
                                    <td>' . substr($schedule['schedules']['time_begin'], 0, 5) . '</td>
                                    <td>R$ ' . number_format($schedule['schedules']['valor'], 2, ",", ".") . '</td>
                                    <td>' . $scheduleStatus . '</td>
                                    <td title="' . $schedule['secondary_users']['name'] . '">' . split(" ", $schedule['secondary_users']['name'])[0] . '</td>
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
                    <th>Cliente</th>
                    <th>Servico</th>
                    <th>Data</th>
                    <th>Horario</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Funcionario</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    if (is_array($allSchedulesPrevious)) {
                        foreach ($allSchedulesPrevious as $schedule) {
                            if ($schedule['schedules']['status'] == 0) {
                                $scheduleStatus = "AGENDADO";
                            } else {
                                $scheduleStatus = "REALIZADO";
                            }

                            echo '
                                <tr>
                                    <td><a href="#">' . $schedule['schedules']['client_name'] . '</a></td>
                                    <td>' . $schedule['schedules']['subclasse_name'] . '</td>
                                    <td>' . implode("/", array_reverse(explode("-", $schedule['schedules']['date']))) . '</td>
                                    <td>' . substr($schedule['schedules']['time_begin'], 0, 5) . '</td>
                                    <td>R$ ' . number_format($schedule['schedules']['valor'], 2, ",", ".") . '</td>
                                    <td>' . $scheduleStatus . '</td>
                                    <td title="' . $schedule['secondary_users']['name'] . '">' . split(" ", $schedule['secondary_users']['name'])[0] . '</td>
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
                    <th>Cliente</th>
                    <th>Servico</th>
                    <th>Data</th>
                    <th>Horario</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Funcionario</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    if (is_array($allSchedulesNext)) {
                        foreach ($allSchedulesNext as $schedule) {
                            if ($schedule['schedules']['status'] == 0) {
                                $scheduleStatus = "AGENDADO";
                            } else {
                                $scheduleStatus = "REALIZADO";
                            }

                            echo '
                                <tr>
                                    <td><a href="#">' . $schedule['schedules']['client_name'] . '</a></td>
                                    <td>' . $schedule['schedules']['subclasse_name'] . '</td>
                                    <td>' . implode("/", array_reverse(explode("-", $schedule['schedules']['date']))) . '</td>
                                    <td>' . substr($schedule['schedules']['time_begin'], 0, 5) . '</td>
                                    <td>R$ ' . number_format($schedule['schedules']['valor'], 2, ",", ".") . '</td>
                                    <td>' . $scheduleStatus . '</td>
                                    <td title="' . $schedule['secondary_users']['name'] . '">' . split(" ", $schedule['secondary_users']['name'])[0] . '</td>
                                </tr>';
                        }
                    }
                    ?>
            </tbody>
        </table>
    </div>
</div>


<!-- POP UP REQUISIÇÕES DE AGENDAMENTO -->
<div id="myModalSchedulesRequisitions" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" >
        <div class="modal-content" id="modelContent">
            <div class="modal-body">
                <form action="<?php echo $this->Html->url("addSubclass"); ?>" method="post">
                    <div class="form-horizontal">
                        <legend>Solicitações de Agendamento</legend>
                        <div class="form-group notification-body" id="notification-body">

                        </div>
                    </div>
                </form>
                <div class="form-group">
                    <div class=" buttonLocation">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-fecha-modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="recebe-cont"> </div>
<!-- <button type="button" class="btn btn-default" id="readFileBtn"> LER ARQUIVO</button> -->

<!-- DETALHE DE USUÁRIO -->
<div id="myModalUserDetails" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" >
        <div class="modal-content" id="modelContent">
            <div class="modal-body">
                <form action="<?php echo $this->Html->url("addSubclass"); ?>" method="post">
                    <legend>Detalhes do Usuário</legend>
                    <div class="form-horizontal" id="recebe">

                        <div class="form-group notification-body" id="notification-body">
                            <div class="col-md-4">
                                <img src="http://coolspotters.com/files/photos/95058/jorge-garcia-profile.jpg" class="user-details-photo"/>
                            </div>
                            <div class="col-md-8">
                                <h3>Jorge Michael</h3>
                                <hr />
                                <div>
                                    <span class="glyphicon glyphicon-envelope pull-left"></span>  <div class="description-info-user">jorge@michael.com</div>
                                    <span class="glyphicon glyphicon-user pull-left"></span> <div class="description-info-user">Masculino</div>
                                    <span class="glyphicon glyphicon-calendar pull-left"></span> <div class="description-info-user">11/08/1994</div>
                                    <span class="glyphicon glyphicon-home pull-left"></span><div class="description-info-user">De Ferraz de Vasconcelos - São Paulo, Rua Hermenegildo Barreto, 120 - 08540-500</div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="info-user-galery">
                                <div class="pull-left quad">
                                    <a href="#" class="thumbnail">
                                        <img src="http://www.pontoabc.com/wp-content/uploads/2014/01/quadrados-dentro-de-um-quadrado.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="pull-left quad">
                                    <a href="#" class="thumbnail">
                                        <img src="http://www.pontoabc.com/wp-content/uploads/2014/01/quadrados-dentro-de-um-quadrado.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="pull-left quad">
                                    <a href="#" class="thumbnail">
                                        <img src="http://www.pontoabc.com/wp-content/uploads/2014/01/quadrados-dentro-de-um-quadrado.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="pull-left quad">
                                    <a href="#" class="thumbnail">
                                        <img src="http://www.pontoabc.com/wp-content/uploads/2014/01/quadrados-dentro-de-um-quadrado.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="pull-left quad">
                                    <a href="#" class="thumbnail">
                                        <img src="http://www.pontoabc.com/wp-content/uploads/2014/01/quadrados-dentro-de-um-quadrado.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="pull-left quad">
                                    <a href="#" class="thumbnail">
                                        <img src="http://www.pontoabc.com/wp-content/uploads/2014/01/quadrados-dentro-de-um-quadrado.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="pull-left quad">
                                    <a href="#" class="thumbnail">
                                        <img src="http://www.pontoabc.com/wp-content/uploads/2014/01/quadrados-dentro-de-um-quadrado.jpg" alt="...">
                                    </a>
                                </div>
                                <div class="pull-left quad">
                                    <a href="#" class="thumbnail">
                                        <img src="http://www.pontoabc.com/wp-content/uploads/2014/01/quadrados-dentro-de-um-quadrado.jpg" alt="...">
                                    </a>
                                </div>
                            </div>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#collapseOne">Compras</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">

                                            <!-- checkout box-->
                                            <div class="col-md-4 checkouts-box">
                                                <div class="col-md-12 img-content" >
                                                    <img src="http://bimg2.mlstatic.com/camiseta-adulto-e-infantil-zelda-triforce_MLB-F-219462707_2113.jpg" class="checkouts-box-img" />
                                                </div>

                                                <div class="col-md-12 checkouts-content">
                                                    <div class="checkout-label">Camiseta qualquer por no brasil</div>
                                                    <hr class="checkouts-divisor"/>

                                                    <div class="checkouts-descriptions col-md-12">												
                                                        <div>
                                                            <div class="col-md-7 checkouts-collums left-collum">
                                                                Quantidade:
                                                            </div>
                                                            <div class="col-md-5 checkouts-collums">
                                                                3
                                                            </div>


                                                            <div class="col-md-7 checkouts-collums left-collum">
                                                                Pagamento:
                                                            </div>
                                                            <div class="col-md-5 checkouts-collums">
                                                                DÉBITO
                                                            </div>


                                                            <div class="col-md-7 checkouts-collums left-collum">
                                                                Data:
                                                            </div>
                                                            <div class="col-md-5 checkouts-collums">
                                                                21/12/2015
                                                            </div>

                                                            <div class="col-md-7 checkouts-collums left-collum">
                                                                Status:
                                                            </div>
                                                            <div class="col-md-5 checkouts-collums">
                                                                RECEBIDO
                                                            </div>

                                                            <div class="col-md-7 checkouts-collums left-collum">
                                                                TOTAL:
                                                            </div>
                                                            <div class="col-md-5 checkouts-collums">
                                                                R$ 1999,00
                                                            </div>
                                                        </div>
                                                    </div>										
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="form-group">
                    <div class=" buttonLocation">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- NEW SCHEDULE -->

<div id="myModalNewSchedule" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" >
        <div class="modal-content" id="modelContent">
            <div class="modal-body">
                <div class="form-horizontal">
                    <legend>Agendamento</legend>


                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="dateSchecule">Data</label>
                            <input type="date" class="form-control" id="dateSchecule" placeholder="Data">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="initialTimeSchecule">Horário</label>
                            <input type="time" class="form-control" id="initialTimeSchecule" placeholder="Hora inicial">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="secondUserSchedule">Profissional</label>
                            <select class="form-control" id="secondUserSchedule">
                                <option value="0" selected>Profissional</option>
								<?php 
									if(isset($secondaryUsers)){
										foreach($secondaryUsers as $secondUser){
											echo "<option value='{$secondUser['secondary_users']['id']}'>{$secondUser['secondary_users']['name']}</option>";
										}
									}
								?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="serviceSchedule">Serviço a ser prestado</label>
                            <select class="form-control" id="serviceSchedule">
                                <option value="0" selected>Serviço</option>
                                <?php
                                if (isset($services)) {
                                    foreach ($services as $sevice) {
                                        echo '<option value="' . $sevice['services']['id'] . '">' . $sevice['subclasses']['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="valueSchedule">Valor do Serviço</label>

                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input id="valueSchedule" type="number" class="form-control"  placeholder="Valor"  aria-label="Amount (to the nearest dollar)">

                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="clientSchedule">Nome do Cliente</label>
                            <input id="clientSchedule" type="text" class="form-control" placeholder="Nome do cliente">
                            <div class="content-names" id="content-names">

                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="#" class="see-user-profile" id="user-profile-link" onclick="showUserDetail()">ver perfil do cliente</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="emailSchedule">Email do Cliente</label>
                            <input id="emailSchedule" type="text" class="form-control" placeholder="Email do cliente">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="phoneSchedule">Telefone do Cliente</label>
                            <input id="phoneSchedule" maxlength="15"  type="tel" class="form-control numbersOnly"  placeholder="Telefone do cliente">
                        </div>
                        <br/><br/>
                        <div class="col-sm-12">
                            <input id="newUserSchedule"  type="checkbox" class="checkbox pull-left" checked="checked">
                            <span class="pull-left"> Novo Cliente</span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 buttonLocation">
                                <input type="hidden" name="userId" id="userId" value="" />
                                <button type="button" class="btn btn-success" id="btnNewSchedule">Agendar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



