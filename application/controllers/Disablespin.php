<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );

class Disablespin extends CI_Controller {

    public function uptodate(){ 
		$this->load->model('ProductModel');
		$product = new ProductModel();
		
		$json = $this->getstatus();
		
		if($json['status_mercado'] == 1){
		    date_default_timezone_set('America/Sao_Paulo');
		    if($json['fechamento']['dia'] == date('d')){
		        date_default_timezone_set('America/Sao_Paulo');
			    if(date('H') >= $json['fechamento']['hora']-1){
			        if(date('i') >= $json['fechamento']['minuto']){
    			        $proditem = $product->getproduct($json['rodada_atual']);
                		if($proditem){
                            $productdata['productid'] = $proditem['productid'];
        					$productdata['productname'] = $proditem['productname'];
        					$productdata['productprice'] = $proditem['productprice'];
        					$productdata['productcategory'] = $proditem['productcategory'];
        					$productdata['productstatus'] = 0;
        					if($product->update($productdata)){
        					    
        					}
                		}
			        }
			    }
			}
		}
	}

}