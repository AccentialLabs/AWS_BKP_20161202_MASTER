<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterConfigController
 *
 * @author user
 */
class MasterConfigController extends AppController {

    //put your code here

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business_master';
        parent::__construct($request, $response);
    }

    public function index() {

		if ($this->request->is('post')) {
            $this->saveCompanyInfomation($this->request->data);			
			//redireciona para dashboard
			$this->redirect(array('controller' => 'masterDashboard', 'action' => 'index'));
        }
	
        $secondMasterUserTypes = $this->getAllSecondaryMasterUsersTypes();
        $secondariesUsers = $this->getAllSecondaryUsers();
		
			$sql = "select * from companies where id = 99999;";
			   $conditions = array(
            'User' => array(
                'query' => $sql
            )
        );
        $comp = $this->AccentialApi->urlRequestToGetData('users', 'query', $conditions);
		$company['Company'] = $comp[0]['companies'];
		
        $this->Session->write("secondariesUsersList", $secondariesUsers);
        $this->set("secondsMasterUsersTypes", $secondMasterUserTypes);
        $this->set("secondariesUsers", $secondariesUsers);
		$this->set('company', $company);
    }

    public function getAllSecondaryMasterUsersTypes() {

        $query = "select * from secondary_masterusers_types;";

        $conditions = array(
            'User' => array(
                'query' => $query
            )
        );

        $masterUsers = $this->AccentialApi->urlRequestToGetData('users', 'query', $conditions);
        return $masterUsers;
    }

    public function getAllSecondaryUsers() {

        $query = "select * from secondary_masterusers inner join secondary_masterusers_types on secondary_masterusers_types.id = secondary_masterusers.secondary_type_id;";
        $conditions = array(
            'User' => array(
                'query' => $query
            )
        );

        $secondariesUsers = $this->AccentialApi->urlRequestToGetData('users', 'query', $conditions);
        return $secondariesUsers;
    }

    public function removeSecondaryUser() {
        $this->autoRender = false;
        $query = "UPDATE secondary_masterusers SET status = 'INACTIVE' WHERE id = " . $this->request->data['id'] . ";";
        $conditions = array(
            'User' => array(
                'query' => $query
            )
        );

        $this->AccentialApi->urlRequestToGetData('users', 'query', $conditions);
    }

    public function reativeSecondaryUser() {
        $this->autoRender = false;
        $query = "UPDATE secondary_masterusers SET status = 'ACTIVE' WHERE id = " . $this->request->data['id'] . ";";
        $conditions = array(
            'User' => array(
                'query' => $query
            )
        );

        $this->AccentialApi->urlRequestToGetData('users', 'query', $conditions);
    }

    public function createSecondUser() {
        $this->autoRender = false;
        $sql = "INSERT INTO secondary_masterusers("
                . "name,"
                . "email,"
                . "password,"
                . "company_id,"
                . "secondary_type_id)"
                . "VALUES("
                . "'" . $this->request->data['name'] . "',"
                . "'" . $this->request->data['email'] . "',"
                . "'" . md5('123456') . "',"
                . "99999,"
                . $this->request->data['secondary_type_id'] . ");";

        $conditions = array(
            'User' => array(
                'query' => $sql
            )
        );

        $this->AccentialApi->urlRequestToGetData('users', 'query', $conditions);
    }

    public function showEditSecondUser() {

        $this->layout = "";
        $index = $this->request->data['index'];

        $seconds = $this->Session->read("secondariesUsersList");

        $user = $seconds[$index];
        $secondMasterUserTypes = $this->getAllSecondaryMasterUsersTypes();
        $this->set("secondsMasterUsersTypes", $secondMasterUserTypes);
        $this->set("user", $user);
    }

    public function saveUpdateSecondaryUser() {
        $this->autoRender = false;
        $query = "UPDATE secondary_masterusers SET "
                . "name = '" . $this->request->data['name'] . "',"
                . "email = '" . $this->request->data['email'] . "',"
                . "secondary_type_id = " . $this->request->data['secondary_type_id'] . ""
                . " WHERE id = " . $this->request->data['id'] . ";";

        $conditions = array(
            'User' => array(
                'query' => $query
            )
        );

        $this->AccentialApi->urlRequestToGetData('users', 'query', $conditions);
    }
	
	 /**
     * Function for save basic information about the company
     * @param Array $post
     * @return boolean
     */
    private function saveCompanyInfomation($post) {
        $params ['Company'] = $post['Company'];
        if(!empty($this->request->data ['Company']['logo']['name'])){
			$compId = 99999;
        // $upload = $this->AccentialApi->uploadFileComp('jezzy/uploads/company-'.$compId.'/config', $this->request->data ['Company'] ['logo']);
		//$upload = $this->AccentialApi->uploadFileComp('jezzy/uploads/company-'.$compId.'/config', $this->request->param ['Company'] ['logo'], $compId);
			$upload = $this->AccentialApi->uploadAnyPhotoCompany('uploads/company-99999/config', $this->request->data ['Company'] ['logo']);
			$params ['Company'] ['logo'] = $upload;
        }else {
            $params ['Company'] ['logo'] =  $this->Session->read('CompanyLoggedIn.Company.logo');
        }
        $params ['Company'] ['id'] = 99999;
        $cadastro = $this->AccentialApi->urlRequestToSaveData('companies', $params);
        if (is_null($cadastro)) {
            $arrayParams = array(
                'Company' => array(
                    'conditions' => array(
                        'Company.id' => 99999
                    )
                )
            );
            $comp = $this->AccentialApi->urlRequestToGetData('companies', 'all', $arrayParams);
            $this->Session->write('CompanyLoggedIn.Company', $comp [0]['Company']);
            return true;
        }
        return false;
    }
	
	public function testeFtp(){
$this->layout = '';
		if ($this->request->is('post')) {

	print_r($_FILES);
 // set up basic connection 
 
        $conn_id = ftp_connect("ec2-52-67-24-232.sa-east-1.compute.amazonaws.com");

        // login with username and password 
        $login_result = ftp_login($conn_id, "jezzy-ftp", "JEZftp1000");
		
		$fileData = $_FILES['myFile']; 
		$myFile = $_FILES['myFile']; 
		$type = explode("/",$fileData['type']);
   
		$destination_path = "uploads/company-99999/config/"; 
		$destination_file = $destination_path.$fileData['name'];
	
		$file = $myFile['tmp_name'];
		
		$upload = ftp_put($conn_id, $destination_file, $file, FTP_BINARY);// upload the file
    if (!$upload) {// check upload status
        return "UPLOAD_ERROR";
    } else {
        return "https://secure.jezzy.com.br/".$destination_file;
    }
}
	}

}
