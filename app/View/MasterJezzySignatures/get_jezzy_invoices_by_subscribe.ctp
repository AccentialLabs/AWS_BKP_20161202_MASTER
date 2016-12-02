<br/>
<h1 class="page-header">Faturas</h1>

<h4>Assinatura: <small><?php echo $code; ?></small></h4>
<br/>
<table class="table table-hover">
	<thead>
		<tr>
			<th><small>Código da Fatura</small></th>
			<th><small>Data de Criação</small></th>
			<th><small>Valor total</small></th>
			<th><small>Status</small></th>
			<th><small></small></th>
		</tr>
	</thead>
	<?php foreach($invoices as $invoice){?>
		<tr>
			<td><?php echo $invoice['id'];?></td>
			<td><?php echo $invoice['creation_date']['day'].'/'.$invoice['creation_date']['month'].'/'.$invoice['creation_date']['year']; ?></td>
			<td><?php echo  'R$'.$invoice['amount'];?></td>
			<td><?php echo  $invoice['status']['description'];?></td>
			<td><?php echo $invoice['occurrence'].'ª fatura';?></td>
		</tr>	
		<?php } ?>
	<tbody>
	</tbody>
</table>