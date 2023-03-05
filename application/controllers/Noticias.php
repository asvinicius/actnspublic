<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Noticias extends CI_Controller {

    public function index(){        
		$this->load->model('CategoryModel');
		$this->load->model('TagModel');
		$this->load->model('NewsModel');
		$category = new CategoryModel();
		$tag = new TagModel();
		$news = new NewsModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$listing = $news->listing();
		$content = array("notice" => $listing);
		
		$listingfront = $news->listfront();
		$listingcategory = $category->listing();
		$listingtag = $tag->listing();
		$menu = array("categories" => $listingcategory, "noticemenu" => $listingfront, "tags" => $listingtag);
		
        $this->load->view('template/header', $pagedata);
        $this->load->view('notice', $content);
        $this->load->view('template/newsmenu', $menu);
		$this->load->view('template/footer');
    }
	
	public function noticia($newsslug = null){
		$this->load->model('CategoryModel');
		$this->load->model('TagModel');
		$this->load->model('NewsModel');
		$this->load->model('NewstagModel');
        $this->load->model('CommentModel');
		$category = new CategoryModel();
		$tag = new TagModel();
		$news = new NewsModel();
		$newstag = new NewstagModel();
        $comment = new CommentModel();
		
		$ogdata = $this->getOgnews($newsslug);
        $pagedata = array("ogdata" => $ogdata);
		
		$specific = $news->getnews($newsslug);
		$listingcomment = $comment->listing($specific['newsid']);
		$num = count($listingcomment);
		$content = array("news" => $specific, "comments" => $listingcomment, "num" => $num);
		
		$listingfront = $news->listfront();
		$listingcategory = $category->categorynews($specific['newscategory']);
		$listingtag = $newstag->listing($specific['newsid']);
		$menu = array("categories" => $listingcategory, "noticemenu" => $listingfront, "tags" => $listingtag);
		
        $this->load->view('template/header', $pagedata);
		$this->load->view('news', $content);
        $this->load->view('template/newsmenu', $menu);
		$this->load->view('template/footer');
	}
	
	public function pesquisar(){
		$this->load->model('CategoryModel');
		$this->load->model('TagModel');
		$this->load->model('NewsModel');
		$category = new CategoryModel();
		$tag = new TagModel();
		$news = new NewsModel();
		
		$searchlabel = $this->input->post("searchlabel");
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$listing = $news->searchmenu($searchlabel);
		$content = array("notice" => $listing);
		
		$listingfront = $news->listfront();
		$listingcategory = $category->listing();
		$listingtag = $tag->listing();
		$menu = array("categories" => $listingcategory, "noticemenu" => $listingfront, "tags" => $listingtag);
		
		$this->load->view('template/header', $pagedata);
        $this->load->view('notice', $content);
        $this->load->view('template/newsmenu', $menu);
		$this->load->view('template/footer');
	}
	
	public function categorias($newscategory){
		$this->load->model('CategoryModel');
		$this->load->model('TagModel');
		$this->load->model('NewsModel');
		$category = new CategoryModel();
		$tag = new TagModel();
		$news = new NewsModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$listing = $news->listcategory($newscategory);
		$content = array("notice" => $listing);
		
		$listingfront = $news->listfront();
		$listingcategory = $category->listing();
		$listingtag = $tag->listing();
		$menu = array("categories" => $listingcategory, "noticemenu" => $listingfront, "tags" => $listingtag);
		
		$this->load->view('template/header', $pagedata);
        $this->load->view('notice', $content);
        $this->load->view('template/newsmenu', $menu);
		$this->load->view('template/footer');
	}
	
	public function tags($tagid){
		$this->load->model('CategoryModel');
		$this->load->model('TagModel');
		$this->load->model('NewsModel');
		$this->load->model('NewstagModel');
		$category = new CategoryModel();
		$tag = new TagModel();
		$news = new NewsModel();
		$newstag = new NewstagModel();
		
		$ogdata = $this->getOgdata();
        $pagedata = array("ogdata" => $ogdata);
		
		$listing = $newstag->listtag($tagid);
		$content = array("notice" => $listing);
		
		$listingfront = $news->listfront();
		$listingcategory = $category->listing();
		$listingtag = $tag->listing();
		$menu = array("categories" => $listingcategory, "noticemenu" => $listingfront, "tags" => $listingtag);
		
		$this->load->view('template/header', $pagedata);
        $this->load->view('notice', $content);
        $this->load->view('template/newsmenu', $menu);
		$this->load->view('template/footer');
	}
	
	public function comentar() {
		$this->load->model('CategoryModel');
		$this->load->model('TagModel');
		$this->load->model('NewsModel');
        $this->load->model('CommentModel');
		$category = new CategoryModel();
		$tag = new TagModel();
		$news = new NewsModel();
        $comment = new CommentModel();

		$commentnews = $this->input->post('commentnews');
		$commentauthor = $this->input->post('commentauthor');
		$commentemailauthor = $this->input->post('commentemailauthor');
		$commentmessage = $this->input->post('commentmessage');
		
		$data['commentid'] = null;
		$data['commentnews'] = $commentnews;
		$data['commentauthor'] = $commentauthor;
		$data['commentemailauthor'] = $commentemailauthor;
		$data['commentmessage'] = $commentmessage;
		$data['commentdate'] = date("Y-m-d H:i");
		$data['commentstatus'] = 1;
		
		
		if($comment->save($data)){			
			
			$ogdata = $this->getOgdata();
			$pagedata = array("ogdata" => $ogdata);
			
			$sendcomment = array(
				"class" => "alert alert-success",
				"message" => "Agradecemos o seu comentario.");
				
			
			$specific = $news->search($commentnews);
			$listingcomment = $comment->listing($commentnews);
			$num = count($listingcomment);
			$content = array("news" => $specific, "comments" => $listingcomment, "num" => $num, "sendcomment" => $sendcomment);
			
			$listingfront = $news->listfront();
			$listingcategory = $category->listing();
			$listingtag = $tag->listing();
			$menu = array("categories" => $listingcategory, "noticemenu" => $listingfront, "tags" => $listingtag);
			
			$this->load->view('template/header', $ogdata);
			$this->load->view('news', $content);
			$this->load->view('template/newsmenu', $menu);
			$this->load->view('template/footer');
		   
		}
	}
	
	public function getOgdata() {
		$current = array(
			"id" => 7, 
			"page" => "user",
			"title" => "Notícias", 
			"description" => "Todas as novidades envolvendo a liga", 
			"url" => "https://www.acretinos.com.br/noticias", 
			"image" => "https://www.acretinos.com.br/assets/img/logotipo.png", 
			"imagealt" => "Todas as novidades envolvendo a liga", 
			"keywords" => "cartola, cartola fc, futebol, brasileirão, campeonato brasileiro, acretinos, bolão, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
	
	public function getOgnews($newsslug = null){
		
		$this->load->model('NewsModel');
		$news = new NewsModel();
		
		$specific = $news->getnews($newsslug);
		
		$current = array(
			"id" => 7, 
			"page" => "user",
			"title" => $specific['newstitle'], 
			"description" => $specific['newsresume'], 
			"url" => "https://www.acretinos.com.br/noticias/noticia/".$specific['newsslug'], 
			"image" => "https://www.gerenciar.acretinos.com.br/assets/img/news/".$specific['newsthumb'],
			"imagealt" => $specific['newsresume'], 
			"keywords" => "cartola, cartola fc, futebol, brasileirão, campeonato brasileiro, acretinos, bolão, liga, mata-mata, dinheiro, dinheiro com futebol", 
		);
        return array("current" => $current);
    }
}