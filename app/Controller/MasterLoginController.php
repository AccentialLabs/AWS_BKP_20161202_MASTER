<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterLoginController
 *
 * @author user
 */
class MasterLoginController extends AppController {

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_login_master';
        parent::__construct($request, $response);
    }

    //put your code here

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
                $this->redirect(array('controller' => 'MasterDashboard', 'action' => 'index'));
            }
        }
    }

    /**
     * Used just to show 'view' 
     */
    public function index() {
        
    }

    public function login() {
        $this->autoRender = false;
        if ($this->request->is('post')) {


            $query = "select * from master_users where email ="
                    . " '{$this->request->data['MasterUser']['email']}' and password = '" .
                    md5($this->request->data['MasterUser']['password']) . "';";
            $params = array(
                'User' => array(
                    'query' => $query
                )
            );
            $master = $this->AccentialApi->urlRequestToGetData('users', 'query', $params);


            if (!empty($master)) {//check if is secundary user
                           
                    $this->Session->write('sessionLogado', true);
                    $this->Session->write('CompanyLoggedIn', $master[0]);
                    $this->Session->write('userLoggedType', 1);
                    $this->Session->write('secondUserLogado', true);
            
            }else {
                    $this->Session->setFlash(__('Usuário ou senha inválidos.'));
                    $this->redirect("index");
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
            $this->redirect(array('controller' => 'MasterDashboard', 'action' => 'index'));
			
			$sql = "select * from companies where id = 99999;";
			   $conditions = array(
            'User' => array(
                'query' => $sql
            )
        );
        $company = $this->AccentialApi->urlRequestToGetData('users', 'query', $conditions);
		$this->Session->write('CompanyMASTERLoggedIn', $company);
		
        }
        $this->redirect("index");
       
    }

}
