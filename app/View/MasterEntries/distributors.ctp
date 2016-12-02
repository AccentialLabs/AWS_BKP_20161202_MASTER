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
echo $this->Html->script('jquery.mask',array('inline' => false));
echo $this->Html->script('jquery.mask.min',array('inline' => false));

?>
<div>
    <h1 class="page-header letterSize"><span>Distribuidores</span></h1>
</div>


<div class="row">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#sectionA">Distribuidores</a></li>
        <li><a data-toggle="tab" href="#sectionB">Parâmetros Financeiros</a></li>
        <li><a data-toggle="tab" href="#sectionC">Comissionamento</a></li>
    </ul>

	<div class="tab-content">
		<div id="sectionA" class="tab-pane fade in active">
			<br />
				<button class="btn btn-default pull-right" type="button" data-toggle="modal" data-target="#myModal">Incluir novo Distribuidor</button>
			<br />
			 <table class="table table-hover" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Distribuidor</th>
                        <th>CONTATO</th>
                        <th>EMAIL</th>
                        <th>TELEFONES</th>
                        <th>ESTADO</th>
                        <th>STATUS</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $index = 0;
                        if(!empty($companies)){
                    foreach ($companies as $company) { ?>
                    <tr>
                        <td><?php echo $company['distributors']['id']; ?></td>
                        <td><a href="masterCompany/index/<?php echo $company['distributors']['id']; ?>"><?php echo $company['distributors']['fancy_name']; ?></a></td>
                        <td><?php echo $company['distributors']['responsible_name']; ?></td>
                        <td><?php echo $company['distributors']['email']; ?></td>
                        <td><?php echo $company['distributors']['phone'].'<br/>'.$company['distributors']['phone_2']; ?></td>
                        <td><?php echo $company['distributors']['state']; ?></td>
                        <td  id="status-<?php echo $company['distributors']['id']; ?>"><?php  if($company['distributors']['status'] == 'ACTIVE'){echo "<span class='label label-success'>Ativo</span>";}else{echo "<span class='label label-danger'>Inativo</span>";} ?></td>
                        <td><span class="glyphicon glyphicon-pencil table-icon" onclick="clickEditDistributor('<?php echo $index; ?>')"></span></td>
                        <td id="button-<?php echo $company['distributors']['id']; ?>">
                           <?php if($company['distributors']['status'] == 'ACTIVE'){?> 
                            <span class="glyphicon glyphicon-remove table-icon remove" onclick="removeCompany(<?php echo $company['distributors']['id']; ?>);"></span>
                           <?php }else{?>
                            <span class="glyphicon glyphicon-play table-icon reative" onclick="reativeCompany(<?php echo $company['distributors']['id']; ?>);"></span>
                           <?php }?>
                        </td>
                    </tr>
                        <?php $index++; } } ?>
                </tbody>
            </table>
			
			
		
		</div>
		
		<div id="sectionB" class="tab-pane fade">
		
			<br />
				<button class="btn btn-default pull-right"  data-toggle="modal" data-target="#myModalNewFinancialParameter">Incluir novo Parâmetro Financeiro</button>
			<br />
			
			<table class="table table-hover">
				<thead>
					<tr>
							<th>id</th>
							<th>Distribuidor</th>
							<th><small>Taxa de imposto</small></th>
							<th><small>Tarifa do<br/>Meio Pagto.</small></th>
							<th><small>Tarifa por<br/> transação</small></th>
							<th><small>Embalagem</small></th>
							<th><small>% Comissão <br/>Salão</small></th>
							<th><small>% Comissão <br/>Parceiro</small></th>
							<th><small>% Infra<br/>Distribuidor</small></th>
							<th><small>% Infra<br/>Jezzy</small></th>
							<th><small>% fundo<br/>Marketing</small></th>
							<th><small>Divisão de lucros</small></th>
							<th></th>
					</tr>
				</thead>
				
				<tbody>
					<?php
					 $index = 0;
					foreach($financialParameters as $parameter){?>
						<tr>
							<td><?php echo $parameter['financial_parameters']['id']; ?></td>
							<td><?php echo $parameter['distributors']['fancy_name']; ?></td>
							<td><?php echo $parameter['financial_parameters']['tx_imp']; ?></td>
							<td><?php echo $parameter['financial_parameters']['tx_mpgto']; ?></td>
							<td><?php echo $parameter['financial_parameters']['tar_trans']; ?></td>
							<td><?php echo $parameter['financial_parameters']['vl_emb']; ?></td>
							<td><?php echo $parameter['financial_parameters']['tx_salao']; ?></td>
							<td><?php echo $parameter['financial_parameters']['tx_parc']; ?></td>
							<td><?php echo $parameter['financial_parameters']['tx_infra_dist']; ?></td>
							<td><?php echo $parameter['financial_parameters']['tx_infra_jzy']; ?></td>
							<td><?php echo $parameter['financial_parameters']['tx_fdo_mkt']; ?></td>
							<td><?php echo $parameter['financial_parameters']['qdt_partes']; ?></td>
							   <td><span class="glyphicon glyphicon-pencil table-icon" onclick="clickEditFinancialParameter('<?php echo $index; ?>')"></span></td>
						</tr>
					<?php $index++;}?>
				</tbody>
				
			</table>
		</div>
	<div id="sectionC" class="tab-pane fade in ">
	 <table class="table table-hover" id="example">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Comissionamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 0;if(!empty($providers)){foreach ($providers as $provider) { ?>
                    <tr>
                        <?php if($provider['providers']['status'] == 'ACTIVE'){?>
                        <td><?php echo $provider['providers']['fancy_name'] ?></td>
                        <td><div class="col-xs-12"><div class="col-xs-2"><input class="form-control" data-mask="9.99" id="Commission<?php echo $provider['providers']['id']?>" type="text" value="<?php echo $provider['providers']['commission'] ?>"></div><div class="col-xs-2"><span>%</span></div><div class="col-xs-6"><button class="btn btn-primary" onclick="SaveCommission(<?php echo $provider['providers']['id']; ?>,document.getElementById('Commission<?php echo $provider['providers']['id']; ?>').value);">Salvar</button><button class="btn btn-danger" onclick="location.reload();">Cancelar</button></div></div></td>
                    </tr>
                    <?php $index++; }}} ?>
                </tbody>
            </table>
			
			
		
		</div>
	</div>
	
</div>

<!-- popup novo fornecedor -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" id="modal-recebe">
        <form class="form-horizontal" role="form" method="post" action="../masterEntries/saveDistribute" id="distributorCompanyForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cadastro de Fornecedor</h4>
                </div>
                <div class="modal-body" id="cadastro-recebe">

                    <!-- 1 -->
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label  class="control-label label-padding"
                                    for="data[distributors][logo]">Logo</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" 
                                       id="data[distributors][logo]" name="data[distributors][logo]" placeholder="Logo"/>
                            </div>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label  class="control-label label-padding"
                                    for="data[distributors][corporate_name]">Raz�o social</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[distributors][corporate_name]" name='data[distributors][corporate_name]' placeholder="Raz�o Social"/>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label  class="control-label label-padding"
                                    for="data[distributors][fancy_name]">Nome Fantasia</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[distributors][fancy_name]" name='data[distributors][fancy_name]' placeholder="Nome Fantasia"/>
                            </div>
                        </div>
                    </div>


                    <!-- 3 -->
                    <div class="row">

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[distributors][cnpj]">CNPJ</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control cnpj" 
                                       id="data[distributors][cnpj]" name="data[distributors][cnpj]" placeholder="CNPJ"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[distributors][phone]">Telefone </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[distributors][phone]" name="data[distributors][phone]" placeholder="Telefone"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[distributors][phone_2]">Telefone 2</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[distributors][phone_2]" name="data[distributors][phone_2]" placeholder="Telefone 2"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[distributors][email]">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" 
                                       id="data[distributors][email]" name="data[distributors][email]" placeholder="Email"/>
                            </div>

                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label  class="control-label label-padding"
                                    for="data[distributors][site]">Site</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[distributors][site]" name="data[distributors][site]" placeholder="Site"/>
                            </div>
                        </div>
                    </div>


                    <!-- 5 -->
                    <hr />
                    <h4 class="modal-title" id="myModalLabel">Respons�vel pela conta</h4>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label  class="control-label label-padding"
                                    for="data[distributors][responsible_name]">Nome</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[distributors][responsible_name]" name="data[distributors][responsible_name]" placeholder="Nome"/>
                            </div>
                        </div>
                    </div>

                    <!-- 6 -->
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label  class="control-label label-padding"
                                    for="data[distributors][responsible_email]">Email <small>  Ser� usado para acesso ao sistema</small></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[distributors][responsible_email]" name="data[distributors][responsible_email]" placeholder="Email"/>
                            </div>
                        </div>
                    </div>

                    <!-- 7 -->
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[distributors][responsible_cpf]">CPF</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control cpf" 
                                       id="data[distributors][responsible_cpf]" name="data[distributors][responsible_cpf]" placeholder="CPF"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[distributors][responsible_phone]">Telefone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[distributors][responsible_phone]" name="data[distributors][responsible_phone]" placeholder="Telefone"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[distributors][responsible_phone_2]">Telefone 2</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[distributors][responsible_phone_2]" name="data[distributors][responsible_phone_2]" placeholder="Telefone 2"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[distributors][responsible_cell]">Celular</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[distributors][responsible_cell]" name="data[distributors][responsible_cell]" placeholder="Celular"/>
                            </div>
                        </div>
                    </div>

                    <!-- 8 -->
                    <hr />
                    <h4 class="modal-title" id="myModalLabel">Endere�o</h4>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label  class="control-label label-padding"
                                    for="data[distributors][cep]">CEP</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerCep" name="data[distributors][cep]" placeholder="CEP"/>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[distributors][address]">Rua</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerLogradouro" name="data[distributors][address]" placeholder="Endere�o"/>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label  class="control-label label-padding"
                                    for="data[distributors][number]">N�mero</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[distributors][number]" name="data[distributors][number]" placeholder="N�mero"/>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[distributors][complement]">Complemento</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[distributors][complement]" name="data[distributors][complement]" placeholder="Complemento"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[distributors][district]">Bairro</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerBairro" name="data[distributors][district]" placeholder="Bairro"/>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[distributors][city]">Cidade</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerLocalidade" name="data[distributors][city]" placeholder="Cidade"/>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[distributors][uf]">UF</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerUf" name="data[distributors][uf]" placeholder="UF"/>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div id="myModalNewFinancialParameter" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <form action="../masterEntries/saveFinancialParameter" method="POST">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Novo <?php echo utf8_encode("Par�metro");?> Financeiro</h4>
      </div>
     <div class="modal-body" id="cadastro-paramentros-financeiros">
        <div class="container-fluid bd-example-row">
		
          <div class="row">
            <div class="col-md-6">
				<label id="">Selecione o Distribuidor:</label>
				<select class="form-control" id="distributor_id" name="distributor_id" >
					<?php foreach($companies as $comp){?>
						<option value="<?php echo $comp['distributors']['id'];?>"><?php echo $comp['distributors']['fancy_name'];?></option>
					<?php } ?>
				</select>
			</div>
          </div>
      
	  <div class="row">
            <div class="col-md-4">
				<label id=""><small>Taxa de imposto (%)</small></label>
				<input type="text" name="tx_imp" id="tx_imp" class="form-control"/>
			</div>
            <div class="col-md-4">
				<label id=""><small>Tarifa do Meio Pagto.</small></label>
				<input type="text" class="form-control" name="tx_mpgto" id="tx_mpgto" />
			</div>
			<div class="col-md-4">
				<label id=""><small>Tarifa por <?php echo utf8_encode("Transa��o");?></small></label>
				<input type="text" class="form-control" name="tar_trans" id="tar_trans" />
			</div>
          </div>
		  
		    <div class="row">
            <div class="col-md-4">
				<label id=""><small>Embalagem (R$)</small></label>
				<input type="text" name="vl_emb" id="vl_emb" class="form-control"/>
			</div>
            <div class="col-md-4">
				<label id=""><small><?php echo utf8_encode("Comiss�o Sal�o");?> (%)</small></label>
				<input type="text" class="form-control" name="tx_salao" id="tx_salao" />
			</div>
			<div class="col-md-4">
				<label id=""><small><?php echo utf8_encode("Comiss�o");?> Parceiro</small></label>
				<input type="text" class="form-control" name="tx_parc" id="tx_parc" />
			</div>
          </div>
		  
		  <div class="row">
            <div class="col-md-4">
				<label id=""><small>% Infra Distribuidor</small></label>
				<input type="text" name="tx_infra_dist" id="tx_infra_dist" class="form-control"/>
			</div>
            <div class="col-md-4">
				<label id=""><small>% Infra Jezzy</small></label>
				<input type="text" class="form-control" name="tx_infra_jzy" id="tx_infra_jzy" />
			</div>
			<div class="col-md-4">
				<label id=""><small>% Fundo Marketing</small></label>
				<input type="text" class="form-control" name="tx_fdo_mkt" id="tx_fdo_mkt" />
			</div>
          </div>
		  
		  <div class="row">
            <div class="col-md-4">
				<label id=""><small><?php echo utf8_encode("Divis�o de lucros"); ?></small></label>
				<input type="text" name="qdt_partes" id="qdt_partes" class="form-control"/>
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