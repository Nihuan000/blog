<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-12-03
 * Time: 上午11:34
 */
class Tag_home extends MY_Model{

    private $_table = 'tag';
    public function __construct(){
        parent::__construct();
    }

	public function get_by_name($tag){
		$en_tag = addslashes(trim($tag));
		return $this->db->get_where($this->_table,array('en_tag'=>$en_tag))->row();
	}

    //根据查看次数获取热门tag
    public function get_by_match(){
        $tag = $this->db->from($this->_table)
            ->order_by('match DESC')
            ->limit(50,0)
            ->get()
            ->result();
        return $tag;
    }

    //获取所有tag
    public function get_all_tag(){
        return $this->db->from($this->_table)->get()->result();
    }

}
