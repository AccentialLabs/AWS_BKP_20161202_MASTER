<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<br/>
<?php

echo $this->Html->css('View/MasterEntries', array('inline' => false)); 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <?php
	echo $this->Html->script('View/MasterEntriesDistributor');
	echo $this->Html->script('View/financialParametersResult');
echo $this->Html->script('jquery.mask',array('inline' => false));
echo $this->Html->script('jquery.mask.min',array('inline' => false));

?>
<div>
    <h1 class="page-header letterSize"><span>Resultados Financeiros</span></h1>
</div>

<br/><br/>
<table class="table table-hover" id="myTable">
	<thead>
		<tr>
			<th>id</th>
			<th>Salão</th>
			<th>Distribuidor</th>
			<th><small>Valor Venda</small></th>
			<th><small>Valor Frente</small></th>
			<th class="text-center"><small>Rec. Bruta</small></th>
			<th class="text-center"><small>Imp. Distribuidor</small></th>
			<th class="text-center"><small>Rec. Líquida</small></th>
			<th class="text-center"><small>Comissão Salão</small></th>
			<th class="text-center"><small>Comissão Parceiro</small></th>
			<th class="text-center"><small>Custo Produto</small></th>
			<th class="text-center"><small>Lucro Bruto</small></th>
			<th class="text-center"><small>Infra. Distrib.</small></th>
			<th class="text-center"><small>Infra. Jezzy</small></th>
			<th><small>Marketing</small></th>
			<th class="text-center"><small>Lucro Liquido</small></th>
			<th><small>Data</small></th>
		</tr>
	</thead>
	<tbody>
	
		<?php foreach($parameters as $param){?>
					<tr>
						<td><small><?php echo $param['financial_parameters_results']['id']; ?></small></td>
						<td class="text-center"><?php if(!empty($param['companies']['id'])){ ?><a href="../masterCompany/index/<?php echo $param['companies']['id']; ?>"><small><?php echo $param['companies']['fancy_name']; ?></small></a><?php }else{echo "-";}?></td>
						<td><small><?php echo $param['distributors']['fancy_name']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['vl_venda']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['vl_frente']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['rec_bruta']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['vl_imp']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['rec_liquida']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['vl_salao']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['vl_parc']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['vl_custo']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['lucro_brt']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['infra_dist']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['infra_jzy']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['fundo_mkt']; ?></small></td>
						<td><small><?php echo $param['financial_parameters_results']['lucro_liq']; ?></small></td>
						<td><small><?php echo date("d/m/Y", strtotime($param['financial_parameters_results']['date_register'])); ?></small></td>
				</tr>
		<?php }?>
	</tbody>
</table>