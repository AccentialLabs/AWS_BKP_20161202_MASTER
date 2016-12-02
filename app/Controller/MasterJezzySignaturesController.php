					<?php

					/*
					 * To change this license header, choose License Headers in Project Properties.
					 * To change this template file, choose Tools | Templates
					 * and open the template in the editor.
					 */

					/**
					 * Description of MasterProductController
					 *
					 * @author user
					 */
					App::import('Vendor', 'PHPExcel');

					class MasterJezzySignaturesController extends AppController {

						//put your code here

						public function __construct($request = null, $response = null) {
							$this->layout = 'default_business_master';
							parent::__construct($request, $response);
						}

					   public function index(){
						
					   }
					   
					   public function plans(){
					   $this->layout = 'default_business_master';
						$planos = $this->getJezzyPlanes();
						
						
						 $this->set('planos', $planos); 
						
					   }
					   
					   public function signatures(){
						 $this->layout = 'default_business_master';
							$subscriptions = $this->getJezzySignatures();
							$coupons = $this->getCoupons();
							
							$this->set('coupons', $coupons);
							$this->set('subscriptions', $subscriptions); 
					   }
					   
					   public function coupons(){
							$this->layout = 'default_business_master';
							
							$coupons = $this->getCoupons();
							$this->set('coupons', $coupons);
					   }
					   
					   public function getJezzyPlanes(){
					   $header = array();
															$header[] = 'Content-type: application/json';
															//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
															//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
															//$url = "https://sandbox.moip.com.br/assinaturas/v1/plans/";
															
															$header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
														$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
															$url = "https://api.moip.com.br/assinaturas/v1/plans/";

															$curl = curl_init();
															curl_setopt($curl, CURLOPT_URL, $url);

															// header que diz que queremos autenticar utilizando o HTTP Basic Auth
															curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

															// informa nossas credenciais
															curl_setopt($curl, CURLOPT_USERPWD, $auth);
															curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
															curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");

															curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

															// efetua a requisicao e coloca a resposta do servidor do MoIP em $ret
															$ret = curl_exec($curl);
															$err = curl_error($curl);
															$err = curl_error($curl);
															curl_close($curl);
															
															$plans = json_decode($ret);
															$planos = (array)$plans;
														
															$i = 0;
															$total = count($planos['plans']);
															$p = '';
															while($i < $total){
															
																$p[$i] = (array)$planos['plans'][$i];
																$p[$i]['creation_date'] = (array) $p[$i]['creation_date'];
																$p[$i]['interval'] = (array) $p[$i]['interval'];
																$p[$i]['trial'] = (array) $p[$i]['trial'];
															
															$i++;
															}
															
															return $p;
						
					   }
					   
					   public function getJezzySignatures(){

									  $header = array();
															$header[] = 'Content-type: application/json';
															//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
															//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
															
															//$url = "https://sandbox.moip.com.br/assinaturas/v1/subscriptions";

																$header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
														$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
															$url = "https://api.moip.com.br/assinaturas/v1/subscriptions";
															
															$curl = curl_init();
															curl_setopt($curl, CURLOPT_URL, $url);

															// header que diz que queremos autenticar utilizando o HTTP Basic Auth
															curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

															// informa nossas credenciais
															curl_setopt($curl, CURLOPT_USERPWD, $auth);
															curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
															curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");

															curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

															// efetua a requisicao e coloca a resposta do servidor do MoIP em $ret
															$ret = curl_exec($curl);
															$err = curl_error($curl);
															$err = curl_error($curl);
															curl_close($curl);
															
															$subscriptions = json_decode($ret);
															$subscriptions = (array) $subscriptions;
															
															$i = 0;
															$total = count($subscriptions['subscriptions']);
															$subs = '';
															
															while($i < $total){
															
																$subs[$i] = (array) $subscriptions['subscriptions'][$i];
																$subs[$i]['creation_date'] = (array) $subs[$i]['creation_date'];
																$subs[$i]['plan'] = (array) $subs[$i]['plan'];
																$subs[$i]['expiration_date'] = (array) $subs[$i]['expiration_date'];
																if($subs[$i]['status'] != 'SUSPENDED'){
																	$subs[$i]['next_invoice_date'] = (array) $subs[$i]['next_invoice_date'];
																}
																$subs[$i]['customer'] = (array) $subs[$i]['customer'];
															
																$i++;
															}
															
															return $subs;
						
					   }
					   
					   public function activeOrInactivePlan(){
					   $this->autoRender = false;
								$planCode = $this->request->data['planCode'];
								$function = $this->request->data['activeOrInactive'];
					   
									$header = array();
												$header[] = 'Content-type: application/json';
												//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
												//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
												// URL do SandBox - Nosso ambiente de testes
												// $url = "https://sandbox.moip.com.br/assinaturas/v1/plans/{$planCode}/{$function}";
												 
												 $header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
														$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
															$url = "https://api.moip.com.br/assinaturas/v1/plans/{$planCode}/{$function}";
												 
											   
												$curl = curl_init();
													curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
												curl_setopt($curl, CURLOPT_URL, $url);
											

												// header que diz que queremos autenticar utilizando o HTTP Basic Auth
												curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

												// informa nossas credenciais
												curl_setopt($curl, CURLOPT_USERPWD, $auth);
												curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
												curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
		//                                        curl_setopt($curl, CURLOPT_POST, true);

												// Informa nosso XML de instru��o
											   // curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

												curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

												// efetua a requisi��o e coloca a resposta do servidor do MoIP em $ret
												$ret = curl_exec($curl);
												$err = curl_error($curl);
												$err = curl_error($curl);
												curl_close($curl);
												
												var_dump($ret);
					   
					   }
					
						public function suspendOrCancelSubscribe(){
						
							 $this->autoRender = false;
								$subscriptionCode = $this->request->data['subscriptionCode'];
								$suspendOrCancel = $this->request->data['suspendOrCancel'];
					   
									$header = array();
												$header[] = 'Content-type: application/json';
												//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
												//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
												// URL do SandBox - Nosso ambiente de testes
												//$url = "https://sandbox.moip.com.br/assinaturas/v1/subscriptions/{$subscriptionCode}/{$suspendOrCancel}";
												
												 $header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
												$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
												$url = "https://api.moip.com.br/assinaturas/v1/subscriptions/{$subscriptionCode}/{$suspendOrCancel}";
												
												 
											   
												$curl = curl_init();
													curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
												curl_setopt($curl, CURLOPT_URL, $url);
											

												// header que diz que queremos autenticar utilizando o HTTP Basic Auth
												curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

												// informa nossas credenciais
												curl_setopt($curl, CURLOPT_USERPWD, $auth);
												curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
												curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
		//                                        curl_setopt($curl, CURLOPT_POST, true);

												// Informa nosso XML de instru��o
											   // curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

												curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

												// efetua a requisi��o e coloca a resposta do servidor do MoIP em $ret
												$ret = curl_exec($curl);
												$err = curl_error($curl);
												$err = curl_error($curl);
												curl_close($curl);
												
												var_dump($ret);
						
						}
				
						public function chanceNextInvoiceDate(){
							$this->autoRender = false;
							$amount = $this->request->data['amount'];
							$date = $this->request->data['date'];
							$code = $this->request->data['code'];
							
							$amount = str_replace(',','.', $amount);
							$amount = ($amount*100);
							
							$newDate = explode("/", $date);
							
							$json = '
								{
										"amount": "'.$amount.'",
										"next_invoice_date": {
											"day": "'.$newDate[0].'",
											"month": "'.$newDate[1].'",
											"year": "'.$newDate[2].'"
										}
								}
							';
							
							$header = array();
												$header[] = 'Content-type: application/json';
												//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
												//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
												// URL do SandBox - Nosso ambiente de testes
												// $url = "https://sandbox.moip.com.br/assinaturas/v1/subscriptions/".$code;
												 
												  $header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
												$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
												$url = "https://api.moip.com.br/assinaturas/v1/subscriptions/".$code;
											   
												$curl = curl_init();
													curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
												curl_setopt($curl, CURLOPT_URL, $url);
											

												// header que diz que queremos autenticar utilizando o HTTP Basic Auth
												curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

												// informa nossas credenciais
												curl_setopt($curl, CURLOPT_USERPWD, $auth);
												curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
												curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
												//curl_setopt($curl, CURLOPT_POST, true);

												// Informa nosso XML de instru��o
											   curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

												curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

												// efetua a requisi��o e coloca a resposta do servidor do MoIP em $ret
												$ret = curl_exec($curl);
												$err = curl_error($curl);
												$err = curl_error($curl);
												curl_close($curl);
												
												var_dump($ret);
							
						}
						
						public function changePlanAmount(){
						$this->autoRender = false;
						
						$code = $this->request->data['code'];
						$amount = $this->request->data['amount'];
						$planName = $this->request->data['planName'];
						
						$amount = ($amount*100);
						
						$json = '
								{
										"name": "'.$planName.'",
										"amount": '.$amount.',
										"max_qty": 9999
								}
							'; 
							
							$header = array();
												$header[] = 'Content-type: application/json';
												//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
												//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
												// URL do SandBox - Nosso ambiente de testes
												 //$url = "https://sandbox.moip.com.br/assinaturas/v1/plans/".$code;
												 
												   $header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
												$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
												$url = "https://api.moip.com.br/assinaturas/v1/plans/".$code;
											   
												$curl = curl_init();
													curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
												curl_setopt($curl, CURLOPT_URL, $url);
											

												// header que diz que queremos autenticar utilizando o HTTP Basic Auth
												curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

												// informa nossas credenciais
												curl_setopt($curl, CURLOPT_USERPWD, $auth);
												curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
												curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
												//curl_setopt($curl, CURLOPT_POST, true);

												// Informa nosso XML de instru��o
											   curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

												curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

												// efetua a requisi��o e coloca a resposta do servidor do MoIP em $ret
												$ret = curl_exec($curl);
												$err = curl_error($curl);
												$err = curl_error($curl);
												curl_close($curl);
												
												var_dump($ret);
							
						
						}
					
						public function getJezzyInvoicesBySubscribe($code = null){
							   $this->layout = 'default_business_master';
							   $header = array();
															$header[] = 'Content-type: application/json';
															//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
															//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
															//$url = "https://sandbox.moip.com.br/assinaturas/v1/subscriptions/".$code."/invoices";
															
															$header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
															$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
															$url = "https://api.moip.com.br/assinaturas/v1/subscriptions/".$code."/invoices";

															$curl = curl_init();
															curl_setopt($curl, CURLOPT_URL, $url);

															// header que diz que queremos autenticar utilizando o HTTP Basic Auth
															curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

															// informa nossas credenciais
															curl_setopt($curl, CURLOPT_USERPWD, $auth);
															curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
															curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");

															curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

															// efetua a requisicao e coloca a resposta do servidor do MoIP em $ret
															$ret = curl_exec($curl);
															$err = curl_error($curl);
															$err = curl_error($curl);
															curl_close($curl);
															
															$invoices = json_decode($ret);
															$invoices = (array)$invoices;
														
															$i = 0;
															$total = count($invoices['invoices']);
															$p = '';
															while($i < $total){
															
																$p[$i] = (array)$invoices['invoices'][$i];
																$p[$i]['creation_date'] = (array) $p[$i]['creation_date'];
																$p[$i]['status'] = (array) $p[$i]['status'];
															
															$i++;
															}
														
															$this->set('code', $code);
															$this->set('invoices', $p);
						
						}
						
						public function addCoupon(){
							$this->autoRender = false;
						
							$name = $this->request->data['name'];
							$description = $this->request->data['description'];
							$codigo = str_replace(" ", "", $name);
							
							$discountType = $this->request->data['discount-type'];
							$discountValue = $this->request->data['discount-value'];
							
							$durationType = $this->request->data['duration-type'];
							$durationOccurrences = $this->request->data['duration-occurrences'];
							
							$max_redemptions = $this->request->data['max_redemptions'];
							$expirationDate =  $this->request->data['expiration_date'];
							$newExpationDate = '';
							$day = '';
							$month = '';
							$year = '';
							
							if(strpos($expirationDate, '-') !== false){
									$newExpationDate = explode("-", $expirationDate);
									$day = $newExpationDate[2];
									$month = $newExpationDate[1];
									$year = $newExpationDate[0];
									
							}else if(strpos($expirationDate, '/') !== false){
									$newExpationDate = explode("/", $expirationDate);
									$day = $newExpationDate[0];
									$month = $newExpationDate[1];
									$year = $newExpationDate[2];
							}
							
							$json = 
							'
							{
		"code": "'.$codigo.'",
		"name": "'.$name.'",
		"description": "'.$description.'",
		"discount": {
			"value": '.$discountValue.',
			"type": "'.$discountType.'"
		},
		"status": "active",
		"duration": {
			"type": "'.$durationType.'",
			"occurrences": '.$durationOccurrences.'
		},
		"max_redemptions": '.$max_redemptions.',
		"expiration_date": {
			"year": '.$year.',
			"month": '.$month.',
			"day": '.$day.'
		}
	}
							';
							
							$header = array();
													$header[] = 'Content-type: application/json';
													//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
													//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
													
													// URL do SandBox - Nosso ambiente de testes
													//$url = "https://sandbox.moip.com.br/assinaturas/v1/coupons";
													
													$header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
															$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
															$url = "https://api.moip.com.br/assinaturas/v1/coupons";

													$curl = curl_init();
													curl_setopt($curl, CURLOPT_URL, $url);

													// header que diz que queremos autenticar utilizando o HTTP Basic Auth
													curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

													// informa nossas credenciais
													curl_setopt($curl, CURLOPT_USERPWD, $auth);
													curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
													curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
													curl_setopt($curl, CURLOPT_POST, true);

													// Informa nosso XML de instru��o
													curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

													curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

													// efetua a requisi��o e coloca a resposta do servidor do MoIP em $ret
													$ret = curl_exec($curl);
													$err = curl_error($curl);
													$err = curl_error($curl);
													curl_close($curl);
													
													var_dump($ret);
						}
					
						public function getCoupons(){
						
							  $header = array();
															$header[] = 'Content-type: application/json';
															//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
															//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
															//$url = "https://sandbox.moip.com.br/assinaturas/v1/coupons";
															
															$header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
															$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
															$url = "https://api.moip.com.br/assinaturas/v1/coupons";

															$curl = curl_init();
															curl_setopt($curl, CURLOPT_URL, $url);

															// header que diz que queremos autenticar utilizando o HTTP Basic Auth
															curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

															// informa nossas credenciais
															curl_setopt($curl, CURLOPT_USERPWD, $auth);
															curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
															curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");

															curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

															// efetua a requisicao e coloca a resposta do servidor do MoIP em $ret
															$ret = curl_exec($curl);
															$err = curl_error($curl);
															$err = curl_error($curl);
															curl_close($curl);
															
															$coupons = json_decode($ret);
															$coupons = (array)$coupons;
															
															$i = 0;
															$total = count($coupons['coupons']);
															$p = '';
															while($i < $total){
															
																$p[$i] = (array)$coupons['coupons'][$i];
																$p[$i]['discount'] = (array) $p[$i]['discount'];
																$p[$i]['duration'] = (array) $p[$i]['duration'];
																$p[$i]['expiration_date'] = (array) $p[$i]['expiration_date'];
																$p[$i]['creation_date'] = (array) $p[$i]['creation_date'];
															
															$i++;
															}
															
															return $p;
						
						}
					
						public function associateCouponToSubscribe(){
							
							$couponCode = $this->request->data['couponCode'];
							$subscribeCode = $this->request->data['subscribeCode'];
							
							$json = '
							{
    "plan": {
        "code": "'.$subscribeCode.'"
    },
    "coupon": {
        "code": "'.$couponCode.'"
    }
}
							';
							
							$header = array();
												$header[] = 'Content-type: application/json';
												//$header [] = "Authorization: Basic SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA==";
												//$auth = 'SFJFT1RPSEpPNElZUVJPMjRBRVVVTVE4OVpRMTEzUk46U1BUUTJYUllTN1dISlVLUUtIMjVUQzk1N0gwM0xJNFpXS0xDTzBDTA';
												// URL do SandBox - Nosso ambiente de testes
												//	 $url = "https://sandbox.moip.com.br/assinaturas/v1/subscriptions/".$subscribeCode;
												 
												 $header [] = "Authorization: Basic Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==";
															$auth = 'Sks3NVY2VUdLWVlVWlIySUNWSEpTU0xENjg3VUVKOUg6MTFQQjRGUE42OE0xRkU4TUFQV1VESU1FSEZJR004UDZETVNCTlhaWg==';
															$url = "https://api.moip.com.br/assinaturas/v1/subscriptions/".$subscribeCode;
											   
												$curl = curl_init();
													curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
												curl_setopt($curl, CURLOPT_URL, $url);
											

												// header que diz que queremos autenticar utilizando o HTTP Basic Auth
												curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

												// informa nossas credenciais
												curl_setopt($curl, CURLOPT_USERPWD, $auth);
												curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
												curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
												//curl_setopt($curl, CURLOPT_POST, true);

												// Informa nosso XML de instru��o
											   curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

												curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

												// efetua a requisi��o e coloca a resposta do servidor do MoIP em $ret
												$ret = curl_exec($curl);
												$err = curl_error($curl);
												$err = curl_error($curl);
												curl_close($curl);
												
												var_dump($ret);
						
						}
					}
