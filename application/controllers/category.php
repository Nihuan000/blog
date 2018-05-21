<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-18
 * Time: 下午4:51
 */
class Category extends MY_Controller{

	public function show($url_name,$sub_url='',$page = 0){
		$en_url = !empty($sub_url) ? $sub_url : $url_name;
		$category = $this->category_home->findByUrl($en_url);
		if(!empty($category)){
			$sub_cate = $this->category_home->find_sub_cate($category->c_id);
			$page = (int)$page;
			$page_size = 10; 
			$data['article'] = $this->article_home->get_all($page_size,$page,true,'',array('c_id'=>$sub_cate));
			$data['count'] = $this->article_home->get_count();
			$config['base_url'] = site_url();
			$config['total_rows'] = $data['count'];
			$config['per_page'] = $page_size;
			$config['slash_base_url'] = FALSE;
			$config['use_page_numbers'] = TRUE;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$this->pagination->cur_page = $page;
			$data['site_pagination'] = $this->pagination->create_links();
			set_metaSeo($category->c_id,'category');
			$this->load->view('index',$data);
		}
	}
}
