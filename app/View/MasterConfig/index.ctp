<?php

echo $this->Html->css('View/MasterConfig', array('inline' => false)); 
    echo $this->Html->script('View/MasterConfig', array('inline' => false));
?>
<br/>
<h1 class="page-header" id="code">Configurações</h1>

<div id="">
    <ul class="nav nav-tabs">
        <li ><a data-toggle="tab" href="#section0">Perfil de Usuários</a></li>
        <li><a data-toggle="tab" href="#sectionB">Cargos e Permissões</a></li>
		 <li class="active"><a data-toggle="tab" href="#sectionC">Dados Gerais</a></li>
    </ul>
    <div class="tab-content">

        <div id="section0" class="tab-pane fade">
            <br />
            <div class="col-md-4">
                <div class="input-group pull-left" >
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                    <input type="text" id="txtBusca" placeholder="Pesquise por Nome, Cargo, Status..." class="form-control"/>
                </div>
            </div>
            <div class="col-md-4 pull-right">
                <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal">Cadastrar usuário</button>
            </div>

            <br />
            <?php   if($secondariesUsers){ ?>
            <table class="table table-hover" id="allSecondaryUsers">
                <thead>
                    <tr>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th>CARGO</th>
                        <th>STATUS</th>
                        <th class="td-icon">EDITAR</th>
                        <th class="td-icon"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  $index = 0;
                    foreach ($secondariesUsers as $secondary) { ?>
                    <tr>
                        <td><?php echo $secondary['secondary_masterusers']['name']; ?></td>
                        <td><?php echo $secondary['secondary_masterusers']['email']; ?></td>
                        <td><?php echo $secondary['secondary_masterusers_types']['name']; ?></td>
                        <td id='status-<?php  echo $secondary['secondary_masterusers']['id'];?>'>
                            <?php if($secondary['secondary_masterusers']['status'] == 'ACTIVE'){ ?>
                            <span class='label label-success'>Ativo</span>
                            <?php }else{ ?>
                            <span class='label label-danger'>Inativo</span>
                            <?php }?>
                        </td>
                        <td class="td-icon"><span class="glyphicon glyphicon-pencil glyph-button table-icon" onclick="editSecondaryUser(<?php echo $index;?>)"></span></td>
                        <td class="td-icon" id='button-<?php  echo $secondary['secondary_masterusers']['id'];?>'>
                                <?php if($secondary['secondary_masterusers']['status'] == 'ACTIVE'){ ?>
                            <span class="glyphicon glyphicon-remove-sign table-icon" onclick='removeSecondaryUser(<?php  echo $secondary['secondary_masterusers']['id'];?>)'></span>
                            <?php }else{ ?>
                            <span class="glyphicon glyphicon-play table-icon reative" onlick='reativeSecondaryUser(<?php  echo $secondary['secondary_masterusers']['id'];?>)'></span>
                            <?php }?>
                        </td>
                    </tr>
                    <?php $index++; }?>
                </tbody>
            </table>
            <?php }else{
                        
            echo "<span class=''>Nenhum usuário secundário criado até o momento.</span>";}
                    ?>
        </div>

        <div id="sectionB" class="tab-pane fade">
            <br/>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-md-4">CARGO</th>
                        <th class="col-md-4">ATRIBUIÇÃO</th>
                        <th class="col-md-4">DESCRIÇÃO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($secondsMasterUsersTypes as $type) { ?>
                    <tr>
                        <td><strong><?php echo $type['secondary_masterusers_types']['name']; ?></strong></td>
                        <td><?php 
                        switch ($type['secondary_masterusers_types']['id']){
                            case 3:
                                echo "Acesso total";
                                break;
                            case 4:
                                echo "Ofertas, Entregas e NFe";
                                break;
                            case 5:
                                echo "Contas e Faturamento";
                                break;
                        }
                        ?></td>
                        <td><small><?php echo $type['secondary_masterusers_types']['description']; ?></small></td>
                    </tr>
                    <?php    
                        } 
                    ?>
                </tbody>
            </table>

        </div>
		
		  <div id="sectionC" class="tab-pane fade in active">
                    <div class="panel-body">
					<form action="/jezzy-master/portal/masterConfig/index" id="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="row">
                        <div class="col-md-3">
						 <label>Logo</label><br/>
						 <div class="company-logo">
                            <!-- <img id="comp-logo-preview" src="" class="sampleImageComapny" alt="Click to Upload" /><br/>-->
							  <img id="comp-logo-preview" src="<?php echo $company['Company']['logo']; ?>" class="sampleImageComapny" alt="Click to Upload" /><br/>
						</div>
                            <input type="file" id="comp-logo-upper" name="data[Company][logo]" class="inputFileHide"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Razão Social</label>
                            <input name="data[Company][corporate_name]" value="<?php echo $company['Company']['corporate_name']; ?>" disabled type="text" class="form-control" id="companyName" placeholder="Razão Social">
                        </div>
                    </div>      
                    <div class="row">
                        <div class="col-md-8">
                            <label>Nome fantasia</label>
                            <input name="data[Company][fancy_name]" value="<?php echo $company['Company']['fancy_name']; ?>" type="text" class="form-control" id="companyName" placeholder="Nome fantasia">
                        </div>
                        <div class="col-md-4">
                            <label>CNPJ</label>
                            <input name="data[Company][cnpj]" value="<?php echo $company['Company']['cnpj']; ?>" disabled type="text" class="form-control" id="companyName" placeholder="CNPJ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Telefone 1</label>
                            <input name="data[Company][phone]" value="<?php echo $company['Company']['phone']; ?>" type="text" class="form-control" id="companyName" placeholder="Telefone">
                        </div>
                        <div class="col-md-4">
                            <label>Telefone 2</label>
                            <input name="data[Company][phone_2]" value="<?php echo $company['Company']['phone_2']; ?>" type="text" class="form-control" id="companyName" placeholder="Telefone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label>E-mail de contato</label>
                            <input name="data[Company][email]" value="<?php echo $company['Company']['email']; ?>" type="text" class="form-control" id="companyName" placeholder="E-mail de contato">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>CEP</label>
                            <input name="data[Company][zip_code]" value="<?php echo $company['Company']['zip_code']; ?>" type="text" class="form-control" id="companyName" placeholder="CEP">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Endereço</label>
                            <input name="data[Company][address]" value="<?php echo $company['Company']['address']; ?>" type="text" class="form-control" id="companyName" placeholder="Endereço">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <label>Número</label>
                            <input name="data[Company][number]" value="<?php echo $company['Company']['number']; ?>" type="text" class="form-control" id="companyName">
                        </div>
                        <div class="col-md-6">
                            <label>Bairro</label>
                            <input name="data[Company][district]" value="<?php echo $company['Company']['district']; ?>" type="text" class="form-control" id="companyName" placeholder="Bairro">
                        </div>
                        <div class="col-md-1">
                            <label>UF</label>
                            <input name="data[Company][state]" value="<?php echo $company['Company']['state']; ?>" type="text" class="form-control" id="companyName" placeholder="UF">
                        </div>
                        <div class="col-md-4">
                            <label>Cidade</label>
                            <input name="data[Company][city]" value="<?php echo $company['Company']['city']; ?>" type="text" class="form-control" id="companyName" placeholder="Cidade">
                        </div>
                    </div>
					
					<!-- RESPONSAVEL PELA EMPRESA -->
					<div class="row">
						
							<h1 class="col-md-12">Dados do Responsável</h1>
						
					</div>
					
					<div class="row">
                        <div class="col-md-8">
                            <label>Nome</label>
                            <input name="data[Company][responsible_name]" value="<?php echo $company['Company']['responsible_name']; ?>" type="text" class="form-control" id="responsibleCompanyName" disabled>
                        </div>
						
						<div class="col-md-4">
                            <label>CPF</label>
                            <input name="data[Company][responsible_cpf]" value="<?php echo $company['Company']['responsible_cpf']; ?>" type="text" class="form-control" id="responsibleCompanyCPF" disabled>
                        </div>
					</div>
					
					
					<div class="row">
                        <div class="col-md-8">
                            <label>Email</label>
                            <input name="data[Company][responsible_email]" value="<?php echo $company['Company']['responsible_email']; ?>" type="text" class="form-control" id="responsibleCompanyEmail" disabled>
                        </div>
					</div>
					<div class="row">
						<div class="col-md-4">
                            <label>Telefone 1</label>
                            <input name="data[Company][responsible_phone]" value="<?php echo $company['Company']['responsible_phone']; ?>" type="text" class="form-control" id="responsibleCompanyPhone" disabled>
                        </div>
						<div class="col-md-4">
                            <label>Telefone 2</label>
                            <input name="data[Company][responsible_phone_2]" value="<?php echo $company['Company']['responsible_phone_2']; ?>" type="text" class="form-control" id="responsibleCompanyPhone2" disabled>
                        </div>
						<div class="col-md-4">
                            <label>Telefone 3</label>
                            <input name="data[Company][responsible_cell_phone]" value="<?php echo $company['Company']['responsible_cell_phone']; ?>" type="text" class="form-control" id="responsibleCompanyCellPhone" disabled>
                        </div>
					</div>
					<div class="row">
					<br/>
                        <button type="submit" class="btn btn-primary pull-right">Salvar</button> 
					</div>
					</form>
                </div>

			</div>
    </div>

</div>

<!-- M O D A L  -->
<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content" id="modelContent">
            <div class="modal-body">
                <div class="form-horizontal" id="form-insert-edit">
                    <div class="form-group marginTop10">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nome *</label>
                        <div class="col-sm-6">
                            <input name="data[secundary_user][name]" type="text" class="form-control" id="secundary_user_name" value="<?php echo $user['secondary_masterusers']['name']; ?>" placeholder="Nome" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">E-mail *</label>
                        <div class="col-sm-6">
                            <input name="data[secundary_user][email]" type="email" class="form-control"  id="secundary_user_email" placeholder="E-mail" value="<?php echo $user['secondary_masterusers']['email']; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Cargo *</label>
                        <div class="col-sm-3">
                            <select  class="form-control" name="data[secundary_user][type]" id="secundary_user_type" >
                                <option value="<?php echo $user['secondary_masterusers_types']['id']; ?>">value="<?php echo $user['secondary_masterusers_types']['name']; ?>"</option>
                                <?php
                                if (is_array($secondsMasterUsersTypes)) {
                                    foreach ($secondsMasterUsersTypes as $user) {
                                        echo '<option value="' . $user['secondary_masterusers_types']['id'] . '">' . $user['secondary_masterusers_types']['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button id="userModalButom" type="button" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>