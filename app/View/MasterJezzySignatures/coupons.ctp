<br/>
<h1 class="page-header">Cupons</h1>
 
<table class="table table-hover">
	<thead>
		<tr>
			<th>Código</th>
			<th>Título</th>
			<th>Descrição</th>
			<th><small>Tipo do Desconto</small></th>
			<th><small>Valor do Desconto</small></th>
			<th>Repetição</th>
			<th>Data de Expiração</th>
			<th><small>Quantidade máxima<br/>de uso</small></th>
			<th>Status</th>
		</tr>
		
		<?php  
			if(!empty($coupons)){
		foreach($coupons as $coupon){?>
				<tr>
					<td><?php echo $coupon['code']; ?></td>
					<td><?php echo $coupon['name']; ?></td>
					<td><small><?php echo $coupon['description']; ?></small></td>
					<td><?php if($coupon['discount']['type'] === 'AMOUNT'){ echo "R$";}else if($coupon['discount']['type'] === 'PERCENT'){ echo "%"; } ?></td>
					<td><?php  if($coupon['discount']['type'] === 'AMOUNT'){ echo "R$".($coupon['discount']['value']/100);}else if($coupon['discount']['type'] === 'PERCENT'){ echo $coupon['discount']['value']."%"; }  ?></td>
					<td>
						<?php 
							if($coupon['duration']['type'] === 'ONCE'){
								echo "<small>Único (apenas para uma cobrança)</small>";
							}else if($coupon['duration']['type'] === 'REPEATING'){
								echo "<small>O uso será <strong>REPETIDO</strong> ".$coupon['duration']['occurrences']." vezes</small>";
							}else if($coupon['duration']['type'] === 'FOREVER'){
								echo "Executado Sempre";
							}
						?>
					</td>
					<td>
						<?php echo $coupon['expiration_date']['day'].'/'.$coupon['expiration_date']['month'].'/'.$coupon['expiration_date']['year']; ?>
					</td>
					<td>
						<?php echo $coupon['max_redemptions']; ?>
					</td>
					<td>
						<?php echo $coupon['status']; ?>
					</td>
				</tr>
		<?php } }?>
		
	</thead>
	
	<tbody>
	</tbody>
</table>

<div class="col-md-5 pull-right">
<div>
		<span><small>
			** Um coupon permite oferecer a um determinado cliente um desconto em valor percentual ou inteiro. Esse desconto pode ser configurado para que seja aplicado apenas uma vez, inúmeras vezes ou pra sempre, além de outras configurações de duração e limite de associações.</small></span>
		</div><button class="btn btn-default pull-right" id="btnNewCoupon" data-toggle="modal" data-target="#myModalNewCoupon">Criar Cupom</button>
		</div>



<!-- Modal -->
<div id="myModalNewCoupon" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <form action="../MasterJezzySignatures/addCoupon" method="POST">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Novo Cupom</h4>
      </div>
     <div class="modal-body">
        <div class="container-fluid bd-example-row">
		
          <div class="row">
            <div class="col-md-6">
				<label id="">Titulo</label>
				<input type="text" class="form-control" name="name" id="name" />
			</div>
            <div class="col-md-6">
				<label id="">Descrição</label>
				<input type="text" class="form-control" name="description" id="description" />
			</div>
          </div>
      
	  <div class="row">
	  <hr />
		<h5>Desconto:</h5>
            <div class="col-md-6">
				<label id="">Tipo</label>
				<select class="form-control" id="discount-type" name="discount-type">
					<option value="percent">Porcentagem</option>
					<option value="amount">Valor (R$)</option>
				</select>
			</div>
            <div class="col-md-6">
				<label id="">Valor <small>(% ou R$)</small></label>
				<input type="text" class="form-control" name="discount-value" id="discount-value" />
			</div>
          </div>
		  
		   <div class="row">
		   <hr />
		<h5>Duração:</h5>
            <div class="col-md-6">
				<label id="">Tipo</label>
				<select class="form-control" id="duration-type" name="duration-type">
					<option value="once">Uma vez</option>
					<option value="repeating">Inserir número de repetiçoes</option>
					<option value="foreve">Para sempre</option>
				</select>
			</div>
            <div class="col-md-6">
				<label id="">Número de repetiçoes</label>
				<input type="number" class="form-control" name="duration-occurrences" id="duration-occurrences" />
			</div>
          </div>
		  
		  <div class="row">
            <div class="col-md-6">
				<label id="">Submits máximos do Cupom</label>
				<input type="number" class="form-control" name="max_redemptions" id="max_redemptions" />
			</div>
          </div>
		  
		  <div class="row">
            <div class="col-md-6">
				<label id="">Data de Expiração</label>
				<input type="date" class="form-control" name="expiration_date" id="expiration_date" />
			</div>
          </div>
		  
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		 <button type="submit" class="btn btn-default" id="btnAddNewCoupon">Salvar</button>
      </div>
    </div>
	</form>

  </div>
</div>