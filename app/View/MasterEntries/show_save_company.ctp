<form class="form-horizontal" role="form" method="post" action="/jezzy-master/portal/masterEntries/saveCompany">
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
                               id="data[Company][corporate_name]" name='data[Company][corporate_name]' placeholder="Razão Social"/>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label  class="control-label label-padding"
                            for="data[Company][fancy_name]">Nome Fantasia</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" 
                               id="data[Company][fancy_name]" name='data[Company][fancy_name]' placeholder="Nome Fantasia"/>
                    </div>
                </div>
            </div>


            <!-- 3 -->
            <div class="row">

                <div class="form-group col-md-3">
                    <label  class="control-label label-padding"
                            for="data[Company][cnpj]">CNPJ</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control cnpj" 
                               id="data[Company][cnpj]" name="data[Company][cnpj]" placeholder="CNPJ"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label  class="control-label label-padding"
                            for="data[Company][phone]">Telefone </label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control phone" 
                               id="data[Company][phone]" name="data[Company][phone]" placeholder="Telefone"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label  class="control-label label-padding"
                            for="data[Company][phone_2]">Telefone 2</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control phone"  
                               id="data[Company][phone_2]" name="data[Company][phone_2]" placeholder="Telefone 2"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label  class="control-label label-padding"
                            for="data[Company][email]">Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" 
                               id="data[Company][email]" name="data[Company][email]" placeholder="Email"/>
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
                               id="data[Company][site]" name="data[Company][site]" placeholder="Site"/>
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
                               id="data[Company][responsible_name]" name="data[Company][responsible_name]" placeholder="Nome"/>
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
                               id="data[Company][responsible_email]" name="data[Company][responsible_email]" placeholder="Email"/>
                    </div>
                </div>
            </div>

            <!-- 7 -->
            <div class="row">
                <div class="form-group col-md-3">
                    <label  class="control-label label-padding"
                            for="data[Company][responsible_cpf]">CPF</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control cpf" 
                               id="data[Company][responsible_cpf]" name="data[Company][responsible_cpf]" placeholder="CPF"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label  class="control-label label-padding"
                            for="data[Company][responsible_phone]">Telefone</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control phone" 
                               id="data[Company][responsible_phone]" name="data[Company][responsible_phone]" placeholder="Telefone"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label  class="control-label label-padding"
                            for="data[Company][responsible_phone_2]">Telefone 2</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control phone" 
                               id="data[Company][responsible_phone_2]" name="data[Company][responsible_phone_2]" placeholder="Telefone 2"/>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label  class="control-label label-padding"
                            for="data[Company][responsible_cell]">Celular</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control phone" 
                               id="data[Company][responsible_cell]" name="data[Company][responsible_cell]" placeholder="Celular"/>
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
                               id="companyCep" name="data[Company][cep]" placeholder="CEP" onkeyup="searchAddressByZipcode()"/>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label  class="control-label label-padding"
                            for="data[Company][address]">Rua</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" 
                               id="companyLogradouro" name="data[Company][address]" placeholder="Endereço"/>
                    </div>
                </div>

                <div class="form-group col-md-2">
                    <label  class="control-label label-padding"
                            for="data[Company][number]">Número</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" 
                               id="data[Company][number]" name="data[Company][number]" placeholder="Número"/>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label  class="control-label label-padding"
                            for="data[Company][complement]">Complemento</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" 
                               id="data[Company][complement]" name="data[Company][complement]" placeholder="Complemento"/>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-4">
                    <label  class="control-label label-padding"
                            for="data[Company][district]">Bairro</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" 
                               id="companyBairro" name="data[Company][district]" placeholder="Bairro"/>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label  class="control-label label-padding"
                            for="data[Company][city]">Cidade</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" 
                               id="companyLocalidade" name="data[Company][city]" placeholder="Cidade"/>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label  class="control-label label-padding"
                            for="data[Company][uf]">UF</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" 
                               id="companyUf" name="data[Company][uf]" placeholder="UF"/>
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



 
        