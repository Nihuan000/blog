<?php
/**
 * Created by PhpStorm.
 * User: nihuan
 * Date: 14-11-17
 * Time: 下午2:12
 */
class Setting_model extends ADMIN_Model{

    private $_table = 'setting';
    public function __construct(){
        parent::__construct();
    }

    //获取所有信息
    public function findAll(){
        $setting_arr = array();
        $setting = $this->db->get_where($this->_table,array('isshow'=>1))->result_array();
        if(!empty($setting)){
            foreach($setting as $key => $value){
                $setting_arr[$value['key']] = $value;
            }
        }
        return $setting_arr;
    }

    //根据名称获取设置信息
    public function get($name){
       $setting = $this->db->select('value')
           ->from($this->_table)
           ->where('key',$name)
           ->get()
           ->row();
        if(!empty($setting)){
            return $setting->value;
        }
    }

    //根据提交的数据更改信息
    public function update($data =array()){
        if(!empty($data)){
            foreach($data as $key => $val){
                $this->db->where('key', $key);
                $this->db->update($this->_table, array('value'=>$val));
            }
            return true;
        }
    }
}