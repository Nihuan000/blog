<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-17
 * Time: 下午4:36
 */

//登录安全验证

function auth_security($data = array()){
    $CI = &get_instance();
    if(!empty($data)){
        if(empty($data['username'])){
            set_message('login_error','用户名不能为空','error');
            return false;
        }else if(empty($data['password'])){
            set_message('login_error','密码不能为空','error');
            return false;
        }else if(empty($data['verify'])){
            set_message('login_error','验证码不能为空','error');
            return false;
        }else{
            $auth_info = $CI->db->get_where('users', array('username' => $data['username']))->row();
            if(!empty($auth_info)){
                if($auth_info->password != md5($data['password'])){
                    set_message('login_error','密码错误','error');
                    return false;
                }else{
                    if(strtolower($data['verify']) != strtolower($CI->session->userdata('captcha_word'))){
                        set_message('login_error','验证码错误','error');
                        return false;
                    }else{
                        return $auth_info->u_id;
                    }
                }
            }else{
                set_message('login_error','用户名不存在','error');
                return false;
            }
        }
    }

}
