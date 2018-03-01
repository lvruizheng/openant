<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library(array('currency'));
		$this->load->model(array('product/product_model', '/category/category_model'));
	}

	public function index()
	{
		$this->lang->load('product/category', $_SESSION['language_name']);
		
		if($this->input->get('page')){
			$data['page']=$this->input->get('page');
		}else{
			$data['page']='0';
		}
		
		if($this->input->get('search') != NULL){
			$search = $this->input->get('search');
			$search = str_replace('？', '', $search);
			$search=str_replace('?', '', $search);
			$search=utf8_substr($search, 0, 30);
			
			$this->load->helper('text');
			$this->load->model('common/search_model');
			
			$data['search']=$search;
			
			$data['search_key_words']=$this->search_model->get_top();
			$data['search_abouts']=$this->search_model->get_about($search);
			$data['label']=array('primary', 'success', 'info', 'warning', 'danger');
		}
		
		if($this->input->get('id')){
			$ids=explode('_', $this->input->get('id'));
			if(isset($ids[1])){
				$data['category_id']=$ids[1];
			}else{
				$data['category_id']=$ids[0];
			}
		}

		if($this->input->get('order_by')){
			$order_by = $this->input->get('order_by');
			$data['order_by'] = $order_by;
		}
		
		$category_info=$this->category_model->get_category_to_category($this->input->get('id'));
		
		
		$data['categorys']=$category_info;
		
		$products_info=$this->product_model->get_products_to_category($data);

		if($products_info){
			$data['products']=$products_info['products'];
			$data['count']=$products_info['count'];
		}
		
		//分页
		$config['base_url'] 			= $this->config->item('catalog').'/product/category?id='.$this->input->get('id');
		$config['num_links'] 			= 2;
		$config['page_query_string'] 	= TRUE;
		$config['query_string_segment'] = 'page';
		$config['full_tag_open'] 		= sprintf(lang_line('page'), @(floor($products_info['count'] / $this->config->get_config ( 'config_limit_catalog' )) + 1), @(floor($data['page'] / $this->config->get_config ( 'config_limit_catalog' )) + 1));
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
		$config['total_rows'] 			= isset($products_info['count']) ? $products_info['count'] : '0';
		$config['per_page'] 			= $this->config->get_config('config_limit_catalog');

		$this->pagination->initialize($config);

		$data['pagination'] 			= $this->pagination->create_links();
		
		if($this->input->get('search') != NULL){
			$title=$this->input->get('search');
			$description=$this->input->get('search');
		}elseif($category_info){
			if(isset($category_info['childs'])){
				foreach($category_info['childs'] as $child){
					if($child['category_id'] == $data['category_id']){
						$title=$child['name'];
						$description=$child['description'];
					}else{
						$title=$category_info['name'];
						$description=$category_info['description'];
					}
				}
			}else{
				$title=$category_info['name'];
				$description=$category_info['description'];
			}
			$data['category_name']=$category_info['name'];
			$data['category_id']=$category_info['category_id'];
			
		}else{
			$title=lang_line('all_product');
			
			if(unserialize($this->config->get_config('meta_description'))[$_SESSION['language_id']]){
				$description=unserialize($this->config->get_config('meta_description'))[$_SESSION['language_id']];
			}
		}
		
		$this->document->setTitle($title);
		
		//提取关键词key
		$this->load->library('phpanalysis');
		$this->load->helper('string');
		$this->phpanalysis->SetSource (unserialize($this->config->get_config('site_name'))[$_SESSION['language_id']].$title.$title.utf8_substr(DeleteHtml($description), 0, 200));
		$this->phpanalysis->StartAnalysis ( true );
			
		$tags = $this->phpanalysis->GetFinallyKeywords ( 20 ); // 获取文章中的五个关键字
		
		$this->document->setKeywords($tags);
		//提取关键词key
		
		$this->document->setDescription(utf8_substr(DeleteHtml($description), 0, 200));
		
		$data['keyword']=$title;
		
		$data['position_top']=$this->position_top->index();
		$data['position_left']=$this->position_left->index();
		$data['position_right']=$this->position_right->index();
		$data['position_bottom']=$this->position_bottom->index();
		
		$data['header']=$this->header->index();
		$data['top']=$this->header->top();
		$data['footer']=$this->footer->index();

		$data['id'] = $this->input->get('id');
		
		if($this->config->get_config('view_type') == 1){
			if($this->input->get('comefrom') != null && $this->input->get('comefrom') == 'scroll'){
				if($data['products']){
					return $this->load->view('theme/default/template/product/m_category_list',$data);
				}else{
					return false;
				}
			}else{
				$this->load->view('theme/default/template/product/m_category',$data);
			}
		}else{
			$this->load->view('theme/default/template/product/category',$data);
		}
	}
	
	public function category_all()
	{
		$this->lang->load('product/category', $_SESSION['language_name']);
		
		$this->document->setTitle('所有分类');
		
		if($this->input->get('page')){
			$page=$this->input->get('page');
		}else{
			$page='0';
		}
		
		$row=$this->category_model->get_categorys_all($page);
		
		$data['categorys']=$row['categorys'];
		
		//分页
		$config['base_url'] 			= $this->config->item('catalog').'product/category/category_all';
		$config['num_links'] 			= 2;
		$config['page_query_string'] 	= TRUE;
		$config['query_string_segment'] = 'page';
		$config['full_tag_open'] 		= sprintf(lang_line('page'), @(floor($row['count'] / $this->config->get_config ( 'config_limit_catalog' )) + 1), @(floor($page / $this->config->get_config ( 'config_limit_catalog' )) + 1));
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
		$config['total_rows'] 			= isset($row['count']) ? $row['count'] : '0';
		$config['per_page'] 			= $this->config->get_config('config_limit_catalog');

		$this->pagination->initialize($config);

		$data['pagination'] 			= $this->pagination->create_links();
		
		$data['position_top']=$this->position_top->index();
		$data['position_left']=$this->position_left->index();
		$data['position_right']=$this->position_right->index();
		$data['position_bottom']=$this->position_bottom->index();
		
		$data['header']=$this->header->index();
		$data['top']=$this->header->top();
		$data['footer']=$this->footer->index();
		
		$this->load->view('theme/default/template/product/category_all',$data);
	}
	
	//添加搜索词
	public function add_search_keyword(){
		$search=$this->input->get('search');
		if(preg_match('/^[\x{4e00}-\x{9fa5}\w-]+$/u', $search) && mb_strlen($search,'UTF8') > 3 && mb_strlen($search,'UTF8') <= 30){
			$this->load->model('common/search_model');
			$this->search_model->add($search);
		}
	}
}
