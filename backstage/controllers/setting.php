<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-30
 * Time: 上午11:00
 */
class Setting extends ADMIN_Controller{

    public function basic(){
        $setting = $this->input->post('setting');
        if(isset($setting) && !empty($setting)){
            $update = array();
            if(!empty($setting['site_name'])){
                $update['site_name'] = $setting['site_name'];
            }
            if(!empty($setting['second_name'])){
                $update['second_name'] = $setting['second_name'];
            }
            if(!empty($setting['site_url'])){
                $update['site_url'] = $setting['site_url'];
            }
            if(!empty($setting['date_format'])){
                $update['date_format'] = $setting['date_format'];
            }
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
            if($this->upload->do_upload('site_logo')){
                $old_logo = $this->setting_model->get('site_log');
                str_replace($url,HOMEPATH,$old_logo);
                if(file_exists($old_logo)){
                    unlink($old_logo);
                }
                $upload_data = $this->upload->data();
                $update['site_logo'] = str_replace(HOMEPATH,$url,$upload_data['full_path']);
            }
            if($this->setting_model->update($update)){
                set_message('setting_update','信息更新成功！','success');
                redirect(current_url());
            }
        }
        $this->load->view('setting_basic');
    }

    public function seo(){
        $setting = $this->input->post('setting');
        if(isset($setting) && !empty($setting)){
            $update = array();
            if(!empty($setting['index_meta_title'])){
                $update['index_meta_title'] = $setting['index_meta_title'];
            }
            if(!empty($setting['index_meta_keyword'])){
                $update['index_meta_keyword'] = $setting['index_meta_keyword'];
            }
            if(!empty($setting['index_meta_desc'])){
                $update['index_meta_desc'] = $setting['index_meta_desc'];
            }
            if(!empty($setting['column_meta_title'])){
                $update['column_meta_title'] = $setting['column_meta_title'];
            }
            if(!empty($setting['column_meta_keyword'])){
                $update['column_meta_keyword'] = $setting['column_meta_keyword'];
            }
            if(!empty($setting['column_meta_desc'])){
                $update['column_meta_desc'] = $setting['column_meta_desc'];
            }
            if(!empty($setting['article_meta_title'])){
                $update['article_meta_title'] = $setting['article_meta_title'];
            }
            if(!empty($setting['article_meta_keyword'])){
                $update['article_meta_keyword'] = $setting['article_meta_keyword'];
            }
            if(!empty($setting['article_meta_desc'])){
                $update['article_meta_desc'] = $setting['article_meta_desc'];
            }
            if(!empty($setting['site_copyright'])){
                $update['site_copyright'] = $setting['site_copyright'];
            }
            if($this->setting_model->update($update)){
                set_message('setting_update','信息更新成功！','success');
                redirect(current_url());
            }
        }
        $this->load->view('setting_seo');
    }

}