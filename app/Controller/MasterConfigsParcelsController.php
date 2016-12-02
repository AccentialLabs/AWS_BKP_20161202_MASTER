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
class MasterConfigsParcelsController extends AppController {

    //put your code here

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business_master';
        parent::__construct($request, $response);
    }

     public function index() {

       
        $parcels = $this->getAllParcels();
        $this->set("parcels", $parcels);
    
    }

    private function getAllParcels() {

       $query = "SELECT * FROM parcels_configuration";
        $ParcelsParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnParcels = $this->AccentialApi->urlRequestToGetData('users', 'query', $ParcelsParam);
       
        return $returnParcels;
    }
    public function addParcels() {
    
        $this->autoRender = false;
        $date = date('Y-m-d');
        $query = "INSERT INTO parcels_configuration (minparcels, maxparcels, reception_type, payer_cost, date_configuration) VALUES (" .$_POST['minparcels']. "," .$_POST['maxparcels']. ",'ANTECIPADO'," .$_POST['payer_cost']. ", " .$date.");";
        
        $ParcelsParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnParcels = $this->AccentialApi->urlRequestToGetData('users', 'query', $ParcelsParam);
        $querySELECT = "SELECT * FROM parcels_configuration ORDER BY id DESC limit 1";
        $ParcelsParamSELECT = array(
            'User' => array(
                'query' => $querySELECT
            )
        );
        $Registro = $this->AccentialApi->urlRequestToGetData('users', 'query', $ParcelsParamSELECT);
        //print_r()
        print_r($Registro[0]['parcels_configuration']['id']);
    }
    public function removeParcels() {
    
        $this->autoRender = false;
  
        $query = "DELETE FROM parcels_configuration WHERE id = " .$_POST['id'];
     
        $ParcelsParam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnParcels = $this->AccentialApi->urlRequestToGetData('users', 'query', $ParcelsParam);
      
      
    }

}
