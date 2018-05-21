<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-29
 * Time: 下午2:15
 */
class Tag extends ADMIN_Controller{

    //tag首页列表
    public function index($page = 1){
        $page = (int)$page;
        $page_size = 20;
        $offset = ($page -1) * $page_size;
        $data['tag_list'] = $this->tag_model->find_all($page_size,$offset,true);
        $data['count'] = $this->tag_model->get_count();
        $config['base_url'] = site_url('tag/index');
        $config['total_rows'] = $data['count'];
        $config['per_page'] = $page_size;
        $config['slash_base_url'] = FALSE;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $this->pagination->cur_page = $page;
        $data['tag_pagination'] = $this->pagination->create_links();

        if(isset($_POST['tag'])){

        }
        $this->load->view('tag',$data);
    }

    //编辑tag
    public function edit($id){

    }

    //删除tag
    public function delete($id){

    }
}