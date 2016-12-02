<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
echo $this->Html->css('View/MasterEntries', array('inline' => false)); 
echo $this->Html->script('View/MasterIndicationsUser', array('inline' => false));
echo $this->Html->script('jquery.mask.min',array('inline' => false));
echo $this->Html->script('exif', array('inline' => false));
echo $this->Html->css('View/MasterIndicationsUser', array('inline' => false));
?>
<br/>
<div>
    <h1 class="page-header letterSize"><span>Indicações</span></h1>
</div>
<div class="row">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#sectionA">Indicados</a></li>
        <li><a data-toggle="tab" href="#sectionB">Contatado</a></li>
        <li><a data-toggle="tab" href="#sectionC">Registrados</a></li>
        <li><a data-toggle="tab" href="#sectionD">Não Interessados</a></li>
    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
            <br/>
            <!--div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBusca" placeholder="Pesquise por Nome da Empresa, Cnpj, Email, Estado..." class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4 pull-right">
                    <button class="btn btn-default pull-right" type="button" onclick="showNewCompany()">Incluir nova empresa</button>
                </div>
            </div-->
            <br/><br/>
            <table class="table table-hover" align="center" id="example">
                <thead>
                    <tr>
                        <th style="text-align: center">CONTATO</th>
                        <th style="text-align: center">TELEFONE</th>
                        <th style="text-align: center">EMAIL</th>
                        <th style="text-align: center">SALÃO</th>
                        <th style="text-align: center">INDICADO POR</th>
                        <th style="text-align: center">STATUS</th>
                    </tr>
                </thead>
                <tbody align="center" id="tbody-indicados">
                    <?php
                        $index = 0;
                        if(!empty($indications)){
                    foreach ($indications as $indication) {
                        if($indication['indications']['status'] == 'INDICADO'){ ?>
                        <tr id="trid<?php echo $indication['indications']['id']; ?>">
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $indication['indications']['nome_contato']; ?></td>
                        <td><span class="table-icon phone" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><a><?php echo $indication['indications']['telefone_salao'];?></a></td>
                        <?php
                        $tamMax = 15;
                        if(strlen($indication['indications']['company_email']) > $tamMax){
                        $companyemail = substr($indication['indications']['company_email'], 0, $tamMax).'...';
                        }else{
                        $companyemail = $indication['indications']['company_email'];
                        }
                        ?> 
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $companyemail; ?></td>
                        <?php
                        $companyname = $indication['indications']['company_name'];
                        ?> 
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $companyname; ?></td>
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeUserIndication('<?php echo $indication['users']['name']; ?>','<?php echo $indication['users']['photo']; ?>')" data-toggle="modal" data-target="#myModal"><?php echo $indication['users']['name']; ?></span></td>
                        <td><select style="color:#2597AC;text-align: center" id="status<?php echo $indication['indications']['id']; ?>"class="form-control" onchange="mudarStatus('<?php echo $indication['indications']['id']; ?>','status<?php echo $indication['indications']['id']; ?>' )"><option value="INDICADO" selected>INDICADO</option><option value="CONTATADO">CONTATADO</option><option value="REGISTRADO">REGISTRADO</option><option value="DESINTERESSADO">DESINTERESSADO</option></select></td>
                    </tr>
                        <?php $index++; } }}else{
                            ?> 
                    <tr><td colspan="6"><span>Sem indicações!</span></td></tr>
                                    
                            <?php                            
                        }
                        ?>
                </tbody>
            </table>
        </div>

        <div id="sectionB" class="tab-pane fade">

            <br />
            <!--div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBuscaFornecedores" placeholder="Pesquise por Nome do Fornecedor, Cnpj, Email, Estado..." class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4 pull-right">
                    <button class="btn btn-default pull-right" type="button"  data-toggle="modal" data-target="#myModal">Incluir novo fornecedor</button>
                </div>
            </div-->
            <br/><br/>
            <table class="table table-hover" id="tab-contatados">
                <thead>
                    <tr>
                        <th style="text-align: center">CONTATO</th>
                        <th style="text-align: center">TELEFONE</th>
                        <th style="text-align: center">EMAIL</th>
                        <th style="text-align: center">SALÃO</th>
                        <th style="text-align: center">INDICADO POR</th>
                        <th style="text-align: center">STATUS</th>
                    </tr>
                </thead>
                 <tbody align="center" id="tbody-contatados">
                    <?php
                        $index = 0;
                        if(!empty($indications)){
                    foreach ($indications as $indication) {
                        if($indication['indications']['status'] == 'CONTATADO'){?>
                    <tr id="trid<?php echo $indication['indications']['id']; ?>">
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $indication['indications']['nome_contato']; ?></td>
                        <td><span class="table-icon phone" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><a><?php echo $indication['indications']['telefone_salao']; ?></a></td>
                        <?php
                        $tamMax = 15;
                        if(strlen($indication['indications']['company_email']) > $tamMax){
                        $companyemail = substr($indication['indications']['company_email'], 0, $tamMax).'...';
                        }else{
                        $companyemail = $indication['indications']['company_email'];
                        }
                        ?> 
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $companyemail; ?></td>
                        <?php
                        $companyname = $indication['indications']['company_name'];
                        ?> 
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $companyname; ?></td>
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeUserIndication('<?php echo $indication['users']['name']; ?>','<?php echo $indication['users']['photo']; ?>')" data-toggle="modal" data-target="#myModal"><?php echo $indication['users']['name']; ?></span></td>
                        <td><select style="color:#2597AC;text-align: center" id="status<?php echo $indication['indications']['id']; ?>"class="form-control" onchange="mudarStatus('<?php echo $indication['indications']['id']; ?>','status<?php echo $indication['indications']['id']; ?>' )"><option value="INDICADO">INDICADO</option><option value="CONTATADO" selected>CONTATADO</option><option value="REGISTRADO">REGISTRADO</option><option value="DESINTERESSADO">DESINTERESSADO</option></select></td>
                    </tr>
                        <?php $index++; } }}else{
                            ?>
                    <tr><td colspan="6"><span>Sem indicações!</span></td></tr>
                        <?php
                        }
                        ?>
                </tbody>
            </table>
        </div>
        <div id="sectionC" class="tab-pane fade">

            <br/>
            <!--div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBuscaFornecedores" placeholder="Pesquise por Nome do Fornecedor, Cnpj, Email, Estado..." class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4 pull-right">
                    <button class="btn btn-default pull-right" type="button"  data-toggle="modal" data-target="#myModal">Incluir novo fornecedor</button>
                </div>
            </div-->
            <br/><br/>
            <table class="table table-hover" id="tab-registrados">
                <thead>
                    <tr>
                        <th style="text-align: center">CONTATO</th>
                        <th style="text-align: center">TELEFONE</th>
                        <th style="text-align: center">EMAIL</th>
                        <th style="text-align: center">SALÃO</th>
                        <th style="text-align: center">INDICADO POR</th>
                        <th style="text-align: center">STATUS</th>
                    </tr>
                </thead>
                 <tbody align="center" id="tbody-registrados">
                    <?php
                        $index = 0;
                        if(!empty($indications)){
                    foreach ($indications as $indication) {
                        if($indication['indications']['status'] == 'REGISTRADO'){?>
                        <tr id="trid<?php echo $indication['indications']['id']; ?>">
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $indication['indications']['nome_contato']; ?></td>
                        <td><span class="table-icon phone" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><a><?php echo $indication['indications']['telefone_salao']; ?></a></td>
                        <?php
                        $tamMax = 15;
                        if(strlen($indication['indications']['company_email']) > $tamMax){
                        $companyemail = substr($indication['indications']['company_email'], 0, $tamMax).'...';
                        }else{
                        $companyemail = $indication['indications']['company_email'];
                        }
                        ?> 
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $companyemail; ?></td>
                        <?php
                        $companyname = $indication['indications']['company_name'];
                        ?> 
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $companyname; ?></td>
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeUserIndication('<?php echo $indication['users']['name']; ?>','<?php echo $indication['users']['photo']; ?>')" data-toggle="modal" data-target="#myModal"><?php echo $indication['users']['name']; ?></span></td>
                        <td><select style="color:#2597AC;text-align: center;" id="status<?php echo $indication['indications']['id']; ?>"class="form-control" onchange="mudarStatus('<?php echo $indication['indications']['id']; ?>','status<?php echo $indication['indications']['id']; ?>' )"><option value="INDICADO">INDICADO</option><option value="CONTATADO">CONTATADO</option><option value="REGISTRADO" selected>REGISTRADO</option><option value="DESINTERESSADO">DESINTERESSADO</option></select></td>
                    </tr>
                        <?php $index++; } }}else{
                            ?>
                        <tr><td colspan="6"><span>Sem indicações!</span></td></tr>
                    <?php
                        }
                        ?>
                </tbody>
            </table>
        </div>
        <div id="sectionD" class="tab-pane fade">
            <br/>
            <!--div class="col-md-12">
                <div class="col-md-4">
                    <div class="input-group pull-left" >
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span> </span>
                        <input type="text" id="txtBuscaFornecedores" placeholder="Pesquise por Nome do Fornecedor, Cnpj, Email, Estado..." class="form-control"/>
                    </div>
                </div>
                <div class="col-md-4 pull-right">
                    <button class="btn btn-default pull-right" type="button"  data-toggle="modal" data-target="#myModal">Incluir novo fornecedor</button>
                </div>
            </div-->
            <br/><br/>
            <table class="table table-hover" id="tab-naointeressados">
                <thead>
                    <tr>
                        <th style="text-align: center">CONTATO</th>
                        <th style="text-align: center">TELEFONE</th>
                        <th style="text-align: center">EMAIL</th>
                        <th style="text-align: center">SALÃO</th>
                        <th style="text-align: center">INDICADO POR</th>
                        <th style="text-align: center">STATUS</th>
                    </tr>
                </thead>
                 <tbody align="center" id="tbody-desinteressados">
                    <?php
                        $index = 0;
                        if(!empty($indications)){
                    foreach ($indications as $indication) {
                        if($indication['indications']['status'] == 'DESINTERESSADO'){?>
                     <tr id="trid<?php echo $indication['indications']['id']; ?>">
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $indication['indications']['nome_contato']; ?></td>
                        <td><span class="table-icon phone" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><a><?php echo $indication['indications']['telefone_salao']; ?></a></td>
                        <?php
                        $tamMax = 15;
                        if(strlen($indication['indications']['company_email']) > $tamMax){
                        $companyemail = substr($indication['indications']['company_email'], 0, $tamMax).'...';
                        }else{
                        $companyemail = $indication['indications']['company_email'];
                        }
                        ?> 
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $companyemail; ?></td>
                        <?php
                        $companyname = $indication['indications']['company_name'];
                        ?> 
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeInfoIndication('<?php echo $indication['indications']['nome_contato']; ?>','<?php echo $indication['indications']['company_email']; ?>', '<?php echo $indication['indications']['telefone_salao']; ?>', '<?php echo $indication['indications']['company_name']; ?>', '<?php echo $indication['indications']['qtpessoas']; ?>', '<?php echo $indication['indications']['date_indication']; ?>')" data-toggle="modal" data-target="#modalInfoIndication"><?php echo $companyname; ?></td>
                        <td><span class="table-icon" style="color:#2597AC" onclick="exibeUserIndication('<?php echo $indication['users']['name']; ?>','<?php echo $indication['users']['photo']; ?>')" data-toggle="modal" data-target="#myModal"><?php echo $indication['users']['name']; ?></span></td>
                       <td><select style="color:#2597AC;text-align: center" id="status<?php echo $indication['indications']['id']; ?>"class="form-control" onchange="mudarStatus('<?php echo $indication['indications']['id']; ?>','status<?php echo $indication['indications']['id']; ?>' )"><option value="INDICADO">INDICADO</option><option value="CONTATADO">CONTATADO</option><option value="REGISTRADO">REGISTRADO</option><option value="DESINTERESSADO" selected>DESINTERESSADO</option></select></td>
                    </tr>
                        <?php $index++; } } }else{
                            ?>
                    <tr><td colspan="6"><span>Sem indicações!</span></td></tr>
                    <?php
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--MODAL USUARIO QUE INDICOU-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document" id="modal-recebe">
        <div class="modal-content" style="background-color:white">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color:#101010;font-weight: bolder">Primeiro usuário a indicar</h4>
                </div>
            <div class="modal-body" id="exibe-user" style="color:#101010;background-color:white;">
                    <div class="row">
                        <div id ="recebe-usuario" class="col-md-12" style="text-align: center;">
                           
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" style="background-color:#2597AC;color:white;font-weight: bolder;" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-default" style="background-color:#2597AC;color:white;font-weight: bolder;">Enviar Email ao Usuário</button>
                </div>
        
    </div>
    </div>
</div>
<!--MODAL INFORMAÇÕES DA INDICAÇÃO-->
<div class="modal fade" id="modalInfoIndication"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document" id="modal-recebe">
        <div class="modal-content" style="background-color:white;">
                <div class="modal-header" style="color:#2597AC">
                    <button type="button" class="close" data-dismiss="modal" style="color:#2597AC" aria-label="Close" ><span  style="color:#2597AC" aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="TituloModal" ></h4>
                </div>
            <div class="modal-body" id="exibe-user" style="background-color:white">
                    <div class="row">
                        <div id ="recebe-infoindication"  class="col-md-12">
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" style="background-color:#2597AC;color:white;font-weight: bolder" data-dismiss="modal">Fechar</button>
                </div>
        
    </div>
    </div>
</div>


 