<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tag extends MY_Controller{

	public function index($page = 0){
		$page = (int)$page;
		$tag = $this->uri->segment(2);
		$page_size = 10;
		//获取tag信息
		$tag_info = $this->tag_home->get_by_name($tag);
		if(!empty($tag_info)){
			$article_ids = $this->article_home->get_ids_by_tag($tag_info->t_id);
			$data['article'] = $this->article_home->get_all($page_size,$page,true,'',array('a_id'=>$article_ids));
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
			set_metaSeo('','tag',$tag);                                                                 
			$this->load->view('index',$data);
		}
	}
}
