<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Length_class extends MY_Controller {
	private $error = array();
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('utf8'));
		$this->load->language('wecome');
		if(!$this->user->hasPermission('access', 'admin/localisation/length_class')){
			$this->session->set_flashdata('fali', '你没有访问权限！');
			redirect($this->config->item('admin'));
			exit;
		}
		$this->load->library(array('form_validation'));
		$this->load->model(array('localisation/length_class_model', 'common/language_model'));
	}

	public function index(){
		$this->document->setTitle('长度设置');
		
		$this->get_list();
	}
	
	public function add()
	{
		$this->document->setTitle('添加长度设置');
		
		if($_SERVER['REQUEST_METHOD']=="POST" && $this->validate_form()){
			$this->length_class_model->add($this->input->post());
			
			redirect($this->config->item('admin').'localisation/length_class');
		}
		
		$this->get_form();
	}
	
	public function edit()
	{
		$this->document->setTitle('修改长度设置');
		
		if($_SERVER['REQUEST_METHOD']=="POST" && $this->validate_form()){
			$this->length_class_model->edit($this->input->post());
			
			redirect($this->config->item('admin').'localisation/length_class');
		}
		
		$this->get_form();
	}
	
	public function delete()
	{
		$this->document->setTitle('删除长度参数');
		
		if($_SERVER['REQUEST_METHOD']=="POST" && $this->validate_delete()){
			$this->length_class_model->delete($this->input->post('selected'));
			
			redirect($this->config->item('admin').'localisation/length_class');
		}
		
		$this->get_list();
	}
	
	public function get_form()
	{
		if($this->input->get('length_class_id')){
			$length_class_info					=$this->length_class_model->get_length_class_form($this->input->get('length_class_id'));
		}
		
		if($this->input->post('description')){
			$data['description']			=$this->input->post('description');
		}elseif(isset($length_class_info['description'])){
			$data['description']			=$length_class_info['description'];
		}
		
		if($this->input->post('base')['value']){
			$data['value']			=$this->input->post('base')['value'];
		}elseif(isset($length_class_info['value'])){
			$data['value']			=$length_class_info['value'];
		}else{
			$data['value']			='';
		}
		
		if($this->input->get('length_class_id')){
			$data['action']					=$this->config->item('admin').'localisation/length_class/edit?length_class_id='.$this->input->get('length_class_id');
		}else{
			$data['action']					=$this->config->item('admin').'localisation/length_class/add';
		}
		
		if(isset($this->error['error_description'])){
			$data['error_description']		=$this->error['error_description'];
		}
		
		$data['languages']				=$this->language_model->get_languages();
		
		$data['header']=$this->header->index();
		$data['top']=$this->header->top();
		$data['footer']=$this->footer->index();
		$this->load->view('theme/default/template/localisation/length_class_form',$data);
	}

	public function get_list()
	{
		if($this->input->get('page')){
			$data['page']=$this->input->get('page');
		}else{
			$data['page']='0';
		}
		
		$length_classs_info=$this->length_class_model->get_length_classs_for_langugae_id($data);
		if($length_classs_info){
			$data['length_classs']			=$length_classs_info['length_classs'];
			$data['count']					=$length_classs_info['count'];
		}
		
		
		//分页
		$config['base_url'] 			= $this->config->item('admin').'localisation/length_class';
		$config['num_links'] 			= 2;
		$config['page_query_string'] 	= TRUE;
		$config['query_string_segment'] = 'page';
		$config['full_tag_open'] 		= '<nav class="text-left"><ul class="pagination">';
		$config['full_tag_close'] 		= '</ul>';
		$config['first_tag_open'] 		= '<li>';
		$config['first_tag_close'] 		= '</li>';
		$config['last_tag_open'] 		= '<li>';
		$config['last_tag_close'] 		= '</li>';
		$config['next_tag_open'] 		= '<li>';
		$config['next_tag_close'] 		= '</li>';
		$config['prev_tag_open'] 		= '<li>';
		$config['prev_tag_close'] 		= '</li>';
		$config['cur_tag_open'] 		= '<li class="active"><a>';
		$config['cur_tag_close'] 		= '</a></li>';
		$config['num_tag_open']			= '<li>';
		$config['num_tag_close']		= '</li>';
		$config['first_link'] 			= '<<';
		$config['last_link'] 			= '>>';
		$config['total_rows'] 			= $length_classs_info['count'];
		$config['per_page'] 			= $this->config->get_config('config_limit_admin');

		$this->pagination->initialize($config);

		$data['pagination'] 			= $this->pagination->create_links();
		
		$data['delete']					=$this->config->item('admin').'localisation/length_class/delete';
		
		$data['header']=$this->header->index();
		$data['top']=$this->header->top();
		$data['footer']=$this->footer->index();
		$this->load->view('theme/default/template/localisation/length_class_list',$data);
	}
	
	public function validate_delete(){
		if (!$this->user->hasPermission('modify', 'admin/localisation/length_class')) {
			$this->session->set_flashdata('danger', '你无权修改，请联系管理员！');
			$this->error['warning'] = '没有权限修改';
		}
		
		if($this->length_class_model->check_delete($this->input->post('selected'))){
			$this->error['wring_delete']='有一个删除的长度设置正在被使用';
		}
		
		return !$this->error;
	}
	
	//验证表单
	public function validate_form(){
		if (!$this->user->hasPermission('modify', 'admin/localisation/length_class')) {
			$this->session->set_flashdata('danger', '你无权修改，请联系管理员！');
			$this->error['warning'] = '没有权限修改';
		}
		
		$description=$this->input->post('description');
		foreach($description as $key=>$value){
			if((utf8_strlen($description[$key]['title']) < 2) || (utf8_strlen($description[$key]['title']) > 32)){
				$this->error['error_description'][$key]['error_title']='长度名称2——32字符';
			}
			
			if((utf8_strlen($description[$key]['unit']) < 1) || (utf8_strlen($description[$key]['unit']) > 4)){
				$this->error['error_description'][$key]['error_unit']='长度名称1——4字符';
			}
		}
		
		return !$this->error;
	}
}
