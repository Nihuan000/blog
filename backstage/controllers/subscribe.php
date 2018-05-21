<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-30
 * Time: 上午10:50
 */
class Subscribe extends ADMIN_Controller{

    public function index($page = 1){
        $page = (int)$page;
        $page_size = 20;
        $offset = ($page - 1) * $page_size;
        $data['subscribe_list'] = $this->subscribe_model->find_all($page_size,$offset,true);
        $data['count'] = $this->subscribe_model->get_count();
        $config['base_url'] = site_url('subscribe/index');
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $page_size;
        $config['slash_base_url'] = FALSE;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $this->pagination->cur_page = $page;
        $data['subscribe_pagination'] = $this->pagination->create_links();

        $this->load->view('subscribe',$data);
    }
}