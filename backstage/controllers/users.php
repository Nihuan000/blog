<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-30
 * Time: 上午11:58
 */
class Users extends ADMIN_Controller{

    private $_user;
    public function __construct(){
        parent::__construct();
        $this->_user = $this->session->userdata('userinfo');
    }

    public function index(){
        $update = array();
        $data['user'] = $this->users_model->get_by_pk($this->_user['uid']);
        $users = $this->input->post('users');
        if(isset($users) && !empty($users)){
            $update['username'] =  addslashes(trim($users['username']));
            $update['name'] =  addslashes(trim($users['name']));
            if(!empty($users['password'])){
                $update['password'] =  addslashes(trim($users['password']));
            }
            $update['email'] =  addslashes(trim($users['email']));
            $update['qq'] =  addslashes(trim($users['qq']));
            $update['phone'] =  addslashes(trim($users['phone']));
            $update['txweibo'] =  addslashes(trim($users['txweibo']));
            $update['sina'] =  addslashes(trim($users['sina']));
            $update['weixin'] =  addslashes(trim($users['weixin']));
            $update['maxim'] =  addslashes(trim($users['maxim']));
            $update['photo'] = '';
            //文件保存目录路径
            $full_dir_name = HOMEPATH . 'attached/imgInfo/';
            $url= rtrim($this->setting_model->get('site_url'),'/') . '/';
            if(!file_exists($full_dir_name)){
                mkdir($full_dir_name,0777);
            }
            $config['upload_path'] = $full_dir_name;
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['max_size'] = 1000;
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            if($this->upload->do_upload('users')){
                $old_photo = $data['user']->photo;
                $old_photo = str_replace($url,HOMEPATH,$old_photo);
                if(file_exists($old_photo)){
                    unlink($old_photo);
                }
                $upload_data = $this->upload->data();
                $update['photo'] = str_replace(HOMEPATH,$url,$upload_data['full_path']);
            }
            if(empty($update['photo'])){
                $update['photo'] = $data['user']->photo;
            }
            if($this->users_model->update($data['user']->u_id,$update)){
                set_message('user_update','信息更新成功！','success');
                redirect(current_url());
            }
        }
        $this->load->view('users',$data);
    }

    public function logout(){
        $this->session->unset_userdata('userinfo');
        $this->session->sess_destroy();
        redirect('/');
    }
}