<?php
/**
 * All action about Users
 */
class UserController extends AppController {

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business';
        $this->set('title_for_layout', 'Usuarios');
        
        parent::__construct($request, $response);
    }

    public function beforeFilter() {
        if($this->Session->read('userLoggedType') != 1){
            $this -> render('../Errors/wrong_way');
            //TODO: enviar e-mail para responsavel da empresa avisando da tentativa.
        }
        parent::beforeFilter();
    }


    /**
     * Show populated view
     */
    public function index() {
        $this->set('company', $this->Session->read('CompanyLoggedIn'));
        $this->set('secundaryUserTypes', $this->secundaryUserTypes());
        $this->set('secundaryUsers', $this->getSecundaryUsers($this->Session->read('CompanyLoggedIn.Company.id')));
    }
    
    /**
     * Update information of primary user.
     * If password change, logout user
     */
    public function updatePrimaryUser() {  
        if ($this->request->is('post')) {
            $name = $this->request->data ['User'] ['name'];
            $email = $this->request->data ['User'] ['email'];
            $pass = $this->request->data ['User'] ['pass'];
            if (md5($pass) === $this->Session->read('CompanyLoggedIn.Company.password')) {
                $passNew1 = $this->request->data ['User'] ['passNew1'];
                $passNew2 = $this->request->data ['User'] ['passNew2'];
                if ($passNew1 === $passNew2) {
                    $params = array(
                        'Company' => array(
                            'id' => $this->Session->read('CompanyLoggedIn.Company.id'),
                            'responsible_name' => $name,
                            'email' => $email,
                            'password' => $passNew1
                        )
                    );
                    $updateSenha = $this->AccentialApi->urlRequestToSaveData('companies', $params);
                    $this->redirect("/login/logout");
                } else {
                    $this->Session->setFlash(__('Confirmação da senha diferente da nova senha.'));
                }
            } else {
                if (empty($pass)) {
                    $params = array(
                        'Company' => array(
                            'id' => $this->Session->read('CompanyLoggedIn.Company.id'),
                            'responsible_name' => $name,
                            'email' => $email
                        )
                    );
                    $update = $this->AccentialApi->urlRequestToSaveData('companies', $params);
                    if(is_null($update)){
                        $company = $this->Session->read('CompanyLoggedIn');
                        $company['Company']['email'] = $email;
                        $company['Company']['responsible_name'] = $name;
                        $this->Session->write('CompanyLoggedIn', $company);
                    }
                    
                } else {
                    $this->Session->setFlash(__('Senha antiga incorreta.'));
                }
            }
        }
        $this->redirect("index");
    }

    /**
     * Add secondary user on company. On success send e-mail
     * @return 0 for error and UserObject in success
     */
    public function addSecondaryUver() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $this->GeneralFunctions = $this->Components->load('GeneralFunctions');
            $company = $this->Session->read('CompanyLoggedIn');
            $password = $this->GeneralFunctions->generateRandomPassword();
            $param['SecondaryUser']['name'] = $this->request->data['SecondaryUser']['name'];
            $param['SecondaryUser']['email'] = $this->request->data['SecondaryUser']['email'];
            $param['SecondaryUser']['type'] = $this->request->data['SecondaryUser']['type'];
            $param['SecondaryUser']['company_id'] = $company['Company']['id'];
            $param['SecondaryUser']['normalPass'] = $password;
            $param['SecondaryUser']['hashPass'] = md5($password);
            $query = "INSERT INTO secondary_users(name, email, password, company_id, secondary_type_id)"
                    . " VALUES('" . $param['SecondaryUser']['name'] . "'"
                    . ",'" . $param['SecondaryUser']['email'] . "'"
                    . ",'" . $param['SecondaryUser']['hashPass'] . "'"
                    . "," . $param['SecondaryUser']['company_id'] . ""
                    . "," . $param['SecondaryUser']['type'] . ");";
            $params = array(
                'User' => array(
                    'query' => $query
                )
            );
            $addUserOffer = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
            if (is_null($addUserOffer)) {
                //TODO: enviar email ao adicionar o usuario com sucesso.
                $data['normalPass'] = $param['SecondaryUser']['normalPass'];
                $data['name'] = $param['SecondaryUser']['name'];
                $data['email'] = $param['SecondaryUser']['email'];
                $msgReturn = $this->GeneralFunctions->postEmail('companies', 'secondaryUser', $data);
                $newUser = $this->getSecundaryUserByLoginAndPassword($param['SecondaryUser']['email'], $param['SecondaryUser']['hashPass'], $company['Company']['id']);
                return json_encode($newUser[0]);
            }
        }
        return 0;
    }

    /**
     * Remove the secundary use from system
     * @return int
     */
    public function removeSecondUser() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $secondUserId = $this->request->data['SecondaryUser']['id'];
            $sql = "UPDATE secondary_users SET excluded = 1 where id = {$secondUserId};";
            $params = array('User' => array('query' => $sql));
            $delete = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
            if (is_null($delete)) {
                return 1;
            }
        }
        return 0;
    }

    // <editor-fold  defaultstate="collapsed" desc="Private Methods">
    /**
     * Get all types os secundary users on system
     * @return Array with all types of secundary users
     */
    private function secundaryUserTypes() {
        $query = "select * from secondary_users_types;";
        $params = array(
            'User' => array(
                'query' => $query
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
    }

    /**
     * Get secundary users of company
     * @param int $companyId
     * @return Array os all secundarys users of this company
     */
    private function getSecundaryUsers($companyId) {
        $secondUserSQL = "select * "
                . "from secondary_users "
                . "inner join secondary_users_types on secondary_users.secondary_type_id = secondary_users_types.id "
                . "where company_id  = {$companyId} ;";
        $secondUserParam = array(
            'User' => array(
                'query' => $secondUserSQL
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $secondUserParam);
    }

    /**
     * Get user based on login and password
     * @param string $secUserName
     * @param string $secUserPass
     * @param int $companyId
     * @return Array with one element - the user with the login and pass send
     */
    private function getSecundaryUserByLoginAndPassword($secUserName, $secUserPass, $companyId) {
        $secondUserSQL = "select * "
                . "from secondary_users "
                . "inner join secondary_users_types on secondary_users.secondary_type_id = secondary_users_types.id "
                . "where secondary_users.email = '{$secUserName}' "
                . "and secondary_users.password = '{$secUserPass}'"
                . "and company_id  = {$companyId} AND secondary_users.excluded = 0;";
        $secondUserParam = array(
            'User' => array(
                'query' => $secondUserSQL
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $secondUserParam);
    }
	
	public function ajaxAddNewUser(){
	 $this->autoRender = false;
	 
		$sql = "INSERT INTO users(
		`name`,
		`email`, 
		`password`
		) 
		VALUES(
		'".$this->request->data['User']['name']."',
		'".$this->request->data['User']['email']."',
		'".md5($this->request->data['User']['password'])."'
		
		);";
		
		$scheduleParam = array(
                'User' => array(
                    'query' => $sql
                )
            );
        $scheduleReturn = $this->AccentialApi->urlRequestToGetData('users', 'query', $scheduleParam);
		
		return 'false';
	}
	
	public function editSecondaryUser(){
		$this->autoRender = false;
		$sql = "UPDATE secondary_users 
				SET
				name = '".$this->request->data['SecondaryUser']['name']."',
				email = '".$this->request->data['SecondaryUser']['email']."',
				secondary_type_id = '".$this->request->data['SecondaryUser']['type']."'
				WHERE id = ".$this->request->data['SecondaryUser']['id'].";";
	
		$scheduleParam = array(
                'User' => array(
                    'query' => $sql
                )
            );
			
        $scheduleReturn = $this->AccentialApi->urlRequestToGetData('users', 'query', $scheduleParam);
		return 'false';
	}
	
	public function reativeSecondUser(){
	$this->autoRender = false;
        if ($this->request->is('post')) {
            $secondUserId = $this->request->data['SecondaryUser']['id'];
            $sql = "UPDATE secondary_users SET excluded = 0 where id = {$secondUserId};";
            $params = array('User' => array('query' => $sql));
            $delete = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
            if (is_null($delete)) {
                return 1;
            }
        }
        return 0;
	}

    // </editor-fold>
}
