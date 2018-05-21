<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-10-28
 * Time: 上午11:54
 */
class Columns extends ADMIN_Controller{

    public function index(){
        $column_data = array();
        $column_data['lists'] = $this->columns_model->find_all();

        //如果提交了新的分类
        $columns = $this->input->post('columns');
        if(!empty($columns)){
            $this->form_validation->set_rules('columns[cate_name]', 'cate_name', 'required|xss_clean');
            $this->form_validation->set_rules('columns[meta_desc]', 'meta_desc', 'required|xss_clean');
            $this->form_validation->set_rules('columns[meta_keyword]', 'meta_keyword', 'required|xss_clean');
            $this->form_validation->set_rules('columns[url_name]', 'url_name', 'required|alpha_dash');
            if($this->form_validation->run() == TRUE){
                $data = $columns;
                $data['cate_name'] = addslashes(trim($columns['cate_name']));
                $data['meta_desc'] = addslashes(trim($columns['meta_desc']));
                $data['meta_keyword'] = addslashes(trim($columns['meta_keyword']));
                $data['show'] = 1;
                $data['updated'] = time();
                $data['displayorder'] = 1;
                if($this->columns_model->save($data)){
                    set_message('column_add','栏目分类添加成功','success');
                }else{
                    set_message('column_add','栏目分类添加失败','error');
                }
                redirect(array('columns/index'));
            }
        }
        $this->load->view('columns',$column_data);
    }

    public function update($id){
        if(!empty($id)){
            $data = array();
            $column_result = $this->columns_model->find_by_pk($id);
            if(!empty($column_result)){
                $data['column'] = $column_result;
                $update_column = $this->input->post('columns');
                if(!empty($update_column)){
                    $this->form_validation->set_rules('columns[cate_name]', 'cate_name', 'required|xss_clean');
                    $this->form_validation->set_rules('columns[meta_desc]', 'meta_desc', 'required|xss_clean');
                    $this->form_validation->set_rules('columns[meta_keyword]', 'meta_keyword', 'required|xss_clean');
                    $this->form_validation->set_rules('columns[url_name]', 'url_name', 'required|alpha_dash');
                    if($this->form_validation->run() == TRUE){
                        $data = $update_column;
                        $data['cate_name'] = addslashes(trim($update_column['cate_name']));
                        $data['meta_desc'] = addslashes(trim($update_column['meta_desc']));
                        $data['meta_keyword'] = addslashes(trim($update_column['meta_keyword']));
                        $data['updated'] = time();
                        if($this->columns_model->update($id,$data)){
                            redirect(array('columns/index'));
                        }else{
                            set_message('column_update','栏目分类更新失败','error');
                        }

                    }
                }
            }
            $this->load->view('columns_form',$data);
        }
    }

    public function delete(){
    	$id = $this->input->post('cata_id');
        if(!empty($id)){
            if($this->columns_model->delete($id)){
            	set_message('column_add','栏目分类已删除','success');
            	echo 'succ';
            }else{
                set_message('column_add','栏目分类删除失败','error');
            }
        }
    }
}