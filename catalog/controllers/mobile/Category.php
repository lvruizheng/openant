<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('category/category_model');
	}

	public function index()
	{
		$this->lang->load('mobile/category',$_SESSION['language_name']);
		
		$this->document->setTitle(lang_line('title'));
		//$this->document->addScript(base_url('resources/public/resources/default/js/slinks/jquery.slinky.js'));
		//$this->document->addStyle(base_url('resources/public/resources/default/css/slinks/jquery.slinky.css'));
		
		$data['menus']=$this->category_model->get_categorys_to_top();
		$data['munus_names']=array_column($data['menus'],'name');
		//var_dump($data['menus']);die;
		
		
		$data['position_top']=$this->position_top->index();
		$data['position_left']=$this->position_left->index();
		$data['position_right']=$this->position_right->index();
		$data['position_bottom']=$this->position_bottom->index();
		
		$data['header']=$this->header->index();
		$data['top']=$this->header->top();
		$data['footer']=$this->footer->index();
		
		if($this->agent->is_mobile() && $this->config->get_config('view_type') == 1){
			$this->load->view('theme/default/template/mobile/m_category',$data);
		}else{
			$this->load->view('theme/default/template/mobile/category',$data);
		}
	}
}
