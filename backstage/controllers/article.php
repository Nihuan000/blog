<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-20
 * Time: 下午4:03
 */

class Article extends ADMIN_Controller{

	public function index($page = 1){
        $page = (int)$page;
        $page_size = 20;
        $offset = ($page -1) * $page_size;
        $article_list = $this->article_model->find_all($page_size,$offset,true);
        if(!empty($article_list)){
            foreach($article_list as $k => $v){
                $category = $this->columns_model->find_by_pk($v->c_id);
                $user = $this->users_model->get_by_pk($v->uid);
                $article_list[$k]->uid = $user->username;
                $article_list[$k]->c_id = $category->cate_name;
            }
        }
        $data['article_list'] = $article_list;
        $data['count'] = $this->article_model->get_count();
        $config['base_url'] = site_url('article/index');
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $page_size;
        $config['slash_base_url'] = FALSE;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $this->pagination->cur_page = $page;
        $data['article_pagination'] = $this->pagination->create_links();
		$this->load->view('article',$data);
	}

    public function create(){
        $article['category'] = get_columns(TRUE);
        $userinfo = $this->session->userdata('userinfo');

        $posts = $this->input->post('article');
        if(!empty($posts)){
            $this->form_validation->set_rules('article[post_title]', 'title', 'required|xss_clean');
            $this->form_validation->set_rules('article[content]', 'content', 'required|xss_clean');
            $this->form_validation->set_rules('article[meta_keyword]', 'meta_keyword', 'required|xss_clean');
            $this->form_validation->set_rules('article[meta_desc]', 'meta_desc', 'required|xss_clean');
            if($this->form_validation->run() == TRUE){
                $data['uid'] = $userinfo['uid'];
                $data['title'] = addslashes(trim($posts['post_title']));
                $data['content'] = addslashes(trim($posts['content']));
                $data['meta_keyword'] = addslashes(trim($posts['meta_keyword']));
                $data['meta_desc'] = addslashes(trim($posts['meta_desc']));
                $data['is_show'] = 1;
                $data['comment'] = 1;
                $data['view_count'] = 0;
                $data['comment_count'] = 0;
                $data['post_time'] = time();
                $data['c_id'] = $posts['c_id'];
                $articlt_id = $this->article_model->save($data);
                if($articlt_id !== false){
                    if(!empty($posts['tags'])){
                        $posts['tags'] = str_replace('，',',',$posts['tags']);
                        $tags = explode(',',$posts['tags']);
                        if(is_array($tags) && !empty($tags)){
                            foreach($tags as $k => $v){
                                $tag_check = $this->tag_model->find($v);
                                if(empty($tag_check)){
                                    $tag = array();
                                    $tag['tag'] = trim($v);
                                    $tag_id = $this->tag_model->save($tag);
                                }else{
                                    $tag_id = $tag_check->t_id;
                                }

                                if($tag_id !== false){
                                    $art_tag = array();
                                    $art_tag['article_id'] = $articlt_id;
                                    $art_tag['tag_id'] = $tag_id;
                                    $this->article_tag_model->save($art_tag);
                                }

                            }
                        }
                    }
                    set_message('article_add','文章添加成功','success');
                }else{
                    set_message('article_add','文章添加失败','error');
                }
                redirect('article/index');
            }
        }
        $this->load->view('article_create',$article);
    }

    //搜索
    public function search(){

    }

    //更新
    public function update($id){
        $data['category'] = get_columns(TRUE);
		$data['post'] = $this->article_model->find_by_pk($id);
		if(!empty($data['post'])){
            $data['tags'] = $this->article_tag_model->find_by_post($data['post']->a_id);
            $update_article = $this->input->post('article');
            if(isset($update_article) && !empty($update_article['a_id'])){
            	if(!empty($update_article['post_title'])){
            		$article['title'] = addslashes(trim($update_article['post_title']));
            	}
            	if(!empty($update_article['content'])){
            		$article['content'] = addslashes(trim($update_article['content']));
            	}
            	if(!empty($update_article['meta_keyword'])){
            		$article['meta_keyword'] = addslashes(trim($update_article['meta_keyword']));
            	}
            	if(!empty($update_article['meta_desc'])){
            		$article['meta_desc'] = addslashes(trim($update_article['meta_desc']));
            	}
            	if(!empty($update_article['tags'])){
            	 $update_article['tags'] = str_replace('，',',',$update_article['tags']);
                        $tags = explode(',',$update_article['tags']);
                        if(is_array($tags) && !empty($tags)){
                            foreach($tags as $k => $v){
                                $tag_check = $this->tag_model->find($v);
                                if(empty($tag_check)){
                                    $tag = array();
                                    $tag['tag'] = trim($v);
                                    $tag_id = $this->tag_model->save($tag);
                                }else{
                                    $tag_id = $tag_check->t_id;
                                }

                                if($tag_id !== false){
                                	$check_tag = $this->article_tag_model->find_by_tag($update_article['a_id'],$tag_id);
                                	if(empty($check_tag)){
	                                    $art_tag = array();
	                                    $art_tag['article_id'] = $update_article['a_id'];
	                                    $art_tag['tag_id'] = $tag_id;
	                                    $this->article_tag_model->save($art_tag);
                                	}
                                }

                            }
                        }
            	}
            	$result = $this->article_model->update($update_article['a_id'],$article);
            	if($result){
	            	set_message('article_add','文章添加成功','success');
	            	redirect('article/index');
            	}else {
            		set_message('article_add','文章不存在','error');
            		redirect('article/index');
            	}
            }
			$this->load->view('article_create',$data);
		}
    }

    //预览
    public function preview($id){

    }

    //删除
    public function delete(){
		$id = $this->input->post('article_id');
		if(!empty($id)){
			$delete = $this->article_model->delete($id);
			if($delete == true){
				echo 'succ';
			}
		}		

    }
}
