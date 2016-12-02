<?php

class DashboardController extends AppController {

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business';
        parent::__construct($request, $response);
    }

    public function index() {
        $company = $this->Session->read('CompanyLoggedIn');
        if ($this->Session->read('userLoggedType') == 1) { //system admin
            $this->set('secundary_users', $this->getSecundaruUsers($company));
        } else {
            $user = $this->Session->read('SecondaryUserLoggedIn')[0]['secondary_users'];
            $this->set('secundary_users', $this->getSecundaruUsers($company, $user));
        }
		$births = $this->getBirthDays($company);
        $this->set('birthdays', $births);
        $this->set('deliveryToday', $this->getNumberDeliveryToday($company));
		$this->set('schedules', $this->getAllSchecule($company));
		$this->set('allSchedulesNext', $this->getAllSchecule($company, " > "));
        $this->set('allSchedulesPrevious', $this->getAllSchecule($company, " < "));
        $allCheckouts = $this->getLastCheckout($company);
        $checkouts1 = "";
        $checkouts2 = "";
        if (isset($allCheckouts[0]) && is_array($allCheckouts[0])) {
            $checkouts1 = $allCheckouts[0];
        }
        if (isset($allCheckouts[1]) && is_array($allCheckouts[1])) {
            $checkouts2 = $allCheckouts[1];
        }
        $this->set('checkouts1', $checkouts1);
        $this->set('checkouts2', $checkouts2);
		
		$servcs = $this->getCompanyServices($company);
		$secondaryUsers = $this->getSecundaryUsers($company);
		
		$this->set('secondaryUsers', $secondaryUsers);
        $this->set('services', $servcs);
    }

    public function personalScheduleDashboard() {
        $this->layout = '';
        if ($this->request->is('post')) {
            $this->GeneralFunctions = $this->Components->load('GeneralFunctions');
            $dataSend = $this->GeneralFunctions->convertDateBrazilToSQL($this->request->data['scheduleDay']);
            $userId = $this->request->data['userId'];
            $company = $this->Session->read('CompanyLoggedIn');
            $dateTimeHoje = new DateTime(date('Y-m-d'));
            $dateTimeSend = new DateTime($dataSend);
            $numberOfDays = (int) $dateTimeHoje->diff($dateTimeSend)->format('%a');
            if ($numberOfDays == 0) {
                $this->set('schedules', $this->getSchecule($company, $userId));
            } else {
                if ($numberOfDays > 0) {
                    $this->set('schedules', $this->getScheculeNext($company, $userId, $dataSend));
                } else {
                    $this->set('schedules', $this->getScheculePrevious($company, $userId, $dataSend));
                }
            }
        } else {
            $this->autoRender = false;
            return false;
        }
    }

    // <editor-fold  defaultstate="collapsed" desc="Private methods">
    /**
     * Gets the last checkout itens
     * @param type $company
     * @return type
     */
    private function getLastCheckout($company) {
        $params = array(
            'Checkout' => array(
                'conditions' => array(
                    'Checkout.company_id' => $company ['Company'] ['id'],
                    'Checkout.total_value > ' => '0',
                    'Checkout.payment_state_id' => 4
                ),
                'order' => array(
                    'Checkout.id' => 'DESC'
                )
            ),
            'PaymentState',
            'Offer',
            'User',
            'OffersUser'
        );
        return $this->AccentialApi->urlRequestToGetData('payments', 'all', $params);
    }

    /**
     * Get the number of deliverys for today
     * @param type $company
     * @return int
     */
    private function getNumberDeliveryToday($company) {
        $paramsDelivery = array(
            'Checkout' => array(
                'conditions' => array(
                    'Checkout.company_id' => $company['Company'] ['id'],
                    'Checkout.payment_state_id' => 1
                )
            ),
            'User',
            'Offer'
        );
        $deliveriesToDo = $this->AccentialApi->urlRequestToGetData('payments', 'all', $paramsDelivery);
        $deliveriesToday = array();
        foreach ($deliveriesToDo as $delivery) {
            $dataDaEntrega = date('d/m/y', strtotime("+1 days", strtotime($delivery['Checkout']['date'])));
            $dataHoje = date('d/m/y');
            if ($dataDaEntrega == $dataHoje) {
                $deliveriesToday['Today'][] = $delivery;
            }
        }
        if (isset($deliveriesToday['Today'])) {
            return count($deliveriesToday['Today']);
        }
        return 0;
    }

    /**
     * get birthdays of the day
     */
    private function getBirthDays($company) {
        $minhaData = date('m-d');
        $bithSql = "SELECT * FROM users INNER JOIN companies_users ON companies_users.user_id = users.id WHERE companies_users.company_id = " . $company['Company'] ['id'] . " AND users.birthday LIKE '%$minhaData';";
        $birthParams = array('User' => array('query' => $bithSql));
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $birthParams);
    }

    /**
     * Get the secundary user of the system.
     * @param type $company
     * @param type $user
     * @return type
     */
    private function getSecundaruUsers($company, $user = null) {
        //TODO: este metodo pode ser unificado com o metodo do Dashboar <> Schedule <> Users
        $andQuery = "";
        if ($user != null) {
            if (is_array($user)) {
                $andQuery = " AND secondary_users.id = " . $user['id'] . " ";
            } else {
                $andQuery = " AND secondary_users.id = " . $user . " ";
            }
        }
        $secondUserSQL = "select secondary_users.name, secondary_users.id "
                . "from secondary_users "
                . "inner join secondary_users_types on secondary_users.secondary_type_id = secondary_users_types.id "
                . "where secondary_users.excluded = 0 AND company_id  = {$company['Company'] ['id']} $andQuery;";
        $secondUserParam = array(
            'User' => array(
                'query' => $secondUserSQL
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $secondUserParam);
    }
	
	/*
	* Recupera todos os agendamentos do dia
	*/
	 private function getAllSchecule($company, $dateComparison = "=") {
        $scehduleSQL = "
            SELECT schedules.*, secondary_users.*
            FROM schedules
            INNER JOIN secondary_users
                ON schedules.secondary_user_id = secondary_users.id
            WHERE schedules.companie_id = '" . $company['Company'] ['id'] . "'
            AND schedules.date " . $dateComparison . " '" . date('Y-m-d') . "'";
        $scheduleParam = array(
            'Schedule' => array(
                'query' => $scehduleSQL
            )
        );
        return $this->AccentialApi->urlRequestToGetData('schedules', 'query', $scheduleParam);
    }
	
	public function readFile(){
	$this->layout = "";
		$handle = @fopen("../arquivo.txt", "r");
			if ($handle) {
				while (($buffer = fgets($handle, 4096)) !== false) {
					echo $buffer;
				}
			if (!feof($handle)) {
				echo "Erro: falha inexperada de fgets()\n";
			}

			fclose($handle);
	}
}

	public function writeFile(){
		$this->autoRender = false;
		$myfile = fopen("../arquivo.txt", "w") or die("Unable to open file!");
		$txt = $this->request->data['fileText'];
		fwrite($myfile, $txt);
		fclose($myfile);
		
		return 'false';
	}

	public function testeTemplate(){
		$this->layout = "";
	}
    // </editor-fold>
	
	/**
	* PARA CADASTRO DE NOVO AGENDAMENTO
	*/
	  /**
     * Gets all the services for the company
     * @param type $company
     * @return type
     */
    private function getCompanyServices($company) {
        $queryInformation = "SELECT services.*,  subclasses.*
                FROM services 
                INNER JOIN subclasses ON subclasses.id = services.subclasse_id
                    AND services.companie_id = " . $company['Company'] ['id'] . "";
        $params = array(
            'Service' => array(
                'query' => $queryInformation
            )
        );
        return $this->AccentialApi->urlRequestToGetData('Services', 'query', $params);
    }
	
	 private function getSecundaryUsers($company, $user = null) {
        //TODO: este metodo pode ser unificado com o metodo do Dashboar <> Schedule <> Users
        $andQuery = "";
        if ($user != null) {
            if (is_array($user)) {
                $andQuery = " AND secondary_users.id = " . $user['id'] . " ";
            } else {
                $andQuery = " AND secondary_users.id = " . $user . " ";
            }
        }
        $secondUserSQL = "select secondary_users.name, secondary_users.id "
                . "from secondary_users "
                . "inner join secondary_users_types on secondary_users.secondary_type_id = secondary_users_types.id "
                . "where secondary_users.excluded = 0 AND company_id  = {$company['Company'] ['id']} $andQuery;";
        $secondUserParam = array(
            'User' => array(
                'query' => $secondUserSQL
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $secondUserParam);
    }

	
}
