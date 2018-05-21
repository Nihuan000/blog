<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-19
 * Time: 下午1:39
 */
class Category_home extends MY_Model{

    private $_table = 'columns';
    private $_count;

    public function __construct(){
        parent::__construct();
    }

    public function findByPk($id){
        return $this->db->get_where($this->_table,array('c_id'=>$id))->row();
    }

	public function findByUrl($url_title){
		return $this->db->get_where($this->_table,array('url_name'=>$url_title))->row();
	}

    public function find_root_cate(){
        $categoryes = $this->db->get_where($this->_table,array('pid'=>0))->result();
        return $categoryes;
    }

    public function find_all($pid){
        if(!empty($pid)){
            $category = $this->db->get_where($this->_table,array('pid'=>$pid))->result();
        }
        return $category;
    }

	public function find_sub_cate($pid = 0){
		$sub_cate = array();
		$query = $this->db->from($this->_table)->where('pid',$pid)->get()->result();
		if(!empty($query)){
			foreach($query as $key => $value){
				$sub_cate []= $value->c_id;	
			}
		}else{
			$sub_cate[] = $pid;
		}
		return $sub_cate;
	}
}
