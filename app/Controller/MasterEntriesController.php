<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require("../Vendor/phpmailer/PHPMailerAutoload.php");

/**
 * Description of MasterEntriesController
 *
 * @author user
 */
class MasterEntriesController extends AppController {

    //put your code here

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business_master';
        parent::__construct($request, $response);
    }

    public function index() {

        $this->Session->write("offerEditing", false);
        $companies = $this->getAllCompanies();
        $providers = $this->getAllProviders();

        $this->set("companies", $companies);
        $this->set("providers", $providers);
    }
	
	public function distributors(){
		
                 $editingDistribute = $this->Session->read("editingDistribute");
		 $companies = $this->getAllDistributors();
                 $providers = $this->getAllProviders();
		 $financialParameters = $this->getAllFinancialParameter();
		 
		 $this->set("companies", $companies);
		  $this->set("financialParameters", $financialParameters);
                  $this->set("providers", $providers);
	}
	
	public function financialParametersResult(){
	
		$parameters = $this->getAllFinancialParameterResults();
		$this->set('parameters', $parameters);
	
	}
	
	
   private function getAllCompanies() {

        $params = array(
            'Company' => array(
                'conditions' => array(
                )
            )
			
        );
        $companies = $this->AccentialApi->urlRequestToGetData('companies', 'all', $params);
		
		$cont =0;
		$comps = '';
		foreach($companies as $comp){
			
			$query = "SELECT * FROM company_plans WHERE company_id = {$comp['Company']['id']};";
			$providersParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $plan = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);
		
		if(!empty($plan)){
		
			$comp['Company']['plan'] = $plan[0]['company_plans']['plan'];
			$comp['Company']['plan_days'] = $plan[0]['company_plans']['TRIAL_COUNTER'];
		
		}else{
		
			$comp['Company']['plan'] = "MASTER";
		
		}
		
			$comps[$cont] = $comp;
			$cont++;
		}
		
        $this->Session->write('SessionCompanies', $comps);
        return $comps;
    }
    
    
    private function getAllProviders() {

        $query = "SELECT * FROM providers order by status,corporate_name,fancy_name;";
        $providersParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnProviders = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);
        $this->Session->write('SessionProviders', $returnProviders);
        return $returnProviders;
    }
	
	  private function getAllDistributors() {

        $query = "SELECT * FROM distributors order by status,corporate_name,fancy_name;";
        $providersParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnProviders = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);
        $this->Session->write('SessionDistributors', $returnProviders);
        return $returnProviders;
    }
	
	private function getAllFinancialParameter() {

        $query = "SELECT financial_parameters.*, distributors.fancy_name FROM financial_parameters
						inner join distributors on distributors.id = financial_parameters.distributor_id;";
        $providersParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnProviders = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);
        $this->Session->write('SessionFinancialParameter', $returnProviders);
        return $returnProviders;
    }
	
	private function getAllFinancialParameterResults() {

        $query = "select * from financial_parameters_results 
					inner join distributors on distributors.id = financial_parameters_results.distributor_id
					LEFT JOIN companies on companies.id = financial_parameters_results.company_id  ORDER BY financial_parameters_results.id DESC;";
        $providersParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnProviders = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);
        $this->Session->write('SessionFinancialParameterResults', $returnProviders);
        return $returnProviders;
    }

    public function saveProvider() {
        $this->autoRender = false;

        $editingProvider = $this->Session->read("offerEditing");

        if ($editingProvider == false) {
            // CRIAÇÃO DE FORNECEDOR
            $sql = "INSERT INTO providers(" .
                    "`corporate_name`,"
                    . "`fancy_name`,"
                    . "`description`,"
                    . "`site_url`,"
                    . "`category_id`,"
                    . "`sub_category_id`,"
                    . "`cnpj`,"
                    . "`email`,"
                    . "`password`,"
                    . "`phone`,"
                    . "`phone_2`,"
                    . "`address`,"
                    . "`complement`,"
                    . "`city`,"
                    . "`state`,"
                    . "`district`,"
                    . "`number`,"
                    . "`zip_code`,"
                    . "`responsible_name`,"
                    . "`responsible_cpf`,"
                    . "`responsible_email`,"
                    . "`responsible_phone`,"
                    . "`responsible_phone_2`,"
                    . "`responsible_cell_phone`,"
                    . "`logo`,"
                    . "`status`,"
                    . "`login_moip`,"
                    . "`register`,"
                    . "`facebook_install`,"
                    . "`date_register`"
                    . ") VALUES("
                    . "'" . $this->request->data['provider']['corporate_name'] . "',"
                    . "'" . $this->request->data['provider']['fancy_name'] . "',"
                    . "'descricao forn',"
                    . "'" . $this->request->data['provider']['site'] . "',"
                    . "15,"
                    . "15, "
                    . "'" . $this->request->data['provider']['cnpj'] . "',"
                    . "'" . $this->request->data['provider']['email'] . "',"
                    . "'123456',"
                    . "'" . $this->request->data['provider']['phone'] . "',"
                    . "'" . $this->request->data['provider']['phone_2'] . "',"
                    . "'" . $this->request->data['provider']['address'] . "',"
                    . "'" . $this->request->data['provider']['complement'] . "',"
                    . "'" . $this->request->data['provider']['city'] . "',"
                    . "'" . $this->request->data['provider']['uf'] . "',"
                    . "'" . $this->request->data['provider']['district'] . "',"
                    . "'" . $this->request->data['provider']['number'] . "',"
                    . "'" . $this->request->data['provider']['cep'] . "',"
                    . "'" . $this->request->data['provider']['responsible_name'] . "',"
                    . "'" . $this->request->data['provider']['responsible_cpf'] . "',"
                    . "'" . $this->request->data['provider']['responsible_email'] . "',"
                    . "'" . $this->request->data['provider']['responsible_phone'] . "',"
                    . "'" . $this->request->data['provider']['responsible_phone_2'] . "',"
                    . "'" . $this->request->data['provider']['responsible_cell'] . "',"
                    . "'logoglollgolgolokogolgogl',"
                    . "'ACTIVE',"
                    . "0,"
                    . "0,"
                    . "0,"
                    . "'0000-00-00 00:00:00'"
                    . ");";

            $providersParam = array(
                'User' => array(
                    'query' => $sql
                )
            );
            $retorno = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);

            echo print_r($retorno);
        } else {
            //EDIÇÃO DE FORNECEDOR
            $sqlEdit = "UPDATE providers set" .
                    " corporate_name = '" . $this->request->data['provider']['corporate_name'] . "',"
                    . "fancy_name = '" . $this->request->data['provider']['fancy_name'] . "',"
                    . "description = 'DESCRIPTION',"
                    . "site_url = '" . $this->request->data['provider']['site'] . "',"
                    . "category_id = 15,"
                    . "sub_category_id = 15,"
                    . "cnpj = '" . $this->request->data['provider']['cnpj'] . "',"
                    . "email = '" . $this->request->data['provider']['email'] . "',"
                    . "password = '123456',"
                    . "phone = '" . $this->request->data['provider']['phone'] . "',"
                    . "phone_2 = '" . $this->request->data['provider']['phone_2'] . "',"
                    . "address = '" . $this->request->data['provider']['address'] . "',"
                    . "complement = '" . $this->request->data['provider']['complement'] . "',"
                    . "city = '" . $this->request->data['provider']['city'] . "',"
                    . "state ='" . $this->request->data['provider']['uf'] . "',"
                    . "district = '" . $this->request->data['provider']['district'] . "',"
                    . "number = '" . $this->request->data['provider']['number'] . "',"
                    . "zip_code = '" . $this->request->data['provider']['cep'] . "',"
                    . "responsible_name = '" . $this->request->data['provider']['responsible_name'] . "',"
                    . "responsible_cpf ='" . $this->request->data['provider']['responsible_cpf'] . "',"
                    . "responsible_email ='" . $this->request->data['provider']['responsible_email'] . "',"
                    . "responsible_phone ='" . $this->request->data['provider']['responsible_phone'] . "',"
                    . "responsible_phone_2 = '" . $this->request->data['provider']['responsible_phone_2'] . "',"
                    . "responsible_cell_phone = '" . $this->request->data['provider']['responsible_cell'] . "',"
                    . "logo = 'logogogogogog',"
                    . "status = 'ACTIVE',"
                    . "login_moip = 0,"
                    . "register = 0,"
                    . "facebook_install = 0,"
                    . "date_register = '0000-00-00 00:00:00'"
                    . "WHERE id = " . $this->request->data['provider']['id'] . ";";

            $providersParamEdit = array(
                'User' => array(
                    'query' => $sqlEdit
                )
            );
            $retorno = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParamEdit);

            //EDITANDO OFERTA = TRUE
            $this->Session->write("offerEditing", false);
        }
    }

    public function editProvider() {

        //EDITANDO OFERTA = TRUE
        $this->Session->write("offerEditing", true);

        $this->layout = "";
        $index = $this->request->data['providerIndex'];
        $providers = $this->Session->read('SessionProviders');
        $provider = $providers[$index];
        $this->set("provider", $provider);
    }

    public function removeProvider() {

        $this->layout = '';
        $query = "UPDATE providers SET status = 'INACTIVE' WHERE id = {$this->request->data['id']};";
        $providersParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnProviders = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);
        echo print_r($returnProviders);
    }

    public function reativeProvider() {

        $this->layout = '';
        $query = "UPDATE providers SET status = 'ACTIVE' WHERE id = {$this->request->data['id']};";
        $providersParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnProviders = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);
        echo print_r($returnProviders);
    }

    public function showSaveCompany() {

        $this->layout = "";
    }

    public function saveCompany() {

        $this->autoRender = false;

        $editingCompany = $this->Session->read("companyEditing");

        if ($editingCompany == false) {

            $password = $this->geraSenha();

            // CRIAÇÃO DE FORNECEDOR
            $sql = "INSERT INTO companies(" .
                    "`corporate_name`,"
                    . "`fancy_name`,"
                    . "`description`,"
                    . "`site_url`,"
                    . "`category_id`,"
                    . "`sub_category_id`,"
                    . "`cnpj`,"
                    . "`email`,"
                    . "`password`,"
                    . "`phone`,"
                    . "`phone_2`,"
                    . "`address`,"
                    . "`complement`,"
                    . "`city`,"
                    . "`state`,"
                    . "`district`,"
                    . "`number`,"
                    . "`zip_code`,"
                    . "`responsible_name`,"
                    . "`responsible_cpf`,"
                    . "`responsible_email`,"
                    . "`responsible_phone`,"
                    . "`responsible_phone_2`,"
                    . "`responsible_cell_phone`,"
                    . "`logo`,"
                    . "`status`,"
                    . "`login_moip`,"
                    . "`register`,"
                    . "`facebook_install`,"
                    . "`date_register`"
                    . ") VALUES("
                    . "'" . $this->request->data['Company']['corporate_name'] . "',"
                    . "'" . $this->request->data['Company']['fancy_name'] . "',"
                    . "'descricao forn',"
                    . "'" . $this->request->data['Company']['site'] . "',"
                    . "15,"
                    . "15, "
                    . "'" . $this->request->data['Company']['cnpj'] . "',"
                    . "'" . $this->request->data['Company']['email'] . "',"
                    . "'" . md5($password) . "',"
                    . "'" . $this->request->data['Company']['phone'] . "',"
                    . "'" . $this->request->data['Company']['phone_2'] . "',"
                    . "'" . $this->request->data['Company']['address'] . "',"
                    . "'" . $this->request->data['Company']['complement'] . "',"
                    . "'" . $this->request->data['Company']['city'] . "',"
                    . "'" . $this->request->data['Company']['uf'] . "',"
                    . "'" . $this->request->data['Company']['district'] . "',"
                    . "'" . $this->request->data['Company']['number'] . "',"
                    . "'" . $this->request->data['Company']['cep'] . "',"
                    . "'" . $this->request->data['Company']['responsible_name'] . "',"
                    . "'" . $this->request->data['Company']['responsible_cpf'] . "',"
                    . "'" . $this->request->data['Company']['responsible_email'] . "',"
                    . "'" . $this->request->data['Company']['responsible_phone'] . "',"
                    . "'" . $this->request->data['Company']['responsible_phone_2'] . "',"
                    . "'" . $this->request->data['Company']['responsible_cell'] . "',"
                    . "'logoglollgolgolokogolgogl',"
                    . "'ACTIVE',"
                    . "0,"
                    . "0,"
                    . "0,"
                    . date('Y/m/d') . ","
                    . ");";

            $CompanysParam = array(
                'User' => array(
                    'query' => $sql
                )
            );
            $retorno = $this->AccentialApi->urlRequestToGetData('users', 'query', $CompanysParam);


            $selectSql = "select * from companies where cnpj LIKE '" . $this->request->data['Company']['cnpj'] . "';";
            $SelCompanyParam = array(
                'User' => array(
                    'query' => $selectSql
                )
            );

            $retornoSelect = $this->AccentialApi->urlRequestToGetData('users', 'query', $SelCompanyParam);

            //CRIANDO DIRETORIO PARA COMPANY
            $this->AccentialApi->createCompanyDir($retornoSelect[0]['companies']['id']);

            //	ENVIANDO EMAIL COM USUARIO E SENHA
            $this->sendEmailNewUser($this->request->data['Company']['fancy_name'], $this->request->data['Company']['email'], $password);
        } else {
            //EDIÇÃO DE FORNECEDOR
            $sqlEdit = "UPDATE companies set" .
                    " corporate_name = '" . $this->request->data['Company']['corporate_name'] . "',"
                    . "fancy_name = '" . $this->request->data['Company']['fancy_name'] . "',"
                    . "description = 'DESCRIPTION',"
                    . "site_url = '" . $this->request->data['Company']['site'] . "',"
                    . "category_id = 15,"
                    . "sub_category_id = 15,"
                    . "cnpj = '" . $this->request->data['Company']['cnpj'] . "',"
                    . "email = '" . $this->request->data['Company']['email'] . "',"
                    . "password = '123456',"
                    . "phone = '" . $this->request->data['Company']['phone'] . "',"
                    . "phone_2 = '" . $this->request->data['Company']['phone_2'] . "',"
                    . "address = '" . $this->request->data['Company']['address'] . "',"
                    . "complement = '" . $this->request->data['Company']['complement'] . "',"
                    . "city = '" . $this->request->data['Company']['city'] . "',"
                    . "state ='" . $this->request->data['Company']['uf'] . "',"
                    . "district = '" . $this->request->data['Company']['district'] . "',"
                    . "number = '" . $this->request->data['Company']['number'] . "',"
                    . "zip_code = '" . $this->request->data['Company']['cep'] . "',"
                    . "responsible_name = '" . $this->request->data['Company']['responsible_name'] . "',"
                    . "responsible_cpf ='" . $this->request->data['Company']['responsible_cpf'] . "',"
                    . "responsible_email ='" . $this->request->data['Company']['responsible_email'] . "',"
                    . "responsible_phone ='" . $this->request->data['Company']['responsible_phone'] . "',"
                    . "responsible_phone_2 = '" . $this->request->data['Company']['responsible_phone_2'] . "',"
                    . "responsible_cell_phone = '" . $this->request->data['Company']['responsible_cell'] . "',"
                    . "logo = 'logogogogogog',"
                    . "status = 'ACTIVE',"
                    . "login_moip = 0,"
                    . "register = 0,"
                    . "facebook_install = 0,"
                    . "date_register = '0000-00-00 00:00:00'"
                    . "WHERE id = " . $this->request->data['Company']['id'] . ";";

            $CompanysParamEdit = array(
                'User' => array(
                    'query' => $sqlEdit
                )
            );
            $retorno = $this->AccentialApi->urlRequestToGetData('users', 'query', $CompanysParamEdit);

            //EDITANDO OFERTA = TRUE
            $this->Session->write("companyEditing", false);
        }
    }

    public function editCompany() {

        //EDITANDO OFERTA = TRUE
        $this->Session->write("companyEditing", true);

        $this->layout = "";
        $index = $this->request->data['companyIndex'];
        $companies = $this->Session->read('SessionCompanies');
        $company = $companies[$index];
        $this->set("company", $company);
    }

    public function removeCompany() {

        $this->layout = '';
        $query = "UPDATE companies SET status = 'INACTIVE' WHERE id = {$this->request->data['id']};";
        
        
        $providersParam = array(
            'User' => array(
                'query' => $query
            )
        );

       $returnProviders = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);
        //echo print_r($returnProviders);
      return $returnProviders;
    }
 public function SaveCommission() {

        $this->autoRender = false;
        $query = "UPDATE providers SET commission ='{$this->request->data['commission']}' WHERE id = {$this->request->data['id']};";
        
        
        $providersCommissionParam = array(
            'User' => array(
                'query' => $query
            )
        );

       $returnCommissionProviders = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersCommissionParam);
        //echo print_r($returnProviders);
       return $returnCommissionProviders;
    
    }
    public function reativeCompany() {

        $this->layout = '';
        $query = "UPDATE companies SET status = 'ACTIVE' WHERE id = {$this->request->data['id']};";
        $providersParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnProviders = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);
        //echo print_r($returnProviders);
    }

    public function saveCompanyLogo($logo, $companyId) {

        $this->autoRender = false;
        $url = "jezzyuploads/company-" . $companyId . "/config";
        $offersExtraPhotos = $this->AccentialApi->uploadAnyPhotoCompany($url, $logo, $companyId);
        // $saveDatabase = $this->saveImageUrl($this->request['data']['offerId'], $offersExtraPhotos, true);

        return $offersExtraPhotos;
    }

    public function sendEmailNewUser($fancyName, $companyemail, $pass) {
        $mail = new PHPMailer(true);

        // Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsSMTP(); // Define que a mensagem será SMTP
        $mail->Host = "pro.turbo-smtp.com"; // Endereço do servidor SMTP
        $mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
        $mail->Username = 'contato@jezzy.com.br'; // Usuário do servidor SMTP
        $mail->Password = 'oo0MvB2Qw'; // Senha do servidor SMTP
        // Define o remetente
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->From = "contato@jezzy.com.br"; // Seu e-mail
        $mail->FromName = "Contato - Jezzy"; // Seu nome

        $mail->AddAddress("{$companyemail}");

        // Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        $mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->Subject = "Bem-Vindo ao Jezzy Empresas"; // Assunto da mensagem
        $mail->Body = "Ola, {$fancyName} seja bem-vindo ao Jezzy Empresas, seus dados de login sao: <br/> Usuário: {$companyemail} <br/> Senha: {$pass} <br/><br/> <b>Boas Compras!</b>";
        $mail->AltBody = "";

        // Define os anexos (opcional)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
        // Envia o e-mail
        $enviado = $mail->Send();

// Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
    }

    function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
// Caracteres de cada tipo
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
// Variáveis internas
        $retorno = '';
        $caracteres = '';
// Agrupamos todos os caracteres que poderão ser utilizados
        $caracteres .= $lmin;
        if ($maiusculas)
            $caracteres .= $lmai;
        if ($numeros)
            $caracteres .= $num;
        if ($simbolos)
            $caracteres .= $simb;
// Calculamos o total de caracteres possíveis
        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
            $rand = mt_rand(1, $len);
// Concatenamos um dos caracteres na variável $retorno
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }

    public function searchAddressByZipcode() {
        $this->autoRender = false;
        $cURL = curl_init("http://cep.correiocontrol.com.br/{$this->request->data['cep']}.json");
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        $resultado = curl_exec($cURL);
        curl_close($cURL);
        echo $resultado;
    }

    public function saveSplitForCompany() {
        $this->autoRender = false;
        $compID = $this->request->data['id'];
        $split = $this->request->data['split'];


        $sql = "UPDATE companies SET percentage_split = {$split} WHERE id = {$compID};";
        $param = array(
            'User' => array(
                'query' => $sql
            )
        );

        $this->AccentialApi->urlRequestToGetData('users', 'query', $param);
    }
	
	  public function saveDistribute() {
        $this->autoRender = false;

        $editingDistribute = $this->Session->read("editingDistribute");

        if ($editingDistribute == false) {
            // CRIAÇÃO DE FORNECEDOR
            $sql = "INSERT INTO distributors(" .
                    "`corporate_name`,"
                    . "`fancy_name`,"
                    . "`description`,"
                    . "`site_url`,"
                    . "`category_id`,"
                    . "`sub_category_id`,"
                    . "`cnpj`,"
                    . "`email`,"
                    . "`password`,"
                    . "`phone`,"
                    . "`phone_2`,"
                    . "`address`,"
                    . "`complement`,"
                    . "`city`,"
                    . "`state`,"
                    . "`district`,"
                    . "`number`,"
                    . "`zip_code`,"
                    . "`responsible_name`,"
                    . "`responsible_cpf`,"
                    . "`responsible_email`,"
                    . "`responsible_phone`,"
                    . "`responsible_phone_2`,"
                    . "`responsible_cell_phone`,"
                    . "`logo`,"
                    . "`status`,"
                    . "`login_moip`,"
                    . "`register`,"
                    . "`facebook_install`,"
                    . "`date_register`"
                    . ") VALUES("
                    . "'" . $this->request->data['distributors']['corporate_name'] . "',"
                    . "'" . $this->request->data['distributors']['fancy_name'] . "',"
                    . "'descricao forn',"
                    . "'" . $this->request->data['distributors']['site'] . "',"
                    . "15,"
                    . "15, "
                    . "'" . $this->request->data['distributors']['cnpj'] . "',"
                    . "'" . $this->request->data['distributors']['email'] . "',"
                    . "'123456',"
                    . "'" . $this->request->data['distributors']['phone'] . "',"
                    . "'" . $this->request->data['distributors']['phone_2'] . "',"
                    . "'" . $this->request->data['distributors']['address'] . "',"
                    . "'" . $this->request->data['distributors']['complement'] . "',"
                    . "'" . $this->request->data['distributors']['city'] . "',"
                    . "'" . $this->request->data['distributors']['uf'] . "',"
                    . "'" . $this->request->data['distributors']['district'] . "',"
                    . "'" . $this->request->data['distributors']['number'] . "',"
                    . "'" . $this->request->data['distributors']['cep'] . "',"
                    . "'" . $this->request->data['distributors']['responsible_name'] . "',"
                    . "'" . $this->request->data['distributors']['responsible_cpf'] . "',"
                    . "'" . $this->request->data['distributors']['responsible_email'] . "',"
                    . "'" . $this->request->data['distributors']['responsible_phone'] . "',"
                    . "'" . $this->request->data['distributors']['responsible_phone_2'] . "',"
                    . "'" . $this->request->data['distributors']['responsible_cell'] . "',"
                    . "'logoglollgolgolokogolgogl',"
                    . "'ACTIVE',"
                    . "0,"
                    . "0,"
                    . "0,"
                    . "'0000-00-00 00:00:00'"
                    . ");";

            $providersParam = array(
                'User' => array(
                    'query' => $sql
                )
            );
            $retorno = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParam);

            echo print_r($retorno);
        } else {
            //EDIÇÃO DE FORNECEDOR
            $sqlEdit = "UPDATE providers set" .
                    " corporate_name = '" . $this->request->data['distributors']['corporate_name'] . "',"
                    . "fancy_name = '" . $this->request->data['distributors']['fancy_name'] . "',"
                    . "description = 'DESCRIPTION',"
                    . "site_url = '" . $this->request->data['distributors']['site'] . "',"
                    . "category_id = 15,"
                    . "sub_category_id = 15,"
                    . "cnpj = '" . $this->request->data['distributors']['cnpj'] . "',"
                    . "email = '" . $this->request->data['distributors']['email'] . "',"
                    . "password = '123456',"
                    . "phone = '" . $this->request->data['distributors']['phone'] . "',"
                    . "phone_2 = '" . $this->request->data['distributors']['phone_2'] . "',"
                    . "address = '" . $this->request->data['distributors']['address'] . "',"
                    . "complement = '" . $this->request->data['distributors']['complement'] . "',"
                    . "city = '" . $this->request->data['distributors']['city'] . "',"
                    . "state ='" . $this->request->data['distributors']['uf'] . "',"
                    . "district = '" . $this->request->data['distributors']['district'] . "',"
                    . "number = '" . $this->request->data['distributors']['number'] . "',"
                    . "zip_code = '" . $this->request->data['distributors']['cep'] . "',"
                    . "responsible_name = '" . $this->request->data['distributors']['responsible_name'] . "',"
                    . "responsible_cpf ='" . $this->request->data['distributors']['responsible_cpf'] . "',"
                    . "responsible_email ='" . $this->request->data['distributors']['responsible_email'] . "',"
                    . "responsible_phone ='" . $this->request->data['distributors']['responsible_phone'] . "',"
                    . "responsible_phone_2 = '" . $this->request->data['distributors']['responsible_phone_2'] . "',"
                    . "responsible_cell_phone = '" . $this->request->data['distributors']['responsible_cell'] . "',"
                    . "logo = 'logogogogogog',"
                    . "status = 'ACTIVE',"
                    . "login_moip = 0,"
                    . "register = 0,"
                    . "facebook_install = 0,"
                    . "date_register = '0000-00-00 00:00:00'"
                    . "WHERE id = " . $this->request->data['distributors']['id'] . ";";

            $providersParamEdit = array(
                'User' => array(
                    'query' => $sqlEdit
                )
            );
            $retorno = $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParamEdit);

            //EDITANDO OFERTA = TRUE
            $this->Session->write("editingDistribute", false);
        }
    }
	
	 public function editDistribute() {

        //EDITANDO OFERTA = TRUE
        $this->Session->write("distributeEditing", true);

        $this->layout = "";
        $index = $this->request->data['companyIndex'];
        $companies = $this->Session->read('SessionDistributors');
        $company = $companies[$index];
        $this->set("distributors", $company);
    }
	
	public function saveFinancialParameter(){
		$this->autoRender = false;
		$dateRegister = date("Y-m-d");
		
		
        $editingFinancialParameter = $this->Session->read("financialParameterEditing");

        if ($editingFinancialParameter == false) {
	
		$sqlInsert = "INSERT INTO financial_parameters(
							`distributor_id`,
								`tx_imp`,
								`tx_mpgto`,
								`tar_trans`,
								`vl_emb`,
								`tx_salao`,
								`tx_parc`,
								`tx_infra_dist`,
								`tx_infra_jzy`,
								`tx_fdo_mkt`,
								`qdt_partes`,
								`date_register`) VALUES(
								{$this->request->data['distributor_id']},
								{$this->request->data['tx_imp']},
								{$this->request->data['tx_mpgto']},
								{$this->request->data['tar_trans']},
								{$this->request->data['vl_emb']},
								{$this->request->data['tx_salao']},
								{$this->request->data['tx_parc']},
								{$this->request->data['tx_infra_dist']},
								{$this->request->data['tx_infra_jzy']},
								{$this->request->data['tx_fdo_mkt']},
								{$this->request->data['qdt_partes']},
								'{$dateRegister}'
								);";
								
			$providersParamEdit = array(
                'User' => array(
                    'query' => $sqlInsert
                )
            );
            $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParamEdit);
			
			}else{
			
				$sqlUpdate = "UPDATE financial_parameters set
								tx_imp = {$this->request->data['tx_imp']},
								tx_mpgto ={$this->request->data['tx_mpgto']},
								tar_trans = {$this->request->data['tar_trans']},
								vl_emb = {$this->request->data['vl_emb']},
								tx_salao = {$this->request->data['tx_salao']},
								tx_parc = {$this->request->data['tx_parc']},
								tx_infra_dist = {$this->request->data['tx_infra_dist']},
								tx_infra_jzy = {$this->request->data['tx_infra_jzy']},
								tx_fdo_mkt = {$this->request->data['tx_fdo_mkt']},
								qdt_partes = {$this->request->data['qdt_partes']}
								WHERE id = {$this->request->data['paramater_id']};";

			$providersParamEdit = array(
                'User' => array(
                    'query' => $sqlUpdate
                )
            );
            $this->AccentialApi->urlRequestToGetData('users', 'query', $providersParamEdit);
			
			}
			
			
			$this->Session->write("financialParameterEditing", false);
			$this->redirect(
				array(
					"controller" => "masterEntries",
					"action" => "distributors"
				)
			); 
 	
	}
	
	 public function editFinancialParameter() {

        //EDITANDO OFERTA = TRUE
        $this->Session->write("financialParameterEditing", true);

        $this->layout = "";
        $index = $this->request->data['financialParameterIndex'];
        $companies = $this->Session->read('SessionFinancialParameter');
        $company = $companies[$index];
        $this->set("parameter", $company);
    }
	
	
}
