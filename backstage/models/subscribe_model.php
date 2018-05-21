<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-13
 * Time: 上午11:15
 */
class Subscribe_model extends ADMIN_Model{

    protected $_table = 'subscribe';

    function __construct()
    {
        parent::__construct();
    }

    //获取所有订阅
    public function find_all($limit = 20,$offset = 0,$count = false){
        $article = $this->db->from($this->_table)
            ->limit($limit,$offset)
            ->get()
            ->result();
        if($count){
            $this->_count = $this->get_result_count();
        }
        return $article;
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