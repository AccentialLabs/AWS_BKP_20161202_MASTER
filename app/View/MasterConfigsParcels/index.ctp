<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
echo $this->Html->script('jquery.mask.min',array('inline' => false));
echo $this->Html->script('View/MasterConfigsParcel', array('inline' => false));
?>
<?php ?>
<body onunload="window.opener.location.reload()">
<br/>

<div>
    <h1 class="page-header letterSize"><span><?php echo "Configurações / Parcelamentos"; ?></span></h1>
</div>
<br/><br/>

<fieldset>
	<legend>Parcelamentos e taxas disponibilizados</legend>

	<table class="table table-hover">
		<thead>
			<tr>
				<th>De (mínimo de parcelas)</th>
				<th>Até (máximo de parcelas)</th>
				<th>Recebimento</th>
				<th>Custo para<br/>comprador</th>
				<th><?php echo "Ações";?></th>
			</tr>
		</thead>
		<tbody id="body">
                    
                    
                      <?php
                        $index = 0;
                        
                       if($parcels != null){
                    foreach ($parcels as $parcel) {?>
                    <tr id="trid<?php echo $parcel['parcels_configuration']['id']; ?>">
                        <td><span class="table-icon" style="color:#2597AC" data-toggle="modal" data-target="#modalInfoIndication">
                            <?php echo $parcel['parcels_configuration']['minparcels']; ?></span></td>
                        <td><span class="table-icon" style="color:#2597AC" data-toggle="modal" data-target="#modalParcels">
                            <?php echo $parcel['parcels_configuration']['maxparcels']; ?></span>
                        </td>
                        <td><span class="table-icon" style="color:#2597AC" data-toggle="modal" data-target="#modalInfoIndication">
                            <?php if($parcel['parcels_configuration']['reception_type'] == 'ANTECIPADO'){
                                        echo 'Antecipado';
                                    }
                            ?></span></td>
                        <td><span class="table-icon" style="color:#2597AC" data-toggle="modal" data-target="#modalInfoIndication">
                            <?php if($parcel['parcels_configuration']['payer_cost'] == 0){
                                            echo 'Sem tarifa';
                                    }else{
                                            $payercost = str_replace('.', ',', $parcel['parcels_configuration']['payer_cost']);
                                            echo $payercost.'%';
                                    }
                            ?></span>
                        </td>
                        <td><a onclick = 'Removetr(0, <?php echo $parcel['parcels_configuration']['id']; ?>)'>remover</a></td>    
                    </tr>
                    <?php $index++;}
                      }?>
		</tbody>
	</table>
	<br/>
	<button class="btn btn-default" id="clicarCadastrarParcel">Novo parcelamento</button>
</fieldset>
<br/><br/>
<fieldset>
	<legend>Configurações do parcelamento</legend>
	<p>Escolha as opcoes de parcelamento que deseja oferecer aos seus clientes:</p>
	
	
		<div class="form-group col-md-3">
                    <br>
			<label>Minimo de Parcelas:</label>
			<input type="number" class="form-control" name="minparcels" id="minparcels">
		</div>
		<div class="form-group col-md-3">
                    <br>
			<label for="email">Maximo de Parcelas:</label>
			<input type="number" class="form-control" name="maxparcels" id="maxparcels">
		</div>
		<div class="form-group col-md-6">
                        <input type="radio" name="juros" id="CobrarTarifa">
                        <label>Não cobrar tarifa de parcelamento do meu cliente</label><br>
                         <input type="radio" name="juros" checked id="juros"/><label>Incluir juros no parcelamento de:</label>
                         <div class="col-md-12">
                         <input class="form-control col-md-8" name="payer_cost" id="payer_cost" type="text"><label class="col-md-2">% ao mês</label>
                         </div>
                        
		</div>
            
	
	

</fieldset>
</body>
