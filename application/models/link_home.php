<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-12-3
 * Time: 下午4:33
 */
class Link_home extends MY_Model{

    private $_table = 'link';
    public function __construct(){
        parent::__construct();
    }

    public function get_all($where = array(),$offset = 0,$limit = 8,$is_count = false){
        $links = $this->db->from($this->_table)->where($where)->limit($limit,$offset)->get()->result();
        if($is_count){
            $this->_count = $this->get_result_count($where);
        }
        return $links;
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