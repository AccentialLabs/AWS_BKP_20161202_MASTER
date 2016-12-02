<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array('Session','AccentialApi','Cookie');
    
    public function beforeFilter() {
        if(array_reverse(explode("/", $this->here))[0] !== "login" && array_reverse(explode("/", $this->here))[1] !== "login"){
            if ($this->Session->check("sessionLogado") === false || $this->Session->check("CompanyLoggedIn") === false) {
                $this->redirect(array('controller' => 'MasterLogin', 'action' => 'index'));
            }
        }
    }
    
}
