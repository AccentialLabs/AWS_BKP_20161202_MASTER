<div class="row">
    <div class="form-group col-md-8">
        <label  class="control-label label-padding"
                for="data[Company][logo]">Logo</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" 
                   id="data[Company][logo]" name="data[Company][logo]" placeholder="Logo"/>
        </div>
    </div>
</div>

<!-- 2 -->
<div class="row">
    <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="data[Company][corporate_name]">Razão social</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][corporate_name]" name='data[Company][corporate_name]' placeholder="Razão Social" value="<?php echo $company['Company']['corporate_name']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="data[Company][fancy_name]">Nome Fantasia</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][fancy_name]" name='data[Company][fancy_name]' placeholder="Nome Fantasia" value="<?php echo $company['Company']['fancy_name']; ?>"/>
        </div>
    </div>
</div>


<!-- 3 -->
<div class="row">

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[Company][cnpj]">CNPJ</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][cnpj]" name="data[Company][cnpj]" placeholder="CNPJ" value="<?php echo $company['Company']['cnpj']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[Company][phone]">Telefone </label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][phone]" name="data[Company][phone]" placeholder="Telefone" value="<?php echo $company['Company']['phone']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[Company][phone_2]">Telefone 2</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][phone_2]" name="data[Company][phone_2]" placeholder="Telefone 2" value="<?php echo $company['Company']['phone_2']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[Company][email]">Email</label>
        <div class="col-sm-12">
            <input type="email" class="form-control" 
                   id="data[Company][email]" name="data[Company][email]" placeholder="Email" value="<?php echo $company['Company']['email']; ?>"/>
        </div>

    </div>
</div>

<!-- 4 -->
<div class="row">
    <div class="form-group col-md-8">
        <label  class="control-label label-padding"
                for="data[Company][site]">Site</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][site]" name="data[Company][site]" placeholder="Site" value="<?php echo $company['Company']['site_url']; ?>"/>
        </div>
    </div>
</div>


<!-- 5 -->
<hr />
<h4 class="modal-title" id="myModalLabel">Responsável pela conta</h4>
<div class="row">
    <div class="form-group col-md-8">
        <label  class="control-label label-padding"
                for="data[Company][responsible_name]">Nome</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][responsible_name]" name="data[Company][responsible_name]" placeholder="Nome" value="<?php echo $company['Company']['responsible_name']; ?>"/>
        </div>
    </div>
</div>

<!-- 6 -->
<div class="row">
    <div class="form-group col-md-8">
        <label  class="control-label label-padding"
                for="data[Company][responsible_email]">Email <small>  Será usado para acesso ao sistema</small></label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][responsible_email]" name="data[Company][responsible_email]" placeholder="Email" value="<?php echo $company['Company']['responsible_email']; ?>"/>
        </div>
    </div>
</div>

<!-- 7 -->
<div class="row">
    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[Company][responsible_cpf]">CPF</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][responsible_cpf]" name="data[Company][responsible_cpf]" placeholder="CPF" value="<?php echo $company['Company']['responsible_cpf']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[Company][responsible_phone]">Telefone</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][responsible_phone]" name="data[Company][responsible_phone]" placeholder="Telefone" value="<?php echo $company['Company']['responsible_phone']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[Company][responsible_phone_2]">Telefone 2</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][responsible_phone_2]" name="data[Company][responsible_phone_2]" placeholder="Telefone 2" value="<?php echo $company['Company']['responsible_phone_2']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[Company][responsible_cell]">Celular</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][responsible_cell]" name="data[Company][responsible_cell]" placeholder="Celular" value="<?php echo $company['Company']['responsible_cell_phone']; ?>"/>
        </div>
    </div>
</div>

<!-- 8 -->
<hr />
<h4 class="modal-title" id="myModalLabel">Endereço</h4>
<div class="row">
    <div class="form-group col-md-2">
        <label  class="control-label label-padding"
                for="data[Company][cep]">CEP</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][cep]" name="data[Company][cep]" placeholder="CEP" value="<?php echo $company['Company']['zip_code']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[Company][address]">Rua</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][address]" name="data[Company][address]" placeholder="Endereço" value="<?php echo $company['Company']['address']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-2">
        <label  class="control-label label-padding"
                for="data[Company][number]">Número</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][number]" name="data[Company][number]" placeholder="Número" value="<?php echo $company['Company']['number']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[Company][complement]">Complemento</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][complement]" name="data[Company][complement]" placeholder="Complemento" value="<?php echo $company['Company']['complement']; ?>"/>
        </div>
    </div>
</div>

<div class="row">

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[Company][district]">Bairro</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][district]" name="data[Company][district]" placeholder="Bairro" value="<?php echo $company['Company']['district']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[Company][city]">Cidade</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][city]" name="data[Company][city]" placeholder="Cidade" value="<?php echo $company['Company']['city']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[Company][uf]">UF</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[Company][uf]" name="data[Company][uf]" placeholder="UF" value="<?php echo $company['Company']['state']; ?>"/>
        </div>
    </div>

    <input type="text" class="form-control hide" 
           id="data[Company][id]" name="data[Company][id]" placeholder="id" value="<?php echo $company['Company']['id']; ?>"/>
</div>