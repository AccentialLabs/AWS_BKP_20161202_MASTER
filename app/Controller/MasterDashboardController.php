<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterDashboardController
 *
 * @author user
 */
class MasterDashboardController extends AppController{
    //put your code here
    
     public function __construct($request = null, $response = null) {
        $this->layout = 'default_business_master';
        parent::__construct($request, $response);
    }
    
    
     public function index() {
        $master = $this->Session->read('CompanyLoggedIn');
      
                $qtd = $this->getQtdSaloesAtivos();
		$totalDoDia = $this->getValorVendasDoDia();
		$indicationsCount = $this->getIndications();
                $activeUsersCount = $this->getActiveUsersLastHour();
		$this->set('vendasDoDia', $totalDoDia);
		$this->set('qtdSaloes', $qtd);
                $this->set('master', $master);
                $this->set('indicationscount', $indicationsCount);
                $this->set('activeusers', $activeUsersCount);
    }
	
		
	public function getQtdSaloesAtivos(){
	
	$sql = "select COUNT(*) total from companies where status LIKE 'ACTIVE';";
	$companiesParam = array(
            'User' => array(
                'query' => $sql
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $companiesParam);
	}
	
	public function getValorVendasDoDia(){
	
		$sql = "select sum(total_value) total from checkouts where date > CURDATE() and company_id = 99999;";
		   $vendasDoDiaParam = array(
            'User' => array(
                'query' => $sql
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $vendasDoDiaParam);
		
	}
        public function getIndications(){
	
		$sql = "select count(*) from indications where status = 'INDICADO'";
		   $indicationsCount = array(
                        'User' => array(
                            'query' => $sql
                        )
                    );
                return $this->AccentialApi->urlRequestToGetData('users', 'query', $indicationsCount);
		
	}
        public function getActiveUsersLastHour(){
	
		//$sql = "SELECT count(*) FROM users where last_update > DATE_SUB(NOW(), INTERVAL 24 HOUR);";
        $sql = "SELECT count(*) FROM users where last_update > CURDATE();";
		   $activeUsers = array(
                        'User' => array(
                            'query' => $sql
                        )
                    );
                return $this->AccentialApi->urlRequestToGetData('users', 'query', $activeUsers);
		
	}
}
