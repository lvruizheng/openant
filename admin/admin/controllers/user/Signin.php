<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {
	private $error = array();
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('utf8'));
		$this->load->library('form_validation');
		//$this->load->model(array('common/user_model', 'common/user_activity_model'));
		//$this->lang->load('user/signin', $_SESSION['language_name']);
		//$this->lang->load('common/header', $_SESSION['language_name']);
	}

	public function login()
	{
		//用户帐号正常登陆
		$load=FALSE;
		if($this->config->get_config('login_window') == '0' || $this->agent->is_mobile() || $this->input->post('is_view') != '1'){
			$this->document->setTitle('登录');
			
			if($this->input->get('url') != NULL){
				$url=rawurldecode($this->input->get('url'));
			}else{
				$url=base_url();
			}
			
			$data['position_top']=$this->position_top->index();
			$data['position_left']=$this->position_left->index();
			$data['position_right']=$this->position_right->index();
			$data['position_bottom']=$this->position_bottom->index();
			
			$data['header']=$this->header->index();
			//$data['login_top']=$this->header->login_top();
			$data['login_footer']=$this->footer->index();
			
			$load=TRUE;
		}
		
		if($load == TRUE){
			$this->load->view('theme/default/template/user/signin',$data);
		}
	}

	public function logout ()
	{
		//$this->output->set_status_header(302);
		$this->user->logout();
		$this->session->set_flashdata('success', lang_line('success_loginout'));
	}
	
}
