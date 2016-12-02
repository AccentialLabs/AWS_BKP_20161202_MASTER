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
                for="data[distributors][corporate_name]">Razão social</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][corporate_name]" name='data[distributors][corporate_name]' placeholder="Razão Social" value="<?php echo $distributors['distributors']['corporate_name']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-6">
        <label  class="control-label label-padding"
                for="data[distributors][fancy_name]">Nome Fantasia</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][fancy_name]" name='data[distributors][fancy_name]' placeholder="Nome Fantasia" value="<?php echo $distributors['distributors']['fancy_name']; ?>"/>
        </div>
    </div>
</div>


<!-- 3 -->
<div class="row">

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[distributors][cnpj]">CNPJ</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][cnpj]" name="data[distributors][cnpj]" placeholder="CNPJ" value="<?php echo $distributors['distributors']['cnpj']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[distributors][phone]">Telefone </label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][phone]" name="data[distributors][phone]" placeholder="Telefone" value="<?php echo $distributors['distributors']['phone']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[distributors][phone_2]">Telefone 2</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][phone_2]" name="data[distributors][phone_2]" placeholder="Telefone 2" value="<?php echo $distributors['distributors']['phone_2']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[distributors][email]">Email</label>
        <div class="col-sm-12">
            <input type="email" class="form-control" 
                   id="data[distributors][email]" name="data[distributors][email]" placeholder="Email" value="<?php echo $distributors['distributors']['email']; ?>"/>
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
                   id="data[distributors][site]" name="data[distributors][site]" placeholder="Site" value="<?php echo $distributors['distributors']['site_url']; ?>"/>
        </div>
    </div>
</div>


<!-- 5 -->
<hr />
<h4 class="modal-title" id="myModalLabel">Responsável pela conta</h4>
<div class="row">
    <div class="form-group col-md-8">
        <label  class="control-label label-padding"
                for="data[distributors][responsible_name]">Nome</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][responsible_name]" name="data[distributors][responsible_name]" placeholder="Nome" value="<?php echo $distributors['distributors']['responsible_name']; ?>"/>
        </div>
    </div>
</div>

<!-- 6 -->
<div class="row">
    <div class="form-group col-md-8">
        <label  class="control-label label-padding"
                for="data[distributors][responsible_email]">Email <small>  Será usado para acesso ao sistema</small></label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][responsible_email]" name="data[distributors][responsible_email]" placeholder="Email" value="<?php echo $distributors['distributors']['responsible_email']; ?>"/>
        </div>
    </div>
</div>

<!-- 7 -->
<div class="row">
    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[distributors][responsible_cpf]">CPF</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][responsible_cpf]" name="data[distributors][responsible_cpf]" placeholder="CPF" value="<?php echo $distributors['distributors']['responsible_cpf']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[distributors][responsible_phone]">Telefone</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][responsible_phone]" name="data[distributors][responsible_phone]" placeholder="Telefone" value="<?php echo $distributors['distributors']['responsible_phone']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[distributors][responsible_phone_2]">Telefone 2</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][responsible_phone_2]" name="data[distributors][responsible_phone_2]" placeholder="Telefone 2" value="<?php echo $distributors['distributors']['responsible_phone_2']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-3">
        <label  class="control-label label-padding"
                for="data[distributors][responsible_cell]">Celular</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][responsible_cell]" name="data[distributors][responsible_cell]" placeholder="Celular" value="<?php echo $distributors['distributors']['responsible_cell_phone']; ?>"/>
        </div>
    </div>
</div>

<!-- 8 -->
<hr />
<h4 class="modal-title" id="myModalLabel">Endereço</h4>
<div class="row">
    <div class="form-group col-md-2">
        <label  class="control-label label-padding"
                for="data[distributors][cep]">CEP</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][cep]" name="data[distributors][cep]" placeholder="CEP" value="<?php echo $distributors['distributors']['zip_code']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[distributors][address]">Rua</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][address]" name="data[distributors][address]" placeholder="Endereço" value="<?php echo $distributors['distributors']['address']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-2">
        <label  class="control-label label-padding"
                for="data[distributors][number]">Número</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][number]" name="data[distributors][number]" placeholder="Número" value="<?php echo $distributors['distributors']['number']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[distributors][complement]">Complemento</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][complement]" name="data[distributors][complement]" placeholder="Complemento" value="<?php echo $distributors['distributors']['complement']; ?>"/>
        </div>
    </div>
</div>

<div class="row">

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[distributors][district]">Bairro</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][district]" name="data[distributors][district]" placeholder="Bairro" value="<?php echo $distributors['distributors']['district']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[distributors][city]">Cidade</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][city]" name="data[distributors][city]" placeholder="Cidade" value="<?php echo $distributors['distributors']['city']; ?>"/>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label  class="control-label label-padding"
                for="data[distributors][uf]">UF</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" 
                   id="data[distributors][uf]" name="data[distributors][uf]" placeholder="UF" value="<?php echo $distributors['distributors']['state']; ?>"/>
        </div>
    </div>

    <input type="text" class="form-control hide" 
           id="data[distributors][id]" name="data[distributors][id]" placeholder="id" value="<?php echo $distributors['distributors']['id']; ?>"/>
</div>