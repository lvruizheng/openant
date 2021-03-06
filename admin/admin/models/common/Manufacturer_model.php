<?php
class Manufacturer_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//取品牌列表
	public function get_manufacturers($data)
	{
		$this->db->limit($this->config->get_config('config_limit_admin'), $data['page']);
		$this->db->select('manufacturer_id');
		$this->db->from($this->db->dbprefix('manufacturer'));
		
		$query=$this->db->get();
		
		//统计记录条数
		$row['count']   =$this->db->count_all_results($this->db->dbprefix('manufacturer'));
		if($query->num_rows() > 0){
			foreach($query->result_array() as $value){
				$row['manufacturer'][]=$this->get_manufacturer_for_language($value['manufacturer_id']);
			}
			
			return $row;
		}
		return FALSE;
	}
	
	//取品牌给分类
	public function get_manufacturers_to_category()
	{
		$this->db->select('manufacturer_id');
		$this->db->where('status', '0');
		$this->db->from($this->db->dbprefix('manufacturer'));
		$query=$this->db->get();
		if($query->num_rows() > 0){
			foreach($query->result_array() as $value){
				$row[]=$this->get_manufacturer_for_language($value['manufacturer_id']);
			}
			return $row;
		}
		return FALSE;
	}
	
	//取品牌
	public function get_manufacturer_for_language($manufacturer_id)
	{
		$this->db->where('m.manufacturer_id', $manufacturer_id);
		$this->db->where('md.language_id', isset($_SESSION['language_id']) ? $_SESSION['language_id'] : '1');
		$this->db->join('manufacturer_description AS md','md.manufacturer_id = m.manufacturer_id');
		$this->db->from($this->db->dbprefix('manufacturer') . ' AS m');
		
		$query=$this->db->get();
		
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		
		return FALSE;
	}
	
	//删除品牌
	public function delete_manufacturer($data)
	{
		foreach($data as $key=>$value){
			$this->db->delete($this->db->dbprefix('manufacturer'), array('manufacturer_id' => $data[$key]));
			$this->db->delete($this->db->dbprefix('manufacturer_description'), array('manufacturer_id' => $data[$key]));
		}
	}
	
	//验证品牌是否被商品使用
	public function get_product_manufacturer_for_manufacturer_id($manufacturer_id){
		$this->db->where('manufacturer_id',$manufacturer_id);
		$this->db->from($this->db->dbprefix('manufacturer_to_store'));
		
		$query=$this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}
		return FALSE;
	}
	
	//取单条品牌为二维数组
	public function get_manufacturer_arr($manufacturer_id){
		$row['description']=FALSE;
		
		$this->db->where('manufacturer_id',$manufacturer_id);
		$this->db->from($this->db->dbprefix('manufacturer'));
		$query=$this->db->get();
		if($query->num_rows() > 0){
			$row=$query->row_array();
			
			//取描述
			$this->db->where('manufacturer_id',$manufacturer_id);
			$this->db->from($this->db->dbprefix('manufacturer_description'));
			$query=$this->db->get();
			
			if($query->num_rows() > 0){
				$description=array();
				$de=$query->result_array();
				foreach($de as $key=>$value){
					$description[$de[$key]['language_id']]=$value;
				}
				$row['description']=$description;
			}
			
			return $row;
		}
		return FALSE;
	}

	//修改品牌
	public function edit_manufacturer($data){
		//更新attribute表
		$data['base']['date_modified']=date("Y-m-d H:i:s");
		$this->db->where('manufacturer_id', $data['manufacturer_id']);
		$this->db->update($this->db->dbprefix('manufacturer'), $data['base']);
		
		//更新descript表
		foreach($data['description'] as $key=>$value){
			$data['description'][$key]['language_id']=$key;
			$data['description'][$key]['manufacturer_id']=$data['manufacturer_id'];
			$this->db->replace($this->db->dbprefix('manufacturer_description'), $data['description'][$key]);
		}
	}

	//添加品牌
	public function add_manufacturer($data){
		//写入attribute表
		$data['base']['date_added']=date("Y-m-d H:i:s");
		$data['base']['date_modified']=date("Y-m-d H:i:s");
		$this->db->insert($this->db->dbprefix('manufacturer'), $data['base']);
		
		//写入descript表
		//取最后查入的一第分类id
		$manufacturer_id=$this->db->insert_id();
		
		foreach($data['description'] as $key=>$value){
			$data['description'][$key]['language_id']=$key;
			$data['description'][$key]['manufacturer_id']=$manufacturer_id;
			$this->db->replace($this->db->dbprefix('manufacturer_description'), $data['description'][$key]);
		}
	}
}