<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-30
 * Time: 下午1:06
 */
class Link extends ADMIN_Controller{

    public function index($page = 1){
    	$page = (int)$page;
        $page_size = 20;
        $offset = ($page -1) * $page_size;
        $link_list = $this->link_model->find_all($page_size,$offset,true);
        $data['link_list'] = $link_list;
        $data['count'] = $this->link_model->get_count();
        $config['base_url'] = site_url('link/index');
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $page_size;
        $config['slash_base_url'] = FALSE;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $this->pagination->cur_page = $page;
        $data['link_pagination'] = $this->pagination->create_links();
        $this->load->view('link',$data);
    }
}