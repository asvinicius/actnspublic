<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set(“display_errors”, 0 );

class Equipesaux extends CI_Controller {
    
    /*
    public function parcialret(){
        set_time_limit(6000);
        ini_set('default_socket_timeout', 6000);
        
        $this->load->model('ParciaisModel');
		$this->load->model('PartialModel');
		$this->load->model('PAModel');
		$this->load->model('PartialatletasModel');
		$this->load->model('PRModel');
		$this->load->model('ReservaModel');
		$parciais = new ParciaisModel();
		$partial = new PartialModel();
		$parciais_atletas = new PAModel();
		$pa = new PartialatletasModel();
		$parciais_reservas = new PRModel();
		$pr = new ReservaModel();
		
		$parciaislista = $parciais->listing();
		$palista = $parciais_atletas->listing();
		$prlista = $parciais_reservas->listing();
		
		foreach($prlista as $item){
			
			$prdata['pr_id'] = $item->pr_id;
			$prdata['pr_team'] = $item->pr_team;
			$prdata['pr_atleta'] = $item->pr_atleta;
			
			if($pr->save($prdata)){
			    echo "P.R. concluída";
			}
		}
		
    }
    */
    
    
    public function added($id = null){ 
        set_time_limit(6000);
        ini_set('default_socket_timeout', 6000);
        
        $this->load->model('EquipesModel');
        $this->load->model('TimesModel');
        $this->load->model('TEModel');
        $equipes = new EquipesModel();
        $timesmodel = new TimesModel();
        $te = new TEModel();
        
        /*
        if($id){
            $times = $te->searchequipe($id);
            echo "<strong>TIMES ADICIONADOS</strong>";
            echo "<hr />";
            
            foreach($times as $time){
                $cartoladata = $this->getsquad($time->te_time);
                $item = $cartoladata['time'];
                
                $timedata['time_id'] = $item['time_id'];
        	    $timedata['time_nome'] = $item['nome'];
        	    $timedata['time_cartoleiro'] = $item['nome_cartola'];
        	    $timedata['time_slug'] = $item['slug'];
        	    $timedata['time_escudo'] = $item['url_escudo_svg'];
        	    $timedata['time_pontos'] = 0;
        	    $timedata['time_status'] = 1;
        	    
        	    if($timesmodel->save($timedata)){
        	        echo $item['nome'];
        	        echo "<br />";
    	        }
        	    
            }
            
            $equipedata = $equipes->search($id);
            $equipedata['equipe_pontos'] = 0;
            
            if($equipes->update($equipedata)){
    	        echo "<hr />";
	        }
        }
        */
        
        $ativos = $equipes->listActive();
        
        foreach($ativos as $ativo){
            if($ativo->equipe_pontos == 0){
                echo "<label style='color: green'>OK</label> - ".$ativo->equipe_nome."<br />";
            } else {
                echo "<label style='color: red'>PENDENTE</label> - <a href='https://acretinos.com.br/equipesaux/added/".$ativo->equipe_id."'>adicionar</a> - ".$ativo->equipe_nome."<br />";
            }
        }
        return false;
    }
    
    /*
    public function added($id = null){ 
        set_time_limit(6000);
        ini_set('default_socket_timeout', 6000);
        
        $this->load->model('TEModel');
        $this->load->model('TimesModel');
        $te = new TEModel();
        $times = new TimesModel();
        
        $telist = $te->listing();
        
        foreach($telist as $teitem){
            $item = $this->getsquad($teitem->te_time);
	        $itemtime = $item['time'];
	        
	        $timedata['time_id'] = $itemtime['time_id'];
    	    $timedata['time_nome'] = $itemtime['nome'];
    	    $timedata['time_cartoleiro'] = $itemtime['nome_cartola'];
    	    $timedata['time_slug'] = $itemtime['slug'];
    	    $timedata['time_escudo'] = $itemtime['url_escudo_svg'];
    	    $timedata['time_pontos'] = 0;
    	    $timedata['time_status'] = 1;
	        
	        if($times->save($timedata)){
    	        echo $itemtime['nome'];
    	        echo "<br />";
	        }
	        
        }
        return false;
    }
    */
    
    public function updouble(){
        $this->load->model('DoubleModel');
        $this->load->model('DTModel');
        $double = new DoubleModel();
        $dt = new DTModel();
        
        $listdoubles = $double->listing();
        
        foreach($listdoubles as $doubleunid){
            
            $equipe_data['equipe_id'] = $doubleunid->equipe_id;
            $equipe_data['equipe_nome'] = $doubleunid->equipe_nome;
            $equipe_data['equipe_escudo'] = $doubleunid->equipe_escudo;
            $equipe_data['equipe_pontos'] = 0;
            $equipe_data['equipe_status'] = $doubleunid->equipe_status;
            
            $item = $dt->searchequipe($doubleunid->equipe_id);
            
            foreach($item as $unid){
                
                $data = $this->getsquad($unid->te_time);
                
                $equipe_data['equipe_pontos'] += $data['pontos_campeonato'];
                
            }
            
            $double->update($equipe_data);
        }
        
    }
    
    public function getpontos($equipe_id){ 
        $this->load->model('StatusModel');
        $this->load->model('TEModel');
        $this->load->model('TimesModel');
        $this->load->model('RankingModel');
        $this->load->model('TabelaModel');
        $status = new StatusModel();
        $te = new TEModel();
        $times = new TimesModel();
        $ranking = new RankingModel();
        $tabela = new TabelaModel();
        
        $laststatus = $status->search();
        
        $item = $te->searchequipe($equipe_id);
        
        foreach($item as $unid){
            $time = $times->search($unid->te_time);
            $data = $this->getsquad($unid->te_time, $laststatus['currentround']);
            
            $time_data['time_id'] = $time['time_id'];
            $time_data['time_nome'] = $time['time_nome'];
            $time_data['time_cartoleiro'] = $time['time_cartoleiro'];
            $time_data['time_slug'] = $time['time_slug'];
            $time_data['time_escudo'] = $time['time_escudo'];
            $time_data['time_pontos'] = $time['time_pontos'] + $data['pontos'];
            $time_data['time_status'] = $time['time_status'];
            
            if($times->update($time_data)){
                $tabela_data['tabela_equipea_pontos'] = $tabela_data['tabela_equipea_pontos'] + $data['pontos'];
            }
        }
    }
    
    public function getsquad($teamid) {
        
        $url = 'https://api.cartola.globo.com/time/id/'.$teamid;
        
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