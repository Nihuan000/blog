<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-19
 * Time: 上午11:34
 */
class Article_home extends MY_Model{

    private $_table = 'article';
    private $_count;

    public function __construct(){
        parent::__construct();
    }

	public function getById($id){
		$article = $this->db->get_where($this->_table,array('a_id'=>$id))->row();
		return $article;
	}
	
	/**
	 *
	 *根据文章的id获取tag找到可能喜欢的其他信息
	 */
	public function get_other_post($artid,$limit = 2){
		$tag = '';
		$article = array();
		$tags = $this->db->get('article_tag',array('article_id'=>$artid))->result();
		if(!empty($tags)){
			foreach ($tags as $key => $value){
				$tag .= $value->tag_id . ',';
			}
			$tag = substr($tag,0,strlen($tag));
			$article = $this->db->from($this->_table)
						->join('article_tag','article_tag.article_id = article.a_id')
						->where('article.a_id !=',$artid)
						->where_in('article_tag.tag_id',$tag)
						->limit($limit)
						->get()
						->result();
			if(!empty($article)){
				foreach($article as $k => $v){
					$article[$k]->cate_url = category_url($v->c_id);
					$category = $this->category_home->findByPk($v->c_id);
					if(!empty($category)){
						$article[$k]->cate_name = $category->cate_name;
						$article[$k]->url = article_url($v->a_id,$category->url_name);
					}
				}
			}
		}
		return $article;
	}
	
	/**
	 * 
	 *获取上一篇和下一片
	 *$order: -1上一篇，1下一篇
	 */
	public function get_other_by_cateid($c_id,$artid,$order = 1){
		$article = '';
		if($order == 1){
			$article = $this->db->get_where($this->_table,array('c_id'=>$c_id,'a_id >'=>$artid,'is_show'=>1))->row();
		}else{
			$article = $this->db->get_where($this->_table,array('c_id'=>$c_id,'a_id <'=>$artid,'is_show'=>1))->row();
		}
		if(!empty($article)){
			$article->cate_url = category_url($article->c_id);
			$category = $this->category_home->findByPk($article->c_id);
			if(!empty($category)){
				$article->cate_name = $category->cate_name;
				$article->url = article_url($article->a_id,$category->url_name);
			}
		}
		return $article;
	}

	//根据tag页获取文章列表
	public function get_ids_by_tag($tag_id){
		$ids = array();
		$articles = $this->db->get_where('article_tag',array('tag_id'=>$tag_id))->result();
		if(!empty($articles)){
			foreach ($articles as $key => $value) {
				$ids[] = $value->article_id;
			}
		}
		return $ids;
	}

    //获取所有文章
    public function get_all($limit = 10,$offset = 0,$count = false,$where = array(),$where_in = array(),$order = 'a_id DESC'){
	$condition['is_show'] = 1;
	if(!empty($where)){
	    foreach($where as $key => $value){
		$condition[$key] = $value;
	    }
	}

	if(!empty($where_in)){
		foreach($where_in as $k => $v){
			$this->db->where_in($k,$v);
		}
	}
        $article = $this->db->from($this->_table)
	    ->where($condition)
	    ->order_by($order)
            ->limit($limit,$offset)
            ->get()
            ->result();
        if(!empty($article)){
            foreach($article as $k => $v){
                if(isset($v->c_id) && !empty($v->c_id)){
                    $article[$k]->cate_url = category_url($v->c_id);
                    $category = $this->category_home->findByPk($v->c_id);
                    if(!empty($category)){
                        $article[$k]->cate_name = $category->cate_name;
                        $article[$k]->url = article_url($v->a_id,$category->url_name);
                    }
                }
                // $article[$k]->comment_count = $this->comment_home->get_count_by_article($v->a_id);
            }
        }
        if($count){
			if(!empty($where_in))
				$this->_count = $this->get_result_count($condition,$where_in);
			else
				$this->_count = $this->get_result_count($condition);
        }
        return $article;
    }
    
    //获取结果总条数

    public function get_result_count($where = array(),$where_in = array()){
		if(!empty($where_in)){
			foreach($where_in as $key => $value){
				$this->db->where_in($key,$value);
			}
		}
        return $this->db->from($this->_table)
            ->where($where)
            ->count_all_results();
    }

    public function get_count(){
        return $this->_count;
    }

    public function update($id,$data){
    	return $this->db->update($this->_table,$data,array('a_id'=>$id));
    }
}
