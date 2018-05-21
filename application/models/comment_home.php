<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-19
 * Time: 下午1:58
 */
class Comment_home extends MY_Model{
    private $_table = 'comment';
    private $count;

    public function __construct(){
        parent::__construct();
    }

    public function save($data = array()){
        $data['time'] = time();
        $data['verify'] = 0;
        $this->db->set($data);
        return $this->db->insert($this->_table);
    }

    public function get_by_post($postid){
        $comment = $this->db->from($this->_table)->where(array('article_id'=>$postid,'verify'=>1,'reply_id' => 0))->get()->result_array();
        if(!empty($comment)){
            foreach($comment as $key => $value){
                $reply = $this->db->get_where($this->_table,array('article_id'=>$value['article_id'],'reply_id'=>$value['id']))->result_array();
                $comment[$key]['reply'] = $reply;
            }
        }
        return $comment;
    }

    public function get_count_by_article($art_id){
        return $this->db->from($this->_table)->where('article_id',$art_id)->count_all_results();
    }
}