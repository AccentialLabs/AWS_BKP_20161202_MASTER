<?php 
echo $this->Html->script('View/MasterFinances', array('inline' => false)); 
	echo $this->Html->css('View/MasterFinances', array('inline' => false)); 
?>

<br/>
	<h1 class="page-header" id="code">Classificação (Lista de Preços)</h1>
<br /><br />
<table class="table table-hover">
	<thead>
		<tr>
			<th class="text-center">Fabricante</th>
			<th>AA</th>
			<th>A</th>
			<th>AB</th>
			<th>B</th>
			<th>BC</th>
			<th>C</th>
			<th class="text-center">ATIVO</th>
				<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($ratings as $rate){ ?>
		<tr>
			<td class="text-center"><?php echo $rate['providers']['fancy_name'].'<br /><small>'.$rate['providers']['id'].'</small>';?></td>
			<td><?php echo $rate['rating_price_lists']['AA']; ?></td>
			<td><?php echo $rate['rating_price_lists']['A']; ?></td>
			<td><?php echo $rate['rating_price_lists']['AB']; ?></td>
			<td><?php echo $rate['rating_price_lists']['B']; ?></td>
			<td><?php echo $rate['rating_price_lists']['BC']; ?></td>
			<td><?php echo $rate['rating_price_lists']['C']; ?></td>
			<td>
					<?php if($rate['rating_price_lists']['status'] == 'ACTIVE'){?>
							<input type="checkbox" class="form-control ratingStatus" checked="checked" id="<?php echo $rate['rating_price_lists']['id']; ?>"/>
					<?php }else{?>
							<input type="checkbox" class="form-control ratingStatus" id="<?php echo $rate['rating_price_lists']['id']; ?>"/>
					<?php }?>
			</td>
			<td><span class="glyphicon glyphicon-remove reatingDelete" id="<?php echo $rate['rating_price_lists']['id']; ?>" ></span></td>
		</tr>
	<?php }?>
	</tbody>
</table>
<br />
<button class="btn btn-default pull-right" type="button" data-toggle="modal" data-target="#myModal">Nova Lista</button> 

<!-- Modal -->
<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nova Lista de Classificação</h4>
      </div>
	  <form action="../MasterFinances/insertRatingPriceList" method="post">
      <div class="modal-body">
	   <div>
			<label>AA</label>
			<input type="text" class="form-control" id="AA" name="AA" />
 	   </div>
	   
	   <div>
			<label>A</label>
			<input type="text" class="form-control" id="A" name="A" />
 	   </div>
	   
	   <div>
			<label>AB</label>
			<input type="text" class="form-control" id="AB" name="AB" />
 	   </div>
	   
	   <div>
			<label>B</label>
			<input type="text" class="form-control" id="B" name="B" />
 	   </div>
	   
	   <div>
			<label>BC</label>
			<input type="text" class="form-control" id="BC" name="BC" />
 	   </div>
	   
	   <div>
			<label>C</label>
			<input type="text" class="form-control" id="C" name="C" />
 	   </div>
	   
	   <div>
			<label>Fabricante</label>
			<select class="form-control" id="provider" name="provider">
			<option value="0">Selecione</option>
			   <?php foreach($providers as $prov){?>
			   <option value="<?php echo $prov['providers']['id']; ?>"><?php echo $prov['providers']['fancy_name']; ?></option>
			   <?php }?>
			</select>
	   </div>
	   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" >Salvar</button>
      </div>
	  </form>
    </div>
  </div>
</div>