<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-17
 * Time: 下午2:01
 */
class UserManageAuth{

    private $CI;

    public function __construct(){
        $this->CI = &get_instance();
    }

    /**
     * 权限认证
     */
    public function auth(){
        if((!$this->CI->session->userdata('userinfo') || $this->CI->session->userdata('userinfo') == false)) {
            if($this->CI->router->class !='main' || ( $this->CI->router->class == 'main' && $this->CI->router->method != 'index' && $this->CI->router->method != 'captcha')){
                redirect('/');
            } 
        }
    }
}