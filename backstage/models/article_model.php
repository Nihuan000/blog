<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-4
 * Time: 下午3:14
 */
class Article_model extends ADMIN_Model
{

    protected $_table = 'article';
    private $_count;

    function __construct()
    {
        parent::__construct();
    }

    public function save($data = array())
    {
        if (!empty($data)) {
            if ($this->db->insert($this->_table, $data)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }
    }

    //根据id获取详细信息
    public function find_by_pk($pk){
        return $this->db->from($this->_table)
            ->where('a_id',$pk)
            ->get()->row();
    }

    //更新数据
    public function update($id,$data = array()){
        return $this->db->where('a_id',$id)
            ->update($this->_table,$data);
    }

    //删除数据
    public function delete($id){
        return $this->db->delete($this->_table,array('a_id' => $id));
    }

    //获取所有文章
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

    public function get_review_count(){
        $reviews = 0;
        $article = $this->find_all(50,0);
        if(!empty($article)){
            foreach($article as $value){
                $reviews += $value->view_count;
            }
        }
        return $reviews;
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