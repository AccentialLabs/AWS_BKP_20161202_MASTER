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
                   id="data[provider][corporate_name]" name='data[provider][corporate_name]' placeholder="Razão Social" value="<?php echo $provider['providers']['corporate_name']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="data[provider][fancy_name]">Nome Fantasia</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][fancy_name]" name='data[provider][fancy_name]' placeholder="Nome Fantasia" value="<?php echo $provider['providers']['fancy_name']; ?>"/>
        </div>
    </div>
</div>


<!-- 3 -->
<div class="row">

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[provider][cnpj]">CNPJ</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][cnpj]" name="data[provider][cnpj]" placeholder="CNPJ" value="<?php echo $provider['providers']['cnpj']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[provider][phone]">Telefone </label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][phone]" name="data[provider][phone]" placeholder="Telefone" value="<?php echo $provider['providers']['phone']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[provider][phone_2]">Telefone 2</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][phone_2]" name="data[provider][phone_2]" placeholder="Telefone 2" value="<?php echo $provider['providers']['phone_2']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[provider][email]">Email</label>
        <div class="col-sm-12">
            <input type="email" class="form-control" 
                   id="data[provider][email]" name="data[provider][email]" placeholder="Email" value="<?php echo $provider['providers']['email']; ?>"/>
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
                   id="data[provider][site]" name="data[provider][site]" placeholder="Site" value="<?php echo $provider['providers']['site_url']; ?>"/>
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
                   id="data[provider][responsible_name]" name="data[provider][responsible_name]" placeholder="Nome" value="<?php echo $provider['providers']['responsible_name']; ?>"/>
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
                   id="data[provider][responsible_email]" name="data[provider][responsible_email]" placeholder="Email" value="<?php echo $provider['providers']['responsible_email']; ?>"/>
        </div>
    </div>
</div>

<!-- 7 -->
<div class="row">
    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[provider][responsible_cpf]">CPF</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][responsible_cpf]" name="data[provider][responsible_cpf]" placeholder="CPF" value="<?php echo $provider['providers']['responsible_cpf']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[provider][responsible_phone]">Telefone</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][responsible_phone]" name="data[provider][responsible_phone]" placeholder="Telefone" value="<?php echo $provider['providers']['responsible_phone']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[provider][responsible_phone_2]">Telefone 2</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][responsible_phone_2]" name="data[provider][responsible_phone_2]" placeholder="Telefone 2" value="<?php echo $provider['providers']['responsible_phone_2']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[provider][responsible_cell]">Celular</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][responsible_cell]" name="data[provider][responsible_cell]" placeholder="Celular" value="<?php echo $provider['providers']['responsible_cell_phone']; ?>"/>
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
                   id="data[provider][cep]" name="data[provider][cep]" placeholder="CEP" value="<?php echo $provider['providers']['zip_code']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[provider][address]">Rua</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][address]" name="data[provider][address]" placeholder="Endereço" value="<?php echo $provider['providers']['address']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-2">
        <label  class="control-label label-padding"
                for="data[provider][number]">Número</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][number]" name="data[provider][number]" placeholder="Número" value="<?php echo $provider['providers']['number']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[provider][complement]">Complemento</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][complement]" name="data[provider][complement]" placeholder="Complemento" value="<?php echo $provider['providers']['complement']; ?>"/>
        </div>
    </div>
</div>

<div class="row">

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[provider][district]">Bairro</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][district]" name="data[provider][district]" placeholder="Bairro" value="<?php echo $provider['providers']['district']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[provider][city]">Cidade</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][city]" name="data[provider][city]" placeholder="Cidade" value="<?php echo $provider['providers']['city']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[provider][uf]">UF</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[provider][uf]" name="data[provider][uf]" placeholder="UF" value="<?php echo $provider['providers']['state']; ?>"/>
        </div>
    </div>

    <input type="text" class="form-control hide" 
           id="data[provider][id]" name="data[provider][id]" placeholder="id" value="<?php echo $provider['providers']['id']; ?>"/>
</div>