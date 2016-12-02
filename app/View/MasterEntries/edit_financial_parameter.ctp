 <div class="row">
            <div class="col-md-6">
				<label id="">Selecione o Distribuidor:</label>
				<input type="text" value="<?php echo $parameter['distributors']['fancy_name'];?>" class="form-control" disabled="disabled"/>
			</div>
          </div>
      
	  <div class="row">
				<input type="hidden" value="<?php echo $parameter['financial_parameters']['id']; ?>"  id="paramater_id" name="paramater_id" />
            <div class="col-md-4">
				<label id=""><small>Taxa de imposto (%)</small></label>
				<input type="text" name="tx_imp" id="tx_imp" class="form-control" value="<?php echo $parameter['financial_parameters']['tx_imp']; ?>"/>
			</div>
            <div class="col-md-4">
				<label id=""><small>Tarifa do Meio Pagto.</small></label>
				<input type="text" class="form-control" name="tx_mpgto" id="tx_mpgto" value="<?php echo $parameter['financial_parameters']['tx_mpgto']; ?>"/>
			</div>
			<div class="col-md-4">
				<label id=""><small>Tarifa por Transação</small></label>
				<input type="text" class="form-control" name="tar_trans" id="tar_trans"  value="<?php echo $parameter['financial_parameters']['tar_trans']; ?>"/>
			</div>
          </div>
		  
		    <div class="row">
            <div class="col-md-4">
				<label id=""><small>Embalagem (R$)</small></label>
				<input type="text" name="vl_emb" id="vl_emb" class="form-control" value="<?php echo $parameter['financial_parameters']['vl_emb']; ?>"/>
			</div>
            <div class="col-md-4">
				<label id=""><small>Comissão Salão (%)</small></label>
				<input type="text" class="form-control" name="tx_salao" id="tx_salao" value="<?php echo $parameter['financial_parameters']['tx_salao']; ?>"/>
			</div>
			<div class="col-md-4">
				<label id=""><small>Comissão Parceiro</small></label>
				<input type="text" class="form-control" name="tx_parc" id="tx_parc"  value="<?php echo $parameter['financial_parameters']['tx_parc']; ?>"/>
			</div>
          </div>
		  
		  <div class="row">
            <div class="col-md-4">
				<label id=""><small>% Infra Distribuidor</small></label>
				<input type="text" name="tx_infra_dist" id="tx_infra_dist" class="form-control" value="<?php echo $parameter['financial_parameters']['tx_infra_dist']; ?>"/>
			</div>
            <div class="col-md-4">
				<label id=""><small>% Infra Jezzy</small></label>
				<input type="text" class="form-control" name="tx_infra_jzy" id="tx_infra_jzy" value="<?php echo $parameter['financial_parameters']['tx_infra_jzy']; ?>"/>
			</div>
			<div class="col-md-4">
				<label id=""><small>% Fundo Marketing</small></label>
				<input type="text" class="form-control" name="tx_fdo_mkt" id="tx_fdo_mkt" value="<?php echo $parameter['financial_parameters']['tx_fdo_mkt']; ?>"/>
			</div>
          </div>
		  
		  <div class="row">
            <div class="col-md-4">
				<label id=""><small>Divisão de Lucros</small></label>
				<input type="text" name="qdt_partes" id="qdt_partes" class="form-control" value="<?php echo $parameter['financial_parameters']['qdt_partes']; ?>"/>
			</div>
          </div>
		  