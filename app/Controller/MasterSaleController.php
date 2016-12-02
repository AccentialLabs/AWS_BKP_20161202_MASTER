<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MasterSaleController extends AppController {

    //put your code here

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business_master';
        parent::__construct($request, $response);
    }
public function beforeFilter() {
        if ($this->action !== "logout") {
            if ($this->Cookie->check("sessionLogado") === true && $this->Cookie->check("CompanyLoggedIn") === true && is_array($this->Cookie->read("CompanyLoggedIn"))) {
                $this->Session->write('sessionLogado', true);
                $this->Session->write('CompanyLoggedIn', $this->Cookie->read("CompanyLoggedIn"));
            }
            if ($this->Cookie->check('userLoggedType') === true) {
                $this->Session->write('userLoggedType', $this->Cookie->read('userLoggedType'));
            }
            if ($this->Cookie->check('userLoggedType') === true) {
                $this->Session->write('secondUserLogado', $this->Cookie->read('secondUserLogado'));
            }
            if ($this->Cookie->check('SecondaryUserLoggedIn') === true) {
                $this->Session->write('SecondaryUserLoggedIn', $this->Cookie->read('SecondaryUserLoggedIn'));
            }
            if ($this->Session->check("sessionLogado") === true && $this->Session->check("CompanyLoggedIn") === true && is_array($this->Session->read("CompanyLoggedIn"))) {
                $this->redirect(array('controller' => 'MasterDashboard', 'action' => 'index'));
            }
        }
    }
    public function index() {

        $minhasVendas = $this->getAllMyCheckouts();
        $todasVendas = $this->getAllCheckouts();

        $this->set("minhasVendas", $minhasVendas);
        $this->set("todasVendas", $todasVendas);
    }
	

    public function getAllMyCheckouts() {
        $params = array(
            'Checkout' => array(
                'conditions' => array(
                    'Checkout.company_id' => 99999
                ),
                'order' => array(
                    'Checkout.id' => 'DESC'
                ),
            ),
            'PaymentState',
			'Offer',
            'User',
            'OffersUser'
        );
        $todasCompras = $this->AccentialApi->urlRequestToGetData('payments', 'all', $params);

        return $todasCompras;
    }

    public function getAllCheckouts() {


        $params = array(
            'Checkout' => array(
                'conditions' => array(
                ),
                'order' => array(
                    'Checkout.id' => 'DESC'
                ),
            ),
            'Company',
            'Offer',
            'User',
            'OffersUser',
           'OffersComment',
        );
        $todasCompras = $this->AccentialApi->urlRequestToGetData('payments', 'all', $params);

        $allChecks = '';
        $i = 0;
       foreach ($todasCompras as $compra) {
				$sql = "select * from companies where id = {$compra['Checkout']['company_id']};";
			  $statisticsParams = array(
                    'User' => array(
                        'query' => $sql
                    )
                );
                 $comp = $this->AccentialApi->urlRequestToGetData('users', 'query', $statisticsParams);
				   //$compra['Company'] = $comp[0]['companies'];
			$allChecks[$i] = $compra;
            $allChecks[$i]['Company'] = $comp[0]['companies'];
            $i++;
        } 
        return $allChecks;
    }
	
	public function getAllSalesByMonth(){
		$this->layout = "";
	
		$month = $this->request->data['month'];
		  $params = array(
            'Checkout' => array(
                'conditions' => array(
                    'Checkout.company_id' => 99999,
					'MONTH(Checkout.date)' => $month
                ),
                'order' => array(
                    'Checkout.id' => 'DESC'
                ),
            ),
            'PaymentState',
			'Offer',
            'User',
            'OffersUser'
        );
        $todasCompras = $this->AccentialApi->urlRequestToGetData('payments', 'all', $params);

		$valorTotal = 0;
		if(!empty($todasCompras)){
		foreach($todasCompras as $compra){
			$valorTotal = $valorTotal+$compra['Checkout']['total_value'];
		}}
		
		$this->set('valorTotalMensal', $valorTotal);
        $this->set('minhasVendas', $todasCompras);
	
	}

    public function getCompanyById($id) {

        $params = array(
            'Company' => array(
                'conditions' => array(
                    'Company.id' => $id
                )
            )
        );

        $company = $this->AccentialApi->urlRequestToGetData('companies', 'first', $params);

        return $company;
    }
	
	public function tes(){
		$this->layout = "";
  $params = array(
            'Checkout' => array(
                'conditions' => array(
                ),
                'order' => array(
                    'Checkout.id' => 'DESC'
                ),
            ),
            'Company',
            'Offer',
            'User',
            'OffersUser',
           'OffersComment',
        );
        $todasCompras = $this->AccentialApi->urlRequestToGetData('payments', 'all', $params);
		
		$allChecks = '';
		$i = 0;
		foreach ($todasCompras as $compra) {

			$sql = "select * from companies where id = {$compra['Checkout']['company_id']};";
			  $statisticsParams = array(
                    'User' => array(
                        'query' => $sql
                    )
                );
                 $comp = $this->AccentialApi->urlRequestToGetData('users', 'query', $statisticsParams);
				   //$compra['Company'] = $comp[0]['companies'];
			$allChecks[$i] = $compra;
            $allChecks[$i]['Company'] = $comp[0]['companies'];
            $i++;
        }
				
		print_r($allChecks);
	}


// API Finanças Jezzy
//  -tem como objetivo calcular qual o percentual e o valor fixo que o distribuidor receberá de cada pedido de produto pertencente a marca que o mesmo forneceu, para isso será utilizada uma tabela de configurações financeiras para cada distribuidor, os valores serão calculados de acordo com os dados provenientes da tabela de configurações financeiras.
//  -cada marca possui um distribuidor atrelado a ela, os produtos possuem a marca gravada junto a ela e o distribuidor desse produto é encontrado através da marca.
//  -EXTREMAMENTE IMPORTANTE QUE O DISTRIBUIDOR DE CADA MARCA SEJA REGISTRADO JUNTO A PRÓPRIA NO BANCO DE DADOS PARA QUE O CALCULO SEJA EFETIVADO.
//  -a tabela de distribuidores possui apenas um identificador para que todo o processo seja mapeado. Esse identificador é referenciado na tabela de configurações financeiras do mesmo, e também na tabela que contém as marcas de produtos.

	public function calculateFinancialsResult(){
		$this->autoRender = false;
		$offerId = $this->request->data['offerId'];
		//$shippingValue = $this->request->data['shippingValue'];
		$shippingValue = $_POST['shippingValue'];
		$companyId = $this->request->data['companyId'];
		$qtdproducts = $this->request->data['qtdprodutos'];
		$comissioned_secondary_user = $this->request->data['comissioned_secondary_user'];
		$offer = '';
		$company = '';
		$financialsParameters = '';
		
		/**
		* Pesquisando dados da oferta
		**/
		
		$sqlOffer = "select * from offers where id = {$offerId};";
			  $offerParams = array(
                    'User' => array(
                        'query' => $sqlOffer
                    )
                );
        $offer = $this->AccentialApi->urlRequestToGetData('users', 'query', $offerParams);
		
		/**
		* Pesquisando dados do distribuidor que está fornecendo o produto
		**/
		$providerfancyname = str_replace("'", "\'", $offer[0]['offers']['brand']);
		
		$sqlProvAndDist = "select * from providers inner join distributors 
		on providers.dist_id = distributors.id 
		WHERE providers.fancy_name LIKE '{$providerfancyname}';";
		
			  $ProvAndDistParams = array(
                    'User' => array(
                        'query' => $sqlProvAndDist
                    )
                );
        $providerAndDistributor = $this->AccentialApi->urlRequestToGetData('users', 'query', $ProvAndDistParams);
		
		//pesquisa parametros de comissão do profissional que indicou if exists
		if($comissioned_secondary_user!=0){
			$sqlComSec = "select rate_per_jezzy_product from secondary_users_commissioning_fees where secondary_user_id = {$comissioned_secondary_user};";
			  $ComSecParams = array(
                    'User' => array(
                        'query' => $sqlComSec
                    )
                );
			$comissioned_secondary_user_percentage = $this->AccentialApi->urlRequestToGetData('users', 'query', $ComSecParams);
			
		}
	
		
		$comissioned_secondary_user_id = $comissioned_secondary_user;
		
		if(isset($comissioned_secondary_user_percentage)){
			$comissioned_secondary_user_percentage = ($comissioned_secondary_user_percentage[0]['secondary_users_commissioning_fees']['rate_per_jezzy_product']);
		}else{
			$comissioned_secondary_user_percentage = 0.00;
		}
		
		
		
		/**
		* Pesquisando dos paramentros financeiros
		**/
		$financialParameterSQL = "select * from financial_parameters where distributor_id = {$providerAndDistributor[0]['distributors']['id']};";
			  $financialParameterParams = array(
                    'User' => array(
                        'query' => $financialParameterSQL
                    )
                );
        $financialParameter = $this->AccentialApi->urlRequestToGetData('users', 'query', $financialParameterParams);
	
		
		/**
		EX.: $financialParameter[0]['financial_parameters']['tot_open']
		*/
		$offerprice =  $offer[0]['offers']['value'];
		$percentage =  $offer[0]['offers']['percentage_discount']/1;
		$desconto = ($offerprice / 100) * (100 - $percentage);
		$desconto =  number_format($desconto, 2);
		$Valorcomdesconto = str_replace(".", "",$desconto);


$valor_venda = $Valorcomdesconto;			//(A);

$valor_frete = $shippingValue;			//(B);
$receita_bruta = '';   		// SOMA VALOR DE VENDA COM VALOR DE FRETE (C = A+B);
$taxadeImposto = $financialParameter[0]['financial_parameters']['tx_imp'];	   		// PORCENTAGEM PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (TX_IMPOSTO);
$valordeImposto = '';  		// PORCENTAGEM DA RECEITA BRUTA DESTINADA A IMPOSTOS DO DISTRIBUIDOR (D = C * TX_IMPOSTO);
$receita_liquida = ''; 		// VALOR TOTAL DA VENDA MENOS O VALOR PAGO VIA IMPOSTOS (E = C-D);
$tarifa_meio_pgto = $financialParameter[0]['financial_parameters']['tx_mpgto'];	// TARIFA PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (F);
$tarifa_transaction = $financialParameter[0]['financial_parameters']['tar_trans'];		// TARIFA PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (G);
$embalagem = $this->$financialParameter[0]['financial_parameters']['vl_emb'];		// TARIFA PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (H);

if($providerAndDistributor[0]['providers']['commission'] == 0){
	$tx_salao = $financialParameter[0]['financial_parameters']['tx_salao'];				// PROCENTAGEM COMISSÃO PARA O SALÃO PROVENIENTE DA TABELA DA COMPANIA NO CASO DE SALÃO FAVORITO DO COMPRADOR (TX_SALAO);
}else{
	$tx_salao = $providerAndDistributor[0]['providers']['commission']; //SE A MARCA TIVER UMA PORCENTAGEM DEFINIDA DIFERENTE DE ZERO, ENTÃO A TAXA DO SALÃO SERÁ O VALOR ATRIBUIDO A ESSA MARCA
}

$valor_salao = ''; 			// VALOR COMISSÃO PARA O SALÃO PROVENIENTE DA TABELA DA COMPANIA NO CASO DE SALÃO FAVORITO DO COMPRADOR (I = A*TX_SALAO);
$tx_parceiro = $financialParameter[0]['financial_parameters']['tx_parc']; 			// PORCENTAGEM PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (TX_PARCEIRO);
$valor_parceiro = ''; 		// VALOR PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (J = C*TX_PARCEIRO);

if(!empty($offer[0]['offers']['cost'])){
	$valor_custeio =  ($offer[0]['offers']['cost']);
}else{
	$valor_custeio = 0;
}

$valor_custo =  number_format(($valor_custeio*$qtdproducts)/1,2,'.',',');	// CUSTO DO PRODUTO PROVENIENTE DA TABELA DE OFERTAS (K);

$custosdevenda = '';		// VALOR TOTAL DE CUSTOS PARA O JEZZY (L = F+G+H+B+I+J+K);
$lucro_bruto = '';			// VALOR DE LUCRO DIANTE DOS CUSTOS GERAIS E VALORES DE VENDA AO CONSUMIDOR (M = E-L);
$tx_distribution = $financialParameter[0]['financial_parameters']['tx_infra_dist'];  		// PORCENTAGEM DE DISTRIBUIÇÃO DO PRODUTO PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (TX_DIST);
$infra_distribution = ''; 	// VALOR DE INFRAESTRUTURA REFERENTE A DISTRIBUIÇÃO DO PRODUTO (N= A*TX_DIST);
$infra_jezzy =  $financialParameter[0]['financial_parameters']['tx_infra_jzy'];  			// PORCENTAGEM PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (TX_JEZZY);
$valor_infra_jezzy = '';	// VALOR DE INFRAESTRUTURA DO JEZZY DIANTE DOS CUSTOS DO PRODUTO (O = A*TX_JEZZY);
$tx_marketing =  $financialParameter[0]['financial_parameters']['tx_fdo_mkt']; 	// PORCENTAGEM PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (TX_MARKETING);
$valor_tx_marketing = '';	// FUNDO DE MARKETING PROVENIENTE DA TABELA DE PARAMETROS FINANCEIROS DO DISTRIBUIDOR (P = A*TX_MARKETING);
$tot_oper = '';				// CUSTOS OPERACIONAIS (Q = N+O+P);
$lucro_liquido = '';		// LUCRO LIQUIDO (R = M-Q);
$partes = $this->request->data['partes'];  			// NUMERO PROVENIENTE DA FUNCTION PAGAMENTO TESTE OU PAGAMENTO TESTE BOLETO (PARTES);
$lucro_partes = '';			// LUCRO PARA CADA PARTE ENVOLVIDA (S = R/PARTES);

$total_distribuidor = '';	// TOTAL QUE O DISTRIBUIDOR TERÁ A RECEBER (D+K+N+S); *pode ser porcentagem ou valor fixo*
$total_jezzy = ''; 			// TOTAL QUE O JEZZY TERÁ A RECEBER (F+G+H+B+J+O+P+S+S); *pode ser porcentagem ou valor fixo*
$total_salao = '';			// TOTAL QUE O SALÃO TERÁ A RECEBER (I); *pode ser porcentagem ou valor fixo*



$embalagem = number_format($embalagem/100,2,'.',',');
$embalagem = str_replace(',', '', $embalagem);

$valor_venda =  number_format($valor_venda*$qtdproducts/100,2,'.',',');
$valor_venda = str_replace(',', '', $valor_venda);

$valor_frete = number_format($valor_frete/100,2,'.',',');
$valor_frete = str_replace(',', '', $valor_frete);
$receita_bruta = $valor_venda + $valor_frete;
$receita_bruta = number_format($receita_bruta,2,'.',',');
$receita_bruta = str_replace(',', '', $receita_bruta);
$valordeImposto = $receita_bruta * ($taxadeImposto/100);
$valordeImposto = number_format($valordeImposto,2,'.',',');
$valordeImposto = str_replace(',', '', $valordeImposto);
$receita_liquida = $receita_bruta - $valordeImposto;
$receita_liquida = number_format($receita_liquida,2,'.',',');
$receita_liquida = str_replace(',', '', $receita_liquida);
$valor_salao = $valor_venda * ($tx_salao/100);
if(isset($comissioned_secondary_user_percentage)){
	$comissioned_secondary_user_value = $valor_salao*($comissioned_secondary_user_percentage/100);
}else{
	$comissioned_secondary_user_value = 0.00;
}
$valor_salao = number_format($valor_salao,2,'.',',');
$valor_salao = str_replace(',', '', $valor_salao);
$valor_parceiro = $receita_bruta * ($tx_parceiro/100);
$valor_parceiro = number_format($valor_parceiro,2,'.',',');
$valor_parceiro = str_replace(',', '', $valor_parceiro);

$custosdevenda = ($receita_bruta*($tarifa_meio_pgto/100))+$tarifa_transaction+$embalagem+$valor_frete+$valor_salao+$valor_parceiro+$valor_custo;
$custosdevenda = number_format($custosdevenda,2,'.',',');
$custosdevenda = str_replace(',', '', $custosdevenda);
$lucro_bruto = $receita_liquida - $custosdevenda;
$lucro_bruto = number_format($lucro_bruto,2,'.',',');
$lucro_bruto = str_replace(',', '', $lucro_bruto);
$infra_distribution = $valor_venda * ($tx_distribution/100);

$valor_infra_jezzy = $valor_venda * ($infra_jezzy/100);
$valor_infra_jezzy = number_format($valor_infra_jezzy,2,'.',',');
$valor_infra_jezzy = str_replace(',', '', $valor_infra_jezzy);
$valor_tx_marketing = $valor_venda * ($tx_marketing/100);
$valor_tx_marketing = number_format($valor_tx_marketing,2,'.',',');
$valor_tx_marketing = str_replace(',', '', $valor_tx_marketing);

$tot_oper = $infra_distribution + $valor_infra_jezzy + $valor_tx_marketing;
$tot_oper = number_format($tot_oper, 2, '.', ',');
$tot_oper = str_replace(',', '', $tot_oper);
$lucro_liquido = $lucro_bruto - $tot_oper;
$lucro_liquido = number_format($lucro_liquido, 2, '.', ',');
$lucro_liquido = str_replace(',', '', $lucro_liquido);
$lucro_partes = $lucro_liquido/$partes;
$lucro_partes = number_format($lucro_partes, 2, '.', ',');
$lucro_partes = str_replace(',', '', $lucro_partes);
$total_distribuidor = $valordeImposto + $valor_custo + $infra_distribution + $lucro_partes; // 1 PARTE

$total_jezzy = ($receita_bruta*($tarifa_meio_pgto/100)) + $tarifa_transaction + $embalagem + $valor_frete + $valor_parceiro + $valor_infra_jezzy+$valor_tx_marketing + $lucro_partes + $lucro_partes; // 2 PARTE

$total_jezzy = number_format($total_jezzy, 2, '.', ',');
$total_jezzy = str_replace(',', '', $total_jezzy);
$total_salao = $valor_salao; //3 PARTE


$distribuidor_id = $providerAndDistributor[0]['distributors']['id']; // ID DO DISTRIBUIDOR













///GRAVAR NA TABELA financial_parameters_results;








$financialParameterSQL = "insert into financial_parameters_results (distributor_id, company_id, checkout_id, vl_venda, vl_frente, rec_bruta, vl_imp, rec_liquida, vl_salao, vl_parc, vl_custo, tot_cpv, lucro_brt, infra_dist, infra_jzy, fundo_mkt, tot_oper, lucro_liq, lucro_partes, tot_distrib, tot_jezzy, date_register, tx_imp, tx_mpgto, tar_trans, vl_emb, tx_salao, tx_parc, tx_infra_dist, tx_infra_jzy, tx_fdo_mkt, qdt_partes, secondary_user_id, secondary_user_commission, secondary_user_percentage) VALUES (".$distribuidor_id.", ".$companyId.", 0, '".$valor_venda."', '".$valor_frete."', '".$receita_bruta."', '".$valordeImposto."', '".$receita_liquida."', '".$valor_salao."', '".$valor_parceiro."', '".$valor_custo."', '".$custosdevenda."', '".$lucro_bruto."', '".$infra_distribution."', '".$valor_infra_jezzy."', '".$valor_tx_marketing."', '".$tot_oper."', '".$lucro_liquido."','".$lucro_partes."', '".$total_distribuidor."', '".$total_jezzy."', '".date('Y-m-d H:i:s')."', '".$taxadeImposto."', '".$tarifa_meio_pgto."', '".$tarifa_transaction."', '".$embalagem."', '".$tx_salao."', '".$tx_parceiro."', '".$tx_distribution."', '".$infra_jezzy."', '".$tx_marketing."', ".$partes.", ".$comissioned_secondary_user_id.", '".$comissioned_secondary_user_value."', '".$comissioned_secondary_user_percentage."');";


			  $financialParameterParams = array(
                    'User' => array(
                        'query' => $financialParameterSQL
                    )
                );
        $financialresultParameter = $this->AccentialApi->urlRequestToGetData('users', 'query', $financialParameterParams);
		
		
		
$financialSelectParameterSQL = "select * from financial_parameters_results WHERE distributor_id = ".$distribuidor_id." and company_id  = ".$companyId." and date_register =  '".date('Y-m-d H:i:s')."';";

		 $financialSelectParameterParams = array(
                    'User' => array(
                        'query' => $financialSelectParameterSQL
                    )
                );
        $financialresultSelectParameter = $this->AccentialApi->urlRequestToGetData('users', 'query', $financialSelectParameterParams);
	
		
		$arrayretorno = array($financialresultSelectParameter[0]['financial_parameters_results']['id'], $financialresultSelectParameter[0]['financial_parameters_results']['tot_distrib'], $providerAndDistributor[0]['distributors']['moip_id']);
		//$arrayretorno[0]=>$financialresultSelectParameter[0]['financial_parameters_results']['id'];
		//$arrayretorno[1]=>$providerAndDistributor[0]['distributors']['moip_id'];
		
		echo json_encode($arrayretorno);
	
		
	}


}
