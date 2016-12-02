<?php

echo $this->Html->css('View/MasterEntries', array('inline' => false)); 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <?php
echo $this->Html->script('jquery.mask',array('inline' => false));
echo $this->Html->script('jquery.mask.min',array('inline' => false));
echo $this->Html->script('View/MasterEntries', array('inline' => false));
?>
<br/>
<div>
    <h1 class="page-header letterSize"><span>Cadastros</span></h1>
</div>
<div class="row">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#sectionA">Salões</a></li>
        <li><a data-toggle="tab" href="#sectionB">Fabricantes</a></li>

    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
            <br />
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBusca" placeholder="Pesquisar..." class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4 pull-right">
                    <button class="btn btn-default pull-right" type="button" onclick="showNewCompany()">Incluir nova empresa</button>
                </div>
            </div>
            <br/><br/>
            <table class="table table-hover" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SALÃO</th>
                        <th>CONTATO</th>
                        <th>EMAIL</th>
                        <th>TELEFONES</th>
                        <th>ESTADO</th>
                        <th>STATUS</th>
						<th>PLANO</th>
                        <th><small>DIAS<br/>RESTANTES</small></th>
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
                        <td><?php echo $company['Company']['id']; ?></td>
                        <td><a href="masterCompany/index/<?php echo $company['Company']['id']; ?>"><?php echo $company['Company']['fancy_name']; ?></a></td>
                        <td><?php echo $company['Company']['responsible_name']; ?></td>
                        <td><?php echo $company['Company']['email']; ?></td>
                        <td><?php echo $company['Company']['phone'].'<br/>'.$company['Company']['phone_2']; ?></td>
                        <td><?php echo $company['Company']['state']; ?></td>
						
                        <td  id="status-<?php echo $company['Company']['id']; ?>"><?php  if($company['Company']['status'] == 'ACTIVE'){echo "<span class='label label-success'>Ativo</span>";}else{echo "<span class='label label-danger'>Inativo</span>";} ?></td>
                        <td class="text-center"><?php echo $company['Company']['plan']; ?></td>
						<td class="text-center" >
                            <?php if($company['Company']['plan'] == 'TRIAL'){ echo $company['Company']['plan_days'];}else{echo "--";} ?>
                        </td>
                        <td><span class="glyphicon glyphicon-pencil table-icon" onclick="clickEditCompany('<?php echo $index; ?>')"></span></td>
                        <td id="button-<?php echo $company['Company']['id']; ?>">
                           <?php if($company['Company']['status'] == 'ACTIVE'){?> 
                            <span class="glyphicon glyphicon-remove table-icon remove" onclick="removeCompany(<?php echo $company['Company']['id']; ?>);"></span>
                           <?php }else{?>
                            <span class="glyphicon glyphicon-play table-icon reative" onclick="reativeCompany(<?php echo $company['Company']['id']; ?>);"></span>
                           <?php }?>
                        </td>
                    </tr>
                        <?php $index++; } } ?>
                </tbody>
            </table>
        </div>

        <div id="sectionB" class="tab-pane fade">

            <br />
            <div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBuscaFornecedores" placeholder="Pesquisar..." class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4 pull-right">
                    <button class="btn btn-default pull-right" type="button"  data-toggle="modal" data-target="#myModal">Incluir novo fornecedor</button>
                </div>
            </div>
            <br/><br/>
            <table class="table table-hover" id="tab-fornecedores">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>FABRICANTE</th>
                        <th>PRODUTOS</th>
                        <!-- <th>CNPJ</th> -->
                        <!-- <th>EMAIL</th> -->
                        <!-- <th>RESPONSAVEL</th> -->
                        <th>DISTRIBUIDOR</th>
                        <th>CONTATO</th>
                        <th>TELEFONE</th>
                        <th>STATUS</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       $index = 0;
                       if(!empty($providers)){
                    foreach ($providers as $provider) { ?>
                    
                        <!-- <td><?php echo $provider['providers']['id']; ?></td> -->
                        <td><?php echo $provider['providers']['corporate_name']; ?></td>
                        <td><?php echo $provider['providers']['fancy_name']; ?></td>
                        <!-- <td><?php echo $provider['providers']['cnpj']; ?></td> -->
                        <!-- <td><?php echo $provider['providers']['email']; ?></td> -->
                        <td><?php echo $provider['providers']['responsible_name']; ?></td>
                        <td><?php echo $provider['providers']['responsible_email']; ?></td>
                        <td><?php echo $provider['providers']['responsible_phone']; ?></td>
                        <!-- <td><?php echo $provider['providers']['state']; ?></td> -->
                        <td id="status-<?php echo $provider['providers']['id']; ?>"><?php  if($provider['providers']['status'] == 'ACTIVE'){echo "<span class='label label-success'>Ativo</span>";}else{echo "<span class='label label-danger'>Inativo</span>";} ?></td>
                        <td><span class="glyphicon glyphicon-pencil table-icon" onclick="clickEditProvider('<?php echo $index; ?>')"></span></td>
                        <td id="button-<?php echo $provider['providers']['id']; ?>">
                           <?php if($provider['providers']['status'] == 'ACTIVE'){?> 
                            <span class="glyphicon glyphicon-remove table-icon remove" onclick="removeProvider(<?php echo $provider['providers']['id']; ?>);"></span>
                           <?php }else{?>
                            <span class="glyphicon glyphicon-play table-icon reative" onclick="reativeProvider(<?php echo $provider['providers']['id']; ?>);"></span>
                           <?php }?>
                        </td>
                    </tr>
                    <?php 
                    $index++;
                       } }?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- popup novo fornecedor -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document" id="modal-recebe">
        <form class="form-horizontal" role="form" method="post" action="masterEntries/saveProvider" id="providerCompanyForm">
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
                                    for="data[provider][logo]">Logo</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" 
                                       id="data[provider][logo]" name="data[provider][logo]" placeholder="Logo"/>
                            </div>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label  class="control-label label-padding"
                                    for="data[provider][corporate_name]">Razão social</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[provider][corporate_name]" name='data[provider][corporate_name]' placeholder="Razão Social"/>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label  class="control-label label-padding"
                                    for="data[provider][fancy_name]">Nome Fantasia</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[provider][fancy_name]" name='data[provider][fancy_name]' placeholder="Nome Fantasia"/>
                            </div>
                        </div>
                    </div>


                    <!-- 3 -->
                    <div class="row">

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[provider][cnpj]">CNPJ</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control cnpj" 
                                       id="data[provider][cnpj]" name="data[provider][cnpj]" placeholder="CNPJ"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[provider][phone]">Telefone </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[provider][phone]" name="data[provider][phone]" placeholder="Telefone"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[provider][phone_2]">Telefone 2</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[provider][phone_2]" name="data[provider][phone_2]" placeholder="Telefone 2"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[provider][email]">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" 
                                       id="data[provider][email]" name="data[provider][email]" placeholder="Email"/>
                            </div>

                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label  class="control-label label-padding"
                                    for="data[provider][site]">Site</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[provider][site]" name="data[provider][site]" placeholder="Site"/>
                            </div>
                        </div>
                    </div>


                    <!-- 5 -->
                    <hr />
                    <h4 class="modal-title" id="myModalLabel">Responsável pela conta</h4>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label  class="control-label label-padding"
                                    for="data[provider][responsible_name]">Nome</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[provider][responsible_name]" name="data[provider][responsible_name]" placeholder="Nome"/>
                            </div>
                        </div>
                    </div>

                    <!-- 6 -->
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label  class="control-label label-padding"
                                    for="data[provider][responsible_email]">Email <small>  Será usado para acesso ao sistema</small></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[provider][responsible_email]" name="data[provider][responsible_email]" placeholder="Email"/>
                            </div>
                        </div>
                    </div>

                    <!-- 7 -->
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[provider][responsible_cpf]">CPF</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control cpf" 
                                       id="data[provider][responsible_cpf]" name="data[provider][responsible_cpf]" placeholder="CPF"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[provider][responsible_phone]">Telefone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[provider][responsible_phone]" name="data[provider][responsible_phone]" placeholder="Telefone"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[provider][responsible_phone_2]">Telefone 2</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[provider][responsible_phone_2]" name="data[provider][responsible_phone_2]" placeholder="Telefone 2"/>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <label  class="control-label label-padding"
                                    for="data[provider][responsible_cell]">Celular</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control phone" 
                                       id="data[provider][responsible_cell]" name="data[provider][responsible_cell]" placeholder="Celular"/>
                            </div>
                        </div>
                    </div>

                    <!-- 8 -->
                    <hr />
                    <h4 class="modal-title" id="myModalLabel">Endereço</h4>
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label  class="control-label label-padding"
                                    for="data[provider][cep]">CEP</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerCep" name="data[provider][cep]" placeholder="CEP"/>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[provider][address]">Rua</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerLogradouro" name="data[provider][address]" placeholder="Endereço"/>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label  class="control-label label-padding"
                                    for="data[provider][number]">Número</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[provider][number]" name="data[provider][number]" placeholder="Número"/>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[provider][complement]">Complemento</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="data[provider][complement]" name="data[provider][complement]" placeholder="Complemento"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[provider][district]">Bairro</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerBairro" name="data[provider][district]" placeholder="Bairro"/>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[provider][city]">Cidade</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerLocalidade" name="data[provider][city]" placeholder="Cidade"/>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label  class="control-label label-padding"
                                    for="data[provider][uf]">UF</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" 
                                       id="providerUf" name="data[provider][uf]" placeholder="UF"/>
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
