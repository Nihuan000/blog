<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-11
 * Time: 上午11:16
 */
class Comment_model extends ADMIN_Model{

    private $_table = 'comment';
    private $_count;
    public function __construct(){
        parent::__construct();
    }

    public function findAll($offset,$limit,$is_count = false){
        $comment = $this->db->get($this->_table,$limit,$offset)->result();
        if($is_count){
            $this->_count = $this->get_result_count();
        }

        return $comment;
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

    public function update($data = array(),$id){
        return $this->db->update_string($this->_table,$data,"id = '{$id}'");
    }
}