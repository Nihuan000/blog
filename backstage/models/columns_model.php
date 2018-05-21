<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-4
 * Time: 上午11:46
 */
class Columns_model extends ADMIN_Model{

    protected $_table = 'columns';
    private $_count;

    function __construct(){
        parent::__construct();
    }

    public function save($data = array()){
        if(!empty($data)){
            if($this->db->insert($this->_table, $data)){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }

    //根据id获取详细信息
    public function find_by_pk($pk){
        return $this->db->from($this->_table)
                ->where('c_id',$pk)
                ->get()->row();
    }

    //更新数据
    public function update($id,$data = array()){
        return $this->db->where('c_id',$id)
                         ->update($this->_table,$data);
    }

    //删除数据
    public function delete($id){
    	$default_column = default_category();
    	if(!empty($default_column)){
	    	$this->db->where('c_id',$id);
	    	$this->db->update('article',array('c_id'=>$default_column->c_id));
    	}
        return $this->db->delete($this->_table,array('c_id' => $id));
    }

    //获取所有栏目
    public function find_all(){
        $column_array = array();
        $columns = $this->db->from($this->_table)->where('pid',0)->get()->result_array();
        if(!empty($columns)){
            foreach($columns as $key => $value){
                $column_array[$value['c_id']] = $value;
                $sub_column = $this->db->from($this->_table)->where('pid',$value['c_id'])->get()->result_array();
                if(!empty($sub_column)){
                  foreach($sub_column as $sk => $sv){
                      $column_array[$value['c_id']]['sub'][$sk] = $sv;
                  }
                }
            }
        }
        return $column_array;
    }

    //获取结果总条数

    public function get_result_count($where = array()){
        return $this->db->from($this->_table)
                        ->where($where)
                        ->count_all_results();
    }

    public function get_count(){
        return $this->_count;
    }

}