	<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of MasterFinancesController
	 *
	 * @author user
	 */
	class MasterFinancesController extends AppController {

		//put your code here
		//put your code here

		public function __construct($request = null, $response = null) {
			$this->layout = 'default_business_master';
			parent::__construct($request, $response);
		}

		public function index() {
			
		}
		
		public function ratingPriceList(){
		
			$ratings = $this->getAllRatingPriceList();
			$providers = $this->getAllProviders();
		
			$this->set("providers", $providers);
			$this->set("ratings", $ratings);
		}

		
		public function getAllRatingPriceList(){
			
			$query = "SELECT * FROM rating_price_lists LEFT JOIN providers on providers.id = rating_price_lists.provider_id;";
			
			  $param = array(
						'User' => array(
							'query' => $query
						)
					);
		   return $this->AccentialApi->urlRequestToGetData('users', 'query', $param);
		
		}
		
		public function insertRatingPriceList(){
		
			$date = date('Y-m-d');
			$AA = $this->request->data['AA'];
			$A = $this->request->data['A'];
			$AB = $this->request->data['AB'];
			$B = $this->request->data['B'];
			$BC = $this->request->data['BC'];
			$C = $this->request->data['C'];
			$provider = $this->request->data['provider'];
			
			$query = "INSERT INTO `jezzyapp_main`.`rating_price_lists`
				(`AA`,
				`A`,
				`AB`,
				`B`,
				`BC`,
				`C`,
				`status`,
				`date_register`,
				`provider_id`)
				VALUES(
				{$AA},
				{$A},
				{$AB},
				{$B},
				{$BC},
				{$C},
				'ACTIVE',
				'{$date}',
				{$provider}
				);";
	
			$param = array(
						'User' => array(
							'query' => $query
						)
					);
			$this->AccentialApi->urlRequestToGetData('users', 'query', $param);
	
	$this->redirect(
    array(
          "controller" => "masterFinances", 
          "action" => "ratingPriceList"));
	
		}
		
		public function updateRatingPriceList(){
			$this->autoRender =  false;
			
			$id = $this->request->data['id'];
			$sql = "UPDATE rating_price_lists SET `status` = 'INACTIVE';";
			$param = array(
						'User' => array(
							'query' => $sql
						)
					);
			$this->AccentialApi->urlRequestToGetData('users', 'query', $param);
			
			//**************************************************
			
			$sql = "UPDATE rating_price_lists SET `status` = 'ACTIVE' WHERE id = {$id};";
			$param = array(
						'User' => array(
							'query' => $sql
						)
					);
			$this->AccentialApi->urlRequestToGetData('users', 'query', $param);
		
		}
		
		
		public function deleteRatingPriceList(){
		
		$this->autoRender = false;
		$id = $this->request->data['id'];
		
		$sql = "DELETE FROM rating_price_lists WHERE id = {$id}";
		$param = array(
						'User' => array(
							'query' => $sql
						)
					);
			$this->AccentialApi->urlRequestToGetData('users', 'query', $param);
		
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
		
	}
