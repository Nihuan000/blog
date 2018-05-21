<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-5
 * Time: 下午2:22
 */
class Tag_model extends ADMIN_Model{

    protected $_table = 'tag';

    function __construct()
    {
        parent::__construct();
    }

    public function save($data = array())
    {
        if (!empty($data)) {
            if(empty($data['en_tag'])){
                $data['en_tag'] = Pinyin($data['tag']);
            }
            if ($this->db->insert($this->_table, $data)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }
    }
    public function find($tag)
    {
        if(!empty($tag)){
            return $this->db->get_where($this->_table,array('tag'=>$tag))->row();
        }
    }

    public function find_by_pk($tag_id){
        return $this->db->get_where($this->_table,array('t_id'=>$tag_id))->row();
    }

    //获取所有文章
    public function find_all($limit = 20,$offset = 0,$count = false){
        $tags = array();
        $tags = $this->db->from($this->_table)
            ->limit($limit,$offset)
            ->get()
            ->result_array();
        if(!empty($tags)){
            foreach($tags as $key => $value){
                $article = $this->db->from('article_tag')
                            ->join('article','article.a_id = article_tag.article_id','left')
                            ->where('tag_id',$value['t_id'])
                            ->get()
                            ->row();
                if(!empty($article)){
                    $tags[$key]['article'] = $article->title;
                }
            }
        }
        if($count){
            $this->_count = $this->get_result_count();
        }
        return $tags;
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