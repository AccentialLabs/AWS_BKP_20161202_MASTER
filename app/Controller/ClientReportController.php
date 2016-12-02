<?php
/**
 * All action about clients report
 */
class ClientReportController extends AppController {

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business';
        $this->set('title_for_layout', 'Rel.Cliente');
        parent::__construct($request, $response);
    }
    
    /**
     * Show populated view
     */
    public function index() {
        $company = $this->Session->read('CompanyLoggedIn');
        $this->set('allClients', $this->getAllClients($company));
        $this->set('allClientsCanceled', $this->getAllClientsCanceled($company));
    }

    //TODO: descobrir como funciona este metodo de criar oferta para clientes ou grupos
    public function createPersonalOffer() {
        $userId = $this->request->data['userId'];
        $this->Session->write('direcOfferUserId', $userId);
    }

    // <editor-fold  defaultstate="collapsed" desc="Private Methods">
    /**
     * Gets all active clients of the company
     * @param type $company
     * @return Array of active clients
     */
    private function getAllClients($company) {
        $this->GeneralFunctions = $this->Components->load('GeneralFunctions');
        $params = array(
            'CompaniesUser' => array(
                'conditions' => array(
                    'CompaniesUser.company_id' => $company['Company'] ['id'],
                    'User.status' => 'ACTIVE',
                    'CompaniesUser.status' => 'ACTIVE',
                ),
                'order' => array(
                    'CompaniesUser.id' => 'DESC'
                ),
            ),
            'User'
        );
        $clientsWithAge = $this->AccentialApi->urlRequestToGetData('companies', 'all', $params);
        foreach ($clientsWithAge as $key => $client){
            $clientsWithAge[$key]['User']['age'] = $this->GeneralFunctions->ageBybirthday(date('d/m/Y', strtotime($client ['User'] ['birthday'])));
            $clientsWithAge[$key]['User']['lastCheckout'] = $this->clientLastCheckout($company, $client['User']['id']);
            $clientsWithAge[$key]['User']['lastSchedule'] = "";
        }
        return $clientsWithAge;
    }
    
    /**
     * Gets all inactive clients of the company
     * @param type $company
     * @return Array of inactive clients
     */
    private function getAllClientsCanceled($company) {
        $this->GeneralFunctions = $this->Components->load('GeneralFunctions');
        $params = array(
            'CompaniesUser' => array(
                'conditions' => array(
                    'CompaniesUser.company_id' => $company['Company'] ['id'],
                    'User.status' => 'ACTIVE',
                    'CompaniesUser.status' => 'INACTIVE'
                ),
                'order' => array(
                    'CompaniesUser.id' => 'DESC'
                ),
            ),
            'User'
        );
        $clientsCanceledWithAge = $this->AccentialApi->urlRequestToGetData('companies', 'all', $params);
        foreach ($clientsCanceledWithAge as $key => $client){
            $clientsCanceledWithAge[$key]['User']['age'] = $this->GeneralFunctions->ageBybirthday(date('d/m/Y', strtotime($client ['User'] ['birthday'])));
            $clientsCanceledWithAge[$key]['User']['lastCheckout'] = $this->clientLastCheckout($company, $client['User']['id']);
            $clientsCanceledWithAge[$key]['User']['lastSchedule'] = "";
        }
        return $clientsCanceledWithAge;
    }

    /**
     * Get client last checlout and put on clients array
     * @param type $company
     * @param type $userID
     * @return The date 
     */
    private function clientLastCheckout($company, $userID) {
        $params = array(
            'Checkout' => array(
                'conditions' => array(
                    'Checkout.company_id' => $company['Company'] ['id'],
                    'Checkout.user_id' => $userID
                ),
                'order' => array(
                    'Checkout.id' => 'DESC'
                ),
            )
        );
        $lastCheckout = $this->AccentialApi->urlRequestToGetData('payments', 'first', $params);
        return $lastCheckout['Checkout']['date'] ;
    }
	
	private function getAllCheckoutsByClient($company, $userID){
	
		 $params = array(
            'Checkout' => array(
                'conditions' => array(
                    'Checkout.company_id' => $company['Company'] ['id'],
                    'Checkout.user_id' => $userID
                ),
				'Offer',
                'order' => array(
                    'Checkout.id' => 'DESC'
                ),
            )
        );
        $allCheckouts = $this->AccentialApi->urlRequestToGetData('payments', 'all', $params);
        
		return $allCheckouts;
	}
	
	public function getClienteDetail(){
	$this->layout = "";
	 $company = $this->Session->read('CompanyLoggedIn');
	
		//$id = 289;
		$id = $this->request->data['userId'];
		
		 $params = array(
            'User' => array(
                'conditions' => array(
                    'User.id' => $id
                )
            )
        );
        $user = $this->AccentialApi->urlRequestToGetData('users', 'first', $params);
		/*
		$checkouts = $this->getAllCheckoutsByClient($company, $id);
		
		
		
		$this->set('allChecks', $retorno);
		var_dump($retorno); */
		
		  $minhaData = date('m-d');
        $bithSql = "select * from checkouts inner join offers on offers.id = checkouts.offer_id where checkouts.user_id = ".$id." and checkouts.company_id = ".$company['Company'] ['id'].";";
        $birthParams = array('User' => array('query' => $bithSql));
        $ret =  $this->AccentialApi->urlRequestToGetData('users', 'query', $birthParams);
		
		$retorno['User'] = $user;
		$retorno['Checkouts'] = $ret;
		
		$schedulesSql = "select * from schedules inner join secondary_users on secondary_users.id = schedules.secondary_user_id where user_id = ".$id.";";
		$schedulesParams = array('User' => array('query' => $schedulesSql));
		$schedules =  $this->AccentialApi->urlRequestToGetData('users', 'query', $schedulesParams);
		
		$this->set('allCheckouts', $retorno);
		$this->set('schedules', $schedules);
		
		return $retorno;
	}
    // </editor-fold>
}
