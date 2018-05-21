<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-16
 * Time: 下午3:16
 */

class Main extends ADMIN_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        if($this->session->userdata('userinfo') != false){
            redirect('main/mainPage');
        }
        $this->load->helper('auth');
        $data['username'] = $this->input->post('login_name');
        $data['password'] = $this->input->post('login_password');
        $data['verify'] = $this->input->post('captcha');
        if($this->input->post('submit') == true){
            if(auth_security($data) == false){
                redirect('/');
            }else{
                $this->session->set_userdata('userinfo',array('uid'=>auth_security($data),'username'=>$data['username']));
                redirect('main/mainPage');
            }
        }
        $this->load->view('login');
    }

    public function mainPage(){
        $data['comment_count'] = $this->comment_model->get_result_count() ? $this->comment_model->get_result_count() : 0 ;
        $data['review_count'] = $this->article_model->get_review_count();
        $data['subscribe_count'] = $this->subscribe_model->get_result_count();
        $data['tag_count'] = $this->tag_model->get_result_count();
        $data['link_count'] = $this->link_model->get_result_count();
        $data['article_count'] = $this->article_model->get_result_count();
        $this->load->view('statistics',$data);
    }

    //验证码
    public function captcha() {
        $this->load->helper('captcha');
        $cap = create_captcha(array('word_lenght' => 4, 'img_height' => 27, 'img_width' => 100));
        $this->session->set_userdata('captcha_word', $cap['word']);
        $this->output->set_header("Content-type: image/jpeg");
        ImageJPEG($cap['image']);
        ImageDestroy($cap['image']);
    }

    //编辑器上传图片
    public function area_img(){
        //文件保存目录路径
        $dir_name = date('Ymd');
        $full_dir_name = HOMEPATH . 'attached/' . $dir_name . '/';
        $url= rtrim('http://'.$_SERVER['HTTP_HOST'],'/') . '/';
        if(!file_exists($full_dir_name)){
            mkdir($full_dir_name,0777);
        }
        $config['upload_path'] = $full_dir_name;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['max_size'] = 10000;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if(!$this->upload->do_upload('imgFile')){
            $errors = $this->upload->display_errors();
            echo json_encode(array('success' => false, 'msg' => $errors));
        }else{
            $upload_date = $this->upload->data();
            echo json_encode(array('success' => true, 'file_path' =>str_replace(HOMEPATH,$url,$upload_date['full_path'])));
        }
    }
}
