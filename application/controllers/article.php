<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-18
 * Time: 下午4:51
 */
class Article extends MY_Controller{

    public function index($artid){
		$data['article'] = $this->article_home->getById($artid);
		if(!empty($data['article'])){
			$data['prev_post'] = $this->article_home->get_other_by_cateid($data['article']->c_id,$artid,-1);
			$data['next_post'] = $this->article_home->get_other_by_cateid($data['article']->c_id,$artid,1);
			$data['other_post'] = $this->article_home->get_other_post($data['article']->a_id);
            //评论
            $data['post_comment'] = $this->comment_home->get_by_post($data['article']->a_id);
            $data['post_comment_count'] = $this->comment_home->get_count_by_article($data['article']->a_id);
			set_metaSeo($data['article']->a_id,'article');
			$this->load->view('detail',$data);
		}else{
			blog_show_404();
		}
    }
}
