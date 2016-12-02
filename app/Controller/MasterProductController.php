<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MasterProductController
 *
 * @author user
 */
App::import('Vendor', 'PHPExcel');

class MasterProductController extends AppController {

    //put your code here

    public function __construct($request = null, $response = null) {
        $this->layout = 'default_business_master';
        parent::__construct($request, $response);
    }

    public function index() {
        $offers = $this->getAllOffers();
        $myOffers = $this->getAllMyOffers();
		//$statisticsFromAll = $this->getStatisticsFromAllOffers($offers);
        $this->set("offers", $offers);
        $this->set("myOffers", $myOffers);
		//$this->set('statisticsFromAll', $statisticsFromAll);
    }

    private function getAllOffers() {

        $arrayParams = array(
            'Offer' => array(
                'conditions' => array(
                ),
                'order' => array(
                    'Offer.id' => 'DESC'
                ),
            ),
            'Company'
        );
        $offers = $this->AccentialApi->urlRequestToGetData('offers', 'all', $arrayParams);
        $offersWithStatistics = '';
        foreach ($offers as $offer) {
            $statisticsQuery = "select details_click, checkouts_click, purchased_billet, purchased_card, sum(evaluation) evaluation, count(evaluation) votantes
                from offers_statistics 
                inner join offers_comments on offers_statistics.offer_id = offers_comments.offer_id 
                where offers_statistics.offer_id =" . $offer['Offer']['id'] . ";";

            $statisticsParams = array(
                'User' => array(
                    'query' => $statisticsQuery
                )
            );
            $statistics = $this->AccentialApi->urlRequestToGetData('users', 'query', $statisticsParams);
			if(!empty($statistics)){
            $offer['Statistics'] = $statistics[0];
			}
            $offersWithStatistics[] = $offer;
        }
        return $offersWithStatistics;
    }

    public function sendFileXls() {
        $this->layout = "";
        echo $_FILES['xlsFile']['tmp_name'];

        $objReader = new PHPExcel_Reader_Excel5();
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load("C:/xampp/htdocs/jezzy-master/portal/app/teste_php.xlsx");
        $objPHPExcel->setActiveSheetIndex(0);
    }

    public function getAllMyOffers() {

        $arrayParams = array(
            'Offer' => array(
                'conditions' => array(
                    'Offer.company_id' => 99999
                ),
                'order' => array(
                    'Offer.id' => 'DESC'
                )
            )
        );
        $offers = $this->AccentialApi->urlRequestToGetData('offers', 'all', $arrayParams);
        $offersWithStatistics = '';
       
            foreach ($offers as $offer) {
                $statisticsQuery = "select details_click, checkouts_click, purchased_billet, purchased_card
                from offers_statistics 
                where offers_statistics.offer_id =" . $offer['Offer']['id'] . ";";

                $statisticsParams = array(
                    'User' => array(
                        'query' => $statisticsQuery
                    )
                );
                $statistics = $this->AccentialApi->urlRequestToGetData('users', 'query', $statisticsParams);
                $offer['Statistics'] = $statistics[0];
                $offersWithStatistics[] = $offer;
            
        }
        return $offersWithStatistics;
    }
	
	public function getStatisticsFromAllOffers($offers = null){
		 $this->autoRender = false;
		$statisticsFromAll = '';
		foreach ($offers as $offer) {
                $statisticsQuery = "select details_click, checkouts_click, purchased_billet, purchased_card
                from offers_statistics 
                where offers_statistics.offer_id =" . $offer['Offer']['id'] . ";";

                $statisticsParams = array(
                    'User' => array(
                        'query' => $statisticsQuery
                    )
                );
				
                $statistics = $this->AccentialApi->urlRequestToGetData('users', 'query', $statisticsParams);
				$id = $offer['Offer']['id'];
                $statisticsFromAll[$id]['Statistics'] = $statistics[0];   
        }
		
		return $statisticsFromAll;
	
	}
        public function offerClickActivate(){
              $this->autoRender = false;
        
       $query = "UPDATE offers SET status = 'INACTIVE' WHERE id = " .$_POST['id']." and status = '".$_POST['status']."';";
        print_r($query);
        $Offersparam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnOffers = $this->AccentialApi->urlRequestToGetData('users', 'query', $Offersparam);
       
        return $returnOffers;
        }
        public function offerClickDesactivate(){
              $this->autoRender = false;
        
       $query = "UPDATE offers SET status = 'ACTIVE' WHERE id = " .$_POST['id']." and status = '".$_POST['status']."';";
        print_r($query);
        $Offersparam = array(
            'User' => array(
                'query' => $query
            )
        );

        $returnOffers = $this->AccentialApi->urlRequestToGetData('users', 'query', $Offersparam);
       
        return $returnOffers;
        }
		
	public function configImportOffer() {
        $this->autoRender = false;
        if ($_FILES['file']['tmp_name']) {

            //Capturamos o arquivo que está sendo upado  no INPUT[FILE]
            $objPHPExcel = PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);

            //capturamos o total de colunas
            $columns = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
            //transformamos o total de colunas em número
            $columnsNumber = PHPExcel_Cell::columnIndexFromString($columns);
            //capturamos o total de linhas
            $rows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

            $scripts = '';
            //faremos o foreach baseado no total de linhas, pois será nosso 
			
				$root = $_SERVER['DOCUMENT_ROOT'];
		$root = $root.'/uploads/offersFotos'; 
		
		
		$link = mysql_connect('lm1qivwncj3xprd.c2g7fyxoel3s.sa-east-1.rds.amazonaws.com', 'jezdbadmin', 'JEZdB1000');
		
            for ($linha = 3; $linha <= $rows; $linha++) {

		
		$arquivo['type'] = ".jpg";
		$arquivo['name'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(14, $linha)->getValue();
		$arquivo['tmp_name'] = $root.'/'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(14, $linha)->getValue();
	
		$photo= $this->AccentialApi->uploadAnyPhotos('uploads/company-99999/offers', $arquivo, 99999);
		
		/**
		TIRANDO ASPAS SIMPLES DOS TEXTOS
		*/
		$resume = str_replace("'", "", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $linha)->getValue());
		$description = str_replace("'", "", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $linha)->getValue());
		$specification = str_replace("'", "", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $linha)->getValue());
		$result = str_replace("'","", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $linha)->getValue());
		$brand = str_replace("'","", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(20, $linha)->getValue());
		
		/**
		TROCANDO VIRGULAS POR PONTO
		*/
		$cost = str_replace(",", ".",$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, $linha)->getValue());
		$value = str_replace(",", ".", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8, $linha)->getValue());
		$percentageDiscount = str_replace(",", ".",$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(9, $linha)->getValue());
		$weight = str_replace(",", ".", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(10, $linha)->getValue());

		
		$application = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(27, $linha)->getValue().';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(28, $linha)->getValue();
		$hairType = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(29, $linha)->getValue().';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(30, $linha)->getValue().';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(31, $linha)->getValue();

		
		$productCategories = '';
		
		$productCategories .= $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(23, $linha)->getValue();
		
		if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(24, $linha)->getValue() != ''){
				$productCategories .= ';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(24, $linha)->getValue();
		}
		
		if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(25, $linha)->getValue() != ''){
				$productCategories .= ';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(25, $linha)->getValue();
		}
		
	/**
		`value_2`,
`percentage_discount_2`,
`value_3`,
`percentage_discount_3`
		**/
		$dtInicio = date('Y-m-d');
                $sql = "INSERT INTO offers
(
`company_id`,
`title`,
`resume`,
`description`,
`specification`,
`value`,
`percentage_discount`,
`weight`,
`amount_allowed`,
`begins_at`,
`ends_at`,
`photo`,
`metrics`,
`parcels`,
`parcels_off_impost`,
`public`,
`status`,
`SKU`,
`parcels_quantity`,
`brand`,
`line`,
`result`,
`purchase_price`,
`classification`,
`cost`)
VALUES(
{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $linha)->getValue()},"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $linha)->getValue()}',"
                        . "'{$resume}',"
                        . "'{$description}',"
                        . "'{$specification}',"
                        . "{$value},"
                        . "{$percentageDiscount},"
                        . "{$weight},"
                        . "{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(11, $linha)->getValue()},"
                        . "'{$dtInicio}',"
                        . "'2999-12-02 00:00:00',"
                        . "'{$photo}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(23, $linha)->getValue()}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(15, $linha)->getValue()}',"
                        . "'INACTIVE',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(16, $linha)->getValue()}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(17, $linha)->getValue()}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(18, $linha)->getValue()}',"
                        . "{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(19, $linha)->getValue()},"
                        . "'{$brand}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(21, $linha)->getValue()}',"
                        . "'{$result}',"
                        . "{$cost},"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, $linha)->getValue()}',"
						. "{$cost});
						
						SET @LAST_ID = last_insert_id();
						
						insert into offers_statistics(`offer_id`, `details_click`, `checkouts_click`, `purchased_billet`, `purchased_card`)
						VALUES(
						@LAST_ID,
						0,
						0,
						0,
						0);
						
						INSERT INTO offers_questions(
						`offer_id`,
						`hair_type`,
						`application`,
						`product_categories`,
						`public`
						) VALUES(
						@LAST_ID,
						'{$hairType}',
						'{$application}',
						'{$productCategories}',
						'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(26, $linha)->getValue()}'
						);
						
						INSERT INTO offers_extra_infos(
						`offer_id`,
						`delivery_deadline`,
						`category_id`,
						`delivery_mode`,
						`offer_type`,
						`offer_orientation`,
						`delivery_value`) VALUES(
						@LAST_ID,
						0,
						0,
						'CORREIO',
						'PRODUCT',
						' ',
						0.0);";
						
                $scripts[$linha] = $sql;
				
            }
			
			/**
			percorreremos agora a lista de INSERTs e executaremos um à um 
			**/
			$contador = 0 ;
			foreach($scripts as $script){
			
										$param = array(
            'User' => array(
                'query' => $script
            )
        );

         $this->AccentialApi->urlRequestToGetData('users', 'query', $param);
		 echo 'Registro: '.$contador. ' inserido com sucesso. ID: '.mysql_insert_id().' <br/>';
		 
			$contador++;
			}
			echo "<a href='../masterProduct'><button type='button'>Voltar</button></a>";
            
            
        }
    }
	
	/**
	* Função responsável por importar ofertas do XLS e alterar as que já existem
	*/
	public function configImportOfferINSERTandUPDATE() {
        $this->autoRender = false;
        if ($_FILES['file']['tmp_name']) {

            //Capturamos o arquivo que está sendo upado  no INPUT[FILE]
            $objPHPExcel = PHPExcel_IOFactory::load($_FILES['file']['tmp_name']);

            //capturamos o total de colunas
            $columns = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
            //transformamos o total de colunas em número
            $columnsNumber = PHPExcel_Cell::columnIndexFromString($columns);
            //capturamos o total de linhas
            $rows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

            $scripts = '';
            //faremos o foreach baseado no total de linhas, pois será nosso 
			
				$root = $_SERVER['DOCUMENT_ROOT'];
		$root = $root.'/uploads/offersFotos'; 
		
		
		$link = mysql_connect('lm1qivwncj3xprd.c2g7fyxoel3s.sa-east-1.rds.amazonaws.com', 'jezdbadmin', 'JEZdB1000');
		
            for ($linha = 3; $linha <= $rows; $linha++) {
			
			/**
			* Verificamos se oferta já é existente
			*/
			$sqlSELECT = "SELECT * FROM offers WHERE sku = '{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(18, $linha)->getValue()}';";
			$paramSELECT  = array(
				'User' => array(
						'query' => $sqlSELECT
					)
				);

			$selectedOffers = $this->AccentialApi->urlRequestToGetData('users', 'query', $paramSELECT);
			
			
				if(!empty($selectedOffers)){
				
					$value = str_replace(",", ".", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8, $linha)->getValue());
					$sqlUPDATE = "UPDATE offers SET `amount_allowed` = {$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(11, $linha)->getValue()}, `value` = {$value} WHERE id = {$selectedOffers[0]['offers']['id']};";
					$scripts[$linha] = $sqlUPDATE;
				
				}
				else{

		
		$arquivo['type'] = ".jpg";
		$arquivo['name'] = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(14, $linha)->getValue();
		$arquivo['tmp_name'] = $root.'/'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(14, $linha)->getValue();
	
		$photo= $this->AccentialApi->uploadAnyPhotos('uploads/company-99999/offers', $arquivo, 99999);
		
		/**
		TIRANDO ASPAS SIMPLES DOS TEXTOS
		*/
		$resume = str_replace("'", "", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $linha)->getValue());
		$description = str_replace("'", "", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $linha)->getValue());
		$specification = str_replace("'", "", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $linha)->getValue());
		$result = str_replace("'","", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $linha)->getValue());
		$brand = str_replace("'","", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(20, $linha)->getValue());
		
		/**
		TROCANDO VIRGULAS POR PONTO
		*/
		$cost = str_replace(",", ".",$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(6, $linha)->getValue());
		$value = str_replace(",", ".", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(8, $linha)->getValue());
		$percentageDiscount = str_replace(",", ".",$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(9, $linha)->getValue());
		$weight = str_replace(",", ".", $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(10, $linha)->getValue());

		
		$application = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(27, $linha)->getValue().';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(28, $linha)->getValue();
		$hairType = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(29, $linha)->getValue().';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(30, $linha)->getValue().';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(31, $linha)->getValue();

		
		$productCategories = '';
		
		$productCategories .= $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(23, $linha)->getValue();
		
		if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(24, $linha)->getValue() != ''){
				$productCategories .= ';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(24, $linha)->getValue();
		}
		
		if($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(25, $linha)->getValue() != ''){
				$productCategories .= ';'.$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(25, $linha)->getValue();
		}
		
	/**
		`value_2`,
`percentage_discount_2`,
`value_3`,
`percentage_discount_3`
		**/
		$dtInicio = date('Y-m-d');
                $sql = "INSERT INTO offers
(
`company_id`,
`title`,
`resume`,
`description`,
`specification`,
`value`,
`percentage_discount`,
`weight`,
`amount_allowed`,
`begins_at`,
`ends_at`,
`photo`,
`metrics`,
`parcels`,
`parcels_off_impost`,
`public`,
`status`,
`SKU`,
`parcels_quantity`,
`brand`,
`line`,
`result`,
`purchase_price`,
`classification`,
`cost`,
`is_promotional`)
VALUES(
{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $linha)->getValue()},"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $linha)->getValue()}',"
                        . "'{$resume}',"
                        . "'{$description}',"
                        . "'{$specification}',"
                        . "{$value},"
                        . "{$percentageDiscount},"
                        . "{$weight},"
                        . "{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(11, $linha)->getValue()},"
                        . "'{$dtInicio}',"
                        . "'2999-12-02 00:00:00',"
                        . "'{$photo}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(23, $linha)->getValue()}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(15, $linha)->getValue()}',"
                        . "'INACTIVE',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(16, $linha)->getValue()}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(17, $linha)->getValue()}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(18, $linha)->getValue()}',"
                        . "{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(19, $linha)->getValue()},"
                        . "'{$brand}',"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(21, $linha)->getValue()}',"
                        . "'{$result}',"
                        . "{$cost},"
                        . "'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(7, $linha)->getValue()}',"
						. "{$cost},"
						."'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(32, $linha)->getValue()}');
						
						SET @LAST_ID = last_insert_id();
						
						insert into offers_statistics(`offer_id`, `details_click`, `checkouts_click`, `purchased_billet`, `purchased_card`)
						VALUES(
						@LAST_ID,
						0,
						0,
						0,
						0);
						
						INSERT INTO offers_questions(
						`offer_id`,
						`hair_type`,
						`application`,
						`product_categories`,
						`public`
						) VALUES(
						@LAST_ID,
						'{$hairType}',
						'{$application}',
						'{$productCategories}',
						'{$objPHPExcel->getActiveSheet()->getCellByColumnAndRow(26, $linha)->getValue()}'
						);
						
						INSERT INTO offers_extra_infos(
						`offer_id`,
						`delivery_deadline`,
						`category_id`,
						`delivery_mode`,
						`offer_type`,
						`offer_orientation`,
						`delivery_value`) VALUES(
						@LAST_ID,
						0,
						0,
						'CORREIO',
						'PRODUCT',
						' ',
						0.0);";
						
                $scripts[$linha] = $sql;
				
            }
			}
			
			/**
			percorreremos agora a lista de INSERTs e executaremos um à um 
			**/
			$contador = 0 ;
			foreach($scripts as $script){
			
										$param = array(
            'User' => array(
                'query' => $script
            )
        );

         $this->AccentialApi->urlRequestToGetData('users', 'query', $param);
		 echo 'Registro: '.$contador. ' inserido com sucesso. ID: '.mysql_insert_id().' <br/>';
		 
			$contador++;
			}
			echo "<a href='../masterProduct'><button type='button'>Voltar</button></a>";
            
            
        }
    }
	
	public function openDirectory(){
		$this->autoRender = false;
		$root = $_SERVER['DOCUMENT_ROOT'];
		
		$root = $root.'/uploads/offersFotos'; 
		
		$arquivo['type'] = ".jpg";
		$arquivo['name'] = "hazor.jpg";
		$arquivo['tmp_name'] = $root.'/hazor.jpg';
	
		$offersExtraPhotos = $this->AccentialApi->uploadAnyPhotos('uploads/company-99999/offers', $arquivo, 99999);
		echo $offersExtraPhotos;
		
		if(is_dir($root)){
			if($dh = opendir($root)){
				while(($file = readdir($dh)) !== false){
					
					
				}
				closedir($dh);
			}
		}
		
		//echo $root;
	}
        
}
