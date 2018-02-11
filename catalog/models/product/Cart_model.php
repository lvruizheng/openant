<?php
class Cart_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function add_cart($data){
		
		if($this->user->isLogged()){
			$user_id=$this->user->getId();
		}else{
			$user_id='0';
		}
		foreach($data as $key=>$value){
			$cart=array();
			if(isset($data[$key]['options'])){
				$cart['options']= implode('.', $data[$key]['options']);
			}else{
				$cart['options']='';
			}
			
			$cart['id']=$data[$key]['id'];
			$cart['user_id']=$user_id;
			//$cart['qty']=$data[$key]['qty'];
			//$cart['price']=$data[$key]['price'];
			$cart['name']=$data[$key]['name'];
			//$cart['rowid']=md5($cart['id'].serialize($cart['options']).$_SESSION['cart_id']);
			$cart['points']=$data[$key]['points'];
			
			if(isset($data[$key]['preferential_type'])){
				$cart['preferential_type']=$data[$key]['preferential_type'];
			}
			if(isset($data[$key]['preferential_value'])){
				$cart['preferential_value']=$data[$key]['preferential_value'];
			}
			
			$this->db->select('rowid,qty,price');
			$this->db->where($cart);
			$this->db->from($this->db->dbprefix('user_cart'));
			$query=$this->db->get();

			if($query->num_rows() > 0){
				$cart_info = $query->result_array();	
				$this->db->where($cart);

				$updates['qty'] = $cart_info[0]['qty'] + $data[$key]['qty'];
				$updates['price'] = $cart_info[0]['price'] + $data[$key]['price'];

				$this->db->update($this->db->dbprefix('user_cart'), $updates);
				$cart['rowid'] = $cart_info[0]['rowid'];
			}else{
				$cart['rowid']=md5($cart['id'].serialize($cart['options']).$_SESSION['cart_id']);
				$cart['qty'] = $data[$key]['qty'];
				$cart['price'] = $data[$key]['price'];
				
				$this->db->insert($this->db->dbprefix('user_cart'), $cart);
			}
			
			return $cart['rowid'];
		}
		return FALSE;
	}
	
	public function get_carts(){
		$this->db->select('rowid, id, qty, price, name, options, points');
		$this->db->where('user_id', (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '0'));
		$this->db->order_by('date_added', 'DESC');
		$this->db->from($this->db->dbprefix('user_cart'));
		$cart_query=$this->db->get();
		if($cart_query->num_rows() > 0){
			$cart_contents=array();
			$cart_arr=$cart_query->result_array();
			foreach($cart_arr as $key=>$value){
				$cart_arr[$key]['options']=explode('.', $cart_arr[$key]['options']);
				$cart_contents[$cart_arr[$key]['rowid']]=$cart_arr[$key];
				$cart_contents[$cart_arr[$key]['rowid']]['subtotal']=$cart_arr[$key]['qty'] * $cart_arr[$key]['price'];
			}
			$cart_contents['cart_total']=array_sum(array_column($cart_contents,'price'));
			$cart_contents['total_items']=array_sum(array_column($cart_contents,'qty'));
			return $cart_contents;
		}
		return FALSE;
	}
	
	public function get_cart_for_rowid($rowid){
		$this->db->select('rowid, id, qty, price, name, options, points');
		$this->db->where('user_id', $_SESSION['user_id']);
		$this->db->where('rowid', $rowid);
		$this->db->from($this->db->dbprefix('user_cart'));
		$query=$this->db->get();
		if($query->num_rows() > 0){
			$cart_product=$query->row_array();
			
			$data['options']=explode('.', $cart_product['options']);
			$data['rowid']=$cart_product['rowid'];
			$data['subtotal']=$cart_product['qty'] * $cart_product['price'];
			$data['cart_total']=array_sum(array_column($cart_product,'price'));
			$data['total_items']=array_sum(array_column($cart_product,'qty'));
			return $data;
		}
		return FALSE;
	}
	
	//用购物车数据取商店数据
	public function get_store($store_id){
		$this->db->select('store.store_id, store_description.store_name');
		$this->db->where('store.store_id', $store_id);
		$this->db->where('store_description.language_id', isset($_SESSION['language_id']) ? $_SESSION['language_id'] : '1');
		$this->db->join('store_description', 'store_description.store_id = store.store_id');
		$this->db->from($this->db->dbprefix('store'));
		$query=$this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		
		return;
	}
	
	//用购物车数据取商品图片
	public function get_product_info($product_id){
		$this->db->select('*');
		$this->db->where('product_id', $product_id);
		$this->db->from($this->db->dbprefix('product'));
		$query=$this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		return false;
	}
	
	public function get_product_name($rowid){
		$this->db->select('name');
		$this->db->where('rowid', $rowid);
		$this->db->from($this->db->dbprefix('user_cart'));
		$query=$this->db->get();
		if($query->num_rows() > 0){
			return $query->row_array()['name'];
		}
		return false;
	}
	
	public function get_tax_for_cart($tax_class_id){
		//查税
		$this->db->select('tax_rate.rate, name, type');
		$this->db->where('tax_class.tax_class_id', $tax_class_id);
		$this->db->where('tax_class_description.language_id', isset($_SESSION['language_id']) ? $_SESSION['language_id'] : '1');
		$this->db->where('tax_rate_description.language_id', isset($_SESSION['language_id']) ? $_SESSION['language_id'] : '1');
		$this->db->join('tax_class_description','tax_class_description.tax_class_id = tax_class.tax_class_id');
		$this->db->join('tax_rule','tax_rule.tax_class_id = tax_class.tax_class_id');
		$this->db->join('tax_rate','tax_rate.tax_rate_id = tax_rule.tax_rate_id');
		$this->db->join('tax_rate_description','tax_rate_description.tax_rate_id = tax_rule.tax_rate_id');
		$this->db->join('tax_rate_to_user_class','tax_rate_to_user_class.tax_rate_id = tax_rule.tax_rate_id');
		$this->db->from($this->db->dbprefix('tax_class'));//查
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			return $query->row_array();
		}
		return FALSE;
	}
	
	//用购物车数据取商品属性
	public function get_product_options($product_id,$options){
		//$row=array();
		
		$this->db->select('option_group_id');
		$this->db->where('product_id', $product_id);
		$this->db->where('option_id', $options);
		$this->db->from($this->db->dbprefix('product_option_value'));
		$query=$this->db->get();
		if($query->num_rows() > 0){
			$option_ids=explode('.', $options);
			$option_group_ids=explode('.', $query->row_array()['option_group_id']);
			
			foreach($option_group_ids as $key=>$value){
				$this->db->select('option_group_description.option_group_name, option_description.name');
				$this->db->where('option_group_description.language_id', isset($_SESSION['language_id']) ? $_SESSION['language_id'] : '1');
				$this->db->where('option_description.language_id', isset($_SESSION['language_id']) ? $_SESSION['language_id'] : '1');
				$this->db->where_in('option.option_id', $option_ids);
				$this->db->join('option', 'option.option_group_id = option_group_description.option_group_id');
				
				$this->db->join('option_description', 'option_description.option_id = option.option_id');
				
				$this->db->where('option_group_description.option_group_id', $option_group_ids[$key]);
				$this->db->from($this->db->dbprefix('option_group_description'));
				
				$query=$this->db->get();
				if($query->num_rows() > 0){
					$row[$key]['group_name']=$query->row_array()['option_group_name'];
					$row[$key]['option_name']=$query->row_array()['name'];
				}
			}
		}
		
		if(isset($row)){
			foreach($row as $key=>$value){
				$re[]=implode(':', $row[$key]);
			}
			return implode('  ',$re);
		}else{
			return FALSE;
		}
	}
	
	public function update_cart($data){
		$this->db->where('rowid', $data['rowid']);
		return $this->db->update($this->db->dbprefix('user_cart'), $data);
	}
	
	public function delete($rowid){
		return $this->db->delete($this->db->dbprefix('user_cart'), array('rowid' => $rowid));
	}
}
