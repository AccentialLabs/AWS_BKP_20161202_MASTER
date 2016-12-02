<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php echo $this->Html->script('View/MasterJezzySignatures'); ?>
<br/>
<h1 class="page-header">Assinaturas Jezzy / <small>Planos</small></h1>

<div>
		
		
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome</th>
					<th class="text-center"><small>Valor Assinatura<small></th>
					<th>Criação</th>
					<th>Descrição</th>
					<th class="text-center">Período <i>Trial</i></th>
					<th>Status</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php 
			foreach($planos as $plan){?>
				<tr>
					<td><?php echo $plan['code']; ?></td>
					<td><?php echo $plan['name']; ?></td>
					<td><?php echo "R$". ($plan['amount']/100); ?></td>
					<td><?php echo $plan['creation_date']['day'].'/'.$plan['creation_date']['month'].'/'.$plan['creation_date']['year'] .'<br/><small>'.$plan['creation_date']['hour'].':'.$plan['creation_date']['minute'].'</small>';?></td>
					<td><?php echo '<small>'.$plan['description'].'</small>'; ?></td>
					<td class="text-center"><?php if($plan['trial']['enabled'] === true){ echo "<strong>ATIVO</strong><br/>".$plan['trial']['days']." dia(s)";}else{ echo "INATIVO";} ?></td>
					<td><?php if($plan['status'] === 'ACTIVE'){ echo "<strong>ATIVO</strong>";}else{ echo "<strong>INATIVO</strong>";}?></td>
					<td><?php if($plan['status'] === 'ACTIVE'){ ?>
						<button type="button" class="btn btn-danger btn-xs inactivePlan" id="<?php echo $plan['code']; ?>">Desativar</button>
					<?php }else{?>
						<button type="button" class="btn btn-success btn-xs activePlan" id="<?php echo $plan['code']; ?>">Ativar</button>
					<?php }?>
					</td>
					<td>
						<button type="button" class="btn btn-default btn-xs editPlan" id="<?php echo $plan['code']; ?>"  name="<?php echo $plan['name']; ?>"	data-toggle="modal" data-target="#myModalEditPlan">Ajustar valor<br/>do plano</button>
					</td>
				</tr>
				
				<?php } ?>
			</tbody>
		</table>

</div>

<!-- Modal -->
<div id="myModalEditPlan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajustar valor do plano</h4>
      </div>
      <div class="modal-body">
        <div>
		<form>
			<input type="hidden" id="planCode" />
			<input type="hidden" id="planName" />
			<label for="amount" >Novo Valor <small>(R$)</small></label>
 			<input type="text" class="form-control " id="newAmount" />
			</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		 <button type="button" class="btn btn-default" id="btnSaveEditPlan">Salvar</button>
      </div>
    </div>

  </div>
</div>