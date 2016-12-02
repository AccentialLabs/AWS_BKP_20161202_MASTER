
		
				
				<fieldset>
					<legend>Compra <?php echo $checkout[0]['checkouts']['id'];?></legend>
					<div class="checkout-text">
						<span>O produto foi adquirido em <strong><?php $data =  explode("-",$checkout[0]['checkouts']['date']); echo str_replace(" 00:00:00", "", $data[2])."/".$data[1]."/".$data[0];?></strong> via 
						<strong><?php echo $checkout[0]['payments_methods']['type']. ' ' .$checkout[0]['payments_methods']['name'];?></strong> e o status da compra é <strong>
						<?php echo $checkout[0]['payment_states']['name']; ?></strong>.<br/> Quantidade comprada: <strong><?php echo $checkout[0]['checkouts']['amount'];?></strong><br/>
						Valor total da compra: <strong>R$<?php echo str_replace(".", ",", $checkout[0]['checkouts']['total_value']);?></strong></span><br/>
						Produto enviado para <strong><?php echo $checkout[0]['checkouts']['address'].' nº '. $checkout[0]['checkouts']['number'].' - '. $checkout[0]['checkouts']['complement'].'. '. $checkout[0]['checkouts']['city']. ' - '. $checkout[0]['checkouts']['state'];?></strong>
					</div>
				</fieldset>
				
				<br />
				<fieldset>
					 <h3><?php echo $offer[0]['offers']['title'];?><br/> <small><?php echo $offer[0]['offers']['resume'];?></small></h3>
					<div class="col-md-12">
						<div class="col-md-3">
							<img src="<?php echo $offer[0]['offers']['photo'];?>" style="width: 100%;"/>
						</div>
						<div class="col-md-9">
						
						 Oferta <strong><?php  if($offer[0]['offers']['public'] == 'ACTIVE'){echo "Pública"; }else{echo "Direcionada";}?></strong> válida de <strong><?php $data =  explode("-",$offer[0]['offers']['begins_at']); echo str_replace(" 00:00:00", "", $data[2])."/".$data[1]."/".$data[0];?></strong> a <strong><?php $data =  explode("-",$offer[0]['offers']['ends_at']); echo $data[2]."/".$data[1]."/".$data[0];?></strong>.<br/>
						 Valor unitário R$ <strong><?php echo str_replace(".", ",", $offer[0]['offers']['value']);?></strong> com desconto de <strong><?php echo $offer[0]['offers']['percentage_discount'];?></strong>%.
						
						</div>
					</div>
				</fieldset>
				<br/><br/>
				<fieldset>
					 <h3><?php echo $checkout[0]['users']['name'];?><br/> <small>Cliente desde <strong><?php $data =  explode("-",$checkout[0]['users']['date_register']); echo substr($data[2], 0, 1)."/".$data[1]."/".$data[0];?></strong></small></h3>
					<div class="col-md-12">
						<div class="col-md-3">
							<img src="<?php echo $checkout[0]['users']['photo'];?>" style="width: 100%;"/>
						</div>
						<div class="col-md-9">
						
						 Usuário de <strong><?php echo $checkout[0]['users']['city'];?> - <?php echo $checkout[0]['users']['state'];?> </strong><br/>
						 <span><?php if($checkout[0]['users']['gender'] == 'male'){ echo "Masculino";}else{echo "Feminino";};?></span>
						</div>
					</div>
				</fieldset>
				
            