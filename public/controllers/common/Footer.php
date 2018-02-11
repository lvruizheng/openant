<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends CI_Common {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('tools'));
		$this->load->model(array('product/cart_model','setting/overall_model'));
	}

	public function index()
	{
		$this->lang->load('common/footer', $_SESSION['language_name']);
		
		$footer_html=$this->overall_model->get_overall('overall', 'footer_html');
		
		$data['footer_html']=$footer_html['setting'][$_SESSION['language_code'] != NULL ? $_SESSION['language_code'] : 'zh-CN'];
		$data ['scripts'] = $this->document->getScripts ('footer');

		if($this->agent->is_mobile() && $this->config->get_config('view_type') == 1){		
			return $this->load->view('theme/default/template/mobile/m_footer',$data,TRUE);
		}else{
			return $this->load->view('theme/default/template/common/footer',$data,TRUE);
		}
	}

	//wap站底部导航
	public function footer_nav($fetch_class){
		//获取购物车
		$data['carts']=$this->cart_model->get_carts();
		$data['fetch_class'] = $fetch_class;
			
		return $this->load->view('theme/default/template/common/m_footer_nav',$data,TRUE);
	}
}
