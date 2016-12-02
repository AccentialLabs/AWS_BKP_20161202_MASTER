<?php

class MasterIndicationsUserController extends AppController {

    //put your code here

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business_master';
        parent::__construct($request, $response);
    }

    public function index() {

       
        $indications = $this->getAllIndications();
       
        $this->Session->write('SessionCompanies', $indications);
        $this->set("indications", $indications);
    
    }

    private function getAllIndications() {

       $query = "SELECT * FROM indications inner join users on indications.indication_user_id = users.id;";
        $indicationsParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnIndications = $this->AccentialApi->urlRequestToGetData('users', 'query', $indicationsParam);
       
        return $returnIndications;
    }
    public function changeStatusIndications() {
       
        $this->autoRender = false;
        
       $query = "UPDATE indications SET status = '" .$_POST['status']. "' WHERE id = " .$_POST['id'];
     
        $indicationsParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnIndications = $this->AccentialApi->urlRequestToGetData('users', 'query', $indicationsParam);
       
        return $returnIndications;
    }
    
}
?>