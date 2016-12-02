<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<?php echo $this->Html->script('View/MasterJezzySignatures'); ?>
<br/>
<h1 class="page-header">Assinaturas Jezzy / <small>Assinaturas</small></h1>

<div>
<br />
	<span><small>* valores buscados no MoIP</small></span><br/>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th class="text-center">Assinante</th>
					<th class="text-center">PLANO</th>
					<th class="text-center"><small>Data Assinatura</small></th>
					<th class="text-center"><small>Data da proxima cobrança</small></th>
					<th>Status</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			if(!empty($subscriptions)){
			foreach($subscriptions as $sub){ ?>
				<tr>
					<td><?php echo $sub['code'];?></td>
					<td class="text-center"><?php echo $sub['customer']['fullname'].'<br/><small>'.$sub['customer']['code'].'</small>'; ?></td>
					<td class="text-center"><strong><?php echo  $sub['plan']['name']; ?></strong></td>
					<td class="text-center"><?php echo $sub['creation_date']['day'].'/'.$sub['creation_date']['month'].'/'.$sub['creation_date']['year'].'<br/><small>'.$sub['creation_date']['hour'].':'.$sub['creation_date']['minute'].'</small>'; ?></td>
					<td class="text-center">
					<?php if($sub['status'] === 'SUSPENDED'){?>
							<small>Assinatura<br/>suspensa</small>
							<?php }else{echo $sub['next_invoice_date']['day'].'/'.$sub['next_invoice_date']['month'].'/'.$sub['next_invoice_date']['year'].'<br/><small>R$'.str_replace(".", ",", ($sub['amount']/100)).'</small>';} ?>
					</td>
					<td><i><?php echo $sub['status'];?></i></td>
					<td class="text-center">
						<?php if($sub['status'] === 'SUSPENDED'){?>
						<button type="button" class="btn btn-success btn-xs activeSubscribe" id="<?php echo $sub['code']; ?>">Reativar assinatura</button><br/>
						<?php }else{?>
						<button type="button" class="btn btn-warning btn-xs inactiveSubscribe" id="<?php echo $sub['code']; ?>">Suspender assinatura</button><br/>
						<?php }?>
						<button type="button" class="btn btn-danger btn-xs cancelSubscribe" id="<?php echo $sub['code']; ?>">Cancelar assinatura</button><br/>
						
					</td>
					<td><button type="button" class="btn btn-default btn-xs alterNextInvoiceDate" id="<?php echo $sub['code']; ?>" 
					data-toggle="modal" data-target="#myModalnextInvoiceDate">Alterar data da<br/>proxima cobrança</button></td>
					<td><a href="/jezzy-master/portal/MasterJezzySignatures/getJezzyInvoicesBySubscribe/<?php echo $sub['code'];?>"><button class="btn btn-default btn-xs">Ver faturas<br/>do assinante</button></a></td>
					<td><button type="button" class="btn btn-default btn-xs associateCoupon" id="<?php echo $sub['code']; ?>"   data-toggle="modal" data-target="#myModaCoupons">Associar cupom<br/>promocional</button> </td>
				</tr>
				<?php }}?>
			
			</tbody>
		</table>
		<br />
		<div class="col-md-5 pull-right">
		<span><small>
			. Caso suspensa, a assinatura não será cobrada no final do intervalo atual, ao reativá-la, a próxima cobrança será feita de acordo com a data de contratação da assinatura. Caso cancelada, a assinatura não poderá mais ser reativa ou alterada.
		</small></span>
		</div>

</div>

<!-- Modal -->
<div id="myModalnextInvoiceDate" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alterar data da proxima Cobrança</h4>
      </div>
      <div class="modal-body">
        <div>
		<form>
			<input type="hidden" id="subscriptionsCode" />
			<label for="amount" >Valor <small>(R$)</small></label>
 			<input type="text" class="form-control " id="amount" />
			<br/>
			<label for="nextInvoiceDate" >Data para cobrança</label>
 			<input type="date" class="form-control" id="nextInvoiceDate"/>
			</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		 <button type="button" class="btn btn-default" id="btnNextInvoiceDate">Salvar</button>
      </div>
    </div>

  </div>
</div>

<div id="myModaCoupons" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Adicionar Copum Promocional</h4>
      </div>
      <div class="modal-body">
        <div>
			<input type="hidden" id="subscriptionsCode" />
			<label for="">Selecione o Cupom</label>
			<select class="form-control" name="couponCode" id="couponCode">
				<?php foreach($coupons as $coupon){?>
					<option value="<?php echo $coupon['code']; ?>"><?php echo $coupon['name']; ?></option>
				<?php }?>
			</select>
			
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		 <button type="button" class="btn btn-default" id="btnSaveCouponSubscribe">Salvar</button>
      </div>
    </div>

  </div>
</div>