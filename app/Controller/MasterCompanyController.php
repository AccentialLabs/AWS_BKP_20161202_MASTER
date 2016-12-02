<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterCompanyController
 *
 * @author user
 */
class MasterCompanyController extends AppController {

    //put your code here
    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business_master';
        parent::__construct($request, $response);
    }

    public function index($companyId) {

        //COMPANY
        $arrayParams = array(
            'Company' => array(
                'conditions' => array(
                    'Company.id' => $companyId
                )
            )
        );
        $company = $this->AccentialApi->urlRequestToGetData('companies', 'first', $arrayParams);

        //COMPANIESUSER
        $arrayParamsU = array(
            'CompaniesUser' => array(
                'conditions' => array(
                    'CompaniesUser.company_id' => $companyId
                )
            ),
            'User'
        );
        $companiesUser = $this->AccentialApi->urlRequestToGetData('companies', 'all', $arrayParamsU);

        //CHECKOUTS
         $arrayParamsC = array(
            'Checkout' => array(
                'conditions' => array(
                    'Checkout.company_id' => $companyId
                )
            ),
            'Offer', 
            'PaymentState',
             'User'
             
        );
        $checkouts = $this->AccentialApi->urlRequestToGetData('payments', 'all', $arrayParamsC);
        
        $this->set('company', $company);
        $this->set('companiesUser', $companiesUser);
         $this->set('checkouts', $checkouts);
    }

}
