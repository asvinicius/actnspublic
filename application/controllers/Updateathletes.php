<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );

class Updateathletes extends CI_Controller {
    
    // /opt/cpanel/ea-php71/root/usr/bin/php /home/wwacre/public_html/index.php updatepartial uptodate
    // /opt/cpanel/ea-php71/root/usr/bin/php /home/wwacre/public_html/index.php updatepartial updatesquad
    
    public function uptodate(){
        set_time_limit(12000);
        ini_set('default_socket_timeout', 12000);
        
		$this->load->model('AtletasModel');
		$atletas = new AtletasModel();
		
		$json = $this->getstatus();
		
		if($json['status_mercado'] == 2){
		    
		    $listatletas = $atletas->listing();
		    $pontuados = $this->getpontuados();
		    $pontuadoitens = $pontuados['atletas'];
		    
		    if($listatletas){
				foreach($listatletas as $atleta){
					$atletasdata['atletasid'] = $atleta->atletasid;
					$atletasdata['atletasnome'] = $atleta->atletasnome;
					$atletasdata['atletasapelido'] = $atleta->atletasapelido;
					$atletasdata['atletasclube'] = $atleta->atletasclube;
					$atletasdata['atletasposicao'] = $atleta->atletasposicao;
					$atletasdata['atletaspontos'] = $pontuadoitens[$atleta->atletasid]['pontuacao'];
					
					if($atletas->update($atletasdata)){
						
					}
				}
			}
		    
		    /*
		    $start_time = microtime(true);
		    $end_time = microtime(true);
		    $execution_time = ($end_time - $start_time);
		    */
		}
        
    }
    
	public function getpontuados() {
        $url = 'https://api.cartola.globo.com/atletas/pontuados';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
		
        return $json;
        
    }
    
}