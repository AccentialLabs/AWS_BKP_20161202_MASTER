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
	class MasterUsersDiscountCouponController extends AppController {

		//put your code here
		//put your code here

		public function __construct($request = null, $response = null) {
			$this->layout = 'default_business_master';
			parent::__construct($request, $response);
		}

		public function index() {
		
		
			$couponsProfile = $this->getAllCouponsProfile();
			$users = $this->getAllUsers();
			$discountCoupons = $this->getAllGetDiscountCoupons();
			
			$this->set('couponsProfile', $couponsProfile);
			$this->set('users', $users);
			$this->set('discountCoupons', $discountCoupons);
			
		}
		
		public function getCouponTypeByName(){
		$this->autoRender = false;
			$name = $this->request->data['name'];
			$sql = "SELECT * FROM coupon_types WHERE tag LIKE '{$name}%';";
			$params = array(
				'User' => array(
					'query' => $sql
				)
			);
		
			$tags = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
			$tagsOptions = '';
			
			if(!empty($tags)){
				foreach( $tags as $tag){
		
					$tagsOptions .= '<li onclick="selectTagType('.$tag['coupon_types']['id'].', \''.$tag['coupon_types']['tag'].'\')" id="'.$tag['coupon_types']['id'].'" name="'.$tag['coupon_types']['id'].'">'.$tag['coupon_types']['tag'].'</li>';
			
				}
			}
			
			return $tagsOptions;
		
		}
		
		
		#ESSA FUNCAO É RESPONSAVEL POR CRIAR UM NOVO PERFIL DE CUPOM
		public function saveCouponProfile(){
		$this->autoRender = false;
		
		$tagID = $this->request->data['tagID'];
		$return = '';
		
		if(empty($tagID)){
		
			$sqlTAG = "INSERT INTO coupon_types(`tag`) VALUES('".$this->request->data['tagName']."');";
			
			$params = array(
				'User' => array(
					'query' => $sqlTAG
				)
			);
		
			

			$this->AccentialApi->urlRequestToGetData('users', 'query', $params);
			
			
			$sqlTAGReturn = "SELECT * FROM coupon_types WHERE tag LIKE '".$this->request->data['tagName']."'";
			$params = array(
				'User' => array(
					'query' => $sqlTAGReturn
				)
			);
		
			

			$return = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
			
			$tagID = $return[0]['coupon_types']['id'];
			
			
		}

		$minimunValue = '';
		$minimumValue = str_replace(",", ".", $this->request->data['minimumValue']);
		$discountValue = str_replace(",", ".", $this->request->data['discountValue']);
		
		
		 $sql = "INSERT INTO `coupon_profiles`
(
`coupon_type_id`,
`title`,
`description`,
`date_register`,
`end_date`,
`discount_amount_type`,
`discount_value`,
`minimum_value_use`)
VALUES(
	".$tagID.",
	'".$this->request->data['title']."',
	'".$this->request->data['description']."',
	'".$this->request->data['dt_begin']."',
	'".$this->request->data['dt_end']."',
	'".$this->request->data['discountType']."',
	'".$discountValue."',
	".$minimumValue."
);";
		
		$params = array(
				'User' => array(
					'query' => $sql
				)
			);
		
			$this->AccentialApi->urlRequestToGetData('users', 'query', $params);
		
	$this->redirect(array('controller' => 'masterUsersDiscountCoupon', 'action' => 'index'));
		}
		
		
		public function getAllCouponsProfile(){
		
			$sql = "SELECT * FROM coupon_profiles inner join coupon_types on coupon_types.id = coupon_profiles.coupon_type_id;";
			$params = array(
				'User' => array(
					'query' => $sql
				)
			);
		
			$coupons = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
		
		return $coupons; 
		
		}
		
		public function getAllUsers(){
		
			$sql = "SELECT * FROM users;";
			$params = array(
				'User' => array(
					'query' => $sql
				)
			);
		
			$users = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
		
		return $users; 
		
		}
		
		public function getAllGetDiscountCoupons(){
		
		$sql = "SELECT * FROM discount_coupons;";
			$params = array(
				'User' => array(
					'query' => $sql
				)
			);
		
			$discountCoupons = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
		
		return $discountCoupons; 
		
		}
		
		
		#ESSA FUNCAO É RESPONSAVEL POR CRIAR UM NOVO CUPOM DE DESCONTO ASSOCIADO À ALGUM USUARIO CONSUMIDOR
		public function saveDiscountCoupon(){
		$this->autoRender  = false;
		$profileID = $this->request->data['couponProfile'];
		$sql = "SELECT * FROM coupon_profiles inner join coupon_types on coupon_types.id = coupon_profiles.coupon_type_id WHERE coupon_profiles.id = {$profileID};";
			$params = array(
				'User' => array(
					'query' => $sql
				)
			);
		
		$couponProfile = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
		
		
		$couponCode = $this->request->data['couponProfileUser'].$profileID.date('Y-m-d');
		$couponCode = base64_encode($couponCode);
		$data = date('Y-m-d');
		
		$dataFim = '';
		
		if(strpos($this->request->data['endDate'], '/') !== false){
		
			$arraydata = explode("/", $this->request->data['endDate']);
			$dataFim = $arraydata[2].'-'.$arraydata[1].'-'.$arraydata[0];
		
		}else{
		$dataFim = $this->request->data['endDate'];
		}
		
		$sqlINSERT = "INSERT INTO `discount_coupons`
(`user_id`,
`coupon_code`,
`date_register`,
`end_date`,
`indication_code`,
`discount_amount_type`,
`discount_value`,
`minimum_value_use`)
VALUES(
".$this->request->data['couponProfileUser'].",
'{$couponCode}',
'{$data}',
'{$dataFim}',
'0',
'{$couponProfile[0]['coupon_profiles']['discount_amount_type']}',
'{$couponProfile[0]['coupon_profiles']['discount_value']}',
{$couponProfile[0]['coupon_profiles']['minimum_value_use']}
);";

$params = array(
				'User' => array(
					'query' => $sqlINSERT
				)
			);
		
		$this->AccentialApi->urlRequestToGetData('users', 'query', $params);
		
		$this->redirect(array('controller' => 'masterUsersDiscountCoupon', 'action' => 'index'));
		
		}
		
		}