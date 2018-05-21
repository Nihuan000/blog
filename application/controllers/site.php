<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-16
 * Time: 下午3:16
 */

class Site extends MY_Controller{

    public function index($page = 0){
    	$page = (int)$page;
        $page_size = 10;
        $offset = ($page == 0 ? $page : $page - 1) * $page_size;
        $data['article'] = $this->article_home->get_all($page_size,$offset,true);
        $data['count'] = $this->article_home->get_count();
        $config['base_url'] = site_url();
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $page_size;
//        $config['slash_base_url'] = FALSE;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['cur_page'] = $page;
        $config['uri_segment'] = 1;
        $this->pagination->initialize($config);
        $data['site_pagination'] = $this->pagination->create_links();
		set_metaSeo('','index');
        $this->load->view('index',$data);
    }

	//404错误
	public function _show_404(){
		$this->output->set_status_header('404');
        set_metaSeo('','index');
		$this->load->view('errors/error_404');
	}

    //sitemap
    public function sitemap(){
        $data = array();
        //分类和文章
        $data['root_cate'] = $this->category_home->find_root_cate();
        if(!empty($data['root_cate'])){
            foreach($data['root_cate'] as $key => $value){
                $data['root_cate'][$key]->url = category_url($value->c_id);
                $subcate = $this->category_home->find_all($value->c_id);
                if(!empty($subcate)){
                    foreach($subcate as $sk => $sv){
                        $data[$key][$sk]->url = category_url($sv->c_id);
                    }
                    $data['root_cate'][$key]->sec_cate = $subcate;
                }
            }
        }
        //new article
        $new_article = $this->article_home->get_all(1000,0,true);
        if(!empty($new_article)){
            foreach($new_article as $a_k => $a_v){
                $new_article[$a_k]->url = article_url($a_v->a_id);
            }
            $data['new_article'] = $new_article;
        }
        //tag
        $tags = $this->tag_home->get_all_tag();
        if(!empty($tags)){
            foreach($tags as $tk => $tv){
                $tags[$tk]->url = tag_url($tv->tag,$tv->en_tag);
            }
            $data['tags'] = $tags;
        }
        set_metaSeo('','index');
        $this->load->view('sitemap',$data);
    }

    //订阅
    public function subscribe(){
        $email = $this->input->post('email');
        $status = '订阅失败，请检查邮箱格式!';
        if (preg_match('/^[A-Za-z0-9-_.+%]+@[A-Za-z0-9-.]+\.[A-Za-z]{2,4}$/',$email)) {
            if(true === $this->subscribe_home->save($email)){
                $status = 'ok';
            }else{
                $status = '订阅失败,请不要重复订阅或者可以刷新重试';
            }
        }else{
            $status = '订阅失败，请检查邮箱格式!';
        }
        echo $status;
    }

    //生成migration迁移
    public function migration()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }else{
            echo $this->migration->latest();
        }
    }
}
