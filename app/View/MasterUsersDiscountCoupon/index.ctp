 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <?php echo $this->Html->script('View/MasterUsersDiscountCoupon'); ?>

<br/>
	<h1 class="page-header" id="code">Cupons de Desconto</h1>
	
	<div class="panel panel-default">
  <div class="panel-heading">Cupons</div>
  <div class="panel-body">
  <small>
    Os perfis de Cupom criados devem conter apenas <i>UM</i> <strong>tipo</strong> por registro para que a identifação seja mais fácil durante a requisição dos mesmos.<br/>
	Em nossa primeira abordagem é necessário que apenas <strong>cupom</strong> seja setado como <i>ATIVO</i> por tipo.
	</small>
  </div>
  
  <div>
		<!-- PERFIS DE CUPOM -->
		<div class="col-md-12 text-center" >
			<table class="table table-hover">
				<thead>
				<tr>
				<th colspan="8">Perfis de Cupons</th>
				<th><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> </button></th>
				</tr>
					<tr>
						<th>ID</th>
						<th>TAG</th>
						<th>Título</th>
						<th>Descrição</th>
						<th><small>Data inicio</small></th>
						<th><small>Data fim</small></th>
						<th><small>Valor Minimo</small></th>
						<th><small>Valor desconto</small></th>
						<th>Ativo</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach($couponsProfile as $coupon){ ?>
						<tr>
							<td><?php echo $coupon['coupon_profiles']['id']; ?></td>
							<td><?php echo $coupon['coupon_types']['tag']; ?></td>
							<td><small><?php echo  $coupon['coupon_profiles']['title'];?></small></td>
							<td><small><small><?php echo  $coupon['coupon_profiles']['description'];?></small></small></td>
							<td><small><?php $date = date_create($coupon['coupon_profiles']['date_register']); echo  date_format($date, "d/m/Y");?></small></td>
							<td><small><?php $date = date_create($coupon['coupon_profiles']['end_date']); echo  date_format($date, "d/m/Y");;?></small></td>
							<td><?php echo  $coupon['coupon_profiles']['minimum_value_use'];?></td>
							<td><?php  if($coupon['coupon_profiles']['discount_amount_type'] == 'CURRENCY'){ echo "R$".$coupon['coupon_profiles']['discount_value'];}else if($coupon['coupon_profiles']['discount_amount_type'] == 'PERCENTAGE'){echo $coupon['coupon_profiles']['discount_value'].'%';}?></td>
							<td><input type="checkbox" <?php if($coupon['coupon_profiles']['status']=='ACTIVE'){echo "checked='checked'";}?>/></td>
						</tr>
					<?php	}
					?>
				</tbody>
			</table>

		</div>

		<!-- CUPONS LANÇADOS -->
		<div class="col-md-12 text-center" >
		
			<table class="table table-hover">
				<thead>
					<tr>
						<th colspan="8">Cupons Lançados</th>
							<th><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalCupom"><span class="glyphicon glyphicon-plus"></span> </button></th>
					</tr>
						<tr>
							<th>ID</th>
							<th>Codigo</th>
							<th>Usuário</th>
							<th><small>Data atribuição</small></th>
							<th><small>Data validade</small></th>
							<th><small>Valor Minimo</small></th>
							<th><small>Valor desconto</small></th>
							<th>Status</th>
						</tr>
				</thead>
				<tbody>
					<?php foreach($discountCoupons as $coupon){?>
						<tr>
							<td><?php echo $coupon['discount_coupons']['id']; ?></td>
							<td><small><?php echo $coupon['discount_coupons']['coupon_code']; ?></small></td>
							<td><small><?php echo $coupon['discount_coupons']['user_id']; ?></small></td>
							<td><?php $date = date_create($coupon['discount_coupons']['date_register']); echo  date_format($date, "d/m/Y");?></td>
							<td><?php $date = date_create($coupon['discount_coupons']['end_date']); echo  date_format($date, "d/m/Y");?></td>
							<td><small><?php echo 'R$'.$coupon['discount_coupons']['minimum_value_use']; ?></small></td>
							<td><small>
							<?php  if($coupon['discount_coupons']['discount_amount_type'] == 'CURRENCY'){ echo "R$".$coupon['discount_coupons']['discount_value'];}else if($coupon['discount_coupons']['discount_amount_type'] == 'PERCENTAGE'){echo $coupon['discount_coupons']['discount_value'].'%';}?>
							</small></td>
							<td><small><?php echo $coupon['discount_coupons']['status']; ?></small></td>
						</tr>
					<?php }?>
				</tbody>
			</table>
		
		</div>
  </div>
  
</div>


<!-- MODAL ADD PERFIL -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	 <form method="POST" action="masterUsersDiscountCoupon/saveCouponProfile">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Novo Perfil</h4>
      </div>
      <div class="modal-body">
      
	   <p>

	<div class="row">
	    <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Tipo <small><small>(TAG)</small></small></label>
        <div >
            <input type="text" class="form-control" 
                   id="tagName" name="tagName" placeholder="TAG" value=""/>
				   <input type="hidden" id="tagID" name="tagID" />
				   <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="meuMenuDropDown">

  </ul>
        </div>
    </div>
	
	<div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Valor minimo para uso</label>
        <div >
            <input type="text" class="form-control" 
                   id="minimumValue" name="minimumValue" placeholder="00.00" value=""/>
        </div>
    </div>
	
	</div>
	
	<div class="row">
	    <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Titulo</label>
        <div >
            <input type="text" class="form-control" 
                   id="title" name="title" placeholder="Título" value=""/>
        </div>
    </div>
	
	  <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Descrição</label>
        <div>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
    </div>
	
	</div>

<div class="row">
    <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Data Inicio</label>
        <div >
            <input type="date" class="form-control" 
                   id="dt_begin" name="dt_begin" placeholder="Título" value=""/>
        </div>
    </div>
	<div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Data fim</label>
        <div >
            <input type="date" class="form-control" 
                   id="dt_end" name="dt_end" placeholder="Título" value=""/>
        </div>
    </div>
</div>
	
	<div class="row">
    <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Tipo do Desconto</label>
        <div >
            <select class="form-control" id="discountType" name="discountType">
				<option>Selecione</option>
				<option value="CURRENCY">Valor Moeda (R$)</option>
				<option value="PERCENTAGE">Valor Percentual (%)</option>
			</select>
        </div>
    </div>
	<div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Valor do Desconto</label>
        <div class="input-group">
  <span class="input-group-addon" id="basic-addon1">R$</span>
  <input type="text" class="form-control" placeholder="00.00" aria-describedby="basic-addon1" id="discountValue" name="discountValue">
</div>
    </div>
</div>

	   </p>
	  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
	   </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- MODAL ADD PERFIL -->
<div class="modal fade" id="myModalCupom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	 <form method="POST" action="masterUsersDiscountCoupon/saveDiscountCoupon">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Gerar novo cupom</h4>
      </div>
      <div class="modal-body">
	  
	  <div class="row">
	  <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Perfil do Cupom</label>
        <div >
            <select class="form-control" id="couponProfile" name="couponProfile">
				<option>Selecione</option>
					<?php 
						foreach($couponsProfile as $coupon){ ?>
							<option value="<?php echo  $coupon['coupon_profiles']['id']; ?>"><?php echo  $coupon['coupon_types']['tag'].' - <small><small>'.$coupon['coupon_profiles']['title'].'</small></small>'; ?></option>
						<?php }?>
			</select>
        </div>
    </div>
	</div>
	
	  <div class="row">
	  <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Usuário</label>
        <div >
            <select class="form-control" id="couponProfileUser" name="couponProfileUser">
				<option>Selecione</option>
					<?php 
						foreach($users as $user){ ?>
							<option value="<?php echo  $user['users']['id']; ?>"><?php echo  $user['users']['name']; ?></option>
						<?php }?>
			</select>
        </div>
    </div>
	</div>
	
	<div class="row">
	  <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="">Data Validade</label>
        <div >
            <input type="date" name="endDate" id="endDate" />
        </div>
    </div>
	</div>
	  
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
		<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
		</form>
	</div><!-- /.modal -->
</div>

