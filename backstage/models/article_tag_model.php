<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-5
 * Time: 下午2:28
 */
class Article_tag_model extends ADMIN_Model{

    protected $_table = 'article_tag';

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

    public function find_by_post($id){
        $post_tag_id = $this->db->get_where($this->_table,array('article_id'=>$id))->result();
        if(!empty($post_tag_id)){
            $tag = '';
            foreach($post_tag_id as $key => $value){
                $tags = $this->tag_model->find_by_pk($value->tag_id);
                if(!empty($tags)){
                    $tag .= $tags->tag.',';
                }
            }
            $tag = substr($tag,0,strlen($tag)-1);
            return $tag;
        }
    }
    public function find_by_tag($artid,$tag_id){
    	return $this->db->get_where($this->_table,array('article_id'=>$artid,'tag_id'=>$tag_id))->row();
    }
}