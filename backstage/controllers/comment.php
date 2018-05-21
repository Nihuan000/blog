<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-29
 * Time: 下午2:41
 */
class Comment extends ADMIN_Controller{

    public function index($page = 1){
        $page = (int)$page;
        $page_size = 20;
        $offset = ($page -1) * $page_size;
        $comment_list = $this->comment_model->findAll($offset,$page_size,true);

        if(!empty($comment_list)){
            foreach($comment_list as $key => $value){
                //获取评论文章名称
                if(!empty($value->article_id)){
                    $article = $this->article_model->find_by_pk($value->article_id);
                    if(!empty($article)){
                        $comment_list[$key]->article_id = $article->title;
                    }
                }
                //获取评论者信息
                if(!empty($value->site_url)){
                    preg_match("/^(http:\/\/)?([^\/]+)/i", $value->site_url, $matches);
                    if(count($matches) < 2){
                        $value->site_url = 'http://' . $value->site_url;
                    }
                }
            }
        }

        $data['comment'] = $comment_list;
        $data['count'] = $this->comment_model->get_count();

        $config['base_url'] = site_url('comment/index');
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $page_size;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 3;
        $config['cur_page'] = $page;
        $this->pagination->initialize($config);
        $this->pagination->cur_page = $page;
        $data['comment_pagination'] = $this->pagination->create_links();
        $this->load->view('comment',$data);
    }

    public function ajaxPass(){
        $id = $this->input->post('id');
        if($id){
            $comment = $this->comment_model->update(array('verify'=>1),$id);
            if($comment){
                echo 'succ';
            }
        }
    }
}