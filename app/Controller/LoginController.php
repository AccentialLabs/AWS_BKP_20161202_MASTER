<?php

/**
 * All actions about user login on Jezzy
 */
class LoginController extends AppController {

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_login';
        parent::__construct($request, $response);
    }

    /**
     * Check the session every time the class is call, exepts on 'logout' 
     */
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
                $this->redirect(array('controller' => 'Dashboard', 'action' => 'index'));
            }
        }
    }

    /**
     * Used just to show 'view' 
     */
    public function index() {
        
    }

    /**
     * Used just to show 'view' 
     */
    public function forgotPassword() {
        
    }

    /**
     * Do the login of user or return to 'index' with a error message
     */
    public function login() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            
            $email = trim($this->request->data ['Company'] ['email']);
            $pass = md5(trim($this->request->data ['Company'] ['password']));
            $conditions = array(
                'Company' => array(
                    'conditions' => array(
                        'Company.responsible_email' => $email,
                        'Company.password' => $pass,
                        'Company.status' => 'ACTIVE'
                    )
                ),
                'CompanyPreference' => array()
            );
            $company = $this->AccentialApi->urlRequestToGetData('companies', 'first', $conditions);
            if ((!empty($company ['status']) && $company ['status'] === 'GET_ERROR') || empty($company)) {//check if is secundary user
                $resultLogin = $this->secondaryUserLogin($email, $pass);
                if ($resultLogin['login_status'] === 'LOGIN_OK') {
                    $this->Session->write('sessionLogado', true);
                    $this->Session->write('CompanyLoggedIn', $resultLogin['company']);
                    $this->Session->write('userLoggedType', $resultLogin[0]['secondary_users']['secondary_type_id']);
                    $this->Session->write('secondUserLogado', true);
                    $this->Session->write('SecondaryUserLoggedIn', $resultLogin);
                } else {
                    $this->Session->setFlash(__('Usuário ou senha inválidos.'));
                    $this->redirect("index");
                }
            } else {
                $this->Session->write('sessionLogado', true);
                $this->Session->write('CompanyLoggedIn', $company);
                $this->Session->write('userLoggedType', 1);
            }
            if (isset($this->request->data ['Company'] ['remember']) && $this->request->data ['Company'] ['remember'] === "true") {
                $this->Cookie->write('sessionLogado', true, time() + 3600);
                $this->Cookie->write('CompanyLoggedIn', $this->Session->read('CompanyLoggedIn'), time() + 3600);
                if ($this->Session->check('userLoggedType') === true) {
                    $this->Cookie->write('userLoggedType', $this->Session->read('userLoggedType'), time() + 3600);
                }
                if ($this->Session->check('secondUserLogado') === true) {
                    $this->Cookie->write('secondUserLogado', $this->Session->read('secondUserLogado'), time() + 3600);
                }
                if ($this->Session->check('SecondaryUserLoggedIn') === true) {
                    $this->Cookie->write('SecondaryUserLoggedIn', $this->Session->read('SecondaryUserLoggedIn'), time() + 3600);
                }
            }
            $this->redirect(array('controller' => 'Dashboard', 'action' => 'index'));
        }
        $this->redirect("index");
    }

    /**
     * Set new password to user and send e-mail with new password. 
     */
    public function sendPassword() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $email = trim($this->request->data ['Company'] ['email']);
            $this->GeneralFunctions = $this->Components->load('GeneralFunctions');
            $user = $this->getUserData($email);
			$pass = $this->GeneralFunctions->generateRandomPassword();
			//$pass = "123456";
			
            switch ($user['type']) {
                case 0:
                    $this->Session->setFlash(__('E-mail não encontrado.'));
                    $this->redirect("forgotPassword");
                    break;
                case 1:
                    $params = array(
                        'Company' => array(
                            'id' => $user['id'],
                            'email' => $email,
                            'password' => $pass
                        )
                    );
                    $updateSenha = $this->AccentialApi->urlRequestToSaveData('companies', $params);
                    break;
                case 2:
                    $query = "UPDATE secondary_users "
                            . " SET password =  '" .  md5($pass) . "'"
                            . " WHERE id = " . $user['id'];
                    $params = array(
                        'User' => array(
                            'query' => $query
                        )
                    );
                    $updateSenha = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
                    break;
                default :
                    $this->Session->setFlash(__('Ops. Algo deu errado. Tente novamente.'));
                    $this->redirect("forgotPassword");
                    break;
            }
            if(is_null($updateSenha)){
                $data['normalPass'] = $pass;
                $data['email'] = $email;
                $this->GeneralFunctions->postEmail('companies', 'newPass', $data);
                //TODO: remover o passa quando festiver tudo mais funcionando
                $this->Session->setFlash(__('Nova senha enviada por e-mail - "' . $pass . '"'));
            }
        } else {
            $this->Session->setFlash(__('Ação desconhecida. Reinicie seu navegador e tente novamente'));
        }
        $this->redirect("index");
    }

    /**
     * On logout kill all session and cookies
     */
    public function logout() {
        $this->autoRender = false;
        $this->Session->destroy();
        $this->Cookie->destroy();
        $this->redirect("/masterLogin/index");
    }

    // <editor-fold  defaultstate="collapsed" desc="Private Methods">
    /**
     * Check if user is a secundary user and send the information back
     * @param string $email
     * @param string $senha
     * @return string
     */
    private function secondaryUserLogin($email, $senha) {
        $query = "select * from secondary_users where email = '$email' and password = '$senha';";
        $params = array(
            'User' => array(
                'query' => $query
            )
        );
        $usuario = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
        if (!empty($usuario)) { //Check if user exists
            $usuario['login_status'] = 'LOGIN_OK';
            $conditions = array(
                'Company' => array(
                    'conditions' => array(
                        'Company.id' => $usuario[0]['secondary_users']['company_id']
                    )
                ),
                'CompanyPreference' => array()
            );
            $company = $this->AccentialApi->urlRequestToGetData('companies', 'first', $conditions);
            $usuario['company'] = $company;
        } else {
            $usuario['login_status'] = 'LOGIN_ERRO';
        }
        return $usuario;
    }

    /**
     * Get basic information about users. Used in forget password.
     * @param string $email
     * @return Array
     */
    private function getUserData($email) {
        $user['type'] = $conditions = array(
            'Company' => array(
                'conditions' => array(
                    'Company.responsible_email' => $email,
                    'Company.status' => 'ACTIVE'
                )
            ),
            'CompanyPreference' => array()
        );
        $retornData = $this->AccentialApi->urlRequestToGetData('companies', 'first', $conditions);
        if ((!empty($retornData ['status']) && $retornData ['status'] === 'GET_ERROR') || empty($retornData)) {
            $query = "select * from secondary_users where email = '$email';";
            $params = array(
                'User' => array(
                    'query' => $query
                )
            );
            $retornData = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);
            if (isset($retornData[0]["secondary_users"]["id"])) {
                $user['type'] = 2;
                $user['id'] = $retornData[0]["secondary_users"]["id"];
            } else {
                $user['type'] = 0;
            }
        } else {
            $user['type'] = 1;
            $user['id'] = $retornData["Company"]["id"];
        }
        return $user;
    }
    // </editor-fold>
}
