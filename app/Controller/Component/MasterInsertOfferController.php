<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterInsertOfferController
 *
 * @author user
 */
class MasterInsertOfferController extends AppController {

//put your code here

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business_master';
        parent::__construct($request, $response);
    }

    public function index($offerId = null) {

        $this->set('atributes', $this->getOfferAtributes());
        $this->set('categories', $this->getCompanysCategory());
	$this->set('filters', $this->getAllFilters());

        if ($offerId != null) {
//if ($offerId != null && isset($offerId)) {
            $this->GeneralFunctions = $this->Components->load('GeneralFunctions');
            $offer = $this->getOfferInformation($this->GeneralFunctions->onlyNumbers($offerId));
            $this->set('offerInformation', $offer);
            $this->set('offerExtra', $this->getOfferExtraInformation($offerId));
            $this->set('offerImages', $this->getAllImagesForOffer($offerId));
            $this->set('offerFilters', $this->getOfferFilters($offerId));
            $this->set('offerQuestions', $this->getOfferQuestions($offerId));
// }
        }
    }

    /**
     * Get the information about the offer
     * @param Session $company
     * @param Offer Id $offerId
     * @return Offer
     */
    private function getOfferInformation($offerId) {
        $arrayParams = array(
            'Offer' => array(
                'conditions' => array(
                    'Offer.company_id' => 99999,
                    'Offer.id' => $offerId
                )
            )
        );
        return $this->AccentialApi->urlRequestToGetData('offers', 'first', $arrayParams);
    }
    /**get the informations about the product where we can compare to the facebook_profile
     * 
     */
    private function getOfferQuestions($offerId) {
       $query = "select * from offers_characteristics;";
       
        $offerQuestions = array(
            'User' => array(
                'query' => $query
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $offerQuestions);
    }
    /**
     * Functio responsible to add and edit basic offer information
     * @return offer
     */
    public function addEditBasicOfferInformation() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $var['Company']['id'] = 99999;

            $company = $var;
            $this->GeneralFunctions = $this->Components->load('GeneralFunctions');
            extract($this->request->data);
            if (!empty($offer_id)) {
                $param['Offer']['id'] = $offer_id;
                $newOffer = false;
            } else {
                $newOffer = true;
            }
// => Basic filds
            $param['Offer']['company_id'] = $company['Company']['id'];
            $param['Offer']['title'] = $title;
            $param['Offer']['resume'] = $resume;
            $param['Offer']['value'] = $price;
            $param['Offer']['amount_allowed'] = $qtd;
            $param['Offer']['begins_at'] = $this->GeneralFunctions->convertDateBrazilToSQL($begins_at);
            $param['Offer']['parcels'] = $parcels;
// => Extra Filds
            $param['Offer']['description'] = $description;
            $param['Offer']['specification'] = $specification;
            $param['Offer']['percentage_discount'] = 100 - ($price_offer / $price) * 100;
            $param['Offer']['parcels_impost_value'] = $percentage;
            $param['Offer']['weight'] = $weight == "" ? 0 : $weight;
            $param['Offer']['ends_at'] = $ends_at == "" ? "''" : $this->GeneralFunctions->convertDateBrazilToSQL($ends_at);
            $param['Offer']['metrics'] = "''"; // TODO - 1: o que é este campo
            $param['Offer']['sku'] = $sku;
			$param['Offer']['public'] = "ACTIVE"; // TODO - 1: o que é este campo
            $returnAddEdit = $this->AccentialApi->urlRequestToSaveData('offers', $param);
            if (isset($returnAddEdit['data']['Offer']['id'])) {
                $this->editDeliveryInformation($returnAddEdit['data']['Offer']['id'], $newOffer, $offer_type, $delivery_dealine, $delivery_value, $use_correios_api, $split_percentage);
            }
			
			$dataSku = $sku;
			$offerId = $returnAddEdit['data']['Offer']['id'];
			
			$sqlEditOffer = "update offers set sku = '{$dataSku}' where id = {$offerId};";
			$params = array(
            'User' => array(
                'query' => $sqlEditOffer
				)
			);
			$this->AccentialApi->urlRequestToGetData('users', 'query', $params);
			
			
            //INSERI QUANTIDADE DE PARCELAS PERMITIDAS APÓS INSERÇÃO DA OFERTA
            $sqlParcelsQtd = "update offers set parcels_quantity = {$parcels_quantity} where id = {$returnAddEdit['data']['Offer']['id']};";
            $sqlParcelsParams = array('User' => array('query' => $sqlParcelsQtd));
            $this->AccentialApi->urlRequestToGetData('users', 'query', $sqlParcelsParams);
			
			$sqlEditOffersExtra = "update offers_extra_infos set parcel_percentage = {$percentage} where offer_id  = {$offerId};";
			$paramsOffersExtra = array(
            'User' => array(
                'query' => $sqlEditOffersExtra
				)
			);
			$this->AccentialApi->urlRequestToGetData('users', 'query', $paramsOffersExtra);
			
            return json_encode($returnAddEdit);
        }
    }

    private function editDeliveryInformation($justAddId, $newOffer, $offer_type, $delivery_dealine, $delivery_value, $use_correios_api, $splitPercentange) {
        if ($use_correios_api == 1 || $use_correios_api == "1") {
            $delivery_mode = "CORREIO";
            $delivery_dealine = 0;
            $delivery_value = 0;
        } else {
            $delivery_mode = "TRANSPORTA";
            if ($delivery_dealine == "") {
                $delivery_dealine = 0;
            }
            if ($delivery_value == "") {
                $delivery_value = 0;
            }
        }
        if (!$newOffer) {
            $query = "UPDATE offers_extra_infos SET "
                    . " offer_type = '" . $offer_type . "' , "
                    . " delivery_mode = '" . $delivery_mode . "' , "
                    . " delivery_deadline = " . $delivery_dealine . " , "
                    . " delivery_value = " . $delivery_value . ""
                    . " WHERE offer_id = " . $justAddId . ";";
            $paramExtras = array(
                'User' => array(
                    'query' => $query
                )
            );
            $infosExtras = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramExtras);
        } else {
            $query = "INSERT INTO offers_extra_infos("
                    . "offer_type, "
                    . "delivery_mode, "
                    . "delivery_deadline, "
                    . "delivery_value, "
                    . "offer_id,"
                    . "percentage_split)"
                    . " values("
                    . "'" . $offer_type . "',"
                    . "'" . $delivery_mode . "',"
                    . " " . $delivery_dealine . ","
                    . " " . $delivery_value . ","
                    . " " . $justAddId . ","
                    . "" . $splitPercentange . ");";
            $paramExtras = array(
                'User' => array(
                    'query' => $query
                )
            );
            $infosExtras = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramExtras);
        }
        return $infosExtras;
    }

    private function getOfferAtributes() {
        $query = "select * from offers_attributes order by name;
";
        $params3 = array(
            'User' => array(
                'query' => $query
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $params3);
    }

    /**
     * Gets all category for the company
     * @return arrys with the categorys
     */
    private function getCompanysCategory() {
        $arrayParams = array(
            'CompaniesCategory' => array()
        );
        return $this->AccentialApi->urlRequestToGetData('companies', 'all', $arrayParams);
    }

    private function getAllFilters() {
        $company = $this->Session->read('CompanyLoggedIn');
        $return['gender'] = $this->getFiltesOfProfiles('gender', $company);
        $return['location'] = $this->getFiltesOfProfiles('location', $company);
        $return['relationship_status'] = $this->getFiltesOfProfiles('relationship_status', $company);
        $return['religion'] = $this->getFiltesOfProfiles('religion', $company);
        $return['political'] = $this->getFiltesOfProfiles('political', $company);
        $return['age'] = $this->getFiltesOfProfilesAges($company);
        return $return;
    }

    private function getFiltesOfProfiles($filter, $company) {
        $paramExtras = array(
            'User' => array(
                'query' => 'SELECT COUNT(facebook_profiles.' . $filter . ') as sum, facebook_profiles.' . $filter . ' as response FROM facebook_profiles INNER JOIN companies_users ON facebook_profiles.user_id = companies_users.user_id WHERE facebook_profiles.' . $filter . ' IS NOT NULL GROUP BY ' . $filter . ';'
            )
        );
        $result = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramExtras);
        $total = 0;
        if (!empty($result)) {
            foreach ($result as $response) {
                $total = $total + $response[0]['sum'];
            }
        }
        $resultArr = array();
        if (!empty($result)) {
            foreach ($result as $key => $response) {
                $resultArr[$key]['param'] = str_replace(", ", " ", $response['facebook_profiles']['response']);
                $resultArr[$key]['total'] = number_format((($response[0]['sum'] * 100) / $total), 1);
            }
        }
        return $resultArr;
    }

    private function getFiltesOfProfilesAges($company) {
        $paramExtras = array(
            'User' => array(
                'query' => "
SELECT
SUM(IF(age < 20, 1, 0)) AS 0_20,
 SUM(IF(age BETWEEN 20 AND 29, 1, 0)) AS 20_29,
 SUM(IF(age BETWEEN 30 AND 39, 1, 0)) AS 30_39,
 SUM(IF(age BETWEEN 40 AND 49, 1, 0)) AS 40_49,
 SUM(IF(age BETWEEN 50 AND 59, 1, 0)) AS 50_59,
 SUM(IF(age BETWEEN 60 AND 120, 1, 0)) AS 60_120,
 SUM(IF(age >= 121, 1, 0)) AS outro
FROM ( SELECT YEAR(CURDATE()) - YEAR(birthday ) AS age
FROM users as a, companies_users as b
WHERE a.id = b.user_id and b.status = 'ACTIVE') AS derived;
"
            )
        );
        $result = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramExtras);
        $total = 0;
        foreach ($result[0][0] as $key => $response) {
            $total = $total + $response;
        }
        $resultArr = array();
        foreach ($result[0][0] as $key => $response) {
            $resultArr[$key]['param'] = str_replace("_", " a ", $key);
            if ($total == 0) {
                $resultArr[$key]['total'] = 0;
            } else {
                $resultArr[$key]['total'] = number_format((($response * 100) / $total), 1);
            }
        }
        return $resultArr;
    }

    /**
     * Get the URL of extra images
     * @param Offer id $offerId
     * @return Arrya with images
     */
    private function getAllImagesForOffer($offerId) {
        $query = "SELECT * FROM "
                . " offers_photos"
                . " WHERE offer_id = '" . $offerId . "';
";
        $paramExtras = array(
            'User' => array(
                'query' => $query
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $paramExtras);
    }

    /**
     * Gets all extra information about the product
     * @param type $offerId
     * @return type
     */
    private function getOfferExtraInformation($offerId) {
        $query = "SELECT * FROM offers_extra_infos WHERE offer_id = $offerId;
";
        $paramExtras = array(
            'User' => array(
                'query' => $query
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $paramExtras)[0];
    }

    private function getOfferFilters($offerId) {
        $query = "SELECT * FROM "
                . " offers_filters"
                . " WHERE offer_id = '" . $offerId . "';
";
        $paramExtras = array(
            'User' => array(
                'query' => $query
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $paramExtras);
    }

    public function uploadOfferImage() {
        $this->autoRender = false;
        //CHAMAR FUNÇÃO uploadAnyPhoto PARA TESTE 


        if ($this->request->is('post')) {
            if (isset($this->request['data']['offerId']) && !empty($this->request['data']['offerId'])) {
                if (isset($this->request->params['form']['sendImage']) && !empty($this->request->params['form']['sendImage'])) {
                    //$offersExtraPhotos = $this->AccentialApi->uploadFileOffer('offers', $this->request->params['form']['sendImage']);
                    //$offersExtraPhotos = $this->AccentialApi->uploadAnyPhoto('jezzyuploads/company-119/offers', $this->request->params['form']['sendImage']);
                    $offersExtraPhotos = $this->AccentialApi->uploadAnyPhotos('uploads/company-99999/offers', $this->request->params['form']['sendImage'], 99999);
                    if (!empty($offersExtraPhotos) && substr($offersExtraPhotos, 0, 4) == "http") {
                        $saveDatabase = $this->saveImageUrl($this->request['data']['offerId'], $offersExtraPhotos, false, $this->request['data']['photo_id']);
                        if (empty($saveDatabase)) {
                            return "true";
                        }
                    }
                } else {
                    if (isset($this->request->params['form']['sendImageFirst']) && !empty($this->request->params['form']['sendImageFirst'])) {
                        // $offersExtraPhotos = $this->AccentialApi->uploadFileOffer('offers', $this->request->params['form']['sendImageFirst']);
                        //$offersExtraPhotos = $this->AccentialApi->uploadAnyPhoto('jezzyuploads/company-119/offers', $this->request->params['form']['sendImageFirst']);
                        $offersExtraPhotos = $this->AccentialApi->uploadAnyPhotos('uploads/company-99999/offers', $this->request->params['form']['sendImageFirst'], 99999);
                        $saveDatabase = $this->saveImageUrl($this->request['data']['offerId'], $offersExtraPhotos, true);
                        if (empty($saveDatabase)) {
                            return "true";
                        }
                    }
                }
            }
        }
        return "false";
    }

    /**
     * Save the image URL on database
     * @param string $offerId
     * @param string $imageUrl
     * @param string $first
     * @param string $photo_id
     * @return resposne do query.
     */
    private function saveImageUrl($offerId, $imageUrl, $first = false, $photo_id = 0) {
        if ($first) {
            $query = "UPDATE offers SET "
                    . " photo = '" . $imageUrl . "' "
                    . " WHERE id = " . $offerId . ";
";
        } else {
            if ($photo_id == 0 || $photo_id == "0") {
                $query = "INSERT INTO offers_photos("
                        . " offer_id, "
                        . " photo )"
                        . " values("
                        . $offerId . ", "
                        . "'" . $imageUrl . "');
";
            } else {
                $query = "UPDATE offers_photos SET "
                        . " photo = '" . $imageUrl . "' "
                        . " WHERE id = " . $photo_id . ";
";
            }
        }
        $paramExtras = array(
            'User' => array(
                'query' => $query
            )
        );
        return $this->AccentialApi->urlRequestToGetData('users', 'query', $paramExtras);
    }
    
      // <editor-fold  defaultstate="collapsed" desc="Ajax Methods">
    /**
     * Mount the HTML table of product options. 
     */
    public function productOptionsTable() {
        $this->layout = '';
        if ($this->request->is('post')) {
            if (!empty($this->request->data['col']) and ! empty($this->request->data['line'])) {

                $param['Offer']['id'] = $this->request->data['offerId'];
                $param['Offer']['offer_attribute_x'] = $this->request->data['line'];
                $param['Offer']['offer_attribute_y'] = $this->request->data['col'];
                $param['Offer']['category'] = $this->request->data['category'];
                $returnAddEdit = $this->AccentialApi->urlRequestToSaveData('offers', $param);

                if (isset($this->request->data['offerId']) && !empty($this->request->data['offerId'])) {
                    $sqlDTColuna = "select * from offers_metrics inner join offers_domains on offers_metrics.offer_metrics_y_id = offers_domains.id inner join offers_attributes on offers_attributes.id = offers_domains.offer_attribute_id where offers_metrics.offer_id = " . $this->request->data['offerId'] . ";";
                    $paramsDTColuna = array(
                        'User' => array(
                            'query' => $sqlDTColuna
                        )
                    );
                    $editDTColunas = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramsDTColuna);
                    $editDTLinhas = $editDTColunas;
                } else {
                    $editDTColunas = Array();
                    $editDTLinhas = Array();
                }
                // => Gets all domains for that colomn
                $col = $this->request->data['col'];
                $line = $this->request->data['line'];
                $query = "select * from offers_domains where offer_attribute_id = $col;";
                $paramsCol = array(
                    'User' => array(
                        'query' => $query
                    )
                );
                // => Gets all domains for that line
                $cols = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramsCol);
                $query = "select * from offers_domains where offer_attribute_id = $line;";
                $paramsLine = array(
                    'User' => array(
                        'query' => $query
                    )
                );
                $lines = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramsLine);
            }
        }
        $this->set('editDTColunas', $editDTColunas);
        $this->set('editDTLinhas', $editDTLinhas);
        $this->set('cols', $cols);
        $this->set('lines', $lines);
    }
	
	   /**
     * Save the filters of an offer
     */
    public function saveFilters() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $offerId = $this->request['data']['offerId'];
            $offers_filters_id = $this->request['data']['offers_filters_id'];
            if (isset($this->request['data']['gender'])) {
                $gender = implode(",", $this->request['data']['gender']);
            } else {
                $gender = "";
            }
            if (isset($this->request['data']['religion'])) {
                $religion = implode(",", $this->request['data']['religion']);
            } else {
                $religion = "";
            }
            if (isset($this->request['data']['politics'])) {
                $politics = implode(",", $this->request['data']['politics']);
            } else {
                $politics = "";
            }
            if (isset($this->request['data']['age'])) {
                $age = implode(",", $this->request['data']['age']);
            } else {
                $age = "";
            }
            if (isset($this->request['data']['location'])) {
                $location = implode(",", $this->request['data']['location']);
            } else {
                $location = "";
            }
            if (isset($this->request['data']['relashionship'])) {
                $relashionship = implode(",", $this->request['data']['relashionship']);
            } else {
                $relashionship = "";
            }

            $paramsQuery = array(
                'User' => array(
                    'query' => "UPDATE offers SET public = 'INACTIVE' WHERE id = " . $offerId . ";"
                )
            );
            $abc = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramsQuery);
            if ($offers_filters_id == "") {
                $query = "
                    INSERT INTO offers_filters
                    (gender, religion, political, age_group, location, relationship_status, offer_id)
                    VALUES
                    ('" . $gender . "','" . $religion . "','" . $politics . "','" . $age . "','" . $location . "','" . $relashionship . "', '" . $offerId . "');";
            } else {
                $query = "
                    UPDATE offers_filters SET
                        gender = '" . $gender . "',
                        religion = '" . $religion . "',
                        political = '" . $politics . "',
                        age_group = '" . $age . "',
                        location = '" . $location . "',
                        relationship_status = '" . $relashionship . "'
                    WHERE id = '" . $offers_filters_id . "'";
            }
            $paramsQuery = array(
                'User' => array(
                    'query' => $query
                )
            );
            $abc = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramsQuery);
        }
		
			/**
			* Verficia se oferta tem algum filtro
			* caso não tenha volta para publica
			*/
			$sqlSelectFilter = "select * from offers_filters where offer_id = {$offerId};";
			$paramsMyOffersFilters = array('User' => array('query' => $sqlSelectFilter));
			$myOffersFilters = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramsMyOffersFilters);
			
			if(!empty($myOffersFilters)){
			
				if($myOffersFilters[0]['offers_filters']['gender'] == '' &&
				$myOffersFilters[0]['offers_filters']['religion'] == '' &&
				$myOffersFilters[0]['offers_filters']['age_group'] == '' &&
				$myOffersFilters[0]['offers_filters']['location'] == '' &&
				$myOffersFilters[0]['offers_filters']['relationship_status'] == '' &&
				$myOffersFilters[0]['offers_filters']['religion'] == ''){
					$sqlUpdateOfferToPublic= "update offers set public = 'ACTIVE' where id = {$offerId};";
					$sqlUpdateParams = array('User' => array('query' => $sqlUpdateOfferToPublic));
					$this->AccentialApi->urlRequestToGetData('users', 'query', $sqlUpdateParams);
				}
					
			}
		
        $this->Session->setFlash(__('Opções do produto salvo com sucesso.'));
        $this->redirect('index/' . $offerId);
    }
}
